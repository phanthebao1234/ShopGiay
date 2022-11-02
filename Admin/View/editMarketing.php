<?php
$act = '';
$title = '';
if (isset($_GET['act'])) {
    $act = $_GET['act'];
    if ($act == 'insert') {
        $title = 'Thêm mới chiến dịch';
    } else if ($act == 'update') {
        $title = 'Cập nhật chiến dịch';
        if (isset($_GET['id'])) {
            $marketing_id = $_GET['id'];
            $marketing = new Marketing();
            $result = $marketing->getDetailMarketing($marketing_id);
            $marketing_name = $result['marketing_name'];
            $marketing_description = $result['marketing_description'];
            $marketing_banner = $result['marketing_banner'];
            $marketing_voucher_id = $result['marketing_voucher_id'];
            $marketing_saleall = $result['marketing_saleall'];
            $marketing_trademark_id = $result['marketing_trademark_id'];
            $marketing_saletrademark = $result['marketing_saletrademark'];
            $marketing_start = $result['marketing_start'];
            $marketing_end = $result['marketing_end'];
            $marketing_status = $result['marketing_status'];
            $flag_checked = 0;
            if ($marketing_saleall != null || $marketing_saleall != "") {
                $flag_checked = 1;
            } else if($marketing_saletrademark != null || $marketing_saletrademark != ""){
                $flag_checked = 2;
            } else if($marketing_voucher_id != null || $marketing_voucher_id != "") {
                $flag_checked = 3;
            }
        }
    } else {
    }
}

?>

