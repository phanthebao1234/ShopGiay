    <?php
    if(isset($_GET['id_product'])) {
        $id_sanpham = $_GET['id_product'];
        $sanpham = new Products();
        $result = $sanpham -> getDetailProducts($id_sanpham);
        $tensanpham = $result['TenSanPham'];
        $giasanpham = $result['GiaSanPham'];
        $hinhsanpham = $result['HinhSanPham'];
        $mota = $result['MoTa'];
        $size = $result['Size'];
        $tonkho = $result['TonKho'];
        $thuonghieu = $result['ThuongHieu'];
    }
?>

<div class="container" style="margin-top: 100px">
    <h1>Danh sách sản phẩm</h1>
    <form class="detail d-flex my-5" action="index.php?action=cart&act=add_cart" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $id_sanpham ?>">
        
        <div class="detail_image">
            <img src="../Content/images/<?php echo $hinhsanpham ?>" style="width:100%" alt="">
        </div>
        <div class="detail_info ms-3">
            <h1 class="text-danger fw-bold" style="font-style: italic;">
                <?php echo $tensanpham ?>
            </h1>
            <h4>Thương hiệu: <?php
                echo $thuonghieu;
            ?></h4>
            <h4>Kích thước: <?php
                echo $size;
            ?></h4>
            <h4>Tồn kho: <?php
                echo $tonkho;
            ?></h4>

            <h3 class="text-danger fw-bold my-3" style="text-decoration: underline">
                Giá: <?php echo number_format($giasanpham); ?> đ
            </h3>

            <label for="quantity">Số lượng: </label>
            <input type="number" name="product_quantity" id="product_quantity" value="1" min="1"> 
            
            <button class="btn btn-danger btn-lg mt-2" type="submit" name="submit">Thêm vào giỏ hàng</button>
        </div>
    </form>                                                                                                                                                          
    <div class="description w-50">
        <?php echo $mota ?>
    </div>

    <div class="comment my-4">
        <h3 class="text-danger">Bình luận</h3>
        <hr>
        
    </div>
    <div class="container mt-5">
    <div class="bg-light p-2">
        <form action="index.php?action=comment&act=post_comment" method="POST">
            <div class="d-flex flex-row align-items-start"><img class="rounded-circle" src="../Content/images/noimagesuser.png" width="40">
                <?php
                    if(isset($_SESSION['customer_id'])) {
                ?>
                    <textarea class="form-control ml-1 shadow-none textarea" id="editor" name="comment_content" rows="10"></textarea>
                    <input type="hidden" name="customer_id" value="<?php echo $_SESSION['customer_id']; ?>" />
                    <input type="hidden" name="id_sanpham" value="<?php echo $id_sanpham; ?>" />
                <?php }?>

            </div>
            <div class="mt-2 text-right">
                <?php
                    if(isset($_SESSION['customer_id'])) {
                        echo '<button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                        <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button>';
                    } else {
                        echo '<a href="index.php?action=auth&act=login">Vui lòng đăng nhập</a>';
                    }
                ?>
            </div>
        </form>
    </div>
    <div class="row">
        <?php 
            $comment = new Comment();
            $result = $comment-> getListCommentProduct($id_sanpham);
            while ($set = $result->fetch()):

        ?>
        <div class="col-md-8">
            <div class="d-flex flex-column comment-section">
                <div class="bg-white p-2">
                    <div class="d-flex flex-row user-info">
                        <!-- Chỗ image có thể load hình của từng customer -->
                        <img class="rounded-circle" src="../Content/images/noimagesuser.png" width="40"> 
                        <div class="d-flex flex-column justify-content-start mx-2">
                            <span class="d-block font-weight-bold name"><?php echo $set['fullname'] ?></span>
                            <span class="date text-black-50"><?php echo $set['created_at'] ?></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="comment-text">
                            <?php  echo $set['comment_content']?>
                        </p>
                    </div>
                </div>
                <div class="bg-white">
                    <div class="d-flex flex-row fs-12">
                        <div class="like p-2 cursor btn btn-outline-primary"><i class="fa fa-thumbs-o-up"></i><span class="ml-1">Like</span></div>
                        <div class="like p-2 cursor"><i class="fa fa-commenting-o"></i><span class="ml-1">Comment</span></div>
                        <div class="like p-2 cursor"><i class="fa fa-share"></i><span class="ml-1">Share</span></div>
                    </div>
                </div>
                
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script>
<script>
   
    $(document).ready(function() {
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );


        $('#addcart').click( function(){

        })

        $('#product_quantity').on('input', function(){
            checkproduct_quantity();
        })

        function checkproduct_quantity() {
            var quantity_inStock = <?php echo $tonkho ?>;
            console.log(quantity_inStock);
            var quantity = $('#product_quantity').val();
            var pattern = /^\d+$/;
            var regex = pattern.test(quantity);
            $('#product_quantity').attr('max', quantity_inStock);
            if(!regex) {
                return false;
            } else if(quantity >= quantity_inStock ) {
                $('#product_quantity').val(quantity_inStock);
            }
        }

    })
</script>