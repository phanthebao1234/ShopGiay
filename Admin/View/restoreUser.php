<div class="container-fluid">
    <a class="text-decoration-underline fst-italic" href="index.php?action=users"><i class="fas fa-angle-left"></i> Quay lại danh sách danh mục</a>
    <h1 class="text-capitalize">Người dùng đã xóa</h1>
    <table class="table table-striped table-bordered table-hover my-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Render</th>
                <th>Birth Date</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Password</th>
                <th>Address</th>
                <th>Status</th>
                <th>Roll</th>
                <th>KHôi Phục</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i= 0;
                $users = new User();
                $results = $users->getListUsersNoActive();
                while($set = $results->fetch()):
                    $i++;
            ?>
                <tr>
                <td>
                    <?php echo $i; ?>
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
                <td><?php echo $set['user_birthday']; ?></td>
                <td><?php echo $set['user_phonenumber']; ?></td>
                <td><?php echo $set['user_email']; ?></td>
                <td><?php echo $set['user_password']; ?></td>
                <td><?php echo $set['user_address']; ?></td>
                <td>
                    <?php 
                        if($set['user_status'] == 1) {
                            echo '<button class="btn btn-success">Active</button>';
                        } else {
                            echo '<button class="btn btn-danger">Active</button>';
                        }

                    ?>
                </td>
                <td><?php echo $set['user_roll']; ?></td>
                <td>
                    <a href="index.php?action=users&act=restore_action&id=<?php echo $set['user_id']; ?>" class="btn btn-info">Khôi phục</a>
                </td>
                <td>
                    <?php 
                        if(isset($_SESSION['id'])) {
                            if($_SESSION['roll'] == 'user' ) {
                                echo '<a href="#" onclick="myAlertRoll()" class="btn btn-secondary">Xóa</a>';
                            }
                            else  if($_SESSION['id'] == $set['user_id']) {
                                echo '<a href="#" onclick="myAlertDele()" class="btn btn-secondary">Xóa</a>';
                            }
                            else {
                                echo '<a href="index.php?action=users&act=delete&id='.$set['user_id'].'" class="btn btn-danger">Xóa</a>';
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