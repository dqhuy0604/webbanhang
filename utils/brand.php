<?php
session_start();
require_once('utility.php');
require_once('../database/dbhelper.php');
require_once('../layout/header.php');

$brand_id = getGet('id');
$sort = getGet('sort');

$orderSql = 'p.updated_at DESC';
switch ($sort) {
    case 'price_asc':
        $orderSql = 'discounted_price ASC';
        break;
    case 'price_desc':
        $orderSql = 'discounted_price DESC';
        break;
    case 'name_asc':
        $orderSql = 'p.title ASC';
        break;
    case 'name_desc':
        $orderSql = 'p.title DESC';
        break;
    case 'oldest':
        $orderSql = 'p.updated_at ASC';
        break;
    case 'bestseller':
        $orderSql = 'sold_count DESC';
        break;
    case 'inventory_desc':
        $orderSql = 'stock DESC';
        break;
}

$sql = "
    SELECT p.*, c.name AS category_name,
           d.discount_type, d.value,
           CASE 
                WHEN d.discount_type = 'percent' THEN ROUND(p.price * (1 - d.value / 100), 0)
                WHEN d.discount_type = 'amount' THEN GREATEST(p.price - d.value, 0)
                ELSE p.price
           END AS discounted_price,
           IFNULL(SUM(i.quantity), 0) AS stock,
           IFNULL(SUM(od.num), 0) AS sold_count
    FROM product p
    LEFT JOIN category c ON p.category_id = c.id
    LEFT JOIN brand b ON p.brand_id = b.id
    LEFT JOIN product_discount d ON p.id = d.product_id AND NOW() BETWEEN d.start_date AND d.end_date
    LEFT JOIN product_variant v ON p.id = v.product_id
    LEFT JOIN inventory i ON v.id = i.variant_id
    LEFT JOIN order_details od ON p.id = od.product_id
    WHERE p.deleted = 0 AND p.brand_id = $brand_id
";

$category_id = getGet('category_id');
$price = getGet('price');

if ($category_id != '') {
    $sql .= " AND p.category_id = $category_id";
}

if ($price == '1') {
    $sql .= " AND p.price < 500000";
} elseif ($price == '2') {
    $sql .= " AND p.price BETWEEN 500000 AND 1000000";
} elseif ($price == '3') {
    $sql .= " AND p.price BETWEEN 1000000 AND 2000000";
} elseif ($price == '4') {
    $sql .= " AND p.price BETWEEN 2000000 AND 3000000";
} elseif ($price == '5') {
    $sql .= " AND p.price BETWEEN 3000000 AND 5000000";
} elseif ($price == '6') {
    $sql .= " AND p.price > 5000000";
}

$sql .= "
    GROUP BY p.id
    ORDER BY $orderSql
";

