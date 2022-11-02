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
    </div>
</div>                                    






