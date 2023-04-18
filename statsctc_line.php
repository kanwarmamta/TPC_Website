<?php
require_once 'dbconfig.php';

$sql = "SELECT aBatch as year, MAX(aCtcP) as max_ctc, MIN(aCtcP) as min_ctc, AVG(aCtcP) as avg_ctc, (SELECT AVG(aCtcP) FROM alumni WHERE year) AS median_ctc FROM alumni GROUP BY year ORDER BY year";

$result = $conn->query($sql);

$data = array();
$data[] = array('Year', 'Max CTC', 'Min CTC', 'Avg CTC', 'Median CTC');
while ($row = $result->fetch_assoc()) {
    $year = (INT)$row['year'];
    $max_ctc = $row['max_ctc'];
    $min_ctc = $row['min_ctc'];
    $avg_ctc = $row['avg_ctc'];
    $median_ctc = $row['median_ctc'];
    $data[] = array( $year, (INT)$max_ctc, (INT)$min_ctc, (INT)$avg_ctc, (INT)$median_ctc);
}

$conn->close();

$json_data = json_encode($data);
?>
<html>
<head>
<title>General CTC Trend</title>
</head>
<body>
<h1 style="font-size: 40px; border-bottom: 4px solid #191970; margin-bottom: 10px; padding: 13px; color:#191970; text-align: center;">General CTC Trend</h1>
<?php
echo "
<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
<script type='text/javascript'>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable($json_data);
        console.log('data:', data);
        var options = {
            title: 'CTC Trends by Year',
            curveType: 'function',
            legend: { position: 'bottom' },
            hAxis: {
                title: 'Year',
                viewWindow: {
                    min: new Date(2000, 0, 1)
                }
            },
            vAxis: { title: 'CTC (in LPA)' }
        };
        console.log('options:', options);
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
<div id='chart_div' style='width: 100%; height: 500px;'></div>
";
?>
</body>
</html>