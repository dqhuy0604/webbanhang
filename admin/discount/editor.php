<?php
$title = 'Thêm/Sửa Giảm Giá';
$baseUrl = '../';
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');
require_once('../layouts/header.php');

$productId = getGet('product_id');
if (!is_numeric($productId) || $productId <= 0) {
    echo '<div class="alert alert-danger">Sản phẩm không hợp lệ.</div>';
    require_once('../layouts/footer.php');
    die();
}

// Lấy thông tin sản phẩm
$product = executeResult("SELECT * FROM product WHERE id = $productId", true);
if (!$product) {
    echo '<div class="alert alert-danger">Sản phẩm không tồn tại.</div>';
    require_once('../layouts/footer.php');
    die();
}

// Kiểm tra xem có giảm giá đang áp dụng không
$discount = executeResult("SELECT * FROM product_discount WHERE product_id = $productId ORDER BY end_date DESC LIMIT 1", true);
?>

<div class="row" style="margin-top: 80px;">
    <div class="col-md-8 offset-md-2">
        <h3>Thêm/Sửa Giảm Giá cho: <strong><?= $product['title'] ?></strong></h3>

        <form method="post" action="form_save.php">
            <input type="hidden" name="product_id" value="<?= $productId ?>">

            <div class="form-group">
                <label>Loại giảm giá</label>
                <select class="form-control" name="discount_type" required>
                    <option value="percent" <?= ($discount && $discount['discount_type'] == 'percent') ? 'selected' : '' ?>>Giảm theo %</option>
                    <option value="amount" <?= ($discount && $discount['discount_type'] == 'amount') ? 'selected' : '' ?>>Giảm theo số tiền</option>
                </select>
            </div>

            <div class="form-group">
                <label>Giá trị giảm</label>
                <input type="number" step="0.01" class="form-control" name="value" value="<?= $discount['value'] ?? '' ?>" required>
            </div>

            <div class="form-group">
                <label>Ngày bắt đầu</label>
                <input type="datetime-local" class="form-control" name="start_date"
                    value="<?= isset($discount['start_date']) ? date('Y-m-d\TH:i', strtotime($discount['start_date'])) : '' ?>" required>
            </div>

            <div class="form-group">
                <label>Ngày kết thúc</label>
                <input type="datetime-local" class="form-control" name="end_date"
                    value="<?= isset($discount['end_date']) ? date('Y-m-d\TH:i', strtotime($discount['end_date'])) : '' ?>" required>
            </div>

            <button class="btn btn-success">Lưu Giảm Giá</button>
            <a href="../inventory/index.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>

<?php require_once('../layouts/footer.php'); ?>
