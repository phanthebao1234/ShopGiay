<div class="container-fluid">
    <h1>Danh sách các bài viết</h1>
    <div class="d-flex justify-content-between flex-row mt-3">
        <div>
            <a href="index.php?action=blog&act=insert" class="btn btn-primary me-3">&plus; Thêm mới</a>
            <!-- <a href="index.php?action=blog&act=import" class="btn btn-info me-3">&uArr; Nhập CSV</a>
            <a href="index.php?action=blog&act=export" class="btn btn-success">&dArr; Xuất file Excel</a> -->
        </div>
        <a class="text-decoration-underline fst-italic" href="index.php?action=blog&act=restore">Các bài viết đã xóa <i class="fas fa-lg fa-trash-alt"></i></a>
    </div>
    <div class="d-flex justify-content-start my-3">
        <div class="filter_blog_title">
            <form id="form_filter_blog" action="" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nhập tiêu đề bài viết ..." aria-label="blog_title" aria-describedby="filter_blog_title" id="filter_blog_title" name="filter_blog_title">
                    <button class="btn btn-outline-secondary" type="button" id="filter_blog_title_btn"><i class="fas fa-search fa-fw fa-lg"></i></button>
                </div>
            </form>
        </div>
        <div class="filer_author mx-3" >
            <form id="form_filter_author" action="" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nhập tên tác giả ..." aria-label="blog_title" aria-describedby="filter_author" id="filter_author" name="filter_author">
                    <button class="btn btn-outline-secondary" type="button" id="filter_author_btn"><i class="fas fa-search fa-fw fa-lg"></i></button>
                </div>
            </form>
        </div>
        <div class="filter_menu">
            <form action="" id="form_filter_menu">
                <select class="form-select" name="filter_menu" id="filter_menu">
                    <option selected disabled>Open this select menu</option>
                    <?php
                    $menu = new Menu();
                    $results = $menu->getListMenuActive();
                    while ($set = $results->fetch()) :

                    ?>
                        <option value="<?php echo $set['menu_id'] ?>"><?php echo $set['menu_name'] ?></option>
                    <?php endwhile; ?>
                    <option value="">Tất cả</option>
                </select>
                <!-- <button type="button" >Lọc</button> -->
            </form>
        </div>
    </div>
    <div id="data">
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
                $results = $blog->getBlogs();
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
    </div>
</div>

<script>
    $(document).ready(function() {
        // Lọc theo tiêu đề bài viết
        $('#filter_blog_title_btn').click(function() {
            var form = $('#form_filter_blog')[0];
            var data = new FormData(form);
            $.ajax({
                type: 'POST',
                url: 'View/ajax/filterBlog.php',
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

        // Lọc theo tên tác giả
        $('#filter_author_btn').click(function() {
            var form = $('#form_filter_author')[0];
            var data = new FormData(form);
            $.ajax({
                type: 'POST',
                url: 'View/ajax/filterBlog.php',
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
        
        $('#filter_menu').change(function() {
            var form = $('#form_filter_menu')[0];
            console.log(form);
            var data = new FormData(form);
            $.ajax({
                type: 'POST',
                url: 'View/ajax/filterBlog.php',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,

                success: function(data) {
                    console.log("data: ", data);
                    $('#data').html(data);
                }
            })
        })

    })

    
</script>