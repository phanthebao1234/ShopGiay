<div class="container-fluid">
    <h1>Danh sách thương hiệu</h1>
    <div class="d-flex justify-content-between flex-row mt-3">
        <div>
            <a href="index.php?action=trademark&act=insert" class="btn btn-primary me-3">&plus; Thêm mới</a>
            <!-- <a href="index.php?action=blog&act=import" class="btn btn-info me-3">&uArr; Nhập CSV</a>
            <a href="index.php?action=blog&act=export" class="btn btn-success">&dArr; Xuất file Excel</a> -->
        </div>
        <a class="text-decoration-underline fst-italic" href="index.php?action=customers&act=restore">Các thương hiệu đã xóa <i class="fas fa-lg fa-trash-alt"></i></a>
    </div>
    <table class="table striped my-3">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên nhà thương hiệu</th>
                <th>Thương hiệu cha</th>
                <th>Tổng số lượng sản phẩm</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i = 0;
                $trademark = new Trademark();
                $results = $trademark -> getListAllTrademarks();
                while ($set = $results->fetch()): 
                    $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $set['trademark_name'] ?></td>
                <td><?php 
                    if ($set['trademark_parent_id'] == 0) {
                        echo 'Không có thương hiệu cha';
                    } else {
                        $result = $trademark -> getDetailTrademark($set['trademark_parent_id']);
                        echo $result['trademark_name'];
                    }
                    ?>
                </td>
                <td>
                    <?php ?>
                </td>
                <td>
                    <a href="index.php?action=trademark&act=update&id=<?php echo $set['trademark_id']?>" ><i class="fas fa-edit fw-bold text-warning"></i></a>
                </td>
                <td>
                    <a href="index.php?action=trademark&act=delete&id=<?php echo $set['trademark_id']?>" ><i class="fas fa-trash-alt fw-bold text-danger"></i></a>
                </td>
            </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</div>