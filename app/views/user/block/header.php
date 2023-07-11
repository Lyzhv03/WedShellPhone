
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT_?>/public/assets/client/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/5dd6f63e97.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <header>
        <div class="header-1">
            <a href="Trang-Chu">X-Shop</a>
            <form action="SearchSP" class="search">
                <input type="search" name="key" placeholder="Tìm kiếm..." required>
                <button type="submit">
                    Search
                </button>
            </form>
        </div>
        <nav>
            <ul>
                <li><a href="Trang-Chu">Trang chủ</a></li>
                <li><a href="GioiThieu">Giới thiệu</a></li>
                <li><a href="Trang-Chu#contact">Liên hệ</a></li>
                <li><a href="">Gợi ý</a></li>
                <li><a href="">Hỏi đáp</a></li>
                <li class="dropdown">
                    <a class="danhmuc" href="">Danh mục</a>
                    <ul class="list">
                        <?php 
                            if(!empty($data["danhmuc"])){
                                foreach($data["danhmuc"] as $item){
                        ?>
                                <li><a href="dmSP?Iddm=<?php echo $item["MaLoai"]?>"><?php echo $item["TenLoai"]?></a></li>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                </li>
                <li class="move">
                    <div class="MyCart">
                        <a href="GioHang" class="fas fa-shopping-cart"></a>
                        <?php 
                            if(isset($SL)){
                                echo "<span>".$SL."</span>";
                            }
                        ?>
                    </div>
                    <div class="announce">
                        <a href="Donhang" class="fas fa-solid fa-bell"></a>
                    </div>
                    <div class="dropaccount">
                        <?php ?>
                        <i class="fas fa-user-circle"></i>
                        <ul class="account">
                            <?php 
                                if(isset($_SESSION["Login"]["user"])){
                            ?>
                                <li><a href="CapNhat?act=account">Quản lí Tài Khoản</a></li>
                                <li>
                                    <a href="LogOut"><i class="fa-solid fa-right-from-bracket"></i></a>
                                </li>
                            <?php
                                }else{
                            ?>
                                <li><a href="Login">Đăng nhập</a></li>
                                <li><a href="Register">Đăng kí</a></li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </li>
                <li class="dropdown SPLove">
                    <a href="#">SP yêu thích</a>
                    <ul class="list SP">
                        <?php 
                            if(!empty($data["SPLove"])){
                                foreach($data["SPLove"] as $item){
                        ?>
                                <li>
                                    <a href="SanPham?IdProduct=<?php echo $item["MaHangHoa"]?>">
                                        <img src="<?php echo _WEB_ROOT_."/public/assets/client/images/products/".$item["HinhAnh"]?>" alt="">
                                    </a>
                                    <a href="SanPham?IdProduct=<?php echo $item["MaHangHoa"]?>"><?php echo $item["TenHangHoa"]?></a>
                                </li>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>