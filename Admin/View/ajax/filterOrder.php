<?php
include '../../Model/connect.php';
include '../../Model/order.php';
$orders = new Order();

$order_status = isset($_POST['filter']) ? $_POST['filter'] : "";

?>
<table class="table table-bordered table-hover my-3" id="tableProduct">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Thời gian đặt</th>
            <th>Địa chỉ</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Cập nhật</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($order_status == "all") {
            $results = $orders->getListOrders();
            $i = 0;
            while ($set = $results->fetch()) :
                $i++;
        ?>
                <tr <?php
                    if ($set['order_status'] == 'confirming') {
                        echo 'class="table-warning"';
                    } elseif ($set['order_status'] == 'shipping') {
                        echo 'class="table-info"';
                    } elseif ($set['order_status'] == 'successful') {
                        echo 'class="table-success"';
                    }
                    ?>>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $set['order_fullname'] ?></td>
                    <td><?php echo $set['order_phonenumber'] ?></td>
                    <td><?php echo $set['order_tensanpham'] ?></td>
                    <td><?php echo $set['order_quantity'] ?></td>
                    <td><?php echo $set['order_ngaydat'] ?></td>
                    <td><?php echo $set['order_address'] ?></td>
                    <td><?php echo number_format($set['order_total']) ?>đ</td>
                    <td>
                        <form action="index.php?action=order&act=update_action" method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $set['order_id']; ?>" />
                            <select name="order_status">
                                <option value="confirming" <?php if ($set['order_status'] == 'confirming') echo ' selected="selected"'; ?>>Đang xác nhận</option>
                                <option value="shipping" <?php if ($set['order_status'] == 'shipping') echo ' selected="selected"'; ?>>Đang vận chuyển</option>
                                <option value="successful" <?php if ($set['order_status'] == 'successful') echo ' selected="selected"'; ?>>Hoàn thành</option>
                            </select>
                    <td><button class="btn btn-primary" type="submit">Cập nhật</button>
                        </form>
                    </td>
                    </td>
                </tr>
        <?php
            endwhile;
        }
        ?>
        <?php
        if ($order_status != "") {
            $i = 0;
            $results = $orders->filterOrder($order_status);
            while ($set = $results->fetch()) :
                $i++;
        ?>
                <tr <?php
                    if ($set['order_status'] == 'confirming') {
                        echo 'class="table-warning"';
                    } elseif ($set['order_status'] == 'shipping') {
                        echo 'class="table-info"';
                    } elseif ($set['order_status'] == 'successful') {
                        echo 'class="table-success"';
                    }
                    ?>>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $set['order_fullname'] ?></td>
                    <td><?php echo $set['order_phonenumber'] ?></td>
                    <td><?php echo $set['order_tensanpham'] ?></td>
                    <td><?php echo $set['order_quantity'] ?></td>
                    <td><?php echo $set['order_ngaydat'] ?></td>
                    <td><?php echo $set['order_address'] ?></td>
                    <td><?php echo number_format($set['order_total']) ?>đ</td>
                    <td>
                        <form id="form_update_status" action="" method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $set['order_id']; ?>" />
                            <select name="order_status">
                                <option value="confirming" <?php if ($set['order_status'] == 'confirming') echo ' selected="selected"'; ?>>Đang xác nhận</option>
                                <option value="shipping" <?php if ($set['order_status'] == 'shipping') echo ' selected="selected"'; ?>>Đang vận chuyển</option>
                                <option value="successful" <?php if ($set['order_status'] == 'successful') echo ' selected="selected"'; ?>>Hoàn thành</option>
                            </select>
                    <td><button id="submit_update" class="btn btn-primary" type="button">Cập nhật</button>
                    </td>
                    </form>
                    </td>
                    </td>
                </tr>
        <?php
            endwhile;
        } ?>
    </tbody>
</table>
<script src="../Content/js/datatables.min.js"></script>
<script>
    $(document).ready(function(){
        $(document).ready(function() {
        $('#tableProduct').DataTable({
            searching: false,
            // ordering: false
        });
    });
        $('#submit_update').click(function() {
            var formUpdateStatus = $('#form_update_status')[0];
            var data = new FormData(formUpdateStatus);
            $.ajax({
                type: 'POST',
                url: 'index.php?action=order&act=update_action',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,

                success: function(data) {
                    $('#message').html(data);
                }
            })
        })
    })
</script>