<?php
session_start();
require_once('utility.php');
require_once('../database/dbhelper.php');
require_once('../layout/header.php');

// Lấy ngày hiện tại (08:45 PM +07, 02/06/2025)
$currentDate = date('Y-m-d H:i:s');

// HOT DEAL & SALE
$sql = "SELECT Product.*, Category.name AS category_name,
        COALESCE(
            CASE 
                WHEN product_discount.discount_type = 'amount' AND '$currentDate' BETWEEN product_discount.start_date AND product_discount.end_date 
                THEN product_discount.value 
                ELSE 0 
            END, 0) AS discount
        FROM Product 
        LEFT JOIN Category ON Product.category_id = Category.id 
        LEFT JOIN product_discount ON Product.id = product_discount.product_id 
        WHERE Product.deleted = 0 
        ORDER BY RAND() 
        LIMIT 10;";
$hotdealItems = executeResult($sql);
$hotdealItems_1 = array_slice($hotdealItems, 5, 5);
$hotdealItems = array_slice($hotdealItems, 0, 5);

// BEST SELLER
$sql = "SELECT Product.*, Category.name AS category_name,
        COALESCE(
            CASE 
                WHEN product_discount.discount_type = 'amount' AND '$currentDate' BETWEEN product_discount.start_date AND product_discount.end_date 
                THEN product_discount.value 
                ELSE 0 
            END, 0) AS discount
        FROM Product 
        LEFT JOIN Category ON Product.category_id = Category.id 
        LEFT JOIN product_discount ON Product.id = product_discount.product_id 
        WHERE Product.deleted = 0 
        ORDER BY RAND() 
        LIMIT 10;";
$bestsellerItems = executeResult($sql);
$bestsellerItems_1 = array_slice($bestsellerItems, 5, 5);
$bestsellerItems = array_slice($bestsellerItems, 0, 5);

// NEW ARRIVAL
$sql = "SELECT Product.*, Category.name AS category_name,
        COALESCE(
            CASE 
                WHEN product_discount.discount_type = 'amount' AND '$currentDate' BETWEEN product_discount.start_date AND product_discount.end_date 
                THEN product_discount.value 
                ELSE 0 
            END, 0) AS discount
        FROM Product 
        LEFT JOIN Category ON Product.category_id = Category.id 
        LEFT JOIN product_discount ON Product.id = product_discount.product_id 
        WHERE Product.deleted = 0 
        ORDER BY Product.updated_at ASC 
        LIMIT 10;";
