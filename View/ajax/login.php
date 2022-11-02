<?php
include '../../Model/connect.php';
include '../../Model/customer.php';
session_start();
$customer_username = htmlspecialchars(trim($_POST['customer_username']));
$customer_pass = htmlspecialchars(trim($_POST['customer_password']));


if (empty($customer_username) || empty($customer_pass)) {
    echo '<div class="alert alert-success">Vui lòng nhập đầy đủ thông tin</div>';
} else {
    $customer = new Customer();
    $result = $customer->loginCustomer($customer_username, $customer_pass);
    if ($result) {
        $_SESSION['customer_id'] = $result['customer_id'];
        $_SESSION['customer_firstname'] = $result['customer_firstname'];
        $_SESSION['customer_lastname'] = $result['customer_lastname'];
        echo $_SESSION['customer_id'];
        echo '<script>alert("Đăng nhập thành công")</script>';
        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=home"/>';
    } else {
        echo '<script>alert("Sai thông tin đăng nhập")</script>';
    }
}

