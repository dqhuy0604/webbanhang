<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style type="text/css">
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
    ul.products{
        list-style: none;
        display: flex;
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
        list-style: none;
        height: 120px;
        background-color: white;

    }
    #header{
        box-shadow: 0px 0px 3px 0px #ccc;
        background-color: white;
    }
    .nav .nav-item{
        text-transform: uppercase;
        color: black;
        margin-top: 10px;
        margin-left: 20px;
        position: relative;

    }
    .container ul li a{
        font-size: 16px;
        font-weight: 500;
        color: black;
        display: block;
        text-decoration: none;
        margin-left: -20px;
        margin-right: 5px;
        text-transform: unset;
    }
    .container ul li a:hover{
        color: pink;
        
    }
    .nav-logo{
        margin-left: 100px ;
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
        padding-top: 20px;
        height: auto;
    }
    .carousel-inner img{
        margin-top: 40px;
        height: 700px;
        width: 100%;

    }
    .nav-item img{
        margin-left: 5px;
        margin-top: 15px;
    
    }
    .top-title {
        margin-bottom: 30px;
        text-align: center;
    }
    .nav ul.sub-menu{
        position: absolute;
        background-color: rgb(255, 248, 250);
        list-style: none;
        min-width: 150px;
        margin-top: 50px;
        margin-left: -15px;
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
        margin-right: 2px;
    }
</style>
</head>
<body>
    
</body>
</html>
