<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents("php://input"), true);
$message = strtolower(trim($input['message'] ?? ''));

$intents = require("../utils/intents.php"); // File này chỉ chứa mảng trả về

// Ghi log để kiểm tra
file_put_contents(__DIR__ . "/intent_log.txt", "Tin nhắn: $message\n", FILE_APPEND);


foreach ($intents as $intent) {
    foreach ($intent['keywords'] as $keyword) {
        if (strpos($message, strtolower($keyword)) !== false) {
            file_put_contents("intent_log.txt", "Khớp keyword: $keyword\n", FILE_APPEND);
            echo json_encode(["response" => $intent['response']]);
            exit;
        }
    }
}

echo json_encode(["response" => null]);
