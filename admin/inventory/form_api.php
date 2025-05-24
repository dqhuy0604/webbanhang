<?php
ob_start();
session_start();
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

$user = getUserToken();
if ($user == null) {
    die();
}

if (!empty($_POST)) {
    $action = getPost('action');
    switch ($action) {
        case 'delete':
            deleteProduct();
            break;
        case 'delete_all':
            deleteInventoryByProduct();
            break;
        case 'delete_variant':
            deleteVariant();
            break;    
    }
}
function deleteProduct() {
    $id = getPost('id');
    $sql = "SELECT COUNT(*) as count FROM Order_details od
            JOIN Orders o ON od.order_id = o.id
            WHERE od.product_id = $id AND (o.status = 2 OR o.status = 3)";
    $result = executeResult($sql, true);

    if ($result['count'] > 0) {
        echo 'Sản phẩm này đang nằm trong đơn hàng ở trạng thái đang giao hoặc đã giao thành công. Không thể xóa!';
        return;
    }

    $updated_at = date("Y-m-d H:i:s");
    $sql = "UPDATE Product SET deleted = 1, updated_at = '$updated_at' WHERE id = $id";
    execute($sql);

    echo 'Sản phẩm đã được xóa thành công.';
}

function deleteInventoryByProduct() {
    $productId = getPost('product_id');
    $sql = "SELECT id FROM product_variant WHERE product_id = $productId";
    $variantList = executeResult($sql);

    foreach ($variantList as $variant) {
        $variantId = $variant['id'];

        execute("DELETE FROM inventory WHERE variant_id = $variantId");

        execute("DELETE FROM product_variant WHERE id = $variantId");
    }

    echo 'Tồn kho và size đã được xóa thành công.';
}
function deleteVariant() {
    $variantId = getPost('variant_id');
    $productId = getPost('product_id');

    if (!$variantId || !$productId) {
        echo 'Thiếu tham số.';
        return;
    }

    execute("DELETE FROM inventory WHERE variant_id = $variantId");
    execute("DELETE FROM product_variant WHERE id = $variantId");

    echo 'OK';
}

ob_end_flush();
