<?php
    class Comment {
        public function __construct() {}

        public function getListCommentProduct($id_sanpham) {
            $db = new connect();
            $query = "select b.comment_id, CONCAT(a.customer_firstname, ' ', a.customer_lastname) as fullname, a.customer_phonenumber, b.created_at, b.comment_content
            from sanpham sp, (customers a inner join comments b on a.customer_id=b.customer_id)
            where b.id_sanpham = $id_sanpham
            AND sp.id_sanpham = b.id_sanpham
            ORDER BY b.created_at DESC";
            $result = $db -> getList($query);
            return $result;
        }

        public function postComment($comment_content, $id_sanpham, $customer_id) {
            $db = new connect();
            $query = "insert into comments (comment_content, id_sanpham, customer_id)
            values ('$comment_content', $id_sanpham, $customer_id)";
            $db -> exec($query);
        }

        
    }
?>