<?php
$title = 'Biểu đồ doanh thu';
$baseUrl = '../';
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');
require_once('../layouts/header.php');

// Lấy dữ liệu doanh thu theo tháng trong năm hiện tại
$year = date('Y');
$sql = "
    SELECT MONTH(order_date) as month, SUM(total_money) as revenue
    FROM orders
    WHERE status_id = 4 AND YEAR(order_date) = $year
    GROUP BY MONTH(order_date)
";
$data = executeResult($sql);

$revenueData = array_fill(1, 12, 0);
foreach ($data as $item) {
    $revenueData[(int)$item['month']] = $item['revenue'];
}

$currentMonth = (int)date('n');

// Thống kê sản phẩm bán chạy nhất mặc định theo tháng hiện tại
$from = getGet('from');
$to = getGet('to');

if ($from == '' && $to == '') {
    $from = date('Y-m-01');
    $to = date('Y-m-t');
}

$cond = "WHERE o.status_id = 4";
if ($from != '') {
    $cond .= " AND o.order_date >= '$from 00:00:00'";
}
if ($to != '') {
    $cond .= " AND o.order_date <= '$to 23:59:59'";
}

$sqlTop = "
    SELECT p.title, SUM(od.num) AS total_sold, SUM(od.total_money) AS total_revenue
    FROM order_details od
    JOIN orders o ON od.order_id = o.id
    JOIN product p ON od.product_id = p.id
    $cond
    GROUP BY od.product_id
    ORDER BY total_sold DESC
    LIMIT 10
";
$topProducts = executeResult($sqlTop);

$sqlOrders = "
    SELECT o.*, u.fullname AS customer_name
    FROM orders o
    LEFT JOIN user u ON o.user_id = u.id
    $cond
    ORDER BY o.order_date DESC
";
$orders = executeResult($sqlOrders);

$totalRevenue = 0;
$totalOrder = count($orders);
$totalProduct = 0;
foreach ($orders as $order) {
    $totalRevenue += $order['total_money'];
    $count = executeResult("SELECT SUM(num) AS quantity FROM order_details WHERE order_id = ".$order['id'], true);
    $totalProduct += $count['quantity'] ?? 0;
}
?>

<div class="container mt-5" >

    <form method="get" class="form-inline mb-3" style="margin-top:80px;">
        <label class="mr-2">Từ ngày:</label>
        <input type="date" name="from" class="form-control mr-2" value="<?=$from?>">
        <label class="mr-2">Đến ngày:</label>
        <input type="date" name="to" class="form-control mr-2" value="<?=$to?>">
        <button class="btn btn-success">Lọc</button>
    </form>
    <h4 class="mt-5">Tổng quan doanh thu<?=($from || $to) ? " (lọc từ $from đến $to)" : ""?></h4>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="alert alert-success">
                <h5>Tổng doanh thu</h5>
                <strong><?=number_format($totalRevenue)?> đ</strong>
            </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info">
                <h5>Tổng đơn hàng</h5>
                <strong><?=$totalOrder?> đơn</strong>
            </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-warning">
                <h5>Tổng sản phẩm đã bán</h5>
                <strong><?=$totalProduct?> sản phẩm</strong>
            </div>
        </div>
    </div>


    <h4 style="margin-top: 50px;">Biểu đồ doanh thu năm <?=$year?></h4>
    <canvas id="revenueChart" height="100"></canvas>            
    <h4 class="mt-5">Top 10 sản phẩm bán chạy nhất<?=($from || $to) ? " (lọc từ $from đến $to)" : ""?></h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng đã bán</th>
                <th>Tổng doanh thu</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($topProducts as $p): ?>
                <tr>
                    <td><?=$p['title']?></td>
                    <td><?=$p['total_sold']?></td>
                    <td><?=number_format($p['total_revenue'])?> đ</td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <h4 class="mt-4">Chi tiết đơn hàng</h4>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Thời gian</th>
                <th>Khách hàng</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Tổng tiền</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $item): ?>
                <tr>
                    <td><?=date('d/m/Y H:i', strtotime($item['order_date']))?></td>
                    <td><?=$item['customer_name']?></td>
                    <td><?=$item['email']?></td>
                    <td><?=$item['phone_number']?></td>
                    <td><?=number_format($item['total_money'])?> đ</td>
                    <td>
                        <a href="../order/detail.php?id=<?=$item['id']?>" class="btn btn-sm btn-info">Xem</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Tháng 1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
            datasets: [{
                label: 'Doanh thu (VND)',
                backgroundColor: '#007bff',
                data: <?=json_encode(array_values($revenueData))?>
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat().format(value) + ' đ';
                        }
                    }
                }
            }
        }
    });
</script>

<?php require_once('../layouts/footer.php'); ?>
