<div class="container">
    <h3 class="my-3 text-capitalize fw-bold text-danger">Thông tin của bạn</h3>
    <h5 class="form-label text-success fw-bold">Phân quyền: <?php if (isset($_SESSION['roll'])) {
                                                                if ($_SESSION['roll'] == 'admin') {
                                                                    echo 'Amin';
                                                                } else {
                                                                    echo 'User';
                                                                }
                                                            } ?></h5>
    <form class="row g-3 my-3" id="form" action="" method="POST">
        <?php
        $user_id = $_SESSION['id'];
        $user = new User();
        $result = $user->getUser($user_id);
        $user_firstname = $result['user_firstname'];
        $user_lastname = $result['user_lastname'];
        $user_birthday = $result['user_birthday'];
        $user_render = $result['user_render'];
        $user_email = $result['user_email'];
        $user_phonenumber = $result['user_phonenumber'];
        $user_password = $result['user_password'];
        $user_address = $result['user_address'];
        $user_roll = $result['user_roll'];
        $user_number_home = $result['user_number_home'];
        $user_image = $result['user_image'];

        ?>
        <div class="row col-9">
            <input type="hidden" name="roll" value="<?php echo $user_roll ?>" />
            <input type="hidden" name="id" value="<?php echo $user_id ?>">
            <div class="col-md-4">
                <label for="firstname" class="form-label">Họ</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php if (isset($user_id)) echo $user_firstname; ?>">
                <span id="firstname_err" class="text-danger"></span>
            </div>
            <div class="col-md-3">
                <label for="lastname" class="form-label">Tên</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php if (isset($user_id)) echo $user_lastname; ?>">
                <span id="lastname_err" class="text-danger"></span>
            </div>
            <div class="col-md-3">
                <label for="birth" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" id="birth" name="birth" value="<?php if (isset($user_id)) echo $user_birthday; ?>">
            </div>
            <div class="col-md-2">
                <label for="render" class="form-label">Giới tính</label>
                <select class="form-select" name="render" id="render">
                    <option <?php $user_render == 1 ? 'selected' : '' ?> value="1">Nam</option>
                    <option <?php $user_render == 0 ? 'selected' : '' ?> value="0">Nữ</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php if (isset($user_id)) echo $user_email ?>">
                <span id="email_err" class="text-danger"></span>
            </div>
            <div class="col-md-4">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php if (isset($user_id)) echo $user_phonenumber ?>">
                <span id="phone_err" class="text-danger"></span>
            </div>
            <div class="col-md-4">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php if (isset($user_id)) echo $user_password ?>">
                <span id="password_err" class="text-danger"></span>
            </div>
            <div class="col-md-6">
                <label for="country" class="form-label"><strong>Tỉnh : </strong><span class="text-danger">*</span></label>
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
            <div class="col-md-6">
                <label for="state" class="form-label"><strong>Thành phố : </strong><span class="text-danger">*</span></label>
                <select class="form-select" id="state-dropdown" name="thanhpho"></select>
            </div>
            <div class="col-md-6">
                <label for="city" class="form-label"><strong>Quận, Huyện, Xã : </strong><span class="text-danger">*</span></label>
                <select class="form-select" id="city-dropdown" name="address"></select>
            </div>
            <div class="col-md-6">
                <label for="" class="form-label"><strong>Địa chỉ nhà: </strong><span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="diachi" id="diachi" value="<?php if ($user_id) echo $user_number_home ?>">
            </div>

            <div class="col-12">
                <label for="address" class="form-label">Địa chỉ hiện tại</label>
                <?php
                if ($user_address != "") :
                    $address = new Address();
                    $result = $address->getDetailAddress($user_address)

                ?> 
                    <input type="text" disabled class="form-control" id="address" name="address" value="<?php echo $result['address'] . '. Số nhà: ' . $user_number_home; ?>">
                <?php
                else :
                ?>
                    <input type="text" disabled class="form-control" id="address" name="address" value="">
                <?php endif; ?>
            </div>
            <div class="col-12">
                <button type="button" id="submit_update" class="btn btn-primary btn-lg">Cập nhật thông tin</button>
            </div>
        </div>
        <div class="col-1"></div>
        <div class="col-2">
            <?php
            if ($user_image != "") {
            ?>
                <img src="Content/images/<?php echo $user_image ?>" style="width: 100%; border-radius: 10px" alt="Ảnh CV 12">
            <?php } else if ($user_image == "") { ?>
                <img src="Content/images/noimageuser.png" style="width: 100%; border-radius: 10px" alt="Ảnh CV">
            <?php } ?>

            <input type="file" name="file" id="uploadimg">
            <button type="button" id="update_img" class="btn btn-primary">Cập nhật ảnh</button>
        </div>
        <div class="col-12" id="message"></div>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#update_img').on('click', function() {
            console.log("test");
            var file_upload = $('#uploadimg');
            var file_data = $(file_upload).prop('files')[0];
            var form_data = new FormData();
            var ext = $(file_upload).val().split('.').pop().toLowerCase();
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
                    $('#city-dropdown').html('<option value="">Select State First</option>');
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

        $('#firstname').on('input', function() {
            checkfirstname();
        })

        $('#lastname').on('input', function() {
            checklastname();
        })

        $('#email').on('input', function() {
            checkemail();
        })

        $('#phone').on('input', function() {
            checkphone();
        })

        $('#password').on('input', function() {
            checkpassword();
        })

        $('#submit_update').click(function() {
            if (!checkfirstname() && !checklastname() && !checkemail() && !checkphone() && !checkpassword()) {
                console.log('err1');
                $('#message').html('<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin sản phẩm</div>');
            } else if (!checkfirstname() || !checklastname() || !checkemail() || !checkphone() || !checkpassword()) {
                console.log('err2');
                $('#message').html('<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin sản phẩm</div>');
            } else {
                $('#message').html('');
                var form = $('#form')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "View/ajax/updateProfile.php",
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

        function checkfirstname() {
            var firstname = $('#firstname').val();
            if (firstname == '') {
                $('#firstname_err').html('Vui lòng nhập họ của bạn');
                return false;
            } else if (firstname.length < 2 || firstname.length > 100) {
                $('#firstname_err').html('Độ dài của họ là từ 2 -> 100 kí tự');
                return false;
            } else {
                $('#firstname_err').html('')
                return true;
            }
        }

        function checklastname() {
            var lastname = $('#lastname').val();
            if (lastname == '') {
                $('#lastname_err').html('Vui lòng nhập tên của bạn');
                return false;
            } else if (lastname.length < 2 || lastname.length > 100) {
                $('#lastname_err').html('Độ dài của tên là từ 2 -> 100 kí tự');
                return false;
            } else {
                $('#lastname_err').html('')
                return true;
            }
        }

        function checkemail() {
            var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var email = $('#email').val();
            var validemail = pattern1.test(email);
            if (email == "") {
                $('#email_err').html('Tài khoản email là bắt buộc');
                return false;
            } else if (!validemail) {
                $('#email_err').html('Tài khoản email không đúng định dạng');
                return false;
            } else {
                $('#email_err').html('');
                return true;
            }
        }

        function checkphone() {
            if (!$.isNumeric($("#phone").val())) {
                $("#phone_err").html("Số điện thoại chỉ chứa số");
                return false;
            } else if ($("#phone").val().length != 10) {
                $("#phone_err").html("Số điện thoại bắt buộc 10 số");
                return false;
            } else {
                $("#phone_err").html("");
                return true;
            }
        }

        function checkpassword() {
            console.log("sass");
            var pattern2 = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
            var pass = $('#password').val();
            var validpass = pattern2.test(pass);

            if (pass == "") {
                $('#password_err').html('Mật khẩu là bắt buộc');
                return false;
            } else if (!validpass) {
                $('#password_err').html('Tối đa từ 5 tới 15 kí tự, bao gồm chữ thường, chữ in hoa, số và các kí tự đặt biệt');
                return false;

            } else {
                $('#password_err').html("");
                return true;
            }
        }

    });
</script>