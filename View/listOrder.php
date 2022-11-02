<?php
    if(isset($_SESSION['customer_id'])):
        $customer_id = $_SESSION['customer_id'];
        $order = new HoaDon();
        $result = $order-> getStatusHoaDon($customer_id);
        
        ?>
<div class="container">
    <table>
        <tbody>
            <?php 
                while ($set = $result->fetch()):
            ?>
              <tr>
                <td>
                    <img src="../Content/images/<?php echo $set['HinhSanPham']?>" alt="" style="width: 80px">
                </td>
                <td>
                    <p><?php echo $set['TenSanPham']?></p>
                    <p>Số lượng: <?php echo $set['quantity'] ?></p>
                </td>
                <td>

                </td>
              </tr>  
              <?php endwhile; ?>
        </tbody>
    </table>
    
    <?php endif; ?>
</div>
