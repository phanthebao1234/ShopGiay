<?php
    if(isset($_GET['blog_id'])) {
       $blog_id = $_GET['blog_id'];
       $blog = new Blog();
       $result = $blog -> getDetailBlog($blog_id);
       $blog_title = $result['blog_title'];
       $blog_content = $result['blog_content'];
       $blog_description = $result['blog_desc'];
       $blog_author = $result['author'];
       $menu_name = $result['menu_name'];
       $blog_hashtag = $result['blog_hashtag'];
       $published_at = $result['published_at'];
       $blog_view = $result['blog_view'];
    } else {
        echo '<h1>Trang không tồn tại</h1>';
    }
?>
<div class="container-fluid blog_detail ">
    <div class="blog_detail_content bg-white">
        <div class="text-center">
            <div class="blog_detail_content_inner">
                <div class="blog_detail_content_inner_title">
                    <?php echo $blog_title; ?>
                </div>
                <p class="blog_detail_content_inner_date">
                    <?php echo $published_at ?>
                </p>
                <div class="blog_detail_content_inner_content" >
                    <?php echo $blog_content; ?>
                </div>
            </div>
        </div>
        <div class="bg-light p-2">
            <h3>Bình luận</h3>
            <form action="index.php?action=comment&act=post_comment_blog" method="POST">
                <div class="d-flex flex-row align-items-start"><img class="rounded-circle" src="../Content/images/noimagesuser.png" style="width: 40px">
                    <?php
                        if(isset($_SESSION['customer_id'])) {
                    ?>
                        <textarea class="form-control ml-1 shadow-none textarea" id="editor" name="comment_content" rows="10"></textarea>
                        <input type="hidden" name="customer_id" value="<?php echo $_SESSION['customer_id']; ?>" />
                        <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>" />
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
            $result = $comment-> getListCommentBlog($blog_id);
            while ($set = $result->fetch()):
        ?>
        <div class="col-md-8">
            <div class="d-flex flex-column comment-section">
                <div class="bg-white p-2">
                    <div class="d-flex flex-row user-info">
                        <!-- Chỗ image có thể load hình của từng customer -->
                        <img class="rounded-circle" src="../Content/images/noimagesuser.png" style="width: 40px"> 
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






