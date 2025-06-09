<?php
session_start();
require_once('utility.php');
require_once('../database/dbhelper.php');
require_once('../layout/header.php');

function getProductsWithDiscount($limit = 5, $offset = 0, $orderBy = 'RAND()') {
    $sql = "
        SELECT p.*, c.name AS category_name,
               d.discount_type, d.value,
               CASE
                   WHEN d.discount_type = 'percent' THEN ROUND(p.price * (1 - d.value / 100), 0)
                   WHEN d.discount_type = 'amount' THEN GREATEST(p.price - d.value, 0)
                   ELSE p.price
               END AS discounted_price
        FROM product p
        LEFT JOIN category c ON p.category_id = c.id
        LEFT JOIN product_discount d ON p.id = d.product_id 
            AND NOW() BETWEEN d.start_date AND d.end_date
        WHERE p.deleted = 0
        ORDER BY $orderBy
        LIMIT $limit OFFSET $offset
    ";
    return executeResult($sql);
}

$hotdealItems      = getProductsWithDiscount(5);
$hotdealItems_1    = getProductsWithDiscount(5);

$bestsellerItems   = getProductsWithDiscount(5);
$bestsellerItems_1 = getProductsWithDiscount(5);

$lastestItems      = getProductsWithDiscount(5, 0, 'p.updated_at ASC');
$lastestItems_2    = getProductsWithDiscount(5, 5, 'p.updated_at ASC');
?>

<!-- BANNER -->
<div id="demo" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
    </ul>
    <div class="carousel-inner">
        <div class="carousel-item active"><img class="img-banner" src="https://file.hstatic.net/200000037626/file/2banner-trang-chu_1920x890.png"></div>
        <div class="carousel-item"><img class="img-banner" src="https://file.hstatic.net/200000037626/file/banner-san-pham_1440x400.png"></div>
        <div class="carousel-item"><img class="img-banner" src="../assets/images/banner-1.png"></div>
    </div>
    <a class="carousel-control-prev" href="#demo" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
    <a class="carousel-control-next" href="#demo" data-slide="next"><span class="carousel-control-next-icon"></span></a>
</div>

<!-- HOT DEAL -->
<div class="top-title"><h2 class="title-section"><span>HOT DEAL &amp; SALE</span></h2></div>
<div id="wrapper">
    <ul class="products">
        <?php foreach ($hotdealItems as $item): ?>
            <?=renderProductItem($item, true)?>
        <?php endforeach ?>
    </ul>
    <ul class="products">
        <?php foreach ($hotdealItems_1 as $item): ?>
            <?=renderProductItem($item, true)?>
        <?php endforeach ?>
    </ul>
</div>

<!-- BEST SELLER -->
<div class="top-title"><h2 class="title-section"><span>BEST SELLER</span></h2></div>
<div id="wrapper">
    <ul class="products">
        <?php foreach ($bestsellerItems as $item): ?>
            <?=renderProductItem($item, true)?>
        <?php endforeach ?>
    </ul>
    <ul class="products">
        <?php foreach ($bestsellerItems_1 as $item): ?>
            <?=renderProductItem($item, true)?>
        <?php endforeach ?>
    </ul>
</div>

<!-- NEW ARRIVAL -->
<div class="top-title"><h2 class="title-section"><span>NEW ARRIVAL</span></h2></div>
<div id="wrapper">
    <ul class="products">
        <?php foreach ($lastestItems as $item): ?>
            <?=renderProductItem($item, true)?>
        <?php endforeach ?>
    </ul>
    <ul class="products">
        <?php foreach ($lastestItems_2 as $item): ?>
            <?=renderProductItem($item, true)?>
        <?php endforeach ?>
    </ul>
</div>

<!-- INSTAGRAM -->
<section id="section-instagram" class="pd-top-30">
    <div class="top-title-instar">
        <h2 class="title-section d-flex-center js-center d-flex"><span>FOLLOW US ON INSTAGRAM @hudoshop.vn</span></h2>
    </div>
    <div class="box-img">
        <div class="img-bottom"><img src="../assets/images/bongro-4.png" width="300" height="300"></div>
        <div class="img-bottom"><img src="../assets/images/bongro-1.png" width="300" height="300"></div>
        <div class="img-bottom"><img src="../assets/images/bongro-2.png" width="300" height="300"></div>
        <div class="img-bottom"><img src="../assets/images/bongro-1.png" width="300" height="300"></div>
        <div class="img-bottom"><img src="../assets/images/bongro-3.png" width="300" height="300"></div>
        <div class="img-bottom"><img src="../assets/images/bongro-4.png" width="300" height="300"></div>
    </div>
</section>

<?php require_once('../layout/footer.php'); ?>
</body>
</html>

<?php

function renderProductItem($item, $showSaleTag = false) {
    $originalPrice = $item['price'];
    $discountedPrice = $item['discounted_price'] ?? $originalPrice;
    $discountPercent = ($originalPrice > 0 && $discountedPrice < $originalPrice)
        ? round(100 - ($discountedPrice / $originalPrice * 100)) : 0;

    ob_start(); ?>
    <li>
        <div class="product-item">
            <div class="product-top">
                <a href="detail.php?id=<?=$item['id']?>" class="product-thumb">
                    <img class="dt-width-100" src="../<?=$item['thumbnail']?>" alt="" width="260" height="260">
                    <img class="dt-width-100 img-hover" src="../<?=$item['thumbnail_2']?>" alt="" width="260" height="260">
                </a>
                <a class="buy-now">
                    <div class="product-icon-add"><button onclick="location.href='detail.php?id=<?= $item['id'] ?>'">Thêm vào giỏ</button></div>
                    <div class="product-icon-watch"><button onclick="location.href='detail.php?id=<?= $item['id'] ?>'"> Xem nhanh</button></div>
                </a>
                <?php if ($showSaleTag && $discountPercent > 0): ?>
                    <div class="product-sale"><span>-<?=$discountPercent?>%</span></div>
                <?php endif ?>
                <div class="product-wishlist">
                    <button class="wishlist-loop" data-toggle="tooltip" title="Yêu thích">
                        <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích">
                    </button>
                </div>
            </div>
            <div class="product-infor">
                <h3 class="pro-name">
                    <a href="detail.php?id=<?=$item['id']?>" class="product-name"><?=$item['title']?></a>
                </h3>
                <div class="product-price">
                    <p class="pro-price">
                        <span><?=number_format($discountedPrice)?>đ</span>
                        <?php if ($discountedPrice < $originalPrice): ?>
                            <del class="compare-price"><?=number_format($originalPrice)?>đ</del>
                        <?php endif ?>
                    </p>
                </div>
            </div>
        </div>
    </li>
    <?php return ob_get_clean();
}

?>
