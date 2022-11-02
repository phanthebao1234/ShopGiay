<?php 
    $action = 'comment';

    if(isset($_GET['act'])) {
        $action = $_GET['act'];
    }

    switch ($action) {
        case 'post_comment':
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $comment_content = $_POST['comment_content'];
                $customer_id = $_POST['customer_id'];
                $id_sanpham = $_POST['id_sanpham'];
                $comment = new Comment();
                $comment -> postComment($comment_content, $id_sanpham, $customer_id);
                if($comment) {
                    echo "<script>alert('Đăng thành công')</script>";
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=home&act=detail&id_product='.$id_sanpham.'"/>';
                }
            }
            break;
        
        default:
            # code...
            break;
    }
?>