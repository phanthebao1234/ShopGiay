<div class="header">
    <div class="header_main">
        <div class="header_main-right">
            <a href="index.php?action=home">
                <img src="../Content/images/logo.png" width="240" height="auto" alt="Giày đá bóng chính hãng">
            </a>
        </div>
        <div class="header_main-center">
            <form action="index.php?action=home&act=sanpham&search" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="keyword" placeholder="Bạn đang tìm kiếm ..." aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="header_main-left">
            <!-- Code PHP ở đây -->
            <div class="header_main-left-user">
                <div class="dropdown">
                    <div class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fal fa-user"></i>
                    </div>
                    <?php
                        if (isset($_SESSION['customer_id'])):
                    ?>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="index.php?action=customer&act=viewprofile">Xem hồ sơ</a></li>
                        <li><a class="dropdown-item" href="index.php?action=auth&act=logout_action">Đăng xuất</a></li>
                        <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                    </ul>
                    <?php else: ?>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="index.php?action=auth&act=login">Đăng nhập</a></li>
                            <li><a class="dropdown-item" href="index.php?action=auth&act=resgister">Đăng kí</a></li>
                        </ul>
                    <?php 
                        endif;
                    ?>
                </div>
            </div>
            <div class="header_main-left-cart">
                <?php 
                    if (isset($_SESSION['customer_id'])):
                ?>
                <a href="index.php?action=cart" class="position-relative">
                    <i class="fal fa-shopping-bag"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:10px">
                        <!-- Code PHP ở đây -->
                        <?php 
                            if(empty($_SESSION['cart'])) {
                                echo '0';
                            } else { 
                                echo (count($_SESSION['cart']));
                            } 
                        ?>
                    </span>
                </a>
                <?php endif ?>
            </div>
            <div class="header_main-left-lang">
                <img src="../Content/images/pngwing.com.png" style="width: 28px" alt="">
            </div>
        </div>
    </div>
    <div class="header_menu">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?php if(!isset($_GET['act'])) echo 'text-danger'; ?>" href="index.php?action=home">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(isset($_GET['act']) && $_GET['act'] == 'sanpham') echo 'text-danger'; ?>" href="index.php?action=home&act=sanpham">Tất cả sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(isset($_GET['act']) && $_GET['act'] == 'giayconhantao') echo 'text-danger'; ?>" href="index.php?action=home&act=giayconhantao">Giày cỏ nhân tạo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(isset($_GET['act']) && $_GET['act'] == 'giayfutsal') echo 'text-danger'; ?>" href="index.php?action=home&act=giayfutsal">Giày futsal</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="trademark" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Thương hiệu
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="trademark">
                                <!-- Code PHP -->
                                <?php
                                    $trademark = new Trademark();
                                    $result = $trademark-> getListAllTrademarks();
                                    while($set = $result->fetch()):
                                ?>
                                <li><a class="dropdown-item" href="index.php?action=home&act=sanpham&trademark=<?php echo $set['trademark_id']?>"><?php echo $set['trademark_name']?></a></li>
                                <?php endwhile ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Hot sale</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(isset($_GET['act']) && $_GET['act'] == 'blog') echo 'text-danger'; ?>" href="index.php?action=blog&act=blog">Tin tức giày</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>