<?php 
    class Address {
        public function __construct() {}

        public function getListProvince() {
            $db = new connect();
            $query = "select * from provinces";
            $result = $db -> getList($query);
            return $result;
        }

        public function getDistrict($province_code) {
            $db = new connect();
            $query = "select * from districts where province_code = $province_code";
            $result = $db -> getList($query);
            return $result;
        }

        public function getWards($district_code) {
            $db = new connect();
            $query = "select * from wards where district_code = $district_code";
            $result = $db -> getList($query);
            return $result;
        }
        public function getDetailAddress($wards_code) {
            $db = new connect();
            $query = "select CONCAT('Tỉnh ',p.name, ', thành phố ', d.name, ' , quận/xã: ', w.name) as address
            from provinces p, (districts d inner join wards w on d.code=w.district_code)
            where w.code = $wards_code
            AND p.code = d.province_code";
            $result = $db -> getInstance($query);
            return $result;
        }
    }
?>