<?php
session_start();
require 'db.php';

$user_id = $_SESSION['user_id'];

$query = "
    SELECT p.id, p.name
    FROM wishlist w
    JOIN products p ON w.product_id = p.id
    WHERE w.user_id = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode([
    "count" => count($products),
    "products" => $products
]);
?>
