<?php
    $action = 'users';
    if(isset($_GET['act'])) {
        $action = $_GET['act'];
    }

    switch ($action) {
        
        case 'insert':
            if($_SESSION['roll'] == 'admin') {
                include 'View/editUsers.php';
            } else {
                echo '<script>alert("vui lòng đăng nhập bằng tài khoản admin")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=profile"/>';
            }
            break;
        case 'insert_action': 
            if ($_SESSION['roll'] == 'admin') {   
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $user_firstname = htmlspecialchars(trim($_POST['user_firstname']));
                    $user_lastname = htmlspecialchars(trim($_POST['user_lastname']));
                    $user_render = htmlspecialchars(trim($_POST['user_render']));
                    $user_birthday = htmlspecialchars(trim($_POST['user_birthday']));
                    $user_phone = htmlspecialchars(trim($_POST['user_phone']));
                    $user_email = htmlspecialchars(trim($_POST['user_email']));
                    $user_password = htmlspecialchars(trim($_POST['user_password']));
                    $user_number_home = htmlspecialchars(trim($_POST['diachi']));
                    $code_address = htmlspecialchars(trim($_POST['xa']));
                    $user_status = 1   ;
                    $user_roll = ($_POST['user_roll'] != "") ? $_POST['user_roll'] : 'user';
                    $user_image = ($_FILES['file']['name'] != "") ? $_FILES['file']['name'] : '';
                    $user_image ="";
                    if(empty($user_firstname) || empty($user_lastname) || empty($user_email) || empty($user_phone) || empty($user_password)){
                        echo '<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin</div>';
                    } else {
                        
                            // $address = new Address();
                            // $result = $address->getDetailAddress($code_address);
                            // $user_address = $result['address'];
                            $user = new User();
                            $count = $user -> checkDuplicate($user_email, $user_phone);
                            if($count['count'] == 0) {
                                $user->insertUsers($user_firstname, $user_lastname, $user_render, $user_birthday, $user_phone, $user_email, $user_password, $code_address, $user_image, $user_status, $user_roll, $user_number_home);
                                echo '<script>alert("Thêm người dùng thành công!")</script>';
                                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=users"/>';
                            } else {
                                // echo '<div class="alert alert-warning">Số điện thoại hoặc tài khoản email bị trùng lặp</div>';
                                echo '<script>alert("Số điện thoại hoặc tài khoản email bị trùng lặp!")</script>';
                                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=users&act=insert"/>';
                                
                            }
                        
                        
                    }
                    // $code_address = $_POST['tinh'].';'.$_POST['thanhpho'].';'.$_POST['xa'];
                }   
            } else {
                echo '<script>alert("Vui lòng truy cập bằng tài khoản admin")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=profile"/>';
            }
            break;
        
        case 'update_action':
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $user_id = $_POST['user_id'];
                $user_firstname = htmlspecialchars(trim($_POST['user_firstname']));
                $user_lastname = htmlspecialchars(trim($_POST['user_lastname']));
                $user_render = htmlspecialchars(trim($_POST['user_render']));
                $user_birthday = htmlspecialchars(trim($_POST['user_birthday']));
                $user_phone = htmlspecialchars(trim($_POST['user_phone']));
                $user_email = htmlspecialchars(trim($_POST['user_email']));
                $user_password = htmlspecialchars(trim($_POST['user_password']));
                $user_number_home = htmlspecialchars(trim($_POST['diachi']));
                $code_address = htmlspecialchars(trim($_POST['xa']));
                $user_status = $_POST['user_status'];
                $user = new User();
                $user -> updateUser($user_id, $user_firstname, $user_lastname, $user_render, $user_birthday, $user_phone, $user_email, $user_password, $ward_code, $user_image, $user_status, $user_roll, $user_number_home);
                echo '<script>alert("Cập nhật thành công")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=users"/>';
            }
            break;
        case 'edit':
            if ($_SESSION['roll'] == 'admin') {
                include 'View/editUsers.php';
            } else {
                echo '<script>alert("Vui lòng truy cập bằng tài khoản admin")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=profile"/>';
            }
            
            break;
        case 'delete':
            if ($_SESSION['roll'] == 'admin') {
                if (isset($_GET['user_id'])) {
                    $user_id = $_GET['user_id'];
                    $user = new User();
                    $user->deleteUser($user_id);
                    if($user) {
                        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=users"/>';
                        echo '<script>alert("Xóa thành công")</script>!';
                    }
                } else {
                    echo '<script>alert("Xoá thất bại, vui lòng xóa lại")</script>';
                }
            } else {
                echo '<script>alert("Vui lòng truy cập bằng tài khoản admin")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=profile"/>';
            }
            break;
        case 'restore' :
            if ($_SESSION['roll'] == 'admin') {
                include 'View/restoreUser.php';
            } else {
                echo '<script>alert("Vui lòng truy cập bằng tài khoản admin")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=profile"/>';
            }
            
            break;
        case 'restore_action':
            if ($_SESSION['roll'] == 'admin') {
                $user_id = $_GET['id'];
                $user = new User();
                $user -> restoreUser($user_id);
                if($user) {
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=users"/>';
                    echo '<script>alert("Khôi phục thành công")</script>!';
                } else {
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=users"/>';
                    echo '<script>alert("Xóa thành công")</script>!';
                }
            } else {
                echo '<script>alert("Vui lòng truy cập bằng tài khoản admin")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=profile"/>';
            }
            break;
        case 'delete_confirm':
            if ($_SESSION['roll'] == 'admin') {
                $user_id = $_GET['id'];
                $user = new User();
                $user -> deleteConfirmUser($user_id);
                if($user) {
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=users"/>';
                    echo '<script>alert("Xóa người dùng thành công")</script>!';
                } else {
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=users"/>';
                    echo '<script>alert("Xóa người dùng không thành công")</script>!';
                }
            } else {
                echo '<script>alert("Vui lòng truy cập bằng tài khoản admin")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=profile"/>';
            }
            
            break;
        default:
            if ($_SESSION['roll'] == 'admin') {
                include 'View/user.php';
            } else {
                echo '<script>alert("Vui lòng truy cập bằng tài khoản admin")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=profile"/>';
            }
            break;
    }
