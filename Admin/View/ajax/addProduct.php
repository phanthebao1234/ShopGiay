<?php
    include '../../Model/connect.php';
    include '../../Model/products.php';

    $tensanpham = htmlspecialchars(trim($_POST['tensanpham']));
    $thuonghieu = htmlspecialchars(trim($_POST['thuonghieu']));
    $loai = htmlspecialchars(trim($_POST['loai']));
    $giasanpham = htmlspecialchars(trim($_POST['giasanpham']));
    $giagiam = htmlspecialchars(trim($_POST['giagiam']));
    if ($giagiam != 0) {
        $loaigiamgia = htmlspecialchars(trim($_POST['loaigiamgia']));
    } else {
        $loaigiamgia = 0;
    }
    $mota = $_POST['mota'];
    $thumbnail = htmlspecialchars(trim($_POST['thumbnail']));
    $images = htmlspecialchars(trim($_POST['images']));
    $size = htmlspecialchars(trim($_POST['size']));
    $tonkho = htmlspecialchars(trim($_POST['tonkho']));

    if(empty($tensanpham) || empty($thuonghieu) || empty($giasanpham) || empty($size) || empty($tonkho)) {
        echo '<script>console.log("err3")</script>';
        echo '<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin</div>';
    } else {
        $product = new Products();
        $product -> insertProduct($tensanpham, $giasanpham, $giagiam, $loaigiamgia, $thumbnail, $images, $mota, $size, $thuonghieu, $tonkho, $loai);
        echo '<script>alert("Thêm sản phẩm thành công")</script>';
        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=product"/>';
    } 
?>