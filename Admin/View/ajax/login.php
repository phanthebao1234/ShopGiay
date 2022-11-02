<?php
include '../../Model/connect.php';
include '../../Model/user.php';
session_start();
$user_username = htmlspecialchars(trim($_POST['user_username']));
$user_password = htmlspecialchars(trim($_POST['user_password']));


if (empty($user_username) || empty($user_password)) {
    echo '<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin</div>';
} else {
    $user = new User();
    $result = $user->loginUser($user_username, $user_password, $user_username);
    if (is_array($result)) {
        $_SESSION['id'] = $result['user_id'];
        $_SESSION['firstname'] = $result['user_firstname'];
        $_SESSION['lastname'] = $result['user_lastname'];
        $_SESSION['email'] = $result['user_email'];
        $_SESSION['phone'] = $result['user_phonenumber'];
        $_SESSION['render'] = $result['user_render'];
        $_SESSION['birthday'] = $result['user_birthday'];
        $_SESSION['status'] = $result['user_status'];
        $_SESSION['roll'] = $result['user_roll'];
        $_SESSION['address'] = $result['user_address'];
        $_SESSION['user_number_home'] = $result['user_number_home'];
        $_SESSION['password'] = $result['user_password'];
        echo '<script>alert("Đăng nhập thành công")</script>';
        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=profile"/>';
    } else {
        echo '<script>alert("Sai thông tin đăng nhập")</script>';
    }
}

