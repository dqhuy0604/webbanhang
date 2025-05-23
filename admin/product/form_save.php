<?php   
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');
if(!empty($_POST)){
    $id = getPost('id');
    $title = getPost('title');
    $price = getPost('price');
    $discount = getPost('discount');
    $thumbnail = moveFile('thumbnail');
    $thumbnail_2 = moveFile('thumbnail_2');
    $description = getPost('description');    
    $category_id=getPost('category_id');
    $brand_id=getPost('brand_id'); 
    $created_at = $updated_at = date("Y-m-d H:i:s");
    $thumbnail = moveFile('thumbnail');
    if ($thumbnail == '') {
        $thumbnail = getPost('thumbnail_old');
    }

    $thumbnail_2 = moveFile('thumbnail_2');
    if ($thumbnail_2 == '') {
        $thumbnail_2 = getPost('thumbnail_2_old'); 
    }
    if($id>0){
        if($thumbnail !=''){
            $sql= "update Product set thumbnail= '$thumbnail' ,thumbnail_2= '$thumbnail_2', title='$title', price='$price', 
           description='$description', updated_at='$updated_at',
            category_id='$category_id', brand_id='$brand_id' where id=$id ";
        }else{
            $sql= "update Product set title='$title', price='$price', 
            description='$description', updated_at='$updated_at',
            category_id='$category_id',brand_id='$brand_id' where id=$id ";
        }
       
        execute($sql);
        header('Location:index.php');
        die();
    }else{
        $sql= "insert into Product (thumbnail,thumbnail_2, title, price, description, updated_at, 
                created_at,category_id,brand_id, deleted) values ('$thumbnail', '$thumbnail_2', '$title','$price','$description'
                ,'$updated_at','$created_at','$category_id','$brand_id',0) ";
        execute($sql);
        header('Location:index.php');
        die();
    }


}