<?php
$detail = new Products();
$result = $detail->getDetailProducts($_GET['id']);
$product_id = $_GET['id'];
$product_name = $result['TenSanPham'];
$product_price = $result['GiaSanPham'];
$product_sale = $result['GiaGiam'];
$product_typesale = $result['LoaiGiamGia'];
if ($product_sale != 0) {
    if ($product_typesale == 0) {
        $product_price_sale = $product_price - ($product_price * $product_sale / 100);
        $sale = $product_price * $product_sale;
    }
}
$product_inStock = $result['TonKho'];
$product_thumbnail  = $result['Thumbnail'];
$sizeArr = $result['Size'];
$product_size = explode(',', $sizeArr);
$imgstr = $result['HinhSanPham'];
$product_images = explode(';', $imgstr);
$product_info = $result['MoTa'];
$product_type = $result['LoaiSanPham'];
$menu = new Menu();
$result = $menu->getDetailMenu($product_type);
$menu_desc = $result['menu_desc'];
$menu_name = $result['menu_name'];
?>
<div class="container-fluid detail">
    <div class="row mx-3">
        <div class="col-lg-6 mt-5">
            <div class="owl-carousel owl-theme owl-carousel-thumb">
                <?php
                foreach ($product_images as $key => $value) :
                ?>
                    <div class="item">
                        <img src="../Content/images/<?php echo $value ?>" alt="" width="70%">
                    </div>
                <?php endforeach; ?>
            </div>
            <ul class="owl-carousel owl-theme owl-carousel-slide list-group">
                <?php
                foreach ($product_images as $key => $value) :
                ?>
                    <li class="item list-group-item">
                        <img src="../Content/images/<?php echo $value ?>" width="50%" alt="">
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-lg-6">
            <div class="detail_info">
                <div class="detail_info-title">
                    <h3><?php echo $product_name; ?></h3>
                </div>
                <br>
                <div class="detail_info-type">
                    <p>Lo???i: <span><?php echo $menu_desc; ?></span> | M?? SP: <?php echo $product_id ?></p>
                </div>
                <div class="detail_info-price">
                    <?php
                    if ($product_sale == 0) {
                        echo '<span class="detail_info-price-unsale">' . number_format($product_price) . '???</span>';
                    } else {
                        echo '<span class="detail_info-price-sale text-decoration-line-through">' . number_format($product_price) . '???</span>';
                        echo '<span class="detail_info-price-sale">&emsp;' . number_format($product_price_sale) . '???</span>';
                    }
                    ?>
                </div>
                <div class="detail_info-size">
                    <span class="detail_info-size-name">K??ch th?????c</span>
                    <?php
                    foreach ($product_size as $key => $value) :
                    ?>
                        <label class="p-2" class="option-size" data-name="option" data-value="<?php echo $value ?>">
                            <span><?php echo $value ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <form action="" id="addCartForm" method="post">
                    <div class="detail_info-quantity">
                        <span class="detail_info-quantity-title">
                            S??? l?????ng
                        </span>
                        <div class="detail_info-quantity-option">
                            <input type="button" onclick="decreaseValue()" class="btn btn-light detail_info-quantity-btn" id="tru" value="-" style="font-size: 14px">
                            <input type="number" class="detail_info-quantity-value" name="product_quantity" id="product_quantity" value="1" min="1" onchange="checkproduct_quantity(<?php echo $product_inStock ?>)">
                            <input type="button" onclick="increaseValue()" class="btn btn-light detail_info-quantity-btn" id="cong" value="+" style="font-size: 14px">
                        </div>
                    </div>
                    <div class="detail_info_buy">

                        <input type="hidden" name="product_id" id="product_id" value="<?php if (isset($_GET["id"])) echo $product_id; ?>">
                        <input type="hidden" id="product_size" name="product_size" value="">
                        <?php
                        if (isset($_SESSION['customer_id'])) {
                            echo '<button type="button" class="btn btn-danger btn-lg" id="addcart">Th??m v??o gi??? h??ng</button>';
                        } else {
                            echo '<a class="btn btn-warning btn-lg" href="index.php?action=auth&act=login">Vui l??ng ????ng nh???p</a>';
                        }
                        ?>
                    </div>
                </form>
                <div class="detail_info-policy">
                    <div class="detail_info-policy-item">
                        <div class="detail_info-policy-item-logo">
                            <img src="../Content/images/pd_policy_1_img.png" alt="">
                        </div>
                        <div class="detail_info-policy-item-desc">
                            <h3 class="text-uppdercase">??U ????I T???NG K??M</h3>
                            <p>T???ng k??m v??? d???t kim v?? bal?? ch???ng th???m ?????ng gi??y cho m???i ????n h??ng Gi??y ???? b??ng tr??n 1 tri???u.</p>
                        </div>
                    </div>
                    <div class="detail_info-policy-item">
                        <div class="detail_info-policy-item-logo">
                            <img src="../Content/images/pd_policy_2_img.png" alt="">
                        </div>
                        <div class="detail_info-policy-item-desc">
                            <h3 class="text-uppdercase">?????I H??NG D??? D??NG</h3>
                            <p>H??? tr??? kh??ch h??ng ?????i size ho???c m???u trong vong 7 ng??y. (S???n ph???m ch??a qua s??? d???ng).</p>
                        </div>
                    </div>
                    <div class="detail_info-policy-item">
                        <div class="detail_info-policy-item-logo">
                            <img src="../Content/images/pd_policy_3_img.png" alt="">
                        </div>
                        <div class="detail_info-policy-item-desc">
                            <h3 class="text-uppdercase">CH??NH S??CH GIAO H??NG</h3>
                            <p>COD To??n qu???c | Freeship to??n qu???c khi kh??ch h??ng thanh to??n chuy???n kho???n tr?????c v???i ????n h??ng Gi??y ???? b??ng tr??n 1 tri???u.</p>
                        </div>
                    </div>
                    <div class="detail_info-policy-item">
                        <div class="detail_info-policy-item-logo">
                            <img src="../Content/images/pd_policy_4_img.png" alt="">
                        </div>
                        <div class="detail_info-policy-item-desc">
                            <h3 class="text-uppdercase">THANH TO??N TI???N L???I</h3>
                            <p>Ch???p nh???n c??c lo???i h??nh thanh to??n b???ng th???, ti???n m???t, chuy???n kho???n.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="detail_info">
        <div class="detail_info-desc">
            <ul class="text-uppercase fw-bold detail_info-desc-menu">
                <li class="view-desc" onclick="clickMenu(this, 'info')" id="active">
                    <p>m?? t??? s???n ph???m</p>
                </li>
                <li class="view-desc" onclick="clickMenu(this, 'guarantee')">
                    <p>ch??nh s??ch b???o h??nh</p>
                </li>
                <li class="view-desc" onclick="clickMenu(this, 'advice')">
                    <p>l???i khuy??n ch???n gi??y</p>
                </li>
                <li class="view-desc" onclick="clickMenu(this, 'comment')">
                    <p>B??nh lu???n</p>
                </li>
            </ul>
        </div>
        <div class="detail_info-text">
            <div class="container" id="text">
            </div>
        </div>
    </div>

