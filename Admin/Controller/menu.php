<?php
    $action = "menu";
    if(isset($_GET['act'])) {
        $action = $_GET['act'];
    }

    switch ($action) {
        case 'insert_action':
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $menu_name = $_POST['menu_name'];
                $menu_desc = $_POST['menu_desc'];
                $menu_status = $_POST['menu_status'];
                $menu_thumbnail = $_POST['thumbnail'];
                $menu = new Menu();
                $menu -> insertMenu($menu_name, $menu_status, $menu_desc, $menu_thumbnail);
                if(isset($menu)) {
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=menu"/>';
                    echo '<script>alert("Thêm thành công")</script>';
                } else {
                    echo '<script>alert("Thêm không thành công")</script>!';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=insert"/>';
                }
            }
            break;
        case 'insert': 
            include 'View/editMenu.php';
            break;
        case 'update':
            include 'View/editMenu.php';
            break;
        case 'update_action':
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $menu_name = $_POST['menu_name'];
                $menu_desc = $_POST['menu_desc'];
                $menu_status = $_POST['menu_status'];
                $menu_thumbnail = $_POST['thumbnail'];
                $menu_id = $_POST['menu_id'];
                $menu = new Menu();
                $menu -> updateMenu($menu_id ,$menu_name, $menu_desc, $menu_status, $menu_thumbnail);
                if(isset($menu)) {
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=menu"/>';
                    echo '<script>alert("Cập nhật thành công")</script>';
                } else {
                    echo '<script>alert("Cập nhật không thành công")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=update"/>';
                }
            }
            break;
        case 'delete':
            $menu_id = $_GET['menu_id'];
            $menu = new Menu();
            $menu -> deleteMenu($menu_id);
            if(isset($menu)) {
                echo '<script>alert("Danh mục đã được chuyển vào trong thùng rác")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=menu"/>';
            } else {
                echo '<script>alert("Xóa không thành công")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=menu"/>';
            }
            break;
        case 'restore':
            include 'View/restoreMenu.php';
            break;
        case 'restore_action':
            $menu_id = $_GET['id'];
            $menu = new Menu();
            $menu -> restoreMenu($menu_id);
            if(isset($menu)) {
                echo '<script>alert("Khôi phục danh mục thành công")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=menu"/>';
            } else {
                echo '<script>alert("Xóa không thành công")</script>!';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=menu"/>';
            }
            break;
        case 'delete_confirm':
            $menu_id = $_GET['id'];
            $menu = new Menu();
            $menu -> deleteConfirmMenu($menu_id);
            if(isset($menu)) {
                echo '<script>alert("Xóa danh mục thành công")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=menu"/>';
            } else {
                echo '<script>alert("Xóa không thành công")</script>!';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=menu"/>';
            }
            break;
        default:
            include 'View/menu.php';
            break;
    }
?>