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
                if ($comment_content != '' && $comment_content != null) {
                    $comment -> postComment($comment_content, $id_sanpham, $customer_id);
                    if($comment) {
                        echo "<script>alert('Đăng thành công')</script>";
                        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=home&act=detail&id='.$id_sanpham.'"/>';
                    }
                } else {
                    echo "<script>alert('Đăng thất bại')</script>";
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=home&act=detail&id='.$id_sanpham.'"/>';
                }
            }
            break;
        case 'post_comment_blog':
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $comment_content = $_POST['comment_content'];
                $customer_id = $_POST['customer_id'];
                $blog_id = $_POST['blog_id'];
                $comment = new Comment();
                if ($comment_content != '' && $comment_content != null) {
                    $comment -> postCommentBlog($comment_content, $blog_id, $customer_id);
                    if($comment) {
                        echo "<script>alert('Đăng thành công')</script>";
                        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=blog&act=detail&blog_id='.$blog_id.'"/>';
                    }
                } else {
                    echo "<script>alert('Đăng thất bại')</script>";
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=blog&act=detail&blog_id='.$blog_id.'"/>';
                }
            }
        default:
            # code...
            break;
    }
?>