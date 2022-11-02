<div class="container-fluid">
    <h1 class="text-capitalize">Danh sách đơn hàng</h1>
    <div class="d-flex justify-content-between flex-row mt-3">
        <div>
            <a href="index.php?action=voucher&act=export" class="btn btn-success">&dArr; Xuất file Excel</a>
        </div>
        
    </div>
    <table class="table table-striped table-bordered table-hover my-3">
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
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 0;
                $order = new Demo();
                $results = $order-> getListOrders();
                while ($set = $results->fetch()): 
                    $i++;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $set['fullname'] ?></td>
                    <td><?php echo $set['customer_phonenumber']?></td>
                    <td><?php echo $set['TenSanPham'] ?></td>
                    <td><?php echo $set['quantity'] ?></td>
                    <td><?php echo $set['ngaydat'] ?></td>
                    <td><?php echo $set['customer_address'] ?></td>
                    <td><?php echo number_format($set['total'])?>đ</td>
                    
                </tr>
            <?php
                endwhile;
            ?>
        </tbody>
    </table>
</div>
