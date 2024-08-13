<?php
	require_once('../../database/dbhelper.php');
	require_once('process_form_register.php');
	require_once('../../utils/utility.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Đăng ký</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		// require_once('../../layout/header.php');
	?>
	<div class="container">	
		<div class="panel panel-primary" style="width:480px;margin:0px auto; font-family:'Quicksand', sans-serif !important; " >
			<div class="panel-heading">
				<h2 class="text-center">Đăng kí tài khoản</h2>
				<h5 style="color:red" class="text-center" ><?=$msg?></h5>
			</div>
			<div class="panel-body">
				<form method="post" onsubmit="return validateForm()">
					<div class="form-group">
					<input required="true" type="text" class="form-control" id="usr" placeholder="Họ Tên" name="fullname" value="<?=$fullname?>">
					</div>
					<div class="form-group">
					<input required="true" type="email" class="form-control" id="email" placeholder="Email" name="email"  value="<?=$email?>">
					</div>
					<div class="form-group">
					<input required="true" type="password" class="form-control" id="pwd" placeholder="Mật Khẩu" name="password" minlength="6">
					</div>
					<div class="form-group">
					<input required="true" type="password" class="form-control" id="confirmation_pwd" placeholder="Xác minh mật khẩu">
					</div>
					<p>
						<a href="login.php">Đã có tài khoản</a>
					</p>
					<button class="btn btn-success">Đăng kí</button>
				</form>
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
		// require_once('../layout/footer.php');
	?>
</body>
</html>