<?php
    class Customer {
        public function __construct() {}

        public function getCustomer($customer_id) {
            $db = new connect();
            $query = "select * from customers where customer_id=$customer_id";
            $result = $db->getInstance($query);
            return $result;
        }

        public function loginCustomer($customer_name, $customer_pass) {
            $db = new connect();
            $query = "select * from customers where (customer_phonenumber='$customer_name' and customer_password='$customer_pass') or (customer_email='$customer_name' and customer_password='$customer_pass')";
            $result = $db->getInstance($query);
            return $result;
        }
        
        public function updateCustomer($customer_id, $customer_firstname, $customer_lastname, $customer_render, $customer_birthday, $customer_phonenumber, $customer_email, $customer_password, $customer_address, $customer_image) {
            $db = new connect();
            $query = "update customers set 
            customer_firstname='$customer_firstname',
            customer_lastname='$customer_lastname',
            customer_render='$customer_render',
            customer_birthday='$customer_birthday',
            customer_phonernumber='$customer_phonenumber',
            customer_email='$customer_email',
            customer_password='$customer_password',
            customer_address='$customer_address',
            customer_image='$customer_image',
            where customer_id=$customer_id
            ";
            $db->exec($query);
        }

        public function updateCustomerAdressPhone($customer_id, $customer_address, $customer_phone) {
            $db = new connect();
            $query = "update customers
            set customer_address = '$customer_address',
                customer_phonenumber = $customer_phone
            where customer_id = $customer_id";
            $db-> exec($query);
        }

        public function regristerCustomer($customer_firstname, $customer_lastname, $customer_render = 1, $customer_birthday = '1990-01-01', $customer_phonenumber, $customer_email, $customer_password, $customer_address, $customer_image='' ) {
            $db = new connect();
            $query = "insert into customers (customer_firstname, customer_lastname, customer_render, customer_birthday, customer_phonenumber, customer_email, customer_password, customer_address, customer_image)
            values ('$customer_firstname', '$customer_lastname', '$customer_render', '$customer_birthday', '$customer_phonenumber', '$customer_email', '$customer_password', '$customer_address', '$customer_image')";
            try {
                $db->exec($query);
            } catch (PDOException  $e) {
                if($e->errorInfo[1] == 1062) {
                    echo '<script>alert("Email hoặc số điện thoại bị trùng lặp")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=auth&act=resgister"/>';
                } else {
                    echo "<script>alert('Sai cú pháp')</script>";
                }
            }
        }

        public function checkDuplicate($customer_email, $customer_phonenumber) {
            $db = new connect();
            $query = "select COUNT(*) as count from customers where customer_email = '$customer_email' or customer_phonenumber = '$customer_phonenumber'";
            $result = $db -> getInstance($query);
            return $result;
        }
    }
?>