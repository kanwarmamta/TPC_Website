<?php

require_once 'dbconfig.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT SUBSTR(student.stRollno, 5, 2) AS branch_code, COUNT(DISTINCT applied.stRollno) AS student_count FROM student INNER JOIN applied ON student.stRollno = applied.stRollno WHERE applied.status = 'selected' GROUP BY branch_code";
$result = $conn->query($sql);
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$labels = array();
$values = array();
foreach ($data as $row) {
    array_push($labels, $row['branch_code']);
    array_push($values, $row['student_count']);
}

?>
<html>
<head>
    <title>Current Year Branch-wise Selected Students</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Branch', 'Number of Students'],
                <?php
                for ($i = 0; $i < count($labels); $i++) {
                    echo "['" . $labels[$i] . "', " . $values[$i] . "],";
                }
                ?>
            ]);

            var options = {
                pieHole: 0,
                colors: ['#191970', '#ca135e', '#21535b', '#392b44', '#5a00b4', '#009999', '#006600']
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);

            // Second chart
            var data2 = google.visualization.arrayToDataTable([
                ['Branch', 'Number of Students'],
                <?php
                for ($i = 0; $i < count($labels); $i++) {
                    echo "['" . $labels[$i] . "', " . $values[$i] . "],";
                }
                ?>
               
            ]);

            var options2 = {
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
        title: 'Branch'
      }            };

            var chart2 = new google.visualization.ColumnChart(document.getElementById('columnchart'));
            chart2.draw(data2, options2);
        }
    </script>
</head>
<body>
        <div class="box">
            <h1 style="font-size: 40px; border-bottom: 4px solid #191970; margin-bottom: 10px; padding: 13px; color:#191970; text-align: center;">Branch-wise Selected Students</h1>
    <div id="piechart" style="width: 49%; height: 500px; display: inline-block;"></div>
    <div id="columnchart" style="width: 49%; height: 500px; display: inline-block;"></div>
    </div>
</body>
</html>