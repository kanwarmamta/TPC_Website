<?php
// Database connection details
require_once 'dbconfig.php';

// SQL query to get highest, average, and median CTC year-wise
$sql = "SELECT CONCAT('20', SUBSTR(aRollno, 1, 2) + 4) AS year, COUNT(DISTINCT aCompP) AS count FROM alumni GROUP BY year  ORDER BY year ASC";

$result = $conn->query($sql);

// Create an array to hold the query results
$data = array();
$data[] = array('year', 'count');
while($row = $result->fetch_assoc()) {
    $data[] = array($row["year"], (int)$row["count"]);
}

// Close database connection
$conn->close();

// Convert the data array to JSON format
$json_data = json_encode($data);

?>

<!-- Include Google Charts library -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- Load the visualization library and the corechart package -->
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    // Create the data table from JSON data
    var data = new google.visualization.arrayToDataTable(<?php echo $json_data ?>);

    // Set chart options
    var options = {
      title: 'CTC Year-wise Comparison',
      width: 900,
      height: 500,
      legend: { position: 'top', maxLines: 3 },
      bar: { groupWidth: '75%' },
      isStacked: true,
      colors: ['#FF0000', '#00FF00', '#0000FF'] // Set different colors for each column
    };

    // Instantiate and draw the chart, passing in the options
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>

<!-- Create a div to hold the chart -->
<div id="chart_div"></div>