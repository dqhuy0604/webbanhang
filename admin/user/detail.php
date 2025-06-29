<?php
$title = 'Chi Tiết Người Dùng';
$baseUrl = '../';
require_once(__DIR__.'/../../utils/utility.php');
require_once('../../database/dbhelper.php');
require_once('../layouts/header.php');

$userId = getGet('id');
$user = executeResult("SELECT u.*, r.name AS role_name FROM user u LEFT JOIN role r ON u.role_id = r.id WHERE u.id = $userId AND u.deleted = 0", true);
if (!$user) {
    echo "<div class='alert alert-danger mt-5'>Người dùng không tồn tại</div>";
    require_once('../layouts/footer.php');
    die();
}

$orders = executeResult("SELECT * FROM orders WHERE user_id = $userId ORDER BY order_date DESC");

$totalSpent = executeResult("SELECT SUM(total_money) AS total FROM orders WHERE user_id = $userId AND status_id = 4", true)['total'] ?? 0;
?>

<div class="container mt-4" style="padding-top:60px;">
    <h3>Chi tiết người dùng</h3>
    <p><strong>Họ tên:</strong> <?=$user['fullname']?></p>
    <p><strong>Email:</strong> <?=$user['email']?></p>
    <p><strong>SĐT:</strong> <?=$user['phone_number']?></p>
    <p><strong>Vai trò:</strong> <?=$user['role_name']?></p>
    <p><strong>Tổng chi tiêu:</strong> <?=number_format($totalSpent)?> đ</p>

    <h5 class="mt-4">Lịch sử đơn hàng</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Tổng tiền</th>
                <th>Xem</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?=date('d/m/Y H:i', strtotime($order['order_date']))?></td>
                    <td>
                        <?php
                        $status = executeResult("SELECT name FROM order_status WHERE id = ".$order['status_id'], true);
                        echo $status['name'] ?? '---';
                        ?>
                    </td>
                    <td><?=number_format($order['total_money'])?> đ</td>
                    <td><a href="../order/detail.php?id=<?=$order['id']?>" class="btn btn-sm btn-info">Xem</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary">Quay lại</a>
</div>

<?php require_once('../layouts/footer.php'); ?>
