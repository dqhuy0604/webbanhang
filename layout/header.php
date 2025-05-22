<?php
$sql = "select * from Category";
$menuItems = executeResult($sql);
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
    <!-- <link rel="preload" as="image" href="//theme.hstatic.net/200000037626/1000890916/14/logo.png?v=147"> -->
    <link href="//theme.hstatic.net/200000037626/1000890916/14/styles-index.scss.css?v=147" rel="preload stylesheet" as="style" type="text/css">
    <link rel="preload" as="image" href="//theme.hstatic.net/200000037626/1000890916/14/slideshow_1_mob_large.jpg?v=147" media="(max-width: 480px)">
    <!-- <link href="//theme.hstatic.net/200000037626/1000890916/14/jquery-script.js?v=147" rel="preload" as="script" type="text/javascript"> -->
    <!-- <link href="//theme.hstatic.net/200000037626/1000890916/14/main-scripts.js?v=147" rel="preload" as="script" type="text/javascript"> -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <!-- boxicons css -->

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #f9f9f9;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 8px;
            font-family: 'Quicksand', sans-serif !important;
        }

        .modal-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .close {
            color: #000;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #f00;
            text-decoration: none;
            cursor: pointer;
        }

        .close-register {
            color: #000;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-register:hover,
        .close-register:focus {
            color: #f00;
            text-decoration: none;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-register {
            background-color: #000;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            width: 100%;
        }

        .btn-register:hover {
            background-color: #333;
        }

        .login-link {
            display: block;
            text-align: center;
            margin: 10px 0;
            color: pink;
        }

        .btn-login {
            background-color: #000;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #333;
        }

        .register-link {
            display: block;
            text-align: center;
            margin: 10px 0;
            color: pink;
        }

        * {
            font-family: 'Quicksand', sans-serif !important;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        #warpper {
            max-width: 1178px;
            margin: 0 auto;
            box-sizing: border-box;
        }

        a {
            text-decoration: none;
        }

        ul.products {
            list-style: none;
            display: flex;
            padding-left: 200px;
            padding-right: 200px;
        }

        ul.products li {
            padding-left: 15px;
            padding-right: 15px;
            box-sizing: border-box;
        }

        ul.products li .product-info {
            display: block;

        }

        .pro-price span {
            color: #e70303;
            font-weight: 600;
        }

        p {
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

        .product-item .product-infor .pro-name a {
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

        ul.products li .product-top {
            position: relative;
            overflow: hidden;

        }

        ul.products li .product-top .product-thumb {
            display: block;
        }

        .product-item .product-top .product-thumb>a img {
            left: 20;
            top: 0;
            height: 100%;
            object-fit: cover;
            object-position: top;
            display: block;
            z-index: 8;
        }

        ul.products li .product-top .buy-now {
            background-color: white;
            color: white;
            font-size: 13px;
            padding: 10px auto;
            bottom: -50px;
            width: 100%;
            position: absolute;
        }

        ul.products li:hover .buy-now {
            bottom: 0px;
            z-index: 9;
        }

        ul.products li .product-top .buy-now div {
            display: inline;

        }

        ul.products li .product-top .buy-now button {
            text-align: center;
            width: 45%;
            margin: 10px auto;
            height: 40px;
            background-color: #000000;
            color: white;
            z-index: 9;
        }

        .dt-width-100 {
            width: 100%;
            height: 100%;
        }

        img {
            max-width: 100%;
        }

        .dt-width-100.img-hover {
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

        .container {
            max-width: 1500px;
            padding-top: 15px;
            display: flex;
            flex-direction: row;
            list-style: none;
            height: 120px;
            background-color: white;

        }

        #header {
            box-shadow: 0px 0px 3px 0px #ccc;
            background-color: white;
            display: flex;
            flex-direction: row;
        }

        .nav .nav-item {
            text-transform: uppercase;
            color: black;
            margin-top: 10px;
            margin-left: 20px;
            position: relative;

        }

        .nav {
            display: flex;
            flex-wrap: Nowrap;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
        }

        .container ul li a {
            font-size: 16px;
            font-weight: 500;
            color: black;
            display: inline;
            text-decoration: none;
            margin-left: -20px;
            margin-right: 5px;
            text-transform: unset;
        }

        .container ul li a:hover {
            color: pink;

        }

        .nav-logo {
            margin-left: 30px;
        }

        .container ul {
            width: 100%;
        }

        .container .nav .nav-item {
            height: 100%;
            display: block;
        }

        .nav-logo {
            display: block;
            height: 60%;
        }

        .carousel-inner .img-banner {
            margin-top: 40px;
            height: 700px;
            width: 100%;

        }

        .nav-item img {
            margin-left: 5px;
            margin-top: 15px;

        }

        .top-title {
            margin-top: 30px;
            text-align: center;
        }

        .top-title .title-section span {
            font-size: 25px;
            display: block;
        }

        .nav ul.sub-menu {
            position: absolute;
            background-color: rgb(255, 248, 250);
            list-style: none;
            min-width: 150px;
            margin-top: 50px;
            margin-left: -20px;
            display: none;
        }

        .nav li:hover .sub-menu {
            display: block;

        }

        .nav ul.sub-menu li:hover a {
            color: pink;

        }

        .nav ul.sub-menu a {
            padding: 2px;
            margin-left: 10px;
        }

        footer {
            padding: 30px;
        }

        footer ul {
            list-style-type: none;
            padding: 0px;
            margin: 0px;
            padding-top: 10px;
            padding-bottom: 15px;

        }

        footer ul li {
            margin-top: 10px;
        }

        footer .col-md-4 {
            width: 25%;
        }

        .box-img {
            display: flex;
            flex-direction: row;
            position: relative;
            height: 100%;
            min-height: 1px;
        }

        .box-img .img-bottom {
            display: inline;
        }

        .cart-item {
            position: absolute;
            left: 0;
            background-color: #000;
            color: #fff;
            padding: 1px 3px;
            border-radius: 50%;
            font-size: 12px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 18px;
            height: 18px;
            text-align: center;
        }

        /* search css */
        .search-box {

            background-attachment: scroll;
            background-clip: border-box;
            background-color: rgb(255, 255, 255);
            background-image: none;
            background-origin: padding-box;
            background-position-x: 0%;
            background-position-y: 0%;
            background-repeat: repeat;
            background-size: auto;
            border-bottom-color: rgb(223, 227, 232);
            border-bottom-left-radius: 3px;
            border-bottom-right-radius: 3px;
            border-bottom-style: solid;
            border-bottom-width: 0.666667px;
            border-image-outset: 0;
            border-image-repeat: stretch;
            border-image-slice: 100%;
            border-image-source: none;
            border-image-width: 1;
            border-left-color: rgb(223, 227, 232);
            border-left-style: solid;
            border-left-width: 0.666667px;
            border-right-color: rgb(223, 227, 232);
            border-right-style: solid;
            border-right-width: 0.666667px;
            border-top-color: rgb(103, 114, 121);
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
            border-top-style: none;
            border-top-width: 0px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 5px 2px;
            box-sizing: border-box;
            color: rgb(103, 114, 121);
            display: block;
            font-family: Quicksand, sans-serif;
            font-size: 14px;
            font-weight: 400;
            height: 113.333px;
            left: -276px;
            line-height: 19.6px;
            list-style-type: none;
            margin-bottom: 0px;
            margin-left: 0px;
            margin-right: 0px;
            margin-top: 0px;
            min-width: 375.333px;
            opacity: 1;
            padding-bottom: 0px;
            padding-left: 0px;
            padding-right: 0px;
            padding-top: 0px;
            position: absolute;
            right: -10px;
            text-align: center;
            text-size-adjust: 100%;
            top: 41.1458px;
            transform: matrix(1, 0, 0, 1, 0, 0);
            transition-behavior: normal, normal, normal, normal, normal;
            transition-delay: 0s, 0s, 0s, 0.25s, 0s;
            transition-duration: 0.25s, 0.25s, 0.25s, 0s, 0.25s;
            transition-property: opacity, transform, visibility, max-height, -webkit-transform;
            transition-timing-function: ease-in-out, ease-in-out, ease-in-out, linear, ease-in-out;
            unicode-bidi: isolate;
            visibility: visible;
            width: 375.333px;
            z-index: 2000;
            -webkit-font-smoothing: antialiased;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);

        }

        .box-arrow {
            position: absolute;
            bottom: 110.667px;
            left: 277.208px;
            right: 74.7917px;
            width: 22px;
            height: 15px;

            display: block;
            box-sizing: border-box;
            color: rgb(103, 114, 121);
            font: 400 14px/19.6px 'Quicksand', sans-serif;
            text-align: center;
            text-size-adjust: 100%;
            visibility: visible;
            list-style: none;
            margin: 0;
            padding: 0;

            -webkit-font-smoothing: antialiased;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        .header-search {
            box-sizing: border-box;
            display: block;
            color: rgb(103, 114, 121);
            font: 400 14px/19.6px 'Quicksand', sans-serif;
            text-align: center;
            text-size-adjust: 100%;
            unicode-bidi: isolate;
            visibility: visible;

            width: 374px;
            height: 112.667px;
            max-height: 100%;

            margin: 0;
            padding: 10px 20px;

            list-style: none;
            overflow: hidden;

            -webkit-font-smoothing: antialiased;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);

        }

        .tillte-search {
            box-sizing: border-box;
            display: block;
            color: rgb(0, 0, 0);
            font: 500 17px/20px 'Quicksand', sans-serif;
            letter-spacing: 0.5px;
            text-align: center;
            text-transform: uppercase;
            text-size-adjust: 100%;
            unicode-bidi: isolate;
            visibility: visible;

            width: 334px;
            height: 32.6667px;

            margin: 0 0 10px;
            padding: 6px 10px;

            border-bottom: 0.666667px solid rgb(237, 237, 237);
            list-style: none;

            -webkit-font-smoothing: antialiased;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);


        }

        .site-search {
            box-sizing: border-box;
            display: block;
            color: rgb(103, 114, 121);
            font: 400 14px/19.6px 'Quicksand', sans-serif;
            text-align: center;
            text-size-adjust: 100%;
            unicode-bidi: isolate;
            visibility: visible;

            width: 334px;
            height: 45px;

            margin: 0;
            padding: 0;
            list-style: none;

            -webkit-font-smoothing: antialiased;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);

        }

        .wanda-mxm-search {
            box-sizing: border-box;
            display: block;
            position: relative;

            color: rgb(103, 114, 121);
            font: 400 14px/19.6px 'Quicksand', sans-serif;
            text-align: center;
            text-size-adjust: 100%;
            unicode-bidi: isolate;
            visibility: visible;

            width: 290.667px;
            height: 45px;

            margin: 0 0 5px;
            padding: 0;
            list-style: none;

            -webkit-font-smoothing: antialiased;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);

        }

        .search-inner {
            box-sizing: border-box;
            color: rgb(103, 114, 121);
            display: block;
            font-family: Quicksand, sans-serif;
            font-size: 14px;
            font-weight: 400;
            height: 45px;
            line-height: 19.6px;
            list-style-type: none;
            margin-bottom: 0px;
            margin-left: 0px;
            margin-right: 0px;
            margin-top: 0px;
            padding-bottom: 0px;
            padding-left: 0px;
            padding-right: 0px;
            padding-top: 0px;
            text-align: center;
            text-size-adjust: 100%;
            unicode-bidi: isolate;
            visibility: visible;
            width: 290.667px;
            -webkit-font-smoothing: antialiased;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);



        }

        input.searchinput.input-search.search-input {
            appearance: none;
            box-sizing: border-box;
            display: inline-block;
            cursor: text;
            visibility: visible;

            color: rgb(51, 51, 51);
            font: 500 14px/19.6px 'Quicksand', sans-serif;
            text-align: start;
            text-indent: 0;
            letter-spacing: normal;
            word-spacing: 0;
            text-transform: none;
            text-rendering: auto;
            text-shadow: none;
            text-size-adjust: 100%;

            background: rgb(245, 245, 245);
            background-clip: border-box;
            background-origin: padding-box;
            background-attachment: scroll;
            background-repeat: repeat;
            background-position: 0% 0%;
            background-size: auto;

            border: 0.666667px solid rgb(236, 236, 236);
            border-radius: 0;

            outline: none;

            padding: 0 55px 0 20px;
            margin: 0;
            list-style: none;

            width: 290.667px;
            height: 45px;
            max-width: 100%;

            overflow: clip;
            overflow-clip-margin: 0;

            transition: all 0.15s linear;

            -webkit-font-smoothing: antialiased;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -webkit-rtl-ordering: logical;
            -webkit-border-image: none;
        }

        button#search-header-btn.btn-search {
            appearance: button;
            background-attachment: scroll;
            background-clip: border-box;
            background-color: rgba(0, 0, 0, 0);
            background-image: none;
            background-origin: padding-box;
            background-position-x: 0%;
            background-position-y: 0%;
            background-repeat: repeat;
            background-size: auto;
            border-bottom-color: rgb(0, 0, 0);
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
            border-bottom-style: none;
            border-bottom-width: 0px;
            border-image-outset: 0;
            border-image-repeat: stretch;
            border-image-slice: 100%;
            border-image-source: none;
            border-image-width: 1;
            border-left-color: rgb(0, 0, 0);
            border-left-style: none;
            border-left-width: 0px;
            border-right-color: rgb(0, 0, 0);
            border-right-style: none;
            border-right-width: 0px;
            border-top-color: rgb(0, 0, 0);
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
            border-top-style: none;
            border-top-width: 0px;
            box-shadow: none;
            box-sizing: border-box;
            color: rgb(0, 0, 0);
            cursor: pointer;
            display: block;
            font-family: Quicksand, sans-serif;
            font-feature-settings: normal;
            font-kerning: auto;
            font-optical-sizing: auto;
            font-size: 14px;
            font-size-adjust: none;
            font-stretch: 100%;
            font-style: normal;
            font-variant-alternates: normal;
            font-variant-caps: normal;
            font-variant-east-asian: normal;
            font-variant-emoji: normal;
            font-variant-ligatures: normal;
            font-variant-numeric: normal;
            font-variant-position: normal;
            font-variation-settings: normal;
            font-weight: 400;
            height: 45px;
            letter-spacing: normal;
            line-height: 45px;
            list-style-type: none;
            margin-bottom: 0px;
            margin-left: 0px;
            margin-right: 0px;
            margin-top: 0px;
            min-width: 0px;
            outline-color: rgb(0, 0, 0);
            outline-style: none;
            outline-width: 0px;
            padding-block-end: 0px;
            padding-block-start: 0px;
            padding-bottom: 0px;
            padding-inline-end: 0px;
            padding-inline-start: 0px;
            padding-left: 0px;
            padding-right: 0px;
            padding-top: 0px;
            position: absolute;
            right: 0px;
            text-align: center;
            text-indent: 0px;
            text-rendering: auto;
            text-shadow: none;
            text-size-adjust: 100%;
            text-transform: none;
            top: 0px;
            transition-behavior: normal;
            transition-delay: 0s;
            transition-duration: 0.15s;
            transition-property: opacity;
            transition-timing-function: linear;
            visibility: visible;
            width: 45px;
            word-spacing: 0px;
            -webkit-font-smoothing: antialiased;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -webkit-border-image: none;

        }

        #divwanda-smart-search.smart-search-wrapper.ajaxSearchResults {
            box-sizing: border-box;
            color: rgb(103, 114, 121);
            display: block;
            font-family: Quicksand, sans-serif;
            font-size: 14px;
            font-weight: 400;
            height: 0px;
            line-height: 19.6px;
            list-style-type: none;
            margin-bottom: 0px;
            margin-left: 0px;
            margin-right: 0px;
            margin-top: 0px;
            padding-bottom: 0px;
            padding-left: 0px;
            padding-right: 0px;
            padding-top: 0px;
            position: relative;
            text-align: center;
            text-size-adjust: 100%;
            unicode-bidi: isolate;
            visibility: visible;
            width: 290.667px;
            -webkit-font-smoothing: antialiased;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);

        }

        .results-seach {
            position: absolute;
            top: 105px;
            /* Adjust based on the search bar height */
            left: 0;
            width: 100%;
            /* Match the search bar's width, or set to a specific value like 378.667px */
            max-height: 400px;
            overflow-y: auto;
            z-index: 999;
            background: white;
            display: block;
            /* Ensure visibility */
            box-sizing: border-box;
            color: rgb(103, 114, 121);
            font-family: Quicksand, sans-serif;
            font-size: 14px;
            font-weight: 400;
            line-height: 19.6px;
            margin: 0;
            padding: 0;
            text-align: left;
            /* Align text to the left */
            visibility: visible;
            -webkit-font-smoothing: antialiased;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Adds a subtle shadow below the box */

            /* Hide scrollbar but allow scrolling */
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE 10+ */
        }

        .results-seach::-webkit-scrollbar {
            display: none;
            /* Hide scrollbar for Webkit browsers */
        }

        .results-seach p {
            text-align: center;
            padding: 20px 0;
        }



        /* tab search */
        .search-box {
            display: none;

        }

        .search-box.active {
            display: block;
        }
    </style>


