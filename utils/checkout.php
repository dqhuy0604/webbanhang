<?php
    session_start();
    require_once('utility.php');
    require_once('../database/dbhelper.php');
    require_once('../layout/header.php');       
    $category_id=getGet('id');
    $sql ="select Product.*, Category.name as category_name from Product left join Category on Product.category_id = Category.id
            where Product.category_id = $category_id and Product.deleted=0 order by Product.updated_at desc  ";
    $categoryItems = executeResult($sql);
?>    <!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <?php
        require_once('../assets/css/cssdanhsachsanpham.php');   
    ?>
    <style>
        .main {
            padding-top: 150px;
            display: flex;
            justify-content: space-between;
        }

        .cart-product {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 30px; 
            border-radius: 8px;
            width: 50%;
            margin-bottom: 50px;
        }

        .customer-info {
            width: 45%;
            padding: 30px;
            background-color: #f1f1f1;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-left:60px;
            margin-bottom:80px;
        }

        .cart-title, .customer-title {
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .cart-title h2, .customer-title h2 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .item-wrap {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .cart-wrap {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .item-info {
            width: 60%;
            display: flex;
            align-items: center;
        }

        .item-img {
            width: 100px; 
            height: 100px;
            overflow: hidden;
            border-radius: 8px;
            margin-right: 15px;
        }

        .item-img img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .item-title {
            flex-grow: 1;
        }

        .item-title a {
            font-size: 16px;
            color: #333;
            font-weight: 500;
            text-decoration: none;
            display: block;
            margin-bottom: 5px;
        }

        .item-option {
            font-size: 14px;
            color: #666;
        }

        .item-price .money {
            font-size: 18px;
            font-weight: bold;
            color: #000;
        }

        .quantity-area-cartmini {
            display: flex;
            align-items: center;
        }

        .quantity-mini {
            width: 40px;
            text-align: center;
            border: 1px solid #ddd;
            margin: 0 5px;
            border-radius: 4px;
        }

        .full-price {
            font-size: 30px;
            font-weight: bold;
            color: #000;
            text-align: center;
        }

        .checkout-btn{
            background-color: #000;
            color: #fff;
            padding: 15px 30px;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .customer-info form {
            display: flex;
            flex-direction: column;
        }

        .customer-info label {
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
        }

        .customer-info input, .customer-info textarea {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            color: #333;
            width: 100%;
            box-sizing: border-box;
        }

        .customer-info textarea {
            resize: vertical;
            min-height: 100px;
        }
    </style>
</head>
<body>  
    <?php   
        require_once('../layout/header.php'); 
    ?>
    <div class="main">
        <div class="customer-info">
            <div class="customer-title">
                <h2>Thông tin khách hàng</h2>
            </div>
            <form  method="POST" onsubmit="return completeCheckout();">     
                <input type="text" placeholder="Họ và Tên" id="name" name="fullname_tt" required >
                <input type="email" placeholder="Email" id="email_tt" name="email_tt" required>
                <input type="text" placeholder="Số điện thoại" id="phone_number" name="phone_number" required>
                <input type="text" placeholder="Địa chỉ" id="address" name="address" required>
                <label for="note">Nội dung:</label>
                <textarea id="note" name="note"></textarea>

                <button type="submit" class="checkout-btn">Thanh toán</button>
            </form>
        </div>
        <div class="cart-product">
            <div class="cart-title">
                <h2>Giỏ hàng:</h2>
            </div>
            <?php
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart']=[];
            }
            $index = 0;
            $totalPrice = 0;
            foreach($_SESSION['cart'] as $item){
                $itemTotal = $item['discount'] * $item['num'];
                $totalPrice += $itemTotal; 
                echo '
                    <div class="item-wrap" id="cart-page-result">
                        <ul class="cart-wrap" data-line="1">
                            <li class="item-info">
                                <div class="item-img">
                                    <a href="#">
                                        <img src="../'.$item['thumbnail'].'" alt="'.$item['title'].'">
                                    </a>
                                </div>
                                <div class="item-title">
                                    <a href="#">'.$item['title'].'</a>
                                    <span class="item-option">
                                        <span class="item-price">
                                            <span class="money">'.number_format($item['discount']).'đ</span>
                                            <del data-compare="0₫">'.$item['price'].'đ</del>
                                        </span>
                                    </span>
                                </div>
                            </li>
                            <li class="item-qty">
                                <div class="quantity-area-cartmini">
                                    <a type="number" id="num_'.$item['id'].'" value="'.$item['num'].'" class="quantity-mini">'.$item['num'].'</a>
                                </div>
                            </li>
                            <li class="item-price">
                                <span class="amount full-price">
                                    <span class="money">'.number_format($item['discount']*$item['num']).'đ</span>
                                </span>
                            </li>
                        </ul>
                    </div>';
            }
            ?>
            <div class="full-price">
                <span class="total-price">Tổng cộng: <span class="money" style="font-weight:bold;"><?php echo number_format($totalPrice); ?>₫</span></span>
            </div>  
        </div>
    </div>
    <?php
        require_once('../layout/footer.php');
    ?>
    <script>
    function isValidEmail(email) {
        var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return regex.test(email);
    }
    function isValidPhoneNumber(phoneNumber) {
    var regex = /^[0-9]{10}$/;
    return regex.test(phoneNumber);
    }
    function completeCheckout() {
        var email = $('[name=email_tt]').val();
        var phoneNumber = $('[name=phone_number]').val();
        if (!isValidEmail(email)) {
            alert("Email không hợp lệ. Vui lòng nhập lại email đúng định dạng.");
            return false;
        }
        if (!isValidPhoneNumber(phoneNumber)) {
        alert("Số điện thoại phải bao gồm đúng 10 chữ số.");
        return false;
        }
        $.post('../api/ajax_request.php', {
            'action': 'checkout',
            'fullname': $('[name=fullname_tt]').val(),
            'email': email,
            'phone_number': $('[name=phone_number]').val(),
            'address': $('[name=address]').val(),
            'note': $('[name=note]').val(),
        }, function(data) {
            window.open('history_checkout.php', '_self');
        });
        return false;
    }


    </script>
</body>
</html>
