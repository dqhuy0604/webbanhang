<?php
header('Content-Type: application/json');
session_start();
require_once('../database/dbhelper.php');
require_once('../utils/utility.php');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Bạn chưa đăng nhập!']);
    exit;
}

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);
$product_id = $data['product_id'] ?? null;

if (!$product_id) {
    echo json_encode(['success' => false, 'message' => 'Thiếu product_id']);
    exit;
}

// Kiểm tra xem đã có trong wishlist chưa
$query = "SELECT * FROM wishlist WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $delete = $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ?");
    $delete->bind_param("ii", $user_id, $product_id);
    $delete->execute();
    echo json_encode(["success" => true, "status" => "removed"]);
} else {
    $insert = $conn->prepare("INSERT INTO wishlist (user_id, product_id, created_at) VALUES (?, ?, NOW())");
    $insert->bind_param("ii", $user_id, $product_id);
    $insert->execute();
    echo json_encode(["success" => true, "status" => "added"]);
}
