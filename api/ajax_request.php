<?php 
    session_start();
    require_once('../utils/utility.php');
    require_once('../database/dbhelper.php');
    
    $action = getPost('action');
    switch($action){
        case 'add_to_wishlist':
            addToWishlist();
            break;
        case 'remove_from_wishlist':
            removeFromWishlist();
            break;
        case 'get_wishlist_count':
            getWishlistCount();
            break;
        case 'cart':
            addToCart();
            break;
        case 'update_cart':
            updateCart();
            break;
        case 'checkout':
            checkout();
            break;
            
    }

    function addToWishlist() {
        $id = intval(getPost('id'));
        
        if (!isset($_SESSION['wishlist'])) {
            $_SESSION['wishlist'] = [];
        }

        // Kiểm tra xem sản phẩm đã có trong wishlist chưa
        foreach ($_SESSION['wishlist'] as $item) {
            if ($item['id'] == $id) {
                echo json_encode(['success' => false, 'message' => 'Sản phẩm đã có trong danh sách yêu thích']);
                return;
            }
        }

        // Lấy thông tin sản phẩm từ database
        $sql = "
        SELECT p.*, c.name AS category_name,
            d.discount_type, d.value,
            CASE 
                WHEN d.discount_type = 'percent' THEN ROUND(p.price * (1 - d.value / 100), 0)
                WHEN d.discount_type = 'amount' THEN GREATEST(p.price - d.value, 0)
                ELSE p.price
            END AS discounted_price
        FROM product p
        LEFT JOIN category c ON p.category_id = c.id
        LEFT JOIN product_discount d ON p.id = d.product_id AND NOW() BETWEEN d.start_date AND d.end_date
        WHERE p.id = $id
        ";
        
        $product = executeResult($sql, true);
        
        if ($product) {
            $product['discount'] = $product['discounted_price'] ?? $product['price'];
            $_SESSION['wishlist'][] = $product;
            echo json_encode(['success' => true, 'message' => 'Đã thêm vào danh sách yêu thích', 'count' => count($_SESSION['wishlist'])]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm']);
        }
    }

    function removeFromWishlist() {
        $id = intval(getPost('id'));
        
        if (!isset($_SESSION['wishlist'])) {
            echo json_encode(['success' => false, 'message' => 'Danh sách yêu thích trống']);
            return;
        }

        for ($i = 0; $i < count($_SESSION['wishlist']); $i++) {
            if ($_SESSION['wishlist'][$i]['id'] == $id) {
                array_splice($_SESSION['wishlist'], $i, 1);
                echo json_encode(['success' => true, 'message' => 'Đã xóa khỏi danh sách yêu thích', 'count' => count($_SESSION['wishlist'])]);
                return;
            }
        }
        
        echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm trong danh sách yêu thích']);
    }

    function getWishlistCount() {
        $count = isset($_SESSION['wishlist']) ? count($_SESSION['wishlist']) : 0;
        echo json_encode(['count' => $count]);
    }

    

    //cart
    function checkout(){
        if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
            return;
        }

        $fullname = getPost("fullname");
        $email = getPost("email");
        $phone_number = getPost("phone_number");
        $address = getPost("address");
        $shipping_method_id = getPost("shipping_method_id");
        $payment_method_id = getPost("payment_method_id");
        $note = getPost("note");
        $user = getUserToken();
        $userId = "NULL";   
        if ($user != null) {
            $userId = $user['id'];
        }

        $orderDate = date('Y-m-d H:i:s');
        $totalMoney = 0;

        foreach ($_SESSION['cart'] as $item) {
            $totalMoney += $item['discount'] * $item['num'];
        }
        $sql = "INSERT INTO orders(user_id, fullname, email, phone_number, address, note, order_date, status_id, total_money, shipping_method_id, payment_method_id)
            VALUES ($userId, '$fullname', '$email', '$phone_number', '$address', '$note', '$orderDate', 1, '$totalMoney', $shipping_method_id, $payment_method_id)";
        execute($sql);
        $sql = "SELECT id FROM orders WHERE order_date = '$orderDate' ORDER BY id DESC LIMIT 1";
        $orderItem = executeResult($sql, true);
        $orderId = $orderItem['id'];
        foreach ($_SESSION['cart'] as $item) {
            $product_id = $item['id'];
            $variant_id = intval($item['variant_id']);
            $price = $item['discount'];
            $num = $item['num'];
            $totalMoney = $price * $num;

            $sql = "INSERT INTO order_details(order_id, product_id, variant_id, price, num, total_money) 
                    VALUES ($orderId, $product_id, $variant_id, $price , $num, $totalMoney)";
            execute($sql);
            $sql = "UPDATE inventory SET quantity = quantity - $num WHERE variant_id = $variant_id";
            execute($sql);
        }
        unset($_SESSION['cart']);
    }

    function updateCart(){
        $id = getPost('id');    
        $num = getPost('num');
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart']=[];
        }
        for($i=0; $i<count($_SESSION['cart']);$i++){
            if($_SESSION['cart'][$i]['id']==$id){
                $_SESSION['cart'][$i]['num'] =$num;
                if($num ==0){
                    array_splice($_SESSION['cart'],$i,1);
                }
                break;
            }
        }
    }

    function addToCart() {
        $id = intval(getPost('id'));
        $num = max(1, intval(getPost('num')));
        $variant_id = intval(getPost('variant_id'));
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

       foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $id && $item['variant_id'] == $variant_id) {
                $item['num'] += $num;
                return;
            }
        }

        $sql = "
        SELECT p.*, c.name AS category_name,
            d.discount_type, d.value,
            CASE 
                WHEN d.discount_type = 'percent' THEN ROUND(p.price * (1 - d.value / 100), 0)
                WHEN d.discount_type = 'amount' THEN GREATEST(p.price - d.value, 0)
                ELSE p.price
            END AS discounted_price
        FROM product p
        LEFT JOIN category c ON p.category_id = c.id
        LEFT JOIN product_discount d ON p.id = d.product_id AND NOW() BETWEEN d.start_date AND d.end_date
        WHERE p.id = $id
        ";
        $product = executeResult($sql, true);
        $sqlVariant = "SELECT size FROM product_variant WHERE id = $variant_id";
        $variant = executeResult($sqlVariant, true);
        $size = ($variant && isset($variant['size'])) ? $variant['size'] : '';

        if ($product) {
            $product['discount'] = $product['discounted_price'] ?? $product['price'];
            $product['num'] = $num;
            $product['variant_id'] = $variant_id;
            $product['size'] = $size;
            $_SESSION['cart'][] = $product;
        }
    }

?>