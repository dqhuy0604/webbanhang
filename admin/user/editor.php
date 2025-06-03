<?php 
$title = 'Thêm / Sửa Tài Khoản';
$baseUrl = '../';
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

$id = getGet('id');
$fullname = $email = $phone_number = $address = $password = $role_id = '';
$msg = '';

require_once('form_save.php');
                    
if ($id > 0) {
    $user = executeResult("SELECT * FROM user WHERE id = $id AND deleted = 0", true);
    if ($user) {
        $fullname = $user['fullname'];
        $email = $user['email'];
        $phone_number = $user['phone_number'];
        $address = $user['address'];
        $role_id = $user['role_id'];
    } else {
        $id = 0;
    }
}
$roles = executeResult("SELECT * FROM role");

require_once('../layouts/header.php');
?>

<div class="container" style="margin-top:70px;">
    <h3><?=$id > 0 ? 'Cập nhật tài khoản' : 'Tạo tài khoản mới'?></h3>
    <div class="col-md-6">
        <form method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="form-group">
                <label>Họ tên:</label>
                <input type="text" name="fullname" class="form-control" required value="<?=$fullname?>">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required value="<?=$email?>">
            </div>
            <div class="form-group">
                <label>Mật khẩu <?=$id > 0 ? '(để trống nếu không đổi)' : ''?>:</label>
                <input type="password" name="password" class="form-control" <?=($id == 0 ? 'required minlength="6"' : '')?>>
            </div>
            <div class="form-group">
                <label>Số điện thoại:</label>
                <input type="text" name="phone_number" class="form-control" value="<?=$phone_number?>">
            </div>
            <div class="form-group">
                <label>Địa chỉ:</label>
                <input type="text" name="address" class="form-control" value="<?=$address?>">
            </div>
            <div class="form-group">
                <label>Vai trò:</label>
                <select name="role_id" class="form-control" required>
                    <option value="">-- Chọn vai trò --</option>
                    <?php foreach ($roles as $r): ?>
                        <option value="<?=$r['id']?>" <?=($r['id'] == $role_id ? 'selected' : '')?>><?=$r['name']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group text-danger"><?=$msg?></div>
            <button class="btn btn-success">Lưu tài khoản</button>
            <a href="index.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>


<?php require_once('../layouts/footer.php'); ?>
