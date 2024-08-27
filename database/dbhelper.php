<?php 
require_once('config.php'); 
function execute($sql){
    $conn= mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_set_charset($conn,'utf8');
    mysqli_close($conn);
}

function executeResult($sql, $isSingle = false){
    $data=null;
    $conn= mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_set_charset($conn, 'utf8');
    $resultset=mysqli_query($conn, $sql);

    if (!$resultset) {
        echo "Error: " . mysqli_error($conn);
        return $data;
    }
    if($isSingle){
        $data=mysqli_fetch_array($resultset,1);
    }else{
        $data=[];
        while(($row =mysqli_fetch_array($resultset,1)) !=null){
            $data[]=$row;
         }
    }
    mysqli_close($conn);
    return $data;
}