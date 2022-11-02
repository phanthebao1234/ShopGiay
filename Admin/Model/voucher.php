<?php 
    class Voucher {
        public function __contruct() {}
        
        public function getListAllVoucher() {
            $db = new connect();
            $query = "select * from voucher";
            $result = $db-> getList($query);
            return $result;
        }

        public function getListAllVoucherActive() {
            $db = new connect();
            $query = "select * from voucher where voucher_status=1";
            $result = $db -> getList($query);
            return $result;
        }

        public function insertVoucher($voucher_code, $voucher_name, $voucher_start="", $voucher_end="", $voucher_sale, $voucher_type="phần trăm", $voucher_count, $voucher_status=1) {
            $db = new connect();
            $query = "insert into voucher (voucher_id, voucher_code, voucher_name, voucher_start, voucher_end, voucher_sale, voucher_type, voucher_count, voucher_status)
            values (Null, '$voucher_code', '$voucher_name', '$voucher_start', '$voucher_end', $voucher_sale, $voucher_type, $voucher_count, $voucher_status)";
            $db->exec($query);
        }

        public function updateVoucher($voucher_id, $voucher_code, $voucher_name, $voucher_start, $voucher_end, $voucher_sale,$voucher_type, $voucher_count, $voucher_status) {
            $db = new connect();
            $query = "update voucher 
            set voucher_code='$voucher_code',
                voucher_name='$voucher_name',
                voucher_start='$voucher_start',
                voucher_end='$voucher_end',
                voucher_sale=$voucher_sale,
                voucher_type='$voucher_type',
                voucher_count=$voucher_count,
                voucher_status=$voucher_status
            where voucher_id=$voucher_id";
            $db -> exec($query);
        }

        public function deleteVoucher($voucher_id) {
            $db = new connect();
            $query = "update voucher set voucher_status = 0 where voucher_id = $voucher_id";
            $db -> exec($query);
        }

        public function getDetailVoucher($voucher_id) {
            $db = new connect();
            $query = "select * from voucher where voucher_id='$voucher_id'";
            $result = $db->getInstance($query);
            return $result;
        }

        public function getListAllVoucherNoActive() {
            $db = new connect();
            $query = "select * from voucher where voucher_status=0";
            $result = $db->getList($query);
            return $result;
        }

        public function restoreVoucher($voucher_id) {
            $db = new connect();
            $query = "update voucher set voucher_status = 1 where voucher_id=$voucher_id";
            $db -> exec($query);
        }
        public function deleteVoucherPermanently($voucher_id) {
            $db = new connect();
            $query = "delete from voucher where voucher_id=$voucher_id";
            $db -> exec($query);
        }

        public function checkDuplicateVoucherCode($voucher_code) {
            $db = new connect();
            $query = "select count(*) as count from voucher where voucher_code = '$voucher_code'";
            $result = $db -> getInstance($query);
            return $result;
        }
    }
?>