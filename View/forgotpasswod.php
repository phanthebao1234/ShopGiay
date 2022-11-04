<div class="container border border-1 border-danger shadow-lg p-3 mb-5 bg-body rounded my-5">
    <h1 class="text-danger fw-bold text-capitalize text-center">Quên mật khẩu</h1>
    <div class="mesage"></div>
    <form action="" class="row g-3 my-4" id="myform">
        <div class="mb-3">
            <label for="customer_username" class="form-label">Nhập tên tài khoản Email cần khôi phục</label>
            <input type="text" class="form-control" id="customer_username" name="customer_username">
            <span id="customer_username_err" class="text-danger"></span>
        </div>
        <div class="col-12">
            <button type="button" id="submitbtn" class="btn btn-primary text-capitalize" name="submit">Xác nhận</button>
            <p class="fst-italic mt-3">
                <a href="index.php?action=auth&act=login">Đã có tài khoản</a> |
                <a href="index.php?action=auth&act=resgister">Tạo tài khoản</a>
            </p>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#customer_username').on('input', function() {
            checkusername();
        })
        function checkusername() {
            // var emailVal = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var username = $('#customer_username').val(); 
            // var validemail = emailVal.test(username);
            if(username == ""){
                $('#customer_username_err').html('Vui lòng nhập tên tài khoản');
                return false;
            } else {
                $('#customer_username_err').html("");
                return true;
            }  
        }
        $('#submitbtn').click(function() {
            if(!checkusername()) {
                console.log("err1");
                $("#message").html('<div class="alert alert-warning">Vui lòng điền đủ thông tin</div>');
            } else if(!checkusername()) {
                console.log("err2");
                $("#message").html('<div class="alert alert-warning">Vui lòng điền đủ thông tin</div>');
            } else {
                console.log("ok");
                $("#message").html("");
                var form = $('#myform')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    // beforeSend: function() {
                    //     $('#submitbtn').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                    //     $('#submitbtn').attr("disabled", true);
                    //     $('#submitbtn').css({
                    //         "border-radius": "50%"
                    //     });
                    // },

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
    })
</script>