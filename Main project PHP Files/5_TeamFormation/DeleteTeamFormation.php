<?php
include 'database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['formation_id'])) {
    $formation_id = $_GET['formation_id'];

    
    $sql = "DELETE FROM teamformations WHERE formation_id = $formation_id";
    header("Location: DisplayTeamFormations.php");
    if ($conn->query($sql) === TRUE) {
        echo "Team formation deleted from database";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
   
    exit;
} else {
    echo "Invalid request";
}
?>
