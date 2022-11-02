<?php 
    $action = "blog";
    if (isset($_GET['act'])) {
        $action = $_GET['act'];
    }

    switch ($action) {
        case 'detail':
            $blog_id = $_GET['blog_id'];
            include 'View/blog_detail.php';
            break;
        
        default:
            include 'View/blog.php';
            break;
    }

?>