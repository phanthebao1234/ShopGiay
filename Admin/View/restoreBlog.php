<div class="container-fluid">
    <a class="text-decoration-underline fst-italic" href="index.php?action=blog"><i class="fas fa-angle-left"></i> Quay lại danh sách danh mục</a>
    <h1 class="text-capitalize">Bài viết đã xóa</h1>
    <table class="table table-striped table-bordered table-hover my-3">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tiêu đề bài viết</th>
                <th>Tác giả</th>
                <th>Khôi Phục</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $blog = new Blogs();
            $results = $blog->getListBlogNoActive();
            while ($set = $results->fetch()) :
                $i++;
            ?>
                <tr>
                    <td>
                        <?php echo $i; ?>
                    </td>
                    <td style="max-width:100px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis"><?php echo $set['blog_title']; ?></td>
                    <td><?php echo $set['author']; ?></td>
                    <td>
                        <a href="index.php?action=blog&act=restore_action&id=<?php echo $set['blog_id']; ?>" class="btn btn-info">Khôi phục</a>
                    </td>
                    <td>
                        <?php
                        echo '<a href="index.php?action=blog&act=delete&id=' . $set['blog_id'] . '" class="btn btn-danger">Xóa</a>';
                        ?>
                    </td>
                </tr>
            <?php
            endwhile;
            ?>
        </tbody>
    </table>
</div>