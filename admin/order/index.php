<?php
$title = 'Quản Lý Đơn Hàng';
$baseUrl = '../';
require_once('../layouts/header.php');

$searchOrderId = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

$sql = "SELECT o.*, 
               u.fullname AS customer_name,
               s.name AS shipping_method,
               p.name AS payment_method,
               st.name AS status_name
        FROM orders o
        LEFT JOIN user u ON o.user_id = u.id
        LEFT JOIN shipping_method s ON o.shipping_method_id = s.id
        LEFT JOIN payment_method p ON o.payment_method_id = p.id
        LEFT JOIN order_status st ON o.status_id = st.id";

if ($searchOrderId > 0) {
    $sql .= " WHERE o.id = $searchOrderId";
}

$sql .= " ORDER BY o.order_date DESC";

$data = executeResult($sql);
?>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
        <h3 style="margin-top: 50px; font-weight: bold;">Quản Lý Đơn Hàng</h3>

        <!-- Form tìm kiếm -->
        <form method="GET" class="form-inline mb-3">
            <input type="number" class="form-control mr-2" name="order_id" placeholder="Nhập mã đơn" value="<?= $searchOrderId ?>" min="1" />
            <button class="btn btn-primary">Tìm kiếm</button>
            <a href="index.php" class="btn btn-secondary ml-2">Tất cả</a>
        </form>

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
                            <td>' . $item['customer_name'] . '</td>
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
                    echo '<tr><td colspan="9" class="text-center text-danger">Không tìm thấy đơn hàng phù hợp.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once('../layouts/footer.php');
?>
