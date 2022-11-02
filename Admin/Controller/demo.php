<?php
    $action = 'demo';
    if (isset($_GET['act'])) {
        $action = $_GET['act'];
    }

    switch ($action) {
        case 'demo':
            include 'View/demoPag.php';
            break;
        
        default:
            # code...
            break;
    }
?>