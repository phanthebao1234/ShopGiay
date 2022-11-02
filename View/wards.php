<?php 
    include '../Model/connect.php';
    include '../Model/address.php';
    $address = new Address();
    $state_id = $_POST['state_id'];
    $result = $address -> getWards($state_id);
?>
    <option value="">Chọn quận, huyện, xã</option>
<?php
    while ($set = $result->fetch()):
?>
    <option value="<?php echo $set["code"];?>"><?php echo $set["name"];?></option>
<?php endwhile; ?>