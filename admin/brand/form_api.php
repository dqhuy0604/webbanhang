<?php
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
            deleteBrand();
            break;
    }
}

function deleteBrand() {
    $id = getPost('id');
    $sql = "SELECT COUNT(*) as total FROM Product WHERE brand_id = $id AND deleted = 0";
    $data = executeResult($sql, true);
    $total = $data['total'];
    
    if ($total > 0) {
        echo 'Thương hiệu đang chứa sản phẩm, không được xóa !!!';
        die(); 
    }

    $sql = "DELETE FROM Brand WHERE id = $id";
    execute($sql);  
}