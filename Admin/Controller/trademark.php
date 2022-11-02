<?php
    $action = 'trademark';
    if(isset($_GET['act'])) {
        $action = $_GET['act'];
    }
    switch ($action) {
        case 'insert':
            include 'View/editTrademark.php';
            break;
        case 'insert_action':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $trademark_name = trim($_POST['trademark_name']);
                $trademark_desc = trim($_POST['trademark_desc']);
                $trademark_status = $_POST['trademark_status'];
                $trademark_image = $_POST['trademark_image'];
                $trademark_parent_id = isset($_POST['trademark_parent_id'])  ? $_POST['trademark_parent_id'] : '';
                if (empty($trademark_name)) {
                    echo '<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin</div>';
                } else {
                    $trademark = new Trademark();
                    $result = $trademark->insertTrademark($trademark_name, $trademark_desc, $trademark_image, $trademark_status, $trademark_parent_id);
                    echo '<script>alert("Thêm thương hiệu thành công")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=trademark"/>';
                    // echo '<script>alert("'.$result.'")</script>';
                }
            }
            break;
        case 'update':
            include 'View/editTrademark.php';
            break;
        case 'update_action':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $trademark_id = $_POST['trademark_id'];
                $trademark_name = trim($_POST['trademark_name']);
                $trademark_desc = trim($_POST['trademark_desc']);
                $trademark_status = $_POST['trademark_status'];
                $trademark_image = $_POST['trademark_image'];
                $trademark_parent_id = isset($_POST['trademark_parent_id'])  ? $_POST['trademark_parent_id'] : '';
                if (empty($trademark_name)) {
                    echo '<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin</div>';
                } else {
                    $trademark = new Trademark($trademark_id);
                    $result = $trademark->updateTrademark($trademark_id, $trademark_name, $trademark_desc, $trademark_image, $trademark_status, $trademark_parent_id);
                    echo '<script>alert("cập nhật thương hiệu thành công")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=trademark"/>';
                    echo '<script>alert("'.$result.'")</script>';
                }
            }
        case 'delete':
            if (isset($_SESSION['id'])) {
                if (isset($_GET['id'])) {
                    $trademark_id = $_GET['id'];
                    $trademark = new Trademark();
                    $trademark -> deleteTrademark($trademark_id);
                    if ($trademark) {
                        echo '<script>alert("Xóa thương hiệu thành công")</script>';
                        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=trademark"/>';
                    }
                }
            }
            break;
        default:
            if (isset($_SESSION['id'])) {
                include 'View/trademark.php';
            } else {
                echo '<script>alert("Bạn chưa đăng nhập")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=login"/>';
            }
            break;
    }
?>