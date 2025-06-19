<?php
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = getPost('product_id');
    $discountType = getPost('discount_type');
    $value = getPost('value');
    $startDate = getPost('start_date');
    $endDate = getPost('end_date');

    // Validate dữ liệu cơ bản
    if (!is_numeric($productId) || $value < 0 || $startDate == '' || $endDate == '') {
        header('Location: editor.php?product_id=' . $productId);
        die();
    }

    // Xoá các bản giảm giá cũ nếu muốn chỉ lưu một bản (tuỳ bạn chọn logic)
    execute("DELETE FROM product_discount WHERE product_id = $productId");

    // Thêm mới
    $sql = "INSERT INTO product_discount (product_id, discount_type, value, start_date, end_date)
            VALUES ($productId, '$discountType', $value, '$startDate', '$endDate')";
    execute($sql);

    header('Location: ../inventory/index.php');
    die();
}