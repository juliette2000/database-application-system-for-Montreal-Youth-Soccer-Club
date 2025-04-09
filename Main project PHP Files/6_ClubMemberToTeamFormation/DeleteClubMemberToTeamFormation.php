<?php
include 'database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['player_id'])) {
    $player_id = $_GET['player_id'];

    // SQL query to delete data
    $sql = "DELETE FROM players WHERE player_id = $player_id";
    header("Location: DisplayTeamFormation1.php");
    if ($conn->query($sql) === TRUE) {
        echo "players deleted from database";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    // Redirect to the members list page after deletion
    
    exit;
} else {
    echo "Invalid request";
}
?>
