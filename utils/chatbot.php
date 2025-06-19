<?php
require_once('../database/dbhelper.php'); // để dùng executeResult()
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);
if (!$input || !isset($input['message'])) {
    echo json_encode(['error'=> 'Invalid input']);
    exit;
}

$user_message = mb_strtolower(trim($input['message']));


// Nếu không có từ khóa khớp → gọi Gemini AI như cũ
$api_key = "AIzaSyBcTLWpMAMtgjrHru_LqiI8qHvoeBplyIk";
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$api_key";

$data = [
    "contents" => [
        [
            "parts" => [['text' => $user_message]]
        ]
    ]
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($http_code !== 200) {
    echo json_encode(['error' => 'Không thể kết nối đến AI.']);
    exit;
}

$response_data = json_decode($response, true);
if (!isset($response_data['candidates'][0]['content']['parts'][0]['text'])) {
    echo json_encode(['error' => 'Phản hồi từ AI không hợp lệ.']);
    exit;
}

$ai_response = trim($response_data['candidates'][0]['content']['parts'][0]['text']);
echo json_encode(['response' => $ai_response]);
?>
