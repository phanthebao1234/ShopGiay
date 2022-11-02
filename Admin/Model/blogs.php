<?php
    class Blogs{
        public function __construct() {}

        public function getListBlogs(){
            $db = new connect();
            $query = "SELECT blog_title, CONCAT(users.user_firstname, users.user_lastname) as fullname, menu.menu_name, blog_view, blogs.created_at as ngaytao, blogs.published_at as ngaydang 
            FROM (blogs INNER JOIN menu on blogs.menu_id = menu.menu_id)
            INNER JOIN users
            ON blogs.user_id = users.user_id
            ";
            $result = $db -> getList($query);
            return $result;
        }

        public function getBlogs() {
            $db = new connect();
            $query = "
            SELECT blog_id, blog_title, CONCAT(users.user_firstname, ' ',users.user_lastname) as author, menu.menu_name, blogs.published_at, blogs.created_at, blogs.blog_status
            FROM blogs
            INNER JOIN users on blogs.user_id = users.user_id
            inner JOIN menu on blogs.menu_id = menu.menu_id";
            $result = $db -> getList($query);
            return $result;
        }

        public function getListBlogNoActive() {
            $db = new connect();
            $query = "
            SELECT blog_id, blog_title, CONCAT(users.user_firstname, ' ',users.user_lastname) as author, menu.menu_name, blogs.published_at, blogs.created_at, blogs.blog_status
            FROM blogs
            INNER JOIN users on blogs.user_id = users.user_id
            inner JOIN menu on blogs.menu_id = menu.menu_id
            where blog_status = '0'";
            $result = $db -> getList($query);
            return $result;
        }

        public function insertBlog($user_id, $menu_id, $blog_title, $blog_content, $blog_desc, $blog_hashtag, $blog_thumbnail="", $published_at="") {
            $db = new connect();
            $query = "insert into blogs 
            (user_id, menu_id, blog_title, blog_content, blog_desc, blog_hashtag, blog_thumbnail, published_at)
            values ($user_id, $menu_id, '$blog_title', '$blog_content', '$blog_desc', '$blog_hashtag', '$blog_thumbnail', '$published_at')";
            $db -> exec($query);
        }

        public function updateBlog($blog_id, $blog_title, $blog_content, $blog_desc, $blog_hashtag, $blog_thumbnail="", $menu_id, $published_at= "") {
            $db = new connect();
            $query = "update blogs
            set blog_title = '$blog_title',
                blog_content = '$blog_content',
                blog_desc = '$blog_desc',
                blog_hashtag = '$blog_hashtag',
                blog_thumbnail = '$blog_thumbnail',
                menu_id = '$menu_id',
                published_at = '$published_at'
            where blog_id = '$blog_id'";
            $db -> exec($query);
        }
        public function deleteConfirm($blog_id) {
            $db = new connect();
            $query = "update blogs set blog_status = 0 where blog_id = '$blog_id'";
            $db -> exec($query);
        }
        public function delete($blog_id) {
            $db = new connect();
            $query = "delete from blogs where blog_id = '$blog_id'";
            $db -> exec($query);
        }

        public function restoreBlog($blog_id) {
            $db = new connect();
            $query = "update blogs set blog_status = 1 where blog_id = '$blog_id'";
            $db -> exec($query);
        }

        public function deleteBlog($blog_id) {
            $db = new connect();
            $query = "delete from blogs where blog_id = $blog_id";
            $db -> exec($query);
        }

        public function searchBlog($search) {
            $db = new connect();
            $query = "select * from blogs where CONCAT_WS('', blog_title, blog_desc, blog_content, blog_hashtag) LIKE '%$search%'";
            $result = $db -> getList($query);
            return reset($result);
        }

        public function getDetailBlog($blog_id) {
            $db = new connect();
            $query = "select * from blogs where blog_id = '$blog_id'";
            $result = $db -> getInstance($query);
            return $result;
        }

        public function updateViewBlog($blog_id) {
            $db = new connect();
            $query = "update blogs (blog_view) set blog_view = blog_view + 1 where blog_id = '$blog_id'";
            $db -> exec($query);
        }
        
        public function searchBlogTitle($blog_title) {
            $db = new connect();
            $query = "SELECT blog_id, blog_title, CONCAT(users.user_firstname, ' ',users.user_lastname) as author, menu.menu_name, blogs.published_at, blogs.created_at, blogs.blog_status
            FROM blogs
            INNER JOIN users on blogs.user_id = users.user_id
            inner JOIN menu on blogs.menu_id = menu.menu_id
            where blogs.blog_title like '%$blog_title%'";
            $result = $db -> getList($query);
            return $result;
        }

        public function searchBlogAuthor($blog_author) {
            $db = new connect();
            $query = "SELECT blog_id, blog_title, CONCAT(users.user_firstname, ' ',users.user_lastname) as author, menu.menu_name, blogs.published_at, blogs.created_at, blogs.blog_status
            FROM blogs
            INNER JOIN users on blogs.user_id = users.user_id
            inner JOIN menu on blogs.menu_id = menu.menu_id
            where user_lastname like '%$blog_author%'";
            $result = $db -> getList($query);
            return $result;
        }

        public function searchBlogMenu($menu_id) {
            $db = new connect();
            $query = "SELECT blog_id, blog_title, CONCAT(users.user_firstname, ' ',users.user_lastname) as author, menu.menu_name, blogs.published_at, blogs.created_at, blogs.blog_status
            FROM blogs
            INNER JOIN users on blogs.user_id = users.user_id
            inner JOIN menu on blogs.menu_id = menu.menu_id
            where blogs.menu_id like '%$menu_id%'";
            $result = $db -> getList($query);
            return $result;
        }
        
    }
?>