$products = executeResult($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sản phẩm theo thương hiệu</title>
    <?php require_once('../assets/css/cssdanhsachsanpham.php'); ?>
</head>
<body>
    <div class="main">
        <div class="container-01">
            <div class="banner-collection" style="margin-top:0px;">
                <img class="dt-width-100" src="../assets/images/banner-01.webp" width="900" height="400">
            </div>

            <div class="row d-flex">
                <div class="col-25">
                   <form method="get" class="wrap-filter" id="filterForm">
                        <input type="hidden" name="id" value="<?=$brand_id?>">
                        <div class="list-collection">
                            <div class="shop-sidebar">
                                <h4 class="title">Danh mục sản phẩm</h4>
                                <select name="category_id" class="form-control" onchange="document.getElementById('filterForm').submit()">
                                    <option value="">-- Tất cả --</option>
                                    <?php
                                    $categories = executeResult("SELECT * FROM category");
                                    foreach ($categories ?? [] as $c) {
                                        $selected = ($c['id'] == $category_id) ? 'selected' : '';
                                        echo "<option value='{$c['id']}' $selected>{$c['name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="shop-sidebar">
                                <h4 class="title">Giá</h4>
                                <select name="price" class="form-control" onchange="document.getElementById('filterForm').submit()">
                                    <option value="">-- Tất cả --</option>
                                    <option value="1" <?= $price == '1' ? 'selected' : '' ?>>Dưới 500K</option>
                                    <option value="2" <?= $price == '2' ? 'selected' : '' ?>>500K - 1 triệu</option>
                                    <option value="3" <?= $price == '3' ? 'selected' : '' ?>>1 triệu - 2 triệu</option>
                                    <option value="4" <?= $price == '4' ? 'selected' : '' ?>>2 triệu - 3 triệu</option>
                                    <option value="5" <?= $price == '5' ? 'selected' : '' ?>>3 triệu - 5 triệu</option>
                                    <option value="6" <?= $price == '6' ? 'selected' : '' ?>>Trên 5 triệu</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-75">
                    <div class="top-title-colection">
                        <div class="collection-title"><h1>Sản phẩm theo thương hiệu</h1></div>
                        <div class="product-short">
                            <form method="get" id="sortForm">
                                <input type="hidden" name="id" value="<?=$brand_id?>">
                                <label for="sort">Sắp xếp:</label>
                                <select name="sort" class="sort-by custom-dropdown__select" onchange="document.getElementById('sortForm').submit()">
                                    <option value="price_asc" <?=($sort=='price_asc')?'selected':''?>>Giá: Tăng dần</option>
                                    <option value="price_desc" <?=($sort=='price_desc')?'selected':''?>>Giá: Giảm dần</option>
                                    <option value="name_asc" <?=($sort=='name_asc')?'selected':''?>>Tên: A-Z</option>
                                    <option value="name_desc" <?=($sort=='name_desc')?'selected':''?>>Tên: Z-A</option>
                                    <option value="oldest" <?=($sort=='oldest')?'selected':''?>>Cũ nhất</option>
                                    <option value="bestseller" <?=($sort=='bestseller')?'selected':''?>>Bán chạy nhất</option>
                                    <option value="inventory_desc" <?=($sort=='inventory_desc')?'selected':''?>>Tồn kho: Giảm dần</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="content-product-list">
                        <?php
                        foreach ($products ?? [] as $item) {
                            renderProductItem($item);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
// Hàm hiện sản phẩm (giữ nguyên từ category.php)
function renderProductItem($item) {
    $originalPrice = $item['price'];
    $discountedPrice = $originalPrice;
    $discountPercent = '';

    if (!empty($item['discount_type']) && $item['value'] > 0) {
        if ($item['discount_type'] == 'percent') {
            $discountedPrice = $originalPrice * (1 - $item['value'] / 100);
            $discountPercent = '-' . intval($item['value']) . '%';
        } elseif ($item['discount_type'] == 'amount') {
            $discountedPrice = $originalPrice - $item['value'];
            $discountPercent = '-' . intval(($item['value'] / $originalPrice) * 100) . '%';
        }
        if ($discountedPrice < 0) $discountedPrice = 0;
    }

    echo '
    <div class="collection-box">
        <div class="product-item-collection">
            <div class="product-top">
                <a href="detail.php?id='.$item['id'].'" class="product-thumb">
                    <img class="dt-width-100" src="../'.$item['thumbnail'].'" alt="" width="260" height="260">
                    <img class="dt-width-100 img-hover" src="../'.$item['thumbnail_2'].'" alt="" width="260" height="260">
                </a>
                '.($discountPercent ? '<div class="product-sale"><span>'.$discountPercent.'</span></div>' : '').'
                <a class="buy-now">
                    <div class="product-icon-add">
                        <button onclick="addCart('.$item['id'].',1)">Thêm vào giỏ</button>
                    </div>
                    <div class="product-icon-watch">
                        <button>Xem nhanh</button>
                    </div>
                </a>
                <div class="product-wishlist">
                    <button class="wishlist-loop">
                        <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích
                    </button>
                </div>
            </div>
            <div class="product-infor">
                <a href="detail.php?id='.$item['id'].'" class="product-name-collection">'.$item['title'].'</a>
                <div class="product-price">
                    <p class="pro-price">
                        <span>'.number_format($discountedPrice).'đ</span>
                        '.($discountedPrice < $originalPrice ? '<del class="compare-price">'.number_format($originalPrice).'đ</del>' : '').'
                    </p>
                </div>
            </div>
        </div>
    </div>';
}
require_once('../layout/footer.php'); ?>
</body>
</html>
