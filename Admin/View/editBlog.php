<?php
$act = '';
$title = '';
if (isset($_GET['act'])) {
    $act = $_GET['act'];
    if ($act == 'insert') {
        $title = 'Thêm mới bài viết';
    } else if ($act == 'update') {
        $title = 'Cập nhật bài viết';
        if (isset($_GET['id'])) {
            $blog_id = $_GET['id'];
            $blog = new Blogs();
            $result = $blog->getDetailBlog($blog_id);
            $blog_title = $result['blog_title'];
            $blog_desc = $result['blog_desc'];
            $blog_content = $result['blog_content'];
            $blog_hashtag = $result['blog_hashtag'];
            $blog_thumbnail = $result['blog_thumbnail'];
            $user_id = $result['user_id'];
            $menu_id = $result['menu_id'];
            $blog_view = $result['blog_view'];
            $created_at = $result['created_at'];
            $update_at = $result['updated_at'];
            $published_at = $result['published_at'];
        }
    } else {
    }
}

?>

<a class="btn btn-primary" href="index.php?action=blog">Hủy</a>
<div class="container mt-3">
    <h1 class="text-center text-primary text-capitalize">
        <?php
        echo $title;
        ?>
    </h1>
    <div id="message"></div>
    <?php
    if ($act == 'insert') {
        echo '<form id="form" action="#" method="POST" enctype="multiple/form-data">';
    } else if ($act == 'update') {
        echo '<form id="form" action="#" method="POST" enctype="multiple/form-data">';
    }
    ?>
    <form>
        <div class="row">
            <div class="col-8">
                <input type="hidden" name="blog_id" value="<?php if (isset($blog_id)) echo $blog_id ?>">
                <input type="hidden" name="user_id" value="<?php 
                if (isset($blog_id)) {
                    echo $user_id;
                } else if(isset($_SESSION['id'])) {
                    echo $_SESSION['id'];
                }
                ?>">
                <div class="col-md-12 my-3">
                    <label for="blog_title" class="form-label">Tiêu đề bài viết</label>
                    <input type="text" class="form-control" id="blog_title" name="blog_title" value="<?php if (isset($blog_id)) echo $blog_title ?>">
                    <span id="blog_title_err" class="text-danger"></span>
                </div>
                <div class="col-md-12 my-3">
                    <label for="blog_desc" class="form-label">Mô tả bài viết</label>
                    <textarea id="blog_desc" name="blog_desc" rows="20" cols="50"><?php if (isset($blog_id)) echo $blog_desc ?></textarea>
                    <span id="blog_desc_err" class="text-danger"></span>
                </div>
                <div class="col-md-12 my-3">
                    <label for="blog_content" class="form-label">Nội dung bài viết</label>
                    <textarea id="blog_content" name="blog_content"><?php if (isset($blog_id)) echo $blog_content ?></textarea>
                    <span id="blog_content_err" class="text-danger"></span>
                </div>
            </div>

            <div class="col-4 ">
                <div class=" my-3">
                    <label for="phone" class="form-label">Hash tag bài viết</label>
                    <input type="text" class="form-control" id="blog_hashtag" name="blog_hashtag" value="<?php if (isset($blog_id)) echo $blog_hashtag ?>">
                    <span id="blog_hashtag_err" class="text-danger"></span>
                </div>
                <div class=" my-3">
                    <input type="hidden" name="menu" value="<?php if(isset($blog_id)) echo $menu_id ?>">
                    <label for="country" class="form-label">Danh mục<span class="text-danger">*</span></label>
                    <select class="form-select" id="country-dropdown" name="menu">
                        <option selected disabled>Chọn danh mục bài biết</option>
                        <?php
                            $menu = new Menu();
                            $result = $menu->getListMenuActive();
                            while ($set = $result->fetch()) :
                                if ($menu_id == $set['menu_id']) {
                                    echo $set['menu_name'];
                                }
                        ?>

                            <option value="<?php echo $set['menu_id']; ?>">
                                <?php echo $set['menu_name']?>
                            </option>
                        <?php
                        endwhile;
                        ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col my-3">
                        <label for="created_at" class="form-label">Ngày viết</label>
                        <input type="datetime-local" disabled class="form-control" id="created_at" name="created_at" value="<?php if (isset($blog_id)) echo $created_at; ?>">
                        <span id="create_at_err" class="text-danger"></span>
                    </div>
                    <div class="col my-3">
                        <label for="update_at" class="form-label">Ngày cập nhật</label>
                        <input type="datetime-local" disabled class="form-control" id="update_at" name="update_at" value="<?php if (isset($blog_id)) echo $update_at; ?>">
                        <span id="update_at_err" class="text-danger"></span>
                    </div>
                    <div class="col my-3">
                        <label for="published_at" class="form-label">Ngày đăng</label>
                        <input type="datetime-local" class="form-control" id="published_at" name="published_at" value="<?php if (isset($blog_id)) echo $published_at; ?>">
                        <span id="published_at_err" class="text-danger"></span>
                    </div>
                </div>
                <div class="my-3">
                    <label for="" class="form-label">Ảnh Review bài viết</label>
                    <div class="d-block my-3">
                        <img src="../../Content/images/<?php if (isset($blog_id)) echo $blog_thumbnail ?>" alt="" id="showImage" width="100%">
                    </div>
                    <input id="uploadImage1" type="file" accept="image/*" name="image1" class="uploadimg" />
                    <input type="hidden" name="blog_thumbnail" id="blog_thumbnail" value="<?php if (isset($blog_id)) echo $blog_thumbnail; ?>" >
                </div>
                <div class="col-md-12 my-3">
                    <div class="float-end">
                        <?php
                        if ($act == 'insert') {
                            echo '<button id="submit_create" type="button" class="btn btn-primary btn-lg">Thêm bài viết</button>';
                        } else if ($act == 'update') {
                            echo '<button id="submit_update" type="button" class="btn btn-primary btn-lg">Cập nhật bài viết</button>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        tinymce.init({
            selector: '#blog_desc',
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
        });
        tinymce.init({
            selector: '#blog_content',
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
        });

        $('#blog_title').on('input', function() {
            checktitle();
        });

        $('#blog_hashtag').on('input', function() {
            checkhashtag();
        });
        $('#submit_create').click(function() {
            tinyMCE.triggerSave();
            if (!checktitle() && !checkhashtag()) {
                console.log("er1");
                $("#message").html(`<div class="alert alert-warning">Vui lòng điền đầy đủ thông tin</div>`);
            } else if (!checktitle() || !checkhashtag()) {
                $("#message").html(`<div class="alert alert-warning"Vui lòng điền đầy đủ thông tin</div>`);
                console.log("er");
            } else {
                console.log($('#blog_content').val());
                console.log("ok");
                $("#message").html("");
                var form = $('#form')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "index.php?action=blog&act=insert_action",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,

                    success: function(data) {
                        $('#message').html(data);
                    },
                    complete: function() {
                        setTimeout(function() {
                            $('#form').trigger("reset");
                            $('#submit_create').html('Submit');
                            $('#submit_create').attr("disabled", false);
                            $('#submit_create').css({
                                "border-radius": "4px"
                            });
                        }, 50000);
                    }
                });
            }
        })
        $('#submit_update').click(function() {
            tinyMCE.triggerSave();
            if (!checktitle()  && !checkhashtag()) {
                console.log("er1");
                $("#message").html(`<div class="alert alert-warning">Vui lòng điền đầy đủ thông tin</div>`);
            } else if (!checktitle() || !checkhashtag()) {
                $("#message").html(`<div class="alert alert-warning">Vui lòng điền đầy đủ thông tin</div>`);
                console.log("er");
            } else {
                console.log("ok");
                $("#message").html("");
                var form = $('#form')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "index.php?action=blog&act=update_action",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,

                    success: function(data) {
                        $('#message').html(data);
                    },
                    complete: function() {
                        setTimeout(function() {
                            $('#form').trigger("reset");
                            $('#submit_update').html('Submit');
                            $('#submit_update').attr("disabled", false);
                            $('#submit_update').css({
                                "border-radius": "4px"
                            });
                        }, 50000);
                    }
                });
            }                                                                       
        })

        $('.uploadimg').on('change', function() {
            console.log("test");
            var file_data = $(this).prop('files')[0];
            var form_data = new FormData();
            var ext = $(this).val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                alert("file không đúng định dạng");
                return;
            }
            var picsize = (file_data.size);
            console.log(picsize); /*in byte*/
            if (picsize > 2097152) /* 2mb*/ {
                alert("kích thước ảnh quá lớn")
                return;
            }
            form_data.append('file', file_data);
            $.ajax({
                url: 'View/ajax/upload.php',
                /*point to server-side PHP script */
                dataType: 'text',
                /* what to expect back from the PHP script, if anything*/
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(res) {
                    console.log(res);
                }
            });
        });

        $('#uploadImage1').change(function(e) {
            var filename = e.target.files[0].name;
            // console.log(filename);
            var thumbnail = $('#blog_thumbnail');
            thumbnail.val(filename);
        })

        // Xem hình ảnh
        function readURL(input) {
            if (input.files && input.files[0]) {
                console.log(input.files[0]);
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result).width(150).height(200);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Hàm validation rules
        function checktitle() {
            var title = $('#blog_title').val();
            if (title == '') {
                $('#blog_title_err').html('Tiêu đề không được để trống');
                return false;
            } else if (title.length > 100 || title.length < 10) {
                $('#blog_title_err').html('Tiêu đề không được ít hơn 10 kí tự và nhỏ hơn 100');
                return false;
            } else {
                $('#blog_title_err').html('');
                return true;
            }
        }


        function checkhashtag() {
            var hashtag = $('#blog_hashtag').val();
            if (hashtag == '') {
                $('#blog_hashtag_err').html('Mô tả không được để trống');
                return false;
            } else if (hashtag.length < 10 || hashtag.length > 100) {
                $('#blog_hashtag_err').html('Hashtag không được ít hơn 10 kí tự và nhỏ hơn 100');
                return false;
            } else {
                $('#blog_hashtag_err').html('');
                return true;
            }
        }

    })
</script>