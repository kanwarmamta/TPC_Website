<?php
session_start();
require_once 'dbconfig.php';

// Check if the query parameter is set
if(isset($_POST['stquery'])) {
    // Get the input data from the form
    $stquery = $_POST['stquery'];
    $stRollno = $_SESSION["stRollnonew"];
    $stName = $_SESSION["stNamenew"];
    $stWebmail = $_SESSION["stWebmailnew"];
    $qStatus = "pending";

    // Prepare the query
    $stmt = $conn->prepare("INSERT INTO stqueries (stRollno, stName, stWebmail, stquery, qStatus) VALUES (?, ?, ?, ?, ?)");

    // Bind the parameters to the prepared statement
    $stmt->bind_param("sssss", $stRollno, $stName, $stWebmail, $stquery, $qStatus);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Query submitted successfully.";
    } else {
        echo "Error submitting query: " . $stmt->error;
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    echo "No query provided.";
}
?>