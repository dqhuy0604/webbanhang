<?php 
ob_start();

$title = 'Quản Lý Size & Tồn Kho';
$baseUrl = '../';

require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');
require_once('form_save.php');
require_once('../layouts/header.php');

$user = getUserToken();
if ($user == null) {
    die('<div class="alert alert-danger">Vui lòng đăng nhập để truy cập trang này.</div>');
}

$productId = getGet('id');
if ($productId == '' || !is_numeric($productId)) {
    echo '<div class="alert alert-danger">Không tìm thấy sản phẩm.</div>';
    require_once('../layouts/footer.php');
    die();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantities'])) {
    $quantities = $_POST['quantities'] ?? [];
    foreach ($quantities as $variantId => $qty) {
        $qty = (int)$qty;
        if ($qty >= 0) {
            $sql = "UPDATE inventory SET quantity = $qty WHERE variant_id = $variantId";
            execute($sql);
        }	
    }
    // Reload lại trang sau khi cập nhật
    header("Location:editor.php?id=$productId");
    die();
}
$sql = "SELECT v.id AS variant_id, v.size, IFNULL(i.quantity, 0) AS quantity
        FROM product_variant v
        LEFT JOIN inventory i ON v.id = i.variant_id
        WHERE v.product_id = $productId
        ORDER BY v.size ASC";
$sizeItems = executeResult($sql);

?>

<div class="row" style="margin-top: 70px;">
    <div class="col-md-12">
        <h3>Quản Lý Size & Tồn Kho</h3>
        <div class="panel panel-primary">
            <div class="panel-body">

                <!-- Form thêm size + số lượng ban đầu gửi qua save.php -->
                <form method="post" action="form_save.php" class="form-inline mb-3">
                    <input type="hidden" name="product_id" value="<?=$productId?>">
                    <div class="form-group mr-2">
                        <input required type="text" class="form-control" name="size" placeholder="Nhập size (VD: 41)">
                    </div>
                    <div class="form-group mr-2">
                        <input required type="number" class="form-control" name="quantity" placeholder="Số lượng" min="1">
                    </div>
                    <button class="btn btn-success">Thêm Size</button>
                </form>

                <!-- Form cập nhật số lượng các size hiện có -->
                <form method="post" action="update_quantity.php">
					<input type="hidden" name="product_id" value="<?=$productId?>">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Size</th>
                                <th style="width: 120px;">Số lượng</th>
                                <th style="width: 120px;">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $index = 0;
                            foreach ($sizeItems as $item) {
                                echo '<tr>
                                        <td>'.(++$index).'</td>
                                        <td>'.htmlspecialchars($item['size']).'</td>
                                        <td>
                                            <input type="number" name="quantities['.$item['variant_id'].']" 
                                                   value="'.$item['quantity'].'" min="0" class="form-control" style="width:80px;">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm btn-delete-size" 
                                                data-variant-id="'.$item['variant_id'].'" data-product-id="'.$productId.'">
                                                Xóa
                                            </button>
                                        </td>
                                      </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                   <div class="d-flex justify-content-end">
						<button type="submit" class="btn btn-success">Cập nhật số lượng</button>
					</div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.btn-delete-size').forEach(button => {
        button.addEventListener('click', function() {
            if (!confirm('Bạn có chắc muốn xóa size này?')) return;

            const variantId = this.getAttribute('data-variant-id');
            const productId = this.getAttribute('data-product-id');
            const btn = this;

            fetch('form_api.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: new URLSearchParams({
                    action: 'delete_variant',
                    variant_id: variantId,
                    product_id: productId
                })
            })
            .then(response => response.text())
            .then(data => {
                if(data.trim() === 'OK') {
                    btn.closest('tr').remove();
                } else {
                    alert('Lỗi: ' + data);
                }
            })
            .catch(err => alert('Lỗi hệ thống, vui lòng thử lại.'));
        });
    });
</script>

<?php require_once('../layouts/footer.php'); ?>
