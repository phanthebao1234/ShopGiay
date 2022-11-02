<div class="container-fluid">
    <h1>Quản lý Marketing</h1>
    <div class="d-flex justify-content-between flex-row mt-3">
        <div>
            <a href="index.php?action=marketing&act=insert" class="btn btn-primary me-3">&plus; Thêm chiến dịch marketing</a>
            <!-- <a href="index.php?action=blog&act=import" class="btn btn-info me-3">&uArr; Nhập CSV</a>
            <a href="index.php?action=blog&act=export" class="btn btn-success">&dArr; Xuất file Excel</a> -->
        </div>
        <!-- <a class="text-decoration-underline fst-italic" href="index.php?action=customers&act=restore">Các thương hiệu đã xóa <i class="fas fa-lg fa-trash-alt"></i></a> -->
    </div>
    <table class="table striped my-3">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên chiến dịch</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i = 0;
                $marketing = new Marketing();
                $results = $marketing -> getListAllMarketing();
                
                while ($set = $results->fetch()): 
                    $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $set['marketing_name'] ?></td>
                <td>
                    <?php echo $set['marketing_start'] ?>
                </td>
                <td>
                    <?php 
                        echo $set['marketing_end']; 
                    ?>
                </td>
                <td>
                    <form action="index.php?action=marketing&act=changestatus" method="POST" class="d-flex">
                        <input type="hidden" name="marketing_id" value="<?php echo $set['marketing_id']?>">
                        <select class="form-select" id="marketing_status" name="marketing_status">
                            <option <?php if($set['marketing_status'] == 1) {
                                echo "selected";
                            } else { echo ""; } ?> value="1">Đang hoạt động</option>
                            <option <?php if($set['marketing_status'] == 0) {
                                echo "selected";
                            } else { echo ""; } ?> value="0">Chưa hoạt động</option>
                        </select>
                        <button class="btn btn-primary" type="submit">Thay đổi</button>
                    </form>
                </td>
                <td>
                    <a href="index.php?action=marketing&act=update&id=<?php echo $set['marketing_id']?>" ><i class="fas fa-edit fw-bold text-warning"></i></a>
                </td>
                <td>
                    <a href="index.php?action=marketing&act=delete&id=<?php echo $set['marketing_id']?>" ><i class="fas fa-trash-alt fw-bold text-danger"></i></a>
                </td>
            </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function(){
        $('#marketing_status').change(function(){
            console.log("Hello world");
        })
    })
</script>