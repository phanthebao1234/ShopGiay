<?php 
    include '../Model/connect.php';
    include '../Model/address.php';
    $address = new Address();
    // $province_id = $_SESSION['province_id'];
    $province_id = $_POST['province_id'];
    $result = $address -> getDistrict($province_id);
?>
    <option value="">Chọn thành phố</option>
<?php
    while ($set = $result->fetch()):
?>
    <option value="<?php echo $set["code"];?>"><?php echo $set["name"];?></option>
<?php endwhile; ?>