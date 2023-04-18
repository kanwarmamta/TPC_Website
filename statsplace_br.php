<?php
require_once 'dbconfig.php';

$sql = "SELECT SUBSTR(aRollno, 5, 2) AS branch_code, COUNT(*) AS student_count FROM alumni GROUP BY branch_code";

$result = $conn->query($sql);

$data = array();
$data[] = array('branch_code', 'student_count');
while($row = $result->fetch_assoc()) {
    $data[] = array($row["branch_code"], (int)$row["student_count"]);
}

$conn->close();

$json_data = json_encode($data);

?>
<html>
  <head>
    <title>Branch-wise Comparison</title>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});

  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = new google.visualization.arrayToDataTable(<?php echo $json_data ?>);

    var options = {
      width: 900,
      height: 500,
      legend: { position: 'top', maxLines: 3 },
      bar: { groupWidth: '20%' },
      isStacked: true,
      colors: ['#191970', '#ca135e', '#21535b'] // Set different colors for each column
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
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
            <h1 style="font-size: 40px; border-bottom: 4px solid #191970; margin-bottom: 10px; padding: 13px; color:#191970; text-align: center;">Branch-wise Comparison</h1>
            <div id="chart_div" style="width: 50%; height: 500px; margin: 0 auto 0 200px;"></div>
</body>
</html>