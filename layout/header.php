<?php
    $sql ="select * from Category";
    $menuItems =executeResult($sql);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=fallback" as="style" type="text/css" rel="preload stylesheet">
    <link href="//theme.hstatic.net/200000037626/1000890916/14/plugin-style.css?v=147" rel="preload stylesheet" as="style" type="text/css">
    <link href="//theme.hstatic.net/200000037626/1000890916/14/styles-new.scss.css?v=147" rel="preload stylesheet" as="style" type="text/css">
    <link rel="preload" as="image" href="//theme.hstatic.net/200000037626/1000890916/14/logo.png?v=147">
    <link href="//theme.hstatic.net/200000037626/1000890916/14/styles-index.scss.css?v=147" rel="preload stylesheet" as="style" type="text/css"><link rel="preload" as="image" href="//theme.hstatic.net/200000037626/1000890916/14/slideshow_1_mob_large.jpg?v=147" media="(max-width: 480px)">
    <link href="//theme.hstatic.net/200000037626/1000890916/14/jquery-script.js?v=147" rel="preload" as="script" type="text/javascript">
    <link href="//theme.hstatic.net/200000037626/1000890916/14/main-scripts.js?v=147" rel="preload" as="script" type="text/javascript">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
        *{
            font-family: 'Quicksand', sans-serif !important;
            margin:0;
            padding:0;
            -webkit-font-smoothing: antialiased;
        }
        #warpper{
            max-width :1178px;
            margin: 0 auto;
            box-sizing: border-box;
        }
        a{
            text-decoration: none;
        }
        ul.products{
            list-style: none;
            display: flex;
            padding-left: 200px;
            padding-right: 200px;
        }
        ul.products li{
            padding-left: 15px;
            padding-right: 15px;
            box-sizing: border-box;
        }
        ul.products li .product-info{
            display: block;

        }
        .pro-price span{
            color: #e70303;
            font-weight: 600;
        }
        p{
            margin: 0 0 10px 0;
            line-height: 20px;
        }
        del {
            text-decoration: line-through;
        }
        .pro-price .compare-price {
            font-size: 15px;
            font-weight: 500;
            margin-left: 15px;
            color: #888888;
        }
        .product-item .product-infor .pro-name a{
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            color: #000000;
            line-height: 18px;
            padding-top: 10px;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        ul.products li .product-top{
            position: relative;
            overflow: hidden;

        }
        ul.products li .product-top .product-thumb{
            display: block;
        }
        .product-item .product-top .product-thumb > a img{
            left: 20;
            top: 0;
            height: 100%;
            object-fit: cover;
            object-position: top;
            display: block;
            z-index: 8;
        }
        ul.products li .product-top .buy-now{
            background-color: white;
            color: white;
            font-size: 13px;
            padding: 10px auto;
            bottom: -50px;
            width: 100%;
            position: absolute;
        }
        ul.products li:hover .buy-now{
            bottom: 0px;
            z-index: 9;
        }
        ul.products li .product-top .buy-now div{
            display: inline;
            
        }
        ul.products li .product-top .buy-now button{
            text-align: center;
            width: 45%;
            margin: 10px auto;
            height: 40px;
            background-color: #000000;
            color: white;
            z-index: 9;
        }
        .dt-width-100{
            width:100%;
            height: 100%;
        }
        img{
            max-width: 100%;
        }
        .dt-width-100.img-hover{
            display: none;
        }
        ul.products li .product-top:hover .dt-width-100.img-hover {
            display: inline;
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            object-fit: cover;
            object-position: top;
            display: block;
            z-index: 8;
        }

        .product-item .product-top .product-wishlist {
            position: absolute;
            z-index: 9;
            top: 0px;
            right: 0px;
        }
        .product-item .product-top .product-wishlist button {
            font-size: 0;
            outline: none;
            border: none;
            background: none;
            width: 35px;
            height: 35px;
        }
        .container{
            max-width: 1500px;
            padding-top: 15px;
            display: flex;
            flex-direction: row;
            list-style: none;
            height: 120px;
            background-color: white;

        }
        #header{
            box-shadow: 0px 0px 3px 0px #ccc;
            background-color: white;
            display: flex;
            flex-direction: row;
        }
        .nav .nav-item{
            text-transform: uppercase;
            color: black;
            margin-top: 10px;
            margin-left: 20px;
            position: relative;

        }
        .nav {
            display: flex;
            flex-wrap: Nowrap ;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
        }
        .container ul li a{
            font-size: 16px;
            font-weight: 500;
            color: black;
            display: inline;
            text-decoration: none;
            margin-left: -20px;
            margin-right: 5px;
            text-transform: unset;
        }
        .container ul li a:hover{
            color: pink;
            
        }
        .nav-logo{
            margin-left: 30px ;
        }
        .container ul{
            width:100%;
        }
        .container .nav .nav-item{
            height: 100%;
            display: block;
        }
        .nav-logo{
            display: block;
            height : 60%;
        }
        .carousel-inner .img-banner{
            margin-top: 40px;
            height: 700px;
            width: 100%;

        }
        .nav-item img{
            margin-left: 5px;
            margin-top: 15px;
        
        }
        .top-title {
            margin-top: 30px;
            text-align: center;
        }
        .top-title .title-section span{
            font-size: 25px;
            display: block;
        }
        
        .nav ul.sub-menu{
            position: absolute;
            background-color: rgb(255, 248, 250);
            list-style: none;
            min-width: 150px;
            margin-top: 50px;
            margin-left: -20px;
            display: none;
        }
        .nav li:hover .sub-menu{
            display: block;
            
        }
        .nav ul.sub-menu li:hover a{
            color:pink;

        }
        .nav ul.sub-menu a{
            padding: 2px;
            margin-left: 10px;
        }
        footer{
            padding:30px;
        }
        footer ul{
            list-style-type:none ;
            padding:0px;
            margin:0px;
            padding-top:10px;
            padding-bottom:15px ;

        }
        footer ul li{
            margin-top: 10px;
        }
        footer .col-md-4{
            width: 25%;
        }
        .box-img{
            display: flex;
            flex-direction: row;
        }
        .box-img .img-bottom{
            display :inline;
        }
    </style>

</head>
<body>
    <!-- -- MENU-- -->
    <div id="header">
        <nav class="container">
            <a class="nav-logo">
                    <img src="../assets/images/HUDO.png"
                    style ="height:100px; width:250px;">
            </a>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Trang chủ</a>
                </li>
              <?php 
              foreach($menuItems as $item){
                echo'<li class="nav-item ">
                        <a class="nav-link" href="category.php?id='.$item['id'].'">'.$item['name'].'</a>
                    </li>';
              }
              ?>
                <li class="nav-item">
                    <a class="nav-link" href="gioithieu.php">Giới thiệu</a>
                </li>
                <li class="nav-item">
                    <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/searcg-icon.svg?v=147" alt="Tìm kiếm">
                </li>
                <li class="nav-item">
                    <a href="../admin/authen/register.php">
                    <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/user-account.svg?v=147" alt="Tài khoản" >
                    </a>
                </li>
                <li class="nav-item">
                    <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Danh sách yêu thích">
                </li>
                <li class="nav-item">
                    <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/shopping-cart.svg?v=147" alt="Giỏ hàng">
                </li>
            </ul>
        </div>
    </div>
    <!-- --menu_stop-- -->

  