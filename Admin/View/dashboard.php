
<div class="container-fluid">
  <h3 class="text-danger">Tổng doanh thu: <span><?php 
    $order = new Order();
    $total = $order -> getSumTotal();
    if(isset($total)) {
      echo number_format($total['Tổng tiền']);
    } else {
      echo 0;
    }
  ?>đ</span></h3>
  <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
  
  <div class="container-fluid my-5">
    <div class="row">
      <div class="col-lg-4 my-3">
        <div class="text-center" style="
              border: 5px solid blue;
              border-radius: 20px;">
          <h3 class="fw-bold text-primary mt-3">Số lượng đơn hàng</h3>
          <p class="h1 text-primary fw-bold"><?php 
            $order = new Order();
            $countOrder = $order -> getCountOrders();
            echo $countOrder['total']; 
          ?></p>
        </div>
      </div>
      <div class="col-lg-4 my-3">
        <div class="text-center" style="
            border: 5px solid #36b9cc;
            border-radius: 20px;">
          <h3 class="fw-bold text-info mt-3">Số lượng khách hàng</h3>
          <p class="h1 text-info fw-bold"><?php 
            $customer = new Customers();
            $countCustomer = $customer -> getCountCustomer();
            echo $countCustomer['total']; 
          ?></p>
        </div>
      </div>
      <div class="col-lg-4 my-3">
        <div class="text-center" style="
            border: 5px solid #f6c23e;
            border-radius: 20px;">
          <h3 class="fw-bold text-warning mt-3">Số lượng bài viết</h3>
          <p class="h1 text-warning fw-bold"><?php 
            $blog = new Blogs();
            $countBlog = $blog -> getCountBlog();
            echo $countBlog['total']; 
          ?></p>
        </div>
      </div>
      <div class="col-lg-4 my-3">
        <div class="text-center" style="
            border: 5px solid #1cc88a;
            border-radius: 20px;">
          <h3 class="fw-bold text-success mt-3">Số lượng sản phẩm</h3>
          <p class="h1 text-success fw-bold"><?php 
            $product = new Products();
            $countProduct = $product -> getCountProduct();
            echo $countProduct['total']; 
          ?></p>
        </div>
      </div>
      <div class="col-lg-4 my-3">
        <div class="text-center" style="
            border: 5px solid #e74a3b;
            border-radius: 20px;">
          <h3 class="fw-bold text-danger mt-3">Số lượng thương hiệu</h3>
          <p class="h1 text-danger fw-bold"><?php 
            $trademark = new Trademark();
            $countTrademark = $trademark -> getCountTrademark();
            echo $countTrademark['total']; 
          ?></p>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['bar']
  });
  google.charts.setOnLoadCallback(drawChartBar);

  function drawChartBar() {
    var data = google.visualization.arrayToDataTable([
      ['Tháng', 'Tổng doanh thu từng tháng'],
      <?php
      
      $result = $order->getTotalMonth();
      while ($set = $result->fetch()) {
        echo '["' . $set["Tháng"] . '", ' . $set['Tổng tiền'] . '],';
      }
      ?>
    ]);

    var options = {
      chart: {
        title: 'Biểu đồ doanh thu ',
        subtitle: 'Tổng hợp doanh thu của từng tháng trong năm 2022',
      },
      animation:{
        duration: 1000,
        easing: 'out',
      },
      
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
  
</script>