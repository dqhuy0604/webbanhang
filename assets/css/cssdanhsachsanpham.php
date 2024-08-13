<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container-01{
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
    position: relative;
    width: 1200px;
}
.banner-collection{
    margin-top: 150px;
    margin-bottom: 25px;
}
.col-25{
    width: 20%;
    padding: 0 15px;
    position: relative;
    
}
.wrap-filler{
    border: 1px solid #eee;
    border-radius: 3px;
    background-color: #fff;
    overflow: hidden;
    position: sticky;
    top: calc(var(--height-head) + 10px);
}
.col-75{
    width: 80%;
    padding: 0 15px;
    position: relative;
}
.top-title-colection {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}
.top-title-colection .collection-title {
    display: flex;
    align-items: center
}
.top-title-colection .collection-title h1 {
    font-size: 23px;
    margin: 0;
    font-weight: 600;
}
.top-title-colection .product-short {
    display: flex;
    align-items: center;
}
.top-title-colection .product-short label {
    margin-bottom: 0;
    font-weight: 600;
    margin-right: 15px;
}
.top-title-colection .product-short select {
    padding: 0 15px;
    font-size: 15px;
    height: 36px;
    line-height: 36px;
    font-weight: 400;
    min-width: 175px;
    outline: none;
    background-image: var(--imgsort);
}
.dt-width-100 .img-hover {
    width: auto;
    height: 30%;
    
}
.btn-filter-mob {
    display: none;
    text-align: left;
}
.content-product-list{
    display: flex;
    flex-wrap: wrap;
    margin-top: 30px;
    position: relative;  
}
.collection-top-bar .product-short select option {
    color: #000;
    background-color: #fff;
}
.product-item-collection .product-info{
    display: block;

}
.product-name-collection{
    font-size: 14px;
    font-weight: 500;
    color: #000000;
    line-height: 18px;
    padding-top: 10px;
    display: flex;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    color: var(--colorshophover);
    min-height: 100%;
}
.product-item-collection .product-top {
    position: relative;
    overflow: hidden;

}
.product-item-collection .product-top .product-thumb{
    display: block;
}
.product-item-collection .product-top .product-thumb > a img{
    left: 20;
    top: 0;
    height: 100%;
    object-fit: cover;
    object-position: top;
    display: block;
    z-index: 8;
}
.product-item-collection .product-top .buy-now{
    background-color: white;
    color: white;
    font-size: 13px;
    padding: 5px auto;
    bottom: -50px;
    width: 100%;
    position: absolute;
}
.product-item-collection:hover .buy-now{
    bottom: 0px;
    z-index: 9;
}
.product-item-collection .product-top .buy-now div{
    display: inline;
    
}
.product-item-collection .product-top .buy-now button{
    text-align: center;
    width: 45%;
    margin: 10px auto;
    height: 40px;
    background-color: #000000;
    color: white;
    z-index: 9;     
}
.collection-box{
    display: flex;
    flex-direction: column;
    outline: none;
    padding: 0 15px;
    width: 25%;
    min-height: 100%;
}
.product-item-collection .product-top:hover .dt-width-100.img-hover {
    display: block;
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    object-fit: cover;
    object-position: top;
    z-index: 8;
}
.product-item-collection .product-infor a {
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

.product-item-collection .product-top .product-wishlist {
    position: absolute;
    z-index: 9;
    top: 0px;
    right: 0px;
}
.product-item-collection .product-top .product-wishlist button {
    font-size: 0;
    outline: none;
    border: none;
    background: none;
    width: 35px;
    height: 35px;
}
.wrap-filter {
    border: 1px solid #eee;
    border-radius: 3px;
    background-color: #fff;
    overflow: hidden;
    position: sticky;
    top: calc(var(--height-head) + 10px);
}
.wrap-filter .list-collection{
    padding: 15px;
}
.wrap-filter .list-collection .shop-sidebar {
    padding-bottom: 15px;
}
.wrap-filter .list-collection .shop-sidebar .title {
    font-size: 16px;
    font-weight: 700;
    position: relative;
    margin-bottom: 0;
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
}
    </style>

</head>
<body>
    
</body>
</html>