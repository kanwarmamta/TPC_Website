<?php
require_once 'dbconfig.php';

$sql = "SELECT CONCAT('20', SUBSTR(aRollno, 1, 2) + 4) AS passout_year, COUNT(*) AS student_count FROM alumni where aCompP='TCS' GROUP BY passout_year";

$result = $conn->query($sql);

$data = array();
$data[] = array('passout_year', 'student_count');
while($row = $result->fetch_assoc()) {
    $data[] = array($row["passout_year"], (int)$row["student_count"]);
}

$conn->close();

$json_data = json_encode($data);

?>
<html>
  <head>
    <title>TCS Trends</title>
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
      series: {
        0: {color: '#191970'},
        1: {color: '#ca135e'},
        2: {color: '#21535b'}
      },
      vAxis: {
      title: 'No. of Students'
       
      },
      hAxis: {
        title: 'Year'
      }
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
            <h1 style="font-size: 40px; border-bottom: 4px solid #191970; margin-bottom: 10px; padding: 13px; color:#191970; text-align: center;">TCS Trends</h1>
<div id="chart_div" style="width: 50%; height: 500px; margin: 0 auto 0 200px;"></div>
    </body>
    </html>