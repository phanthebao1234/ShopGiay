<?php
include '../../Model/connect.php';
include '../../Model/customer.php';

$customer_firstname = htmlspecialchars(trim($_POST['customer_firstname']));
$customer_lastname = htmlspecialchars(trim($_POST['customer_lastname']));
$customer_email = htmlspecialchars(trim($_POST['customer_email']));
$customer_pass = htmlspecialchars(trim($_POST['customer_password']));
$customer_phone = htmlspecialchars(trim($_POST['customer_phone']));
$customer_render = htmlspecialchars(trim($_POST['customer_render']));
$customer_address = htmlspecialchars(trim($_POST['customer_address']));
$customer_birthday = htmlspecialchars(trim($_POST['customer_birthday']));
$customer_number_address = htmlspecialchars(trim($_POST['diachi']));

if (empty($customer_firstname) || empty($customer_lastname) || empty($customer_email) || empty($customer_pass) || empty($customer_phone)) {
    echo '<div class="alert alert-success">Vui lòng nhập đầy đủ thông tin</div>';
} else {
    $customer = new Customer();
    $count = $customer->checkDuplicate($customer_email, $customer_phone);
    if($count['count'] > 0) {
        echo '<script>alert("Số điện thoại hoặc tài khoản email đã tồn tại")</script>';
        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=resgister"/>';
    } else {
        $customer->regristerCustomer($customer_firstname, $customer_lastname, $customer_render, $customer_birthday, $customer_phone, $customer_email, $customer_pass, $customer_address, $customer_image);
        echo '<script>alert("Tạo tài khoản thành công")</script>';
        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=login"/>';
    }
    
}
