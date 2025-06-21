<?php
session_start();
require_once('utility.php');
require_once('../database/dbhelper.php');
require_once('../layout/header.php');

$productId = getGet('id');
if (!is_numeric($productId)) {
    echo "<h2>Không tìm thấy sản phẩm.</h2>";
    require_once('../layout/footer.php');
    exit;
}

$sql = "
    SELECT p.*, c.name AS category_name,
           b.name AS brand_name, -- thêm tên hãng
           d.discount_type, d.value,
           CASE 
               WHEN d.discount_type = 'percent' THEN ROUND(p.price * (1 - d.value / 100), 0)
               WHEN d.discount_type = 'amount' THEN GREATEST(p.price - d.value, 0)
               ELSE p.price
           END AS discounted_price
    FROM product p
    LEFT JOIN category c ON p.category_id = c.id
    LEFT JOIN brand b ON p.brand_id = b.id  -- join thêm bảng brand
    LEFT JOIN product_discount d ON p.id = d.product_id AND NOW() BETWEEN d.start_date AND d.end_date
    WHERE p.id = $productId
";
$product = executeResult($sql, true);
$originalPrice = $product['price'];
$discountedPrice = $product['discounted_price'] ?? $originalPrice;
$discountPercent = ($originalPrice > 0 && $discountedPrice < $originalPrice)
    ? round(100 - ($discountedPrice / $originalPrice * 100)) : 0;

if (!$product) {
    echo "<h2>Sản phẩm không tồn tại.</h2>";
    require_once('../layout/footer.php');
    exit;
}

$variantSql = "
    SELECT v.size, v.id as variant_id, IFNULL(SUM(i.quantity), 0) as stock
    FROM product_variant v
    LEFT JOIN inventory i ON v.id = i.variant_id
    WHERE v.product_id = $productId
    GROUP BY v.id
    ORDER BY v.size
";
$variants = executeResult($variantSql);

$relatedSql = "
    SELECT p.*, c.name AS category_name,
           d.discount_type, d.value,
           CASE 
               WHEN d.discount_type = 'percent' THEN ROUND(p.price * (1 - d.value / 100), 0)
               WHEN d.discount_type = 'amount' THEN GREATEST(p.price - d.value, 0)
               ELSE p.price
           END AS discounted_price
    FROM product p
    LEFT JOIN category c ON p.category_id = c.id
    LEFT JOIN product_discount d ON p.id = d.product_id AND NOW() BETWEEN d.start_date AND d.end_date
    WHERE p.deleted = 0 AND p.category_id = {$product['category_id']} AND p.id <> $productId
    ORDER BY p.updated_at DESC
    LIMIT 5
";
$relatedProducts = executeResult($relatedSql);

$bestsellerSql = "
    SELECT p.*, c.name AS category_name,
           d.discount_type, d.value,
           CASE 
               WHEN d.discount_type = 'percent' THEN ROUND(p.price * (1 - d.value / 100), 0)
               WHEN d.discount_type = 'amount' THEN GREATEST(p.price - d.value, 0)
               ELSE p.price
           END AS discounted_price,
           SUM(od.num) AS total_sold
    FROM product p
    LEFT JOIN order_details od ON p.id = od.product_id
    LEFT JOIN category c ON p.category_id = c.id
    LEFT JOIN product_discount d ON p.id = d.product_id AND NOW() BETWEEN d.start_date AND d.end_date
    WHERE p.deleted = 0
    GROUP BY p.id
    ORDER BY total_sold DESC
    LIMIT 5
