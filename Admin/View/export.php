<?php
    require "Content/PHPExcel.php";
     $sanpham = new Products();
     $result = $sanpham->exportData();
     // Out put each data
    

    $excel = new PHPExcel();
    $excel -> setActiveSheetIndex(0);
    $excel ->getActiveSheet() ->setCellValue('A1', 'Tên Sản Phẩm');
    $excel ->getActiveSheet() ->setCellValue('B1', 'Giá Sản Phẩm');
    $excel ->getActiveSheet() ->setCellValue('C1', 'Hình Sản Phẩm');
    $excel ->getActiveSheet() ->setCellValue('D1', 'Mô tả Sản Phẩm');
    $excel ->getActiveSheet() ->setCellValue('E1', 'Size Sản Phẩm');
    $excel ->getActiveSheet() ->setCellValue('F1', 'Thương Hiệu Sản Phẩm');
    $excel ->getActiveSheet() ->setCellValue('G1', 'Tồn Kho Sản Phẩm');

    $numRow = 2;
    while($row = $result->fetch()) {
        $excel->getActiveSheet() ->setCellValue('A'.$numRow, $row['TenSanPham']);
        $excel->getActiveSheet() ->setCellValue('B'.$numRow, $row['GiaSanPham']);
        $excel->getActiveSheet() ->setCellValue('C'.$numRow, $row['HinhSanPham']);
        $excel->getActiveSheet() ->setCellValue('D'.$numRow, $row['MoTa']);
        $excel->getActiveSheet() ->setCellValue('E'.$numRow, $row['Size']);
        $excel->getActiveSheet() ->setCellValue('F'.$numRow, $row['ThuongHieu']);
        $excel->getActiveSheet() ->setCellValue('G'.$numRow, $row['TonKho']);
        $numRow++;
    }

    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=products_data".time().".xlsx");
    PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
    
    
?>