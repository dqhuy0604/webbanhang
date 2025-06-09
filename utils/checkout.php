<?php
    session_start();
    require_once('utility.php');
    require_once('../database/dbhelper.php');
    require_once('../layout/header.php');       
    $category_id=getGet('id');
    $id = intval(getPost('id'));
    $sql ="select Product.*, Category.name as category_name from Product left join Category on Product.category_id = Category.id
             and Product.deleted=0 order by Product.updated_at desc  ";
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
    <div class="main" style="padding-top: 20px;">
        <div class="customer-info">
            <div class="customer-title">
                <h2>Thông tin khách hàng</h2>
            </div>
            <form method="POST" class="checkout-form" onsubmit="return completeCheckout();">
                <div class="form-group">
                    <input type="text" placeholder="Họ và Tên" id="name" name="fullname_tt" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="email" placeholder="Email" id="email_tt" name="email_tt" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Số điện thoại" id="phone_number" name="phone_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Địa chỉ" id="address" name="address" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="shipping_method">Phương thức vận chuyển:</label>
                    <select name="shipping_method_id" id="shipping_method" class="form-control" required>
                        <option value="">-- Chọn phương thức vận chuyển --</option>
                        <option value="1">Giao hàng tiêu chuẩn</option>
                        <option value="2">Giao hàng nhanh</option>
                        <option value="3">Lấy tại cửa hàng</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="payment_method">Phương thức thanh toán:</label>
                    <select name="payment_method_id" id="payment_method" class="form-control" required>
                        <option value="">-- Chọn phương thức thanh toán --</option>
                        <option value="1">Thanh toán khi nhận hàng (COD)</option>
                        <option value="2">Chuyển khoản ngân hàng</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="note">Nội dung:</label>
                    <textarea id="note" name="note" class="form-control" rows="4"></textarea>
                </div>

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
                                    <a >'.$item['title'].'</a>
                                    <strong>Size:</strong> ' . htmlspecialchars($item['size']) .'<br>
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
        var shipping_method_id = $('[name=shipping_method_id]').val();
        var payment_method_id = $('[name=payment_method_id]').val();
        if (!shipping_method_id || !payment_method_id) {
            alert("Vui lòng chọn phương thức vận chuyển và thanh toán.");
            return false;
        }
        $.post('../api/ajax_request.php', {
            'action': 'checkout',
            'fullname': $('[name=fullname_tt]').val(),
            'email': email,
            'phone_number': phoneNumber,
            'address': $('[name=address]').val(),
            'note': $('[name=note]').val(),
            'shipping_method_id': shipping_method_id,
            'payment_method_id': payment_method_id
        }, function(data) {
            window.open('history_checkout.php', '_self');
        });
        return false;
    }
    </script>
    <style>
    .checkout-form {
        display: flex;
        flex-direction: column;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom:0px;
    }

    .form-group label {
        font-size: 16px;
        font-weight: 500;
        color: #333;
    }

    .form-control {
        font-size: 16px;
        border-radius: 6px;
        border: 1px solid #ccc;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 3px #007bff55;
    }

    .checkout-btn {
        background-color: #000;
        color: #fff;
        padding: 15px;
        font-size: 18px;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .checkout-btn:hover {
        background-color: #333;
    }

    </style>
</body>
</html>
