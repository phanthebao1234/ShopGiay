<?php
    $action = 'marketing';
    if (isset($_GET['act'])) {
        $action = $_GET['act'];
    }

    switch ($action) {
        case 'order':
            include 'View/orders.php';
            break;
        case 'insert':
            include 'View/editMarketing.php';
            break;
        case 'insert_action':
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $marketing_name = $_POST['marketing_name'];
                $marketing_description = $_POST['marketing_description'];
                $marketing_banner = $_POST['marketing_banner'];
                $marketing_start = $_POST['marketing_start'];
                $marketing_end = $_POST['marketing_end'];
                $marketing_voucher_id = $_POST['marketing_voucher_id'];
                $marketing_saleall = $_POST['marketing_saleall'];
                $marketing_trademark_id = $_POST['marketing_trademark_id'];
                $marketing_saletrademark = $_POST['marketing_saletrademark'];
                $marketing = new Marketing();
                $marketing -> insertMarketing($marketing_name, $marketing_description, $marketing_banner, $marketing_voucher_id, $marketing_saleall, $marketing_trademark_id, $marketing_saletrademark, $marketing_start, $marketing_end);
                echo '<script>alert("Marketing được thêm thành công")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=marketing"/>';
            }
            break;
        case 'update':
            if (isset($_GET['act']) && $_GET['act'] == 'update') {
                $marketing_id = $_GET['id'];
                include 'View/editMarketing.php';
            }
            break;
        case 'update_action':
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $order_id = $_POST['order_id'];
                $order_status = $_POST['order_status'];
                $order = new Order();
                $order -> updateStatusOrder($order_id, $order_status);
                if($order) {
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=order"/>';
                    echo '<script>alert("Cập thành thành công")</script>!';
                } else {
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=order"/>';
                    echo '<script>alert("Cập thành không thành công thành công")</script>!';
                }
            }
            break;
        case 'delete':
            if (isset($_GET['act']) && isset($_GET['id']) & $_GET['id'] != "") {
                $marketing_id = $_GET['id'];
                $marketing = new Marketing();
                $marketing -> deleteMarketing($marketing_id);
                if ($marketing) {
                    echo '<script>alert("Xóa thành công")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=marketing"/>';
                }
            }
            break;
        case 'changestatus':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $marketing_id = $_POST['marketing_id'];
                $marketing_status = $_POST['marketing_status'];
                $marketing = new Marketing();
                $marketing -> updateStatus($marketing_id, $marketing_status);
                if($marketing_status == 1 || $marketing_id != "") {
 
                    $marketing = new Marketing();
                    $result = $marketing->getDetailMarketing($marketing_id);
                    if($result['marketing_status'] == 1) {
                        if($result['marketing_saleall'] != null || $result['marketing_saleall'] != "") {
                            $product = new Products();
                            $product -> setSaleAllProducts(0, $result['marketing_saleall']); // -0 là phần trăm
                        } else if($result['marketing_saletrademark'] != null && $result['marketing_saletrademark'] != "") {
                            $product = new Products();
                            $product -> setSaleAllProductsWithTrademark($result['marketing_trademark_id'],0, $result['marketing_saletrademark']);
                        } 
                    } else if($result['marketing_status'] == 0) {
                        if($result['marketing_saleall'] != null && $result['marketing_saleall'] != "") {
                            $product = new Products();
                            $product -> setSaleAllProducts(0, 0);
                        } else if($result['marketing_saletrademark'] != null && $result['marketing_saletrademark'] != "") {
                            $product = new Products();
                            $product -> setSaleAllProductsWithTrademark($result['marketing_trademark_id'],0, 0);
                        }
                    }
                } else {
                    if($result['marketing_saleall'] != null && $result['marketing_saleall'] != "") {
                        $product = new Products();
                        $product -> setSaleAllProducts(0, 0);
                    } else if($result['marketing_saletrademark'] != null && $result['marketing_saletrademark'] != "") {
                        $product = new Products();
                        $product -> setSaleAllProductsWithTrademark($result['marketing_trademark_id'],0, 0);
                    } else {
                        
                    }
                }
                
                    echo '<script>alert("Cập nhật thành công")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=marketing"/>';
            } else {
                echo '<script>alert("Sự kiện không thành công")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=marketing"/>';
            }
            break;
        default:
            include 'View/marketing.php';
            break;
    }
?>