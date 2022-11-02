<?php 
    class HoaDon {
        public function __construct() {}

        public function insertBill($customer_id) {
            $db = new connect();
            $query = "insert into bill (bill_id, customer_id, total, ngaydat)
            values (Null, $customer_id, 0, null)";
            $db->exec($query);
            $select = "select bill_id from bill order by bill_id desc limit 1";
            $result = $db->getInstance($select); 
            return $result[0]; 
        }
        public function insertOrderDetail($bill_id, $id_sanpham, $quantity, $total) {
            $db = new connect();
            $query = "insert into bill_detail (bill_id, id_sanpham, quantity, total)
            values ($bill_id, $id_sanpham, $quantity, $total)";
            $db->exec($query);
        }
        public function updateOrderTotal($bill_id, $total) {
            $db = new connect();
            $query = "update bill set total = $total where bill_id = $bill_id";
            $db -> exec($query);
        }

        public function getOrder($sohdid) {
            $db=new connect();
            $select="select b.bill_id, a.customer_firstname ,a.customer_lastname,a.customer_address,a.customer_phonenumber,b.ngaydat from customers a 
            inner join bill b on a.customer_id=b.customer_id where bill_id=$sohdid";
            // trả đúng thông tin của 1 khách hàng  getInstance
            $result=$db->getInstance($select);
            return $result;
        }

        public function getOrderDetails($bill_id) {
           $db = new connect();
           $query = "select a.TenSanPham, a.GiaSanPham, b.quantity, b.total from sanpham a inner join bill_detail b on a.id_sanpham = b.id_sanpham where bill_id=$bill_id";    
           $result = $db -> getList($query);
           return $result; 
        }

        public function getStatusHoaDon($customer_id) {
            $db = new connect();
            $query = "select b.bill_id, CONCAT(a.customer_firstname, ' ', a.customer_lastname) as fullname,a.customer_address,a.customer_phonenumber,b.ngaydat, c.total, sp.TenSanPham, c.quantity, sp.HinhSanPham
            from sanpham sp, (customers a inner join bill b on a.customer_id=b.customer_id)
            INNER JOIN bill_detail c on b.bill_id = c.bill_id
            where b.customer_id = $customer_id
            AND sp.id_sanpham = c.id_sanpham
            "; 
            $result = $db -> getList($query);
            return $result;
        }

        public function insertOrder($bill_id, $customer_id) {
            $db = new connect();
            $query = "insert into orders (order_fullname, order_address, order_phonenumber, order_total, order_tensanpham, order_quantity)
            select CONCAT(a.customer_firstname, ' ', a.customer_lastname) as fullname,a.customer_address,a.customer_phonenumber, c.total, sp.TenSanPham, c.quantity
            from sanpham sp, (customers a inner join bill b on a.customer_id=b.customer_id)
            INNER JOIN bill_detail c on b.bill_id = c.bill_id
            where b.customer_id = $customer_id
            AND b.bill_id = $bill_id
            AND sp.id_sanpham = c.id_sanpham";
            $db -> exec($query);
        }

}
