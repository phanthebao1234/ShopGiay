<?php 
    if (isset($_SESSION['customer_id'])) {
        $action = 'cart';
    if(!isset($_SESSTION['cart'])) {
        $_SESSTION['cart'] = array();
    }
    if(isset($_GET['act'])) {
        $action = $_GET['act'];
    }

    switch ($action) {
        case 'cart':
            include 'View/cart2.php';
            break;
        case 'add_cart':
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $product_id = $_POST['product_id'];
                $product_quantity = $_POST['product_quantity'];
                $product_size = $_POST['product_size'];
                $product_status = true;
                addCart($product_id, $product_quantity, $product_size, $product_status);
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=cart"/>';
            }
            break;
        case 'pay_action':

            break;
        case 'delete':
            if(isset($_GET['id'])){
                $key = $_GET['id'];
                unset($_SESSION['cart'][$key]);
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=cart"/>';
            }
            break;
        case 'update':
            if(isset($_POST['newqty'])) {   
                $soluongmua = $_POST['newqty'];
                // $check = $_POST['cart_check'];
                // echo '<script>alert("'.$check.'")</script>';
                foreach($soluongmua as $key=>$qty)
                {
                    if($_SESSION['cart'][$key]['product_quantity']!=$qty)
                    {
                        updateItem($key,$qty);//21,10
                    }
                }
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=cart"/>';
            } else {
                '<script>alert("Hello world")</script>';
            }
            break;
        case 'status':
            include 'View/status.php';
            break;
        default:
            include 'View/cart.php';
            break;
        }
    } else {
        echo '<script>alert("Vui lòng đăng nhập")</script>';
        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=login"/>';
    }
?>