</head>

<body>
    <!-- -- MENU-- -->
    <div id="header">
        <nav class="container">
            <a class="nav-logo" href="index.php">
                <img src="../assets/images/HUDO.png"
                    style="height:100px; width:250px;">
            </a>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product.php">SẢN PHẨM</a>
                </li>
                <?php
                foreach ($menuItems as $item) {
                    echo '<li class="nav-item "> 
                        <a class="nav-link" href="../utils/category.php?id=' . $item['id'] . '">' . $item['name'] . '</a>
                    </li>';
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="gioithieu.php">Giới thiệu</a>
                </li>
                <?php
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }
                $count = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $count += $item['num'];
                }
                ?>
                <!-- search -->
                <li class="nav-item ">
                    <a href="../utils/search.php" class="search-icon">
                        <img width="20" height="20" class="search js-search-mobile" src="//theme.hstatic.net/200000037626/1000890916/14/searcg-icon.svg?v=147" alt="Tìm kiếm">

                    </a>
                    <div class="search-box" id="searchBox">
                        <span class="box-arrow">
                            <svg viewBox="0 0 20 9" role="presentation">
                                <path d="M.47108938 9c.2694725-.26871321.57077721-.58667841.90388257-.89986354C3.12384116 6.36134886 5.74788116 3.76338565 9.2467995.30653888c.4145057-.4095171 1.0844277-.40860098 1.4977971.00205122L19.4935156 9H.47108938z" fill="#ffffff"></path>
                            </svg>
                        </span>
                        <div class="header-search">
                            <p class="tillte-search">Tìm Kiếm</p>
                            <div class="site-search">
                                <form action="../utils/search.php" class="wanda-mxm-search">
                                    <div class="search-inner">
                                        <input type="hidden" name="type" value="product">
                                        <input type="text" name="q" placeholder="Tìm kiếm sản phẩm" class="searchinput input-search search-input " autocomplete="off" size="20" aria-label="search" value="" id="searchInput" data-history="">
                                    </div>
                                    <button type="submit" class="btn-search" id="search-header-btn" aria-label="Tìm kiếm">

                                        <img style="margin-left: 60px; margin-top: 0px; " width="24" height="24" src="//theme.hstatic.net/200000037626/1000890916/14/searcg-icon.svg?v=170" alt="Tìm kiếm">
                                    </button>
                                </form>
                                <!-- phần hiện thông itn sản phẩm tìm đc -->
                                <div id="wanda-smart-search" class="smart-search-wrapper ajaxSearchResults">
                                    <div class="results-seach">

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- end -->
                <li class="nav-item" id="loginNavItem">
                    <a href="#">
                        <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/user-account.svg?v=147" alt="Tài khoản">
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../admin/authen/logout.php">
                        <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Danh sách yêu thích">
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../utils/cart.php">
                        <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/shopping-cart.svg?v=147" alt="Giỏ hàng">
                        <span class="cart-item"><?= $count ?></span>
                    </a>
                </li>
            </ul>
    </div>
    </div>


    <!-- --menu_stop-- -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 class="modal-title">Đăng nhập</h2>
            <form method="post" action="../admin/authen/login.php">
                <div class="form-group">
                    <input required type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input required type="password" class="form-control" id="pwd" name="password" placeholder="Mật khẩu">
                </div>
                <a href="register.php" class="register-link" id="registerNavItem">Đăng ký</a>
                <button type="submit" class="btn-login">Đăng nhập</button>
            </form>
        </div>
    </div>
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close-register">&times;</span>
            <h2 class="modal-title">Đăng ký tài khoản</h2>
            <form method="post" action="../utils/index.php" onsubmit="return validateForm()">
                <div class="form-group">
                    <input required type="text" class="form-control" id="fullname" name="fullname" placeholder="Họ Tên">
                </div>
                <div class="form-group">
                    <input required type="email" class="form-control" id="email_register" name="email_register" placeholder="Email">
                </div>
                <div class="form-group">
                    <input required type="password" class="form-control" id="pwd_register" name="pwd_register" placeholder="Mật Khẩu" minlength="6">
                </div>
                <div class="form-group">
                    <input required type="password" class="form-control" id="confirmation_pwd" placeholder="Xác minh mật khẩu">
                </div>
                <p>
                    <a href="" class="login-link">Đã có tài khoản</a>
                </p>
                <button type="submit" class="btn-register">Đăng kí</button>
            </form>
        </div>
    </div>

    <?php
    require_once('../admin/authen/process_form_register.php')
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('loginModal');
            const closeSpan = document.querySelector('.close');
            const navItem = document.getElementById('loginNavItem');
            navItem.addEventListener('click', (event) => {
                event.preventDefault();
                modal.style.display = 'block';
            });
            closeSpan.addEventListener('click', () => {
                modal.style.display = 'none';
            });
            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });

        function openRegisterModal() {
            document.getElementById('registerModal').style.display = 'block';
        }

        function closeRegisterModal() {
            document.getElementById('registerModal').style.display = 'none';
        }
        document.querySelector('.close-register').addEventListener('click', closeRegisterModal);
        document.querySelector('.login-link').addEventListener('click', closeRegisterModal);
        window.addEventListener('click', function(event) {
            if (event.target === document.getElementById('registerModal')) {
                closeRegisterModal();
            }
        });

        document.querySelector('a.register-link').addEventListener('click', function(event) {
            event.preventDefault();
            openRegisterModal();
        });

        function validateForm() {
            var pwd = document.getElementById('pwd_register').value;
            var confirmPwd = document.getElementById('confirmation_pwd').value;
            if (pwd != confirmPwd) {
                alert("Mật khẩu không khớp, vui lòng nhập lại");
                return false;
            }
            return true;
        }
    </script>
    <script src="../layout/search.js"></script>