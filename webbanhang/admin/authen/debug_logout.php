<?php
// debug_logout.php - Tạo file này trong thư mục admin/authen/ để debug

echo "<h2>🔍 DEBUG THÔNG TIN ĐƯỜNG DẪN</h2>";
echo "<pre>";

// 1. Thông tin cơ bản
echo "=== THÔNG TIN CƠ BẢN ===\n";
echo "File hiện tại: " . __FILE__ . "\n";
echo "Thư mục hiện tại (__DIR__): " . __DIR__ . "\n";
echo "Thư mục làm việc (getcwd): " . getcwd() . "\n";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "Script Name: " . $_SERVER['SCRIPT_NAME'] . "\n\n";

// 2. Thử các cách lùi về thư mục gốc
echo "=== THỬ CÁC CÁCH TÌM THU MỤC GỐC ===\n";

$methods = [
    'realpath(__DIR__ . "/../../")' => realpath(__DIR__ . "/../../"),
    'dirname(dirname(__DIR__))' => dirname(dirname(__DIR__)),
    'dirname(__DIR__, 2)' => dirname(__DIR__, 2),
    '__DIR__ . "/../../"' => __DIR__ . "/../../"
];

foreach ($methods as $method => $path) {
    echo "Phương pháp: $method\n";
    echo "Kết quả: $path\n";
    echo "Tồn tại: " . (is_dir($path) ? "✅ CÓ" : "❌ KHÔNG") . "\n\n";
}

// 3. Kiểm tra các file cần include
echo "=== KIỂM TRA CÁC FILE CẦN INCLUDE ===\n";

$projectRoot = realpath(__DIR__ . "/../../");
if ($projectRoot) {
    $filesToCheck = [
        'utils/utility.php',
        'database/dbhelper.php',
        'utils/index.php',
        'admin/index.php'
    ];
    
    foreach ($filesToCheck as $file) {
        $fullPath = $projectRoot . '/' . $file;
        echo "File: $file\n";
        echo "Đường dẫn đầy đủ: $fullPath\n";
        echo "Tồn tại: " . (file_exists($fullPath) ? "✅ CÓ" : "❌ KHÔNG") . "\n";
        
        if (file_exists($fullPath)) {
            echo "Kích thước: " . filesize($fullPath) . " bytes\n";
            echo "Có thể đọc: " . (is_readable($fullPath) ? "✅ CÓ" : "❌ KHÔNG") . "\n";
        }
        echo "\n";
    }
} else {
    echo "❌ KHÔNG TÌM ĐƯỢC THƯ MỤC GỐC!\n\n";
}

// 4. Kiểm tra cấu trúc thư mục
echo "=== CẤU TRÚC THƯ MỤC HIỆN TẠI ===\n";
$currentDir = __DIR__;
echo "Nội dung thư mục: $currentDir\n";
$files = scandir($currentDir);
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        echo "  📁 $file " . (is_dir($currentDir . '/' . $file) ? "(thư mục)" : "(file)") . "\n";
    }
}

echo "\nNội dung thư mục cha: " . dirname($currentDir) . "\n";
$parentFiles = scandir(dirname($currentDir));
foreach ($parentFiles as $file) {
    if ($file != '.' && $file != '..') {
        echo "  📁 $file " . (is_dir(dirname($currentDir) . '/' . $file) ? "(thư mục)" : "(file)") . "\n";
    }
}

if ($projectRoot) {
    echo "\nNội dung thư mục gốc: $projectRoot\n";
    $rootFiles = scandir($projectRoot);
    foreach ($rootFiles as $file) {
        if ($file != '.' && $file != '..') {
            echo "  📁 $file " . (is_dir($projectRoot . '/' . $file) ? "(thư mục)" : "(file)") . "\n";
        }
    }
}

// 5. Thử include utility.php với nhiều cách
echo "\n=== THỬ INCLUDE UTILITY.PHP ===\n";

$utilityPaths = [
    '../../utils/utility.php',
    '../utils/utility.php',
    __DIR__ . '/../../utils/utility.php',
    dirname(dirname(__DIR__)) . '/utils/utility.php'
];

if ($projectRoot) {
    $utilityPaths[] = $projectRoot . '/utils/utility.php';
}

foreach ($utilityPaths as $i => $path) {
    echo "Thử đường dẫn " . ($i + 1) . ": $path\n";
    
    if (file_exists($path)) {
        echo "✅ File tồn tại!\n";
        echo "Đường dẫn tuyệt đối: " . realpath($path) . "\n";
        
        // Thử include
        try {
            ob_start();
            include_once($path);
            $output = ob_get_clean();
            echo "✅ Include thành công!\n";
            
            // Kiểm tra function
            if (function_exists('getUserToken')) {
                echo "✅ Function getUserToken() có sẵn!\n";
            } else {
                echo "❌ Function getUserToken() KHÔNG có!\n";
            }
            
        } catch (Exception $e) {
            echo "❌ Lỗi khi include: " . $e->getMessage() . "\n";
        }
    } else {
        echo "❌ File không tồn tại\n";
    }
    echo "\n";
}

// 6. Thông tin về URL base
echo "=== THÔNG TIN URL BASE ===\n";
$requestUri = $_SERVER['REQUEST_URI'];
if (strpos($requestUri, '/webbanhang/webbanhang/') !== false) {
    echo "Phát hiện cấu trúc: /webbanhang/webbanhang/\n";
    echo "Base URL: /webbanhang/webbanhang\n";
} else if (strpos($requestUri, '/webbanhang/') !== false) {
    echo "Phát hiện cấu trúc: /webbanhang/\n";  
    echo "Base URL: /webbanhang\n";
} else {
    echo "Không phát hiện được cấu trúc webbanhang\n";
}

echo "</pre>";

echo "<h3>📋 KẾT LUẬN VÀ HƯỚNG KHẮC PHỤC:</h3>";
echo "<ol>";
echo "<li>Sao chép kết quả debug này</li>";
echo "<li>Kiểm tra xem file utility.php có tồn tại không</li>";
echo "<li>Chọn đường dẫn include phù hợp từ danh sách trên</li>";
echo "<li>Sử dụng đường dẫn đó trong logout.php</li>";
echo "</ol>";
?>