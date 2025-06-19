<?php
session_start();
require_once('utility.php');
require_once('../database/dbhelper.php');
require_once('../layout/header.php');

// Lấy filter từ URL
$category_id = getGet('category_id');
$brand_id    = getGet('brand_id');
$price_range = getGet('price_range');
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

// Bắt đầu câu SQL
$sql = "
    SELECT p.*, c.name AS category_name, b.name AS brand_name,
           d.discount_type, d.value,
           CASE
               WHEN d.discount_type = 'percent' THEN ROUND(p.price * (1 - d.value / 100), 0)
               WHEN d.discount_type = 'amount' THEN GREATEST(p.price - d.value, 0)
               ELSE p.price
           END AS discounted_price
    FROM product p
    LEFT JOIN category c ON p.category_id = c.id
    LEFT JOIN brand b ON p.brand_id = b.id
    LEFT JOIN product_discount d ON p.id = d.product_id 
        AND NOW() BETWEEN d.start_date AND d.end_date
    WHERE p.deleted = 0
";

// Thêm điều kiện lọc nếu có
if ($category_id != '') {
    $sql .= " AND p.category_id = $category_id";
}
if ($brand_id != '') {
    $sql .= " AND p.brand_id = $brand_id";
}
if ($price_range == '1') {
    $sql .= " AND p.price < 500000";
} elseif ($price_range == '2') {
    $sql .= " AND p.price BETWEEN 500000 AND 1000000";
} elseif ($price_range == '3') {
    $sql .= " AND p.price BETWEEN 1000000 AND 2000000";
}
 elseif ($price_range == '4') {
    $sql .= " AND p.price BETWEEN 2000000 AND 3000000";
}elseif ($price_range == '5') {
    $sql .= " AND p.price BETWEEN 3000000 AND 5000000";
}
 elseif ($price_range == '6') {
    $sql .= " AND p.price > 5000000";
}

$sql .= " ORDER BY $orderSql";

$products = executeResult($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sản phẩm</title>
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
                <div class="wrap-filter">
                    <form method="get" class="list-collection">
                        <div class="shop-sidebar">
                            <h4 class="title">Loại sản phẩm</h4>
                            <select name="category_id" class="form-control">
                                <option value="">-- Tất cả --</option>
                                <?php
                                $categories = executeResult("SELECT * FROM category");
                                foreach ($categories as $cat) {
                                    $selected = ($category_id == $cat['id']) ? 'selected' : '';
                                    echo "<option value='{$cat['id']}' $selected>{$cat['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="shop-sidebar">
                            <h4 class="title">Thương hiệu</h4>
                            <select name="brand_id" class="form-control">
                                <option value="">-- Tất cả --</option>
                                <?php
                                $brands = executeResult("SELECT * FROM brand");
                                foreach ($brands as $b) {
                                    $selected = ($brand_id == $b['id']) ? 'selected' : '';
                                    echo "<option value='{$b['id']}' $selected>{$b['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="shop-sidebar">
                            <h4 class="title">Giá</h4>
                            <select name="price_range" class="form-control">
                                <option value="">-- Tất cả --</option>
                                <option value="1" <?= $price_range == '1' ? 'selected' : '' ?>>Dưới 500K</option>
                                <option value="2" <?= $price_range == '2' ? 'selected' : '' ?>>500K - 1 triệu</option>
                                <option value="3" <?= $price_range == '3' ? 'selected' : '' ?>>1 triệu - 2 triệu </option>
                                <option value="4" <?= $price_range == '1' ? 'selected' : '' ?>>2 triệu - 3 triệu </option>
                                <option value="5" <?= $price_range == '2' ? 'selected' : '' ?>>3 triệu - 5 triệu</option>
                                <option value="6" <?= $price_range == '3' ? 'selected' : '' ?>>Trên 5 triệu</option>
                            </select>
                        </div>
                        <div class="shop-sidebar">
                            <button type="submit" class="btn btn-success mt-2">Lọc sản phẩm</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-75">
                <div class="top-title-colection">
                    <div class="collection-title">
                        <h1>Tất cả sản phẩm</h1>
                    </div>
                        <div class="product-short">
                            <form method="get" id="sortForm">
                            <input type="hidden" name="category_id" value="<?= $category_id ?>">
                            <input type="hidden" name="brand_id" value="<?= $brand_id ?>">
                            <input type="hidden" name="price_range" value="<?= $price_range ?>">
                            
                            <label for="sort">Sắp xếp:</label>
                            <select name="sort" class="sort-by custom-dropdown__select" onchange="document.getElementById('sortForm').submit()">
                                <option>--Bộ lọc--</option>
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
                <div class="content-product-list d-flex flex-wrap">
                    <?php
                    if (empty($products)) {
                        echo '<p class="text-muted">Không tìm thấy sản phẩm nào.</p>';
                    } else {
                        foreach ($products as $item) {
                            echo renderProductItem_1($item);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('../layout/footer.php'); ?>
</body>
</html>
