<?php
    class Order {
        public function __construct() {}

        public function getListOrders2() {
            $db = new connect();
            $query = "select b.bill_id, CONCAT(a.customer_firstname, ' ', a.customer_lastname) as fullname,a.customer_address,a.customer_phonenumber,b.ngaydat, c.total, sp.TenSanPham, c.quantity
            from sanpham sp, (customers a inner join bill b on a.customer_id=b.customer_id)
            INNER JOIN bill_detail c on b.bill_id = c.bill_id
            where sp.id_sanpham = c.id_sanpham 
            order by b.ngaydat desc
            "; 
            $result = $db -> getList($query);
            return $result;
        }

        public function getListOrders() {
            $db = new connect();
            $query = "select * from orders order by order_ngaydat desc";
            $result = $db -> getList($query);
            return $result;
        }

        public function insertOrders() {
            $db = new connect();
            $query = "select b.bill_id, CONCAT(a.customer_firstname, ' ', a.customer_lastname) as fullname,a.customer_address,a.customer_phonenumber,b.ngaydat, c.total, sp.TenSanPham, c.quantity
            from sanpham sp, (customers a inner join bill b on a.customer_id=b.customer_id)
            INNER JOIN bill_detail c on b.bill_id = c.bill_id
            where sp.id_sanpham = c.id_sanpham 
            "; 
            $db->exec($query);
        }

        public function getTotalMonth() {
            $db = new connect();
            $query = "SELECT YEAR(order_ngaydat) as 'Năm', MONTH(order_ngaydat) as 'Tháng', SUM(order_total) as 'Tổng tiền'
            FROM orders
            GROUP BY YEAR(order_ngaydat), MONTH(order_ngaydat)
            order by YEAR(order_ngaydat), MONTH(order_ngaydat)";
            $result = $db -> getList($query);
            return $result;
        }

        public function getSumTotal() {
            $db = new connect();
            $query = "select sum(order_total) as 'Tổng tiền' from orders";
            $result = $db -> getInstance($query);
            return $result;
        }

        public function updateStatusOrder($order_id, $order_status) {
            $db = new connect();
            $query = "update orders set order_status = '$order_status' where order_id = '$order_id'";
            $db -> exec($query);
        }

        public function getListOrdersLimit3() {
            $db = new connect();
            $query = "select * from orders order by order_ngaydat asc limit 3";
            $result = $db -> getList($query);
            return $result;
        }

        public function filterOrder($order_status) {
            $db = new connect();
            $query = "select * from orders where order_status='$order_status' ORDER BY order_ngaydat ASC";
            $result = $db -> getList($query);
            return $result;
        }

    }
?>