<?php 
    class Menu {
        public function __construct() {}

        public function getListMenu() {
            $db = new connect();
            $query = "select * from menu";
            $result = $db -> getList($query);
            return $result;
        }

        public function getListMenuActive() {
            $db = new connect();
            $query = "select * from menu where menu_status = 1";
            $result = $db -> getList($query);
            return $result;
        }

        public function getListMenuNoActive() {
            $db = new connect();
            $query = "select * from menu where menu_status = 0";
            $result = $db -> getList($query);
            return $result;
        }

        public function insertMenu($menu_name, $menu_status, $menu_desc, $menu_thumbnail= "") {
            $db = new connect();
            $query = "insert into menu ( menu_name, menu_desc, menu_status, menu_thumbnail)
            value ('$menu_name', '$menu_desc', $menu_status, '$menu_thumbnail')";
            $db -> exec($query);
        }

        public function updateMenu($menu_id, $menu_name, $menu_desc, $menu_status = 1,  $menu_thumbnail= "") {
            $db = new connect();
            $query = "update menu
            set menu_name = '$menu_name',
                menu_desc = '$menu_desc', 
                menu_status = '$menu_status',
                menu_thumbnail = '$menu_thumbnail'
                where menu_id = '$menu_id'";
            $db -> exec($query);
        }

        public function deleteConfirmMenu($menu_id) {
            $db = new connect();
            $query = "delete from menu where menu_id = '$menu_id'";
            $db -> exec($query);
        }
        
        public function deleteMenu($menu_id) {
            $db = new connect();
            $query = "update menu
            set menu_status = 0
            where menu_id = '$menu_id'";
            $db->exec($query);
        }

        public function restoreMenu($menu_id) {
            $db = new connect();
            $query = "update menu
            set menu_status = 1
            where menu_id = '$menu_id'";
            $db->exec($query);
        }

        public function getDetailMenu($menu_id) {
            $db = new connect();
            $query = "select * from menu where menu_id = '$menu_id'";
            $result = $db->getInstance($query);
            return $result;
        }
    }
?>

