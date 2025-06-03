<?php 
$title = 'Quản Lý Tồn Kho và Giảm Giá';
$baseUrl = '../';
require_once('../layouts/header.php');

$keyword = getGet('keyword');

// Lấy danh sách sản phẩm + tổng tồn kho + giảm giá đang áp dụng
$sql = "SELECT p.id, p.title, p.thumbnail,
               IFNULL(SUM(i.quantity), 0) AS total_quantity,
               d.discount_type, d.value, d.start_date, d.end_date
        FROM product p
        LEFT JOIN product_variant v ON p.id = v.product_id
        LEFT JOIN inventory i ON v.id = i.variant_id
        LEFT JOIN (
            SELECT *
            FROM product_discount
            WHERE NOW() BETWEEN start_date AND end_date
        ) d ON p.id = d.product_id
        WHERE p.deleted = 0";

if ($keyword != '') {
    $sql .= " AND p.title LIKE '%$keyword%'";
}

$sql .= " GROUP BY p.id";

$data = executeResult($sql);
?>

<div class="row" style="margin-top:20px;">
    <div class="col-md-12">
        <h3 style="margin-top:50px;font-weight:bold;">Quản lý số lượng và giảm giá</h3>

        <!-- Bộ lọc tìm kiếm -->
        <form method="GET" class="form-inline mb-3">
            <input type="text" name="keyword" class="form-control mr-2" placeholder="Tìm theo tên sản phẩm" value="<?=getGet('keyword')?>">
            <button class="btn btn-primary">Tìm</button>
        </form>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Thumbnail</th>
                    <th>Tổng Số Lượng</th>
                    <th></th>
                    <th>Giảm giá</th>
                    <th >Thêm giảm giá</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = 0;
                foreach ($data as $item) {
                    $discountInfo = '';
                    if (!empty($item['discount_type'])) {
                        if ($item['discount_type'] == 'percent') {
                            $discountInfo = '-' . $item['value'] . '%';
                        } else {
                            $discountInfo = '-' . number_format($item['value']) . 'đ';
                        }
                        $discountInfo .= '<br><small>(' . date('d/m/Y', strtotime($item['start_date'])) . ' - ' . date('d/m/Y', strtotime($item['end_date'])) . ')</small>';
                    }

                    echo '<tr>
                        <td>' . (++$index) . '</td>
                        <td>' . $item['title'] . '</td>
                        <td><img src="' . fixUrl($item['thumbnail']) . '" style="height:100px"></td>
                        <td>' . $item['total_quantity'] . '</td>
                        <td>
                            <a href="editor.php?id=' . $item['id'] . '">
                                <button class="btn btn-success btn-sm">Thêm số lượng </button>
                            </a>
                        </td>
                        <td>
                            ' . ($discountInfo ?: '<i>Chưa có</i>') . '
                           
                        </td>
                        <td> 
                            <a href="../discount/editor.php?product_id=' . $item['id'] . '">
                                <button class="btn btn-warning btn-sm mt-1">Thêm giảm giá</button>
                            </a>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
function deleteInventory(id) {
    if (!confirm('Bạn có chắc chắn muốn xóa toàn bộ tồn kho của sản phẩm này không?')) return;

    $.post('form_api.php', {
        'product_id': id,
        'action': 'delete_all'
    }, function(data) {
        alert(data);
        location.reload();
    });
}
</script>

<?php 
require_once('../layouts/footer.php');
?>