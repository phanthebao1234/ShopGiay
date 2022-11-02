<div class="">
    <div class="container" style="width: 100%;
    height: 700px;
    display: flex;
    justify-content: center;
    align-items: center;">
        <div class="">
            <h2 class="text-center text-danger fw-bold text-capitalize">Đăng nhập với vai trò quản trị viên</h2>
            <div id="message"></div>
            <form id="form" action="#" method="POST" class="my-3">
                <div class="mb-3">
                    <label for="user_username" class="form-label">Email address or Phone Number</label>
                    <input type="text" class="form-control" id="user_username" name="user_username">
                    <div id="user_username_err" class="text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="user_password" name="user_password">
                    <div id="user_password_err" class="text-danger"></div>
                </div>
                <button type="button" id="submitbtn" class="btn btn-primary btn-lg">Login</button>
            </form>
            <a class="text-underline text-decoration-underline" href="index.php?action=auth&act=reset">Quên mật khẩu</a>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#user_username').on('input', function() {
            checkusername();
        })
        $('#user_password').on('input', function() {
            checkpassword();
        })
        $('#submitbtn').click(function() {
            if (!checkusername() && !checkpassword()) {
                console.log("er1");
                $("#message").html(`<div class="alert alert-warning">Vui lòng điền đầy đủ thông tin</div>`);
            } else if (!checkusername() || !checkpassword()) {
                $("#message").html(`<div class="alert alert-warning">Vui lòng điền đầy đủ thông tin</div>`);
                console.log("er");
            } else {
                console.log("ok");
                $("#message").html("");
                var form = $('#form')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "View/ajax/login.php",
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
                });
            }
        });

        // Hàm kiểm tra username
        function checkusername() {
            var username = $('#user_username').val();
            if (username == "") {
                $('#user_username_err').html('Vui lòng nhập tên tài khoản');
                return false;
            } else {
                $('#user_username_err').html('');
                return true;
            }
        }

        // Hàm kiểm tra mật khẩu
        function checkpassword() {
            var password = $('#user_password').val();
            if (password == "") {
                $('#user_password_err').html('Vui lòng nhập mật khẩu');
                return false;
            } else {
                $('#user_password_err').html('');
                return true;
            }
        }
    })
</script>