<?php
$act = '';
$title = '';
if (isset($_GET['act'])) {
    $act = $_GET['act'];
    if ($act == 'insert') {
        $title = 'Thêm Voucher';
    } else if ($act == 'update') {
        $title = 'Cập nhật Voucher';
        if (isset($_GET['id'])) {
            $voucher_id = $_GET['id'];
            echo $voucher_id;
            $voucher = new Voucher();
            $result = $voucher->getDetailVoucher($voucher_id);
            $voucher_code = $result['voucher_code'];
            $voucher_name = $result['voucher_name'];
            $voucher_start = $result['voucher_start'];
            $voucher_end = $result['voucher_end'];
            $voucher_sale = $result['voucher_sale'];
            $voucher_count = $result['voucher_count'];
        }
    } else {
        $title = 'Không tìm thấy trang';
    }
}
?>

<a class="btn btn-primary" href="index.php?action=voucher">Hủy</a>
<div class="container">
    <h1 class="text-center text-primary text-capitalize">
        <?php echo $title; ?>
    </h1>
    <div id="message"></div>
    <?php
    if ($act == 'insert') {
        echo '<form id="form" method="POST" action="#" >';
    } else if ($act == 'update') {
        echo '<form id="form" method="POST" action="#">';
    } else {
        echo '<form>';
    }
    ?>
    <form>
        <div class="row">
            <input type="hidden" name="voucher_id" value="<?php if (isset($voucher_id)) echo $voucher_id; ?>">
            <div class="col-md-3">
                <label for="voucher_code" class="form-label">Voucher Code</label>
                <input type="text" class="form-control" id="voucher_code" name="voucher_code" value="<?php if (isset($voucher_id)) echo $voucher_code ?>">
                <span id="voucher_code_err" class="text-danger"></span>
            </div>
            <div class="col-md-9">
                <label for="voucher_name" class="form-label">Voucher Name</label>
                <input type="text" class="form-control" id="voucher_name" name="voucher_name" value="<?php if (isset($voucher_id)) echo $voucher_name ?>">
                <span id="voucher_name_err" class="text-danger"></span>
            </div>
            <div class="col-md-3">
                <label for="voucher_start" class="form-label">Voucher Start Date</label>
                <input type="date" class="form-control" name="voucher_start" value="<?php if (isset($voucher_id)) echo $voucher_start ?>">
            </div>
            <div class="col-md-3">
                <label for="voucher_end" class="form-label">Voucher End Date</label>
                <input type="date" class="form-control" name="voucher_end" value="<?php if (isset($voucher_id)) echo $voucher_end ?>">
            </div>
            <div class="col-md-3">
                <label for="voucher_sale" class="form-label">Voucher Sale (<span id="type"></span>)</label>
                <input type="number" step="0.1" class="form-control" id="voucher_sale" name="voucher_sale" value="<?php if (isset($voucher_id)) echo $voucher_sale ?>">
                <span id="voucher_sale_err" class="text-danger"></span>
            </div>
            <div class="col-md-3">
                <label for="voucher_count" class="form-label">Voucher Count</label>
                <input type="number" class="form-control" id="voucher_count" name="voucher_count" value="<?php if (isset($voucher_id)) echo $voucher_count ?>">
                <span id="voucher_count_err" class="text-danger"></span>
            </div>
            <div class="col-md-3">
                <label for="voucher_status" class="form-label">Voucher Status</label>
                <select class="form-select" aria-label="Default select example" name="voucher_status">
                    <option value="1" selected>Open this select status</option>
                    <option value="1">Active</option>
                    <option value="0">No Active</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="voucher_type" class="form-label">Voucher Type</label>
                <select class="form-select" aria-label="Default select example" id="voucher_type" name="voucher_type">
                    <option value="phantram" selected>Open this select status</option>
                    <option value="phantram">Phần Trăm(%)</option>
                    <option value="tien">Tiền(vnđ)</option>
                </select>
            </div>
            <div class="col-md-12 d-flex justify-content-center my-3">
                <?php
                if ($act == 'insert') {
                    echo '<button id="submit_create" type="button" class="btn btn-primary">Thêm voucher</button>';
                } else if ($act == 'update') {
                    echo '<button id="submit_update" type="button" class="btn btn-primary">Cập nhật voucher</button>';
                }
                ?>
            </div>
        </div>

    </form>
</div>

