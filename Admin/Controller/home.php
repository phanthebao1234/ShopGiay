<?php
    $action = 'home';
    if(isset($_GET['act'])) {
        $action = $_GET['act'];
    }

    switch($action) {
        case 'upload':
            include 'View/importImage.php'; 
            break;
        case 'home':
            include 'View/home.php';
            break;
        case 'chart':
            include 'View/dashboard.php';
            break;
        case 'sendMail':
            include 'View/sendMail.php';
            break;
    }
?>
