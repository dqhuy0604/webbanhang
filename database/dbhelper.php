<?php
require_once('config.php');
$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, 'utf8');

function execute($sql) {
    global $conn;
    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . mysqli_error($conn);
    }
}

function executeResult($sql, $isSingle = false) {
    global $conn;
    $data = null;
    $resultset = mysqli_query($conn, $sql);
    if (!$resultset) {
        echo "Error: " . mysqli_error($conn);
        return $data;
    }
    if ($isSingle) {
        $data = mysqli_fetch_array($resultset, MYSQLI_ASSOC);
    } else {
        $data = [];
        while (($row = mysqli_fetch_array($resultset, MYSQLI_ASSOC)) != null) {
            $data[] = $row;
        }
    }
    return $data;
}

function getLastInsertId() {
    global $conn;
    return mysqli_insert_id($conn);
}
?>
