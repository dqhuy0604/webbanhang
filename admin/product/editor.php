<?php 
    $title ='Thêm/Sửa Sản Phẩm';
    $baseUrl='../';
	require_once('../../utils/utility.php');
	require_once('../../database/dbhelper.php');
	$id = $thumbnail=$thumbnail_2= $title = $price = $category_id = $description = $brand_id= '';
    require_once('form_save.php');
	require_once('../layouts/header.php');
	$id = getGet('id');
	if($id != '' && $id > 0){
		$sql = "select * from Product where id= '$id' and deleted =0 ";
		$userItem = executeResult ($sql,true);
		if($userItem != null){
			$thumbnail = $userItem['thumbnail'];
			$thumbnail_2 = $userItem['thumbnail_2'];
			$title = $userItem['title'];
			$price = $userItem['price'];
			$category_id = $userItem['category_id'];
			$brand_id = $userItem['brand_id'];
            $description = $userItem['description'];
		}else {
			$id = 0;
		}
	}

    $sql = "select * from Category";
    $categoryItems = executeResult($sql);
	$sql_1 = "select * from Brand";
	$brandItems = executeResult($sql_1);

?>

<div class= "row" style="margin-top :20px;">
    <div class="col-md-12">
            <h3>Thêm/Sửa Sản Phẩm</h3>
            <div class="panel panel-primary"  >
			<div class="panel-body">
				<form method="post" enctype="multipart/form-data" >
					<div class="form-group">
					<input required="true" type="text" class="form-control" id="usr" placeholder="Tên Sản Phẩm" name="title" value="<?=$title?>">
					<input type="text" name="id" value =" <?=$id ?>" hidden="true">
					</div>
                    <div class="form-group">
                        <select class="form-control" name="category_id" id="category_id" required="true">
                            <option> Danh Mục Sản Phẩm </option>
                            <?php
                                foreach($categoryItems as $item){
									if($item['id']== $category_id){
										echo '<option selected value ="'.$item['id'].'">'.$item['name'].'</option>';
									}else
                                    	echo '<option value ="'.$item['id'].'">'.$item['name'].'</option>';
                                }	
                            ?>  
                        </select>
					</div>
					  <div class="form-group">
                        <select class="form-control" name="brand_id" id="brand_id" required="true">
                            <option> Brand </option>
                            <?php
                                foreach($brandItems as $item){
									if($item['id']== $brand_id){
										echo '<option selected value ="'.$item['id'].'">'.$item['name'].'</option>';
									}else
                                    	echo '<option value ="'.$item['id'].'">'.$item['name'].'</option>';
                                }	
                            ?>  
                        </select>
					</div>
					<div class="form-group">
						<label>Ảnh chính (thumbnail):</label>
						<input type="file" class="form-control" name="thumbnail" accept="image/*">
						<input type="hidden" name="thumbnail_old" value="<?=$thumbnail?>">
						<img src="<?=fixUrl($thumbnail)?>" style="max-height:160px; margin-top:10px;">
					</div>
					<div class="form-group">
						<label>Ảnh phụ (thumbnail 2):</label>
						<input type="file" class="form-control" name="thumbnail_2" accept="image/*">
						<input type="hidden" name="thumbnail_2_old" value="<?=$thumbnail_2?>">
						<img src="<?=fixUrl($thumbnail_2)?>" style="max-height:160px; margin-top:10px;">
					</div>
                    <div class="form-group">
					<input required="true" type="number" class="form-control" id="price" placeholder="Giá" name="price" value="<?=$price?>">
					</div>
					<div class="form-group">
					<textarea class="form-control" rows="5" name="description"><?=$description?></textarea>
                    </div>
					<button class="btn btn-success">Lưu Sản Phẩm</button>
				</form>
			</div>
		</div>
    </div>
</div>
<script type = "text/javascript">
    function updateThumbnail(){
        $('#thumbnail_img').attr('src',$('#thumbnail').val())
		$('#thumbnail_2_img').attr('src',$('#thumbnail_2').val())
    }
</script>

<?php 
    require_once('../layouts/footer.php')
?>