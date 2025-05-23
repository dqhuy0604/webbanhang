<?php
	session_start();
	require_once($baseUrl.'../utils/utility.php');
	require_once($baseUrl.'../database/dbhelper.php');

	$user = getUserToken();
	if($user == null){
		header('Location: '.$baseUrl.'authen/login.php');
        die();

	}
?>  
<!DOCTYPE html>
<html>
<head>
    <title> <?= $title?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,
    initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="https://gokisoft.com/uploads/2021/03/s-568-ico-web.jpg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.mim.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <Style>
    *{
         font-family: 'Quicksand', sans-serif !important;
    }
body {
    font-family: 'Quicksand', sans-serif !important;
    font-size: 0.875rem;
    margin: 0;
    padding: 0;
}

.navbar {
    background-color: pink !important;
    color: #fff;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    padding: 0 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
a{
    color:black;
    font-weight:  bold;
}
.navbar-brand {
    font-size: 1.25rem;
    font-weight: bold;
    color: #ff4081;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.navbar-brand:hover {
    color: #e91e63; 
}

.navbar .form-control {
    padding: 0.75rem 1rem;
    border-width: 0;
    border-radius: 0;
}

.navbar-nav {
    display: flex;
    align-items: center;
}

.navbar-nav .nav-item {
    margin: 0 10px;
}

.navbar-nav .nav-link {
    color: #fff;
    font-weight: 500;
}

.navbar-nav .nav-link.active {
    color: #007bff;
}

.navbar-nav .nav-link:hover {
    color: #0056b3;
}

.sidebar {
    display: flex;
    justify-content: center;
    background-color: #f8f9fa;
    padding: 10px 0;
    margin-top: 56px; 
}

.sidebar .nav {
    display: flex;
    list-style-type: none;
    padding-left: 0;
}

.sidebar .nav-item {
    margin: 0 15px;
}

.sidebar .nav-link {
    color: #333;
    font-weight: bold;
    text-decoration: none;
}

.sidebar .nav-link:hover {
    color: pink;
}

.sidebar .nav-link.active {
    color: pink;
}
.main {
    padding: 20px;
}

.table {
    margin-top: 20px;
    background-color: #fff; 
    border: 1px solid #ddd;
}

.table thead {
    background-color: #f1f1f1; 
}

.table th, .table td {
    text-align: center;
    font-weight: bold;
}

.table-hover tbody tr:hover {
    background-color: #f5f5f5;
}

.btn {
    border-radius: 5px;
    font-weight: 600;
}

.btn-success {
    background-color: black;
    color: #fff;
    border-color: black;
}

.btn-success:hover {
    background-color: pink;
    border-color: pink;
}

.btn-warning {
    background-color: black;
    color: #fff;
    border-color: black;
}

.btn-warning:hover {
    background-color: pink; 
    border-color: pink;
}

.btn-danger {
    background-color: pink;
    color: #fff;
    border-color: pink;
}

.btn-danger:hover {
    background-color: black;     
    border-color: black;
}


.card {
    border: 1px solid #ddd;
    border-radius: 8px;
}

.card-body {
    padding: 1.25rem;
}

.card-title {
    font-size: 1.5rem;
    font-weight: bold;
}

.card-footer {
    background-color: #f1f1f1;
    padding: 0.75rem;
    border-top: 1px solid #ddd;
}
.custom-select {
    font-weight: bold;
    display: inline-block;
    width: 100%;
    height: 40px;
    padding: 8px 16px;
    border-radius: 4px;
    border: 1px solid #ddd;
    font-size: 16px;
    color: #333;
    background-color: #fff;
    background-image: linear-gradient(45deg, #f1f1f1 50%, #fff 50%);
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 20px 20px;
    cursor: pointer;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

.custom-select:focus {
    border-color: #0056b3;
    outline: none;
    box-shadow: 0 0 0 2px rgba(38, 143, 255, 0.2);
}

.custom-select-wrapper {
    position: relative;
    display: inline-block;
    width: 100%;
}

.custom-select-wrapper::after {
    content: '\25BE';
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    font-size: 16px;
    color: #333;
    pointer-events: none;
}

.option-waiting {
    background-color: #f5f5f5;
    color: #666;
}

.option-confirmed {
    background-color: #d4edda;
    color: #155724;
}

.option-shipping {
    background-color: #fff3cd;
    color: #856404;
}

.option-completed {
    background-color: #d1ecf1;
    color: #0c5460;
}

    </style>
</head>
<body>
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap
        p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../../utils/index.php">HUDOSHOP
        </a>
        <input class="form-control form-control-dark w-100" type="text"
        placeholder="Tìm kiếm" aria-label="Search">
        <ul class="navbar-nv px-3">
            <li class="nav-item text-nowrap">
            <a class="nav-link" href="<?=$baseUrl?>authen/logout.php">Thoát</a>
                </li>
            </ul>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                 <a class="nav-link active" href="">
                                 <i class="bi bi-house-fill"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=$baseUrl?>category">
                                <i class="bi bi-folder"></i>
                                    Danh Mục Sản Phẩm
                                </a>
                            </li>
                               <li class="nav-item">
                                <a class="nav-link" href="<?=$baseUrl?>brand">
                                <i class="bi bi-folder"></i>
                                    Brand
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=$baseUrl?>product">
                                <i class="bi bi-file-earmark-text"></i>
                                    Sản Phẩm
                                </a>
                            </li>
                            <li class="nav-item">
                                 <a class="nav-link" href="<?=$baseUrl?>order">
                                <i class="bi bi-minecart"></i>
                                    Quản Lý Đơn Hàng
                                </a>
                            </li>
                            <li class="nav-item">
                                 <a class="nav-link" href="<?=$baseUrl?>user">
                                <i class="bi bi-people-fill"></i>
                                    Quản Lý Người dùng
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">