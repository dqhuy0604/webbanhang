<?php
session_start();
require_once('../database/dbhelper.php');
require_once('../layout/header.php');

// Lấy ID của đơn hàng từ URL
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;

if ($order_id) {
    // Truy vấn chi tiết đơn hàng
    $sql = "SELECT Order_details.*, Product.title, Product.thumbnail 
            FROM Order_details 
            LEFT JOIN Product ON Order_details.product_id = Product.id 
            WHERE Order_details.order_id = $order_id";
    $order_details = executeResult($sql);

    // Truy vấn thông tin tổng quan của đơn hàng
    $sql = "SELECT * FROM Orders WHERE id = $order_id";
    $order = executeResult($sql, true);
} else {
    echo 'Không tìm thấy đơn hàng!';
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng #<?php echo $order_id; ?></title>
    <style>
        .main {
            display: flex;
            justify-content: center;
            padding-top: 150px;
        }

        .order-container {
            display: flex;
            width: 80%;
            max-width: 1200px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            margin-bottom: 100px;
        }
        .order-details {
            width: 70%;
            padding: 20px;
        }

        .order-summary {
            width: 30%;
            padding: 20px;
            border-left: 1px solid #ddd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        .order-title h2 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="order-container">
            <div class="order-details">

                <h3>Danh sách sản phẩm</h3>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($order_details) > 0) {
                            foreach ($order_details as $detail) {
                                echo '<tr>';
                                echo '<td><img src="../'.$detail['thumbnail'].'" alt="'.$detail['title'].'" width="50" height="50"></td>';
                                echo '<td>'.$detail['title'].'</td>';
                                echo '<td>'.$detail['num'].'</td>';
                                echo '<td>'.number_format($detail['price']).'₫</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="4">Không có sản phẩm nào trong đơn hàng này.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="order-summary">
                <h3>Tổng quan đơn hàng</h3>
                <p><strong>Họ và tên:</strong> <?php echo $order['fullname']; ?></p>
                <p><strong>Email:</strong> <?php echo $order['email']; ?></p>
                <p><strong>Số điện thoại:</strong> <?php echo $order['phone_number']; ?></p>
                <p><strong>Địa chỉ:</strong> <?php echo $order['address']; ?></p>
                <p><strong>Ngày đặt hàng:</strong> <?php echo $order['order_date']; ?></p>
                <p><strong>Nội dung:</strong> <?php echo $order['note']; ?></p>
                <p><strong>Tổng tiền:</strong> <?php echo number_format($order['total_money']); ?>₫</p>

                <h4>Trạng thái đơn hàng:</h4>
                <?php
                $statusText = '';
                switch ($order['status']) {
                    case 0:
                        $statusText = 'Đang chờ xác nhận';
                        break;
                    case 1:
                        $statusText = 'Xác nhận';
                        break;
                    case 2:
                        $statusText = 'Đang giao';
                        break;
                    case 3:
                        $statusText = 'Đã giao thành công';
                        break;
                }
                echo '<p style="color:red; font-weight:bold;">'.$statusText.'</p>';
                ?>
            </div>
        </div>
    </div>

    <?php require_once('../layout/footer.php'); ?>
</body>
</html>
