<?php
if (isset($_GET['act'])) {

    if ($_GET['act'] == 'insert_product') {
        $ac = 'insert';
    } elseif ($_GET['act'] == 'update_product') {
        $ac = 'update';
    } else {
        $ac = null;
    }
}

if (isset($_GET['id_sanpham'])) {
    $id_sanpham = $_GET['id_sanpham'];
    $sanpham = new Products();
    $result = $sanpham->getProductID($id_sanpham);
    $tensanpham = $result['TenSanPham'];
    $giasanpham = $result['GiaSanPham'];
    $giakhuyenmai = $result['GiaGiam'];
    $loaigiamgia = $result['LoaiGiamGia'];
    // echo $loaigiamgia;
    $thumbnail = $result['Thumbnail'];
    $hinh_sanpham = $result['HinhSanPham'];
    $mota = $result['MoTa'];
    $size = $result['Size'];
    $thuonghieu = $result['ThuongHieu'];
    $loai = $result['LoaiSanPham'];
    $tonkho = $result['TonKho'];
}
?>

<a class="btn btn-primary" href="index.php?action=product">Hủy</a>
<div class="container">
    <div class="edit">
        <div class="edit_title">
            <h1>
                <?php
                if ($ac == 'insert') {
                    echo 'Thêm sản phẩm mới';
                } else if ($ac == 'update') {
                    echo 'Cập nhật sản phẩm';
                } else {
                    echo 'Not Found';
                }
                ?>
            </h1>
        </div>
        <div id="message"></div>
        <div class="edit_form">
            <?php
            if ($ac == 'insert') {
                echo '<form id="form" action="#" method="POST" enctype="multipart/form-data" class="row g-3">';
            } else if ($ac == 'update') {
                echo '<form id="form" action="#" method="POST" enctype="multipart/form-data" class="row g-3">';
            }
            ?>
            <form>
                <div class="row">
                    <div class="col-8">
                        <input type="hidden" class="form-control" id="id_sanpham" name="id_sanpham" value="<?php if (isset($id_sanpham)) echo $id_sanpham; ?>">
                        <div class="my-3">
                            <label for="tensanpham" class="form-label">Tên Sản Phẩm<span class="text-danger">*</span></label>
                            <input type="text" class="form-control " id="tensanpham" name="tensanpham" value="<?php if (isset($id_sanpham)) echo $tensanpham; ?>">
                            <span id="tensanpham_err" class="text-danger"></span>
                        </div>
                        <div class="my-3">
                            <label for="">Mô tả<span class="text-danger">*</span></label>
                            <textarea id="editor" name="mota">
                                <?php if (isset($id_sanpham)) echo $mota; ?>
                            </textarea>
                            <span id="mota_err" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="my-3">
                            <input type="hidden" name="thuonghieu" value="<?php if (isset($id_sanpham)) {
                                echo $thuonghieu;
                            } ?>">
                            <label for="trademark_status" class="form-label">Lựa chọn thương hiệu<span class="text-danger">*</span></label>
                            <select class="form-select" name="thuonghieu" id="thuonghieu">
                                <option selected disabled>Thương hiệu</option>
                                <?php
                                $trademark = new Trademark();
                                $result = $trademark->getListAllTrademarks();
                                while ($set = $result->fetch()) :
                                ?>
                                    <option value="<?php echo $set['trademark_id'] ?>"
                                    <?php 
                                        if (isset($id_sanpham)) {
                                            if ($set['trademark_id'] == $thuonghieu) {
                                                echo ' selected';
                                            } else {
                                                echo "";
                                            }
                                        }
                                    
                                    ?>
                                    ><?php echo $set['trademark_name'] ?></option>
                                <?php endwhile ?>
                                
                            </select>
                            <span id="thuonghieu_err" class="text-danger"></span>
                        </div>
                        <div class="my-3">
                            <input type="hidden" name="loai" value="<?php if (isset($id_sanpham)) {
                                echo $loai;
                            } ?>">
                            <label for="" class="form-label">Lựa chọn loại sản phẩm<span class="text-danger">*</span></label>
                            <select class="form-select" name="loai" id="loai">
                                <option selected disabled>Loại</option>
                                <?php
                                $menu = new Menu();
                                $result = $menu->getListMenuActive();
                                while ($set = $result->fetch()) :
                                ?>
                                    <option value="<?php echo $set['menu_id'] ?>"
                                    <?php
                                        if (isset($id_sanpham)) {
                                            if ($set['menu_id'] == $loai) {
                                                echo 'selected';
                                            } else {
                                                echo "";
                                            }
                                        }
                                    ?>
                                    ><?php echo $set['menu_name'] ?></option>
                                <?php endwhile ?>
                    
                            </select>
                            <span id="loai_err" class="text-danger"></span>
                        </div>
                        <div class="my-3">
                            <label for="giasanpham" class="form-label">Giá Sản Phẩm(vnđ)<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="giasanpham" name="giasanpham" value="<?php if (isset($id_sanpham)) echo $giasanpham; ?>">
                            <span id="giasanpham_err" class="text-danger"></span>
                        </div>
                        <div class="my-3">
                            <label for="giagiam" class="form-label">Giá Khuyến Mãi(vnđ)<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="giagiam" name="giagiam" value="<?php if (isset($id_sanpham)) echo $giakhuyenmai; ?>">
                            <span id="giagiam_err" class="text-danger"></span>
                        </div>
                        <div class="my-3">
                            <label for="loaigiamgia">Giảm Giá theo</label>
                            <select name="loaigiamgia" id="loaigiamgia" disabled>
                                <option selected disabled>Chọn loại giảm giá</option>
                                <option value="0" <?php if(isset($id_sanpham)) {
                                    if ($loaigiamgia == 0) {    
                                        echo 'selected';
                                    } else {
                                        echo '';
                                    }
                                } ?>>%</option>
                                <option value="1" <?php if(isset($id_sanpham)) {
                                    if ($loaigiamgia == 1) {    
                                        echo 'selected';
                                    } else {
                                        echo '';
                                    }
                                } ?>>vnđ</option>
                            </select>
                        </div>
                        <div class="my-3">
                            <label for="size" class="form-label">Size<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="size" name="size" value="<?php if (isset($id_sanpham)) echo $size; ?>">
                            <span id="size_err" class="text-danger"></span>
                        </div>
                        <div class="my-3">
                            <label for="tonkho" class="form-label">Tồn Kho<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="tonkho" name="tonkho" value="<?php if (isset($id_sanpham)) echo $tonkho; ?>">
                            <span id="tonkho_err" class="text-danger"></span>
                        </div>
                        <div class="my-3">
                            <label for="thumbnail" class="form-label">Ảnh Review sản phẩm<span class="text-danger">*</span></label>
                            <div id="displaythumbnail"></div>
                            <?php 
                                if($ac == 'update'){
                                    echo '<img src="../../Content/images/'. $thumbnail.'" alt="thumbnail" width="100%">';
                                } else {
                                    // echo '<img src="../Content/images/noimagesuser.png" width="100px" height="100px">';
                                }
                            ?>
                            <input type="file" name="uploadThumbnail" id="uploadThumbnail" class="uploadThumbnail" >
                            <input type="hidden" class="form-control" id="thumbnail" name="thumbnail" value="<?php if (isset($id_sanpham)) echo $thumbnail; ?>">
                        </div>

                        <div class="my-3">
                            <h5>Hình sản phẩm</h5>
                            <input type="hidden" name="images" id="images" value="<?php if (isset($id_sanpham)) echo $hinh_sanpham ?>">
                            <div class="d-flex justify-content-between">
                                <?php if (isset($id_sanpham)) :
                                    $arrayImg = explode(';', $hinh_sanpham);
                                    foreach ($arrayImg as $key => $value) :
                                ?>
                                        <img src="../../Content/images/<?php echo $value; ?>" alt="" width="20%" id="showImage"><br>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </div>
                            <!-- <label for="image" class="form-label">Chọn file để upload</label>
                            <input class="form-control form-control-lg" id="image" name="image[]" multiple type="file" onchange="readURL(this);" value="<?php if (isset($id_sanpham)) echo $hinh_sanpham ?>"> -->
                            <input type="file" id='files' name="files[]" multiple><br>
                            <input type="button" id="submit" value='Upload'>
                            <div id='preview'></div>
                        </div>

                        <?php
                        if ($ac == 'insert') {
                            echo '<input id="submit_create" type="button" name="submit" value="Thêm sản phẩm" class="btn btn-primary">';
                        } else if ($ac == 'update') {
                            echo '<input id="submit_update" type="button" name="submit" value="Cập nhật" class="btn btn-primary">';
                        } else {
                            echo '<div class=""><h3> KHÔNG CÓ TRANG NÀO</h3></div>';
                        }
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- <script src="../Content/js/bootstrap-tagsinput.min.js"></script> -->
<script>
    $(document).ready(function() {
        tinymce.init({
            selector: '#editor',
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
        });

        $('#tensanpham').on('input', function() {
            checktensanpham();
        })

        $('#thuonghieu').on('input', function() {
            // checkthuonghieu();
        })

        $('#giasanpham').on('input', function() {
            checkgiasanpham();
        })

        $('#size').on('input', function() {
            checksize();
        })

        $('#tonkho').on('input', function() {
            checktonkho();
        })

        $('#giagiam').on('input', function() {
            checkgiagiam();
            
        })
        // Thêm mới sản phẩm
        $('#submit_create').click(function() {
            tinyMCE.triggerSave();
            if (!checktensanpham() && !checkthuonghieu() && !checkgiasanpham() && !checksize() && !checktonkho()) {
                console.log('err1');
                $('#message').html('<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin sản phẩm</div>');
            } else if (!checktensanpham() || !checkthuonghieu() || !checkgiasanpham() || !checksize() || !checktonkho()) {
                console.log('err2');
                $('#message').html('<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin sản phẩm</div>');
            } else {
                console.log('ok');
                $('#message').html('');
                var form = $('#form')[0];
                var data = new FormData(form);
                $.ajax({
                    type: 'POST',
                    url: 'View/ajax/addProduct.php',
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
                            $('#submitbtn').html('Submit');
                            $('#submitbtn').attr("disabled", false);
                            $('#submitbtn').css({
                                "border-radius": "4px"
                            });
                        }, 50000);
                    }
                })
            }
        })
        // Cập nhật sản phẩm
        $('#submit_update').click(function() {
            tinyMCE.triggerSave();
            if (!checktensanpham()  && !checkgiasanpham() && !checksize() && !checktonkho()) {
                console.log('err1');
                $('#message').html('<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin sản phẩm</div>');
            } else if (!checktensanpham()  || !checkgiasanpham() || !checksize() || !checktonkho()) {
                console.log('err2');
                $('#message').html('<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin sản phẩm</div>');
            } else {
                console.log('ok');
                $('#message').html('');
                var form = $('#form')[0];
                var data = new FormData(form);
                $.ajax({
                    type: 'POST',
                    url: 'View/ajax/updateProduct.php',
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
                            $('#submitbtn').html('Submit');
                            $('#submitbtn').attr("disabled", false);
                            $('#submitbtn').css({
                                "border-radius": "4px"
                            });
                        }, 50000);
                    }
                })
            }
        })


        $('#submit').click(function() {
            var form_data = new FormData();
            var arrImg = [];
            /* Read selected files */
            var totalfiles = document.getElementById('files').files.length;
            var files = document.getElementById('files');
            for (let i = 0; i < totalfiles; i++) {
                const element = files.files[i].name;
                arrImg.push(files.files[i].name)
            }
            console.log(arrImg);
            if (arrImg.lenth != 0) {
                var strNameImg = arrImg.join(';');
                $('#images').val(strNameImg);
                 
            }

            for (var index = 0; index < totalfiles; index++) {
                form_data.append("files[]", document.getElementById('files').files[index]);
            }

            /* AJAX request */
            $.ajax({
                type: 'post',
                url: 'View/ajax/ajaxfile.php',
                data: form_data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {

                    for (var index = 0; index < response.length; index++) {
                        var src = response[index];
                        // var nameImg = response[index].name;

                        /* Thêm 1 element là img vào trong div có id là preview */
                        $('#preview').append('<img src="' + src + '" width="200px;" height="200px">');
                        // $('#images').val(nameImg);
                    }

                }
            });

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
                    $('#displaythumbnail').append(`<img src="../../Content/images/${json.code}" width="200" height="200">`)
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

        function checktensanpham() {
            var tensanpham = $('#tensanpham').val();
            if (tensanpham == "") {
                $('#tensanpham_err').html('Vui lòng nhập tên sản phẩm');
                return false;
            } else if (tensanpham.length <= 3) {
                $('#tensanpham_err').html('Tên sản phẩm quá ngắn')
                return false;
            } else {
                $('#tensanpham_err').html('');
                return true;
            }
        }

        function checkthuonghieu() {
            var thuonghieu = $('#thuonghieu').val();
                if (thuonghieu == "" || thuonghieu == null) {
                    $('#thuonghieu_err').html('Vui lòng nhập thương hiệu sản phẩm');
                    return false;
                } else {
                    $('#thuonghieu_err').html('');
                    return true;
                }
        }

        function checkgiasanpham() {
            var floatValues = /[+-]?([0-9]*[.])?[0-9]+/;
            var regex = /^(\$|)([1-9]\d{0,2}(\,\d{3})*|([1-9]\d*))(\.\d{2})?$/;
            var giasanpham = $('#giasanpham').val();
            var giaValid = regex.test(giasanpham);
            // var giavalid2 = floatValues.test(giasanpham);
            if (giasanpham == '') {
                $('#giasanpham_err').html('Giá sản phẩm không được để trống')
                return false;
            } else if (!giaValid) {
                $('#giasanpham_err').html('Giá sản phẩm chỉ chứ số');
                return false;
            } else {
                $('#giasanpham_err').html('')
                return true;
            }
        }

        function checksize() {
            // var regex = /^(\$|)([1-9]\d{0,2}(\d{3})*|([1-9]\d*))(\.\d{2})?$/;
            var size = $('#size').val();
            // var sizeValid = regex.test(size);
            if (size == '') {
                $('#size_err').html('Vui lòng nhập size');
                return false;
            } else {
                $('#size_err').html('');
                $('#size').tagsInput();
                return true;
            }
        }

        function checktonkho() {
            var regex = /^(\$|)([1-9]\d{0,2}(\,\d{3})*|([1-9]\d*))(\.\d{2})?$/;
            var tonkho = $('#tonkho').val();
            var sizeValid = regex.test(tonkho);
            if (tonkho == '') {
                $('#tonkho_err').html('Vui lòng nhập số lượng tồn kho');
                return false;
            } else if (!sizeValid) {
                $('#tonkho').html('Số lượng chỉ được nhập số')
                return false;
            } else {
                $('#tonkho').html('')
                return true;
            }
        }

        function checkgiagiam() {
            var giagiam = $('#giagiam').val();
            var floatValues = /[+-]?([0-9]*[.])?[0-9]+/;
            var regex = /^(\$|)([1-9]\d{0,2}(\,\d{3})*|([1-9]\d*))(\.\d{2})?$/;
            var giaValid = floatValues.test(giagiam);
            if (!giaValid) {
                $('#giagiam_err').html('Giá sản phẩm chỉ chứ số');
                return false;
            } else {
                $('#giagiam_err').html('')
                if (giagiam != 0 ) {
                    $('#loaigiamgia').removeAttr('disabled');
                } else {
                    $('#loaigiamgia').attr('disabled', true);
                }
                return true;
            }
        }

        $giamgia = $('#giagiam').val();
        if ($giamgia != 0) {
            $('#loaigiamgia').removeAttr('disabled');
        }
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            const arrayInput = Array.from(input.files)
            console.log(arrayInput);
            arrayInput.forEach((image, index) => {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result).width(150).height(200);
                };
                reader.readAsDataURL(arrayInput[index]);
            });

        }
    }
</script>