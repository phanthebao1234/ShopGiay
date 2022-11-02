<?php
    $action = 'order';
    if (isset($_GET['act'])) {
        $action = $_GET['act'];
    }

    switch ($action) {
        case 'order':
            include 'View/orders.php';
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
        default:
            # code...
            break;
    }
?>