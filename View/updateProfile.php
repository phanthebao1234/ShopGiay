<?php
    $customer_id = $_SESSION['customer_id'];
    $customer = new Customer();
    $result = $customer->getCustomer($customer_id);
    $customer_firstname = $result['customer_firstname'];
    $customer_lastname = $result['customer_lastname'];
    $customer_render = $result['customer_render'];
    $customer_email = $result['customer_email'];
    $customer_phone = $result['customer_phonenumber'];
    $customer_password = $result['customer_password'];
    $customer_birthday = $result['customer_birthday'];
    $customer_address = $result['customer_address'];
    $customer_code_address = $result['customer_code_address'];
    $customer_image = $result['customer_image'];
?>
<div class="container mt-3">
    <h1 class="text-center text-danger text-capitalize fw-bold">
        Cập nhật thông tin tài khoản
    </h1>
    <div id="message"></div>
    <form id="form">
        <div class="row border my-4 p-5">
            <input type="hidden" class="form-control" name="customer_id" value="<?php if (isset($customer_id)) echo $customer_id ?>">
            <input type="hidden" name="customer_code_address" value="<?php if (isset($customer_id)) echo $customer_code_address ?>" >
            <input type="hidden" name="customer_email" value="<?php if (isset($customer_id)) echo $customer_email ?>">
            <div class="col-lg-9 row " >
                <div class="col-md-6">
                    <label for="phone" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="customer_firstname" name="customer_firstname" value="<?php if (isset($customer_id)) echo $customer_firstname ?>">
                    <span id="customer_firstname_err" class="text-danger"></span>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="customer_lastname" name="customer_lastname" value="<?php if (isset($customer_id)) echo $customer_lastname ?>">
                    <span id="customer_lastname_err" class="text-danger"></span>
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Giới tính</label>
                    <select class="form-control" name="customer_render" value="<?php if (isset($customer_id)) echo $customer_render ?>">
                        <option value="0">Select Render:</option>
                        <option <?php echo $customer_render == 0 ? "selected" : "" ?> value="0">Nam</option>
                        <option <?php echo $customer_render == 1 ? "selected" : "" ?> value="1">Nữ</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="customer_phone" name="customer_phonenumber" value="<?php if (isset($customer_id)) echo $customer_phone ?>">
                    <span id="customer_phone_err" class="text-danger"></span>
                </div>
                <div class="col-md-3">
                    <label for="phone" class="form-label">Ngày sinh</label>
                    <input type="date" class="form-control" name="customer_birthday" value="<?php if (isset($customer_id)) echo $customer_birthday ?>">
                </div>
                <div class="col-md-3">
                    <label for="country" class="form-label">Tỉnh/ Thành phố<span class="text-danger">*</span></label>
                    <select class="form-select" id="country-dropdown" name="tinh">
                        <option value="">Chọn Tỉnh/ Thành phố</option>
                        <?php
                        $provinces = new Address();
                        $result = $provinces->getListProvince();
                        while ($set = $result->fetch()) :

                        ?>
                            <option value="<?php echo $set['code']; ?>"><?php echo $set["name"]; ?></option>
                        <?php
                        endwhile;
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="state" class="form-label">Quận/ Huyện<span class="text-danger">*</span></label>
                    <select class="form-select" id="state-dropdown" name="thanhpho"></select>
                </div>
                <div class="col-md-3">
                    <label for="city" class="form-label">Phường/ Xã <span class="text-danger">*</span></label>
                    <select class="form-select" id="city-dropdown" name="customer_code_address"></select>
                </div>
                <div class="col-md-3">
                    <label for="customer_address" class="form-label">Địa chỉ nhà<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="customer_address" id="customer_address" value="<?php if (isset($customer_id)) echo $customer_address ?>">
                </div>
                <div class="col-md-12">
                    <label for="phone" class="form-label">Email</label>
                    <input type="customer_email" disabled  class="form-control" id="customer_email" name="customer_email" value="<?php if (isset($customer_id)) echo $customer_email ?>">
                    <span id="customer_email_err" class="text-danger"></span>
                </div>
                <div class="col-md-12">
                    <label for="phone" class="form-label">Password</label>
                    <input type="password" class="form-control" id="customer_password" name="customer_password" value="<?php if (isset($customer_id)) echo $customer_password ?>">
                    <span id="customer_password_err" class="text-danger"></span>
                </div>
            </div>
            <div class="col-lg-3">
                <div>
                    <label for="" class="form-label">Ảnh hồ sơ</label>
                    <input type="hidden" class="form-control" id="thumbnail" name="customer_image" value="<?php if (isset($customer_image)) echo $customer_image; ?>">
                    <!-- <input class="form-control form-control-lg" class="uploadimg" id="image" name="image" type="file" onchange="readURL(this);"> -->
                    <input id="uploadImage" type="file" accept="image/*" name="image1" class="uploadThumbnail" onchange="readURL(this);"/>
                    <div class="d-block">
                        <img src="../../Content/images/<?php if (isset($customer_id)) echo $customer_image ?>" alt="" id="showImage" width="30%">
                    </div>
                </div>
            </div>
            <div class="col-md-12 my-5">
                <div class="text-center">
                    <button id="submit_update" type="button" class="btn btn-primary btn-lg px-5 py-3">Cập nhật tài khoản</button>
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
                    $('#showImage').attr('src', e.target.result).width('100%').height('100%');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    $(document).ready(function() {
        $('.uploadThumbnail').on('change', function(e){
            var filename = e.target.files[0].name;
            var thumbnail = $('#thumbnail');
            thumbnail.val(filename);
        })
        
        $('#customer_firstname').on('input', function() {
            checkfirstname();
        });
        $('#customer_lastname').on('input', function() {
            checklastname();
        });
        $('#customer_email').on('input', function() {
            checkemail();
        });
        $('#customer_password').on('input', function() {
            checkpass();
        });
        $('#customer_cpassword').on('input', function() {
            checkcpass();
        });
        $('#customer_phone').on('input', function() {
            checkmobile();
        });
        $('#submit_create').click(function() {
            if (!checkfirstname() && !checklastname() && !checkemail() && !checkmobile() && !checkpass()) {
                console.log("er1");
                $("#message").html(`<div class="alert alert-warning">Vui lòng điền đầy đủ thông tin</div>`);
            } else if (!checkfirstname() ||  !checklastname() || !checkemail() || !checkmobile() || !checkpass()) {
                $("#message").html(`<div class="alert alert-warning"Vui lòng điền đầy đủ thông tin</div>`);
                console.log("er");
            } else {
                console.log("ok");
                $("#message").html("");
                var form = $('#form')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "index.php?action=customer&act=insert_action",
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
                    url: "index.php?action=customer&act=update_action",
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

        // Địa chỉ
        $('#country-dropdown').on('change', function() {
            var province_id = this.value;
            $.ajax({
                url: "View/ajax/districts.php",
                type: "POST",
                data: {
                    province_id: province_id
                },
                cache: false,
                success: function(result) {
                    $("#state-dropdown").html(result);
                    $('#city-dropdown').html('<option value="">Chọn quận, huyện, xã</option>');
                }
            });
        });

        $('#state-dropdown').on('change', function() {
            var state_id = this.value;
            $.ajax({
                url: "View/ajax/wards.php",
                type: "POST",
                data: {
                    state_id: state_id
                },
                cache: false,
                success: function(result) {
                    $("#city-dropdown").html(result);
                }
            });
        });

        

        // Hàm validation rules
        function checkfirstname() {
            var pattern = /^[A-Za-z0-9]+$/;
            var user = $('#customer_firstname').val();
            var validuser = pattern.test(user);
            if ($('#customer_firstname').val().length < 2) {
                $('#customer_firstname_err').html('Họ và Tên đệm quá ngắn');
                return false;
            } else {
                $('#customer_firstname_err').html('');
                return true;
            }
        }

        function checklastname() {
            var pattern = /^[A-Za-z0-9]+$/;
            var user = $('#customer_lastname').val();
            var validuser = pattern.test(user);
            if ($('#customer_lastname').val().length < 2) {
                $('#customer_lastname_err').html('Tên quá ngắn');
                return false;
            } else {
                $('#customer_lastname_err').html('');
                return true;
            }
        }

        function checkemail() {
            var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var email = $('#customer_email').val();
            var validemail = pattern1.test(email);
            if (email == "") {
                $('#customer_email_err').html('Tài khoản email là bắt buộc');
                return false;
            } else if (!validemail) {
                $('#customer_email_err').html('Tài khoản email không đúng định dạng');
                return false;
            } else {
                $('#customer_email_err').html('');
                return true;
            }
        }

        function checkpass() {
            console.log("sass");
            var pattern2 = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
            var pass = $('#customer_password').val();
            var validpass = pattern2.test(pass);

            if (pass == "") {
                $('#customer_password_err').html('Mật khẩu là bắt buộc');
                return false;
            } else if (!validpass) {
                $('#customer_password_err').html('Tối đa từ 5 tới 15 kí tự, bao gồm chữ thường, chữ in hoa, số và các kí tự đặt biệt');
                return false;

            } else {
                $('#customer_password_err').html("");
                return true;
            }
        }

        function checkmobile() {
            if (!$.isNumeric($("#customer_phone").val())) {
                $("#customer_phone_err").html("Số điện thoại chỉ chứa số");
                return false;
            } else if ($("#customer_phone").val().length != 10) {
                $("#customer_phone_err").html("Số điện thoại bắt buộc 10 số");
                return false;
            } else {
                $("#customer_phone_err").html("");
                return true;
            }
        }
    })
</script>