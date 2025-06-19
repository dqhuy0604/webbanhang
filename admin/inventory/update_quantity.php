<?php
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = getPost('product_id');
    $quantities = $_POST['quantities'] ?? [];

    if ($productId == '' || !is_numeric($productId)) {
        die('Thiếu ID sản phẩm hoặc ID không hợp lệ.');
    }

    foreach ($quantities as $variantId => $qty) {
        $variantId = intval($variantId);
        $qty = intval($qty);
        if ($qty >= 0) {
            $sql = "UPDATE inventory SET quantity = $qty WHERE variant_id = $variantId";
            execute($sql);
        }
    }

    // Quay lại trang editor
    header('Location: index.php');
    die();
}