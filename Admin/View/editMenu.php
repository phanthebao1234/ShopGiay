<?php
$act = '';
$title = '';
if (isset($_GET['act'])) {
    $act = $_GET['act'];
    if ($act == 'insert') {
        $title = 'Thêm mới danh mục';
    } else if ($act == 'update') {
        $title = 'Cập nhật danh mục';
        if (isset($_GET['menu_id'])) {
            $menu_id = $_GET['menu_id'];
            $menu = new Menu();
            $result = $menu->getDetailMenu($menu_id);
            $menu_name = $result['menu_name'];
            $menu_desc = $result['menu_desc'];
            $menu_status = $result['menu_status'];
            $menu_thumbnail = $result['menu_thumbnail'];
            if ($menu_thumbnail == "") {
                $menu_thumbnail = "noimage.jpg";
            } else {
                $menu_thumbnail =  $result['menu_thumbnail'];
            }
        }
    } else {
    }
}

?>
<a href="index.php?action=menu" class="btn btn-primary">Hủy</a>
<div class="container mt-3">
    <h1 class="">
        <?php
        echo $title;
        ?>
    </h1>
    <?php
    if ($act == 'insert') {
        echo '<form action="index.php?action=menu&act=insert_action" method="POST" enctype="multiple/form-data">';
    } else if ($act == 'update') {
        echo '<form action="index.php?action=menu&act=update_action" method="POST" enctype="multiple/form-data">';
    }
    ?>
    <form>
        <div class="row">
            <input type="hidden" class="form-control" name="menu_id" value="<?php if (isset($menu_id)) echo $menu_id ?>">
            <div class="col-12">
                <label for="" class="form-label">Tiêu đề danh mục</label>
                <input type="text" class="form-control" name="menu_name" value="<?php if (isset($menu_id)) echo $menu_name ?>">
            </div>
            <div class="col-12 my-3">
                <label for="" class="form-label">Mô tả danh mục</label>
                <textarea name="menu_desc" id="menu_desc"><?php if (isset($menu_desc)) echo $menu_desc ?></textarea>
            </div>
            <input type="hidden" name="menu_status" value="<?php echo $menu_status ?>">
            <div class="col-md-3 my-4">
                <select class="" name="menu_status" value="<?php if (isset($menu_id)) echo $menu_status ?>">
                    <option selected disabled>Lưa chọn trạng thái:</option>
                    <option value="1">Active</option>
                    <option value="0">No Active</option>
                </select>
            </div>
            <div class="my-3">
                <label for="thumbnail" class="form-label">Ảnh danh mục<span class="text-danger">*</span></label>
                <div id="displaythumbnail"></div>
                <?php
                if ($act == 'update') {
                    echo '<img src="../../Content/images/' . $menu_thumbnail . '" alt="thumbnail" style="width: 400px">';
                } else {
                    // echo '<img src="../Content/images/noimagesuser.png" width="100px" height="100px">';
                }
                ?>
                <input type="file" name="uploadThumbnail" id="uploadThumbnail" class="uploadThumbnail">
                <input type="hidden" class="form-control" id="thumbnail" name="thumbnail" value="<?php if (isset($menu_id)) echo $menu_thumbnail; ?>">
            </div>
            <div class="col-12">
                <button class="btn btn-primary btn-lg" type="submit" class="form-control">
                    <?php
                    if ($act == 'insert') {
                        echo 'Thêm';
                    } else if ($act == 'update') {
                        echo 'Cập nhật';
                    } else {
                        echo '';
                    }
                    ?>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'casechange',
        toolbar: 'casechange',
        height: '300px',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });

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

        $('.uploadThumbnail').on('change', function(e){
            var filename = e.target.files[0].name;
            var thumbnail = $('#thumbnail');
            thumbnail.val(filename);
        })

</script>