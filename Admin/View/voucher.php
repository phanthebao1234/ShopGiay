<div class="container-fluid">
    <h1 class="text-capitalize">Danh sách Voucher</h1>
    <div class="d-flex justify-content-between flex-row mt-3">
        <div>
            <a href="index.php?action=voucher&act=insert" class="btn btn-primary me-3">&plus; Thêm mới</a>
            <a href="index.php?action=voucher&act=import" class="btn btn-info me-3">&uArr; Nhập CSV</a>
            <a href="index.php?action=voucher&act=export" class="btn btn-success">&dArr; Xuất file Excel</a>
        </div>
        <a class="text-decoration-underline fst-italic" href="index.php?action=voucher&act=restore">Các Voucher đã xóa <i class="fas fa-lg fa-trash-alt"></i></a>
    </div>
    <table class="table table-bordered table-hover my-3" id="tableVoucher">
        <thead>
            <tr>
                <th>STT</th>
                <th>Voucher Code</th>
                <th>Voucher Name</th>
                <th>Voucher Start Day</th>
                <th>Voucher End Day</th>
                <th>Voucher Sale (%)</th>
                <th>Voucher Count</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 0;
                $voucher = new Voucher();
                $results = $voucher-> getListAllVoucherActive();
                while ($set = $results->fetch()): 
                    $i++;
            ?>
                <tr class="text-center <?php if($set['voucher_count'] == 0) echo 'table-warning'?>" >
                    <td><?php echo $i; ?></td>
                    <td><?php echo $set['voucher_code'] ?></td>
                    <td><?php echo $set['voucher_name']?></td>
                    <td><?php echo $set['voucher_start'] ?></td>
                    <td><?php echo $set['voucher_end'] ?></td>
                    <td>
                        <?php 
                            if($set['voucher_type'] == 'phantram') {
                                echo $set['voucher_sale'].' %'; 
                            } else {
                                echo number_format($set['voucher_sale']).' vnđ';
                            }
                        ?>
                    </td>
                    <td><?php echo $set['voucher_count']?></td>
                    <td>
                        <a class="" href="index.php?action=voucher&act=update&id=<?php echo $set['voucher_id']?>"><i class="fas fa-edit fw-bold text-warning"></i></a>
                    </td>
                    <td>    
                        <a class=""  href="index.php?action=voucher&act=delete&id=<?php echo $set['voucher_id']?>"><i class="fas fa-trash-alt fw-bold text-danger"></i></a>
                    </td>
                </tr>
            <?php
                endwhile;
            ?>
        </tbody>
    </table>
</div>
<script src="../Content/js/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tableVoucher').DataTable({
            searching: false,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
        });
    });
</script>   