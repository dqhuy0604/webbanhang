<?php
require_once(__DIR__.'/../../utils/utility.php');
$fullname = $email = $msg ='';  
if(!empty($_POST)){ 
    $fullname = getPost('fullname');
    $email = getPost('email_register');
    $pwd = getPost('pwd_register');

    if(empty($fullname)|| empty($email) ||empty($pwd)|| strlen($pwd)<6){

    }else{  
        $userExist = executeResult("select * from User where email= 
                                    '$email'", true);
        if($userExist != null){
            $msg = ' Email đã được đăng ký trên hệ thống';
        }else{
            $created_at= $updated_at = date('Y-m-d H:i:s');
            $pwd = getSecurityMD5($pwd);
            $sql= "insert into User (fullname , email, password,
                    role_id, created_at, updated_at, deleted) values('$fullname' , '$email', '$pwd',
                    2, '$created_at', '$updated_at', 0)";
            execute($sql);
            header('Location: login.php');
            die();
        }
    }

}

?>