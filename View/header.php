<nav class="navbar navbar-expand-lg " style="height: 90px; margin-bottom: 40px">
  <div class="container-fluid">
    <a class="navbar-brand text-danger" href="#">GiàyShopVN</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php?action=home&act=home">Trang Chủ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=home&act=sanpham">Sản Phẩm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=blog">Bài Viết</a>
        </li>

      </ul>
      <div class="d-flex">
        <?php
        if (isset($_SESSION['customer_id'])) {
          ?>
          <div class="btn-group">
          <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo '<a style="text-decoration: none; color: #fff" href="index.php?action=auth&act=viewprofile">' . $_SESSION['customer_firstname'] . ' ' . $_SESSION['customer_lastname'] . '</a>'; ?>
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item text-danger text-capitalize" href="index.php?action=customer&act=profile">Xem hồ sơ</a></li>
            <li><a class="dropdown-item text-danger text-capitalize" href="index.php?action=cart&act=status">Xem đơn đặt hàng</a></li>
            <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger text-capitalize" href="index.php?action=auth&act=logout_action">Đăng xuất</a></li>
          </ul>
        </div>
          <?php
        } else {
          echo '<a class="btn btn-success " href="index.php?action=auth">Login</a>';
        }
        ?>
        <div class="cart mx-3" >
          <a href="index.php?action=cart" class="btn btn-primary">
            <i class="fal fa-shopping-cart fa-lg"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>  