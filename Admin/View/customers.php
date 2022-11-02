<div class="container-fluid">
    <h1 class="text-capitalize">Danh sách Khách hàng</h1>
    <div class="d-flex justify-content-between flex-row mt-3">
        <div>
            <a href="index.php?action=customer&act=insert" class="btn btn-primary me-3">&plus; Thêm mới</a>
            <a href="index.php?action=user&act=import" class="btn btn-info me-3">&uArr; Nhập CSV</a>
            <a href="index.php?action=user&act=export" class="btn btn-success">&dArr; Xuất file Excel</a>
        </div>
        <a class="text-decoration-underline fst-italic" href="index.php?action=customers&act=restore">Các khách hàng đã xóa <i class="fas fa-lg fa-trash-alt"></i></a>
    </div>
    <table class="table table-bordered table-hover my-3">
        <thead>
            <tr>
                <th>STT</th>
                <th>First Name</th>
                <th>Last Name</th>
                <!-- <th>Render</th> -->
                <!-- <th>Birth Date</th> -->
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <!-- <th>Image</th> -->
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 0;
                $customers = new Customers();
                $results = $customers->getListCustomers();
                while($set= $results->fetch()):
                    $i++
            ?>
            <tr class="text-center">
                <td>
                    <?php echo $i ?>
                </td>
                <td>
                    <?php echo $set['customer_firstname'] ?>
                </td>
                <td>
                    <?php echo $set['customer_lastname'] ?>
                </td>
                

                <td>
                    <?php echo $set['customer_phonenumber'] ?>
                </td>
                <td>
                    <?php echo $set['customer_email'] ?>
                </td>
               
                <td>
                    <?php echo $set['customer_address'] ?>
                </td>
                
                <td>
                    <a href="index.php?action=customer&act=update&customer_id=<?php echo $set['customer_id'] ?>" ><i class="fas fa-edit fw-bold text-warning"></i></a>
                </td>
                <td>
                    <a href="index.php?action=customer&act=delete&customer_id=<?php echo $set['customer_id'] ?>" ><i class="fas fa-trash-alt fw-bold text-danger"></i></a>
                </td>
            </tr>
            <?php
                endwhile;
            ?>
        </tbody>
    </table>
</div>