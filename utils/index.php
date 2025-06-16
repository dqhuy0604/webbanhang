<?php
session_start();
require_once('utility.php');
require_once('../database/dbhelper.php');
require_once('../layout/header.php');

?>


<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to-right, #667eea, #764ba2);
        margin: 0;
    }

    .chatbot-container {
        position: fixed;
        bottom: 210px;
        left: 80px;
        width: 350px;
        max-height: 400px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        z-index: 10000;
        display: none;
        font-family: 'Poppins', sans-serif;
        padding: 10px;
       
        overflow: hidden;
        
        margin-top: 100px;
    }

    .chatbot-container.active {
        display: block;
    }

    .chatbot-header h2 {
        margin: 0;
        padding-bottom: 10px;
        text-align: center;
        font-size: 16px;
    }

    #chat-box {
        height: 300px;
        overflow-y: auto;
        padding: 10px;
        background: #f9f9f9;
        border-radius: 10px;
        margin-bottom: 10px;
        height: 280px;
    }

    .user-message,
    .bot-message {
        max-width: 75%;
        padding: 10px;
        border-radius: 10px;
        margin: 8px 0;
    }

    .user-message {
        background: #007bff;
        color: #fff;
        text-align: right;
        align-self: flex-end;
    }

    .bot-message {
        background: #8D8D8D;
        color: #fff;
        text-align: left;
        align-self: flex-start;
    }

    .input-container {
        display: flex;

        width: 100%;
        box-sizing: border-box;
        padding: 0 5px;
    }

    #user-input {
        flex: 1;
        padding: 10px;
        border-radius: 20px;
        border: 1px solid #ccc;
        outline: none;
    }

    .buttun {
        padding: 10px 20px;
        margin-left: 10px;
        border-radius: 20px;
        border: none;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    .contact-container {
        position: fixed;
        width: 50px;
        height: 50px;
        left: 20px;
        z-index: 9999;
    }

    .contact-container a {
        display: block;
    }

    .contact-container img {
        max-width: 100%;
        height: auto;
    }

    .contact-container span {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        position: relative;
    }


    /* Lớp chung cho vòng tròn hiệu ứng */
    .cmoz-circle {
        width: 60px;
        height: 60px;
        top: -5px;
        right: -5px;
        position: absolute;
        background-color: transparent;
        border-radius: 100%;
        opacity: 0.5;
    }

    .cmoz-circle-fill {
        width: 70px;
        height: 70px;
        top: -10px;
        right: -10px;
        position: absolute;
        border-radius: 100%;
        border: 2px solid transparent;
    }

    /* Hiệu ứng chung */
    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale3d(0.3, 0.3, 0.3);
        }

        50% {
            opacity: 1;
        }
    }

    @keyframes pulse {
        from {
            transform: scale3d(1, 1, 1);
        }

        50% {
            transform: scale3d(1.1, 1.1, 1.1);
        }

        to {
            transform: scale3d(1, 1, 1);
        }
    }

    /* Hover chung */
    .contact-container:hover .cmoz-circle {
        opacity: 0.7;
    }

    .contact-container:hover .cmoz-circle-fill {
        opacity: 0.9;
    }

    /* Zalo */
    .zalo-container {
        bottom: 30px;
    }

    .zalo-container span {
        background: #00aeef;
    }

    .zalo-container .cmoz-circle {
        border: 2px solid rgba(0, 174, 239, 0.8);
        animation: zoomIn 1s ease-in-out infinite;
    }

    .zalo-container .cmoz-circle-fill {
        background-color: rgba(0, 174, 239, 0.45);
        animation: pulse 1s ease-in-out infinite;
    }

    /* Facebook */
    .facebook-container {
        bottom: 90px;
    }

    .facebook-container span {
        background: #1877f2;
    }

    .facebook-container .cmoz-circle {
        border: 2px solid rgba(24, 119, 242, 0.8);
        animation: zoomIn 1s ease-in-out infinite;
    }

    .facebook-container .cmoz-circle-fill {
        background-color: rgba(24, 119, 242, 0.45);
        animation: pulse 1s ease-in-out infinite;
    }

    /* Phone */
    .phone-container {
        bottom: 150px;
    }

    .phone-container span {
        background: #25d366;
    }

    .phone-container .cmoz-circle {
        border: 2px solid rgba(37, 211, 102, 0.8);
        animation: zoomIn 1s ease-in-out infinite;
    }

    .phone-container .cmoz-circle-fill {
        background-color: rgba(37, 211, 102, 0.45);
        animation: pulse 1s ease-in-out infinite;
    }

    /* Chat */
    .chat-container {
        bottom: 210px;
    }

    .chat-container span {
        background: #ff5733;
    }

    .chat-container .cmoz-circle {
        border: 2px solid rgba(255, 87, 51, 0.8);
        animation: zoomIn 1s ease-in-out infinite;
    }

    .chat-container .cmoz-circle-fill {
        background-color: rgba(255, 87, 51, 0.45);
        animation: pulse 1s ease-in-out infinite;
    }
