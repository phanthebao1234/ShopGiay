<?php
    include '../../Model/connect.php';
    include '../../Model/voucher.php';

    $voucher_id = htmlspecialchars(trim($_POST['voucher_id']));
    $voucher_name = htmlspecialchars(trim($_POST['voucher_name']));
    $voucher_code = htmlspecialchars(trim($_POST['voucher_code']));
    $voucher_sale = htmlspecialchars(trim($_POST['voucher_sale']));
    $voucher_type = htmlspecialchars(trim($_POST['voucher_type']));
    $voucher_count = htmlspecialchars(trim($_POST['voucher_count']));
    $voucher_start = htmlspecialchars(trim($_POST['voucher_start']));
    $voucher_end = htmlspecialchars(trim($_POST['voucher_end']));
    $voucher_status = htmlspecialchars(trim($_POST['voucher_status']));
    $voucher_type = htmlspecialchars(trim($_POST['voucher_type']));

    if(empty($voucher_name) || empty($voucher_code) || empty($voucher_sale) || empty($voucher_count)) {
        echo '<script>console.log("err3")</script>';
        echo '<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin</div>';
    } else {
        $voucher = new Voucher();
        $count_voucher_code = $voucher -> checkDuplicateVoucherCode($voucher_code);
        if ($count_voucher_code['count'] > 0) {
            echo '<script>alert("Mã voucher đã tồn tại")</script>';
            echo '<meta http-equiv="refresh" content="0;url=./index.php?action=voucher&act=insert"/>';
        } else {
            $voucher -> insertVoucher($voucher_code, $voucher_name, $voucher_start, $voucher_end, $voucher_sale, $voucher_type, $voucher_count, $voucher_status);
            echo '<script>alert("Thêm voucher thành công")</script>';
            echo '<meta http-equiv="refresh" content="0;url=./index.php?action=voucher"/>';
        }
    }
?>