<?php
require_once 'dbconfig.php';
// SQL query to fetch data for line graph
$sql = "SELECT aBatch as year, MAX(aCtcP) as max_ctc, MIN(aCtcP) as min_ctc, AVG(aCtcP) as avg_ctc, (SELECT AVG(aCtcP) FROM alumni WHERE year) AS median_ctc FROM alumni GROUP BY aBatch ORDER BY aBatch";

// Execute the query and get the results
$result = $conn->query($sql);

// Create an array to store the data
$data = array();
$data[] = array('Year', 'Max CTC', 'Min CTC', 'Avg CTC', 'Median CTC');
while ($row = $result->fetch_assoc()) {
    $year = (INT)$row['year'];
    $max_ctc = $row['max_ctc'];
    $min_ctc = $row['min_ctc'];
    $avg_ctc = $row['avg_ctc'];
    $median_ctc = $row['median_ctc'];
    $data[] = array((INT) $year, (INT)$max_ctc, (INT)$min_ctc, (INT)$avg_ctc, (INT)$median_ctc);
}

// Close the database connection
$conn->close();

// Convert the data array to JSON format
$json_data = json_encode($data);

// Create the line chart using the Google Charts API
echo "
<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
<script type='text/javascript'>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable($json_data);

        var options = {
            title: 'CTC Trends by Year',
            curveType: 'function',
            legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

        chart.draw(data, options);
    }
</script>

<div id='chart_div' style='width: 100%; height: 500px;'></div>
";
?>