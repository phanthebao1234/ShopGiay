<?php
$act = '';
$title = '';
if (isset($_GET['act'])) {
    $act = $_GET['act'];
    if ($act == 'insert') {
        $title = 'Thêm người dùng mới';
    } else if ($act == 'edit') {
        $title = 'Cập nhật người dùng';
        if (isset($_GET['id'])) {
            $user_id = $_GET['id'];
            $user = new User();
            $result = $user->getUser($user_id);
            $user_firstname = $result['user_firstname'];
            $user_lastname = $result['user_lastname'];
            $user_render = $result['user_render'];
            $user_birthday = $result['user_birthday'];
            $user_phone = $result['user_phonenumber'];
            $user_email = $result['user_email'];
            $user_password = $result['user_password'];
            $user_address = $result['user_address'];
            $user_number_home = $result['user_number_home'];
            $user_status = $result['user_status'];
            $user_roll = $result['user_roll'];
        }
    } else {
        echo 'Không tìm thấy id !';
    }
} else {
    echo 'Không tìm thấy trang !';
}


?>

<a class="btn btn-primary" href="index.php?action=users">Hủy</a>
<div class="container">
    <h1 class="text-center text-primary text-capitalize">
        <?php if (strlen($title) > 0) echo $title; ?>
    </h1>
    <div id="message"></div>
    <?php
    // if ($act == 'insert') {
    //     echo '<form action="index.php?action=users&act=insert_action" method="POST" enctype="multiple/form-data">';
    // } else if ($act == 'edit') {
    //     echo '<form action="index.php?action=users&act=update_action" method="POST" enctype="multiple/form-data">';
    // }
    ?>
    <form id="form" method="POST" enctype="multipart/form-data">
        <div class="row">
            <input type="hidden" name="user_status" value="<?php if(isset($user_id)) echo $user_status ?>">
            <input type="hidden" class="form-control" name="user_id" value="<?php if (isset($user_id)) echo $user_id ?>">
            <input type="hidden" name="user_roll" value="<?php if (isset($user_id)) echo $user_roll ?>">
            <div class="col-md-3">
                <label for="phone" class="form-label">First Name</label>
                <input type="text" class="form-control" name="user_firstname" id="user_firstname" value="<?php if (isset($user_id)) echo $user_firstname ?>">
                <span id="user_firstname_err" class="text-danger"></span>
            </div>
            <div class="col-md-7">
                <label for="phone" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="user_lastname" id="user_lastname" value="<?php if (isset($user_id)) echo $user_lastname ?>">
                <span id="user_lastname_err" class="text-danger"></span>
            </div>
            <div class="col-md-3 mt-4">
                <select class="" name="user_render" id="render">
                    <option selected disabled>Select Render:</option>
                    <option <?php isset($user_id) ? ($user_render == 1 ? 'selected' : '') : '';?> value="1">Nam</option>
                    <option <?php isset($user_id) ? ($user_render == 0 ? 'selected' : '') : '';?> value="0">Nữ</option>
                </select>
            </div>
            <div class="col-md-2 mt-4">
                <select class="" name="user_roll" id="roll">
                    <option selected disabled>Select Roll:</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="user_phone" name="user_phone" value="<?php if (isset($user_id)) echo $user_phone ?>">
                <span id="user_phone_err" class="text-danger"></span>
            </div>
            <div class="col-md-3">
                <label for="phone" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" name="user_birthday" value="<?php if (isset($user_id)) echo $user_birthday ?>">
                <span id="user__err"></span>
            </div>

            <div class="col-md-6">
                <label for="phone" class="form-label">Email</label>
                <input type="email" disabled class="form-control" id="user_email" name="user_email"  value="<?php if (isset($user_id)) echo $user_email ?> ">
                <span id="user_email_err" class="text-danger"></span>
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Password</label>
                <input type="text" class="form-control" id="user_password" name="user_password" value="<?php if (isset($user_id)) echo $user_password ?>">
                <span id="user_password_err" class="text-danger"></span>
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
                <select class="form-select" id="city-dropdown" name="xa"></select>
            </div>
            <div class="col-md-6">
                <label for="" class="form-label"><strong>Địa chỉ nhà: </strong><span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="diachi" id="diachi" value="<?php if(isset($user_id)) echo $user_number_home ?>">
                <span id="user_diachi_err"></span>
            </div>

            <div class="col-md-6">
                <label for="" class="form-label">Image</label>
                <img src="../../Content/images/<?php if (isset($user_id)) echo $user_image ?>" alt="">
                <!-- <input type="file" class="form-control" name="image"> -->
                <input class="form-control form-control-lg uploadimg" id="image" name="file" type="file" onchange="readURL(this);">
            </div>
            <div class="col-md-12 my-3">
                <?php 
                    if($act == 'insert') {
                        echo '<button class="btn btn-primary btn-lg float-end" type="button" id="submit_create">Thêm mới người dùng</button>';
                    } else if ($act == 'edit') {  
                        echo '<button class="btn btn-primary btn-lg float-end" type="button" id="submit_update">Cập nhật người dùng</button>';
                    }
                ?>
            </div>
        </div>
    </form>
