<div class="container-fluid blog mt-5" style="background-color: #f3f3f3">
    <div class="desc container-fluid">
        <div class="row row-cols-1 row-cols-md-4 g-4" style="padding: 50px 0">
            <?php
            $blog = new Blog();
            $result = $blog->getListBlogs();
            while ($set = $result->fetch()) :
            ?>
                <div class="col ">
                    <div class="card h-100">
                        <a href="index.php?action=blog&act=detail&blog_id=<?php echo $set['blog_id'] ?>"><img src="../Admin/Content/images/<?php echo $set['blog_thumbnail'] ?>" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <a class="text-decoration-none text-secondary" href="index.php?action=blog&act=detail&blog_id=<?php echo $set['blog_id']?>">
                                <h5 class="card-title fw-bolder title" id="blog_title" title="<?php echo $set['blog_title']; ?>"><?php echo $set['blog_title']; ?></h5>
                            </a>
                            <p class="card-text" >
                                <?php echo $set['blog_desc'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile ?>
        </div>
    </div>
</div>
