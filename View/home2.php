<div class="container-fluid home">
    <div class="home_slide">
        <div class="owl-carousel slide-banner">
            <?php

            for ($i = 1; $i <= 10; $i++) :
            ?>
                <div>
                    <img src="../Content/images/slideshow_<?php echo $i ?>.jpg" alt="">
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <div class="home_mustbuy">
        <div class="container">
            <div class="home_mustbuy-title">
                <h3 class="text-uppercase">Bộ sưu tập mới</h3>
            </div>
            <div class="home_mustbuy-img">
                <figure>
                    <img src="../Content/images/mustbuy_img_master.jpg" alt="">
                </figure>
            </div>
            <div class="home_mustbuy-product">
                <div class="row">
                    <?php
                    $product = new Products();
                    $result = $product->getLimitProduct();
                    while ($set = $result->fetch()) :
                    ?>

                        <a href="index.php?action=home&act=detail&id=<?php echo $set['id_sanpham'] ?>" class="card col-3 g-4 border-0  list-item text-decoration-none">
                            <img src="../Content/images/<?php echo $set['Thumbnail'] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-title" style="color: #4c4c4c"><?php echo $set['TenSanPham'] ?></p>
                                <p class="card-text text-danger fw-bold"><?php echo number_format($set['GiaSanPham']) ?>₫</p>
                            </div>
                        </a>

                    <?php endwhile ?>
                </div>
            </div>
        </div>
    </div>

    <div class="home_newcol">
        <div class="container">
            <div class="home_newcol-title">
                <h3 class="text-uppercase">Bạn đang quan tâm</h3>
            </div>
            <div class="home_newcol-img row">
                <div class="col-3 slide-newcol owl-carousel">
                    <?php
                    $menu = new Menu();
                    $result = $menu->getListMenuActive();
                    while ($set = $result->fetch()) :
                    ?>
                        <a href="index.php?action=home&act=sanpham">
                            <figure>
                                <img src="../Content/images/<?php echo $set['menu_thumbnail'] ?>" alt="">
                            </figure>
                        </a>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="home_trademark">
        <div class="container">
            <div class="home_trademark-title">
                <h3 class="text-uppercase">Tìm theo thương hiệu</h3>
            </div>
            <div class="row home_trademark-img">
                <?php
                $trademark = new Trademark();
                $result = $trademark->getListAllTrademarks();
                while ($set = $result->fetch()) :
                ?>
                    <div class="col-lg-3">
                        <a href="index.php?action=sanpham">
                            <figure>
                                <img src="../Content/images/<?php echo $set['trademark_image'] ?>" alt="">
                            </figure>
                            <div class="text-start text-primary">
                                <p><?php echo $set['trademark_desc'] ?></p>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <div class="home_banner">
        <div class="container">
            <a href="index.php?action=home&act=sanpham">
                <picture>
                    <source media="(max-width: 767px)" data-srcset="//theme.hstatic.net/200000278317/1000929405/14/home_banner_img_larges.jpg?v=121" srcset="//theme.hstatic.net/200000278317/1000929405/14/home_banner_img_larges.jpg?v=121">
                    <img class="dt-width-100 lazyloaded" width="1600" height="600" src="//theme.hstatic.net/200000278317/1000929405/14/home_banner_img.jpg?v=121" data-src="//theme.hstatic.net/200000278317/1000929405/14/home_banner_img.jpg?v=121" alt="home_banner_img.jpg">
                </picture>
            </a>
        </div>
    </div>

    <div class="home_review">
        <div class="container">
        <div class="home_review-title">
            <h3 class="text-uppercase">Trải nghiệm mua sắm tại cửa hàng</h3>
        </div>
            <div class="row">
                <?php
                    for ($i=1; $i <= 6; $i++):  
                ?>
                    <div class="col-2">
                        <a href="index.php?action=home&act=sanpham">
                            <img src="../Content/images/groupbuy_<?php echo $i; ?>_img_compact.jpg" alt="">
                        </a>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>

<script src="../Content/js/owl.carousel.min.js"></script>
<script>
    $('.slide-banner').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 5000,
        transition: 1000,
        autoplayHoverPause: false,
        smartSpeed: 1500,
        // animateIn: 'linear',
        // animateOut: 'linear',
        responsive: {
            0: {
                items: 1,
                nav: true,
                loop: true
            },
            600: {
                items: 3,
                nav: false,
                loop: true
            },
            1000: {
                items: 1,
                nav: false,
                loop: true
            }
        }
    })

    $('.slide-newcol').owlCarousel({
        items: 4,
        loop: true,
        margin: 10,
        responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 5000,
        transition: 1000,
        autoplayHoverPause: false,
        smartSpeed: 1500,
        // animateIn: 'linear',
        // animateOut: 'linear',
        responsive: {
            0: {
                items: 1,
                nav: true,
                loop: true
            },
            600: {
                items: 2,
                nav: false,
                loop: true
            },
            1000: {
                items: 4,
                nav: false,
                loop: true
            }
        }
    })
    <?php 
        $marketing = new Marketing();
        $results = $marketing->getDetailMarketingBanner();
        while ($set = $results->fetch()):
    ?>
        var banner = `
        <div class="d-flex justify-content-center align-items-center">
            <div>
                <img src="../Content/images/<?php if($set['marketing_banner'] != null) { echo $set['marketing_banner']; } else { echo "no-banner.jpg";} ?>" width="70%" class="text-center">
                <h3 class="my-3 text-danger"><?php echo $set['marketing_name'] ?></h3>
                <div class="border border-info text-danger fst-italic d-flex justify-content-center align-items-center">
                    <?php if($set['marketing_saleall'] != null ): ?>
                        <p class="p-1">Giảm giá <?php echo $set['marketing_saleall']?>% cho tất cả sản phẩm </p>
                    <?php elseif($set['marketing_saletrademark'] != null): ?>
                        <p class="p-1">Giảm <?php echo $set['marketing_saletrademark']?>% cho tất cả sản phẩm <?php $getNameTrademark = $trademark -> getNameTrademark($set['marketing_trademark_id']); echo $getNameTrademark['trademark_name']?> </p>
                    <?php elseif($set['marketing_voucher_id'] != null): ?>
                        <p class="p-1">Nhập mã <?php $voucher = new Voucher; $getVoucherCode = $voucher -> getVoucherCode($set['marketing_voucher_id']); echo $getVoucherCode['voucher_code'];?> để nhận được ưu đãi</p>
                    <?php endif;?>
                </div>
                <div class="my-3">
                    <?php echo $set['marketing_description'] ?>
                </div>
            </div>
        </div>
        `
    <?php endwhile; ?>
    Swal.fire({
        title: 'Thông tin khuyến mãi cho bạn!',
        html: banner,
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        }
    })
</script>