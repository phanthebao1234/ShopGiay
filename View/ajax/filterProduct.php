<?php
include '../../Model/connect.php';
include '../../Model/products.php';

$product = new Products();
$filterPrice = isset($_POST['conditionprice']) ? trim($_POST['conditionprice']) : '';
$filterSelect = isset($_POST['option']) ? trim($_POST['option']) : '';
$filterTradeMark = isset($_POST['filterTrademark']) ? trim($_POST['filterTrademark']) : '';
?>

<div class="list my-3 row">
    <?php
    if ($filterPrice != '') {   
        switch ($filterPrice) {
            case 'price1':
                $results = $product -> filterPrice(1000000, 0);
                break;
            case 'price2':
                $results = $product -> filterPrice(2000000, 1000000);
                break;
            case 'price3':
                $results = $product -> filterPrice(3000000, 2000000);
            case 'price4': 
                $results = $product -> filterPrice(4000000, 3000000);
                break;
        }
    } else if ($filterSelect != '') {
        switch ($filterSelect) {
            case 'descPrice':
                $results = $product -> filterSelect('DESC', 'GiaSanPham');
                break;
            case 'ascPrice': 
                $results = $product -> filterSelect('ASC', 'GiaSanPham');
                break;
            case 'ascName': 
                $results = $product -> filterSelect('ASC', 'TenSanPham');
                break;
            case 'descName': 
                $results = $product -> filterSelect('DESC', 'TenSanPham');
                break;
        }
    } else if($filterTradeMark != "") {
        $results = $product -> filterTradeMark($filterTradeMark);
    } else {
        $results = $product -> getListProducts();   
    } 
    while ($set = $results->fetch()) :
    ?>
        <a href="index.php?action=home&act=detail&id=<?php echo $set['id_sanpham'] ?>" class="card col-3 g-4 border-0  list-item text-decoration-none">
            <img src="../Content/images/<?php echo $set['Thumbnail'] ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-title" style="color: #4c4c4c"><?php echo $set['TenSanPham'] ?></p>
                <p class="card-text text-danger fw-bold"><?php echo number_format($set['GiaSanPham']) ?>₫</p>
            </div>
        </a>
    <?php endwhile; ?>
</div>