</div>

<script src="../node_modules/readmore-js/readmore.min.js"></script>
<script>
    $('.demo').readmore({
        speed: 75,
        moreLink: '<a href="#">Read more</a>',
        collapsedHeight: 200
    });
    var product_info = `<?php echo $product_info ?>`;
    var text_comment = `
        <div>
            <?php 
                if(isset($_SESSION['customer_id'])):
            ?>  
            
            <form method="post" action="index.php?action=comment&act=post_comment">
                <div class="d-flex flex-row align-items-start">
                    <img class="rounded-circle" src="../Content/images/noimagesuser.png" style="width: 40px">
                        <textarea class="form-control ml-1 shadow-none textarea" id="editor" name="comment_content" rows="5"></textarea>
                        <input type="hidden" name="customer_id" value="<?php echo $_SESSION['customer_id']; ?>" />
                        <input type="hidden" name="id_sanpham" value="<?php echo $product_id; ?>" />
                </div>
                <button type="submit">????ng b??nh lu???n</button>
            </form>
            <?php 
                else:
            ?>
                <a href="index.php?action=auth&act=login">Vui l??ng ????ng nh???p</a>
            <?php endif; ?>
            <hr>
            <div class="row">
            <?php 
                $comment = new Comment();
                $result = $comment-> getListCommentProduct($product_id);
                while ($set = $result->fetch()):

            ?>
                <div class="col-md-8">
                    <div class="d-flex flex-column comment-section">
                        <div class="bg-white p-2">
                            <div class="d-flex flex-row user-info">
                                <!-- Ch??? image c?? th??? load h??nh c???a t???ng customer -->
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
        </div>`;
    var text_advice = `<p>Gi&agrave;y ??&aacute; banh ch&iacute;nh h&atilde;ng l&agrave; m???t s???n ph???m v???i c&ocirc;ng n??ng ri&ecirc;ng bi???t, chuy&ecirc;n d&agrave;nh cho nh???ng&nbsp;tr???n thi ?????u b&oacute;ng ??&aacute;, t??? ??&oacute; m&agrave; v???t li???u, thi???t k??? v&agrave; c&aacute;ch thi c&ocirc;ng gi&agrave;y&nbsp;c??ng r???t ri&ecirc;ng, kh&aacute;c v???i nh???ng d&ograve;ng s???n ph???m gi&agrave;y th&ocirc;ng th?????ng. V???y n&ecirc;n ????? c&oacute; ???????c tr???i nghi???m "tr&ecirc;n ch&acirc;n" t???t nh???t, ?????c bi???t l&agrave; v???i nh???ng anh em ch??a c&oacute; nhi???u kinh nghi???m trong vi???c ch???n m???t ??&ocirc;i gi&agrave;y ??&aacute; banh ph&ugrave; h???p v???i m&igrave;nh,&nbsp;th&igrave; anh em c&oacute; th??? theo m???t s??? l???i khuy&ecirc;n c???a ThanhHung Futsal nh?? sau:</p>
            <p><strong>1. Khi ch???n size gi&agrave;y, anh em n&ecirc;n ch???n size m&agrave; khi mang v&agrave;o th&igrave; ph???n m??i gi&agrave;y v&agrave; m??i ch&acirc;n s???&nbsp;v???a v???i nhau&nbsp;( ho???c d?? m??i kho???ng&nbsp;0.5cm ho???c d?? &iacute;t h??n tu??? v&agrave;o c???m gi&aacute;c c???a anh em).</strong></p>
            <p><img style="height: 640px; width: 1280px;" src="https://file.hstatic.net/200000278317/file/trang-break-in-giay-2_8b96a8d5d72d462685947682b1963ea2.jpg" width="600" height="600" data-src="//file.hstatic.net/200000278317/file/trang-break-in-giay-2_8b96a8d5d72d462685947682b1963ea2.jpg"></p>
            <p><strong>2. V???i nh???ng ??&ocirc;i gi&agrave;y ??&aacute; banh m???i "c&oacute;ng" th&igrave; b??? ngang s??? h??i b&oacute; l&agrave;m anh em kh&oacute; ch???u v&agrave;i tr???n ?????u (c&oacute; th??? s??? l&agrave;m anh em m???t phong ????? 1-2 tr???n ?????u lu&ocirc;n), nh??ng t???m tr???n th??? 4,&nbsp;th??? 5 th&igrave; gi&agrave;y&nbsp;s??? b???t ?????u Break-in (gi&agrave;y s??? m???m d???n) v&agrave; b???t ?????u thu???n ch&acirc;n c???a anh em.&nbsp;</strong></p>
            <p><em>L??u &yacute; l&agrave; trong kho???ng th???i gian ????? gi&agrave;y&nbsp;Break-in, khi ra s&acirc;n anh em n??ng n??? ch???y&nbsp;m???t t&yacute; ????? gi&agrave;y nhanh thu???n ch&acirc;n&nbsp;anh em h??n. ?????ng ra s&acirc;n kh???i ?????ng nh???, s??? l&agrave;m gi&agrave;y l&acirc;u Break-in h??n.</em></p>
            <p><img style="height: 640px; width: 1280px;" src="https://file.hstatic.net/200000278317/file/trang-break-in-giay-1_f006461552604f3bb0cccf4fe3b64c5e.jpg" width="600" height="600" data-src="//file.hstatic.net/200000278317/file/trang-break-in-giay-1_f006461552604f3bb0cccf4fe3b64c5e.jpg"></p>
            <p><strong>3.&nbsp;H&atilde;y lu&ocirc;n lu&ocirc;n ??u ti&ecirc;n ?????n c???a h&agrave;ng ????? ???????c ??o k&iacute;ch th?????c ch&acirc;n th???t chu???n, v&agrave; ???????c th??? tr???c ti???p ??&ocirc;i gi&agrave;y tr?????c khi quy???t ?????nh mua. ??? Thanh H&ugrave;ng Futsal, ch&uacute;ng m&igrave;nh lu&ocirc;n c&oacute; b?????c ??o ch&acirc;n b???ng d???ng c??? chuy&ecirc;n d???ng v&agrave; lu&ocirc;n khuy???n kh&iacute;ch c&aacute;c b???n th??? gi&agrave;y th???t k??? tr?????c khi mua.</strong></p>
            <p><img style="height: 640px; width: 1280px;" src="https://file.hstatic.net/200000278317/file/trang-break-in-giay-3_9804664335254ab3940fd6172881d3c7.jpg" width="600" height="600" data-src="//file.hstatic.net/200000278317/file/trang-break-in-giay-3_9804664335254ab3940fd6172881d3c7.jpg"></p>`;
    var text_guarantee = `<p>Thanh H&ugrave;ng Futsal lu&ocirc;n n??? l???c mang ?????n tr???i nghi???m mua s???m tuy???t v???i d&agrave;nh cho Kh&aacute;ch H&agrave;ng t??? vi???c ??a d???ng ho&aacute; m???u m&atilde;&nbsp;t??? nhi???u th????ng hi???u qu???c t??? n???i ti???ng,&nbsp;d???ch v??? t?? v???n b&aacute;n h&agrave;ng online, offline v&agrave; nh???ng d???ch v??? h???u m&atilde;i kh&ocirc;ng ng???ng ???????c ho&agrave;n thi???n.</p>
                <p><img style="height: 640px; width: 1280px;" src="https://file.hstatic.net/200000278317/file/hinh-bao-hanh-2_ab1c35a8dd334a619cb4e6364e50b180.jpg" width="600" height="600" data-src="//file.hstatic.net/200000278317/file/hinh-bao-hanh-2_ab1c35a8dd334a619cb4e6364e50b180.jpg"></p>
                <p>D?????i ??&acirc;y l&agrave; ch&iacute;nh s&aacute;ch b???o h&agrave;nh c???a Thanh H&ugrave;ng Futsal.</p>
                <p><strong>??I???U KI???N B???O H&Agrave;NH</strong></p>
                <p>- Thanh H&ugrave;ng Futsal h??? tr??? kh&aacute;ch h&agrave;ng&nbsp;<strong>b???o h&agrave;nh&nbsp;s???a ch???a 3 th&aacute;ng&nbsp;</strong>mi???n ph&iacute;:</p>
                <ol>
                    <li>S???n ph???m ph???i do ch&iacute;nh Shop Thanh H&ugrave;ng Futsal&nbsp;ph&acirc;n ph???i.</li>
                    <li>S???n ph???m c&ograve;n trong th???i h???n b???o h&agrave;nh v&agrave; b??? h?? h???ng do l???i k??? thu???t c???a Nh&agrave; s???n xu???t:&nbsp;h??? keo, tr&oacute;c ?????,&nbsp;?????t thun, ?????t ch???.</li>
                    <li>Kh&aacute;ch h&agrave;ng ph???i xu???t tr&igrave;nh ???????c phi???u b???o h&agrave;nh s???n ph???m h???p l??? ho???c c&oacute; th&ocirc;ng tin mua h&agrave;ng ?????y ????? tr&ecirc;n h??? th???ng.</li>
                </ol>
                <p>- Thanh H&ugrave;ng Futsal&nbsp;<strong>t??? ch???i b???o h&agrave;nh</strong>&nbsp;s???n ph???m ?????i v???i c&aacute;c tr?????ng h???p:</p>
                <ol>
                    <li>Kh&ocirc;ng c&oacute; th&ocirc;ng tin ho&aacute; ????n mua h&agrave;ng</li>
                    <li>S???n ph???m b??? h?? h???ng v&agrave; l???i t??? ph&iacute;a kh&aacute;ch h&agrave;ng g&acirc;y n&ecirc;n nh?? tr???y x?????c, ????? m&ograve;n, s???n ph???m kh&ocirc;ng c&ograve;n nguy&ecirc;n v???n do b??? ?????ng v???t c???n, b???o qu???n kh&ocirc;ng t???t g&acirc;y ???m m???c, phai n???ng, n&oacute;ng ch???y.</li>
                </ol>
                <p>Sau khi h???t th???i gian b???o h&agrave;nh, shop v???n h??? tr??? s???a ch???a gi&agrave;y v???i chi ph&iacute; h???p l&yacute; t???i c&aacute;c c?? s??? s???a ch???a uy t&iacute;n cho qu&yacute; kh&aacute;ch h&agrave;ng trong su???t qu&aacute; tr&igrave;nh s??? d???ng.</p>
                <p><img style="height: 640px; width: 1280px;" src="https://file.hstatic.net/200000278317/file/hinh-bao-hanh-1_94eef38d32944ad49ab9e2cf105e7b2c.jpg" width="600" height="600" data-src="//file.hstatic.net/200000278317/file/hinh-bao-hanh-1_94eef38d32944ad49ab9e2cf105e7b2c.jpg"></p>
                <p><strong>TH???I GIAN B???O H&Agrave;NH</strong></p>
                <p>X??? l&yacute; v&agrave; trao tr??? s???n ph???m ??&atilde; ???????c s???a ch???a b???o h&agrave;nh cho kh&aacute;ch h&agrave;ng trong kho???ng th???i gian 05 ng&agrave;y l&agrave;m vi???c k??? t??? khi ti???p nh???n s???n ph???m (tr??? c&aacute;c t&igrave;nh hu???ng ?????c bi???t ho???c&nbsp;ph???i t&igrave;m ch???t li???u kh&oacute; ????? thay th???, Shop s??? li&ecirc;n h??? v&agrave; ??&agrave;m ph&aacute;n tr???c ti???p v???i kh&aacute;ch h&agrave;ng).</p>`;

    var defualtext = document.getElementById("text");
    defualtext.innerHTML = product_info;
    var tags = document.getElementsByClassName('view-desc');

    function clickMenu(e, condition) {
        for (let i = 0; i < tags.length; i++) {
            const element = tags[i];
            if (element.id == 'active') {
                element.removeAttribute('id');
            }
        }
        e.setAttribute('id', 'active');
        switch (condition) {
            case 'info':
                defualtext.innerHTML = `<?php echo $product_info ?>`;
                break;
            case 'guarantee':
                defualtext.innerHTML = text_guarantee;
                break;
            case 'advice':
                defualtext.innerHTML = text_advice;
                break;
            case 'comment':
                defualtext.innerHTML = text_comment;
                break;
            default:
                defualtext.innerHTML = `<?php echo $product_info ?>`;
                break;
        }
    }
    $('document').ready(function() {
        tinymce.init({
            selector: '#comment',
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            width: "900",
            height: "300",
            toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
        });

        var menu = $('#view-desc');
        menu.on('click', function() {
            console.log(this.value);
        })

        var option = $('*[data-name="option"]');
        // console.log(option.removeClass("active"));
        $('*[data-name="option"]').click(function() {
            for (let i = 0; i < option.length; i++) {
                const element = option[i];
                option.removeClass("border-5 border-dark");
                $(this).addClass("border-5 border-dark")
            }
            var value = $(this).data('value');
            console.log(value);
            $('#product_size').val(value);
        })

        var trubtn = $('#tru');
        var congbtn = $('#cong');
        var quantity_text = $('#product_quantity')




        $('.owl-carousel-slide').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });
        $('.owl-carousel-thumb').owlCarousel({
            margin: 10,
            loop: true,
            items: 1,
        })
    })

    function checkproduct_quantity(tonkho) {
        var quantity_inStock = tonkho;
        console.log(quantity_inStock);

    }

    function increaseValue() {
        var value = parseInt(document.getElementById('product_quantity').value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('product_quantity').value = value;
    }

    function decreaseValue() {
        var value = parseInt(document.getElementById('product_quantity').value, 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? value = 1 : '';
        value--;
        document.getElementById('product_quantity').value = value;
    }

    $('#addcart').click(function() {
        if (!checkSize() && !checkQuantity()) {
            console.log("kh??ng th??? th??m v??o gi??? h??ng, L???i 1");
        } else if (!checkSize() || !checkQuantity()) {
            alert('Vui l??ng ch???n ')
            console.log("kh??ng th??? th??m v??o gi??? h??ng, L???i 2");
        } else {
            var size = $('#product_size').val();
            var quantity = $('#product_quantity').val();
            var product_id = $('#product_id').val();
            console.log('Size: ', size, "Quantity: ", quantity, "Product ID: ", product_id);
            var product = `<div class="d-flex justify-content-between">
                <img src="../Content/images/<?php echo $product_thumbnail; ?>" style="width: 30%;
                    margin-right: 15px;
                    height: 15%;" alt="">
                <div class="text-start">
                    <p class="text-"><?php echo $product_name ?></p>
                    <p>K??ch th?????c: ${size}</p>
                    <p>Lo???i: <?php echo $menu_name ?></p>
                    <p>S??? l?????ng: ${quantity}</p>
                </div>
            </div>`;

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Th??m v??o gi??? h??ng',
                html: product,
                showConfirmButton: false,
                timer: 100000
            })

            var form = $('#addCartForm')[0];
            var data = new FormData(form);
            $.ajax({
                url: 'index.php?action=cart&act=add_cart',
                type: 'POST',
                dataType: 'text',
                contentType: false,
                processData: false,
                data: data,
                success: function(response) {
                    console.log(response);
                }
            })
        }
    })

    function checkSize() {
        var size = $('#product_size').val();
        if (size == '') {
            return false;
        } else {
            return true;
        }
    }

    function checkQuantity() {
        var quantity = $('#product_quantity').val();
        if (quantity == '') {
            return false;
        } else {
            return true;
        }
    }
    
    $('#post-comment').click(function () {
        console.log("hello ");
        tinyMCE.triggerSave();
        var form = $('#form_comment')[0];
        var data = new FormData(form);
        $.ajax({
            type: "POST",
            url: 'index.php?action=comment&act=post_comment',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function (data) {
                alert("????ng b??nh lu???n th??nh c??ng")
            }
        })
    })
    var buttonComment = document.getElementById("post-comment")
    if (buttonComment) {
        buttonComment.addEventListener("click", function() {
            console.log("hello ");
        })
    } else {
        console.log("Khong ton tai");
    }
</script>