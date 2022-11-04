<?php 
    $action = 'customer';
    if(isset($_GET['act'])) {
        $action = $_GET['act'];
    }

    switch ($action) {
        case 'update_address':
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $customer_id = $_POST['customer_id'];
                $customer_address = $_POST['customer_address'];
                $customer_phone = $_POST['customer_phone'];
                $customer = new Customer();
                $customer -> updateCustomerAdressPhone($customer_id, $customer_address, $customer_phone);
                if(isset($customer)) {
                    echo "<script>alert('Cập nhật thành công')</script>";
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=order2"/>';
                } else {
                    echo '<script>alert("Cập nhật thất bại")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=order2"/>';
                }
            }
            break;
        case 'update':
            if (isset($_SESSION['customer_id'])) {
                include 'View/updateProfile.php';
            } else {
                echo '<script>alert("Vui lòng đăng nhập vào tài khoản của bạn!")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=login"/>';
            }
        break;
        case 'update_action':
            if (isset($_SESSION['customer_id'])) {
                $customer_id = $_POST['customer_id'];
                $customer_firstname = $_POST['customer_firstname'] ;
                $customer_lastname = $_POST['customer_lastname'] ;
                $customer_render = $_POST['customer_render'] ;
                $customer_birthday = $_POST['customer_birthday'] ;
                $customer_phonenumber = $_POST['customer_phonenumber'];
                $customer_email = $_POST['customer_email'];
                $customer_password = $_POST['customer_password'];
                $customer_address = $_POST['customer_address'] ;
                $customer_code_address = $_POST['customer_code_address'] ;
                $customer_image = $_POST['customer_image'] ;
                $customer = new Customer();
                $customer -> updateCustomer($customer_id, $customer_firstname, $customer_lastname, $customer_render, $customer_birthday, $customer_phonenumber, 
                $customer_email, $customer_password, $customer_address, $customer_image, $customer_code_address);
            } else {
                echo '<script>alert("Vui lòng đăng nhập vào tài khoản của bạn!")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=login"/>';
            }
            echo "<script>alert('Cập nhật thành công')</script>";
            echo '<meta http-equiv="refresh" content="0;url=./index.php?action=customer&act=viewprofile"/>';
            break;
        default:
            include 'View/profile2.php';
            break;
    }
?>