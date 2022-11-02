<?php
$act = '';
$title = '';
if (isset($_GET['act'])) {
    $act = $_GET['act'];
    if ($act == 'insert') {
        $title = 'Thêm thường hiệu mới';
    } else if ($act == 'update') {
        $title = 'Cập nhật thương hiệu';
        if (isset($_GET['id'])) {
            $trademark_id = $_GET['id'];
            $trademark = new Trademark();
            $result = $trademark->getDetailTrademark($trademark_id);
            $trademark_name = $result['trademark_name'];
            $trademark_desc = $result['trademark_desc'];
            $trademark_status = $result['trademark_status'];
            $trademark_image = $result['trademark_image'];
        }
    } else {
        echo 'Không tìm thấy id !';
    }
} else {
    echo '<script>alert("Không tìm thấy trang")</script>';
    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=trademark"/>';
}
?>
<a href="index.php?action=trademark" class="btn btn-primary">Hủy</a>
<div class="container">
    <h1 class="text-center text-primary text-capitalize">
        <?php if (strlen($title > 0)) {
            echo $title;
        } ?>
    </h1>
    <div id="message"></div>
    <form id="form" method="POST" enctype="multiple/form-data">
        <div class="row">
            <div class="col-8">
                <input type="hidden" name="trademark_id" value="<?php if (isset($trademark_id)) echo $trademark_id ?>">
                <div class="my-3">
                    <label for="trademark_name" class="form-label">Tên thương hiệu</label>
                    <input type="text" class="form-control" name="trademark_name" id="trademark_name" value="<?php if (isset($trademark)) echo $trademark_name ?>">
                    <span id="trademark_name_err" class="text-danger"></span>
                </div>
                <div class="my-3">
                    <label for="trademark_desc" class="form-label">Mô tả thương hiệu</label>
                    <textarea class="form-control" name="trademark_desc" id="trademark_desc">
                        <?php if (isset($trademark_id)) echo $trademark_desc ?>
                    </textarea>
                    <span id="trademark_desc_err" class="text-danger"></span>
                </div>
            </div>
            <div class="col-4">
                <div class="my-3">
                    <label for="" class="form-label">Lựa chọn thương hiệu cha</label>
                    <select class="form-select" name="trademark_parent_id">
                        <option selected disabled>Thương hiệu</option>
                        <?php
                        $trademark = new Trademark();
                        $result = $trademark->getListAllTrademarks();
                        while ($set = $result->fetch()) :
                        ?>
                            <option value="<?php echo $set['trademark_id'] ?>" <?php 
                                if($_GET['act'] == 'update') {
                                    if($set['trademark_id'] == $trademark_id) {
                                        echo 'selected';
                                    } else { echo "";}
                                } 
                            ?>><?php echo $set['trademark_name'] ?></option>
                        <?php endwhile ?>
                        <option value="0">Không có</option>
                    </select>
                </div>
                <input type="hidden" name="trademark_status" value="<?php if(($_GET['act']) == 'update') echo $trademark_status?>">
                <div class="my-3">
                    <label for="trademark_status" class="form-label">Lựa chọn trạng thái</label>
                    <select class="form-select" name="trademark_status">
                        <option selected disabled>Trạng thái</option>
                        <option value="1" <?php if($_GET['act'] == 'update'){ if($trademark_status == '1') echo 'selected';} ?>>Hoạt động</option>
                        <option value="0" <?php if($_GET['act'] == 'update'){ if($trademark_status == '0') echo 'selected';} ?>>Chưa hoạt động</option>
                    </select>
                </div>
                <div class="my-3">
                    <label for="thumbnail" class="form-label">Ảnh danh mục<span class="text-danger">*</span></label>
                    <div id="displaythumbnail"></div>
                    <?php
                    if ($act == 'update') {
                        echo '<img src="../../Content/images/' . $trademark_image . '" alt="thumbnail" style="width: 400px">';
                    } else {
                        // echo '<img src="../Content/images/noimagesuser.png" width="100px" height="100px">';
                    }
                    ?>
                    <input type="file" name="uploadThumbnail" id="uploadThumbnail" class="uploadThumbnail">
                    <input type="hidden" class="form-control" id="thumbnail" name="trademark_image" value="<?php if (isset($menu_id)) echo $trademark_image; ?>">
                </div>
                <div class="mt-5">
                    <?php
                    if ($act == 'insert') {
                        echo '<button class="btn btn-primary btn-lg float-end" type="button" id="submit_create">Thêm thương hiệu mới</button>';
                    } else if ($act == 'update') {
                        echo '<button class="btn btn-primary btn-lg float-end" type="button" id="submit_update">Cập nhật thương hiệu</button>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        tinymce.init({
            selector: '#trademark_desc',
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
        });

        $('#trademark_name').on('input', function() {
            checktrademark_name();
        })

        $('#submit_create').click(function() {
            tinyMCE.triggerSave();
            console.log('lol');
            if (!checktrademark_name()) {
                $('#message').html('<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin</div>');
            } else {
                $('#message').html('');
                var form = $('#form')[0];
                var data = new FormData(form);
                $.ajax({
                    type: 'POST',
                    url: 'index.php?action=trademark&act=insert_action',
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
                            $('#submit_create').html('Thêm thương hiệu');
                            $('#submit_create').attr("disabled", false);
                            $('#submit_create').css({
                                "border-radius": "4px"
                            });
                        }, 50000);
                    }
                })
            }

        })

        $('#submit_update').click(function() {
            tinyMCE.triggerSave();
            if (!checktrademark_name()) {
                $('#message').html('<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin</div>');
            } else {
                $('#message').html('');
                var form = $('#form')[0];
                var data = new FormData(form);
                $.ajax({
                    type: 'POST',
                    url: 'index.php?action=trademark&act=update_action',
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
                            $('#submit_update').html('Cập nhật thương hiệu');
                            $('#submit_update').attr("disabled", false);
                            $('#submit_update').css({
                                "border-radius": "4px"
                            });
                        }, 50000);
                    }
                })
            }

        })

        function checktrademark_name() {
            var trademark_name = $('#trademark_name').val();
            if (trademark_name == '') {
                $('#trademark_name_err').html('Tên thương hiệu không được để trống');
                return false;
            } else if (trademark_name.length <= 2 && trademark_name.length > 100) {
                $('#trademark_name_err').html('Tên thương hiệu ít nhất 2 kí tự và nhỏ hơn 100 kí tự');
                return false;
            } else {
                $('#trademark_name_err').html('');
                return true;
            }
        }

        $('#uploadThumbnail').on('change', function() {
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
                success: function(response) {
                    const json = JSON.parse(response);
                    console.log(json.code);
                    $('#displaythumbnail').append(`<img src="../../Content/images/${json.code}" width="400" height="200">`)
                    // for (var index = 0; index < response.length; index++) {
                    //     var src = response[index];
                    //     // var nameImg = response[index].name;

                    //     /* Thêm 1 element là img vào trong div có id là preview */
                    //     $('#preview').append('<img src="' + src + '" width="200px;" height="200px">');
                    //     // $('#images').val(nameImg);
                    // }
                }
            });
        });

        $('.uploadThumbnail').on('change', function(e) {
            var filename = e.target.files[0].name;
            var thumbnail = $('#thumbnail');
            thumbnail.val(filename);
        })

    })
</script>