<?php
include 'database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['personnel_id'])) {
    $personnel_id = $_GET['personnel_id'];

    // SQL query to delete data
    $sql = "DELETE FROM Personnel WHERE personnel_id = $personnel_id";
header("Location: DisplayPersonnel.php");
    if ($conn->query($sql) === TRUE) {
        echo "Personnel deleted from database";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    // Redirect to the personnel list page after deletion
    
    exit;
} else {
    echo "Invalid request";
}
?>
