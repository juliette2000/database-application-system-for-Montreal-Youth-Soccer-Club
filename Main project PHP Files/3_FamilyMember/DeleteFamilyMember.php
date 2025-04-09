<?php
include 'database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['family_member_id'])) {
    $family_member_id = $_GET['family_member_id'];

    
    $sql = "DELETE FROM FamilyMembers WHERE family_member_id = $family_member_id";
    header("Location: DisplayFamilyMember.php");
    if ($conn->query($sql) === TRUE) {
        echo "Family member deleted from database";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
   
    exit;
} else {
    echo "Invalid request";
}
?>
