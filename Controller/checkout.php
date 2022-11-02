<?php 
    $action = 'checkout';
    if(isset($_GET['act'])) {
        $action = $_GET['act'];
    }

    switch ($action) {
        case '':
            # code...
            break;
        
        default:
            include 'View/checkout.php';
            break;
    }
?>