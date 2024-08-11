<!-- <?php
	require_once('../../utils/utility.php');
	require_once('../../database/dbhelper.php');
	require_once('process_form_register.php');

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
	<div class="container">	
		<div class="panel panel-primary" style="width:480px;margin:0px auto; font-family:'Quicksand', sans-serif !important; " >
			<div class="panel-heading">
				<h2 class="text-center">Đăng nhập</h2>
			</div>
			<div class="panel-body">
				<form method="post" >
					<input required="true" type="email" class="form-control" id="email" placeholder="Email" name="email">
					</div>
					<div class="form-group">
					<input required="true" type="password" class="form-control" id="pwd" placeholder="Mật Khẩu" name="password" minlength="6">
					</div>
					<p>
						<a href="register.php">Đăng kí tài khoản</a>
					</p>
					<button class="btn btn-success">Đăng nhập</button>
				</form>
			</div>
		</div>
	</div>
	<script type ="text/javascript">
		function validateForm(){
			$pwd = $('#pwd').val();
			$confirmPwd = $('#comfirmation_pwd').val();
			if($pwd!= $confirmPwd){
				alert("Mật khẩu không khớp, vui lòng nhập lại");
				return false;
			}
			return true;
		}

	</script>

</body>
</html> -->