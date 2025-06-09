<?php
session_start();
require_once('utility.php');
require_once('../database/dbhelper.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <?php require_once('../assets/css/cssdanhsachsanpham.php'); ?>
    <style>
        .main { padding-top: 150px; }
        .cart-product { background-color: #f9f9f9; border: 1px solid #ddd; padding: 30px; border-radius: 8px; margin-bottom: 20px; width: 100%; margin-left: auto; margin-right: auto; }
        .cart-title { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 15px; margin-bottom: 15px; }
        .cart-title h2 { font-size: 24px; font-weight: bold; color: #333; }
        .cart-count { font-size: 18px; color: #888; }
        .item-wrap { list-style: none; padding: 0; margin: 0; }
        .cart-wrap { display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid #eee; flex-wrap: wrap; }
        .item-info { width:50%; display: flex; align-items: center; }
        .item-img { width: 100px; height: 100px; overflow: hidden; border-radius: 8px; margin-right: 15px; }
        .item-img img { width: 100%; height: auto; object-fit: cover; }
        .item-title { flex-grow: 1; }
        .item-title a { font-size: 16px; color: #333; font-weight: 500; text-decoration: none; display: block; margin-bottom: 5px; }
        .item-option { font-size: 14px; color: #666; }
        .item-price .money { font-size: 18px; font-weight: bold; color: #000; }
        .item-price del { font-size: 14px; color: #999; margin-left: 10px; }
        .quantity-area-cartmini { display: flex; align-items: center; }
        .qty-btn { background-color: #e0e0e0; border: none; padding: 8px 12px; cursor: pointer; font-size: 16px; color: #333; border-radius: 4px; }
        .quantity-mini { width: 40px; text-align: center; border: 1px solid #ddd; margin: 0 5px; border-radius: 4px; }
        .item-remove { margin-left: 20px; }
        .remove-wrap a { color: #d9534f; font-size: 14px; text-decoration: none; cursor: pointer; }
        .full-price, .checkout-wrap { display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd; padding-bottom:50px; flex-wrap: wrap; }
        .total-price { font-size: 20px; color: #333; }
        .checkout-btn { text-decoration: none; background-color: #000; color: #fff; padding: 15px 30px; font-size: 18px; font-weight: bold; border-radius: 5px; cursor: pointer; text-align: center; margin: 10px 0; }
        .full-price { font-size: 18px; font-weight: bold; color: #000; }
    </style>
</head>
<body>
<?php require_once('../layout/header.php'); ?>
<div class="main" style="padding-top:30px;">
    <div class="container-01" >                         
        <div class="cart-product" >
            <div class="cart-title" >
                <h2>Giỏ hàng</h2>
            </div>
     
        <?php
            if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
                echo '<p>Không có sản phẩm nào trong giỏ hàng.</p>';
                echo '<button onclick="location.href=\'history_checkout.php\'" class="button button_detail" style="width:200px;"><span>Lịch sử đặt hàng</span></button>';
            } else {
                $totalPrice = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $itemTotal = $item['discount'] * $item['num'];
                    $totalPrice += $itemTotal;
                    echo '<div class="item-wrap" id="cart-page-result">
                            <ul class="cart-wrap" data-line="1">
                                <li class="item-info">
                                    <div class="item-img">
                                        <a href="#">
                                            <img src="../' . $item['thumbnail'] . '" alt="' . $item['title'] . '">
                                        </a>
                                    </div>
                                    <div class="item-title">
                                        <a>' . $item['title'] . '</a>
                                            <strong>Size:</strong> ' . htmlspecialchars($item['size']) . '<br>
                                        <span class="item-option">
                                            <span class="item-price">
                                                <span class="money">' . number_format($item['discount']) . 'đ</span>
                                                <del data-compare="0₫">' . number_format($item['price']) . 'đ</del>
                                            </span>
                                        </span>
                                    </div>
                                </li>
                                <li class="item-qty">
                                    <div class="quantity-area-cartmini">
                                        <button type="button" onclick="addMoreCart(' . $item['id'] . ',-1)" class="qty-btn">-</button>
                                        <input type="number" id="num_' . $item['id'] . '" value="' . $item['num'] . '" class="quantity-mini" onchange="fixCartNum(' . $item['id'] . ')">
                                        <button type="button" onclick="addMoreCart(' . $item['id'] . ',1)" class="qty-btn">+</button>
                                    </div>
                                    <div class="item-remove">
                                        <span class="remove-wrap"><a href="#" onclick="updateCart(' . $item['id'] . ',0); return false;">Xóa</a></span>
                                    </div>
                                </li>
                                <li class="item-price">
                                    <span class="amount full-price">
                                        <span class="money">' . number_format($itemTotal) . 'đ</span>
                                    </span>
                                </li>
                            </ul>
                        </div>';
                }
            ?>
            <div style=" text-align: right;font-size: 1.6em;font-weight: bold;margin-top: 20px;" ><h1 class="total-price">Tổng cộng: <span class="money" style="font-weight:bold;"><?= number_format($totalPrice) ?>₫</span></h1></div>
        </div>
        <div class="full-price">
            <button  onclick="location.href='history_checkout.php'"  class="button button_detail" style="width:400px;" ><span>Lịch sử đặt hàng</span></button>    
            <button  onclick="location.href='checkout.php'"  class="button button_detail" style="width:400px;" ><span>Thanh toán</span></button>
        </div>
        <?php } ?>
    </div>
</div>
<?php require_once('../layout/footer.php'); ?>
<script type="text/javascript">
    function addMoreCart(id, delta) {
        let num = parseInt(document.getElementById('num_' + id).value);
        num += delta;
        if (num < 1) num = 1;
        document.getElementById('num_' + id).value = num;
        updateCart(id, num);
    }
    function fixCartNum(id) {
        let value = parseInt(document.getElementById('num_' + id).value);
        if (isNaN(value) || value < 1) value = 1;
        document.getElementById('num_' + id).value = value;
        updateCart(id, value);
    }
    function updateCart(productId, num) {
        fetch('../api/ajax_request.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ action: 'update_cart', id: productId, num: num })
        }).then(() => location.reload());
    }
</script>
</body>
</html>
