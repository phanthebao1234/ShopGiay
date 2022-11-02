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
                    <p>Loại: <span><?php echo $menu_desc; ?></span> | Mã SP: <?php echo $product_id ?></p>
                </div>
                <div class="detail_info-price">
                    <?php
                    if ($product_sale == 0) {
                        echo '<span class="detail_info-price-unsale">' . number_format($product_price) . '₫</span>';
                    } else {
                        echo '<span class="detail_info-price-sale text-decoration-line-through">' . number_format($product_price) . '₫</span>';
                        echo '<span class="detail_info-price-sale">&emsp;' . number_format($product_price_sale) . '₫</span>';
                    }
                    ?>
                </div>
                <div class="detail_info-size">
                    <span class="detail_info-size-name">Kích thước</span>
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
                            Số lượng
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
                            echo '<button type="button" class="btn btn-danger btn-lg" id="addcart">Thêm vào giỏ hàng</button>';
                        } else {
                            echo '<a class="btn btn-warning btn-lg" href="index.php?action=auth&act=login">Vui lòng đăng nhập</a>';
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
                            <h3 class="text-uppdercase">ƯU ĐÃI TẶNG KÈM</h3>
                            <p>Tặng kèm vớ dệt kim và balô chống thấm đựng giày cho mỗi đơn hàng Giày đá bóng trên 1 triệu.</p>
                        </div>
                    </div>
                    <div class="detail_info-policy-item">
                        <div class="detail_info-policy-item-logo">
                            <img src="../Content/images/pd_policy_2_img.png" alt="">
                        </div>
                        <div class="detail_info-policy-item-desc">
                            <h3 class="text-uppdercase">ĐỔI HÀNG DỄ DÀNG</h3>
                            <p>Hỗ trợ khách hàng đổi size hoặc mẫu trong vong 7 ngày. (Sản phẩm chưa qua sử dụng).</p>
                        </div>
                    </div>
                    <div class="detail_info-policy-item">
                        <div class="detail_info-policy-item-logo">
                            <img src="../Content/images/pd_policy_3_img.png" alt="">
                        </div>
                        <div class="detail_info-policy-item-desc">
                            <h3 class="text-uppdercase">CHÍNH SÁCH GIAO HÀNG</h3>
                            <p>COD Toàn quốc | Freeship toàn quốc khi khách hàng thanh toán chuyển khoản trước với đơn hàng Giày đá bóng trên 1 triệu.</p>
                        </div>
                    </div>
                    <div class="detail_info-policy-item">
                        <div class="detail_info-policy-item-logo">
                            <img src="../Content/images/pd_policy_4_img.png" alt="">
                        </div>
                        <div class="detail_info-policy-item-desc">
                            <h3 class="text-uppdercase">THANH TOÁN TIỆN LỢI</h3>
                            <p>Chấp nhận các loại hình thanh toán bằng thẻ, tiền mặt, chuyển khoản.</p>
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
                    <p>mô tả sản phẩm</p>
                </li>
                <li class="view-desc" onclick="clickMenu(this, 'guarantee')">
                    <p>chính sách bảo hành</p>
                </li>
                <li class="view-desc" onclick="clickMenu(this, 'advice')">
                    <p>lời khuyên chọn giày</p>
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
    var text_advice = `<p>Gi&agrave;y đ&aacute; banh ch&iacute;nh h&atilde;ng l&agrave; một sản phẩm với c&ocirc;ng năng ri&ecirc;ng biệt, chuy&ecirc;n d&agrave;nh cho những&nbsp;trận thi đấu b&oacute;ng đ&aacute;, từ đ&oacute; m&agrave; vật liệu, thiết kế v&agrave; c&aacute;ch thi c&ocirc;ng gi&agrave;y&nbsp;cũng rất ri&ecirc;ng, kh&aacute;c với những d&ograve;ng sản phẩm gi&agrave;y th&ocirc;ng thường. Vậy n&ecirc;n để c&oacute; được trải nghiệm "tr&ecirc;n ch&acirc;n" tốt nhất, đặc biệt l&agrave; với những anh em chưa c&oacute; nhiều kinh nghiệm trong việc chọn một đ&ocirc;i gi&agrave;y đ&aacute; banh ph&ugrave; hợp với m&igrave;nh,&nbsp;th&igrave; anh em c&oacute; thể theo một số lời khuy&ecirc;n của ThanhHung Futsal như sau:</p>
            <p><strong>1. Khi chọn size gi&agrave;y, anh em n&ecirc;n chọn size m&agrave; khi mang v&agrave;o th&igrave; phần mũi gi&agrave;y v&agrave; mũi ch&acirc;n sẽ&nbsp;vừa với nhau&nbsp;( hoặc dư mũi khoảng&nbsp;0.5cm hoặc dư &iacute;t hơn tuỳ v&agrave;o cảm gi&aacute;c của anh em).</strong></p>
            <p><img style="height: 640px; width: 1280px;" src="https://file.hstatic.net/200000278317/file/trang-break-in-giay-2_8b96a8d5d72d462685947682b1963ea2.jpg" width="600" height="600" data-src="//file.hstatic.net/200000278317/file/trang-break-in-giay-2_8b96a8d5d72d462685947682b1963ea2.jpg"></p>
            <p><strong>2. Với những đ&ocirc;i gi&agrave;y đ&aacute; banh mới "c&oacute;ng" th&igrave; bề ngang sẽ hơi b&oacute; l&agrave;m anh em kh&oacute; chịu v&agrave;i trận đầu (c&oacute; thể sẽ l&agrave;m anh em mất phong độ 1-2 trận đầu lu&ocirc;n), nhưng tầm trận thứ 4,&nbsp;thứ 5 th&igrave; gi&agrave;y&nbsp;sẽ bắt đầu Break-in (gi&agrave;y sẽ mềm dần) v&agrave; bắt đầu thuần ch&acirc;n của anh em.&nbsp;</strong></p>
            <p><em>Lưu &yacute; l&agrave; trong khoảng thời gian để gi&agrave;y&nbsp;Break-in, khi ra s&acirc;n anh em năng nổ chạy&nbsp;một t&yacute; để gi&agrave;y nhanh thuần ch&acirc;n&nbsp;anh em hơn. Đừng ra s&acirc;n khởi động nhẹ, sẽ l&agrave;m gi&agrave;y l&acirc;u Break-in hơn.</em></p>
            <p><img style="height: 640px; width: 1280px;" src="https://file.hstatic.net/200000278317/file/trang-break-in-giay-1_f006461552604f3bb0cccf4fe3b64c5e.jpg" width="600" height="600" data-src="//file.hstatic.net/200000278317/file/trang-break-in-giay-1_f006461552604f3bb0cccf4fe3b64c5e.jpg"></p>
            <p><strong>3.&nbsp;H&atilde;y lu&ocirc;n lu&ocirc;n ưu ti&ecirc;n đến cửa h&agrave;ng để được đo k&iacute;ch thước ch&acirc;n thật chuẩn, v&agrave; được thử trực tiếp đ&ocirc;i gi&agrave;y trước khi quyết định mua. Ở Thanh H&ugrave;ng Futsal, ch&uacute;ng m&igrave;nh lu&ocirc;n c&oacute; bước đo ch&acirc;n bằng dụng cụ chuy&ecirc;n dụng v&agrave; lu&ocirc;n khuyến kh&iacute;ch c&aacute;c bạn thử gi&agrave;y thật kỹ trước khi mua.</strong></p>
            <p><img style="height: 640px; width: 1280px;" src="https://file.hstatic.net/200000278317/file/trang-break-in-giay-3_9804664335254ab3940fd6172881d3c7.jpg" width="600" height="600" data-src="//file.hstatic.net/200000278317/file/trang-break-in-giay-3_9804664335254ab3940fd6172881d3c7.jpg"></p>`;
    var text_guarantee = `<p>Thanh H&ugrave;ng Futsal lu&ocirc;n nỗ lực mang đến trải nghiệm mua sắm tuyệt vời d&agrave;nh cho Kh&aacute;ch H&agrave;ng từ việc đa dạng ho&aacute; mẫu m&atilde;&nbsp;từ nhiều thương hiệu quốc tế nổi tiếng,&nbsp;dịch vụ tư vấn b&aacute;n h&agrave;ng online, offline v&agrave; những dịch vụ hậu m&atilde;i kh&ocirc;ng ngừng được ho&agrave;n thiện.</p>
                <p><img style="height: 640px; width: 1280px;" src="https://file.hstatic.net/200000278317/file/hinh-bao-hanh-2_ab1c35a8dd334a619cb4e6364e50b180.jpg" width="600" height="600" data-src="//file.hstatic.net/200000278317/file/hinh-bao-hanh-2_ab1c35a8dd334a619cb4e6364e50b180.jpg"></p>
                <p>Dưới đ&acirc;y l&agrave; ch&iacute;nh s&aacute;ch bảo h&agrave;nh của Thanh H&ugrave;ng Futsal.</p>
                <p><strong>ĐIỀU KIỆN BẢO H&Agrave;NH</strong></p>
                <p>- Thanh H&ugrave;ng Futsal hỗ trợ kh&aacute;ch h&agrave;ng&nbsp;<strong>bảo h&agrave;nh&nbsp;sửa chữa 3 th&aacute;ng&nbsp;</strong>miễn ph&iacute;:</p>
                <ol>
                    <li>Sản phẩm phải do ch&iacute;nh Shop Thanh H&ugrave;ng Futsal&nbsp;ph&acirc;n phối.</li>
                    <li>Sản phẩm c&ograve;n trong thời hạn bảo h&agrave;nh v&agrave; bị hư hỏng do lỗi kỹ thuật của Nh&agrave; sản xuất:&nbsp;hở keo, tr&oacute;c đế,&nbsp;đứt thun, đứt chỉ.</li>
                    <li>Kh&aacute;ch h&agrave;ng phải xuất tr&igrave;nh được phiếu bảo h&agrave;nh sản phẩm hợp lệ hoặc c&oacute; th&ocirc;ng tin mua h&agrave;ng đầy đủ tr&ecirc;n hệ thống.</li>
                </ol>
                <p>- Thanh H&ugrave;ng Futsal&nbsp;<strong>từ chối bảo h&agrave;nh</strong>&nbsp;sản phẩm đối với c&aacute;c trường hợp:</p>
                <ol>
                    <li>Kh&ocirc;ng c&oacute; th&ocirc;ng tin ho&aacute; đơn mua h&agrave;ng</li>
                    <li>Sản phẩm bị hư hỏng v&agrave; lỗi từ ph&iacute;a kh&aacute;ch h&agrave;ng g&acirc;y n&ecirc;n như trầy xước, đế m&ograve;n, sản phẩm kh&ocirc;ng c&ograve;n nguy&ecirc;n vẹn do bị động vật cắn, bảo quản kh&ocirc;ng tốt g&acirc;y ẩm mốc, phai nắng, n&oacute;ng chảy.</li>
                </ol>
                <p>Sau khi hết thời gian bảo h&agrave;nh, shop vẫn hỗ trợ sửa chữa gi&agrave;y với chi ph&iacute; hợp l&yacute; tại c&aacute;c cơ sở sửa chữa uy t&iacute;n cho qu&yacute; kh&aacute;ch h&agrave;ng trong suốt qu&aacute; tr&igrave;nh sử dụng.</p>
                <p><img style="height: 640px; width: 1280px;" src="https://file.hstatic.net/200000278317/file/hinh-bao-hanh-1_94eef38d32944ad49ab9e2cf105e7b2c.jpg" width="600" height="600" data-src="//file.hstatic.net/200000278317/file/hinh-bao-hanh-1_94eef38d32944ad49ab9e2cf105e7b2c.jpg"></p>
                <p><strong>THỜI GIAN BẢO H&Agrave;NH</strong></p>
                <p>Xử l&yacute; v&agrave; trao trả sản phẩm đ&atilde; được sửa chữa bảo h&agrave;nh cho kh&aacute;ch h&agrave;ng trong khoảng thời gian 05 ng&agrave;y l&agrave;m việc kể từ khi tiếp nhận sản phẩm (trừ c&aacute;c t&igrave;nh huống đặc biệt hoặc&nbsp;phải t&igrave;m chất liệu kh&oacute; để thay thế, Shop sẽ li&ecirc;n hệ v&agrave; đ&agrave;m ph&aacute;n trực tiếp với kh&aacute;ch h&agrave;ng).</p>`;

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
            default:
                defualtext.innerHTML = `<?php echo $product_info ?>`;
                break;
        }
    }
    $('document').ready(function() {


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
            console.log("không thể thêm vào giỏ hàng, Lỗi 1");
        } else if (!checkSize() || !checkQuantity()) {
            alert('Vui lòng chọn ')
            console.log("không thể thêm vào giỏ hàng, Lỗi 2");
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
                    <p>Kích thước: ${size}</p>
                    <p>Loại: <?php echo $menu_name ?></p>
                    <p>Số lượng: ${quantity}</p>
                </div>
            </div>`;

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Thêm vào giỏ hàng',
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
</script>