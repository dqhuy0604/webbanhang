<?php
    ob_start();
	session_start();
	require_once('../../utils/utility.php');
	require_once('../../database/dbhelper.php');

	$user = getUserToken();
	if($user == null){
        die();          
	}
if(!empty($_POST)){
  
    $action = getPost('action');
    switch ($action){
        case 'delete':
            deleteProduct();
            break;
    }
}

function deleteProduct() {
    $id = getPost('id');
    $sql = "select COUNT(*) as count FROM Order_details od
            JOIN Orders o ON od.order_id = o.id
            WHERE od.product_id = $id AND (o.status = 2 OR o.status = 3)";
    $result = executeResult($sql, true);

    if ($result['count'] > 0) {
        echo 'Sản phẩm này đang nằm trong đơn hàng ở trạng thái đang giao hoặc đã giao thành công. Không thể xóa!';
        return;
    }
    $updated_at = date("Y-m-d H:i:s");
    $sql = "update Product SET deleted = 1, updated_at = '$updated_at' WHERE id = $id";
    execute($sql);

    echo 'Sản phẩm đã được xóa thành công.';
}
    ob_end_flush();