</style>


<?php

function getProductsWithDiscount($limit = 5, $offset = 0, $orderBy = 'RAND()')
{
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
        LEFT JOIN product_discount d ON p.id = d.product_id 
            AND NOW() BETWEEN d.start_date AND d.end_date
        WHERE p.deleted = 0
        ORDER BY $orderBy
        LIMIT $limit OFFSET $offset
    ";
    return executeResult($sql);
}

$hotdealItems      = getProductsWithDiscount(5);
$hotdealItems_1    = getProductsWithDiscount(5);

$bestsellerItems   = getProductsWithDiscount(5);
$bestsellerItems_1 = getProductsWithDiscount(5);

$lastestItems      = getProductsWithDiscount(5, 0, 'p.updated_at ASC');
$lastestItems_2    = getProductsWithDiscount(5, 5, 'p.updated_at ASC');
?>

<!-- BANNER -->
<div id="demo" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
    </ul>
    <div class="carousel-inner">
        <div class="carousel-item active"><img class="img-banner" src="https://file.hstatic.net/200000037626/file/2banner-trang-chu_1920x890.png"></div>
        <div class="carousel-item"><img class="img-banner" src="https://file.hstatic.net/200000037626/file/banner-san-pham_1440x400.png"></div>
        <div class="carousel-item"><img class="img-banner" src="../assets/images/banner-1.png"></div>
    </div>
    <a class="carousel-control-prev" href="#demo" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
    <a class="carousel-control-next" href="#demo" data-slide="next"><span class="carousel-control-next-icon"></span></a>
</div>

<!-- HOT DEAL -->
<div class="top-title">
    <h2 class="title-section"><span>HOT DEAL &amp; SALE</span></h2>
</div>
<div id="wrapper">
    <ul class="products">
        <?php foreach ($hotdealItems as $item): ?>
            <?= renderProductItem($item, true) ?>
        <?php endforeach ?>
    </ul>
    <ul class="products">
        <?php foreach ($hotdealItems_1 as $item): ?>
            <?= renderProductItem($item, true) ?>
        <?php endforeach ?>
    </ul>
</div>

<!-- BEST SELLER -->
<div class="top-title">
    <h2 class="title-section"><span>BEST SELLER</span></h2>
</div>
<div id="wrapper">
    <ul class="products">
        <?php foreach ($bestsellerItems as $item): ?>
            <?= renderProductItem($item, true) ?>
        <?php endforeach ?>
    </ul>
    <ul class="products">
        <?php foreach ($bestsellerItems_1 as $item): ?>
            <?= renderProductItem($item, true) ?>
        <?php endforeach ?>
    </ul>
</div>

<!-- NEW ARRIVAL -->
<div class="top-title">
    <h2 class="title-section"><span>NEW ARRIVAL</span></h2>
</div>
<div id="wrapper">
    <ul class="products">
        <?php foreach ($lastestItems as $item): ?>
            <?= renderProductItem($item, true) ?>
        <?php endforeach ?>
    </ul>
    <ul class="products">
        <?php foreach ($lastestItems_2 as $item): ?>
            <?= renderProductItem($item, true) ?>
        <?php endforeach ?>
    </ul>
</div>


