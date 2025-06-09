    <?php

    function fixSqlInject($sql){
        $sql = str_replace('\\','\\\\',$sql);
        $sql = str_replace('\'','\\\'',$sql);
        return $sql;
    }
        

    function getPost($key){
        $value ='';
        if(isset($_POST[$key])){
            $value=$_POST[$key];
            $value = fixSqlInject($value);
        }
        return trim($value);
    }

    function getGet($key){
        $value ='';
        if(isset($_GET[$key])){
            $value=$_GET[$key];
            $value = fixSqlInject($value);
        }
        return trim($value);
    }

    function getCookie($key){
        $value ='';
        if(isset($_COOKIE[$key])){
            $value=$_COOKIE[$key];
            $value = fixSqlInject($value);
        }
        return trim($value);
    }
    function getRequest($key){
        $value ='';
        if(isset($_REQUEST[$key])){
            $value=$_REQUEST[$key];
            $value = fixSqlInject($value);
        }
        return trim($value);
    }

    function getSecurityMD5($pwd){
        return md5(md5($pwd).PRIVATE_KEY);
    }
    function getUserToken(){
        if(isset($_SESSION['user'])){
            return $_SESSION['user'];
        }
        $token = getCookie('token');
        $sql ="select * from Tokens where token ='$token'";
        $item =executeResult($sql,true);
        if($item != null){
            $userID = $item['user_id'];
            $sql ="select * from User where id ='$userID' and deleted=0"; 
            $item =executeResult($sql,true);
            if($item !=null){
                $_SESSION['user'] = $item;
                return $item;
            }
        }
        return null;
    }
    
   function moveFile($key, $rootPath = "../../") {
    if (!isset($_FILES[$key]) || !isset($_FILES[$key]['name']) || $_FILES[$key]['name'] == '') {
        return '';
    }

    $pathTemp = $_FILES[$key]["tmp_name"];
    $filename = time() . '-' . basename($_FILES[$key]['name']); 
    $uploadDir = "assets/images/";

  
    $newPath = $uploadDir . $filename;


    if (!file_exists($rootPath . $uploadDir)) {
        mkdir($rootPath . $uploadDir, 0777, true);
    }

    move_uploaded_file($pathTemp, $rootPath . $newPath);

    return $newPath; 
}       
    function fixUrl($thumbnail, $rootPath = "../../") {
        if(stripos($thumbnail, 'http://') !== false || stripos($thumbnail, 'https://') !== false) {
        } else {
            $thumbnail = $rootPath.$thumbnail;
        }
        return $thumbnail;

        }
   function getDiscountedPrice($productId, $price) {
    $now = date('Y-m-d H:i:s');
    $sql = "SELECT * FROM product_discount 
            WHERE product_id = $productId 
            AND start_date <= '$now' 
            AND end_date >= '$now'";
    $discount = executeResult($sql, true);

    if ($discount != null) {
        if ($discount['discount_type'] == 'percent') {
            return round($price * (1 - $discount['value'] / 100), 0);
        } else {
            return max(0, $price - $discount['value']);
        }
    }
    return $price;
}
    function renderProductItem_1($item) {
    $price = number_format($item['price']) . 'đ';
    $discounted = number_format($item['discounted_price']) . 'đ';
    $hasDiscount = $item['discounted_price'] < $item['price'];
    $discountPercent = 0;

    if ($item['discount_type'] == 'percent') {
        $discountPercent = (int)$item['value'];
    } elseif ($item['discount_type'] == 'amount') {
        $discountPercent = round(($item['value'] / $item['price']) * 100);
    }

    return '
    <div class="collection-box">
        <div class="product-item-collection">
            <div class="product-top">
                <a href="detail.php?id='.$item['id'].'" class="product-thumb">
                    <img class="dt-width-100" src="../'.$item['thumbnail'].'" alt="">
                    <img class="dt-width-100 img-hover" src="../'.$item['thumbnail_2'].'" alt="">
                </a>
                <a class="buy-now">
                    <div class="product-icon-add">
                    <div class="product-icon-add"><button onclick="location.href=\'detail.php?id='.$item['id'] . '\'">Thêm vào giỏ</button></div>
                    </div>
                    <div class="product-icon-watch">
                            <div class="product-icon-watch">
                                <button onclick="location.href=\'detail.php?id=' . $item['id'] . '\'">Xem nhanh</button>
                            </div>
                    </div>
                </a>
                '.($hasDiscount ? '<div class="product-sale"><span>-'.$discountPercent.'%</span></div>' : '').'
            </div>
            <div class="product-infor">
                <a href="detail.php?id='.$item['id'].'" class="product-name-collection">'.$item['title'].'</a>
                <div class="product-price">
                    <p class="pro-price">
                        <span>'.$discounted.'</span>'.($hasDiscount ? '<del class="compare-price">'.$price.'</del>' : '').'
                    </p>
                </div>
            </div>
        </div>
    </div>';
}


