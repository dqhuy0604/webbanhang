<?php 
require_once('../database/dbhelper.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$keyword = $_GET['keyword'] ?? '';
$keyword = trim(mb_strtolower($keyword));

if (empty($keyword)) {
    echo json_encode(['html' => '<p style="text-align:center; padding: 20px 0;">Không có từ khóa tìm kiếm.</p>']);
    exit;
}

// Thêm cột thumbnail vào SELECT
$sql = "SELECT id, title, price, thumbnail FROM product 
        WHERE title LIKE '%$keyword%' 
        AND deleted = 0 
        ORDER BY updated_at DESC 
        LIMIT 5";
$products = executeResult($sql);

if (empty($products)) {
    echo json_encode(['html' => '<p style="text-align:center; padding: 20px 0;">Không tìm thấy sản phẩm phù hợp với "' . htmlspecialchars($keyword) . '".</p>']);
    exit;
}

// Hàm xử lý đường dẫn ảnh giống như JavaScript
function processThumbnailPath($thumbnailPath) {
    if (empty($thumbnailPath)) {
        return '/webbanhang/webbanhang/assets/images/default.jpg';
    }
    
    // Xử lý đường dẫn ảnh bị lỗi từ database (giống JavaScript)
    $thumbnailPath = preg_replace('/^0+/', '', $thumbnailPath);
    $thumbnailPath = str_replace('assets/images', '', $thumbnailPath);
    $thumbnailPath = str_replace('images', '', $thumbnailPath);
    
    // Đảm bảo có dấu / ở đầu
    if (strpos($thumbnailPath, '/') !== 0) {
        $thumbnailPath = '/' . $thumbnailPath;
    }
    
    return '/webbanhang/webbanhang/assets/images' . $thumbnailPath;
}

// Tạo HTML sử dụng CSS Grid
$html = '<div class="search-results-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 15px; padding: 10px 0;">';

foreach ($products as $product) {
    $id = $product['id'];
    $title = htmlspecialchars($product['title']);
    $price = (float)$product['price'];
    $thumbnailPath = processThumbnailPath($product['thumbnail']);
    
    // Format giá theo định dạng Việt Nam
    $formattedPrice = number_format($price, 0, ',', '.') . ' đ';
    
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
        ">
            ' . $title . '
        </span>
        <span style="color: #e91e63; font-weight: 700; font-size: 14px; line-height: 1.2;">
            ' . $formattedPrice . '
        </span>
    </div>
</div>
</a>';

}

$html .= '</div>';

echo json_encode([
    'html' => $html,
    'count' => count($products)
]);
?>