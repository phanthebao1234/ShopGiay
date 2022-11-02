<?php 

    $action = 'text';
    if (isset($_GET['act'])) {
        $action = $_GET['act'];
    }
    switch ($action) {
        case 'text_action':
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['username'];
                echo $name;
            }
            break;
        default:
            include 'View/testinput.php';
            break;
    }
    
?>