<!-- button float -->
<div class="chatbot-wrapper">
    <div class="zalo-container contact-container">
        <a id="zalo-btn" href="https://zalo.me/0866753830" target="_blank" rel="noopener nofollow">
            <div class="cmoz-circle"></div>
            <div class="cmoz-circle-fill"></div>
            <span><img src="https://vutruso.com/wp-content/uploads/2024/05/zalo-2.png" alt="Liên hệ qua Zalo"></span>
        </a>
    </div>

    <div class="facebook-container contact-container">
        <a id="facebook-btn" href="https://www.facebook.com/share/1AWeEF3uQW/" target="_blank" rel="noopener nofollow">
            <div class="cmoz-circle"></div>
            <div class="cmoz-circle-fill"></div>
            <span><img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Liên hệ qua Facebook"></span>
        </a>
    </div>

    <div class="phone-container contact-container">
        <a id="phone-btn" href="tel:+your_phone_number" target="_blank" rel="noopener nofollow">
            <div class="cmoz-circle"></div>
            <div class="cmoz-circle-fill"></div>
            <span><img src="https://upload.wikimedia.org/wikipedia/commons/0/0e/Telephone_icon.svg" alt="Gọi điện"></span>
        </a>
    </div>

    <div class="chat-container contact-container">
        <a id="chat-btn" href="javascript:void(0)">
            <div class="cmoz-circle"></div>
            <div class="cmoz-circle-fill"></div>
            <span><img src="https://cdn-icons-png.flaticon.com/512/10367/10367879.png" alt="Chat với tôi"></span>

        </a>
    </div>
    <!-- chatbot -->

    <div class="chatbot-container" id="chatbot">
        <div class="chatbot-header">
            <h2>Chatbot AI</h2>
        </div>
        <div id="chat-box"></div>
        <div class="input-container">
            <input type="text" id="user-input" placeholder="Type your message here...">
            <button class="buttun" onclick="sendMessage()">Send</button>
        </div>
    </div>
</div>
<!-- JS CHAT BOT -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const chatBtn = document.getElementById("chat-btn");
        const chatbot = document.getElementById("chatbot");

        // Toggle khung chatbot
        chatBtn.addEventListener("click", function(e) {
            e.preventDefault();
            chatbot.classList.toggle("active");
            console.log('Đã nhấn nút Chat!');
        });
    });
    // Xử lý sự kiện click cho tất cả các nút
    const buttons = [{
            id: 'zalo-btn',
            name: 'Zalo'
        },
        {
            id: 'facebook-btn',
            name: 'Facebook'
        },
        {
            id: 'phone-btn',
            name: 'Số điện thoại'
        },
        {
            id: 'chat-btn',
            name: 'Chat'
        }
    ];

    buttons.forEach(button => {
        document.getElementById(button.id).addEventListener('click', function() {
            console.log(`Đã nhấn nút ${button.name}!`);
            // Thêm mã theo dõi phân tích tại đây nếu cần
        });
    });
</script>
<script>
    async function sendMessage() {
        const userInput = document.getElementById('user-input').value.trim();
        if (!userInput) return;

        const chatBox = document.getElementById('chat-box');

        // Hiển thị tin nhắn người dùng
        const userMessage = document.createElement('div');
        userMessage.className = 'user-message';
        userMessage.textContent = userInput;
        chatBox.appendChild(userMessage);

        const messageLower = userInput.toLowerCase();

        // Kiểm tra intent tuỳ chỉnh
        try {
            const intentRes = await fetch("../utils/check_intent.php", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    message: userInput
                })
            }).then(res => res.json());

            if (intentRes.response) {
                const botMessage = document.createElement('div');
                botMessage.className = 'bot-message';
                botMessage.textContent = `Bot: ${intentRes.response}`;
                chatBox.appendChild(botMessage);
                document.getElementById('user-input').value = "";
                chatBox.scrollTop = chatBox.scrollHeight;
                return;
            }
        } catch (error) {
            console.error("Lỗi kiểm tra intent:", error);
        }

        //Kiểm tra keyword sản phẩm
        const productKeywords = ['jordan', 'adidas', 'nike', 'puma', 'li-ning'];
        const matchedKeyword = productKeywords.find(kw => messageLower.includes(kw));

        try {
            let data;

            if (matchedKeyword) {
                data = await fetch(`../utils/search_product.php?keyword=${encodeURIComponent(matchedKeyword)}`)
                    .then(res => res.json());

                const botMessage = document.createElement('div');
                botMessage.className = 'bot-message';
                botMessage.innerHTML = `Bot: Dưới đây là những sản phẩm phù hợp:<br>${data.html}`;
                chatBox.appendChild(botMessage);
            } else {
                //Không có gì khớp gọi chatbot AI
                data = await fetch("../utils/chatbot.php", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        message: userInput
                    })
                }).then(res => res.json());

                const botMessage = document.createElement('div');
                botMessage.className = 'bot-message';
                botMessage.textContent = `Bot: ${data.response || data.error || "Không có phản hồi"}`;
                chatBox.appendChild(botMessage);
            }
        } catch (error) {
            const errorMessage = document.createElement('div');
            errorMessage.className = 'bot-message';
            errorMessage.textContent = `Bot: Đã xảy ra lỗi, vui lòng thử lại sau.`;
            chatBox.appendChild(errorMessage);
        }

        document.getElementById('user-input').value = "";
        chatBox.scrollTop = chatBox.scrollHeight;
    }
