<?php
    session_start();
    require_once('utility.php');
    require_once('../database/dbhelper.php');
    require_once('../layout/header.php');
    $sql ="select Product.*, Category.name AS category_name 
    FROM Product 
    LEFT JOIN Category ON Product.category_id = Category.id 
    WHERE Product.deleted = 0 
    ORDER BY RAND() 
    LIMIT 5; ";
    $hotdealItems =executeResult($sql);  
    $sql ="select Product.*, Category.name AS category_name 
    FROM Product 
    LEFT JOIN Category ON Product.category_id = Category.id 
    WHERE Product.deleted = 0 
    ORDER BY RAND() 
    LIMIT 5; ";
    $hotdealItems_1 =executeResult($sql);  
?>
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
            <img  class="img-banner" src="https://file.hstatic.net/200000037626/file/banner-san-pham_1440x400.png" alt="">
            </div>
            <div class="carousel-item">
            <img class="img-banner" src="../assets/images/banner-1.png" alt=" ">
            </div>
        </div>
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
     <!-- -- BANER_STOP -- -->
		<div class="top-title">
			<h2 class="title-section">
				<span>HOT DEAL &amp; SALE</span>
			</h2>
            <p></p>
		</div>

    <!-- --DANH MUC SAN PHAM-- -->
        <div id="wrapper">
            <ul class="products">
                <!-- SP1 -->
                 <?php
                    foreach($hotdealItems as $item){    
                        echo' <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../'.$item['thumbnail'].'" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../'.$item['thumbnail_2'].'" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>                                                                  
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <div class="product-sale"><span>-40%</span></div>
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" 
                                        data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>
                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a href=""class="product-name">'.$item['title'].'</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>'.number_format($item['discount']).'</span><del class="compare-price">'.$item['price'].'</del></p></div>
                                </div>
                            </div>
                        </li>';
                    }   
                    ?>
                    </ul>
                    <ul class="products">
                 <?php
                    foreach($hotdealItems_1 as $item){    
                        echo' <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../'.$item['thumbnail'].'" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../'.$item['thumbnail_2'].'" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>                                                                  
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <div class="product-sale"><span>-40%</span></div>
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" 
                                        data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>
                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a href=""class="product-name">'.$item['title'].'</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>'.number_format($item['discount']).'</span><del class="compare-price">'.$item['price'].'</del></p></div>
                                </div>
                            </div>
                        </li>';
                    }   
                    ?>
                    </ul>
            </div>
    <!-- --STOP danh muc san pham-- -->

    <!-- --BANNER2-- -->
    <div class="top-title">
			<h2 class="title-section">
				<span>BEST SELLER</span>
			</h2>
            <!-- <h2>----////----</h2> -->
             <p></p>
	</div>
<?php
    $sql ="select Product.*, Category.name AS category_name 
            FROM Product 
            LEFT JOIN Category ON Product.category_id = Category.id 
            WHERE Product.deleted = 0 
            ORDER BY RAND() 
            LIMIT 5; ";
    $bestsellerItems =executeResult($sql);  
    $sql ="select Product.*, Category.name AS category_name 
    FROM Product 
    LEFT JOIN Category ON Product.category_id = Category.id 
    WHERE Product.deleted = 0 
    ORDER BY RAND() 
    LIMIT 5; ";
    $bestsellerItems_1 =executeResult($sql);  
