<div class="container-fluid my-5" style="background-color: #f3f3f3">
    <div class="row cart">
        <?php 
        if (!isset($_SESSION['cart'])  || count($_SESSION['cart']) == 0):
        ?>
            <div class="cart_empty">
                <h3>Giỏ hàng của bạn đang trống</h3>
                <a class="btn btn-dark btn-lg w-25" href="index.php?action=home&act=sanpham">Tiếp tục mua hàng</a>
            </div>
        <?php 
            else:
        ?>
            <div class="col-8 cart_left">
                <?php 
                    $i = 0;
                    if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) :
                        echo '<h3>Bạn chưa có sản phẩm nào</h3>';
                    else:
                ?>
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($_SESSION['cart'] as $key => $item):
                            
                    ?>
                    <tr>
                        <form id="cart_form" action="index.php?action=cart&act=update&id=<?php echo $item['product_id'] ?>" method="POST" class="cart-form">
                            
                            <td style="width: 50px;">
                                <input type="checkbox" name="cart_check" data-name="cart_check" data-value="<?php echo $item['product_id'] ?>">
                            </td>
                            <td style="width: 400px; display: flex; justify-content: space-between;">
                                <img src="../Content/images/<?php echo $item['product_image'] ?>" alt="" style="width: 100px; height: auto; margin-right: 15px" rowspan="2">
                                <p class="h5"><?php echo $item['product_name'] ?></p>
                            
                            </td>
                            <td>
                                <p class="h3"><?php echo number_format($item['product_price']) ?>₫</p>
                            </td>
                            <td>

                                <input type="number" id="product_quantity" name="newqty[<?php echo $item['product_id'] ?>]" min="1" max="" value="<?php echo $item['product_quantity'] ?>">
                                <button type="submit">Cập nhật</button>
                            </td>
                            <td>
                                <p class="h3"><?php echo  number_format($item['product_price']) ?>₫</p>
                            </td>
                            <td>
                                <a class="" href="index.php?action=cart&act=delete&id=<?php echo $item['product_id'] ?>" onclick="return confirm('Bạn có chắc chắn xóa')"><i class="far fa-times fa-3x"></i></a>
                            </td>
                            <input type="hidden" name="product_cart" id="product_cart">
                        </form>
                    </tr>
                    <?php 
                        endforeach;
                        endif;
                    ?>
                </tbody>
                <tfoot>
                    <tr colspan="4">
                        <td></td>
                       <td><a class="h4 fst-italic" href="index.php?action=home&act=sanpham">Tiếp tục mua hàng</a></td>
                    </tr>
                </tfoot>
            </table>
            
        </div>
        <div class="col-4 cart_right" >
            <div class="cart_right-content">
                <div class="cart_right_total">
                    <label for="">Thành tiền</label>
                    <span class="cart_right_total_price text-danger h3"><?php echo number_format(getTotal()); ?>₫</span>
                </div>
                <div class="cart_right_button">
                        <form action="index.php?action=checkout" method="POST">
                            <button type="submit" class="btn btn-dark btn-lg" id="button_cart">Thanh toán</button>
                        </form>
                    <?php
                        
                    ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<script>
    var productArray = [];
    $('*[data-name="cart_check"]').click(function() {
        var cartCheck = $('*[data-name="cart_check"]');
        for (let i = 0; i < cartCheck.length; i++) {
            const element = cartCheck[i];
            if (element.checked) {  
                var productId = $(this).data('value');
                if (productArray.length == 0) {  
                    productArray.push(productId);
                    console.log(productArray);
                } else {
                   const dupProduct =  productArray.filter(item => item == productId);
                   
                   if (dupProduct.length == 0) {
                    console.log("Dubp:", dupProduct);
                    console.log('San khong khong bi trung');
                    console.log(productArray);
                    productArray.push(productId);
                    
                   } else {
                    console.log('San phaam bi trung');
                    console.log(productArray);
                   }
                }
            }
        }
    })
    
    $('#button_cart').on('click', function() {
        // var data 
        // console.log(data);
    })

    
</script>