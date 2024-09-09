<?php 
    $title ='Quản Lý Đơn Hàng';
    $baseUrl='../';
    require_once('../layouts/header.php');
    $sql = "select * from Orders order by status asc, order_date desc";
    $data = executeResult($sql); 
?>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
        <h3 style="margin-top: 50px; font-weight: bold;">Quản Lý Đơn Hàng</h3>
        <table class="table table-bordered table-hover" style="margin-top: 20px;">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ & Tên</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Địa Chỉ</th>
                    <th>Nội Dung</th>
                    <th>Tổng Tiền</th>
                    <th>Ngày Tạo</th>
                    <th>Trạng Thái</th>
                </tr>
            </thead>
            <tbody>
<?php
        $index = 0;
        foreach($data as $item){
            $statusClass = '';
            switch ($item['status']) {
                case 0:
                    $statusClass = 'option-waiting';
                    break;
                case 1:
                    $statusClass = 'option-confirmed';
                    break;
                case 2:
                    $statusClass = 'option-shipping';
                    break;
                case 3:
                    $statusClass = 'option-completed';
                    break;
            }
            echo '<tr>
                    <th>'.(++$index).'</th>
                    <td><a href="detail.php?id='.$item['id'].'" style="text-decoration:none;">'.$item['fullname'].'</a></td>
                    <td>'.$item['phone_number'].'</td>
                    <td>'.$item['email'].'</td>
                    <td>'.$item['address'].'</td>
                    <td>'.$item['note'].'</td>
                    <td>'.$item['total_money'].'</td>
                    <td>'.$item['order_date'].'</td>
                    <td style="width: 200px;">
                        <div class="custom-select-wrapper">
                            <select class="custom-select" onchange="changeStatus('.$item['id'].', this.value)">
                                <option value="0" class="option-waiting" '.($item['status'] == 0 ? 'selected' : '').'>Đang chờ xác nhận</option>
                                <option value="1" class="option-confirmed" '.($item['status'] == 1 ? 'selected' : '').'>Xác nhận</option>
                                <option value="2" class="option-shipping" '.($item['status'] == 2 ? 'selected' : '').'>Đang giao</option>
                                <option value="3" class="option-completed" '.($item['status'] == 3 ? 'selected' : '').'>Đã giao thành công</option>
                            </select>
                        </div>
                    </td>
                  </tr>';
        }
?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    function changeStatus(id, status) {
        $.post('form_api.php', {
            'id': id,
            'status': status,
            'action': 'update_status'
        }, function(data) {
            location.reload();
        });
    }
</script>

<?php 
    require_once('../layouts/footer.php');
?>
