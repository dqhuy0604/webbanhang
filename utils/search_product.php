<?php
require_once('../database/dbhelper.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$keyword = $_GET['keyword'] ?? '';
$keyword = trim(mb_strtolower($keyword));

if (empty($keyword)) {
    echo json_encode(['html' => '<p>Không có từ khóa tìm kiếm.</p>']);
    exit;
}

$sql = "SELECT id, title, price FROM product 
        WHERE title LIKE '%$keyword%' 
        AND deleted = 0 
        ORDER BY updated_at DESC 
        LIMIT 5";
$products = executeResult($sql);

$html = '';
foreach ($products as $product) {
    $id = $product['id'];
    $title = $product['title'];
    $price = number_format($product['price'], 0, ',', '.') . ' VNĐ';

    $html .= "<div class='product-item'>
                <h4>$title</h4>
                <p>Giá: $price</p>
                <a href='product_detail.php?id=$id'>Xem chi tiết</a>
              </div><hr>";
}

if (!$html) {
    $html = "<p>Không tìm thấy sản phẩm phù hợp với \"$keyword\".</p>";
}

echo json_encode(['html' => $html]);