?>
    <!-- --BEST SELLER -- -->
    <div id="wrapper">
            <ul class="products">
                 <?php
                    foreach($bestsellerItems as $item){    
                        echo '<li>
                                <div class="product-item">
                                    <div class="product-top">
                                        <a href="" class="product-thumb">
                                            <img class="dt-width-100" src="../'.$item['thumbnail'].'" alt="" width="260" height="260">
                                            <img class="dt-width-100 img-hover" src="../'.$item['thumbnail_2'].'" alt="" width="260" height="260">
                                        </a>
                                        <a class="buy-now">
                                            <div class="product-icon-add">
                                                <button>Thêm vào giỏ</button>
                                            </div>                                                                  
                                            <div class="product-icon-watch">
                                                <button>Xem nhanh</button>
                                            </div>
                                        </a>
                                        <div class="product-sale"><span>-40%</span></div>
                                        <div class="product-wishlist"> 
                                            <button data-original-title="Yêu thích" class="wishlist-loop" 
                                                data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" data-toggle="tooltip" tabindex="0"> 
                                                <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> 
                                                Yêu thích 
                                            </button>
                                        </div>
                                    </div>
                                    <div class="product-infor">
                                        <h3 class="pro-name">
                                            <a href="" class="product-name">'.$item['title'].'</a>
                                        </h3>
                                        <div class="product-price">
                                            <p class="pro-price"> 
                                                <span>'.number_format($item['discount']).'</span>
                                                <del class="compare-price">'.$item['price'].'</del>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>';
                    }
                    ?>
                    </ul>
                    <ul class="products">
                    <?php
                    foreach($bestsellerItems_1 as $item){    
                        echo' <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../'.$item['thumbnail'].'" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../'.$item['thumbnail_2'].'" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>                                                                  
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <div class="product-sale"><span>-40%</span></div>
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" 
                                        data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>
                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a href=""class="product-name">'.$item['title'].'</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>'.number_format($item['discount']).'</span><del class="compare-price">'.$item['price'].'</del></p></div>
                                </div>
                            </div>
                        </li>';
                    }   
                    ?>
                    </ul>
            </div>
    <div class="top-title">
			<h2 class="title-section">
				<span>NEW ARRIVAL</span>
			</h2>
            <!-- <h2>----////----</h2> -->
            <p></p>
	    </div>
<?php
    $sql ="select Product.*, Category.name as category_name from
            Product left join Category on Product.category_id = Category.id WHERE Product.deleted = 0
            order by Product.updated_at ASC limit 5 ";
    $lastestItems =executeResult($sql); 
?>
        <!-- --New Arrival-- -->
        <div id="wrapper">
            <ul class="products">
                <!-- SP1 -->
                 <?php
                    foreach($lastestItems as $item){    
                        echo' <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../'.$item['thumbnail'].'" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../'.$item['thumbnail_2'].'" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>                                                                  
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <div class="product-sale"><span>-40%</span></div>
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" 
                                        data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>
                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a href=""class="product-name">'.$item['title'].'</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>'.number_format($item['discount']).'</span><del class="compare-price">'.$item['price'].'</del></p></div>
                                </div>
                            </div>
                        </li>';
                    }   
                    ?>
                    </ul>
                    <ul class="products">
                 <?php
                    foreach($lastestItems as $item){    
                        echo' <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../'.$item['thumbnail'].'" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../'.$item['thumbnail_2'].'" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>                                                                  
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <div class="product-sale"><span>-40%</span></div>
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" 
                                        data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>
                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a href=""class="product-name">'.$item['title'].'</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>'.number_format($item['discount']).'</span><del class="compare-price">'.$item['price'].'</del></p></div>
                                </div>
                            </div>
                        </li>';
                    }   
                    ?>
                    </ul>
            </div>
<section id="section-instagram" class="pd-top-30" data-include="section-instagram">
	<div class="top-title-instar">
		<h2 class="title-section d-flex-center js-center d-flex">
			<span>FOLLOW US ON INSTAGRAM @hudoshop.vn</span>
		</h2>
	</div>
    <div class="box-img">
        <div class="img-bottom">
            <img src="../assets/images/bongro-1.png" width="300px" height="300px" >
        </div>
        <div class="img-bottom">
            <img src="../assets/images/bongro-2.png" width="300px" height="300px">
        </div>
        <div class="img-bottom">
            <img src="../assets/images/bongro-3.png" width="300px" height="300px">
        </div>
        <div class="img-bottom">
            <img src="../assets/images/bongro-4.png" width="300px" height="300px">
        </div>
        <div class="img-bottom">
            <img src="../assets/images/bongro-7.png" width="300px" height="300px">
        </div> 
    </div>
</section>
    <?php
        require_once('../layout/footer.php');
    ?>
</body>
</html>