<?php
$fullname = $email = $msg = '';

if(!empty($_POST)){
    $email= getPost('email');
    $pwd = getPost('password');
    $pwd = getSecurityMD5($pwd);
    $sql ="select * from User where email= '$email' and password ='$pwd' and deleted = 0";
    $userExist =executeResult($sql,true);
    if($userExist == null){
        $msg = 'Đăng nhập không thành công, vui lòng kiểm tra email hoặc mật khẩu';

    }else{
     
        $token=  getSecurityMD5($userExist['email'].time());
        setcookie('token', $token, time() + (7 * 24 * 60 *60) ,'/');
        $created_at= date('Y-m-d H:i:s');
        
        $_SESSION['user']=$userExist;

        $user_id = $userExist['id'];
        $sql ="insert into Tokens (user_id, token , created_at) 
            values('$userId','$token','$created_at')";
        execute($sql);
        $role_id= $userExist['role_id'];
        if($role_id == 1){
            header('Location:../order/index.php');
            die();
        }else{
            header('Location: ../../utils/index.php');
            die();
        }
        
        }
}   