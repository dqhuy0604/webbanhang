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
            width: 90%;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .status-waiting {
            background-color: pink;
            color: white;
            padding: 4px 15px;
            border-radius: 5px;
            text-align: center;
        }

        .status-confirmed {
            background-color: #4caf50;
            color: white;
            padding: 4px 15px;
            border-radius: 5px;
            text-align: center;
        }

        .status-shipping {
            background-color: #9e9e9e;
            color: white;
            padding: 4px 15px;
            border-radius: 5px;
            text-align: center;
        }

        .status-completed {
            background-color: #03a9f4;
            color: white;
            padding: 4px 15px;
            border-radius: 5px;
            text-align: center;
        }
        tr{
            width:30px;
        }

        .show-details-button {
            background-color: grey;
            color: white;
            border: none;
            padding: 8px 16px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .show-details-button:hover {
            background-color: #0056b3;
        }

        .product-details {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <?php require_once('../layout/header.php'); ?>

    <div class="main">
        <div class="order-history">
            <h2>Lịch sử đơn hàng</h2>

            <?php if (!$userId && !$phoneNumber) { ?>
                <form method="POST" action="">
                    <label style="font-weight:bold;" for="phone_number">Nhập số điện thoại để kiểm tra lịch sử đơn hàng:</label>
                    <input type="text" id="phone_number" name="phone_number" placeholder="Nhập số điện thoại" required>
                    <button class="show-details-button" type="submit">Tìm kiếm</button>
                </form>
            <?php } ?>

            <?php if ($userId || $phoneNumber) { ?>
                <?php if (count($orders) > 0) { ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Đơn hàng</th>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Nội dung</th>
                                <th>Ngày đặt hàng</th>
                                <th>Trạng thái</th>
                                <th>Tổng cộng</th>
                                <th>Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order) {
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
                                echo '<tr>';
                                echo '<td>#' . $order['id'] . '</td>';
                                echo '<td>' . $order['fullname'] . '</td>';
                                echo '<td>' . $order['email'] . '</td>';
                                echo '<td>' . $order['phone_number'] . '</td>';
                                echo '<td>' . $order['address'] . '</td>';
                                echo '<td>' . $order['note'] . '</td>';
                                echo '<td>' . $order['order_date'] . '</td>';
                                echo '<td style="width:200px;"><span class="' . $statusClass . '">' . $statusText . '</span></td>';
                                echo '<td style="font-weight:bold;">' . number_format($order['total_money']) . '₫</td>';
                                echo '<td  style="width:300px;"><a href="history_detail.php?order_id=' . $order['id'] . '" class="show-details-button">Hiển thị chi tiết sản phẩm</a></td>';
                                echo '</tr>';
                            } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p style="font-weight:bold;">Không tìm thấy đơn hàng nào với số điện thoại: <?php echo $phoneNumber; ?></p>
                    <form method="POST" action="">
                        <label for="phone_number">Nhập lại số điện thoại:</label>
                        <input type="text" id="phone_number" name="phone_number" placeholder="Nhập số điện thoại mới" required>
                        <button class="show-details-button" type="submit">Tìm kiếm</button>
                    </form>
                <?php } ?>
            <?php } ?>
        </div>
    </div>

    <?php require_once('../layout/footer.php'); ?>
</body>
</html>