<script>
    $('document').ready(function() {
        var type = 'phantram';

        $('#voucher_type').change(function() {
            type = $('#voucher_type').val();
            if (type == 'phantram') {
                var voucher_type = '%';
            } else {
                var voucher_type = 'vnđ'
            }
            $('#type').html(`${voucher_type}`)
        })
        $('#voucher_code').on('input', function() {
            check_voucher_code();
        })

        $('#voucher_name').on('input', function() {
            check_voucher_name();
        })

        $('#voucher_sale').on('input', function() {
            check_voucher_sale();
        })

        $('#voucher_count').on('input', function() {
            check_voucher_count();
        })

        $('#submit_create').click(function() {
            if (!check_voucher_name() && !check_voucher_code() && !check_voucher_sale() && !check_voucher_count()) {
                $('#message').html('<div class="alert alert-warning">Vui lòng nhập đầy đủ</div>');
            } else if (!check_voucher_name() || !check_voucher_code() || !check_voucher_sale() || !check_voucher_count()) {
                $('#message').html('<div class="alert alert-warning">Vui lòng nhập đẩy đủ</div>')
            } else {
                $('#message').html();
                var form = $('#form')[0]
                var data = new FormData(form);
                $.ajax({
                    type: 'POST',
                    url: 'index.php?action=voucher&act=voucher&act=insert_action',
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

        $('#submit_update').click(function() {
            if (!check_voucher_name() && !check_voucher_code() && !check_voucher_sale() && !check_voucher_count()) {
                $('#message').html('<div class="alert alert-warning">Vui lòng nhập đầy đủ</div>');
            } else if (!check_voucher_name() || !check_voucher_code() || !check_voucher_sale() || !check_voucher_count()) {
                $('#message').html('<div class="alert alert-warning">Vui lòng nhập đẩy đủ</div>')
            } else {
                $('#message').html();
                var form = $('#form')[0]
                var data = new FormData(form);
                $.ajax({
                    type: 'POST',
                    url: 'index.php?action=voucher&act=update_action',
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

        function check_voucher_code() {
            var pattern = /^[A-Za-z0-9]+$/;
            var voucher_code = $('#voucher_code').val();
            var voucherCodeValid = pattern.test(voucher_code);
            if (voucher_code == "") {
                $('#voucher_code_err').html('Vui lòng nhập mã voucher');
                return false;
            } else if (!voucherCodeValid) {
                $('#voucher_code_err').html('Code không đúng định dạng')
                return false;
            } else {
                $('#voucher_code_err').html('')
                return true;
            }
        }

        function check_voucher_name() {
            var voucher_name = $('#voucher_name').val();
            var pattern = /^\S/;
            var voucherNameValid = pattern.test(voucher_name);
            if (voucher_name == '') {
                $('#voucher_name_err').html('Vui lòng nhập tên voucher');
                return false;
            } else if (!voucherNameValid) {
                $('#voucher_name_err').html('Tên Voucher không đúng định dạng');
                return false;
            } else {
                $('#voucher_name_err').html('')
                return true;
            }
        }

        function check_voucher_sale() {
            var voucher_type = $('#voucher_type').val();
            var voucher_sale = $('#voucher_sale').val();
            var regexPattern = /^-?[0-9]+$/;
            var voucherSaleValid = regexPattern.test(voucher_sale);
            if (voucher_type == 'phantram') {
                if (voucher_sale == "") {
                    $('#voucher_sale_err').html('Vui lòng nhập phần trăm giảm')
                    return false;
                } else if (voucher_sale > 100) {
                    $('#voucher_sale_err').html('Voucher sale lớn quá mức quy định')
                    return false;
                } else {
                    $('#voucher_sale_err').html('');
                    return true;
                }
            } else if (voucher_type == 'tien') {
                if (voucher_sale == "") {
                    $('#voucher_sale_err').html('Vui lòng nhập giá tiền giảm')
                    return false;
                } else if (!voucherSaleValid) {
                    $('#voucher_sale_err').html('Voucher sale không đúng định dạng')
                    return false;

                } else {
                    $('#voucher_sale_err').html('');
                    return true;
                }
            }
        }

        function check_voucher_count() {
            var voucher_count = $('#voucher_count').val();
            var regexPattern = /^-?[0-9]+$/;
            var voucherCountValid = regexPattern.test(voucher_count);
            if (voucher_count == "") {
                $('#voucher_count_err').html('Vui lòng nhập số lượng voucher')
                return false;
            } else if (!voucherCountValid) {
                $('#voucher_count_err').html('Số lượng nhập không hợp lệ')
                return false;
            } else {
                $('#voucher_count_err').html('')
                return true;
            }
        }
    })
</script>