</div>


<script>
    $(document).ready(function() {

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
        $('#country-dropdown').on('change', function() {
            var province_id = this.value;
            $.ajax({
                url: "View/ajax/districts.php",
                type: "POST",
                data: {
                    province_id: province_id
                },
                cache: false,
                success: function(result){
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
                success: function(result){
                    $("#city-dropdown").html(result);
                }
            });
        });

        $('#user_firstname').on('input', function() {
            checkfirstname();
        })

        $('#user_lastname').on('input', function() {
            checklastname();
        })

        $('#user_phone').on('input', function() {
            checkphone();
        })

        $('#user_email').on('input', function() {
            checkemail();
        })

        $('#user_password').on('input', function() {
            checkpassword();
        })

        $('#submit_create').click(function() {
            if(!checkfirstname() && !checklastname() && !checkemail() && !checkphone() && !checkpassword()) {
                console.log('err1');
                $('#message').html('<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin sản phẩm</div>');
            } else if (!checkfirstname() || !checklastname() || !checkemail() || !checkphone() || !checkpassword()) { 
                console.log('err2');
                $('#message').html('<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin sản phẩm</div>');
            } else {
                console.log('ok');
                $('#message').html('');
                var form = $('#form')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "index.php?action=users&act=insert_action",
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
            if(!checkfirstname() && !checklastname() && !checkemail() && !checkphone() && !checkpassword()) {
                console.log('err1');
                $('#message').html('<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin sản phẩm</div>');
            } else if (!checkfirstname() || !checklastname() || !checkemail() || !checkphone() || !checkpassword()) { 
                console.log('err2');
                $('#message').html('<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin sản phẩm</div>');
            } else {
                console.log('ok');
                $('#message').html('');
                var form = $('#form')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "index.php?action=users&act=update_action",
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

        // Hàm validation rules
        function checkfirstname() {
            var user = $('#user_firstname').val();
            if (user == "") {
                $('#user_firstname_err').html('Họ và Tên đệm không được để trống');
                return false;
            } else if (user.length > 100) {
                $('#user_firstname_err').html('Họ và Tên đệm nhỏ hơn 100 kí tự');
                return false;
            } else {
                $('#user_firstname_err').html('');
                return true;
            }
        }

        function checklastname() {
            var user = $('#user_lastname').val();
            if (user == "" || user.lenght  <=2 ) {
                $('#user_lastname_err').html('Tên phải có nhiều hơn 2 kí tự');
                return false;
            } else if (user.length > 100) {
                $('#user_lastname_err').html('Tên nhỏ hơn 100 kí tự');
                return false;
            } else {
                $('#user_lastname_err').html('');
                return true;
            }
        }

        function checkemail() {
            console.log('hello ');
            var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var email = $('#user_email').val();
            var validemail = pattern1.test(email);
            if (email == "") {
                $('#user_email_err').html('Tài khoản email là bắt buộc');
                return false;
            } else if (!validemail) {
                $('#user_email_err').html('Tài khoản email không đúng định dạng');
                return false;
            } else {
                $('#user_email_err').html('');
                return true;
            }
        }

        function checkpassword() {
            console.log("sass");
            var pattern2 = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
            var pass = $('#user_password').val();
            var validpass = pattern2.test(pass);

            if (pass == "") {
                $('#user_password_err').html('Mật khẩu là bắt buộc');
                return false;
            } else if (!validpass) {
                $('#user_password_err').html('Tối đa từ 5 tới 15 kí tự, bao gồm chữ thường, chữ in hoa, số và các kí tự đặt biệt');
                return false;

            } else {
                $('#user_password_err').html("");
                return true;
            }
        }

        function checkphone() {
            if (!$.isNumeric($("#user_phone").val())) {
                $("#user_phone_err").html("Số điện thoại chỉ chứa số");
                return false;
            } else if ($("#user_phone").val().length != 10) {
                $("#user_phone_err").html("Số điện thoại bắt buộc 10 số");
                return false;
            } else {
                $("#user_phone_err").html("");
                return true;
            }
        }
    });

        
    
</script>