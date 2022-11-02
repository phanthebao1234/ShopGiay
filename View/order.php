<div class="container">
    <?php 
        if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0):
            echo '<script> alert("Bạn chưa đăng nhập");</script>';
            echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=login"/>';
        else:     
    ?>
        <h3>Chi tiết hóa đơn</h3>
        <form action="index.php?action" method="POST">
            <table class="table table-striped table-bordered">
                <tbody>
                    <?php 
                        $bill = new HoaDon();
                        if(isset($_SESSION['bill_id'])) {
                            $result = $bill->getOrder($_SESSION['bill_id']);
                            $date = new DateTime($result['ngaydat']);
                            $ngaydat = $date->format('Y-m-d');
                        }
                    ?>
                    <tr>
                        <td colspan="2">Số Hóa đơn: <?php echo $result['bill_id'];?> </td>
                        <td colspan="2"> Ngày lập: <?php echo $ngaydat;?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Họ và tên:</td>
                        <td colspan="2"><?php echo $result['customer_firstname'].' '.$result['customer_lastname'] ;?></td>
                        </tr>
                    <tr>
                        <td colspan="2">Địa chỉ:  </td>
                        <td colspan="2"><?php echo $result['customer_address'];?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Số điện thoại: </td>
                        <td colspan="2"><?php echo $result['customer_phonenumber'];?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Phương thức thanh toán: </td>
                        <td colspan="2"><?php echo $_SESSION['phuongthuc'] ?></td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-striped table-bordered">
                <thead>
                        <tr>
                            <th>Số TT</th>
                            <th>Thông tin sản phẩm</th>
                            <th>Tùy chọn của bạn</th>
                            
                        </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 0;
                        $result = $bill -> getOrderDetails($_SESSION['bill_id']);
                        while($set = $result->fetch()):
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $set['TenSanPham']?></td>
                        <td><?php echo $set['quantity']?></td>
                    </tr>
                    <tr>
                    <?php
                        endwhile;
                    ?>
            <td >
              <b>Tổng Tiền</b>
            </td>
            <td>
                <p>Số tiền giảm: <?php echo number_format(getTotal() - $_SESSION['total']) ; ?></p>
            </td>
            <td>
              <b><?php echo number_format($_SESSION['total']);?> <sup><u>đ</u></sup></b>
            </td>
            
          </tr>
                </tbody>
            </table>
        </form>
        <a class="btn btn-danger" href="index.php?action=order2&act=pay_action">Thanh toán thành công</a>
    <?php
        endif;
    ?> 
</div>