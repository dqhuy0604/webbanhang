<?php
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

if (!empty($_POST)) {
    $productId = getPost('product_id');
    $size = trim(getPost('size'));
    $quantity = intval(getPost('quantity'));

    // Kiểm tra đầu vào
    if ($productId == '' || $size == '' || $quantity < 1) {
        header('Location: editor.php?id=' . $productId);
        die();
    }

    $productId = intval($productId); // tránh SQL injection
    $size = addslashes($size); // tránh lỗi cú pháp SQL

    // Kiểm tra xem biến thể đã tồn tại chưa
    $sql = "SELECT id FROM product_variant WHERE product_id = $productId AND size = '$size'";
    $variant = executeResult($sql, true);

    if ($variant) {
        $variantId = $variant['id'];
        $sql = "UPDATE inventory SET quantity = quantity + $quantity WHERE variant_id = $variantId";
        execute($sql);
    } else {
        // Tạo biến thể mới
        $sql = "INSERT INTO product_variant(product_id, size) VALUES ($productId, '$size')";
        execute($sql);
        $variantId = getLastInsertId();

        // Tạo kho tương ứng
        $sql = "INSERT INTO inventory(variant_id, quantity) VALUES ($variantId, $quantity)";
        execute($sql);
    }

    // Quay lại editor
    header('Location: editor.php?id=' . $productId);
    die();
}