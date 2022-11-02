<?php
    include '../../Model/connect.php';
    include '../../Model/blogs.php';
    $blog = new Blogs();
    $filter_blog_title = isset($_POST['filter_blog_title']) ? trim($_POST['filter_blog_title']) : '';
    $filter_author = isset($_POST['filter_author']) ? trim($_POST['filter_author']) : '';
    $filter_menu = isset($_POST['filter_menu']) ? $_POST['filter_menu'] : '';
?>

<table class="table table-striped my-3">
            <thead>
                <tr class="text-center">
                    <th>STT</th>
                    <th>Tiêu đề bài viết</th>
                    <th>Tên tác giả</th>
                    <th>Danh mục bài viết</th>
                    <th>Ngày đăng</th>
                    <th>Ngày viết</th>
                    <th>Trạng thái</th>
                    <th>Chỉnh sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $blog = new Blogs();
                if ($filter_blog_title != "") {
                    $results = $blog->searchBlogTitle($filter_blog_title);
                } else if($filter_author != "") {
                    $results = $blog -> searchBlogAuthor($filter_author);
                } else if($filter_menu != "") {
                    $results = $blog -> searchBlogMenu($filter_menu);
                } else if ($filter_author == "") {
                    $results = $blog->getBlogs();
                }  else if ($filter_blog_title == "") {
                    $results = $blog->getBlogs();
                } else if ($filter_menu == "") {
                    $results = $blog-> getBlogs();
                }
                while ($set = $results->fetch()) :
                    $i++;
                ?>
                    <tr class="text-center">
                        <td><?php echo $i; ?></td>
                        <td style="
                        max-width:100px;
                        white-space: nowrap;
                        overflow: hidden;
                        text-overflow: ellipsis">
                            <?php echo $set['blog_title']; ?>
                        </td>
                        <td><?php echo $set['author'] ?></td>
                        <td><?php echo $set['menu_name'] ?></td>
                        <td><?php if ($set['published_at'] == "") {
                                echo 'Chưa có thời gian đăng bài';
                            } else {
                                echo $set['published_at'];
                            } ?></td>
                        <td><?php echo $set['created_at'] ?></td>
                        <td>
                            <?php
                            if ($set['blog_status'] == 1) {
                                echo '<p class="text-success">Đang hoạt động</p>';
                            } else {
                                echo '<p class="text-danger">Không hoạt động</p>';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="index.php?action=blog&act=update&id=<?php echo $set['blog_id'] ?>"><i class="fas fa-edit fw-bold text-warning"></i></a>
                        </td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc chắn xóa ?')" href="index.php?action=blog&act=deleteConfirm&id=<?php echo $set['blog_id'] ?>"><i class="fas fa-trash-alt fw-bold text-danger"></i></a>
                        </td>
                    </tr>

                <?php endwhile; ?>
            </tbody>
        </table>