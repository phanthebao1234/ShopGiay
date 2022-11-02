<div class="container-fluid">
    <h1 class="text-capitalize">Danh sách người dùng</h1>
    <div class="d-flex justify-content-between flex-row mt-3">
        <div>
            <?php 
                if($_SESSION['roll'] == 'admin'){
                    echo '<a class="btn btn-primary me-3" href="index.php?action=users&act=insert">Thêm Mới</a>
                        <a href="index.php?action=user&act=import" class="btn btn-info me-3">&uArr; Nhập CSV</a>
                        <a href="index.php?action=user&act=export" class="btn btn-success">&dArr; Xuất file Excel</a>';
                } else {
                    echo '<a href="#" onclick="myAlertRoll()" class="btn btn-success">Thêm Mới</a>
                    <a href="#" onclick="myAlertRoll()" class="btn btn-info">&uArr; Nhập CSV</a>
                    <a href="#" onclick="myAlertRoll()" class="btn btn-success">&dArr; Xuất file Excel</a>';
                }
            ?>
            <!-- <a href="index.php?action=users&act=insert" class="btn btn-primary me-3">&plus; Thêm mới</a>
            <a href="index.php?action=user&act=import" class="btn btn-info me-3">&uArr; Nhập CSV</a>
            <a href="index.php?action=user&act=export" class="btn btn-success">&dArr; Xuất file Excel</a> -->
        </div>
        <a class="text-decoration-underline fst-italic" href="index.php?action=users&act=restore">Các người dùng đã xóa <i class="fas fa-lg fa-trash-alt"></i></a>
    </div>
    <table class="table table-bordered table-hover my-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Render</th>
                <!-- <th>Birth Date</th> -->
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Image</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $users = new User();
                $results = $users->getListUsersActive($_SESSION['id']);
                while($set = $results->fetch()):
            ?>
            <tr class="text-center 
                    <?php if(isset($_SESSION['id'])) {
                        if($_SESSION['id'] == $set['user_id']) {
                            echo 'table-success';
                        }
                    } ?>
                ">
                <td>
                    <?php echo $set['user_id']; ?>
                </td>
                <td><?php echo $set['user_firstname']; ?></td>
                <td><?php echo $set['user_lastname']; ?></td>
                <td>
                    <?php 
                        if($set['user_render'] == 0){
                            echo 'Nam';
                        } else {
                            echo 'Nữ';
                        }
                    ?>
                </td>
                <td><?php echo $set['user_phonenumber']; ?></td>
                <td><?php echo $set['user_email']; ?></td>
                <td>
                    <?php 
                        if($set['user_address'] == "") {
                            echo 'Chưa có địa chỉ';
                        } else {
                            $address = new Address();
                            $result = $address-> getDetailAddress($set['user_address']);
                            echo $result['address'];
                        }
                    ?>
                </td>
                <td>
                    <img src="../../Content/images/<?php echo $set['user_image'] ?>" alt="Ảnh hồ sơ người dùng" style="width: 60px">
                </td>
                
                <td>
                    <?php 
                        if($_SESSION['id'] == $set['user_id'] || $_SESSION['roll'] == 'admin') {
                            echo '<a href="index.php?action=users&act=edit&id='.$set['user_id'].'"><i class="fas fa-edit fw-bold text-warning"></i></a>';
                        } else {
                            echo '<a href="#" onclick="myAlertDele()"><i class="fas fa-edit fw-bold text-warning"></i></a>';
                        }
                    ?>
                    
                </td>
                <td>
                    <?php 
                        if(isset($_SESSION['id'])) {
                            if($_SESSION['roll'] == 'user' ) {
                                echo '<a href="#" onclick="myAlertRoll()"><i class="fas fa-trash-alt fw-bold text-danger"></i></a>';
                            }
                            else  if($_SESSION['id'] == $set['user_id']) {
                                echo '<a href="#" onclick="myAlertDele()""><i class="fas fa-trash-alt fw-bold text-danger"></i></a>';
                            }
                            else {
                                echo '<a onclick="return confirm("Bạn có chắc chắn xóa !")" href="index.php?action=users&act=delete_confirm&id='.$set['user_id'].'" ><i class="fas fa-trash-alt fw-bold text-danger"></i></a>';
                            }
                        }
                    ?>
                </td>
            </tr>
            <?php
                endwhile;
            ?>
        </tbody>
    </table>
</div>

<script>
    function myAlertRoll() {
        alert("Bạn không có quyền thực hiện điều này!")
    }

    function myAlertDele() {
        alert("Bạn không thể xóa tài khoản của bạn!")
    }
</script>