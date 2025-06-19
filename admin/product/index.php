<?php 
      $title ='Quản Lý Người Dùng';
      $baseUrl='../';
      require_once('../layouts/header.php');
        $sql = "SELECT Product.*, 
                    Category.name AS category_name,
                    Brand.name AS brand_name,
                    d.discount_type,
                    d.value
                FROM Product
                LEFT JOIN Category ON Product.category_id = Category.id
                LEFT JOIN Brand ON Product.brand_id = Brand.id
                LEFT JOIN (
                    SELECT * FROM product_discount 
                    WHERE NOW() BETWEEN start_date AND end_date
                ) d ON Product.id = d.product_id
                WHERE Product.deleted = 0";
      $data = executeResult($sql);
?>

<div class= "row" style="margin-top :20px;">
    <div class="col-md-12">
            <h3 style="margin-top:50px;font-weight:bold;">Quản Lý Sản Phẩm </h3>
            
           <a href="editor.php"> <button class="btn btn-success">Thêm Sản Phẩm</button></a>
            <input type="text" id="searchInput" placeholder="Tìm theo tên sản phẩm..." class="form-control" style="margin-bottom: 20px; width: 300px; margin-top:20px;" />
            <table class="table table-bordered table-hover " style="margin-top :20px;">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Giá sau giảm</th>
                        <th>Danh Mục</th>
                        <th>Brand</th>
                        <th>Hình 1</th>
                        <th>Hình 2</th>
                        <th style ="width :50px"></th>
                        <th style ="width :50px"></th>
                    </tr>
                </thead>
                <tbody>
<?php
        $index = 0;
        foreach($data as $item){
            $originalPrice = $item['price'];
            $discountedPrice = $originalPrice;

            if (!empty($item['discount_type']) && $item['value'] > 0) {
                if ($item['discount_type'] == 'percent') {
                    $discountedPrice = $originalPrice * (1 - $item['value'] / 100);
                } elseif ($item['discount_type'] == 'amount') {
                    $discountedPrice = $originalPrice - $item['value'];
                }
                if ($discountedPrice < 0) $discountedPrice = 0;
            }
            echo'  <tr>
                        <th>'.(++$index).'</th>
                        <td>'.$item['title'].'</td>
                        <td>'.number_format($originalPrice).'đ</td>
                        <td>'.number_format($discountedPrice).'đ</td>
                        <td>'.$item['category_name'].'</td>
                        <td>'.$item['brand_name'].'</td>
                        <td><img src="'.fixUrl($item['thumbnail']).'" style ="height :100px"></td>
                        <td><img src="'.fixUrl($item['thumbnail_2']).'" style ="height :100px"></td>
                        <td style ="width :50px">
                            <a href = "editor.php?id='.$item['id'].'">
                                <button class="btn btn-warning">Sửa</button>
                            </a>
                        </td>
                        <td style ="width :50px">
                                <button onclick="deleteProduct('.$item['id'].')" class="btn btn-danger">Xóa</button>
                            </td>
                        </tr>';
            
         }
    ?>
                </tbody>

            </table>

    </div>
</div>


<script type="text/javascript">
    function deleteProduct(id){
        option = confirm('bạn có chắc chắn muốn xóa sản phẩm này không?')
        if(!option) return;

        $.post('form_api.php',{
            'id':id,
            'action':'delete'
        }, function(data){
                location.reload()
        })

    }
    document.getElementById('searchInput').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase().trim();
    const rows = document.querySelectorAll('table tbody tr');

    rows.forEach(row => {
        const productName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        if (productName.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});


</script>

<?php 
    require_once('../layouts/footer.php')
?>