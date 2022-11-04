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
        $customer_fullname = $customer_firstname.' '.$customer_lastname;
?>
<div class="container-fluid">
    <div class="row m-5">
        <div class="col-lg-7 d-flex justify-content-center align-items-center checkout">
            <div class="checkout_left">
                <h1>Giày đá banh chính hãng</h1>
                <p>
                    <a href="index.php?action=cart">Giỏ hàng</a> > Thông tin giao hàng > Phương thức thanh toán
                </p>
                <h3>Thông tin giao hàng</h3>
                <div class="checkout_left-user">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Họ và tên:</th>
                                <td><?php echo $customer_fullname ?></td>
                            </tr>
                            <tr>
                                <th>Số điện thoại:</th>
                                <td><?php echo $customer_phone ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="checkout_left-address border-1">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Địa chỉ: </th>
                                <td>
                                    <?php 
                                        $address = new Address();
                                        if ($customer_code_address != "") {
                                            # code...
                                            $result = $address->getDetailAddress($customer_code_address);
                                            echo $customer_address.', '.$result['address'];
                                        } else {
                                            echo "Chưa có địa chỉ";
                                        }
                                    ?>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <div class="mt-5 d-flex justify-content-between align-items-center">
                    <a href="index.php?action=cart" class="text-primary text-decoration-underline fst-italic">Giỏ hàng</a>
                    <a href="index.php?action=order2&act=order_detail" class="btn btn-primary" style="padding: 25px; font-size: 18px">Tiếp tục đến phương thức thanh toán</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 checkout_right">
            <table class="table">
                <tbody>
                    <?php 
                        foreach ($_SESSION['cart'] as $key => $item):
                    ?>
                    <tr>
                        <td class="position-relative">
                            <img src="../Content/images/<?php echo $item['product_image'] ?>" alt="" style="width: 80px; height: auto; border-radius: 10px">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" >
                                <?php echo $item['product_quantity']; ?>
                            </span>
                        </td>
                        <td>
                            <p class="text-uppercase">
                                <?php 
                                    echo $item['product_name'];
                                ?>
                            </p>
                            <p class="text-secondary">
                                Size: <?php echo $item['product_size'] ?>
                            </p>
                        </td>
                        <td>
                            <p class="text-secondary">
                                <?php 
                                    echo number_format($item['product_price'])
                                ?>₫
                            </p>
                        </td>
                        
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <table class="table">
                <tbody>
                    <tr>
                        <td class="text-secondary" style="font-size: 14px">Tạm tính:</td>
                        <td style="font-size: 18px">
                            <?php echo number_format(getTotal()); ?>₫
                        </td>
                    </tr>
                    <tr>
                        <td class="text-secondary" style="font-size: 14px">Phí vận chuyển:</td>
                        <td style="font-size: 18px">
                            30,000₫
                        </td>
                    </tr>
                    <tr>
                        <td>Tổng cộng</td>
                        <td><span class="text-secondary" style="font-size: 14px">VND</span> 
                            <span style="font-size: 18px" data-checkout-payment-value="<?php echo (getTotal() + 30000) ?>">
                                <?php echo number_format(getTotal() + 30000); ?>₫
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
    endif;
?>

<script>
    $('#input_voucher').change(function() {
        input_voucher = $('#input_voucher').val();
        if (input_voucher == '') {
            buttonSubmitVoucher.attr('disabled', true);
        } else {
            buttonSubmitVoucher = $('#submit_form_voucher')
            buttonSubmitVoucher.removeAttr('disabled');
        }
    })

    $('#submit_form_voucher').click(function () {
        let input_voucher = $('#input_voucher').val();
        console.log(input_voucher);
        var form = $('#form_voucher')[0];
        var data = new FormData(form);
        $.ajax({
            type: 'POST',
            url: 'index.php?action=order2&act=add_voucher',
            processData: false,
            contentType: false,
            data: data,
        })
    })
    
</script>