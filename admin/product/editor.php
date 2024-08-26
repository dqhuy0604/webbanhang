<?php 
    $title ='Thêm/Sửa Sản Phẩm';
    $baseUrl='../';
    require_once('../layouts/header.php');
	$id = $thumbnail = $title = $price = $discount = $category_id = $description ='';
    require_once('form_save.php');

	$id = getGet('id');
	if($id != '' && $id > 0){
		$sql = "select * from Product where id= '$id' and deleted =0 ";
		$userItem = executeResult ($sql,true);
		if($userItem != null){
			$thumbnail = $userItem['thumbnail'];
			$title = $userItem['title'];
			$price = $userItem['price'];
			$discount = $userItem['discount'];
			$category_id = $userItem['category_id'];
            $description = $userItem['description'];
		}else {
			$id = 0;
		}
	}

    $sql = "select * from Category";
    $categoryItems = executeResult($sql);


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
					<input required="true" type="file" class="form-control" id="thumbnail" placeholder="Thumbnail" 
								name="thumbnail" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                    <img id="thumbnail_img" src="<?=fixUrl($thumbnail)?>" style="max-height :160px; margin-top:10px; margin-bottom:15px;">            
					</div>
                    <div class="form-group">
					<input required="true" type="number" class="form-control" id="price" placeholder="Giá" name="price" value="<?=$price?>">
					</div>
                    <div class="form-group">
					<input required="true" type="number" class="form-control" id="discount" placeholder="Giảm Giá" name="discount"value="<?=$discount?>">
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
    }
</script>

<?php 
    require_once('../layouts/footer.php')
?>