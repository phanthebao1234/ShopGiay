<div class="container border border-1 border-danger shadow-lg p-3 mb-5 bg-body rounded my-5">
    <h1 class="text-danger fw-bold text-capitalize text-center">Tạo tài khoản</h1>
    <div class="container">
        <div id="message"></div>
        <form class="row g-3 my-4" id="myform" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">
                <label for="customer_firstname" class="form-label">Họ & Tên Đệm<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="customer_firstname" name="customer_firstname">
                <span id="customer_firstname_err" class="text-danger"></span>
            </div>
            <div class="col-md-6">
                <label for="customer_lastname" class="form-label">Tên<span class="text-danger">*</span></label>
                <input type="customer_lastname" class="form-control" id="customer_lastname" name="customer_lastname">
                <span id="customer_lastname_err" class="text-danger"></span>
            </div>
            <div class="col-md-6">
                <label for="customer_email" class="form-label">Tài khoản email<span class="text-danger">*</span></label>
                <input type="customer_email" class="form-control" id="customer_email" name="customer_email">
                <span id="customer_email_err" class="text-danger"></span>
            </div>
            <div class="col-md-6">
                <label for="customer_password" class="form-label">Mật khẩu<span class="text-danger">*</span></label>
                <input type="customer_password" class="form-control" id="customer_password" name="customer_password">
                <span id="customer_password_err" class="text-danger"></span>
            </div>
            <div class="col-md-6">
                <label for="customer_cpassword" class="form-label">Nhập lại mật khẩu<span class="text-danger">*</span></label>
                <input type="customer_cpassword" class="form-control" id="customer_cpassword" name="customer_cpassword">
                <span id="customer_cpassword_err" class="text-danger"></span>
            </div>
            <div class="col-md-4">
                <label for="country" class="form-label">Tỉnh<span class="text-danger">*</span></label>
                <select class="form-select" id="country-dropdown" name="tinh">
                    <option value="">Chọn Tỉnh</option>
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
            <div class="col-md-4">
                <label for="state" class="form-label">Thành phố <span class="text-danger">*</span></label>
                <select class="form-select" id="state-dropdown" name="thanhpho"></select>
            </div>
            <div class="col-md-3">
                <label for="city" class="form-label">Quận, Huyện, Xã <span class="text-danger">*</span></label>
                <select class="form-select" id="city-dropdown" name="customer_code_address"></select>
            </div>
            <div class="col-md-3">
                <label for="" class="form-label">Địa chỉ nhà<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="customer_address" id="customer_address">
            </div>
            <div class="col-md-6">
                <label for="customer_phone" class="form-label">Số điện thoại<span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="customer_phone" name="customer_phone">
                <span id="customer_phone_err" class="text-danger"></span>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Giới tính</label>
                <select id="inputState" class="form-select" name="customer_render">
                    <option value="0" selected>Lựa chọn</option>
                    <option value="0">Nam</option>
                    <option value="1">Nữ</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="customer_birthday" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" id="customer_birthday" name="customer_birthday">
            </div>
            <div class="col-sm-3">
                <label for="customer_image" class="form-label">Ảnh cá nhân</label>
                <input type="file" class="form-control" id="customer_image" name="customer_image" placeholder="1234 Main St">
            </div>
            <div class="col-12">
                <button type="button" id="submitbtn" class="btn btn-primary text-capitalize" name="submit">Tạo tài khoản</button>
                <p><a href="index.php?action=auth&act=login" class="fst-italic">Đã có tài khoản</a></p>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#country-dropdown').on('change', function() {
            var province_id = this.value;
            $.ajax({
                url: "View/districts.php",
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
                url: "View/wards.php",
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
        $('#submitbtn').click(function() {
            if (!checkfirstname() && !checkemail() && !checkmobile() && !checkpass() && !checkcpass()) {
                console.log("er1");
                $("#message").html(`<div class="alert alert-warning">Vui lòng điền đầy đủ thông tin</div>`);
            } else if (!checkfirstname() || !checkemail() || !checkmobile() || !checkpass() || !checkcpass()) {
                $("#message").html(`<div class="alert alert-warning"Vui lòng điền đầy đủ thông tin</div>`);
                console.log("er");
            } else {
                console.log("ok");
                $("#message").html("");
                var form = $('#myform')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "View/ajax/resgister.php",
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
        });
    });

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

    function checkcpass() {
        var pass = $('#customer_password').val();
        var cpass = $('#customer_cpassword').val();
        if (cpass == "") {
            $('#customer_cpassword_err').html('Nhập lại mật khẩu là bắt buộc');
            return false;
        } else if (pass !== cpass) {
            $('#customer_cpassword_err').html('Mật khẩu nhập lại sai');
            return false;
        } else {
            $('#customer_cpassword_err').html('');
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

    function password_show_hide() {
        console.log('ok');
        var x = document.getElementById("customer_password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }
</script>