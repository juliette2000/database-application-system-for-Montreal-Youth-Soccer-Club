<?php
include 'database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['member_id'])) {
    $member_id = $_GET['member_id'];

    // SQL query to delete data
    $sql = "DELETE FROM ClubMembers WHERE member_id = $member_id";
    header("Location: DisplayClubMember.php");
    if ($conn->query($sql) === TRUE) {
        echo "Club member deleted from database";
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
