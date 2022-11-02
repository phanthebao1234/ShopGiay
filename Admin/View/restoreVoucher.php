<div class="container-fluid">
    <a class="text-decoration-underline fst-italic" href="index.php?action=voucher"><i class="fas fa-angle-left"></i> Quay lại danh sách Voucher</a>
    <h1 class="text-capitalize">Các Voucher đã xóa</h1>
    <table class="table table-striped table-bordered table-hover my-3">
        <thead>
            <tr>
                <th>STT</th>
                <th>Voucher Code</th>
                <th>Voucher Name</th>
                <th>Voucher Start Day</th>
                <th>Voucher End Day</th>
                <th>Voucher Sale (%)</th>
                <th>Voucher Count</th>
                <!-- <th>Sửa</th> -->
                <th>Xóa</th>
                <th>Khôi phục</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 0;
                $voucher = new Voucher();
                $results = $voucher-> getListAllVoucherNoActive();
                while ($set = $results->fetch()): 
                    $i++;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $set['voucher_code'] ?></td>
                    <td><?php echo $set['voucher_name']?></td>
                    <td><?php echo $set['voucher_start'] ?></td>
                    <td><?php echo $set['voucher_end'] ?></td>
                    <td><?php echo $set['voucher_sale']*100; ?></td>
                    <td><?php echo $set['voucher_count']?></td>
                    <!-- <td>
                        <a class="btn btn-warning" href="index.php?action=voucher&act=update&id=<?php echo $set['voucher_id']?>">Sửa</a>
                    </td> -->
                    <td>
                        <a class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa Voucher: <?php echo $voucher_name ?>')" href="index.php?action=voucher&act=delete_permanently&id=<?php echo $set['voucher_id']?>">Xóa</a>
                    </td>
                    <td>
                        <a class="btn btn-info" href="index.php?action=voucher&act=restore_action&id=<?php echo $set['voucher_id'] ?>">Khôi phục</a>
                    </td>
                </tr>
            <?php
                endwhile;
            ?>
        </tbody>
    </table>
</div>