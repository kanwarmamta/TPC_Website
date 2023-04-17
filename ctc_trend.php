<?php
// Database connection details
require_once 'dbconfig.php';

// SQL query to get highest, average, and median CTC year-wise
$sql = "SELECT CONCAT('20', SUBSTR(aRollno, 1, 2) + 4) AS year,MAX(aCtcP) AS Highest_CTC, AVG(aCtcP) AS Average_CTC, (SELECT AVG(aCtcP) FROM alumni WHERE year) AS Median_CTC FROM alumni GROUP BY year";

$result = $conn->query($sql);

// Create an array to hold the query results
$data = array();
$data[] = array('year', 'Highest CTC', 'Average CTC', 'Median CTC');
while($row = $result->fetch_assoc()) {
    $data[] = array($row["year"], (int) $row["Highest_CTC"], (int) $row["Average_CTC"], (int) $row["Median_CTC"]);
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
    var data = google.visualization.arrayToDataTable(<?php echo $json_data ?>);

    // Set chart options
    var options = {
      title: 'CTC Year-wise Comparison',
      width: 900,
      height: 500,
      legend: { position: 'top', maxLines: 3 },
      isStacked: false,
      seriesType: 'bars',
      series: {
        0: {color: '#FF0000'},
        1: {color: '#00FF00'},
        2: {color: '#0000FF'}
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

<!-- Create a div to hold the chart -->
<div id="chart_div"></div>