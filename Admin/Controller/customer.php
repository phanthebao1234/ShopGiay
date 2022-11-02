<?php
    $action = 'customer';
    if(isset($_GET['act'])) {
        $action = $_GET['act'];
    }

    switch ($action) {
        case 'customer':
            include 'View/customers.php';
            break;
        case 'insert':
            include 'View/editCustomer.php';
            break;
        case 'update':
            include 'View/editCustomer.php';
            break;
        case 'delete':
            if(isset($_GET['customer_id'])) {
                $customer_id = $_GET['customer_id'];
                $customer = new Customers();
                $customer->deleteCustomer($customer_id);
                if(isset($customer)) {
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=customer"/>';
                    echo '<script>alert("Xóa thành công")</script>!';
                }
            }
            else {
                if (isset($customer)) {
                    echo '<script>alert("Xóa không thành công! Vui lòng thực hiện lại")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=customer"/>';
                }
                
            }
            break;
        case 'insert_action':
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $customer_firstname = $_POST['customer_firstname'];
                $customer_lastname = $_POST['customer_lastname'];
                $customer_render = $_POST['customer_render'];
                $customer_birthday = isset($_POST['customer_birthday']) ? $_POST['customer_birthday'] : '';
                $customer_phone = $_POST['customer_phone'];
                $customer_email = $_POST['customer_email'];
                $customer_password = $_POST['customer_password'];
                $customer_code_address = isset($_POST['customer_xa']) ? $_POST['customer_xa'] : "" ;
                $customer_image = isset($_FILES['image1']['name']) ? $_FILES['image1']['name'] : "";
                $customer_address = isset($_POST['customer_diachi']) ? $_POST['customer_diachi'] : "";
                $customer = new Customers();
                $count = $customer->checkDuplicate($customer_email, $customer_phone);
                if($count['count'] > 0) {
                    echo '<script>alert("Số điện thoại hoặc tài khoản email đã tồn tại")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=customer&act=insert"/>';
                } else {
                    $customer->insertCustomers($customer_firstname, $customer_lastname, $customer_render, $customer_birthday, $customer_phone, $customer_email, $customer_password, $customer_address, $customer_code_address, $customer_image);
                    if(isset($customer)) {
                        echo '<script>alert("Thêm khách hàng thành công!")</script>';
                        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=customer"/>';
                    }
                }
                
                
                
            }
            break;
        case 'update_action':
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $customer_id = $_POST['customer_id'];
                $customer_firstname = $_POST['customer_firstname'];
                $customer_lastname = $_POST['customer_lastname'];
                $customer_render = $_POST['customer_render'];
                $customer_birthday = isset($_POST['customer_birthday']) ? $_POST['customer_birthday'] : '';
                $customer_phone = $_POST['customer_phone'];
                $customer_email = $_POST['customer_email'];
                $customer_password = $_POST['customer_password'];
                $customer_code_address = isset($_POST['customer_xa']) ? $_POST['customer_xa'] : "" ;
                $customer_image = isset($_FILES['image1']['name']) ? $_FILES['image1']['name'] : "";
                $customer_address = isset($_POST['customer_diachi']) ? $_POST['customer_diachi'] : "";
                $customer = new Customers();
                $customer->updateCustomer($customer_id, $customer_firstname, $customer_lastname, $customer_render, $customer_birthday, $customer_phone, $customer_email, $customer_password, $customer_address, $customer_code_address, $customer_image);
                if(($customer_image) != "") {
                    $target_dir = "../Content/images/";
                    $target_file = $target_dir . basename($_FILES["image1"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    // Check if image file is a actual image or fake image
                    if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["image1"]["tmp_name"]);
                    if($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                    }

                    // Check if file already exists
                    if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                    }

                    // Check file size
                    if ($_FILES["image1"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                    } else {
                    if (move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file)) {
                        echo "The file ". htmlspecialchars( basename( $_FILES["image1"]["name"])). " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                    }
                }
                echo '<script>alert("Cập nhật khách hàng thành công!")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=customer"/>';
            }

            break;
        
        default:
            # code...
            break;
    }
