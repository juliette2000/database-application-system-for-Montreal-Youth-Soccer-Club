<?php
include 'database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['location_id'])) {
    $location_id = $_GET['location_id'];

    // SQL query to delete data
    $sql = "DELETE FROM Locations WHERE location_id = $location_id";
header("Location: DisplayLocation.php");
    if ($conn->query($sql) === TRUE) {
        echo "Location deleted from database";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    // Redirect to the locations list page after deletion
    
    exit;
} else {
    echo "Invalid request";
}
?>
