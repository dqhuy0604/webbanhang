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
    <title>Danh sách yêu thích</title>
    <?php require_once('../assets/css/cssdanhsachsanpham.php'); ?>
    <style>
        .main { padding-top: 150px; }
        .wishlist-product { background-color: #f9f9f9; border: 1px solid #ddd; padding: 30px; border-radius: 8px; margin-bottom: 20px; width: 100%; margin-left: auto; margin-right: auto; }
        .wishlist-title { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 15px; margin-bottom: 15px; }
        .wishlist-title h2 { font-size: 24px; font-weight: bold; color: #333; }
        .wishlist-count { font-size: 18px; color: #888; }
        .item-wrap { list-style: none; padding: 0; margin: 0; }
        .wishlist-wrap { display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid #eee; flex-wrap: wrap; }
        .item-info { width: 60%; display: flex; align-items: center; }
        .item-img { width: 100px; height: 100px; overflow: hidden; border-radius: 8px; margin-right: 15px; }
        .item-img img { width: 100%; height: auto; object-fit: cover; }
        .item-title { flex-grow: 1; }
        .item-title a { font-size: 16px; color: #333; font-weight: 500; text-decoration: none; display: block; margin-bottom: 5px; }
        .item-title a:hover { text-decoration: none; color:pink;}
        .item-title a:visited { text-decoration: none; }
        .item-title a:active { text-decoration: none; }
        .item-title a:focus { text-decoration: none; outline: none; }
        .item-price .money { font-size: 18px; font-weight: bold; color: #000; }
        .item-price del { font-size: 14px; color: #999; margin-left: 10px; }
        .item-actions { display: flex; gap: 10px; align-items: center; }
        .btn-add-cart, .btn-remove { padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; text-decoration: none; text-align: center; }
        .btn-add-cart { background-color: #007bff; color: white; }
        .btn-add-cart:hover { background-color: #0056b3; }
        .btn-remove { background-color: #dc3545; color: white; }
        .btn-remove:hover { background-color: #c82333; }
        .empty-wishlist { text-align: center; padding: 50px 0; }
        .empty-wishlist img { width: 100px; height: 100px; opacity: 0.5; margin-bottom: 20px; }
        .empty-wishlist p { font-size: 18px; color: #666; margin-bottom: 20px; }
        .btn-continue-shopping { background-color: #000; color: #fff; padding: 12px 24px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; text-decoration: none; }
        .btn-continue-shopping:hover { background-color: #333; }
        .navigation-buttons { text-align: center; margin-top: 30px; }
        .navigation-buttons button { margin-right: 15px; }
    </style>
</head>
<body>
<?php require_once('../layout/header.php'); ?>
<div class="main" style="padding-top:30px;">
    <div class="container-01">                         
        <div class="wishlist-product">
            <div class="wishlist-title">
                <h2>Danh sách yêu thích</h2>
                <span class="wishlist-count">
                    <?= isset($_SESSION['wishlist']) ? count($_SESSION['wishlist']) : 0 ?> sản phẩm
                </span>
            </div>
     
        <?php
            if (!isset($_SESSION['wishlist']) || count($_SESSION['wishlist']) == 0) {
                echo '
                <div class="empty-wishlist">
                        <img src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Empty wishlist">
                        <p>Danh sách yêu thích của bạn đang trống.</p>
                        <button class="btn-continue-shopping" onclick="location.href=\'../index.php\'">Tiếp tục mua sắm</button>
                      </div>';
            } else {
                foreach ($_SESSION['wishlist'] as $item) {
                    echo '<div class="item-wrap">
                            <ul class="wishlist-wrap" data-id="' . $item['id'] . '">
                                <li class="item-info">
                                    <div class="item-img">
                                        <a href="../utils/detail.php?id=' . $item['id'] . '">
                                            <img src="../' . $item['thumbnail'] . '" alt="' . $item['title'] . '">
                                        </a>
                                    </div>
                                    <div class="item-title">
                                        <a href="../utils/detail.php?id=' . $item['id'] . '">' . $item['title'] . '</a>
                                        <span class="item-price">
                                            <span class="money">' . number_format($item['discount']) . 'đ</span>';
                    
                    if ($item['discount'] < $item['price']) {
                        echo '<del>' . number_format($item['price']) . 'đ</del>';
                    }
                    
                    echo '      </span>
                                    </div>
                                </li>
                                <li class="item-actions">
                                    <button class="btn-add-cart" onclick="addToCartFromWishlist(' . $item['id'] . ')">
                                        Thêm vào giỏ hàng
                                    </button>
                                    <button class="btn-remove" onclick="removeFromWishlist(' . $item['id'] . ')">
                                        Xóa
                                    </button>
                                </li>
                            </ul>
                        </div>';
                }
            ?>
            <div class="navigation-buttons">
                <button class="btn-continue-shopping" onclick="location.href='../utils/cart.php'">Xem giỏ hàng</button>
                <button class="btn-continue-shopping" onclick="location.href='../utils/index.php'">Tiếp tục mua sắm</button>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php require_once('../layout/footer.php'); ?>

<script type="text/javascript">
    function removeFromWishlist(productId) {
        if (!confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi danh sách yêu thích?')) {
            return;
        }
        
        fetch('../api/ajax_request.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ 
                action: 'remove_from_wishlist', 
                id: productId 
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Cập nhật số lượng wishlist trong header
                updateWishlistCount();
                // Reload trang để cập nhật danh sách
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra, vui lòng thử lại!');
        });
    }

    function addToCartFromWishlist(productId) {
        // Giả sử thêm variant_id mặc định = 1, bạn có thể điều chỉnh theo logic của mình
        fetch('../api/ajax_request.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ 
                action: 'cart', 
                id: productId,
                num: 1,
                variant_id: 1  // Cần điều chỉnh theo logic variant
            })
        })
        .then(() => {
            alert('Đã thêm sản phẩm vào giỏ hàng!');
            // Cập nhật số lượng cart nếu cần
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra, vui lòng thử lại!');
        });
    }

    function updateWishlistCount() {
        fetch('../api/ajax_request.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ action: 'get_wishlist_count' })
        })
        .then(response => response.json())
        .then(data => {
            const countElement = document.getElementById('wishlist-count');
            if (countElement) {
                countElement.textContent = data.count;
            }
        })
        .catch(error => console.error('Error updating wishlist count:', error));
    }
</script>
</body>
</html>