<?php
    class Products
    {
        // Lấy tất cả sản phẩm
        function getListProducts() {
            $db = new connect();
            $query = "SELECT * FROM sanpham";
            $result = $db -> getList($query);
            return $result;
        }

        // Lấy tất cả sản phẩm theo danh mục
        function getListProductWithMenu($menu_id) {
            $db = new connect();
            $query = "select * from sanpham where LoaiSanPham = '$menu_id'";
            $result = $db -> getList($query);
            return $result;
        }

        function getListProductWithTrademark($trademark) {
            $db = new connect();
            $query = "select * from sanpham where ThuongHieu = '$trademark'";
            $result = $db -> getList($query);
            return $result;
        }
        
        // Lấy thông tin sản phẩm theo ID
        function getDetailProducts($id) {
            $db = new connect();
            $query = "select * from sanpham where id_sanpham = $id";
            $result = $db->getInstance($query);
            return $result;
        }
        // Cập nhật số lượng sản phẩm tồn kho sau khi mua thành công
        function updateProductAfterPay($product_id, $product_quantity) {
            $db = new connect();
            $query = "update sanpham
            set TonKho = TonKho - $product_quantity
            where id_sanpham = $product_id";
            $db -> exec($query);
        }

        function search($keyword) {
            $db = new connect();
            $query = "select * from sanpham where TenSanPham LIKE '%$keyword%'";
            $result = $db->getList($query);
            return $result;
        }

        // Lọc giá sản phẩm
        function filterPrice($num1, $num2) {
            $db = new connect();
            $query = "SELECT *
            FROM sanpham
            WHERE FALSE OR GiaSanPham < $num1 AND GiaSanPham > $num2";
            $result = $db -> getList($query);
            return $result;
        }

        // Sắp xếp sản phẩm
        function filterSelect($option, $col) {
            $db = new connect();
            $query = "select * from sanpham order by $col $option";
            $result = $db -> getList($query);
            return $result;
        }

        // Lọc sản phẩm theo thương hiệu
        function filterTradeMark($trademark) {
            $db = new connect();
            $query = "SELECT * FROM sanpham WHERE ThuongHieu IN ($trademark)";
            $result = $db -> getList($query);
            return $result;
        }

        // Lấy 4 sản phẩm vừa tạo
        function getLimitProduct() {
            $db = new connect();
            $query = "SELECT * 
            FROM sanpham 
            ORDER BY created_at
            LIMIT 4";
            $result = $db -> getList($query);
            return $result;
        }
        
        
        // Phân trang 
        
        public function getTotalPages() {
            $db = new connect();
            $query = "select count(*) as 'total' from sanpham";
            $result = $db -> getInstance($query);
            return $result;
        }
        
        public function getProductPageLimit($start, $limit) {
            $db = new connect();
            $query = "select * from sanpham order by TenSanPham ASC LIMIT $start, $limit";
            $results = $db-> getList($query);
            return $results;
        }
    }
?>