$lastestItems = executeResult($sql);
$lastestItems_2 = array_slice($lastestItems, 5, 5);
$lastestItems = array_slice($lastestItems, 0, 5);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="../utils/index.css">
</head>
<body>
    <!-- --BANNER-- -->
    <div id="demo" class="carousel slide" data-ride="carousel">
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="img-banner" src="https://file.hstatic.net/200000037626/file/2banner-trang-chu_1920x890.png" alt="">
            </div>
            <div class="carousel-item">
                <img class="img-banner" src="https://file.hstatic.net/200000037626/file/banner-san-pham_1440x400.png" alt="">
            </div>
            <div class="carousel-item">
                <img class="img-banner" src="../assets/images/banner-1.png" alt="">
            </div>
        </div>
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
    <!-- --BANER_STOP-- -->

    <!-- --HOT DEAL & SALE-- -->
    <div class="top-title">
        <h2 class="title-section"><span>HOT DEAL & SALE</span></h2>
        <p></p>
    </div>
    <div id="wrapper">
        <ul class="products">
            <?php foreach ($hotdealItems as $item) { ?>
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="detail.php?id=<?php echo $item['id']; ?>" class="product-thumb">
                                <img class="dt-width-100" src="../<?php echo $item['thumbnail']; ?>" alt="" width="260" height="260">
                                <img class="dt-width-100 img-hover" src="../<?php echo $item['thumbnail_2']; ?>" alt="" width="260" height="260">
                            </a>
                            <a class="buy-now">
                                <div class="product-icon-add">
                                    <button onclick="addCart(<?php echo $item['id']; ?>,1)">Thêm vào giỏ</button>
                                </div>
                                <div class="product-icon-watch">
                                    <button>Xem nhanh</button>
                                </div>
                            </a>
                            <div class="product-wishlist">
                                <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" data-toggle="tooltip" tabindex="0">
                                    <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích
                                </button>
                            </div>
                        </div>
                        <div class="product-infor">
                            <h3 class="pro-name">
                                <a href="detail.php?id=<?php echo $item['id']; ?>" class="product-name"><?php echo $item['title']; ?></a>
                            </h3>
                            <div class="product-price">
                                <p class="pro-price">
                                    <span><?php echo number_format($item['discount']); ?>đ</span>
                                    <del class="compare-price"><?php echo number_format($item['price']); ?>đ</del>
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <ul class="products">
            <?php foreach ($hotdealItems_1 as $item) { ?>
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="detail.php?id=<?php echo $item['id']; ?>" class="product-thumb">
                                <img class="dt-width-100" src="../<?php echo $item['thumbnail']; ?>" alt="" width="260" height="260">
                                <img class="dt-width-100 img-hover" src="../<?php echo $item['thumbnail_2']; ?>" alt="" width="260" height="260">
                            </a>
                            <a class="buy-now">
                                <div class="product-icon-add">
                                    <button onclick="addCart(<?php echo $item['id']; ?>,1)">Thêm vào giỏ</button>
                                </div>
                                <div class="product-icon-watch">
                                    <button>Xem nhanh</button>
                                </div>
                            </a>
                            <div class="product-wishlist">
                                <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" data-toggle="tooltip" tabindex="0">
                                    <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích
                                </button>
                            </div>
                        </div>
                        <?php
$sql = "SELECT * FROM product WHERE discount > 0 ORDER BY discount DESC LIMIT 6";
$result = mysqli_query($conn, $sql);
while ($item = mysqli_fetch_array($result)) {
    // Tính giá sau giảm
    $finalPrice = max(0, $item['price'] - $item['discount']);
    ?>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="product-card">
            <div class="product-card-img">
                <a href="product-details.php?id=<?php echo $item['id']; ?>">
                    <img src="images/<?php echo $item['image']; ?>" class="w-100" alt="">
                </a>
            </div>
            <div class="product-card-info">
                <h6 class="product-name">
                    <a href="product-details.php?id=<?php echo $item['id']; ?>">
                        <?php echo $item['name']; ?>
                    </a>
                </h6>
                <p class="pro-price">
                    <span><?php echo number_format($finalPrice); ?>đ</span>
                    <del class="compare-price"><?php echo number_format($item['price']); ?>đ</del>
                </p>
            </div>
        </div>
    </div>
    <?php
}
?>

                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>

    <!-- --BEST SELLER-- -->
    <div class="top-title">
        <h2 class="title-section"><span>BEST SELLER</span></h2>
        <p></p>
    </div>
    <div id="wrapper">
        <ul class="products">
            <?php foreach ($bestsellerItems as $item) { ?>
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="detail.php?id=<?php echo $item['id']; ?>" class="product-thumb">
                                <img class="dt-width-100" src="../<?php echo $item['thumbnail']; ?>" alt="" width="260" height="260">
                                <img class="dt-width-100 img-hover" src="../<?php echo $item['thumbnail_2']; ?>" alt="" width="260" height="260">
                            </a>
                            <a class="buy-now">
                                <div class="product-icon-add">
                                    <button onclick="addCart(<?php echo $item['id']; ?>,1)">Thêm vào giỏ</button>
                                </div>
                                <div class="product-icon-watch">
                                    <button>Xem nhanh</button>
                                </div>
                            </a>
                            <div class="product-wishlist">
                                <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" data-toggle="tooltip" tabindex="0">
                                    <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích
                                </button>
                            </div>
                        </div>
                        <div class="product-infor">
                            <h3 class="pro-name">
                                <a href="detail.php?id=<?php echo $item['id']; ?>" class="product-name"><?php echo $item['title']; ?></a>
                            </h3>
                            <div class="product-price">
                                <p class="pro-price">
                                    <span><?php echo number_format($item['discount']); ?>đ</span>
                                    <del class="compare-price"><?php echo number_format($item['price']); ?>đ</del>
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <ul class="products">
            <?php foreach ($bestsellerItems_1 as $item) { ?>
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="detail.php?id=<?php echo $item['id']; ?>" class="product-thumb">
                                <img class="dt-width-100" src="../<?php echo $item['thumbnail']; ?>" alt="" width="260" height="260">
                                <img class="dt-width-100 img-hover" src="../<?php echo $item['thumbnail_2']; ?>" alt="" width="260" height="260">
                            </a>
                            <a class="buy-now">
                                <div class="product-icon-add">
                                    <button onclick="addCart(<?php echo $item['id']; ?>,1)">Thêm vào giỏ</button>
                                </div>
                                <div class="product-icon-watch">
                                    <button>Xem nhanh</button>
                                </div>
                            </a>
                            <div class="product-wishlist">
                                <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" data-toggle="tooltip" tabindex="0">
                                    <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích
                                </button>
                            </div>
                        </div>
                        <div class="product-infor">
                            <h3 class="pro-name">
                                <a href="detail.php?id=<?php echo $item['id']; ?>" class="product-name"><?php echo $item['title']; ?></a>
                            </h3>
                            <div class="product-price">
                                <p class="pro-price">
                                    <span><?php echo number_format($item['discount']); ?>đ</span>
                                    <del class="compare-price"><?php echo number_format($item['price']); ?>đ</del>
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>

    <!-- --NEW ARRIVAL-- -->
    <div class="top-title">
        <h2 class="title-section"><span>NEW ARRIVAL</span></h2>
        <p></p>
    </div>
    <div id="wrapper">
        <ul class="products">
            <?php foreach ($lastestItems as $item) { ?>
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="detail.php?id=<?php echo $item['id']; ?>" class="product-thumb">
                                <img class="dt-width-100" src="../<?php echo $item['thumbnail']; ?>" alt="" width="260" height="260">
                                <img class="dt-width-100 img-hover" src="../<?php echo $item['thumbnail_2']; ?>" alt="" width="260" height="260">
                            </a>
                            <a class="buy-now">
                                <div class="product-icon-add">
                                    <button onclick="addCart(<?php echo $item['id']; ?>,1)">Thêm vào giỏ</button>
                                </div>
                                <div class="product-icon-watch">
                                    <button>Xem nhanh</button>
                                </div>
                            </a>
                            <div class="product-sale"><span>-40%</span></div>
                            <div class="product-wishlist">
                                <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" data-toggle="tooltip" tabindex="0">
                                    <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích
                                </button>
                            </div>
                        </div>
                        <div class="product-infor">
                            <h3 class="pro-name">
                                <a href="detail.php?id=<?php echo $item['id']; ?>" class="product-name"><?php echo $item['title']; ?></a>
                            </h3>
                            <div class="product-price">
                                <p class="pro-price">
                                    <span><?php echo number_format($item['discount']); ?>đ</span>
                                    <del class="compare-price"><?php echo number_format($item['price']); ?>đ</del>
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <ul class="products">
            <?php foreach ($lastestItems_2 as $item) { ?>
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="detail.php?id=<?php echo $item['id']; ?>" class="product-thumb">
                                <img class="dt-width-100" src="../<?php echo $item['thumbnail']; ?>" alt="" width="260" height="260">
                                <img class="dt-width-100 img-hover" src="../<?php echo $item['thumbnail_2']; ?>" alt="" width="260" height="260">
                            </a>
                            <a class="buy-now">
                                <div class="product-icon-add">
                                    <button onclick="addCart(<?php echo $item['id']; ?>,1)">Thêm vào giỏ</button>
                                </div>
                                <div class="product-icon-watch">
                                    <button>Xem nhanh</button>
                                </div>
                            </a>
                            <div class="product-sale"><span>-40%</span></div>
                            <div class="product-wishlist">
                                <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" data-toggle="tooltip" tabindex="0">
                                    <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích
                                </button>
                            </div>
                        </div>
                        <div class="product-infor">
                            <h3 class="pro-name">
                                <a href="detail.php?id=<?php echo $item['id']; ?>" class="product-name"><?php echo $item['title']; ?></a>
                            </h3>
                            <div class="product-price">
                                <p class="pro-price">
                                    <span><?php echo number_format($item['discount']); ?>đ</span>
                                    <del class="compare-price"><?php echo number_format($item['price']); ?>đ</del>
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>

    <!-- --INSTAGRAM-- -->
    <section id="section-instagram" class="pd-top-30" data-include="section-instagram">
        <div class="top-title-instar">
            <h2 class="title-section d-flex-center js-center d-flex">
                <span>FOLLOW US ON INSTAGRAM @hudoshop.vn</span>
            </h2>
        </div>
        <div class="box-img">   
            <div class="img-bottom">
                <img src="../assets/images/bongro-4.png" width="300px" height="300px">
            </div>
            <div class="img-bottom">
                <img src="../assets/images/bongro-1.png" width="300px" height="300px">
            </div>
            <div class="img-bottom">
                <img src="../assets/images/bongro-2.png" width="300px" height="300px">
            </div>
            <div class="img-bottom">
                <img src="../assets/images/bongro-1.png" width="300px" height="300px">
            </div>  
            <div class="img-bottom">
                <img src="../assets/images/bongro-3.png" width="300px" height="300px">
            </div>
            <div class="img-bottom">
                <img src="../assets/images/bongro-4.png" width="300px" height="300px">
            </div>
        </div>
    </section>

    <?php require_once('../layout/footer.php'); ?>
</body>
</html>