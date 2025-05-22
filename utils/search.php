<?php
require_once('../database/dbhelper.php');

header('Content-Type: application/json');

$keyword = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($keyword === '') {
    echo json_encode(['products' => []]);
    exit;
}

$sql = "SELECT title, price, thumbnail FROM product WHERE title LIKE '%$keyword%'";
$products = executeResult($sql);

echo json_encode(['products' => $products]);
