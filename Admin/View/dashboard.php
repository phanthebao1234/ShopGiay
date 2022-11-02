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