<div class="container-fluid bg-light ">
    <div class="container">
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
                
        ?>
            <div class="row">
                <div class="col-4">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=customer&act=profile">Tài khoản của tôi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=order2&act=list_order">Đơn mua</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=">Sản phẩm yêu thích</a>
                        </li>
                        
                    </ul>
                </div>
                <div class="col-8 bg-white">
                    <h4>Hồ sơ của tôi</h4>
                    <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-8">
                                <form action="">
                                    <table class="table border border-white">
                                        <tbody>
                                            <tr>
                                                <td>Tên của bạn:</td>
                                                <td><?php echo $customer_firstname.' '.$customer_lastname ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tài khoản Email:</td>
                                                <td><?php echo $customer_email ?></td>
                                            </tr>
                                            <tr>
                                                <td>Số điện thoại:</td>
                                                <td><?php echo $customer_phone ?></td>
                                            </tr>
                                            <tr>
                                                <td>Giới tính:</td>
                                                <td>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="render" id="render" value="1" checked>
                                                        <label class="form-check-label" for="render">Nam</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="render" id="render" value="0">
                                                        <label class="form-check-label" for="render">Nữ</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="render" id="render" value="option3">
                                                        <label class="form-check-label" for="render">Khác</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ngày sinh:</td>
                                                <td>
                                                    <input type="date" name="customer_birthday" value="<?php echo $result['customer_birthday']; ?>" id="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button type="submit" class="btn btn-danger p-2">Lưu</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>  
            <h1>Vui lòng bấm <a href="index.php?action=auth&act=login">để đăng nhập</a> hoặc <a href="index.php?action=auth&act=resgister">để tạo tài khoản</a></h1>
        <?php endif; ?>
    </div>
</div>