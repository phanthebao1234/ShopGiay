<?php
    class Customers {
        public function __construct() {}

        // Lấy tất cả customer
        public function getListCustomers() {
            $db = new connect();
            $query = "select * from customers";
            $result = $db->getList($query);
            return $result;
        }

        // Lấy 1 customer
        public function getCustomer($customer_id) {
            $db = new connect();
            $query = "select * from customers where customer_id=$customer_id";
            $result = $db->getInstance($query);
            return $result;
        }

        // Thêm dữ liệu vào customer
        public function insertCustomers($customer_firstname, $customer_lastname, $customer_render, $customer_birthday, $customer_phone, $customer_email, $customer_password, $customer_address, $customer_code_address, $customer_image) {
            $db = new connect();
            if($customer_image == "") {
                $query = "insert into customers (customer_id, customer_firstname, customer_lastname, customer_render,customer_birthday, customer_phonenumber, customer_email, customer_password, customer_address, customer_code_address) 
                values(Null, '$customer_firstname', '$customer_lastname', '$customer_render', '$customer_birthday', $customer_phone, '$customer_email', '$customer_password', '$customer_address', $customer_code_address)";
            } else {
                $query = "insert into customers (customer_id, customer_firstname, customer_lastname, customer_render,customer_birthday, customer_phonenumber, customer_email, customer_password, customer_address, customer_image, customer_code_address) 
                values(Null, '$customer_firstname', '$customer_lastname', '$customer_render', '$customer_birthday', $customer_phone, '$customer_email', '$customer_password', '$customer_address', '$customer_image', $customer_code_address)";
            }
            $db -> exec($query);
        }

        // Cập nhật dữ liệu
        public function updateCustomer($customer_id, $customer_firstname, $customer_lastname, $customer_render=1, $customer_birthday="", $customer_phonenumber, $customer_email, $customer_password, $customer_address="", $customer_code_address, $customer_image) {
            $db = new connect();
            if ($customer_image == "") {
                $query = "update customers set 
                customer_firstname='$customer_firstname',
                customer_lastname='$customer_lastname',
                customer_render='$customer_render',
                customer_birthday='$customer_birthday',
                customer_phonenumber='$customer_phonenumber',
                customer_email='$customer_email',
                customer_password='$customer_password',
                customer_address='$customer_address',
                customer_code_address = '$customer_code_address'
                where customer_id=$customer_id";
            }
            else {
                $query = "update customers set 
                customer_firstname='$customer_firstname',
                customer_lastname='$customer_lastname',
                customer_render='$customer_render',
                customer_birthday='$customer_birthday',
                customer_phonenumber='$customer_phonenumber',
                customer_email='$customer_email',
                customer_password='$customer_password',
                customer_address='$customer_address',
                customer_code_address='$customer_code_address',
                customer_image='$customer_image'
                where customer_id=$customer_id";
            }
            $db->exec($query);
        }

        // Xóa 1 trường
        public function deleteCustomer($customer_id) {
            $db = new connect();
            $query = "delete from customers where customer_id=$customer_id";
            $db->exec($query);
        }

        // Xóa tất cả
        public function deleteAllCustomer() {
            $db = new connect();
            $query = "DELETE FROM customers";
            $db->exec($query);
        }

        // Kiểm tra trùng email hoặc số điện thoại
        public function checkDuplicate($customer_email, $customer_phonenumber) {
            $db = new connect();
            $query = "select COUNT(*) as count from customers where customer_email = '$customer_email' or customer_phonenumber = '$customer_phonenumber'";
            $result = $db -> getInstance($query);
            return $result;
        }
    }
?>