</script>
<!-- INSTAGRAM -->
<section id="section-instagram" class="pd-top-30">
    <div class="top-title-instar">
        <h2 class="title-section d-flex-center js-center d-flex"><span>FOLLOW US ON INSTAGRAM @hudoshop.vn</span></h2>
    </div>
    <div class="box-img">
        <div class="img-bottom"><img src="../assets/images/bongro-4.png" width="300" height="300"></div>
        <div class="img-bottom"><img src="../assets/images/bongro-1.png" width="300" height="300"></div>
        <div class="img-bottom"><img src="../assets/images/bongro-2.png" width="300" height="300"></div>
        <div class="img-bottom"><img src="../assets/images/bongro-1.png" width="300" height="300"></div>
        <div class="img-bottom"><img src="../assets/images/bongro-3.png" width="300" height="300"></div>
        <div class="img-bottom"><img src="../assets/images/bongro-4.png" width="300" height="300"></div>
    </div>
</section>

<?php require_once('../layout/footer.php'); ?>

</body>

</html>

<?php

function renderProductItem($item, $showSaleTag = false)
{
    $originalPrice = $item['price'];
    $discountedPrice = $item['discounted_price'] ?? $originalPrice;
    $discountPercent = ($originalPrice > 0 && $discountedPrice < $originalPrice)
        ? round(100 - ($discountedPrice / $originalPrice * 100)) : 0;

    ob_start(); ?>
    <li>
        <div class="product-item">
            <div class="product-top">
                <a href="detail.php?id=<?= $item['id'] ?>" class="product-thumb">
                    <img class="dt-width-100" src="../<?= $item['thumbnail'] ?>" alt="" width="260" height="260">
                    <img class="dt-width-100 img-hover" src="../<?= $item['thumbnail_2'] ?>" alt="" width="260" height="260">
                </a>
                <a class="buy-now">
                    <div class="product-icon-add"><button onclick="location.href='detail.php?id=<?= $item['id'] ?>'">Thêm vào giỏ</button></div>
                    <div class="product-icon-watch"><button onclick="location.href='detail.php?id=<?= $item['id'] ?>'"> Xem nhanh</button></div>
                </a>
                <?php if ($showSaleTag && $discountPercent > 0): ?>
                    <div class="product-sale"><span>-<?= $discountPercent ?>%</span></div>
                <?php endif ?>


                <div class="product-wishlist">
                    <button class="wishlist-loop" data-toggle="tooltip" title="Yêu thích">
                        <img width="20" height="20" src="//theme.hstatic.net/200000037626/1000890916/14/heart.svg?v=147" alt="Yêu thích">
                    </button>
                </div>


            </div>
            <div class="product-infor">
                <h3 class="pro-name">
                    <a href="detail.php?id=<?= $item['id'] ?>" class="product-name"><?= $item['title'] ?></a>
                </h3>
                <div class="product-price">
                    <p class="pro-price">
                        <span><?= number_format($discountedPrice) ?>đ</span>
                        <?php if ($discountedPrice < $originalPrice): ?>
                            <del class="compare-price"><?= number_format($originalPrice) ?>đ</del>
                        <?php endif ?>
                    </p>
                </div>
            </div>
        </div>
    </li>
<?php return ob_get_clean();
}

?>
<!-- js  -->
<script>

</script>
<!-- js wishlist -->
<script>
    function getWishlist() {
        return JSON.parse(localStorage.getItem('wishlist') || '[]');
    }

    function saveWishlist(list) {
        localStorage.setItem('wishlist', JSON.stringify(list));
    }

    function toggleWishlist(productId) {
        let wishlist = getWishlist();
        const index = wishlist.indexOf(productId);

        if (index > -1) {
            wishlist.splice(index, 1); // xoá khỏi wishlist
            alert('Đã xoá khỏi yêu thích!');
        } else {
            wishlist.push(productId); // thêm vào wishlist
            alert('Đã thêm vào yêu thích!');
        }

        saveWishlist(wishlist);
        updateWishlistHeader();
    }

    function updateWishlistHeader() {
        const count = getWishlist().length;
        const headerEl = document.querySelector('#wishlist-count');
        if (headerEl) {
            headerEl.textContent = count;
        }
    }

    // Gán sự kiện click
    document.querySelectorAll('.wishlist-loop').forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = parseInt(this.dataset.productId);
            toggleWishlist(productId);
        });
    });

    // Cập nhật icon header khi load trang
    updateWishlistHeader();
</script>