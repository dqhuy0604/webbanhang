    <?php
    require_once('../database/dbhelper.php');
    $conn = mysqli_connect("localhost", "root", "", "webbanhang");

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    $keyword = $_GET['keyword'] ?? '';
    $keyword = trim($keyword);

    // Nếu không có từ khóa
    if (empty($keyword)) {
        echo json_encode(['html' => '<p style="text-align:center; padding: 20px 0;">Không có từ khóa tìm kiếm.</p>']);
        exit;
    }

    function removeVietnameseTones($str) {
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-zA-Z0-9\s]/', '', $str);
        return strtolower(trim($str));
    }

 
    function searchExactProduct($keyword, $conn) {
        $safeKeyword = mysqli_real_escape_string($conn, $keyword);
        $normalizedKeyword = removeVietnameseTones($keyword);
        
        // Tìm kiếm chính xác tên sản phẩm (100% match)
        $exactSql = "SELECT DISTINCT p.id, p.title, p.price, p.thumbnail, b.name as brand_name, c.name as category_name,
                            GROUP_CONCAT(DISTINCT pv.size ORDER BY pv.size ASC SEPARATOR ', ') as available_sizes
                    FROM product p 
                    LEFT JOIN brand b ON p.brand_id = b.id 
                    LEFT JOIN category c ON p.category_id = c.id 
                    LEFT JOIN product_variant pv ON p.id = pv.product_id
                    WHERE p.title = '$safeKeyword' 
                    AND p.deleted = 0 
                    GROUP BY p.id, p.title, p.price, p.thumbnail, b.name, c.name
                    LIMIT 1";
        
        $exactResult = executeResult($exactSql);
        
        if (!empty($exactResult)) {
            return [
                'found' => true,
                'type' => 'exact',
                'products' => $exactResult,
                'message' => 'Tìm thấy sản phẩm: "' . htmlspecialchars($keyword) . '"'
            ];
        }
        
        // Nếu không tìm thấy chính xác, thử tìm kiếm gần đúng (không dấu)
        $similarSql = "SELECT DISTINCT p.id, p.title, p.price, p.thumbnail, b.name as brand_name, c.name as category_name,
                            GROUP_CONCAT(DISTINCT pv.size ORDER BY pv.size ASC SEPARATOR ', ') as available_sizes
                    FROM product p 
                    LEFT JOIN brand b ON p.brand_id = b.id 
                    LEFT JOIN category c ON p.category_id = c.id 
                    LEFT JOIN product_variant pv ON p.id = pv.product_id
                    WHERE LOWER(TRIM(p.title)) = LOWER('$safeKeyword')
                    AND p.deleted = 0 
                    GROUP BY p.id, p.title, p.price, p.thumbnail, b.name, c.name
                    LIMIT 1";
        
        $similarResult = executeResult($similarSql);
        
        if (!empty($similarResult)) {
            return [
                'found' => true,
                'type' => 'similar',
                'products' => $similarResult,
                'message' => 'Tìm thấy sản phẩm tương tự: "' . htmlspecialchars($keyword) . '"'
            ];
        }
        
        return [
            'found' => false,
            'type' => 'none',
            'products' => [],
            'message' => 'Không có sản phẩm "' . htmlspecialchars($keyword) . '"'
        ];
    }

    // 🆕 VERSION 8: Kiểm tra xem có phải tìm kiếm sản phẩm cụ thể không
    function isSpecificProductSearch($keyword) {
        // Kiểm tra các pattern cho tìm kiếm sản phẩm cụ thể
        $patterns = [
            '/^(có|co)\s*(bán|ban)?\s*(.+)\s*(không|khong|\?)/i', // "có bán PRODUCT_NAME không"
            '/^(.+)\s*(có|co)\s*(không|khong|\?)/i',              // "PRODUCT_NAME có không"
            '/^tìm\s*(.+)/i',                                     // "tìm PRODUCT_NAME"
            '/^(.+)\s*ở\s*đâu/i',                                // "PRODUCT_NAME ở đâu"
        ];
        
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, trim($keyword), $matches)) {
                // Lấy tên sản phẩm từ pattern match
                $productName = '';
                if (strpos($pattern, 'có|co') !== false && strpos($pattern, 'bán|ban') !== false) {
                    $productName = isset($matches[3]) ? trim($matches[3]) : '';
                } elseif (strpos($pattern, 'tìm') !== false) {
                    $productName = isset($matches[1]) ? trim($matches[1]) : '';
                } else {
                    $productName = isset($matches[1]) ? trim($matches[1]) : '';
                }
                
                // Loại bỏ các từ không cần thiết
                $productName = preg_replace('/(sản phẩm|san pham|product)/i', '', $productName);
                $productName = trim($productName);
                
                if (!empty($productName) && strlen($productName) > 3) {
                    return $productName;
                }
            }
        }
        
        // Nếu keyword dài và có ít nhất 2 từ, coi như tìm sản phẩm cụ thể
        $words = explode(' ', trim($keyword));
        if (count($words) >= 2 && strlen($keyword) > 10) {
            return $keyword;
        }
        
        return false;
    }

    
    $specificProductName = isSpecificProductSearch($keyword);

    if ($specificProductName !== false) {
        $exactSearch = searchExactProduct($specificProductName, $conn);
        
        if ($exactSearch['found']) {
            // Tìm thấy sản phẩm cụ thể - trả về ngay
            $product = $exactSearch['products'][0];
            $id = $product['id'];
            $title = htmlspecialchars($product['title']);
            $price = number_format((float)$product['price'], 0, ',', '.') . ' đ';
            $thumbnailPath = processThumbnailPath($product['thumbnail']);
            $brandName = htmlspecialchars($product['brand_name'] ?? '');
            $categoryName = htmlspecialchars($product['category_name'] ?? '');
            $availableSizes = htmlspecialchars($product['available_sizes'] ?? '');

            $html = '<div class="exact-product-result" style="padding: 15px; background: #f8f9fa; border: 2px solid #28a745; border-radius: 10px; margin-bottom: 15px;">
                <div style="color: #28a745; font-weight: 600; margin-bottom: 10px; font-size: 14px;">
                     ' . $exactSearch['message'] . '
                </div>
                <a href="detail.php?id=' . $id . '" style="text-decoration: none; color: inherit;">
                    <div style="display: grid; grid-template-columns: 80px 1fr; gap: 15px; padding: 15px; background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        <div style="display: flex; align-items: center; justify-content: center;">
                            <img src="' . $thumbnailPath . '" 
                                alt="' . $title . '" 
                                style="width: 70px; height: 70px; object-fit: contain; border-radius: 6px;"
                                loading="lazy"
                                onerror="this.src=\'/webbanhang/webbanhang/assets/images/default.jpg\'; this.onerror=null;">
                        </div>
                        <div style="display: flex; flex-direction: column; justify-content: center;">
                            <h3 style="margin: 0 0 8px 0; font-size: 16px; font-weight: 600; color: #000; line-height: 1.3;">' . $title . '</h3>
                            <div style="display: flex; gap: 8px; margin-bottom: 8px; flex-wrap: wrap;">
                                ' . (!empty($brandName) ? '<span style="font-size: 11px; color: #666; background: #e9ecef; padding: 2px 6px; border-radius: 4px;">' . $brandName . '</span>' : '') . '
                                ' . (!empty($categoryName) ? '<span style="font-size: 11px; color: #666; background: #e9ecef; padding: 2px 6px; border-radius: 4px;">' . $categoryName . '</span>' : '') . '
                                ' . (!empty($availableSizes) ? '<span style="font-size: 11px; color: #007bff; background: #e7f3ff; padding: 2px 6px; border-radius: 4px;">Size: ' . $availableSizes . '</span>' : '') . '
                            </div>
                            <div style="color: #e91e63; font-weight: 700; font-size: 18px;">' . $price . '</div>
                        </div>
                    </div>
                </a>
            </div>';

            echo json_encode([
                'html' => $html,
                'count' => 1,
                'type' => 'exact_product',
                'message' => $exactSearch['message']
            ]);
            exit;
        } else {
            // Không tìm thấy sản phẩm cụ thể - trả về thông báo
            $html = '<div style="text-align: center; padding: 30px; background: #fff3cd; border: 2px solid #ffc107; border-radius: 10px; color: #856404;">
                <div style="font-size: 18px; margin-bottom: 10px;">❌</div>
                <div style="font-weight: 600; font-size: 16px;">' . htmlspecialchars($exactSearch['message']) . '</div>
                <div style="font-size: 14px; margin-top: 8px; color: #6c757d;">Bạn có thể thử tìm kiếm với từ khóa khác</div>
            </div>';

            echo json_encode([
                'html' => $html,
                'count' => 0,
                'type' => 'exact_product_not_found',
                'message' => $exactSearch['message']
            ]);
            exit;
        }
    }

    // Tiếp tục với logic tìm kiếm thông thường nếu không phải tìm sản phẩm cụ thể
    $keyword = mb_strtolower($keyword);

   
    $keywordMapping = [
        // Thương hiệu
        'brands' => [
            'nike' => ['nike', 'air jordan', 'jordan', 'air max', 'air force'],
            'adidas' => ['adidas', 'yeezy', 'ultraboost', 'stan smith', 'superstar'],
            'puma' => ['puma', 'suede', 'rs-x', 'cali'],
            'lining' => ['li-ning', 'lining', 'li ning', 'way of wade'],
            'converse' => ['converse', 'chuck taylor', 'all star'],
            'vans' => ['vans', 'old skool', 'authentic']
        ],
        
        // Loại sản phẩm - Cập nhật theo category_id thực tế
        'types' => [
            'shoes' => ['giay', 'giày', 'giay dep', 'giày đẹp', 'sneaker', 'giay the thao', 'giày thể thao', 'giay nam', 'giay nu', 'boot', 'sandal'],
            'clothing' => ['ao', 'áo', 'quan', 'quần', 'ao quan', 'áo quần', 'ao thun', 'áo thun', 'shorts', 'hoodie', 'jacket', 'ao khoac', 'áo khoác', 'ao khoac bong ro', 'áo khoác bóng rổ'],
            'basketball' => ['bong ro', 'bóng rổ', 'basketball', 'nba'],
            'socks' => ['tat', 'tất', 'tat the thao', 'tất thể thao', 'vo', 'vớ'],
            'protection' => ['bao ho', 'bảo hộ', 'phu kien bao ho', 'phụ kiện bảo hộ', 'knee pad', 'elbow pad'],
            'backpack' => ['balo', 'ba lo', 'balo the thao', 'ba lô thể thao', 'tui', 'túi'],
            'cap' => ['mu', 'mũ', 'non', 'nón', 'mu bong ro', 'mũ bóng rổ', 'cap']
        ],
        
        // Sizes - Thêm phần tìm kiếm theo size
        'sizes' => [
            'shoe_sizes' => ['35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46'],
            'clothing_sizes' => ['xs', 's', 'm', 'l', 'xl', 'xxl', 'xxxl'],
            'generic_sizes' => ['nho', 'nhỏ', 'vua', 'vừa', 'lon', 'lớn', 'small', 'medium', 'large']
        ]
    ];

    function classifyKeyword($keyword, $keywordMapping) {
        $normalizedKeyword = removeVietnameseTones($keyword);
        
        $result = [
            'brand' => null,
            'type' => null,
            'category' => null,
            'size' => null,
            'searchTerms' => []
        ];
        
        // Tìm brand
        foreach ($keywordMapping['brands'] as $brand => $keywords) {
            foreach ($keywords as $kw) {
                if (strpos($normalizedKeyword, removeVietnameseTones($kw)) !== false) {
                    $result['brand'] = $brand;
                    $result['searchTerms'] = array_merge($result['searchTerms'], $keywords);
                    break 2;
                }
            }
        }
        
        // Tìm type
        foreach ($keywordMapping['types'] as $type => $keywords) {
            foreach ($keywords as $kw) {
                if (strpos($normalizedKeyword, removeVietnameseTones($kw)) !== false) {
                    $result['type'] = $type;
                    $result['searchTerms'] = array_merge($result['searchTerms'], $keywords);
                    break 2;
                }
            }
        }
        
        // Tìm size
        foreach ($keywordMapping['sizes'] as $sizeType => $sizes) {
            foreach ($sizes as $size) {
                if (strpos($normalizedKeyword, strtolower($size)) !== false || 
                    preg_match('/\b' . preg_quote($size, '/') . '\b/i', $keyword)) {
                    $result['size'] = $size;
                    break 2;
                }
            }
        }
        
        // Xác định category
        if ($result['brand'] && $result['type']) {
            $result['category'] = $result['brand'] . '_' . $result['type'];
        } elseif ($result['brand']) {
            $result['category'] = $result['brand'];
        } elseif ($result['type']) {
            $result['category'] = $result['type'];
        }
    
        if (empty($result['searchTerms'])) {
            $result['searchTerms'][] = $keyword;
        }
        
        return $result;
    }

    $classification = classifyKeyword($keyword, $keywordMapping);
    $searchTerms = array_unique($classification['searchTerms']);


    $whereConditions = [];
    $joinClause = "LEFT JOIN product_variant pv ON p.id = pv.product_id";

    foreach ($searchTerms as $term) {
        $safeTerm = mysqli_real_escape_string($conn, $term);
        $whereConditions[] = "p.title LIKE '%$safeTerm%'";
        $whereConditions[] = "p.description LIKE '%$safeTerm%'";
        $whereConditions[] = "b.name LIKE '%$safeTerm%'";
        $whereConditions[] = "c.name LIKE '%$safeTerm%'";
    }

    // Thêm điều kiện tìm kiếm theo size nếu có
    if ($classification['size']) {
        $safeSize = mysqli_real_escape_string($conn, $classification['size']);
        $whereConditions[] = "pv.size = '$safeSize'";
    }

    $whereClause = implode(" OR ", $whereConditions);

   
    $orderByClause = "p.updated_at DESC";

    if ($classification['brand'] && $classification['type']) {
        // Ưu tiên sản phẩm khớp cả brand và type
        $brandTerm = mysqli_real_escape_string($conn, $classification['brand']);
        $orderByClause = "
            CASE 
                WHEN (p.title LIKE '%$brandTerm%' OR b.name LIKE '%$brandTerm%') THEN 1
                ELSE 2
            END,
            p.updated_at DESC
        ";
    } elseif ($classification['brand']) {
    
        $brandTerm = mysqli_real_escape_string($conn, $classification['brand']);
        $orderByClause = "
            CASE 
                WHEN (p.title LIKE '%$brandTerm%' OR b.name LIKE '%$brandTerm%') THEN 1
                ELSE 2
            END,
            p.updated_at DESC
        ";
    } elseif ($classification['size']) {
       
        $orderByClause = "
            CASE 
                WHEN pv.size IS NOT NULL THEN 1
                ELSE 2
            END,
            p.updated_at DESC
        ";
    }

    
    $sql = "SELECT DISTINCT p.id, p.title, p.price, p.thumbnail, b.name as brand_name, c.name as category_name,
                GROUP_CONCAT(DISTINCT pv.size ORDER BY pv.size ASC SEPARATOR ', ') as available_sizes
            FROM product p 
            LEFT JOIN brand b ON p.brand_id = b.id 
            LEFT JOIN category c ON p.category_id = c.id 
            $joinClause
            WHERE ($whereClause) 
            AND p.deleted = 0 
            GROUP BY p.id, p.title, p.price, p.thumbnail, b.name, c.name
            ORDER BY $orderByClause
            LIMIT 50";

    $products = executeResult($sql);

  
    function generateResponseMessage($classification, $keyword, $productCount) {
        if ($productCount == 0) {
            return 'Không tìm thấy sản phẩm phù hợp với "' . htmlspecialchars($keyword) . '".';
        }
        
        $message = "Tìm thấy {$productCount} sản phẩm";
        
        if ($classification['size']) {
            $message .= " size " . strtoupper($classification['size']);
        }
        
        if ($classification['brand'] && $classification['type']) {
            $typeNames = [
                'shoes' => 'giày',
                'clothing' => 'áo/quần', 
                'basketball' => 'bóng rổ',
                'socks' => 'tất thể thao',
                'protection' => 'phụ kiện bảo hộ',
                'backpack' => 'ba lô thể thao',
                'cap' => 'mũ'
            ];
            $typeName = $typeNames[$classification['type']] ?? $classification['type'];
            $message .= " {$typeName} thương hiệu " . strtoupper($classification['brand']);
        } elseif ($classification['brand']) {
            $message .= " thương hiệu " . strtoupper($classification['brand']);
        } elseif ($classification['type']) {
            $typeNames = [
                'shoes' => 'giày',
                'clothing' => 'áo/quần',
                'basketball' => 'bóng rổ', 
                'socks' => 'tất thể thao',
                'protection' => 'phụ kiện bảo hộ',
                'backpack' => 'ba lô thể thao',
                'cap' => 'mũ'
            ];
            $typeName = $typeNames[$classification['type']] ?? $classification['type'];
            $message .= " {$typeName}";
        }
        
        return $message . ":";
    }

    // ✅ Trả về kết quả
    if (empty($products)) {
        $responseMessage = generateResponseMessage($classification, $keyword, 0);
        echo json_encode(['html' => '<p style="text-align:center; padding: 20px 0;">' . $responseMessage . '</p>']);
        exit;
    }

    function processThumbnailPath($thumbnailPath) {
        if (empty($thumbnailPath)) return '/webbanhang/webbanhang/assets/images/default.jpg';
        $thumbnailPath = preg_replace('/^0+/', '', $thumbnailPath);
        $thumbnailPath = str_replace(['assets/images', 'images'], '', $thumbnailPath);
        if (strpos($thumbnailPath, '/') !== 0) $thumbnailPath = '/' . $thumbnailPath;
        return '/webbanhang/webbanhang/assets/images' . $thumbnailPath;
    }

    $responseMessage = generateResponseMessage($classification, $keyword, count($products));
    $html = '<div class="search-header" style="margin-bottom: 10px; padding: 8px 0; border-bottom: 1px solid #eee;">
        <span style="font-weight: 600; color: #333; font-size: 14px;">' . $responseMessage . '</span>
    </div>';

    $html .= '<div class="search-results-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 15px; padding: 10px 0;">';

    foreach ($products as $product) {
        $id = $product['id'];
        $title = htmlspecialchars($product['title']);
        $price = number_format((float)$product['price'], 0, ',', '.') . ' đ';
        $thumbnailPath = processThumbnailPath($product['thumbnail']);
        $brandName = htmlspecialchars($product['brand_name'] ?? '');
        $categoryName = htmlspecialchars($product['category_name'] ?? '');
        $availableSizes = htmlspecialchars($product['available_sizes'] ?? '');

        $html .= '
    <a href="detail.php?id=' . $id . '" style="text-decoration: none; color: inherit;">
    <div class="search-result-item" style="
        display: grid; 
        grid-template-columns: 60px 1fr; 
        gap: 10px; 
        padding: 10px; 
        border: 1px solid #e0e0e0; 
        border-radius: 8px; 
        background: #fff; 
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    " onmouseover="this.style.transform=\'translateY(-2px)\'; this.style.boxShadow=\'0 4px 8px rgba(0,0,0,0.15)\';" onmouseout="this.style.transform=\'translateY(0)\'; this.style.boxShadow=\'0 2px 4px rgba(0,0,0,0.1)\';">
        <div class="product-image" style="display: flex; align-items: center; justify-content: center;">
            <img src="' . $thumbnailPath . '" 
                alt="' . $title . '" 
                style="width: 50px; height: 50px; object-fit: contain; border-radius: 4px;"
                loading="lazy"
                onerror="this.src=\'/webbanhang/webbanhang/assets/images/default.jpg\'; this.onerror=null;">
        </div>
        <div class="product-info" style="display: flex; flex-direction: column; justify-content: center; min-width: 0;">
            <span style="
                font-size: 13px; 
                font-weight: 600; 
                color: #000; 
                line-height: 1.3; 
                display: -webkit-box; 
                -webkit-line-clamp: 2; 
                -webkit-box-orient: vertical; 
                overflow: hidden; 
                text-overflow: ellipsis;
                word-break: break-word;
            ">' . $title . '</span>
            <div style="display: flex; gap: 8px; align-items: center; margin: 2px 0; flex-wrap: wrap;">
                ' . (!empty($brandName) ? '<span style="font-size: 10px; color: #666; background: #f0f0f0; padding: 1px 4px; border-radius: 3px;">' . $brandName . '</span>' : '') . '
                ' . (!empty($categoryName) ? '<span style="font-size: 10px; color: #666; background: #f0f0f0; padding: 1px 4px; border-radius: 3px;">' . $categoryName . '</span>' : '') . '
                ' . (!empty($availableSizes) ? '<span style="font-size: 10px; color: #007bff; background: #e7f3ff; padding: 1px 4px; border-radius: 3px;" title="Các size có sẵn">Size: ' . $availableSizes . '</span>' : '') . '
            </div>
            <span style="color: #e91e63; font-weight: 700; font-size: 14px; line-height: 1.2;">
                ' . $price . '
            </span>
        </div>
    </div>
    </a>';
    }
    $html .= '</div>';

    echo json_encode([
        'html' => $html,
        'count' => count($products),
        'classification' => $classification
    ]);
    ?>