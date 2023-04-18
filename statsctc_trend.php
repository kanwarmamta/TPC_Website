<?php
require_once 'dbconfig.php';

$sql = "SELECT CONCAT('20', SUBSTR(aRollno, 1, 2) + 4) AS year,MAX(aCtcP) AS Highest_CTC, AVG(aCtcP) AS Average_CTC, (SELECT AVG(aCtcP) FROM alumni WHERE year) AS Median_CTC FROM alumni GROUP BY year";

$result = $conn->query($sql);

$data = array();
$data[] = array('year', 'Highest CTC', 'Average CTC', 'Median CTC');
while($row = $result->fetch_assoc()) {
    $data[] = array($row["year"], (int) $row["Highest_CTC"], (int) $row["Average_CTC"], (int) $row["Median_CTC"]);
}

$conn->close();

$json_data = json_encode($data);

?>
<html>
  <head>
    <title>Package Offered Trends</title>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});

  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable(<?php echo $json_data ?>);

    var options = {
      width: 900,
      height: 500,
      legend: { position: 'top', maxLines: 3 },
      isStacked: false,
      seriesType: 'bars',
      series: {
        0: {color: '#191970'},
        1: {color: '#ca135e'},
        2: {color: '#21535b'}
      },
      vAxes: {
        0: {title: 'CTC'},
        1: {title: 'Year'}
      },
      hAxis: {
        title: 'Year'
      }
    };

    // Instantiate and draw the chart, passing in the options
    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>
<style>
      #chart_div {
        width: 50%;
        height: 400px;
        margin: 0 auto;
      }
    </style>
</head>
<body>
            <h1 style="font-size: 40px; border-bottom: 4px solid #191970; margin-bottom: 10px; padding: 13px; color:#191970; text-align: center;">Package Offered Trends</h1>
            <div id="chart_div" style="width: 50%; height: 500px; margin: 0 auto 0 200px;"></div>
</body>
</html>