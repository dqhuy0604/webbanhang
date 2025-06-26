<?php
session_start();
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

$token = getCookie('token');
setcookie('token','',time()-100,'/');
session_destroy();

// DEBUG
echo "Current script: " . $_SERVER['SCRIPT_NAME'] . "<br>";
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "<br>";
echo "Document root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";

// Test paths
$path1 = "/webbanhang/webbanhang/utils/index.php";
$path2 = "../../utils/index.php";

echo "Path 1: " . $path1 . "<br>";
echo "Path 2: " . $path2 . "<br>";

echo "File exists (absolute): " . (file_exists($_SERVER['DOCUMENT_ROOT'] . $path1) ? 'YES' : 'NO') . "<br>";
echo "File exists (relative): " . (file_exists($path2) ? 'YES' : 'NO') . "<br>";

// Uncomment để redirect
// header("Location: /webbanhang/webbanhang/utils/index.php");
// die();
?>