<div class="container">
    <?php
    if (!isset($_SESSION['cart'])  || count($_SESSION['cart']) == 0) {
        echo '<p class="text-danger">Bạn chưa có sản phẩm nào trong giỏ hàng</p>';
    }
    ?>
    <table class="table" style="table-layout: fixed;">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Hinh sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Giá sản phẩm</th>
                <th>Số lượng sản phẩm</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            if(!isset($_SESSION['cart']) && count($_SESSION['cart']) == 0) :
                echo '<h3>Bạn chưa có sản phẩm nào</h3>';
            else:
                foreach ($_SESSION['cart'] as $key => $item):
                    $i++;
                ?>
                    <tr>
                        <form action="index.php?action=cart&act=update&id=<?php echo $item['product_id'] ?>" method="POST" class="cart-form">
                            <td>
                                <input type="checkbox" name="cart_check" id="cart_check" onclick="handle(<?php echo $item['product_id']?> )">
                            </td>
                            <td>
                                <?php echo $i ?>
                            </td>
                            <td>
                                <img src="Content/images/<?php echo $item['product_image'] ?>" alt="" style="width: 100%; height: auto" rowspan="2">
                            </td>
                            <td>
                                <?php echo $item['product_name'] ?>
                            </td>
                            <td>
                                <?php echo  number_format($item['product_price']) ?>
                            </td>
                            <td>
                                <input type="number" name="newqty[<?php echo $item['product_id'] ?>]" value="<?php echo $item['product_quantity'] ?>">
                            </td>
                            <td>
                                <button class="btn btn-primary" type="submit" name="submit">Cập nhật</button>
                            </td>
                            <td>
                                <a class="btn btn-danger" href="index.php?action=cart&act=delete&id=<?php echo $item['product_id'] ?>" onclick="return confirm('Bạn có chắc chắn xóa')">Xóa</a>
                            </td>
                        </form>
                    </tr>
                <?php 
                    endforeach; 
                    endif;
                ?>
        </tbody>
    </table>
    <div class="d-flex">
        <h3 class="">Tổng tiền :
            <?php
            echo number_format(getTotal());
            ?>
        </h3>
        <!-- <div class="voucher">
            <form method="get" action="index.php?action=voucher&act=voucher_action" id="voucher-form">
                <div class="input-group flex-nowrap">
                    <input type="text" class="form-control" placeholder="Nhập mã giảm giá" name="voucher_code" id="voucher_code">
                    <button type="submit" class="btn btn-danger" id="submit" name="submit">Nhập voucher</button>
                </div>
            </form>
        </div> -->
    </div>
    <?php
    if (isset($_SESSION['customer_id'])) {
        echo '<a class="btn btn-danger" href="index.php?action=order2">Tiến hành thanh toán</a>';
    } else {
        echo '<a class="btn btn-warning" href="index.php?action=auth&act=login">Vui lòng đăng nhập trước khi thanh toán</a>';
    }
    ?>
</div>

<script>
    var arrayProduct = [];
    const checkBox = document.querySelectorAll('input[name="cart_check"]');

    handle = (product_id) => {
        const index = arrayProduct.indexOf(product_id);
        if(index == -1) {
            arrayProduct.push(product_id);
        } else {
            arrayProduct.splice(index, 1);
        }
        console.log(arrayProduct);
        // 
    }
   
</script>