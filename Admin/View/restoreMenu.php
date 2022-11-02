<div class="container-fluid">
    <a class="text-decoration-underline fst-italic" href="index.php?action=menu"><i class="fas fa-angle-left"></i> Quay lại danh sách danh mục</a>
    <h1 class="text-capitalize">Các danh mục đã xóa</h1>
    <table class="table table-striped table-bordered table-hover my-3">
        <thead>
            <tr>
                <th>STT</th>
                <th>Menu Name</th>
                <th>Menu Status</th>
                <th>Xóa</th>
                <th>Khôi phục</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 0;
                $menu = new Menu();
                $results = $menu-> getListMenuNoActive();
                while ($set = $results->fetch()): 
                    $i++;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $set['menu_name']?></td>
                    <td><?php echo $set['menu_status']?></td>
                    <td>
                        <a class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa menu: <?php echo $menu_name ?>')" href="index.php?action=menu&act=delete_confirm&id=<?php echo $set['menu_id']?>">Xóa</a>
                    </td>
                    <td>
                        <a class="btn btn-info" href="index.php?action=menu&act=restore_action&id=<?php echo $set['menu_id'] ?>">Khôi phục</a>
                    </td>
                </tr>
            <?php
                endwhile;
            ?>
        </tbody>
    </table>
</div>