<div class="container-fluid">
    <h1 class="text-capitalize">Danh sách danh mục</h1>
    <div class="d-flex justify-content-between flex-row mt-3">
        <div>
            <a href="index.php?action=menu&act=insert" class="btn btn-primary me-3">&plus; Thêm mới</a>
            <a href="index.php?action=user&act=import" class="btn btn-info me-3">&uArr; Nhập CSV</a>
            <a href="index.php?action=user&act=export" class="btn btn-success">&dArr; Xuất file Excel</a>
        </div>
        <a class="text-decoration-underline fst-italic" href="index.php?action=menu&act=restore">Các danh mục đã xóa <i class="fas fa-lg fa-trash-alt"></i></a>
    </div>
    <table class="table table-striped table-bordered table-hover my-3">
        <thead>
            <tr>
                <th>STT</th>
                <th>Menu Name</th>
                <th>Menu Status</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 0;
                $menu = new Menu();
                $results = $menu->getListMenuActive();
                while($set= $results->fetch()):
                    $i++;
            ?>
            <tr>
                <td>
                    <?php echo $i; ?>
                </td>
                <td>
                    <?php echo $set['menu_name'] ?>
                </td>
                <td>
                    <?php if($set['menu_status'] == 1) {
                        echo '<button type="button" class="btn btn-success">Active</button>';
                    } else {
                        echo '<button type="button" class="btn btn-danger">Active<button>';
                    }
                    ?>
                </td>
                <td>
                    <a href="index.php?action=menu&act=update&menu_id=<?php echo $set['menu_id'] ?>"><i class="fas fa-edit fw-bold text-warning"></i></a>
                </td>
                <td>
                    <a href="index.php?action=menu&act=delete&menu_id=<?php echo $set['menu_id'] ?>"><i class="fas fa-trash-alt fw-bold text-danger"></i></a>
                </td>
            </tr>
            <?php
                endwhile;
            ?>
        </tbody>
    </table>
</div>