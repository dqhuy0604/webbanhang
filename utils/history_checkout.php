<?php
    session_start();
    require_once('../database/dbhelper.php');
    require_once('../layout/header.php');
    $user = getUserToken();
    $userId = $user ? $user['id'] : null;
    $phoneNumber = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !$userId) {
        $phoneNumber = getPost('phone_number');
    }
    $orders = [];

    if ($userId) {
        $sql = "select * FROM Orders WHERE user_id = '$userId' ORDER BY order_date DESC";
        $orders = executeResult($sql);
    } elseif ($phoneNumber) {
        $sql = "select * FROM Orders WHERE phone_number = '$phoneNumber' ORDER BY order_date DESC";
        $orders = executeResult($sql);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử đơn hàng</title>
    <style>
        .main {
            padding-top: 150px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }

        .order-history {
            width: 80%;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 50px;
        }

        .order-title {
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .order-title h2 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .order-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-item h3 {
            font-size: 20px;
            color: #333;
        }

        .order-item p {
            margin: 5px 0;
            font-size: 16px;
            color: #555;
        }

        .order-total {
            font-size: 18px;
            font-weight: bold;
            color: #000;
            text-align: right;
        }

        .product-list {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        .product-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-info {
            width: 50%;
            display: flex;
            align-items: center;
        }

        .product-img {
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }

        .product-img img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-name {
            font-size: 16px;
            color: #333;
        }

        .product-price {
            font-size: 16px;
            font-weight: bold;
            color: #000;
        }

        .product-qty {
            font-size: 16px;
            color: #555;
        }

        .order-item p a{
            color:white;
        }

        .status-waiting {
            background-color:pink;
            color: white;
            padding: 4px 15px;
            text-decoration: none;
            font-size: 18px;    
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .status-confirmed {
            background-color: #4caf50;
            color: white;
            padding: 4px 15px;
            text-decoration: none;
            font-size: 18px;    
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .status-shipping {
            background-color: #9e9e9e;
            color: white;
            padding: 4px 15px;
            text-decoration: none;
            font-size: 18px;    
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .status-completed {
            background-color: #03a9f4;
            color:white;
            padding: 4px 15px;
            text-decoration: none;
            font-size: 18px;    
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }
        .show-details-button {
            margin-top:10px;
            background-color: grey;
            color: white;
            border: none; 
            padding: 8px 16px; 
            font-size: 16px; 
            font-weight: bold; 
            border-radius: 5px; 
            cursor: pointer; 
            margin-bottom: 10px; 
            transition: background-color 0.3s ease;
        }

        .show-details-button:hover {
            background-color: #0056b3;
        }

        .product-details {
            display: none;
        }   
    </style>
</head>
<body>
    <?php require_once('../layout/header.php'); ?>

    <div class="main">
        <div class="order-history">
            <div class="order-title">
                <h2>Lịch sử đơn hàng</h2>
            </div>

            <?php if (!$userId && !$phoneNumber) { ?>
                <form method="POST" action="">
                    <label style="font-weight:bold;" for="phone_number">Nhập số điện thoại để kiểm tra lịch sử đơn hàng:</label>
                    <input type="text" id="phone_number" name="phone_number" placeholder="Nhập số điện thoại" required>
                    <button class="show-details-button" type="submit">Tìm kiếm</button>
                </form>
            <?php } ?>
            <?php
            if ($userId || $phoneNumber) {
                if (count($orders) > 0) {
                    foreach ($orders as $order) {
                        $order_id = $order['id'];
                        $sql = "select Order_details.*, Product.title, Product.thumbnail 
                                FROM Order_details 
                                LEFT JOIN Product ON Order_details.product_id = Product.id 
                                WHERE Order_details.order_id = $order_id";
                        $order_details = executeResult($sql);

                        $statusText = '';
                        $statusClass = '';
                        switch ($order['status']) {
                            case 0:
                                $statusText = 'Đang chờ xác nhận';
                                $statusClass = 'status-waiting';
                                break;
                            case 1:
                                $statusText = 'Xác nhận';
                                $statusClass = 'status-confirmed';
                                break;
                            case 2:
                                $statusText = 'Đang giao';
                                $statusClass = 'status-shipping';
                                break;
                            case 3:
                                $statusText = 'Đã giao thành công';
                                $statusClass = 'status-completed';
                                break;
                        }

                        echo '<div class="order-item">';
                        echo '<h3>Đơn hàng #'.$order['id'].'</h3>';
                        echo '<div>Họ và tên:<a style="font-weight:bold;"> '.$order['fullname'].'</a></div>';
                        echo '<div>Email:<a style="font-weight:bold;"> '.$order['email'].'</a></div>';
                        echo '<div>Số điện thoại:<a style="font-weight:bold;"> '.$order['phone_number'].'</a></div>';
                        echo '<div>Địa chỉ:<a style="font-weight:bold;"> '.$order['address'].'</a></div>';
                        echo '<div>Nội dung:<a style="font-weight:bold;"> '.$order['note'].'</a></div>';
                        echo '<div>Ngày đặt hàng:<a style="font-weight:bold;"> '.$order['order_date'].'</a></div>';
                        echo '<p  style="font-weight:bold;">Trạng thái đơn hàng:<a style="font-weight:bold;"> <a class="'.$statusClass.'"> '.$statusText.'</a></p>';

                        echo '<button class="show-details-button" onclick="toggleDetails(\'details-'.$order['id'].'\')">Hiển thị chi tiết sản phẩm</button>';
                        echo '<div id="details-'.$order['id'].'" class="product-details">';
                        if (count($order_details) > 0) {
                            echo '<h4>Chi tiết sản phẩm:</h4>';
                            foreach ($order_details as $detail) {
                                echo '<div class="product-item">
                                        <div class="product-info">
                                            <div class="product-img"><img src="../'.$detail['thumbnail'].'" alt="'.$detail['title'].'"></div>
                                            <div class="product-name">'.$detail['title'].'</div>
                                        </div>
                                        <div class="product-qty">Số lượng : '.$detail['num'].'</div>
                                        <div class="product-price">'.number_format($detail['price']).'₫</div>
                                      </div>';
                            }
                        }
                        echo '</div>'; 
                        echo '<p class="order-total">Tổng cộng: '.number_format($order['total_money']).'₫</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p style="font-weight:bold;">Không tìm thấy đơn hàng nào với số điện thoại: ' . $phoneNumber . '</p>';
                    echo '<form method="POST" action="">
                            <label for="phone_number">Nhập lại số điện thoại:</label>
                            <input type="text" id="phone_number" name="phone_number" placeholder="Nhập số điện thoại mới" required>
                            <button class="show-details-button" type="submit">Tìm kiếm</button>
                          </form>';
                }
            }
            ?>
        </div>
    </div>

    <?php require_once('../layout/footer.php'); ?>

    <script>
        function toggleDetails(id) {
            var element = document.getElementById(id);
            if (element.style.display === 'none' || element.style.display === '') {
                element.style.display = 'block';
            } else {
                element.style.display = 'none';
            }
        }
    </script>
</body>
</html>



