<?php
require_once('../database/dbhelper.php');

// Đặt header JSON trước để trình duyệt biết luôn là JSON
header('Content-Type: application/json');

// Lấy từ khóa tìm kiếm
$keyword = isset($_GET['q']) ? trim($_GET['q']) : '';

// Nếu không có từ khóa, trả về mảng rỗng
if ($keyword === '') {
    echo json_encode(['products' => []]);
    exit;
}

// Thực hiện truy vấn (cho học tập nên vẫn nối chuỗi trực tiếp)
$sql = "SELECT title, price, thumbnail FROM product WHERE title LIKE '%$keyword%'";

// Dùng try-catch nhẹ để tránh phản hồi sai định dạng JSON
try {
    $products = executeResult($sql);
    if ($products === null) {
        echo json_encode(['products' => []]);
    } else {
        echo json_encode(['products' => $products]);
    }
} catch (Exception $e) {
    echo json_encode(['products' => []]);
}