";
$bestsellerProducts = executeResult($bestsellerSql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<style>
    .product-image-feature {
        width: 100%;
        height: auto;
        object-fit: cover;
    }
</style>

<body>
    <?php
    require_once('../layout/header.php');
    ?>
    <div class="container-02" style="margin-top:70px;">
        <div class="row d-flex">
            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 order-mb-1 d-flex-wrap d-flex gallery-product-template">
                <div class="product-gallery hidden-xs">
                    <?php if ($discountPercent > 0): ?>
                        <span class="pro-sale-detail"> <span class="sale">-<?= $discountPercent ?>%</span></span>
                    <?php endif ?>
                    <img class="product-image-feature dt-width-100 lazyload-feature" width="600" height="600" src="../<?= $product['thumbnail'] ?>">
                </div>
            </div>
            <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12 order-mb-2">
                <div class="product-content">
                    <div class="pro-content-head clearfix">
                        <h1><?= $product['title'] ?></h1>
                        <div class="d-flex product-info">
                            <span class="line-info">|</span>
                            <div class="pro-type"><span class="title"> Loại: </span><a><?= $product['category_name'] ?></a></div>
                            <span class="line-info">|</span>
                            <div class="pro-sku ProductSku"><span class="title">Hãng:</span> <a><?= $product['brand_name'] ?></a></div>
                        </div>
                        <div id="pro-price">
                            <span class="price-now">
                                <?= number_format($product['discounted_price'], 0, ',', '.') ?>₫
                            </span>
                            <?php if ($product['discounted_price'] < $product['price']) : ?>
                                <span class="price-compare"><del><?= number_format($product['price'], 0, ',', '.') ?>₫</del></span>
                            <?php endif; ?>
                            <div class="available-pro"><span class="title"> Tình trạng: </span><span class="status">Còn hàng</span></div>
                        </div>
                    </div>
                    <div class="bg-countdown-product">
                        <div class="count-down-index d-flex d-flex-center">
                            <span>Kết thúc trong: </span>
                            <ul class="countdown-deal d-flex d-flex-center js-center" data-countdown="Jul 10, 2022 00:00:00">
                                <li><span class="days">02</span></li>
                                <li><span class="hours">14</span></li>
                                <li><span class="minutes">37</span></li>
                                <li><span class="seconds">56</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <form id="add-item-form" action="/cart/add" method="post" class="variants clearfix">
                    <div class="select hidden">
                        <div class="selector-wrapper"><label>Kích thước</label><span class="custom-dropdown custom-dropdown--white">
                                <select class="single-option-selector custom-dropdown__select custom-dropdown__select--white" data-option="option1" id="product-select-option-0">
                                    <option value="12">12</option>
                                </select></span></div><select id="product-select" name="id" style="display: none;">
                            <option value="1112572054" data-available="true" data-variant="12">12</option>
                        </select>
                    </div>
                    <div class="select-swatch clearfix">
                        <div id="variant-swatch-0" class="swatch clearfix" data-option="option1" data-option-index="0">
                            <div class="header">Kích thước:</div>
                            <div class="select-swap">
                                <?php foreach ($variants as $index => $variant): ?>
                                    <div data-value="<?= $variant['size'] ?>"
                                        class="n-sd swatch-element <?= $variant['size'] ?>">
                                        <input class="variant-radio"
                                            id="swatch-0-<?= $variant['variant_id'] ?>"
                                            type="radio"
                                            name="variant_id"
                                            value="<?= $variant['variant_id'] ?>"
                                            <?= $index === 0 ? 'checked' : '' ?>>
                                        <label for="swatch-0-<?= $variant['variant_id'] ?>" class="sd">
                                            <span><?= $variant['size'] ?></span>
                                            <img class="img-check" width="14" height="14"
                                                src="//theme.hstatic.net/200000037626/1000890916/14/select-pro.png?v=147"
                                                style="<?= $index === 0 ? '' : 'display: none;' ?>">
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 selector-actions d-flex d-flex-center pd-top-10">
                            <div class="quantity-area">
                                <input type="button" value="-" onclick="addMoreCart(-1)" class="qty-btn qtyminus">
                                <input type="number" id="quantity" name="num" step="1" value="1" min="1" class="quantity-selector" onchange="fixCartNum()">
                                <input type="button" value="+" onclick="addMoreCart(1)" class="qty-btn qtyplus">
                            </div>
                            <div class="wrap-addcart">
                                <div class="row-flex">
                                    <button type="button"
                                        onclick="addCart(<?= $product['id'] ?>, $('[name=num]').val(), $('input[name=variant_id]:checked').val())"
                                        id="add-to-cart"
                                        class="button button_detail"
                                        name="add">
                                        <span>Thêm vào giỏ</span>
                                    </button>
                                    <button type="button"
                                        onclick="buyNow(<?= $product['id'] ?>, $('[name=num]').val(), $('input[name=variant_id]:checked').val())"
                                        id="buy-now"
                                        class="button button_detail"
                                        name="add">
                                        <span>Mua ngay</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 location-store pd-top-10" style="display: none;"></div>
                    </div>
                </form>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 order-mb-4 mg-top-30  mg-top-0-mb">
                <div class="product-description-tab">
                    <div class="scroll-nav-tab scroll-tab hidden-xs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a class="show" href="javascript:void(0)" data-href="#pro-tab-1" data-toggle="tab" role="tab" aria-selected="true">
                                    <span>Mô tả</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane content-entry active" id="pro-tab-1" role="tabpanel">
                        <div class="tab-mobile visible-xs">
                            Mô tả
                        </div>
                        <div class="more-description">
                            <strong><?= $product['title'] ?></strong>
                            <ul>
                                <li><?= $product['description'] ?></li><img data-src="//file.hstatic.net/200000037626/file/nike-mens__2__fce53d17930e447e9ada5a03812678c9_grande.png" class="dt-width-auto lazyloaded" width="600" height="600" src="//file.hstatic.net/200000037626/file/nike-mens__2__fce53d17930e447e9ada5a03812678c9_grande.png"></p>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>
    <div class="top-title">
        <h2 class="title-section">
            <span>SẢN PHẨM LIÊN QUAN</span>
        </h2>
        <!-- <h2>----////----</h2> -->
        <p></p>
    </div>
    <div id="wrapper">
        <ul class="products">
            <?php
            foreach ($relatedProducts as $item) {
                echo renderProductItem($item, true);
            }
            ?>
        </ul>
    </div>
    <div class="top-title">
        <h2 class="title-section">
            <span>SẢN PHẨM BÁN CHẠY</span>
        </h2>
        <!-- <h2>----////----</h2> -->
        <p></p>
    </div>
    <div id="wrapper">
        <ul class="products">
            <?php
            foreach ($bestsellerProducts as $item) {
                echo renderProductItem($item, true);
            }
            ?>
        </ul>
    </div>
    <?php
    require_once('../layout/footer.php');
    function renderProductItem($item, $showSaleTag = false)
    {
        $originalPrice = $item['price'];
        $discountedPrice = $item['discounted_price'] ?? $originalPrice;
        $discountPercent = ($originalPrice > 0 && $discountedPrice < $originalPrice)
            ? round(100 - ($discountedPrice / $originalPrice * 100)) : 0;

        ob_start(); ?>
        <li>
            <div class="product-item">
                <div class="product-top">
                    <a href="detail.php?id=<?= $item['id'] ?>" class="product-thumb">
                        <img class="dt-width-100" src="../<?= $item['thumbnail'] ?>" alt="" width="260" height="260">
                        <img class="dt-width-100 img-hover" src="../<?= $item['thumbnail_2'] ?>" alt="" width="260" height="260">
                    </a>
                    <a class="buy-now">
                        <div class="product-icon-add"><button onclick="location.href='detail.php?id=<?= $item['id'] ?>'">Thêm vào giỏ</button></div>
                        <div class="product-icon-watch"><button onclick="location.href='detail.php?id=<?= $item['id'] ?>'"> Xem nhanh</button></div>
                    </a>
                    <?php if ($showSaleTag && $discountPercent > 0): ?>
                        <div class="product-sale"><span>-<?= $discountPercent ?>%</span></div>
                    <?php endif ?>
                    <div class="product-wishlist">
                        <button class="wishlist-loop" data-toggle="tooltip" title="Yêu thích" onclick="toggleWishlist(<?= $item['id'] ?>)">
                            <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích">
                        </button>
                    </div>
                </div>
                <div class="product-infor">
                    <h3 class="pro-name">
                        <a href="detail.php?id=<?= $item['id'] ?>" class="product-name"><?= $item['title'] ?></a>
                    </h3>
                    <div class="product-price">
                        <p class="pro-price">
                            <span><?= number_format($discountedPrice) ?>đ</span>
                            <?php if ($discountedPrice < $originalPrice): ?>
                                <del class="compare-price"><?= number_format($originalPrice) ?>đ</del>
                            <?php endif ?>
                        </p>
                    </div>
                </div>
            </div>
        </li>
    <?php return ob_get_clean();
    }
    ?>
    <script type="text/javascript">
        function addMoreCart(delta) {
            num = parseInt($('[name=num]').val())
            num += delta
            if (num < 1) num = 1;
            $('[name=num]').val(num)
        }

        function fixCartNum() {
            $('[name=num]').val(Math.abs($('[name=num]').val()))

        }

        document.querySelectorAll('input[name="variant_id"]').forEach(radio => {
            radio.addEventListener('change', () => {
                document.querySelectorAll('.img-check').forEach(img => img.style.display = 'none');
                const checkedId = radio.id;
                const label = document.querySelector(`label[for="${checkedId}"]`);
                if (label) {
                    const img = label.querySelector('.img-check');
                    if (img) img.style.display = 'inline';
                }
            });
        });

        
    </script>
    <!-- js wishlist -->
<script>
function toggleWishlist(productId) {
    // Kiểm tra xem sản phẩm đã có trong wishlist chưa
    checkWishlistStatus(productId).then(inWishlist => {
        if (inWishlist) {
            // Nếu đã có thì xóa
            removeFromWishlist(productId);
        } else {
            // Nếu chưa có thì thêm
            addToWishlist(productId);
        }
    });
}

function addToWishlist(productId) {
    fetch('../api/ajax_request.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ 
            action: 'add_to_wishlist', 
            id: productId 
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            // Cập nhật UI button
            updateWishlistButton(productId, true);
            // Cập nhật số lượng trong header
            updateWishlistCount();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra, vui lòng thử lại!');
    });
}

