<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .container-02 {
        width: 970px;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
        position: relative;
        margin-top: 150px;
    }
    #product-template .product-content h1 {
    font-size: 24px;
    font-weight: 600;
    color: #000;
    text-transform: capitalize;
    }
    .row {
        margin-right: -15px;
        margin-left: -15px;
    }
    .product-info .title {
        font-weight: bold;
    }
    .product-info .line-info {
        margin: 0 10px;
    }
    .product-info {
        margin-bottom: 10px;
        line-height: 20px;
    }
    .d-flex {
    display: flex;
    flex-wrap: wrap;
    }
    .row-flex {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    }
    .add-to-cart-style{
    background: var(--bgshop);
    color: #fff;
    height: 45px;
    width: calc(50% - 15px);
    flex: 0 0 calc(50% - 15px);
    margin-right: 15px;
    display: block;
    border: 1px solid var(--bgshop);
    max-width: 250px;
    }
    .buynow-style:hover {
        background: var(--bgshop);
        color: #fff;
}
    </style>
</head>
<body>
    <?php
        require_once('../layout/header.php');
    ?>
        <div class="container-02">
                <div class="row d-flex">
                    <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 order-mb-1 d-flex-wrap d-flex gallery-product-template">
                        <div class="product-gallery hidden-xs">
                            <span class="pro-sale-detail">
                                <span class="sale">-5%</span>
                            </span>
                            <img class="product-image-feature dt-width-100 lazyload-feature" width="600" height="600"  src="//product.hstatic.net/200000037626/product/vyll4626_6b9c47d2e9dd46ea8c98b3aaaead20f4_grande.png" alt="JORDAN 38 ">
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12 order-mb-2">
                    <div class="product-content">
                        <div class="pro-content-head clearfix">
                            <h1>JORDAN 38 "FIBA"</h1>
                            <div class="d-flex product-info">
                                <div class="pro-brand"><span class="title">Thương hiệu: </span><a >JORDAN </a></div>
                                <span class="line-info">|</span><div class="pro-type"><span class="title"> Loại: </span><a >GIÀY BÓNG RỔ</a></div>
                                <span class="line-info">|</span><div class="pro-sku ProductSku"><span class="title">MSP:</span> <span class="sku-number">FN7482-100</span></div></div>
                            <div id="pro-price">
                                <span class="price-now">5,990,000₫</span>
                                <span class="price-compare"><del>6,300,000₫</del></span>
                                <div class="available-pro"><span class="title">Tình trạng: </span><span class="status">Còn hàng</span></div>
                            </div>
                    </div>
                    <div class="bg-countdown-product">
                    <div class="count-down-index d-flex d-flex-center">
                        <span>Kết thúc trong: </span>
                        <ul class="countdown-deal d-flex d-flex-center js-center" data-countdown="Jul 10, 2022 00:00:00">
                        <li><span class="days">00</span></li>
                            <li><span class="hours">00</span></li>
                            <li><span class="minutes">00</span></li>
                            <li><span class="seconds">00</span></li>
                        </ul>
                    </div>
                    </div>
                    </div>
                    <form id="add-item-form" action="/cart/add" method="post" class="variants clearfix">				
                    <div class="select hidden">
                    <div class="selector-wrapper"><label>Kích thước</label><span class="custom-dropdown custom-dropdown--white">
                        <select class="single-option-selector custom-dropdown__select custom-dropdown__select--white" data-option="option1" id="product-select-option-0">
                            <option value="12">12</option></select></span></div><select id="product-select" name="id" style="display: none;">
                                <option value="1112572054" data-available="true" data-variant="12">12</option></select>
                    </div>
                    <div class="select-swatch clearfix">
                    <div id="variant-swatch-0" class="swatch clearfix" data-option="option1" data-option-index="0">
                        <div class="header">Kích thước: <span class="color-text"></span>
                    <div class="size-chart">
                    <img src="//theme.hstatic.net/200000037626/1000890916/14/ruler.svg?v=147" width="15" height="15">
                    Bảng quy đổi size
                    </div>
                    </div>
                    <div class="select-swap">


                    <div data-value="12" class="n-sd swatch-element 12  ">
                    <input class="variant-0 " id="swatch-0-12" type="radio" name="option1" value="12" data-vhandle="12" checked="">
                    <label for="swatch-0-12" class="sd">
                        <span>12</span>
                        <img class="img-check" width="14" height="14" src="//theme.hstatic.net/200000037626/1000890916/14/select-pro.png?v=147">
                    </label>
                    </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-xs-12 selector-actions d-flex d-flex-center pd-top-10">
                        <div class="quantity-area">
                            <input type="button" value="–" onclick="Wanda.minusQuantity($(this))" class="qty-btn qtyminus">
                            <input type="text" id="quantity" name="quantity" value="1" min="1" class="quantity-selector">
                            <input type="button" value="+" onclick="Wanda.plusQuantity($(this))" class="qty-btn qtyplus">
                        </div>
                        <div class="wrap-addcart">						
                            <div class="row-flex">
                                <button type="button" id="add-to-cart" class="flex-addcart-mb  add-to-cart-style" name="add"><span>Thêm vào giỏ</span></button>
                                <button type="button" id="buy-now" class="hidden-xs buynow-style" name="add"> 
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
                                <strong>JORDAN 38 "FIBA"</strong><ul><li>Code:&nbsp;FN7482-100</li><li>Phối màu:&nbsp;White/Pure Platinum/Metallic Gold.</li><li>Công nghệ: Full length Zoom Air Strobel kết hợp cùng đệm Cushlon 3.0.</li><li>Fit: True to size hoặc lên 0.5 size.</li><li>Phù hợp chơi indoor.</li><li>Vị trí: Đa vị trí.</li></ul><div style="text-align: center;"><strong>Bảng quy đổi size</strong></div><div style="text-align: center;"><p style="text-align: center"><img data-src="//file.hstatic.net/200000037626/file/nike-mens__2__fce53d17930e447e9ada5a03812678c9_grande.png" class="dt-width-auto lazyloaded" width="600" height="600" src="//file.hstatic.net/200000037626/file/nike-mens__2__fce53d17930e447e9ada5a03812678c9_grande.png"></p></div>
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
                <!-- SP1 -->
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Adidas/Adidas-ADIDAS ADIZERO SELECT-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Adidas/Adidas-ADIDAS ADIZERO SELECT-02.webp" atl="" width="260" height="260">
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
                                        <a href=""class="product-name">ADIDAS ADIZERO SELECT</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>2,272,000₫</span><del class="compare-price">3,590,000₫</del></p></div>
                                </div>
                            </div>
                        </li>
                        <!-- SP2 -->
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Balo/Balo-BALO NIKE AIR ELITE-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Balo/Balo-BALO NIKE AIR ELITE-04.webp" atl="" width="260" height="260">
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
                                        <a href="" class="product-name">BALO NIKE AIR ELITE</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>599,000₫</span><del class="compare-price">639,000₫</del></p></div>
                                </div>
                            </div>
                        </li>
                        <!-- SP3 -->
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Aobongro/Ao-ANTHONY EDWARDS MINNESOTA TIMBERWOLVES CITY EDITION JERSEY-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Aobongro/Ao-ANTHONY EDWARDS MINNESOTA TIMBERWOLVES CITY EDITION JERSEY-02.webp" atl="" width="260" height="260">
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
                                        <a  href="" class="product-name">ANTHONY EDWARDS MINNESOTA TIMBERWOLVES CITY EDITION JERSEY</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>350,000₫</span><del class="compare-price">399,000₫</del></p></div>
                                </div>
                            </div>
                        </li>
                        <!-- SP4 -->
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Aobongro/Ao-KEVIN DURANT PHOENIX SUNS CITY EDITION 2023-24 JERSEY-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Aobongro/Ao-KEVIN DURANT PHOENIX SUNS CITY EDITION 2023-24 JERSEY-02.webp" atl="" width="260" height="260">
                                    </a>
                                    <a class="buy-now">
                                        <div class="product-icon-add">
                                            <button>Thêm vào giỏ</button>
                                        </div>
                                        <div class="product-icon-watch">
                                            <button>Xem nhanh</button>
                                        </div>
                                    </a>
                                    <div class="product-sale"><span>-25%</span></div>
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>

                                    </div>
                                    <div class="product-infor">
                                        <h3 class="pro-name">
                                            <a  href="" class="product-name">KEVIN DURANT PHOENIX SUNS CITY EDITION 2023/24 JERSEY</a>
                                        </h3>
                                        <div class="product-price"><p class="pro-price"> <span>500,000₫</span><del class="compare-price">700,000₫</del></p></div>
                                    </div>
                            </div>
                        </li>
                        <!-- SP5 -->
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Banh/Banh-BANH AKPRO AB9008-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Banh/Banh-BANH AKPRO AB9008-02.webp" atl="" width="260" height="260">
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
                                    <div class="product-wishlist"> <button data-original-title="Yêu thích" class="wishlist-loop" data-handle="peak-basketball-sonic-boom-e39001a-rose-pink" 
                                        data-toggle="tooltip" tabindex="0"> <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích"> Yêu thích </button></div>

                                </div>
                                <div class="product-infor">
                                    <h3 class="pro-name">
                                        <a  href="" class="product-name">BANH AKPRO AB9008</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>490,000₫</span><del class="compare-price">590,000₫</del></p></div>
                                </div>
                            </div>
                        </li>
                        
                    </ul>
    </div>
    <div class="top-title">
			<h2 class="title-section">
				<span>SẢN PHẨM ĐÃ XEM</span>
			</h2>
            <!-- <h2>----////----</h2> -->
            <p></p>
		</div>
    <div id="wrapper">
        <ul class="products">
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Banh/Banh-BANH TARMAK BT500 CONTROL-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Banh/Banh-BANH TARMAK BT500 CONTROL-02.webp" atl="" width="260" height="260">
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
                                        <a href=""class="product-name">BANH TARMAK BT500 CONTROL</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>1,272,000₫</span><del class="compare-price">1,590,000₫</del></p></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- SP7 -->
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Jordan/Jordan-JORDAN LUKA 2 QUAI54-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Jordan/Jordan-JORDAN LUKA 2 QUAI54-02.webp" atl="" width="260" height="260">
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
                                        <a href="" class="product-name">JORDAN LUKA 2 QUAI54</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>5,990,000₫</span><del class="compare-price">6,390,000₫</del></p></div>
                                </div>
                            </div>
                        </li>
                        <!-- SP8 -->
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Sock/Sock-PACK VỚ NIKE EVERYDAY (VNXK)-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Sock/Sock-PACK VỚ NIKE EVERYDAY (VNXK)-02.webp" atl="" width="260" height="260">
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
                                        <a  href="" class="product-name">PACK VỚ NIKE EVERYDAY (VNXK)</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>90,000₫</span><del class="compare-price">99,000₫</del></p></div>
                                </div>
                            </div>
                        </li>
                        <!-- SP9 -->
                        <li>
            
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Li-ning/Lining-LI-NING WADE FLASH CRACKS-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Li-ning/Lining-LI-NING WADE FLASH CRACKS-02.webp" atl="" width="260" height="260">
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
                                        <a  href="" class="product-name">LI-NING WADE FLASH CRACKS</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>2,950,000₫</span><del class="compare-price">3,690,000₫</del></p></div>
                                </div>
                            </div>
                        </li>
                        <!-- SP10 -->
                        <li>
                            <div class="product-item">
                                <div class="product-top">
                                    <a href="" class="product-thumb">
                                        <img class="dt-width-100" src="../assets/images/Adidas/Adidas-ADIDAS D.O.N ISSUE 5-01.webp" atl="" width="260" height="260">
                                        <img class="dt-width-100 img-hover" src="../assets/images/Adidas/Adidas-ADIDAS D.O.N ISSUE 5-02.webp" atl="" width="260" height="260">
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
                                        <a  href="" class="product-name">NIKE LEBRON NXXT</a>
                                    </h3>
                                    <div class="product-price"><p class="pro-price"> <span>5,500,000₫</span><del class="compare-price">6,590,000₫</del></p></div>
                                </div>
                            </div>
                        </li>
                        
                    </ul>
        </div>
<?php
     require_once('../layout/footer.php');
     ?>
</body>

</html>