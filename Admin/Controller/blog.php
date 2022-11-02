<?php
    $action = "blog";
    if (isset($_GET['act'])) {
        $action = $_GET['act'];
    }

    switch ($action) {
        case 'insert':
            if(isset($_SESSION['id'])){
                include 'View/editBlog.php';
            } else {
                echo '<script>alert("Vui lòng đăng nhập")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=login"/>';
            }
            break;
        case 'insert_action':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $user_id = $_POST['user_id'];
                $menu = $_POST['menu'];
                $blog_desc = $_POST['blog_desc'];
                $blog_content = $_POST['blog_content'];
                $blog_title = $_POST['blog_title'];
                $blog_hashtag = $_POST['blog_hashtag'];
                $published_at = $_POST['published_at'];
                $blog_thumbnail = $_POST['blog_thumbnail'];
                $blog = new Blogs();
                $blog-> insertBlog($user_id, $menu, $blog_title, $blog_content, $blog_desc, $blog_hashtag, $blog_thumbnail, $published_at);
                if($blog) {
                    echo '<script>alert("Thêm bài viết thành công")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=blog"/>';
                } else {
                    echo '<script>alert("Thêm bài viết không thành công thành công")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=blog"/>';
                }
            }
            break;
        case 'update':
            if(isset($_SESSION['id'])) {
                include 'View/editBlog.php';
            } else {
                echo '<script>alert("Vui lòng đăng nhập")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=login"/>';
            }
            break;
        case 'update_action':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $blog_id = $_POST['blog_id'];
                $user_id = $_POST['user_id'];
                $menu = $_POST['menu'];
                $blog_desc = $_POST['blog_desc'];
                $blog_content = $_POST['blog_content'];
                $blog_title = $_POST['blog_title'];
                $blog_hashtag = $_POST['blog_hashtag'];
                $published_at = $_POST['published_at'];
                $blog_thumbnail = $_POST['blog_thumbnail'];
                $blog = new Blogs();
                $blog-> updateBlog($blog_id, $blog_title, $blog_content, $blog_desc, $blog_hashtag, $blog_thumbnail, $menu, $published_at);
                if($blog) {
                    echo '<script>alert("Cập nhật bài viết thành công")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=blog"/>';
                } else {
                    echo '<script>alert("Cập nhật bài viết không thành công thành công")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=blog"/>';
                }
            }
            break;
        case 'deleteConfirm':
            if(isset($_GET['id'])) {
                $blog_id = $_GET['id'];
                $blog = new Blogs();
                $blog -> deleteConfirm($blog_id);
                if($blog) {
                    echo '<script>alert("Bài viết đã đưa vào thùng rác")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=blog"/>';
                } else {
                    echo '<script>alert("Xóa bài viết không thành công")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=blog"/>';
                }
            }
            break;
        case 'deleteConfirm':
            if(isset($_GET['id'])) {
                $blog_id = $_GET['id'];
                $blog = new Blogs();
                $blog -> deleteConfirm($blog_id);
                if($blog) {
                    echo '<script>alert("Bài viết đã xóa thành công")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=blog"/>';
                } else {
                    echo '<script>alert("Xóa bài viết không thành công")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=blog&act=restore"/>';
                }
            }
            break;
        case 'delete':
            if(isset($_GET['id'])) {
                $blog_id = $_GET['id'];
                $blog = new Blogs();
                $blog -> delete($blog_id);
                if($blog) {
                    echo '<script>alert("Bài viết đã xóa thành công")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=blog&act=restore"/>';
                } else {
                    echo '<script>alert("Xóa bài viết không thành công")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=blog&act=restore"/>';
                }
            }
            break;
        case 'restore':
            include 'View/restoreBlog.php';
            break;
        case 'restore_action':
            if(isset($_GET['id'])) {
                $blog_id = $_GET['id'];
                $blog = new Blogs();
                $blog -> restoreBlog($blog_id);
                if($blog) {
                    echo '<script>alert("Bài viết đã khôi phục thành công")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=blog&act=restore"/>';
                } else {
                    echo '<script>alert("Khôi phục bài viết không thành công")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=blog&act=restore"/>';
                }
            }
            break;
        default:
            if(isset($_SESSION['id'])){
                include 'View/blogs.php';
            } else {
                echo '<script>alert("Vui lòng đăng nhập")</script>';
                echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=login"/>';
            }
            break;
    }
 