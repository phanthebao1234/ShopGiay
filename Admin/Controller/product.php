<?php
$action = "products";
if (isset($_GET['act'])) {
    $action = $_GET['act'];
}
switch ($action) {
    case "products":
        include 'View/products.php';
        break;
    case "insert_product":
        include 'View/editsanpham.php';
        break;
    case "update_product":
        include 'View/editsanpham.php';
        break;
    case 'delete_action':
        if (isset($_GET['id_sanpham'])) {
            $id_sanpham = $_GET['id_sanpham'];
            $sanpham = new Products();
            $sanpham->deleteProduct($id_sanpham);
            echo '<meta http-equiv="refresh" content="0;url=./index.php?action=product"/>';
            echo '<script>alert("Xóa thành công")</script>!';
        }
        include 'View/products.php';
        break;
    case 'export_action':
        include 'Model/export.php';
        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=product"/>';
        // include 'View/export.php';
        break;
    case 'search_action':
        include 'View/products.php';
        break;
    
    
}
