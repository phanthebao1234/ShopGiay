<?php 
    class Blog {
        public function __construct() {}

        public function getListBlogs() {
            $db = new connect();
            $query = "
            SELECT blog_id, blog_title, CONCAT(users.user_firstname, ' ',users.user_lastname) as author, menu.menu_name, blogs.published_at, blogs.created_at, blogs.blog_status, blogs.blog_desc, blogs.blog_thumbnail
            FROM blogs
            INNER JOIN users on blogs.user_id = users.user_id
            inner JOIN menu on blogs.menu_id = menu.menu_id";
            $result = $db -> getList($query);
            return $result;
        }

        public function getDetailBlog($blog_id) {
            $db = new connect();
            $query = "SELECT blogs.*, CONCAT(users.user_firstname, ' ',users.user_lastname) as author, menu.menu_name
            FROM blogs
            INNER JOIN users on blogs.user_id = users.user_id
            inner JOIN menu on blogs.menu_id = menu.menu_id where blog_id = '$blog_id'";
            $result = $db -> getInstance($query);
            return $result;
        }
    }
?>