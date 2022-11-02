<?php
    include '../../Model/connect.php';
    include '../../Model/user.php';

    $user_id = htmlspecialchars(trim($_POST['id']));
    $user_roll = htmlspecialchars(trim($_POST['roll']));
    $user_firstname = htmlspecialchars(trim($_POST['firstname']));
    $user_lastname = htmlspecialchars(trim($_POST['lastname']));
    $user_birthday = htmlspecialchars(trim($_POST['birth']));
    $user_render = htmlspecialchars(trim($_POST['render']));
    $user_email = htmlspecialchars(trim($_POST['email']));
    $user_phone = htmlspecialchars(trim($_POST['phone']));
    $user_password = htmlspecialchars(trim($_POST['password']));
    $user_address = htmlspecialchars(trim($_POST['address']));
    $user_number_home = htmlspecialchars(trim($_POST['diachi']));
    $user_image = isset($_POST['image']) ? htmlspecialchars(trim($_POST['image'])) : '';

    if (empty($user_firstname) || empty($user_lastname) || empty($user_email) || empty($user_phone) || empty($user_password)) {
        echo '<script>console.log("err3")</script>';
        echo '<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin</div>';
    } else {
        $user = new User();
        $user -> updateUser($user_id, $user_firstname, $user_lastname, $user_render, $user_birthday, $user_phone, $user_email, $user_password, $user_address, $user_image, "", $user_roll, $user_number_home);
        if(isset($user)) {
            echo '<script>alert("Cập nhật hồ sơ thành công")</script>';
            echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=profile"/>';
        }
    }
?>