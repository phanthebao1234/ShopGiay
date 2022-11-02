<?php 
    if(isset($_SESSION['customer_id'])):
        $customer = new Customer();
        $customer_id = $_SESSION['customer_id'];
        $result = $customer->getCustomer($customer_id);
        $customer_lastname = $result['customer_lastname'];
        $customer_firstname = $result['customer_firstname'];
        $customer_email = $result['customer_email'];
        $customer_phone = $result['customer_phonenumber'];
        $customer_render = $result['customer_render'];  
        $customer_birthday = $result['customer_birthday'];
        $customer_address = $result['customer_address'];
        $customer_code_address = $result['customer_code_address'];
?>
<div class="container-fluid profile">
    <div class="profile-title">
        Tài khoản của bạn
    </div>
    <div class="row">
        <div class="col-lg-7 profile_left ">
            <div class="profile_left-content">
                <h4>Bạn chưa đặt mua sản phẩm nào</h4>
                <!-- Sử dụng code php tại đây -->
            </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-4 profile_right">
            <div class="profile_right-title">
                <p class="text-center fw-bold">Thông tin tài khoản</p>
                <hr>
            </div>
            <div class="profile_right-content">
                <p>Họ tên: <?php echo $customer_firstname.' '.$customer_lastname ?></p>
                <p>Địa chỉ Email: <?php echo $customer_email ?> </p>
                <p>Số điện thoại: <?php echo $customer_phone ?></p>
                <p>Địa chỉ: <?php 
                     $address = new Address();
                     $result = $address->getDetailAddress($customer_code_address);
                     echo $customer_address.', '.$result['address'];
                ?></p>
                <a class="text-decoration-underline fst-italic fw-bold text-warning" href="index.php?action=customer&act=update">Cập nhật hồ sơ</a>
            </div>
        </div>
    </div>
</div>
<?php 
    else:
?>
    <h3>Vui lòng đăng nhập</h3>
<?php endif ?>