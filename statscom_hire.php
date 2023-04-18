<?php
require_once 'dbconfig.php';

$sql = "SELECT aBatch AS year, COUNT(DISTINCT aCompP) AS num_companies, COUNT(*) AS num_students FROM alumni GROUP BY year ";

$result = $conn->query($sql);

$data = array();
$data[] = array('year', 'num_companies', 'num_students');
while($row = $result->fetch_assoc()) {
    $data[] = array($row["year"], (int) $row["num_companies"], (int) $row["num_students"]);
}

$conn->close();

$json_data = json_encode($data);

?>
<html>
  <head>
    <title>Company Hiring Trends</title>
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
        0: {title: 'Count'},
        1: {title: 'Year'}
      },
      hAxis: {
        title: 'Year'
      }
    };

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
            <h1 style="font-size: 40px; border-bottom: 4px solid #191970; margin-bottom: 10px; padding: 13px; color:#191970; text-align: center;">Company Hiring Trends</h1>
            <div id="chart_div" style="width: 50%; height: 500px; margin: 0 auto 0 200px;"></div>
</body>
</html>
