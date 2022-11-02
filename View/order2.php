<?php
if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
    $customer = new Customer();
    $result = $customer->getCustomer($customer_id);
    $customer_address = $result['customer_address'];
    $customer_phone = $result['customer_phonenumber'];
    $customer_email = $result['customer_email'];
    $customer_fullname = $result['customer_firstname'] . ' ' . $result['customer_lastname'];
}
?>


<div class="container">
    <div class="">
        <div class="check-info">
            <h3>Thông tin người nhận</h3>
            <p>Tên người nhận: <span><?php echo $customer_fullname ?></span></p>
            <p>Địa chỉ nhận hàng: <span><?php echo $customer_address ?></span></p>
            <p>Số điện thoại người nhân: <span><?php echo $customer_phone ?></span></p>
            <p>Email gửi hóa đơn: <span><?php echo $customer_email ?> </p>
            <p>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#change">
                    Cập nhật địa chỉ nhận hàng
                </button>
                <!-- <a href="index.php?action=customer&act=update">Thay đổi</a> -->
            </p>
        </div>
        <div>
            <h3>Sản phẩm thanh toán</h3>

            <table class="table" style="table-layout: fixed">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($_SESSION['cart'] as $key => $item) :
                    ?>
                        <tr>
                            <td>
                                <img src="Content/images/<?php echo $item['product_image'] ?>" style="width:10%; height: auto" alt="">
                                <?php echo $item['product_name'] ?>
                            </td>

                            <td>
                                <?php echo number_format($item['product_price']) ?>
                            </td>
                            <td>
                                <?php echo $item['product_quantity'] ?>
                            </td>
                            <td>
                                <?php echo number_format($item['product_price']); ?>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
        <h3>Tổng tiền: <?php echo number_format(getTotal()); ?></h3>
    </div>

    <div class="d-flex flex-row-reverse bd-highlight">
        
        <?php
            if (isset($_SESSION['customer_id'])) {
                echo '<a class="btn btn-danger" href="index.php?action=order2&act=order_detail">Tiến hành thanh toán</a>';
            } else {
                echo '<a class="btn btn-warning" href="index.php?action=auth&act=login">Vui lòng đăng nhập trước khi thanh toán</a>';
            }
        ?>
    </div>
</div>


<div class="modal fade" id="change" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thay đổi thông tin nhận hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="index.php?action=customer&act=update_address" method="POST">
                    <input type="hidden" name="customer_id" value="<?php if($customer_id) echo $customer_id?>">
                    <div class="col-md-12">
                        <label for="customer_address" class="form-label">Địa chỉ nhận hàng</label>
                        <input type="text" name="customer_address" class="form-control" id="customer_address" value="<?php if($customer_address) echo $customer_address; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="customer_phone" class="form-label">Số điện thoại</label>
                        <input type="number" name="customer_phone" class="form-control" id="customer_phone" value="<?php if($customer_phone) echo $customer_phone ?>">
                    </div> 
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Tạo form nhập thông tin: số điện thoại, địa chỉ, xem lại danh sách sản phẩm đã đặt ( nếu trong db có rồi thì đưa ra form check lại ) 
-> nhập mã giảm giá và tính lại tổng tiền
-> chọn phương thức thanh toán 
-> thanh toán thành công -->
<script>
    console.log('<?php echo $customer_fullname ?>')
</script>