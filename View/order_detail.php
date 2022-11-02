<div class="container">
    <h1 class="text-danger">Chọn phương thức thanh toán và nhập Voucher</h1>
    <form class="my-3" action="index.php?action=order2&act=order_detail_action" method="POST">
        <div class="d-flex justify-content-evenly">
            <div>
                <h3>Chọn phương thức thanh toán</h3>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="phuongthuc" id="exampleRadios1" value="tructiep" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Thanh toán trức tiếp (0%)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="phuongthuc" id="exampleRadios1" value="momo" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Thanh toán qua Momo (-5% )
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="phuongthuc" id="exampleRadios1" value="nganhang" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Thanh toán bằng tài khoản ngân hàng ( -10% )
                    </label>
                </div>
            </div>
            <div class="">
                <label for="voucher_code" class="form-label h3">Nhập mã giảm giá</label>
                <input type="text" class="form-control" id="voucher_code" placeholder="...." name="voucher_code">
            </div>
        </div>
        <div class="d-flex flex-row-reverse bd-highlight">
            <button type="submit" class="btn btn-danger btn-lg" name="submit">Xác nhận</button>
        </div>
    </form>
</div>