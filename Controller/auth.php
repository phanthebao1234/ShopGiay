<?php 
    $action = 'auth';
    if(isset($_GET['act'])) {
        $action = $_GET['act'];
    }

    switch ($action) {
        case 'login':
            if(isset($_SESSION['customer_id'])) {
                echo '<script>alert("Bạn đã đăng nhập rồi")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=home"/>';
            } else {
                include 'View/login.php';
            }
            break;
        case 'login_action':
            if(!isset($_SESSION['customer_id'])) {
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $account_name = $_POST['name'];
                    $account_password = $_POST['password'];
                    $auth = new Customer();
                    $result = $auth->loginCustomer($account_name, $account_password);
                    if($result == true) {
                        $_SESSION['customer_id'] = $result['customer_id'];
                        $_SESSION['customer_firstname'] = $result['customer_firstname'];
                        $_SESSION['customer_lastname'] = $result['customer_lastname'];
                        echo $_SESSION['customer_firstname'];
                        echo '<script>alert("Đăng nhập thành công")</script>';
                        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=home"/>';
                    } else {
                        echo '<script>alert("Sai thông tin đăng nhập")</script>';
                    }
                }
            } else {
                echo '<script>alert("Bạn chưa đăng nhập")</script>';
            }
            break;
        case 'resgister':
            include 'View/resgister.php';
            break;
        // case 'resgister_action':
        //     if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //         if(empty($_POST['customer_firstname'])) {
        //             $nameErr = "Họ và Tên đệm là bắt buộc";
        //         }
        //         $customer_firstname = $_POST['customer_firstname'];
        //         $customer_lastname = $_POST['customer_lastname'];
        //         $customer_render = $_POST['customer_render'];
        //         $customer_birthday = $_POST['customer_birthday'];
        //         $customer_phone = $_POST['customer_phone'];
        //         $customer_email = $_POST['customer_email'];
        //         $customer_password = $_POST['customer_password'];
        //         $customer_address = $_POST['xa'];
        //         $customer_image = $_FILES['customer_image']['name'];
        //         $customer = new Customer();
        //         $count = $customer -> checkDuplicate($customer_email, $customer_phone);
        //         // if($count['count'] > 0) {
        //         //     echo '<script>alert("Số điện thoại hoặc tài khoản email đã tồn tại")</script>';
        //         //     echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=resgister"/>';
        //         // } else {
        //         //     $customer->regristerCustomer($customer_firstname, $customer_lastname, $customer_render, $customer_birthday, $customer_phone, $customer_email, $customer_password, $customer_address, $customer_image);
        //         //     echo '<script>alert("Tạo tài khoản thành công")</script>';
        //         //     echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=login"/>';
        //         // }
        //     }
        //     break;
        case 'update':
            include 'View/update.php';
            break;
        case 'logout_action':
            if (isset($_SESSION['customer_id'])) {
                $_SESSION['customer_id'] = null;
                $_SESSION['firstname'] = null;
                $_SESSION['lastname'] = null;
                // session_destroy();
                echo '<script>alert("Đăng xuất thành công")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=home"/>';
            } else {
                echo '<script>alert("Bạn chưa đăng nhập")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth"/>';
            }
            break;
        default:
            // include 'View/login.php';
            if(isset($_SESSION['customer_id'])) {
                echo '<script>alert("Bạn đã đăng nhập rồi")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=home"/>';
            } else {
                include 'View/login.php';
            }
            break;
    }
    
?>