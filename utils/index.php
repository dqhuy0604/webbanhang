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
        background: #fff;
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
        overflow-x: hidden;
        padding: 10px;
        background: #f9f9f9;
        border-radius: 10px;
        margin-bottom: 10px;
        height: 280px;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

   
    #chat-box::-webkit-scrollbar {
        display: none;
    }
    #chat-box::-webkit-scrollbar {
        width: 0px;
        background: transparent;
    
    }

    #chat-box::-webkit-scrollbar-thumb {
        background: transparent;
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

        color: black;
        text-align: left;
        align-self: flex-start;
        max-width: 130%;
        padding: auto;
        border-radius: 12px;
        margin: 8px 0;
        word-wrap: break-word;
        line-height: 1.4;
        border-bottom-left-radius: 4px;
    }

    /* Styling cho product results trong bot message */
    .bot-message .search-results-grid {
        margin-top: 8px;
        padding: 0 !important;
    }

    .bot-message .search-result-item {
        margin-bottom: 8px !important;
        border-radius: 8px !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08) !important;
        transition: all 0.2s ease !important;
    }

    .bot-message .search-result-item:hover {
        transform: translateY(-1px) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12) !important;
    }

    .bot-message .search-result-item img {
        border-radius: 6px !important;
        border: 1px solid #f0f0f0 !important;
    }

    .bot-message .search-result-item a {
        color: #333 !important;
        text-decoration: none !important;
    }

    .bot-message .search-result-item a:hover {
        color: #667eea !important;
    }

    /* Responsive cho product grid trong chat */
    @media (max-width: 480px) {
        .bot-message .search-results-grid {
            grid-template-columns: 1fr !important;
            gap: 8px !important;
        }
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
        <a id="phone-btn" href="tel:08667538" target="_blank" rel="noopener nofollow">
            <div class="cmoz-circle"></div>
            <div class="cmoz-circle-fill"></div>
            <span class="phone-i"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="256" height="256" viewBox="0 0 256 256" xml:space="preserve">
                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                        <path d="M 16.639 2.864 c 0.071 0 0.142 0.001 0.215 0.003 c 0.131 0.003 0.261 0.011 0.388 0.019 c 0.171 0.011 0.342 0.024 0.513 0.044 c 0.137 0.016 0.273 0.038 0.409 0.059 c 0.162 0.026 0.323 0.051 0.487 0.086 c 0.129 0.027 0.255 0.061 0.425 0.104 l 0.056 0.015 c 0.133 0.034 0.266 0.067 0.398 0.108 c 0.123 0.038 0.244 0.084 0.366 0.128 l 0.076 0.028 l 0.124 0.045 c 0.098 0.035 0.197 0.07 0.294 0.11 c 0.122 0.051 0.242 0.11 0.362 0.168 l 0.094 0.045 l 0.165 0.078 c 0.072 0.034 0.144 0.066 0.215 0.104 c 0.125 0.067 0.246 0.143 0.368 0.217 l 0.099 0.061 l 0.192 0.115 c 0.047 0.028 0.096 0.054 0.143 0.086 c 0.153 0.102 0.3 0.217 0.447 0.33 l 0.054 0.041 c 0.067 0.051 0.135 0.101 0.203 0.15 l 0.059 0.042 c 0.257 0.21 0.499 0.429 0.72 0.649 l 8.159 8.159 c 0.221 0.221 0.439 0.463 0.641 0.709 l 0.053 0.072 c 0.049 0.068 0.098 0.135 0.149 0.202 l 0.046 0.061 c 0.111 0.145 0.223 0.288 0.324 0.44 c 0.032 0.048 0.059 0.098 0.088 0.147 l 0.112 0.188 l 0.063 0.103 c 0.074 0.12 0.149 0.24 0.215 0.365 c 0.038 0.071 0.071 0.144 0.104 0.216 l 0.077 0.163 l 0.046 0.096 c 0.057 0.119 0.116 0.238 0.167 0.36 c 0.04 0.095 0.073 0.192 0.108 0.289 l 0.046 0.127 l 0.028 0.076 c 0.045 0.122 0.09 0.244 0.129 0.37 c 0.04 0.128 0.072 0.258 0.105 0.388 l 0.024 0.095 c 0.034 0.132 0.069 0.264 0.098 0.399 c 0.034 0.159 0.059 0.319 0.084 0.48 c 0.022 0.138 0.044 0.275 0.06 0.415 c 0.02 0.17 0.032 0.34 0.043 0.509 c 0.008 0.13 0.016 0.259 0.019 0.389 c 0.004 0.179 0.003 0.358 -0.002 0.536 c -0.004 0.121 -0.009 0.242 -0.017 0.364 c -0.012 0.187 -0.03 0.373 -0.052 0.555 c -0.014 0.111 -0.03 0.222 -0.048 0.334 c -0.031 0.194 -0.065 0.386 -0.107 0.577 c -0.02 0.09 -0.043 0.178 -0.073 0.297 c -0.05 0.199 -0.104 0.398 -0.166 0.593 c -0.016 0.051 -0.035 0.101 -0.053 0.152 l -0.038 0.106 c -0.072 0.204 -0.146 0.407 -0.231 0.605 l -0.037 0.079 l -0.064 0.137 c -0.096 0.209 -0.194 0.416 -0.316 0.637 l -0.087 0.148 c -0.145 0.253 -0.259 0.439 -0.365 0.597 c -0.034 0.045 -0.067 0.09 -0.099 0.135 c -0.186 0.266 -0.343 0.474 -0.494 0.654 c -0.229 0.274 -0.408 0.473 -0.58 0.645 l -5.52 5.52 c -1.876 1.876 -1.876 4.927 0 6.803 l 23.86 23.86 c 0.909 0.909 2.117 1.409 3.402 1.409 c 1.285 0 2.493 -0.5 3.402 -1.409 l 5.52 -5.52 c 0.172 -0.172 0.371 -0.351 0.645 -0.581 c 0.181 -0.151 0.389 -0.309 0.654 -0.495 c 0.043 -0.03 0.085 -0.061 0.133 -0.097 c 0.16 -0.108 0.348 -0.223 0.604 -0.37 l 0.158 -0.095 c 0.204 -0.112 0.413 -0.21 0.624 -0.307 l 0.135 -0.063 l 0.074 -0.035 c 0.201 -0.086 0.405 -0.161 0.613 -0.234 l 0.106 -0.038 c 0.048 -0.017 0.096 -0.035 0.145 -0.051 c 0.198 -0.063 0.397 -0.117 0.629 -0.176 c 0.087 -0.022 0.174 -0.045 0.262 -0.064 c 0.193 -0.042 0.386 -0.077 0.583 -0.108 c 0.109 -0.017 0.218 -0.034 0.326 -0.047 c 0.187 -0.023 0.373 -0.04 0.565 -0.053 c 0.119 -0.008 0.239 -0.013 0.357 -0.017 c 0.108 -0.003 0.216 -0.005 0.325 -0.005 c 0.071 0 0.142 0.001 0.214 0.003 c 0.13 0.003 0.26 0.011 0.388 0.019 c 0.171 0.011 0.341 0.024 0.513 0.044 c 0.137 0.016 0.273 0.038 0.409 0.059 c 0.162 0.026 0.323 0.051 0.486 0.086 c 0.128 0.027 0.255 0.061 0.425 0.104 l 0.056 0.014 c 0.133 0.034 0.266 0.067 0.398 0.108 c 0.123 0.038 0.244 0.084 0.366 0.128 l 0.076 0.028 l 0.124 0.045 c 0.098 0.035 0.197 0.07 0.295 0.11 c 0.122 0.051 0.241 0.11 0.361 0.167 l 0.095 0.045 l 0.165 0.078 c 0.072 0.034 0.144 0.066 0.215 0.104 c 0.125 0.067 0.246 0.143 0.368 0.217 l 0.099 0.061 l 0.192 0.115 c 0.047 0.028 0.096 0.054 0.143 0.086 c 0.153 0.102 0.3 0.217 0.448 0.33 l 0.054 0.041 c 0.067 0.051 0.135 0.101 0.203 0.15 l 0.059 0.042 c 0.257 0.21 0.499 0.429 0.72 0.649 l 8.159 8.159 c 0.221 0.221 0.439 0.463 0.641 0.709 l 0.053 0.072 c 0.049 0.068 0.098 0.135 0.149 0.202 l 0.045 0.06 c 0.111 0.145 0.224 0.289 0.325 0.441 c 0.032 0.048 0.059 0.098 0.088 0.147 l 0.112 0.188 l 0.063 0.103 c 0.074 0.12 0.149 0.24 0.215 0.365 c 0.038 0.071 0.071 0.144 0.105 0.216 l 0.077 0.163 l 0.047 0.097 c 0.057 0.119 0.115 0.237 0.166 0.358 c 0.04 0.095 0.073 0.192 0.108 0.288 l 0.046 0.127 l 0.028 0.078 c 0.044 0.122 0.09 0.243 0.129 0.368 c 0.04 0.128 0.072 0.257 0.105 0.386 l 0.024 0.095 c 0.034 0.133 0.069 0.265 0.098 0.401 c 0.034 0.159 0.059 0.319 0.084 0.479 c 0.022 0.138 0.044 0.275 0.06 0.415 c 0.02 0.17 0.032 0.34 0.043 0.509 c 0.008 0.129 0.016 0.259 0.019 0.389 c 0.004 0.179 0.003 0.358 -0.002 0.535 c -0.004 0.121 -0.009 0.242 -0.017 0.364 c -0.012 0.187 -0.03 0.373 -0.052 0.555 c -0.014 0.111 -0.03 0.222 -0.048 0.334 c -0.031 0.194 -0.065 0.386 -0.107 0.577 c -0.02 0.09 -0.043 0.178 -0.073 0.297 c -0.05 0.2 -0.104 0.398 -0.166 0.593 c -0.016 0.051 -0.035 0.102 -0.053 0.152 l -0.038 0.106 c -0.072 0.204 -0.146 0.407 -0.231 0.605 l -0.037 0.079 l -0.064 0.137 c -0.096 0.209 -0.194 0.416 -0.316 0.637 l -0.087 0.148 c -0.145 0.253 -0.259 0.439 -0.365 0.597 c -0.034 0.045 -0.067 0.09 -0.099 0.135 c -0.186 0.266 -0.343 0.474 -0.494 0.653 c -0.229 0.274 -0.408 0.473 -0.58 0.645 l -0.026 0.026 l -0.026 0.027 c -3.996 4.199 -10.029 6.512 -16.988 6.512 c -12.981 0 -27.91 -7.839 -42.053 -22.089 C 10.839 50.511 3 35.464 3.138 22.403 C 3.21 15.59 5.522 9.675 9.649 5.749 l 0.027 -0.026 l 0.026 -0.026 c 0.172 -0.172 0.371 -0.351 0.645 -0.581 c 0.181 -0.151 0.389 -0.309 0.655 -0.495 c 0.043 -0.03 0.085 -0.061 0.133 -0.097 c 0.16 -0.108 0.348 -0.223 0.605 -0.37 l 0.158 -0.095 c 0.204 -0.112 0.413 -0.21 0.624 -0.307 l 0.135 -0.063 l 0.074 -0.035 c 0.201 -0.086 0.406 -0.161 0.613 -0.234 l 0.106 -0.038 c 0.049 -0.017 0.097 -0.035 0.145 -0.051 c 0.198 -0.063 0.397 -0.117 0.629 -0.176 c 0.087 -0.022 0.174 -0.045 0.262 -0.064 c 0.193 -0.042 0.386 -0.077 0.583 -0.108 c 0.109 -0.017 0.218 -0.034 0.325 -0.047 c 0.187 -0.023 0.373 -0.04 0.565 -0.053 c 0.119 -0.008 0.239 -0.013 0.357 -0.017 C 16.423 2.865 16.531 2.864 16.639 2.864 M 16.639 -0.136 c -0.138 0 -0.275 0.002 -0.413 0.006 c -0.157 0.005 -0.313 0.012 -0.469 0.022 c -0.244 0.016 -0.488 0.039 -0.731 0.069 C 14.883 -0.021 14.741 0 14.599 0.022 c -0.254 0.04 -0.506 0.086 -0.758 0.141 c -0.128 0.028 -0.255 0.061 -0.382 0.093 c -0.262 0.066 -0.522 0.137 -0.781 0.22 c -0.111 0.036 -0.221 0.077 -0.331 0.115 c -0.269 0.095 -0.536 0.194 -0.8 0.307 c -0.093 0.04 -0.184 0.085 -0.276 0.128 c -0.275 0.126 -0.548 0.257 -0.815 0.403 c -0.072 0.04 -0.142 0.084 -0.213 0.126 c -0.282 0.162 -0.56 0.329 -0.831 0.514 c -0.044 0.03 -0.086 0.065 -0.13 0.095 C 8.989 2.369 8.701 2.582 8.423 2.815 l 0 0 c -0.288 0.241 -0.572 0.49 -0.842 0.76 C -3.732 14.34 -4.744 39.272 23.096 66.904 c 16.498 16.622 32.035 22.96 44.167 22.96 c 8.188 0 14.824 -2.886 19.162 -7.444 c 0.27 -0.27 0.52 -0.554 0.76 -0.842 c 0 0 0 0 0 0 c 0.232 -0.277 0.444 -0.564 0.649 -0.855 c 0.032 -0.045 0.067 -0.088 0.098 -0.134 c 0.184 -0.27 0.35 -0.547 0.511 -0.827 c 0.042 -0.073 0.088 -0.144 0.128 -0.218 c 0.146 -0.266 0.276 -0.537 0.401 -0.811 c 0.043 -0.094 0.089 -0.186 0.13 -0.28 c 0.113 -0.262 0.211 -0.528 0.305 -0.796 c 0.039 -0.112 0.081 -0.223 0.117 -0.336 c 0.082 -0.257 0.153 -0.516 0.219 -0.777 c 0.033 -0.129 0.065 -0.257 0.094 -0.386 c 0.055 -0.25 0.1 -0.501 0.14 -0.754 c 0.023 -0.144 0.044 -0.287 0.062 -0.432 c 0.03 -0.242 0.052 -0.484 0.068 -0.727 c 0.01 -0.158 0.018 -0.315 0.022 -0.473 c 0.007 -0.233 0.008 -0.465 0.003 -0.698 c -0.004 -0.169 -0.013 -0.338 -0.024 -0.507 c -0.014 -0.222 -0.031 -0.444 -0.057 -0.665 c -0.021 -0.18 -0.049 -0.359 -0.077 -0.539 c -0.033 -0.21 -0.067 -0.419 -0.111 -0.627 c -0.04 -0.189 -0.089 -0.376 -0.137 -0.564 c -0.051 -0.197 -0.1 -0.393 -0.161 -0.587 c -0.061 -0.196 -0.133 -0.389 -0.203 -0.583 c -0.066 -0.182 -0.129 -0.365 -0.204 -0.545 c -0.084 -0.202 -0.181 -0.398 -0.276 -0.596 c -0.08 -0.167 -0.154 -0.335 -0.242 -0.498 c -0.111 -0.209 -0.238 -0.41 -0.361 -0.614 c -0.089 -0.146 -0.171 -0.296 -0.267 -0.439 c -0.15 -0.225 -0.317 -0.441 -0.483 -0.658 c -0.087 -0.114 -0.165 -0.232 -0.256 -0.343 c -0.265 -0.324 -0.548 -0.639 -0.85 -0.941 l -8.159 -8.159 c -0.302 -0.302 -0.617 -0.584 -0.941 -0.85 c -0.111 -0.091 -0.228 -0.168 -0.341 -0.255 c -0.218 -0.166 -0.434 -0.334 -0.66 -0.484 c -0.143 -0.095 -0.291 -0.176 -0.437 -0.265 c -0.204 -0.124 -0.406 -0.251 -0.615 -0.362 c -0.163 -0.087 -0.331 -0.162 -0.497 -0.241 c -0.198 -0.095 -0.396 -0.192 -0.598 -0.276 c -0.18 -0.075 -0.364 -0.138 -0.547 -0.205 c -0.193 -0.07 -0.384 -0.141 -0.58 -0.202 c -0.196 -0.061 -0.394 -0.111 -0.592 -0.162 c -0.186 -0.048 -0.372 -0.096 -0.559 -0.136 c -0.21 -0.044 -0.42 -0.079 -0.631 -0.112 c -0.178 -0.028 -0.356 -0.056 -0.535 -0.077 c -0.222 -0.026 -0.444 -0.043 -0.667 -0.057 c -0.169 -0.011 -0.337 -0.02 -0.506 -0.024 c -0.096 -0.002 -0.192 -0.003 -0.287 -0.003 c -0.138 0 -0.275 0.002 -0.413 0.006 c -0.157 0.005 -0.313 0.012 -0.469 0.022 c -0.244 0.016 -0.488 0.039 -0.731 0.069 c -0.143 0.018 -0.285 0.039 -0.428 0.061 c -0.254 0.04 -0.506 0.086 -0.758 0.141 c -0.128 0.028 -0.255 0.061 -0.382 0.093 c -0.262 0.066 -0.522 0.137 -0.781 0.22 c -0.111 0.036 -0.221 0.077 -0.331 0.115 c -0.269 0.095 -0.536 0.194 -0.8 0.307 c -0.093 0.04 -0.184 0.085 -0.276 0.128 c -0.275 0.126 -0.548 0.257 -0.815 0.403 c -0.072 0.04 -0.142 0.084 -0.213 0.126 c -0.282 0.162 -0.56 0.329 -0.831 0.514 c -0.044 0.03 -0.086 0.065 -0.13 0.095 c -0.293 0.205 -0.581 0.418 -0.859 0.651 l 0 0 c -0.288 0.241 -0.572 0.49 -0.842 0.76 l -5.52 5.52 c -0.354 0.354 -0.817 0.53 -1.28 0.53 c -0.463 0 -0.927 -0.177 -1.28 -0.53 L 28.272 37.867 c -0.707 -0.707 -0.707 -1.854 0 -2.561 l 5.52 -5.52 c 0.27 -0.27 0.52 -0.554 0.761 -0.842 c 0 0 0 0 0 0 c 0.232 -0.277 0.444 -0.564 0.649 -0.855 c 0.032 -0.045 0.067 -0.088 0.098 -0.134 c 0.184 -0.27 0.35 -0.547 0.511 -0.827 c 0.042 -0.073 0.088 -0.144 0.128 -0.218 c 0.146 -0.266 0.276 -0.537 0.401 -0.811 c 0.043 -0.094 0.089 -0.186 0.13 -0.28 c 0.113 -0.262 0.211 -0.528 0.305 -0.796 c 0.039 -0.112 0.081 -0.223 0.117 -0.336 c 0.082 -0.257 0.153 -0.516 0.219 -0.777 c 0.033 -0.129 0.065 -0.257 0.094 -0.386 c 0.055 -0.25 0.1 -0.501 0.14 -0.754 c 0.023 -0.144 0.044 -0.287 0.062 -0.432 c 0.03 -0.242 0.052 -0.484 0.068 -0.727 c 0.011 -0.158 0.018 -0.315 0.022 -0.473 c 0.007 -0.233 0.008 -0.465 0.003 -0.698 c -0.004 -0.169 -0.013 -0.338 -0.024 -0.507 c -0.014 -0.222 -0.031 -0.444 -0.057 -0.665 c -0.021 -0.18 -0.049 -0.359 -0.077 -0.539 c -0.033 -0.21 -0.068 -0.419 -0.111 -0.627 c -0.04 -0.189 -0.089 -0.376 -0.137 -0.564 c -0.051 -0.197 -0.1 -0.393 -0.161 -0.587 c -0.061 -0.196 -0.133 -0.389 -0.203 -0.583 c -0.066 -0.182 -0.129 -0.365 -0.204 -0.545 c -0.084 -0.202 -0.181 -0.398 -0.276 -0.596 c -0.08 -0.167 -0.154 -0.335 -0.242 -0.498 c -0.111 -0.209 -0.238 -0.41 -0.361 -0.614 c -0.089 -0.146 -0.171 -0.296 -0.267 -0.439 c -0.15 -0.225 -0.317 -0.441 -0.483 -0.658 c -0.087 -0.114 -0.165 -0.232 -0.256 -0.343 c -0.265 -0.324 -0.548 -0.639 -0.85 -0.941 l -8.159 -8.159 c -0.302 -0.302 -0.617 -0.584 -0.941 -0.85 c -0.111 -0.091 -0.228 -0.168 -0.342 -0.255 c -0.218 -0.166 -0.434 -0.334 -0.66 -0.484 c -0.143 -0.095 -0.291 -0.176 -0.437 -0.265 c -0.204 -0.124 -0.406 -0.251 -0.615 -0.362 c -0.163 -0.087 -0.331 -0.162 -0.497 -0.241 c -0.198 -0.095 -0.396 -0.192 -0.598 -0.276 c -0.18 -0.075 -0.364 -0.138 -0.547 -0.205 c -0.193 -0.07 -0.384 -0.141 -0.58 -0.202 c -0.196 -0.061 -0.394 -0.111 -0.592 -0.162 c -0.186 -0.048 -0.372 -0.096 -0.559 -0.136 c -0.21 -0.044 -0.42 -0.079 -0.631 -0.112 c -0.178 -0.028 -0.356 -0.056 -0.535 -0.077 c -0.222 -0.026 -0.444 -0.043 -0.667 -0.057 c -0.169 -0.011 -0.337 -0.02 -0.506 -0.024 C 16.831 -0.135 16.735 -0.136 16.639 -0.136 L 16.639 -0.136 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                    </g>
                </svg></span>
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
    // Hàm bỏ dấu tiếng Việt
function removeVietnameseAccents(str) {
    return str
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .replace(/đ/g, 'd')
        .replace(/Đ/g, 'D');
}

// Định nghĩa keywords sản phẩm với phân loại
const productKeywords = {
    brands: {
        nike: ['nike', 'jordan', 'air jordan', 'air max', 'air force'],
        adidas: ['adidas', 'yeezy', 'ultraboost', 'stan smith'],
        puma: ['puma', 'suede', 'rs-x'],
        lining: ['li-ning', 'lining', 'li ning', 'way of wade']
    },
    types: {
        shoes: ['giay', 'giày', 'giay dep', 'giày đẹp', 'sneaker', 'giay the thao', 'giày thể thao', 'giay nike', 'giay adidas'],
        clothing: ['ao', 'áo', 'ao bong da', 'áo bóng đá', 'ao thun', 'áo thun', 'quan', 'quần', 'shorts'],
        accessories: ['balo', 'ba lo', 'tui', 'túi', 'mu', 'mũ', 'tat', 'tất'],
        sports: ['bong', 'bóng', 'bong da', 'bóng đá', 'bong ro', 'bóng rổ', 'tennis']
    }
};

// Hàm phân loại sản phẩm (TRƯỜNG HỢP 1: Tìm theo keyword/category)
function classifyProduct(message) {
    const messageNormalized = removeVietnameseAccents(message.toLowerCase());
    
    let result = {
        brand: null,
        type: null,
        category: null,
        matchedKeywords: [],
        searchKeyword: null
    };
    
    // Tìm brand
    for (const [brand, keywords] of Object.entries(productKeywords.brands)) {
        const matchedBrand = keywords.find(kw => {
            const kwNormalized = removeVietnameseAccents(kw.toLowerCase());
            return messageNormalized.includes(kwNormalized);
        });
        if (matchedBrand) {
            result.brand = brand;
            result.matchedKeywords.push(matchedBrand);
            result.searchKeyword = matchedBrand; // Dùng keyword gốc để search
            break;
        }
    }
    
    // Tìm type
    for (const [type, keywords] of Object.entries(productKeywords.types)) {
        const matchedType = keywords.find(kw => {
            const kwNormalized = removeVietnameseAccents(kw.toLowerCase());
            return messageNormalized.includes(kwNormalized);
        });
        if (matchedType) {
            result.type = type;
            result.matchedKeywords.push(matchedType);
            // Nếu chưa có searchKeyword từ brand, dùng type
            if (!result.searchKeyword) {
                result.searchKeyword = matchedType;
            }
            break;
        }
    }
    
    // Xác định category
    if (result.brand && result.type) {
        result.category = `${result.brand}_${result.type}`;
    } else if (result.brand) {
        result.category = result.brand;
    } else if (result.type) {
        result.category = result.type;
    }
    
    return result;
}

// HÀM MỚI: Xử lý tìm kiếm theo tên cụ thể (TRƯỜNG HỢP 2)
function checkSpecificProductQuery(message) {
    const specificPatterns = [
        // Hỏi có bán không
        /(?:có|co)\s*(?:bán|ban)?\s*(.+?)\s*(?:không|khong|\?)/i,
        // Hỏi về giá
        /(?:giá|gia)\s*(?:của|cua)?\s*(.+?)(?:\s*(?:là|la)\s*(?:bao|bao nhieu|bao nhiêu|gi|gì))?[\?\s]*$/i,
        // Tìm kiếm trực tiếp
        /(?:tìm|tim)\s*(?:kiếm|kiem)?\s*(.+)/i,
        // Hỏi về thông tin
        /(?:cho|cho tôi|cho toi)\s*(?:biết|biet)\s*(?:về|ve)?\s*(.+)/i,
        /(?:thông tin|thong tin)\s*(?:về|ve)\s*(.+)/i,
        // Câu hỏi đảo ngược
        /(.+?)\s*(?:có|co)\s*(?:bán|ban)?\s*(?:không|khong|\?)/i,
        // Hỏi trực tiếp tên sản phẩm
        /^(.+?)\s*[\?\s]*$/i
    ];
    
    // Loại bỏ các từ chung chung không phải tên sản phẩm
    const excludePatterns = [
        /^(?:xin chào|chào|hello|hi|cảm ơn|cam on|thanks|bye|tạm biệt|tam biet)$/i,
        /^(?:bạn|ban)\s+(?:có thể|co the|làm|lam|giúp|giup)/i,
        /^(?:làm|lam)\s+(?:sao|thế nào|the nao)/i
    ];
    
    const messageNormalized = removeVietnameseAccents(message.toLowerCase().trim());
    
    // Kiểm tra xem có phải câu chào hỏi hay câu hỏi chung không
    for (let exclude of excludePatterns) {
        if (exclude.test(messageNormalized)) {
            return { isSpecific: false };
        }
    }
    
    for (let pattern of specificPatterns) {
        const match = message.match(pattern);
        if (match && match[1]) {
            let productName = match[1].trim();
            
            // Loại bỏ các từ không cần thiết
            productName = productName.replace(/^(?:về|ve|của|cua|sản phẩm|san pham)\s*/i, '');
            productName = productName.replace(/\s*(?:này|nay|đó|do|kia)$/i, '');
            
            // Kiểm tra độ dài tên sản phẩm (tránh query quá ngắn)
            if (productName.length >= 2) {
                return {
                    isSpecific: true,
                    productName: productName
                };
            }
        }
    }
    
    return { isSpecific: false };
}

// HÀM MỚI: Xử lý response cho tìm kiếm cụ thể
async function handleSpecificProductSearch(productName, chatBox) {
    try {
        const data = await fetch(`../utils/search_product.php?keyword=${encodeURIComponent(productName)}`)
            .then(res => res.json());

        const botMessage = document.createElement('div');
        botMessage.className = 'bot-message';

        if (data.exact_product) {
            // Tìm thấy sản phẩm chính xác
            botMessage.innerHTML = `Tìm thấy sản phẩm: ${productName}<br>${data.html}`;
        } else if (data.exact_product_not_found) {
            // Không tìm thấy sản phẩm chính xác
            botMessage.textContent = `Bot: Không tìm thấy sản phẩm "${productName}".`;
        } else if (data.html && data.html.trim()) {
            // Tìm thấy sản phẩm tương tự
            botMessage.innerHTML = `Không tìm thấy chính xác "${productName}", nhưng có những sản phẩm tương tự:<br>${data.html}`;
        } else {
            // Không tìm thấy gì
            botMessage.textContent = `Bot: Không tìm thấy sản phẩm "${productName}".`;
        }

        chatBox.appendChild(botMessage);
        return true;
    } catch (error) {
        console.error("Lỗi tìm kiếm sản phẩm cụ thể:", error);
        
        const errorMessage = document.createElement('div');
        errorMessage.className = 'bot-message';
        errorMessage.textContent = `Bot: Đã xảy ra lỗi khi tìm kiếm sản phẩm "${productName}". Vui lòng thử lại sau.`;
        chatBox.appendChild(errorMessage);
        return false;
    }
}

async function sendMessage() {
    const userInput = document.getElementById('user-input').value.trim();
    if (!userInput) return;

    const chatBox = document.getElementById('chat-box');

    // Hiển thị tin nhắn người dùng
    const userMessage = document.createElement('div');
    userMessage.className = 'user-message';
    userMessage.textContent = userInput;
    chatBox.appendChild(userMessage);

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

    // TRƯỜNG HỢP 2: Kiểm tra tìm kiếm theo tên cụ thể
    const specificQuery = checkSpecificProductQuery(userInput);
    
    if (specificQuery.isSpecific) {
        console.log('Tìm kiếm sản phẩm cụ thể:', specificQuery.productName);
        
        const success = await handleSpecificProductSearch(specificQuery.productName, chatBox);
        
        if (success) {
            document.getElementById('user-input').value = "";
            chatBox.scrollTop = chatBox.scrollHeight;
            return;
        }
    }

    // TRƯỜNG HỢP 1: Kiểm tra keyword sản phẩm với phân loại (logic cũ)
    const classification = classifyProduct(userInput);

    try {
        let data;

        if (classification.category) {
            // Có tìm thấy sản phẩm theo keyword/category
            console.log('Phân loại sản phẩm:', classification);
            
            data = await fetch(`../utils/search_product.php?keyword=${encodeURIComponent(classification.searchKeyword)}`)
                .then(res => res.json());

            const botMessage = document.createElement('div');
            botMessage.className = 'bot-message';
            
            // Tạo message phù hợp với phân loại
            let responseText = "Dưới đây là những sản phẩm phù hợp:";
            if (classification.brand && classification.type) {
                responseText = `Tìm thấy ${classification.type} của thương hiệu ${classification.brand.toUpperCase()}:`;
            } else if (classification.brand) {
                responseText = `Tìm thấy sản phẩm ${classification.brand.toUpperCase()}:`;
            } else if (classification.type) {
                responseText = `Tìm thấy ${classification.type}:`;
            }
            
            botMessage.innerHTML = `${responseText}<br>${data.html}`;
            chatBox.appendChild(botMessage);
        } else {
            // Không có gì khớp gọi chatbot AI
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
                    <button class="wishlist-loop" data-toggle="tooltip" title="Yêu thích" onclick="toggleWishlist(<?= $item['id'] ?>)">
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


    <div id="toast-container" style="
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 10px;
"></div>

<?php return ob_get_clean();
}

?>

<!-- js  -->
<script>
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.textContent = message;
    toast.style.cssText = `
        padding: 10px 16px;
        background-color: ${type === 'success' ? '#4caf50' : '#f44336'};
        color: white;
        border-radius: 4px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        font-size: 14px;
        animation: fadeInOut 3s forwards;
    `;
    document.getElementById('toast-container').appendChild(toast);

    // Remove toast after animation
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Add keyframe animation
const toastAnim = document.createElement('style');
toastAnim.textContent = `
@keyframes fadeInOut {
    0% { opacity: 0; transform: translateY(-10px); }
    10% { opacity: 1; transform: translateY(0); }
    90% { opacity: 1; transform: translateY(0); }
    100% { opacity: 0; transform: translateY(-10px); }
}`;
document.head.appendChild(toastAnim);

</script>
<!-- js wishlist -->
<script>
    function toggleWishlist(productId) {
        // Kiểm tra xem sản phẩm đã có trong wishlist chưa
        checkWishlistStatus(productId).then(inWishlist => {
            if (inWishlist) {
                // Nếu đã có thì xóa
                removeFromWishlist(productId);
            } else {
                // Nếu chưa có thì thêm
                addToWishlist(productId);
            }
        });
    }

    function addToWishlist(productId) {
        fetch('../api/ajax_request.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    action: 'add_to_wishlist',
                    id: productId
                })
            })
            .then(response => response.json())
           .then(data => {
    if (data.success) {
        showToast(data.message, 'success');
        updateWishlistButton(productId, true);
        updateWishlistCount();
    } else {
        showToast(data.message, 'error');
    }
})

            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra, vui lòng thử lại!');
            });
    }

    function removeFromWishlist(productId) {
        if (!confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi danh sách yêu thích?')) {
            return;
        }

        fetch('../api/ajax_request.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    action: 'remove_from_wishlist',
                    id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
    if (data.success) {
        showToast(data.message, 'success');
        updateWishlistButton(productId, false);
        updateWishlistCount();
    } else {
        showToast(data.message, 'error');
    }
})

            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra, vui lòng thử lại!');
            });
    }

    function checkWishlistStatus(productId) {
        // Kiểm tra trong session hoặc gửi request để check
        return fetch('../api/ajax_request.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    action: 'check_wishlist_status',
                    id: productId
                })
            })
            .then(response => response.json())
            .then(data => data.in_wishlist)
            .catch(error => {
                console.error('Error:', error);
                return false;
            });
    }

    function updateWishlistButton(productId, inWishlist) {
        const button = document.querySelector(`[onclick="toggleWishlist(${productId})"]`);
        if (button) {
            const img = button.querySelector('img');
            if (inWishlist) {
                // Đổi màu hoặc style khi đã thêm vào wishlist
                button.style.backgroundColor = '#ff6b6b';
                button.style.color = 'white';
                img.style.filter = 'brightness(0) invert(1)'; // Làm trắng icon
            } else {
                // Trở về style ban đầu
                button.style.backgroundColor = '';
                button.style.color = '';
                img.style.filter = '';
            }
        }
    }

    function updateWishlistCount() {
        fetch('../api/ajax_request.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    action: 'get_wishlist_count'
                })
            })
            .then(response => response.json())
            .then(data => {
                const countElement = document.getElementById('wishlist-count');
                if (countElement) {
                    countElement.textContent = data.count;
                }
            })
            .catch(error => console.error('Error updating wishlist count:', error));
    }
    

    // CSS cho button wishlist
    const wishlistStyles = `
.wishlist-loop {
    border: none;
    background: transparent;
    cursor: pointer;
    padding: 8px;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.wishlist-loop:hover {
    background-color: #f0f0f0;
}

.wishlist-loop.active {
    background-color: #ff6b6b;
    color: white;
}

.wishlist-loop.active img {
    filter: brightness(0) invert(1);
}
`;

    // Thêm CSS vào head
    const styleSheet = document.createElement("style");
    styleSheet.textContent = wishlistStyles;
    document.head.appendChild(styleSheet);

</script>