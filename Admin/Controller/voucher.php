<?php
    $action = 'voucher';
    if(isset($_GET['act'])) {
        $action = $_GET['act'];
    }

    switch ($action) {
        case 'insert':
            include 'View/editVoucher.php';
            break;
        case 'insert_action':
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $voucher_code = $_POST['voucher_code'];
                $voucher_name = $_POST['voucher_name'];
                $voucher_start = $_POST['voucher_start'];
                $voucher_end = $_POST['voucher_end'];
                $voucher_sale = $_POST['voucher_sale'];
                $voucher_count = $_POST['voucher_count'];
                $voucher_status = $_POST['voucher_status'];
                $voucher = new Voucher();
                $count_voucher_code = $voucher -> checkDuplicateVoucherCode($voucher_code);
                if ($count_voucher_code['count'] > 0) {
                    echo '<script>alert("Mã voucher đã tồn tại")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=voucher&act=insert"/>';
                } else {
                    $voucher -> insertVoucher($voucher_code, $voucher_name, $voucher_start, $voucher_end, $voucher_sale, $voucher_count, $voucher_status);
                    if(isset($voucher) == true) {
                        echo "<script>alert('Thêm thành công')</script>";
                        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=voucher"/>';
                    } else {
                        echo "<script>alert('Thêm thất bại')</script>";
                        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=voucher&act=insert"/>';
                    }
                }
                
            }
            break;
        case 'update':
            include 'View/editVoucher.php';
            break;
        case 'update_action':
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $voucher_id = $_POST['voucher_id'];
                $voucher_code = $_POST['voucher_code'];
                $voucher_name = $_POST['voucher_name'];
                $voucher_start = $_POST['voucher_start'];
                $voucher_end = $_POST['voucher_end'];
                $voucher_sale = $_POST['voucher_sale'];
                $voucher_count = $_POST['voucher_count'];
                $voucher_status = $_POST['voucher_status'];
                $voucher_type = $_POST['voucher_type'];
                $voucher = new Voucher();
                $voucher -> updateVoucher($voucher_id, $voucher_code, $voucher_name, $voucher_start, $voucher_end, $voucher_sale,$voucher_type, $voucher_count, $voucher_status);
                if(isset($voucher)) {
                    echo "<script>alert('Cập nhật thành công')</script>";
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=voucher"/>';
                }
            }
            break;
        case 'delete':
            if(isset($_GET['id'])) {
                $voucher_id = $_GET['id'];
                $voucher = new Voucher();
                $voucher->deleteVoucher($voucher_id);
                if(isset($voucher) == true) {
                    echo "<script>alert('Voucher đã được chuyển vào thùng rác thành công')</script>";
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=voucher"/>';
                }
            }
            break;
        case 'restore':
            include 'View/restoreVoucher.php';
            break;
        case 'restore_action':
            if(isset($_GET['id'])) {
                $voucher_id = $_GET['id'];
                $voucher = new Voucher();
                $voucher->restoreVoucher($voucher_id);
                if(isset($voucher)) {
                    echo "<script>alert('Khôi phục thành công')</script>";
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=voucher&act=restore"/>';
                }
            }
            break;
        case 'delete_permanently':
            if (isset($_GET['id'])) {
                $voucher = new Voucher();
                $voucher_id = $_GET['id'];
                $voucher -> deleteVoucherPermanently($voucher_id);
                if(isset($voucher_id)) {
                    echo '<script>alert("Xóa thành công")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=voucher&act=restore"/>';
                } else {
                    echo '<script>alert("Xóa không thành công")</script>';
                }
            }
            break;
        case 'export':
            include 'View/exportVoucher.php';
            // echo '<meta http-equiv="refresh" content="0;url=./index.php?action=voucher"/>';
            break;
        default:
            include 'View/voucher.php';
            break;
    }
?>