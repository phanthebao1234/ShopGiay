<?php
    include '../../Model/connect.php';
    include '../../Model/products.php';
    $id_sanpham = htmlspecialchars(trim($_POST['id_sanpham']));
    $tensanpham = htmlspecialchars(trim($_POST['tensanpham']));
    $thuonghieu = htmlspecialchars(trim($_POST['thuonghieu']));
    $loai = htmlspecialchars(trim($_POST['loai']));
    // $hinh = $_FILES['files']['name'];
    // $images = implode(';', $hinh);
    $images = htmlspecialchars(trim($_POST['images']));
    $giasanpham = htmlspecialchars(trim($_POST['giasanpham']));
    $giagiam = htmlspecialchars(trim($_POST['giagiam']));
    if ($giagiam != 0) {
        $loaigiamgia = htmlspecialchars(trim($_POST['loaigiamgia']));
    } else {
        $loaigiamgia = 0;
    }
    $thumbnail = htmlspecialchars(trim($_POST['thumbnail']));
    $mota = $_POST['mota'];
    $size = htmlspecialchars(trim($_POST['size']));
    $tonkho = htmlspecialchars(trim($_POST['tonkho']));

    if(empty($tensanpham) || empty($thuonghieu) || empty($giasanpham) || empty($size) || empty($tonkho)) {
        echo '<script>console.log("err3")</script>';
        echo '<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin</div>';
    } else {
        $product = new Products();
        $product -> updateProduct($id_sanpham, $tensanpham, $giasanpham, $giagiam, $loaigiamgia, $thumbnail, $images, $mota, $size, $thuonghieu, $tonkho, $loai);
        echo '<script>alert("Cập nhật sản phẩm thành công")</script>';
        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=product"/>';
    } 
?>