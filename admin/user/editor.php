<?php 
    $title ='Thêm/Sửa Tài Khoản Người Dùng';
    $baseUrl='../';
    require_once('../layouts/header.php');
	$id= $msg = $fullname = $email = $phone_number = $address = $role_id ='';
    require_once('form_save.php');

	$id = getGet('id');
	if($id != '' && $id > 0){
		$sql = "select * from User where id= '$id'";
		$userItem = executeResult ($sql,true);
		if($userItem != null){
			$fullname = $userItem['fullname'];
			$email = $userItem['email'];
			$phone_number = $userItem['phone_number'];
			$address = $userItem['address'];
			$role_id = $userItem['role_id'];
		}else {
			$id = 0;
		}
	}

    $sql = "select * from Role";
    $roleItems = executeResult($sql);


?>

<div class= "row" style="margin-top :20px;">
    <div class="col-md-12">
            <h3>Thêm/Sửa Tài Khoản Người Dùng</h3>
            <div class="panel panel-primary"  >
			<div class="panel-heading">
				<h5 style="color:red"  ><?=$msg?></h5>
			</div>
			<div class="panel-body">
				<form method="post" onsubmit="return validateForm()">
					<div class="form-group">
					<input required="true" type="text" class="form-control" id="usr" placeholder="Họ Tên" name="fullname" value="<?=$fullname?>">
					<input type="text" name="id" value =" <?=$id ?>" hidden="true">
					</div>
                    <div class="form-group">
                        <select class="form-control" name="role_id" id="role_id" required="true">
                            <option> Role </option>
                            <?php
                                foreach($roleItems as $role){
									if($role['id']==$role_id){
										echo '<option selected value ="'.$role['id'].'">'.$role['name'].'</option>';
									}else
                                    	echo '<option value ="'.$role['id'].'">'.$role['name'].'</option>';
                                }	
                            ?>  
                        </select>
					</div>
					<div class="form-group">
					<input required="true" type="email" class="form-control" id="email" placeholder="Email" name="email"  value="<?=$email?>">
					</div>
                    <div class="form-group">
					<input required="true" type="tel" class="form-control" id="phone_number" placeholder="SĐT" name="phone_number" value="<?=$phone_number?>">
					</div>
                    <div class="form-group">
					<input required="true" type="text" class="form-control" id="address" placeholder="Địa Chỉ" name="address"value="<?=$address?>">
					</div>
					<div class="form-group">
					<input <?=($id > 0? '':'required="true"')?> type="password" class="form-control" id="pwd" placeholder="Mật Khẩu" name="password" minlength="6">
					</div>
					<div class="form-group">
					<input <?=($id > 0?'':'required="true"')?> type="password" class="form-control" id="confirmation_pwd" placeholder="Xác minh mật khẩu">
					</div>
					<button class="btn btn-success">Đăng kí</button>
				</form>
			</div>
		</div>
    </div>
</div>

<script type ="text/javascript">
		function validateForm(){
			$pwd = $('#pwd').val();
			$confirmPwd = $('#confirmation_pwd').val();
			if($pwd!= $confirmPwd){
				alert("Mật khẩu không khớp, vui lòng nhập lại");
				return false;
			}
			return true;
		}

	</script>
<?php 
    require_once('../layouts/footer.php')
?>