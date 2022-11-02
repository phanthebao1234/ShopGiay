<div class="container-fluid my-5">
  <div class="mx-3 row">
    <div class="col-3 filter">
      <div class="filter_price">
        <h4 class="fw-bold">Giá</h4>
        <form action="" id="filter_price">
          <input type="hidden" name="conditionprice" id="filterPrice">
          <div class="form-check my-3">
            <input class="form-check-input" type="radio" name="filterPrice" id="all" value="" checked="checked" onclick="handleFilterPrice()">
            <label class="form-check-label" for="all">
              Tất cả
            </label>
          </div>
          <div class="form-check my-3">
            <input class="form-check-input" type="radio" name="filterPrice" id="price1" value="price1" onclick="handleFilterPrice()">
            <label class="form-check-label" for="price1">
              Dưới 1,000,000₫
            </label>
          </div>
          <div class="form-check my-3">
            <input class="form-check-input" type="radio" name="filterPrice" id="price2" value="price2" onclick="handleFilterPrice()">
            <label class="form-check-label" for="price2">
              1,000,000₫ - 2,000,000₫
            </label>
          </div>
          <div class="form-check my-3">
            <input class="form-check-input" type="radio" name="filterPrice" id="price3" value="price3" onclick="handleFilterPrice()">
            <label class="form-check-label" for="price3">
              2,000,000₫ - 3,000,000₫
            </label>
          </div>
          <div class="form-check my-3">
            <input class="form-check-input" type="radio" name="filterPrice" id="price4" value="price4" onclick="handleFilterPrice()">
            <label class="form-check-label" for="price4">
              3,000,000₫ - 4,000,000₫
            </label>
          </div>
        </form>
      </div>
      <div class="filter_trademark mt-5">
        <h4 class="fw-bold">Thương hiệu</h4>
        <?php
        $trademark = new Trademark();
        $results = $trademark->getListAllTrademarks();
        while ($set = $results->fetch()) :
        ?>
          <div class="form-check my-3">
            <form id="filter-trademark">
              <input type="hidden" name="filterTrademark" id="trademarkValue">
              <input class="form-check-input" type="checkbox" name="trademark" id="fillterTrademark" value="<?php echo $set['trademark_id'] ?>" onclick="filterTradeMark()">
              <label class="form-check-label" for="<?php echo $set['trademark_name'] ?>">
                <?php echo $set['trademark_name'] ?>
              </label>
            </form>
          </div>
        <?php endwhile ?>
      </div>
    </div>
    <div class="col-9">
      <div class="d-flex justify-content-between">
        <?php
          if (isset($_GET['act']) && $_GET['act'] == 'giayconhantao') {
            echo '<h1 class="text-uppercase fw-bold">Giày Cỏ Nhân Tạo</h1>';
          } else if(isset($_GET['act']) && $_GET['act'] == 'giayfutsal') {
            echo '<h1 class="text-uppercase fw-bold">Giày futsal</h1>';
          } else if(isset($_GET['trademark'])) {
            $trademark = new Trademark();
            $result = $trademark -> getDetailTrademark($_GET['trademark']);
            $trademark_name = $result['trademark_name'];
            echo '<h1 class="text-uppercase fw-bold">Giày '.$trademark_name.'</h1>';
          } else if(isset($_GET['search'])) {
            $keyword = $_POST['keyword'];
            echo '<h1 class="text-uppercase fw-bold">Tìm kiếm sản phẩm cho '.$keyword.'...</h1>';
          } 
          else {
            echo '<h1 class="text-uppercase fw-bold">Tất cả sản phẩm</h1>'; 
          }
        ?>
        
        <div>
          <form action="" id="filter-sort">
            <label for="">Sắp xếp theo: </label>
            <select style="padding: 5px" name="option" id="select-option">
              <option selected="selected" disabled>Sản phẩm nổi bật</option>
              <option value="descPrice">Giá giảm dần</option>
              <option value="ascPrice">Giá tăng dần</option>
              <option value="ascName">Tên từ A -> Z</option>
              <option value="descName">Tên từ Z -> A</option>
            </select>
          </form>
        </div>
      </div>
      <div class="list my-3 row" id="data"> 
        <?php
        $sanpham = new Products();
        if (isset($_GET['act']) && $_GET['act'] == 'giayconhantao') {
          $results = $sanpham->getListProductWithMenu(6);
        } else if (isset($_GET['act']) && $_GET['act'] == 'giayfutsal') {
          $results = $sanpham->getListProductWithMenu(7);
        } else if(isset($_GET['trademark'])) {
          $results = $sanpham->getListProductWithTrademark($_GET['trademark']);
        } else if(isset($_GET['search'])) {
          $keyword = $_POST['keyword'];
          $results = $sanpham -> search($keyword);
          $countValue =  $results->rowCount();
          if($countValue <= 0) {
            echo '<p>Không tìm thấy sản phẩm nào phù hợp</p>';
          }
        }
        else {
          $results = $sanpham->getListProducts();
        } 
        while ($set = $results->fetch()) :
        ?>
          <a href="index.php?action=home&act=detail&id=<?php echo $set['id_sanpham'] ?>" class="card col-lg-3 col-md-4 g-4 border-0 h-100 list-item text-decoration-none">
            <img src="../Content/images/<?php echo $set['Thumbnail'] ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <p class="card-title" style="color: #4c4c4c"><?php echo $set['TenSanPham'] ?></p>
              <?php
                if($set['GiaGiam'] > 0):
              ?>
              <p class="card-text text-danger fw-bold"><span class="text-decoration-line-through"><?php echo number_format($set['GiaSanPham']) ?>₫ </span>&emsp; <span style="font-size: 18px"><?php echo number_format($set['GiaSanPham'] - $set['GiaSanPham']*($set['GiaGiam']/100)) ?>₫</span></p>
              <?php else: ?>
              <p class="card-text text-danger fw-bold"><?php echo number_format($set['GiaSanPham']) ?>₫</p>
              <?php endif; ?>
            </div>
          </a>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>
<script>
  var filterPrice = document.getElementsByName('filterPrice');
  function handleFilterPrice() {
    for (let i = 0; i < filterPrice.length; i++) {
      const element = filterPrice[i];
      if (element.checked) {
        document.getElementById('filterPrice').value = element.value;
        break;
      }
    }
    let form = $('#filter_price')[0];
    let data = new FormData(form);
    $.ajax({
      type: 'POST',
      url: 'View/ajax/filterProduct.php',
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      async: false,

      success: function(data) {
        $('#data').html(data);
      }
    })
  }

  $('#select-option').change(function() {
    var form = $('#filter-sort')[0];
    data = new FormData(form);
    $.ajax({
      type: 'POST',
      url: 'View/ajax/filterProduct.php',
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      async: false,

      success: function(data) {
        $('#data').html(data);
      }
    })
  })

  var trademarkInput = $("input[type='checkbox']");
  console.log(trademarkInput);
  function filterTradeMark() {
    var arrValue = [];
    for (let i = 0; i < trademarkInput.length; i++) {
      const element = trademarkInput[i];
      if (element.checked) {
        arrValue.push(element.value);
      }
    }
    console.log(arrValue);
    $('#trademarkValue').val(arrValue);

    let form = $('#filter-trademark')[0];
    let data = new FormData(form);
    $.ajax({
      type: 'POST',
      url: 'View/ajax/filterProduct.php',
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      async: false,

      success: function(data) {
        $('#data').html(data);
      }
    })
  }

</script>