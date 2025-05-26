<?php
ob_start();
$title = 'Chi tiết đơn hàng';
$baseUrl = '../';

require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

$user = getUserToken(); // Lấy thông tin người dùng đăng nhập

$orderId = getGet('id');
if (!is_numeric($orderId)) {
    echo '<div class="alert alert-danger mt-5">ID đơn hàng không hợp lệ</div>';
    require_once('../layouts/footer.php');
    die();
}

// Xử lý cập nhật trạng thái
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newStatus = getPost('status_id');
    if (is_numeric($newStatus)) {
        execute("UPDATE orders SET status_id = $newStatus WHERE id = $orderId");
        $adminId = $user['id'] ?? 0;
        $now = date('Y-m-d H:i:s');
        execute("INSERT INTO order_log(order_id, status_id, updated_by, created_at) VALUES ($orderId, $newStatus, $adminId, '$now')");
        header('Location: detail.php?id=' . $orderId);
        die();
    }
}

require_once('../layouts/header.php');

// Lấy thông tin đơn hàng
$order = executeResult("
    SELECT o.*, 
           u.fullname AS customer_name, u.email, u.phone_number,
           st.name AS status_name,
           p.name AS payment_name,
           s.name AS shipping_name
    FROM orders o
    LEFT JOIN user u ON o.user_id = u.id
    LEFT JOIN order_status st ON o.status_id = st.id
    LEFT JOIN payment_method p ON o.payment_method_id = p.id
    LEFT JOIN shipping_method s ON o.shipping_method_id = s.id
    WHERE o.id = $orderId
", true);

if (!$order) {
    echo '<div class="alert alert-danger">Đơn hàng không tồn tại</div>';
    require_once('../layouts/footer.php');
    die();
}

$items = executeResult("
    SELECT od.*, pr.title, pr.thumbnail 
    FROM order_details od 
    JOIN product pr ON od.product_id = pr.id 
    WHERE od.order_id = $orderId
");

$statusList = executeResult("SELECT * FROM order_status");
?>

<div class="container mt-4">
    <h3 class="mb-4" style="margin-top:70px;">Chi tiết đơn hàng #<?= $orderId ?></h3>

    <h5>Thông tin khách hàng</h5>
    <p><strong>Họ tên:</strong> <?= $order['customer_name'] ?></p>
    <p><strong>Email:</strong> <?= $order['email'] ?></p>
    <p><strong>SĐT:</strong> <?= $order['phone_number'] ?></p>

    <h5>Thông tin đơn hàng</h5>
    <p><strong>Ngày đặt:</strong> <?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></p>
    <p><strong>Phương thức thanh toán:</strong> <?= $order['payment_name'] ?></p>
    <p><strong>Phương thức giao hàng:</strong> <?= $order['shipping_name'] ?></p>
    <p class="order-status"><strong>Trạng thái:</strong> <?= $order['status_name'] ?></p>

    <form method="post" class="form-inline mt-2 mb-3">
        <label class="mr-2">Cập nhật trạng thái:</label>
        <select name="status_id" class="form-control mr-2">
            <?php
            foreach ($statusList as $st) {
                $selected = $st['id'] == $order['status_id'] ? 'selected' : '';
                echo "<option value='{$st['id']}' $selected>{$st['name']}</option>";
            }
            ?>
        </select>
        <button class="btn btn-primary"><i class="bi bi-check-circle"></i> Lưu</button>
    </form>

    <h5>Sản phẩm đã mua</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($items as $item) {
                echo "<tr>
                        <td><img src='" . fixUrl($item['thumbnail']) . "' style='height:80px'></td>
                        <td>{$item['title']}</td>
                        <td>" . number_format($item['price']) . "đ</td>
                        <td>{$item['num']}</td>
                        <td>" . number_format($item['total_money']) . "đ</td>
                    </tr>";
            }
            
            ?>
        </tbody>
    </table>

    <p class="order-total">Tổng tiền: <?= number_format($order['total_money']) ?>đ</p>
    <a href="index.php" class="btn btn-secondary"><i class="bi bi-arrow-left-circle"></i> Quay lại</a>

    <h5>Lịch sử cập nhật trạng thái</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Thời gian</th>
                <th>Trạng thái</th>
                <th>Người cập nhật</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $logs = executeResult("
                SELECT l.*, s.name AS status_name, u.fullname AS admin_name
                FROM order_log l
                LEFT JOIN order_status s ON l.status_id = s.id
                LEFT JOIN user u ON l.updated_by = u.id
                WHERE l.order_id = $orderId
                ORDER BY l.created_at DESC
            ");

            if (!empty($logs)) {
                foreach ($logs as $log) {
                    echo "<tr>
                            <td>" . date('d/m/Y H:i', strtotime($log['created_at'])) . "</td>
                            <td>{$log['status_name']}</td>
                            <td>{$log['admin_name']}</td>
                        </tr>";
                }
            } else {
                echo '<tr><td colspan="3" class="text-center text-muted">Chưa có thay đổi trạng thái nào.</td></tr>';
            }
                ob_end_flush();
            ?>
        </tbody>
    </table>
</div>

<?php require_once('../layouts/footer.php'); ?>
<style>
    h3 {
        font-weight: bold;
        font-size: 26px;
        color: #343a40;
    }
    h5 {
        font-weight: 600;
        margin-top: 25px;
    }
    .order-status {
        font-size: 18px;
        font-weight: bold;
        color: #007bff;
    }
    .order-total {
        font-size: 20px;
        font-weight: bold;
        color:red;
        margin-top: 20px;
    }
    .table {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
    }
    .table th {
        background-color: #f8f9fa;
    }
</style>