function removeFromWishlist(productId) {
    if (!confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi danh sách yêu thích?')) {
        return;
    }
    
    fetch('../api/ajax_request.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ 
            action: 'remove_from_wishlist', 
            id: productId 
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            // Cập nhật UI button
            updateWishlistButton(productId, false);
            // Cập nhật số lượng trong header
            updateWishlistCount();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra, vui lòng thử lại!');
    });
}

function checkWishlistStatus(productId) {
    // Kiểm tra trong session hoặc gửi request để check
    return fetch('../api/ajax_request.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ 
            action: 'check_wishlist_status', 
            id: productId 
        })
    })
    .then(response => response.json())
    .then(data => data.in_wishlist)
    .catch(error => {
        console.error('Error:', error);
        return false;
    });
}

function updateWishlistButton(productId, inWishlist) {
    const button = document.querySelector(`[onclick="toggleWishlist(${productId})"]`);
    if (button) {
        const img = button.querySelector('img');
        if (inWishlist) {
            // Đổi màu hoặc style khi đã thêm vào wishlist
            button.style.backgroundColor = '#ff6b6b';
            button.style.color = 'white';
            img.style.filter = 'brightness(0) invert(1)'; // Làm trắng icon
        } else {
            // Trở về style ban đầu
            button.style.backgroundColor = '';
            button.style.color = '';
            img.style.filter = '';
        }
    }
}

function updateWishlistCount() {
    fetch('../api/ajax_request.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ action: 'get_wishlist_count' })
    })
    .then(response => response.json())
    .then(data => {
        const countElement = document.getElementById('wishlist-count');
        if (countElement) {
            countElement.textContent = data.count;
        }
    })
    .catch(error => console.error('Error updating wishlist count:', error));
}
// CSS cho button wishlist
const wishlistStyles = `
.wishlist-loop {
    border: none;
    background: transparent;
    cursor: pointer;
    padding: 8px;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.wishlist-loop:hover {
    background-color: #f0f0f0;
}

.wishlist-loop.active {
    background-color: #ff6b6b;
    color: white;
}

.wishlist-loop.active img {
    filter: brightness(0) invert(1);
}
`;

// Thêm CSS vào head
const styleSheet = document.createElement("style");
styleSheet.textContent = wishlistStyles;
document.head.appendChild(styleSheet);



</script>

</body>

</html>
