<?php
    session_start();
    require_once('utility.php');
    require_once('../database/dbhelper.php');
    require_once('../layout/header.php');
    $sql ="select Product.*, Category.name as category_name from
            Product left join Category on Product.category_id = Category.id WHERE Product.deleted = 0
            order by Product.updated_at ASC limit 5 ";
    $lastestItems =executeResult($sql);
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
    <!-- --STOP danh muc san pham-- -->

    <!-- --BANNER2-- -->
    <div class="top-title">
			<h2 class="title-section">
				<span>BEST SELLER</span>
			</h2>
            <!-- <h2>----////----</h2> -->
             <p></p>
	</div>

    <!-- --BEST SELLER -- -->
    <div id="demo" class="carousel slide" data-ride="carousel">
        <!-- SP1 -->
                    <ul class="products">
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Peak/Peak-PEAK TAICHI CAVE SANDALS-02.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Peak/Peak-PEAK TAICHI CAVE SANDALS-03.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <!-- <div class="product-sale"><span>-20%</span></div> -->
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" 
                                        data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>
                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a href=""class="product-name">PEAK TAICHI CAVE SANDALS</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>1,999,000₫</span></p></div>
                                </div>
                            </div>
                        </li>
                        <!-- SP2 -->
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Peak/Peak-PEAK MONSTER 8-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Peak/Peak-PEAK MONSTER 8-02.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <div class="product-sale"><span>-12%</span></div>
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>
                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a href="" class="product-name">PEAK MONSTER 8</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>5,990,000₫</span><del class="compare-price">6,390,000₫</del></p></div>
                                </div>
                            </div>
                        </li>
                        <!-- SP3 -->
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Sock/Sock-VỚ NIKE ELITE-02.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Sock/Sock-VỚ NIKE ELITE-01.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <!-- <div class="product-sale"><span>-45%</span></div> -->
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>

                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a  href="" class="product-name">VỚ NIKE ELITE</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>50,000₫</span></p></div>
                                </div>
                            </div>
                        </li>
                        <!-- SP4 -->
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Aobongro/Ao-CURRY GOLDEN STATE WARRIORS CITY EDITION JERSEY-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Aobongro/Ao-CURRY GOLDEN STATE WARRIORS CITY EDITION JERSEY-02.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <div class="product-sale"><span>-35%</span></div>
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>

                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a  href="" class="product-name">CURRY GOLDEN STATE WARRIORS CITY EDITION JERSEY</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>650,000₫</span><del class="compare-price">990,000₫</del></p></div>
                                </div>
                            </div>
                        </li>
                        <!-- SP5 -->
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Banh/Banh-BANH LI-NING WADE-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Banh/Banh-BANH LI-NING WADE-02.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <div class="product-sale"><span>-10%</span></div>
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>

                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a  href="" class="product-name">BANH LI-NING WADE</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>500,000₫</span><del class="compare-price">590,000₫</del></p></div>
                                </div>
                            </div>
                        </li>
                        
                    </ul>
                    <!-- SP6 -->
                    <ul class="products">
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Balo/Balo-BALO NIKE SWOOSH-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Balo/Balo-BALO NIKE SWOOSH-04.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <div class="product-sale"><span>-20%</span></div>
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" 
                                        data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>
                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a href=""class="product-name">BALO NIKE SWOOSH</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>1,272,000₫</span><del class="compare-price">1,590,000₫</del></p></div>
                                </div>
                            </div>
                        </li>
                        <!-- SP7 -->
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Nike/Nike-NIKE GT CUT 3-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Nike/Nike-NIKE GT CUT 3-02.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <div class="product-sale"><span>-12%</span></div>
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>
                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a href="" class="product-name">NIKE GT CUT 3</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>5,990,000₫</span><del class="compare-price">6,390,000₫</del></p></div>
                                </div>
                            </div>
                        </li>
                        <!-- SP7 -->
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Nike/NIKE-NIKE DUNK LOW-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Nike/NIKE-NIKE DUNK LOW-02.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <div class="product-sale"><span>-5%</span></div>
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>

                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a  href="" class="product-name">NIKE DUNK LOW</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>3,500,000₫</span><del class="compare-price">3,990,000₫</del></p></div>
                                </div>
                            </div>
                        </li>
                        <!-- SP8 -->
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Bang/Băng-BĂNG GỐI HỖ TRỢ CHẤN THƯƠNG GOODFIT-01.webp" atl="" width="260" height="260">
                                         <img class="dt-width-100 img-hover" src="../assets/images/Bang/Băng-BĂNG GỐI HỖ TRỢ CHẤN THƯƠNG GOODFIT-02.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <!-- <div class="product-sale"><span>-35%</span></div> -->
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>

                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a  href="" class="product-name">BĂNG GỐI HỖ TRỢ CHẤN THƯƠNG GOODFIT</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>50,000₫</span></p></div>
                                </div>
                            </div>
                        </li>
                        <!-- SP9 -->
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Bang/Băng-BĂNG GỐI THỂ THAO GOODFIT-01.webp" atl="" width="260" height="260">
                                        <!-- <img class="dt-width-100 img-hover" src="../assets/images/Nike/NIKE-NIKE GIANNIS IMMORTALITY 3-02.webp" atl="" width="260" height="260"> -->
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <div class="product-sale"><span>-30%</span></div>
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>

                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a  href="" class="product-name">BĂNG GỐI THỂ THAO GOODFIT</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>50,000₫</span></p></div>
                                </div>
                            </div>
                        </li>
                        
                    </ul>
        </div>
    </div>
    <div class="top-title">
			<h2 class="title-section">
				<span>NEW ARRIVAL</span>
			</h2>
            <!-- <h2>----////----</h2> -->
            <p></p>
	    </div>

        <!-- --New Arrival-- -->
    <div class="    ">
        <!-- SP1 -->
        <ul class="products">
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="../utils/chitietsanpham.php" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Balo/Balo-BALO JORDAN MONOGRAM-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Balo/Balo-BALO JORDAN MONOGRAM-04.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <!-- <div class="product-sale"><span>-20%</span></div> -->
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" 
                                        data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>
                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a href=""class="product-name">BALO JORDAN MONOGRAM</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>5,272,000₫</span></p></div>
                                </div>
                            </div>
                        </li>
                        <!-- SP2 -->
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Balo/Balo-BALO NIKE AIR ELITE 2.0-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Balo/Balo-BALO NIKE AIR ELITE 2.0-04.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <!-- <div class="product-sale"><span>-12%</span></div> -->
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>
                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a href="" class="product-name">BALO NIKE AIR ELITE 2.0</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>5,990,000₫</span></p></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Balo/Balo-BALO NIKE AIR ELITE (BLACK EDITION)-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Balo/Balo-BALO NIKE AIR ELITE (BLACK EDITION)-04.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <!-- <div class="product-sale"><span>-5%</span></div> -->
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>

                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a  href="" class="product-name">BALO NIKE AIR ELITE (BLACK EDITION)</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>6,500,000₫</span></p></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Balo/Balo-BALO NIKE BRASILIA-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Balo/Balo-BALO NIKE BRASILIA-04.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <!-- <div class="product-sale"><span>-35%</span></div> -->
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>

                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a  href="" class="product-name">BALO NIKE BRASILIA</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>6,950,000₫</span></p></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Balo/Balo-BALO ADIDAS POWER VI-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Balo/Balo-BALO ADIDAS POWER VI-04.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <!-- <div class="product-sale"><span>-30%</span></div> -->
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>

                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a  href="" class="product-name">BALO ADIDAS POWER VI</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>8,500,000₫</span></p></div>
                                </div>
                            </div>
                        </li>
                        
                    </ul>
                    <ul class="products">
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Jordan/Jordan-JORDAN 6 CNY-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Jordan/Jordan-JORDAN 6 CNY-02.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <!-- <div class="product-sale"><span>-20%</span></div> -->
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" 
                                        data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>
                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a href=""class="product-name">JORDAN 6 CNY</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>9,272,000₫</span></p></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Jordan/Jordan-JORDAN TATUM 1 DENIM-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Jordan/Jordan-JORDAN TATUM 1 DENIM-02.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <!-- <div class="product-sale"><span>-12%</span></div> -->
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>
                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a href="" class="product-name">JORDAN TATUM 1 DENIM</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>9,990,000₫</span></p></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Li-ning/Lining-LI-NING WADE ALL CITY 12 CITY OF ANGELS-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Li-ning/Lining-LI-NING WADE ALL CITY 12 CITY OF ANGELS-02.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <!-- <div class="product-sale"><span>-5%</span></div> -->
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>

                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a  href="" class="product-name">LI-NING WADE ALL CITY 12 CITY OF ANGELS</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>5,500,000₫</span></p></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Li-ning/Lining-LI-NING SPEED 10-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Li-ning/Lining-LI-NING SPEED 10-02.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <!-- <div class="product-sale"><span>-35%</span></div> -->
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>

                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a  href="" class="product-name">LI-NING SPEED 10</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>5,950,000₫</span></p></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Adidas/Adidas-ADIDAS ADIFOM Q OFF-WHITE-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Adidas/Adidas-ADIDAS ADIFOM Q OFF-WHITE-02.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <!-- <div class="product-sale"><span>-30%</span></div> -->
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>

                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a  href="" class="product-name">ADIDAS ADIFOM Q OFF-WHITE</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>7,500,000₫</span></p></div>
                                </div>
                            </div>
                        </li>
                        
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