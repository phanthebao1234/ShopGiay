<?php
    class Trademark {
        public function __construct() {}

        // Lấy tất cả trademarks
        public function getListAllTrademarks() {
            $db = new connect();
            $query = "select * from trademark";
            $results = $db -> getList($query);
            return $results;
        }

        // Lấy cụ thể 1 trademark theo id
        public function getDetailTrademark($trademark_id) {
            $db = new connect();
            $query = "select * from trademark where trademark_id ='$trademark_id'";
            $results = $db -> getInstance($query);
            return $results;
        }

        // Thêm trademark
        public function insertTrademark($trademark_name, $trademark_desc="", $trademark_img ="", $trademark_status=1, $trademark_parent_id = null ) {
            $db = new connect();
            $query = "insert into trademark (trademark_name, trademark_desc, trademark_image, trademark_status, trademark_parent_id)
            values ('$trademark_name', '$trademark_desc', '$trademark_img', '$trademark_status', '$trademark_parent_id')";
            $db -> exec($query);
        }

        public function updateTrademark($trademark_id, $trademark_name, $trademark_desc, $trademark_image, $trademark_status ,$trademark_parent_id) {
            $db = new connect();
            $query  = "update trademark 
            set trademark_name = '$trademark_name',
                trademark_desc = '$trademark_desc',
                trademark_image = '$trademark_image',
                trademark_status = $trademark_status,
                trademark_parent_id = $trademark_parent_id
            where trademark_id = $trademark_id";
            $db -> exec($query);
        }
        
        public function getNameTrademark($trademark_id) {
            $db = new connect();
            $query = "select trademark_name from trademark where trademark_id = $trademark_id";
            $result = $db -> getInstance($query);
            return $result;
        }
    }

?>