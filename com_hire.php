<?php
// Database connection details
require_once 'dbconfig.php';

// SQL query to get highest, average, and median CTC year-wise


$sql = "SELECT aBatch AS year, COUNT(DISTINCT aCompP) AS num_companies, COUNT(*) AS num_students FROM alumni GROUP BY year ";

$result = $conn->query($sql);

// Create an array to hold the query results
$data = array();
$data[] = array('year', 'num_companies', 'num_students');
while($row = $result->fetch_assoc()) {
    $data[] = array((int) $row["year"], (int) $row["num_companies"], (int) $row["num_students"]);
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
        0: {title: 'Count'},
        1: {title: 'year'}
      },
      hAxis: {
        title: 'year'
      }
    };

    // Instantiate and draw the chart, passing in the options
    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>

<!-- Create a div to hold the chart -->
<div id="chart_div"></div>