<div class="container-fluid">
    <h1 class="text-capitalize">Danh sách đơn hàng</h1>
    <div class="d-flex justify-content-between flex-row mt-3">
        <div>
            <a href="index.php?action=voucher&act=export" class="btn btn-success">&dArr; Xuất file Excel</a>
        </div>
    </div>
    <div id="message"></div>
    <div class="d-flex justify-content-between my-3">
        <div class="">
            <form id="form">
                <select class="form-select" name="filter" id="filter">
                    <option selected disabled>Lựa chọn trạng thái</option>
                    <option value="confirming">Đang xác nhận</option>
                    <option value="shipping">Đang vận chuyển</option>
                    <option value="successful">Hoàn thành</option>
                    <option value="all">Tất cả</option>
                </select>
            </form>
        </div>
    </div>
    <div id="data">
        <table class="table table-bordered table-hover my-3" id="tableProduct">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Khách Hàng</th>
                    <th>Số điện thoại</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Ngày đặt</th>
                    <th>Địa chỉ</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Cập nhật</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $order = new Order();
                $results = $order->getListOrders();
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
                        <td><button class="btn btn-primary" type="submit">Cập nhật</button></td>
                        </form>
                        </td>
                    </tr>
                <?php
                endwhile;
                ?>
            </tbody>
        </table>
    </div>

</div>
<script src="../Content/js/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tableProduct').DataTable({
            searching: false,
            // ordering: false
        });

        $('#filter').on('change', function() {
            var form = $('#form')[0];
            var data = new FormData(form);
            $.ajax({
                type: 'POST',
                url: 'View/ajax/filterOrder.php',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,

                success: function(data) {
                    $('#data').html(data);
                }
            })
        })


    })
</script>