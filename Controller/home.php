<?php 
    $action = 'home';
    if(isset($_GET['act'])) {
        $action = $_GET['act'];
    }

    switch ($action) {
        case 'home':
            include 'View/home2.php';
            break;
        case 'sanpham':
            include 'View/products.php';
            break;
        case 'giayconhantao':
            include 'View/products.php';
            break;
        case 'giayfutsal':
            include 'View/products.php';
            break;
        case 'detail':
            include 'View/detail2.php';
            break;
        case 'input_address':
            include 'View/inputAddress.php';
            break;
    }
?>