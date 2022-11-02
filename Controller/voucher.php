<?php
    $action = 'voucher';
    if(isset($_GET['act'])) {
        $action = $_GET['act'];
    }

    switch ($action) {
        case 'voucher':
            include 'View/voucher.php';
            break;
        case 'voucher_action':
            echo "Hello World";
            echo $_GET['voucher_code'];
            echo '<script>console.log('.$_POST["voucher_code"].')</script>';
            // if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //     echo '<script>alert("'.$_POST['voucher_code'].')</script>';
            // }
            break;
        default:
            # code...
            break;
    }
?>