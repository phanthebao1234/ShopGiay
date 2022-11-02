<?php 
    class Products {
        public function __construct() {}

        // Lấy tất cả sản phẩm
        function getListProducts() {
            $db = new connect();
            $query = "Select * from sanpham";
            $result = $db->getList($query);
            return $result;
        }

        // Thêm sản phẩm
        function insertProduct($tensanpham, $giasanpham, $giagiam = 0, $loaigiamgia = 0, $thumbnail="", $hinhsanpham="", $mota="", $size, $thuonghieu, $tonkho, $loai) {
            $db = new connect();
            $query = "insert into sanpham (id_sanpham, TenSanPham, GiaSanPham, GiaGiam, LoaiGiamGia, Thumbnail, HinhSanPham, MoTa, Size, ThuongHieu, TonKho, LoaiSanPham) 
            values (Null, '$tensanpham', '$giasanpham', '$giagiam', '$loaigiamgia', '$thumbnail' ,'$hinhsanpham', '$mota', '$size', '$thuonghieu', '$tonkho', $loai)";
            $db->exec($query);
        }

        // Cập Nhật sản phẩm
        function updateProduct($id_sanpham, $tensanpham, $giasanpham, $giagiam = 0, $loaigiamgia = 0, $thumbnail ="", $hinhsanpham="", $mota="", $size, $thuonghieu, $tonkho, $loai) {
            $db = new connect();
            $query = "update sanpham 
            set TenSanPham='$tensanpham',
            GiaSanPham='$giasanpham',
            GiaGiam='$giagiam',
            LoaiGiamGia='$loaigiamgia',
            Thumbnail='$thumbnail',
            HinhSanPham='$hinhsanpham',
            MoTa='$mota',
            Size='$size',
            ThuongHieu='$thuonghieu',
            LoaiSanPham ='$loai',
            TonKho='$tonkho'
            where id_sanpham=$id_sanpham";
            $db->exec($query); 
        }

        // Xóa sản phẩm
        function deleteProduct($id) {
            $db = new connect();
            $query = "delete from sanpham where id_sanpham=$id";
            $db->exec($query);
        }

        // lấy thông tin của 1 sản phẩm
        function getProductID($id)
        {
            $db=new connect();
            $select="select * from sanpham where id_sanpham=$id";
            $result=$db->getInstance($select);
            return $result;
        }

        // Exports product
        function exportData() {
            $db = new connect();
            $query = "select * from sanpham order by id_sanpham ASC";
            $result = $db->getList($query);
            return $result;
        }

        // search
        function searchNameProduct($_name) {
            $db = new connect();
            $query = "select * from sanpham where TenSanPham LIKE '%$_name%'";
            $result = $db->getList($query);
            return $result;
        }
        
        // // output count 
        // function countProducts(){
        //     $db = new connect();
        //     $query = "SELECT COUNT(TenSanPham) AS 'total' FROM sanpham;";
        //     $result = $db->getList($query);
        //     return $result;
        // }
        function searchIDProduct($id) {
            $db = new connect();
            $query = "select * from sanpham where id_sanpham like '%$id%'";
            $results= $db->getList($query);
            return $results;
        }
        
        public function setSaleAllProducts($sale_type = 0, $sale_value = 0){
            $db = new connect();
            $query = "update sanpham set LoaiGiamGia = '$sale_type', GiaGiam ='$sale_value'";
            $db->exec($query);
        }
        
        public function setSaleAllProductsWithTrademark($trademark_id, $sale_type = 0, $sale_value = 0){
            $db = new connect();
            $query = "update sanpham set LoaiGiamGia='$sale_type', GiaGiam='$sale_value' where ThuongHieu='$trademark_id'";
            $db->exec($query);
        }
    }
?>