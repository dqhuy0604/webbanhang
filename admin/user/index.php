<?php
$title = 'Quản Lý Người Dùng';
$baseUrl = '../';
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');
require_once('../layouts/header.php');

$keyword = getGet('keyword');

$sql = "SELECT u.*, r.name AS role_name 
        FROM user u 
        LEFT JOIN role r ON u.role_id = r.id 
        WHERE u.deleted = 0";

if ($keyword != '') {
    $sql .= " AND (u.fullname LIKE '%$keyword%' OR u.email LIKE '%$keyword%')";
}

$sql .= " ORDER BY u.created_at DESC";
$users = executeResult($sql);
?>

<div class="container" style="margin-top: 70px;">
    <h3 style="font-weight:bold;">Danh sách người dùng</h3>
    <a href="editor.php">
    <button class="btn btn-success mb-3">+ Thêm tài khoản</button>
    </a>
    <form method="get" class="form-inline mb-3">
        <input type="text" name="keyword" class="form-control mr-2" placeholder="Tìm theo tên hoặc email" value="<?=$keyword?>">
        <button class="btn btn-primary">Tìm kiếm</button>
    </form>

    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th width="50px">STT</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Vai trò</th>
                <th>Tổng chi tiêu</th>
                <th>Đơn hàng</th>
                <th></th>
                <th></th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            $index = 0;
            foreach ($users as $user) {
                $index++;
                $userId = $user['id'];
                $roleId = $user['role_id'];

                // Tổng chi tiêu và số đơn hàng thành công
                $stat = executeResult("SELECT SUM(total_money) AS total_spent, COUNT(*) AS total_orders 
                                        FROM orders 
                                        WHERE user_id = $userId AND status_id = 4", true);
                $totalSpent = number_format($stat['total_spent'] ?? 0);
                $orderCount = $stat['total_orders'] ?? 0;

                echo "<tr>
                        <td>$index</td>
                        <td>{$user['fullname']}</td>
                        <td>{$user['email']}</td>
                        <td>{$user['phone_number']}</td>
                        <td>{$user['role_name']}</td>
                        <td>$totalSpent đ</td>
                        <td>$orderCount</td>
                        <td><a href='detail.php?id=$userId' class='btn btn-info btn-sm'>Chi tiết</a>";echo "</td>
                        <td>";
                      echo" <a href='editor.php?id=$userId' class='btn btn-danger '>Sửa</a>"; 
                if ($roleId != 1) {
                    echo " <button onclick='deleteUser($userId)' class='btn btn-success'>Xóa</button>";
                } else {
                    echo " <button class='btn btn-secondary btn-sm' disabled>Admin</button>";
                }
                  

                echo "</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
function deleteUser(id) {
    if (!confirm('Bạn có chắc chắn muốn xóa người dùng này?')) return;

    $.post('form_api.php', {
        'id': id,
        'action': 'delete'
    }, function(res) {
        location.reload();
    });
}
</script>

<?php require_once('../layouts/footer.php'); ?>