<a class="btn btn-primary" href="index.php?action=marketing">Hủy</a>
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
            <input type="hidden" class="form-control" name="marketing_id" value="<?php if (isset($marketing_id)) echo $marketing_id ?>">
            <div class="col-md-12">
                <label for="marketing_name" class="form-label">Tên chiến dịch</label>
                <input type="text" class="form-control" id="marketing_name" name="marketing_name" value="<?php if (isset($marketing_id)) echo $marketing_name ?>">
                <span id="marketing_name_err" class="text-danger"></span>
            </div>
            <div class="col-md-12 my-3">
                <label for="marketing_description" class="form-label">Mô tả</label>
                <textarea id="marketing_description" name="marketing_description"><?php if (isset($marketing_id)) echo $marketing_description ?></textarea>
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">Ảnh Marketing</label>
                <input type="hidden" name="marketing_banner" id="marketing_banner" value="<?php if(isset($marketing_id)) echo $marketing_banner ?>">
                <img src="../../Content/images/<?php if (isset($marketing_id)) echo $marketing_image ?>" alt="" id="showImage" width="30%">
                
                <input id="uploadImage1" type="file" accept="image/*" name="image1" class="uploadimg" onchange="readURL(this)"/>
            </div>
            <div class="col-md-3">
                <label for="marketing_start" class="form-label">Ngày bắt đầu</label>
                <input type="date" class="form-control" id="marketing_start" name="marketing_start" value="<?php if (isset($marketing_id)) echo $marketing_start ?>">
            </div>
            <div class="col-md-3">
                <label for="marketing_start" class="form-label">Ngày kết thúc</label>
                <input type="date" class="form-control" id="marketing_start" name="marketing_end" value="<?php if (isset($marketing_id)) echo $marketing_end ?>">
            </div>

            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="selecttypesale" id="selecttypesale" value="all" 
                    <?php 
                        if(isset($marketing_id)) {
                            if ($flag_checked == 1) {
                                echo "checked";
                            }
                        } 
                    ?>
                    >
                    <label class="form-check-label" for="selecttypesale">
                        Giảm giá toàn bộ sản phẩm
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="selecttypesale" id="selecttypesale" value="trademark"
                        <?php 
                            if(isset($marketing_id)) {
                                if ($flag_checked == 2) {
                                    echo "checked";
                                }
                            } 
                        ?>
                    >
                    <label class="form-check-label" for="selecttypesale">
                        Giảm giá theo thương hiệu
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="selecttypesale" id="selecttypesale" value="voucher" 
                    <?php 
                        if(isset($marketing_id)) {
                            if ($flag_checked == 3) {
                                echo "checked";
                            }
                        }    
                    ?>
                    >
                    <label class="form-check-label" for="selecttypesale">
                        Giảm giá theo voucher đã được tạo
                    </label>
                </div>
            </div>
            <div id="option-1" class="col-md-12 my-3 d-none">
                <label for="marketing_saleall" class="form-label">Giảm giá toàn bộ sản phẩm(giảm theo %)</label>
                <input type="number" step="0.1" class="form-control" id="marketing_saleall" name="marketing_saleall" value="<?php if (isset($marketing_id)) echo $marketing_saleall ?>">
            </div>
            <div id="option-2" class="col-md-12 my-3 d-none">
                <input type="hidden" name="marketing_trademark_id" value="<?php if (isset($marketing_id)) echo $marketing_trademark_id ?>">
                <input type="hidden" name="marketing_saletrademark" value="<?php if (isset($marketing_id)) echo $marketing_saletrademark ?>">
                <label for="marketing_trademark_id" class="form-label">Giảm giá tất cả sản phẩm theo thương hiệu(giảm theo %)</label>
                <select class="form-select" id="marketing_trademark_id" name="marketing_trademark_id">
                    <option value="" disabled selected>Chọn thương hiệu</option>
                    <?php
                        $trademark = new Trademark();
                        $result = $trademark->getListAllTrademarks();
                        while ($set = $result->fetch()) :
                            
                        ?>
                            <option value="<?php echo $set['trademark_id']; ?>"><?php echo $set["trademark_name"]; ?></option>
                        <?php
                        endwhile;
                    ?>
                </select>
                <label for="marketing_saletrademark" class="form-label">Giảm giá toàn bộ sản phẩm(giảm theo %)</label>
                <input type="number" step="0.1" class="form-control" id="marketing_saletrademark" name="marketing_saletrademark" value="<?php if (isset($marketing_id)) echo $marketing_saletrademark ?>">
                
            </div>
            <div id="option-3" class="col-md-12 my-3 d-none">
                <input type="hidden" name="marketing_voucher_id" value="<?php if(isset($marketing_id)) echo $marketing_voucher_id?>">
                <label for="marketing_voucher_id" class="form-label">Chọn voucher cho chiến dịch<span class="text-danger">*</span></label>
                <select class="form-select" id="marketing_voucher_id" name="marketing_voucher_id">
                    <?php
                    $voucher = new Voucher();
                    $result = $voucher->getListAllVoucherActive();
                    while ($set = $result->fetch()) :
                        
                    ?>
                        <option value="<?php echo $set['voucher_id']; ?> <?php 
                            if(isset($marketing_id)) {
                                if (isset($marketing_voucher_id) && $marketing_voucher_id == $set['voucher_id']) {
                                    echo "selected";
                                }
                            }
                        ?>"><?php echo $set["voucher_name"];?></option>
                    <?php
                    endwhile;
                    ?>
                </select>
            </div>
            <div class="col-md-12">
                <div class="float-end">
                    <?php
                    if ($act == 'insert') {
                        echo '<button id="submit_create" type="button" class="btn btn-primary btn-lg">Tạo chiến dịch</button>';
                    } else if ($act == 'update') {
                        echo '<button id="submit_update" type="button" class="btn btn-primary btn-lg">Cập nhật chiến dịch</button>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
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
    $(document).ready(function() {
        tinymce.init({
            selector: '#blog_content',
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
        });
        tinymce.init({
            selector: '#marketing_description',
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
        });
        
        $('#submit_create').click(function() {
            tinyMCE.triggerSave();
            var form = $('#form')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "index.php?action=marketing&act=insert_action",
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
                        $('#myform').trigger("reset");
                        $('#submitbtn').html('Submit');
                        $('#submitbtn').attr("disabled", false);
                        $('#submitbtn').css({
                            "border-radius": "4px"
                        });
                    }, 50000);
                }
            });
        
        })
        $('#submit_update').click(function() {
            if (!checkfirstname() && !checklastname() && !checkemail() && !checkmobile() && !checkpass()) {
                console.log("er1");
                $("#message").html(`<div class="alert alert-warning">Vui lòng điền đầy đủ thông tin</div>`);
            } else if (!checkfirstname() || !checklastname() || !checkemail() || !checkmobile() || !checkpass()) {
                $("#message").html(`<div class="alert alert-warning">Vui lòng điền đầy đủ thông tin</div>`);
                console.log("er");
            } else {
                console.log("ok");
                $("#message").html("");
                var form = $('#form')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "index.php?action=marketing&act=update_action",
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
                            $('#myform').trigger("reset");
                            $('#submitbtn').html('Submit');
                            $('#submitbtn').attr("disabled", false);
                            $('#submitbtn').css({
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
            var thumbnail = $('#marketing_banner');
            thumbnail.val(filename);
        })

        

        // Hàm validation rules
        function checkfirstname() {
            var pattern = /^[A-Za-z0-9]+$/;
            var user = $('#marketing_name').val();
            var validuser = pattern.test(user);
            if ($('#marketing_name').val().length < 2) {
                $('#marketing_name_err').html('Họ và Tên đệm quá ngắn');
                return false;
            } else if (!validuser) {
                $('#marketing_name_err').html('Họ và Tên đệm sai định dạng');
                return false;
            } else {
                $('#marketing_name_err').html('');
                return true;
            }
        }

        function checklastname() {
            var pattern = /^[A-Za-z0-9]+$/;
            var user = $('#marketing_lastname').val();
            var validuser = pattern.test(user);
            if ($('#marketing_lastname').val().length < 2) {
                $('#marketing_lastname_err').html('Tên quá ngắn');
                return false;
            } else if (!validuser) {
                $('#marketing_lastname_err').html('Tên sai định dạng');
                return false;
            } else {
                $('#marketing_lastname_err').html('');
                return true;
            }
        }

        function checkemail() {
            var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var email = $('#marketing_email').val();
            var validemail = pattern1.test(email);
            if (email == "") {
                $('#marketing_email_err').html('Tài khoản email là bắt buộc');
                return false;
            } else if (!validemail) {
                $('#marketing_email_err').html('Tài khoản email không đúng định dạng');
                return false;
            } else {
                $('#marketing_email_err').html('');
                return true;
            }
        }

        function checkpass() {
            console.log("sass");
            var pattern2 = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
            var pass = $('#marketing_password').val();
            var validpass = pattern2.test(pass);

            if (pass == "") {
                $('#marketing_password_err').html('Mật khẩu là bắt buộc');
                return false;
            } else if (!validpass) {
                $('#marketing_password_err').html('Tối đa từ 5 tới 15 kí tự, bao gồm chữ thường, chữ in hoa, số và các kí tự đặt biệt');
                return false;

            } else {
                $('#marketing_password_err').html("");
                return true;
            }
        }

        function checkmobile() {
            if (!$.isNumeric($("#marketing_phone").val())) {
                $("#marketing_phone_err").html("Số điện thoại chỉ chứa số");
                return false;
            } else if ($("#marketing_phone").val().length != 10) {
                $("#marketing_phone_err").html("Số điện thoại bắt buộc 10 số");
                return false;
            } else {
                $("#marketing_phone_err").html("");
                return true;
            }
        }
        
        $('input[type=radio][name=selecttypesale]').change(function() {
            if (this.value == 'all') {
                console.log("All product");
                $('#option-3').removeClass("d-block");
                $('#option-3').addClass("d-none");
                $('#option-2').removeClass('d-block');
                $('#option-2').addClass('d-none');
                $('#option-1').removeClass('d-none');
                $('#option-1').addClass('d-block');
                
            }
            else if (this.value == 'trademark') {
                console.log("Trademard");
                $('#option-1').removeClass('d-block');
                $('#option-1').addClass('d-none');
                $('#option-2').addClass('d-block');
                $('#option-2').removeClass('d-none');
                $('#option-3').removeClass('d-block');
                $('#option-3').addClass('d-none');
            } else if (this.value == 'voucher') {
                console.log("Trademard");
                $('#option-1').removeClass('d-block');
                $('#option-1').addClass('d-none');
                $('#option-2').addClass('d-none');
                $('#option-2').removeClass('d-block');
                $('#option-3').removeClass('d-none');
                $('#option-3').addClass('d-block');
            }
        });
        
        function changeComponent($value) {
            switch ($value) {
                case 'all':
                    $('#option-3').removeClass("d-block");
                    $('#option-3').addClass("d-none");
                    $('#option-2').removeClass('d-block');
                    $('#option-2').addClass('d-none');
                    $('#option-1').removeClass('d-none');
                    $('#option-1').addClass('d-block');
                    break;
                case 'trademark':
                    $('#option-1').removeClass('d-block');
                    $('#option-1').addClass('d-none');
                    $('#option-2').addClass('d-block');
                    $('#option-2').removeClass('d-none');
                    $('#option-3').removeClass('d-block');
                    $('#option-3').addClass('d-none');
                    break;
                case 'voucher':
                    $('#option-1').removeClass('d-block');
                    $('#option-1').addClass('d-none');
                    $('#option-2').addClass('d-none');
                    $('#option-2').removeClass('d-block');
                    $('#option-3').removeClass('d-none');
                    $('#option-3').addClass('d-block');
                    break;
            }
        }
        
        const arrayItem = $('input[type=radio][name=selecttypesale]');
        for (let i = 0; i < arrayItem.length; i++) {
            const element = arrayItem[i];
            console.log(element.checked);
            if (element.checked == true) {
                console.log(element.value);
                changeComponent(element.value);
                
            }
        }
    })
</script>