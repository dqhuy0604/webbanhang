<?php
$title = 'Quản Lý Đơn Hàng';
$baseUrl = '../';
require_once('../layouts/header.php');

$sql = "SELECT o.*, 
               u.fullname AS customer_name,
               s.name AS shipping_method,
               p.name AS payment_method,
               st.name AS status_name
        FROM orders o
        LEFT JOIN user u ON o.user_id = u.id
        LEFT JOIN shipping_method s ON o.shipping_method_id = s.id
        LEFT JOIN payment_method p ON o.payment_method_id = p.id
        LEFT JOIN order_status st ON o.status_id = st.id
        ORDER BY o.order_date DESC";


$data = executeResult($sql);    
?>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
        <h3 style="margin-top: 50px; font-weight: bold;">Quản Lý Đơn Hàng</h3>

        <table class="table table-bordered table-hover mt-3">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã Đơn</th>
                    <th>Khách hàng</th>
                    <th>Ngày tạo</th>
                    <th>Thanh toán</th>
                    <th>Vận chuyển</th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền</th>
                    <th style="width: 80px;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = 0;
                if (!empty($data)) {
                foreach ($data as $item) {
                    echo '<tr>
                            <td>' . (++$index) . '</td>
                            <td>#' . $item['id'] . '</td>
                            <td>' . $item['fullname'] . '</td>
                            <td>' . date('d/m/Y H:i', strtotime($item['order_date'])) . '</td>
                            <td>' . $item['payment_method'] . '</td>
                            <td>' . $item['shipping_method'] . '</td>
                            <td>' . $item['status_name'] . '</td>
                            <td>' . number_format($item['total_money']) . 'đ</td>
                            <td>
                                <a href="detail.php?id=' . $item['id'] . '">
                                    <button class="btn btn-info btn-sm">Xem</button>
                                </a>
                            </td>
                        </tr>';
                }
                } else {
                            echo '<tr><td colspan="9" class="text-center text-danger">Chưa có đơn hàng nào.</td></tr>';
                        }

                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once('../layouts/footer.php');
?>
