<?php 
    class Marketing {
        public function __construct() {}
        
        public function getListAllMarketing() {
            $db = new connect();
            $query = "select * from marketing";
            $result = $db-> getList($query);
            return $result;
        }
        
        public function insertMarketing($marketing_name = null, $marketing_description = null, $marketing_banner = null, $marketing_voucher_id = null, $marketing_saleall = null, $marketing_trademark_id = null, $marketing_saletrademark = null, $marketing_start = null, $marketing_end = null) {
            $db = new connect();
            $query = "insert into marketing (marketing_name, marketing_description, marketing_banner, marketing_voucher_id, marketing_saleall, marketing_trademark_id, marketing_saletrademark, marketing_start, marketing_end)
            value ('$marketing_name', '$marketing_description', '$marketing_banner', '$marketing_voucher_id', '$marketing_saleall', '$marketing_trademark_id', '$marketing_saletrademark', '$marketing_start', '$marketing_end')";
            $db->exec($query);
        }
        
        public function updateMarketing($marketing_id, $marketing_name = null, $marketing_description = null, $marketing_banner = null, $marketing_voucher_id = null, $marketing_saleall = null, $marketing_trademark_id = null, $marketing_saletrademark = null, $marketing_start = null, $marketing_end = null) {
            $db = new connect();
            $query = "update marketing
            set marketing_name = '$marketing_name',
                marketing_description = '$marketing_description',
                marketing_banner = '$marketing_banner',
                marketing_voucher_id = '$marketing_voucher_id',
                marketing_saleall = '$marketing_saleall',
                marketing_trademark_id = '$marketing_trademark_id',
                marketing_saletrademark = '$marketing_saletrademark',
                marketing_start = '$marketing'
                marketing_end = '$marketing_end'
            where marketing_id = $marketing_id";
            $db -> exec($query);
        }
        
        public function deleteMarketing($marketing_id) {
            $db = new connect();
            $query = "delete from marketing where marketing_id = $marketing_id";
            $db -> exec($query);
        }
        
        public function getDetailMarketing($marketing_id) {
            $db = new connect();
            $query = "select * from marketing where marketing_id = $marketing_id";
            $result = $db -> getInstance($query);
            return $result;
        }
        
        public function updateStatus($marketing_id, $marketing_status) {
            $db = new connect();
            $query = "update marketing set marketing_status = '$marketing_status' where marketing_id = $marketing_id";
            $db -> exec($query);
        }
    }
?>