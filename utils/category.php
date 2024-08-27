<?php
    session_start();
    require_once('utility.php');
    require_once('../database/dbhelper.php');
    require_once('../layout/header.php');       
    $category_id=getGet('id');
    $sql ="select Product.*, Category.name as category_name from Product left join Category on Product.category_id = Category.id
            where Product.category_id = $category_id and Product.deleted=0 order by Product.updated_at desc limit 0,8 ";
    $categoryItems = executeResult($sql);
?>              
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        require_once('../assets/css/cssdanhsachsanpham.php');   
    ?>
</head>
<body>  
    <div class="main">
        <?php
        require_once('../layout/header.php');
        ?>      
        <div class="container-01">
            <div class="banner-collection">
                <img class="dt-width-100" src="../assets/images/banner-01.webp" width="900" height="400">
            </div>
            <div class= "row d-flex">
                <div class="col-25">
                    <div class="wrap-filter">
                        <div class="list-collection">
                            <div class="shop-sidebar" >
                                <h4 class="title">Danh mục sản phẩm</h4>
                            </div>
                            <div class="shop-sidebar">
                                <h4 class="title">Thương hiệu</h4>
                            </div>
                            <div class="shop-sidebar">
                                <h4 class="title">Giá</h4>
                            </div>
                            <div class="shop-sidebar">
                                <h4 class="title">Size</h4>
                            </div>
                            <div class="shop-sidebar">
                                <h4 class="title">Loại sản phẩm</h4>
                            </div>
                                

                        </div>
                    </div>
                </div>
            <div class="col-75">
                    <div class="top-title-colection">
                        <div class="collection-title">
                            <h1>Tất cả sản phẩm</h1>
                        </div>
                        <div class="product-short">
                            <button class="btn-filter-mob">Bộ lọc</button>
                            <div class="wrap-box-sort">
                                <label for="SortBy">Sắp xếp:</label>
                                <select class="sort-by custom-dropdown__select">
                                    <option >Giá: Tăng dần</option>
                                    <option >Giá: Giảm dần</option>
                                    <option>Tên: A-Z</option>
                                    <option >Tên: Z-A</option>
                                    <option >Cũ nhất</option>
                                    <option >Mới nhất</option>
                                    <option >Bán chạy nhất</option>
                                    <option >Tồn kho: Giảm dần</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="content-product-list">
                       <?php
                       foreach($categoryItems as $item){
                        echo ' <div class="collection-box">
                            <div class="product-item-collection">
                                        <div class="product-top">
                                            <a href="detail.php?id='.$item['id'].'" class="product-thumb">
                                                <img class="dt-width-100" src="../'.$item['thumbnail'].'" atl="" width="260" height="260">
                                                <img class="dt-width-100 img-hover" src="../'.$item['thumbnail_2'].'" atl="" width="260" height="150">
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
                                                <a href=""class="product-name-collection">'.$item['title'].'</a>
                                            <div class="product-price"><p class="pro-price"> <span>'.$item['discount'].'</span><del class="compare-price">'.$item['price'].'</del></p></div>
                                        </div>
                            </div>
                        </div>';
                       }
                       ?>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <?php
        require_once('../layout/footer.php');
    ?>
</body>
</html>