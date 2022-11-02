<?php 
    class Marketing {
        public function __construct() {}
        
        public function getListMarketing() {
            $db = new connect();
            $query = "select * from marketing";
            $results = $db->getList($query);
            return $results;
        }
        public function getDetailMarketing($id = null) {
            $db = new connect();
            $query = "select * from marketing where marketing_id = '$id'";
            $results = $db->getInstance($query);
            return $results;
        }
        
        public function getDetailMarketingBanner() {
            $db = new connect();
            $query = "SELECT * FROM `marketing` where marketing_status = 1 ORDER BY updated_at DESC LIMIT 1";
            $results = $db -> getList($query);
            return $results;
        }
    }
?>