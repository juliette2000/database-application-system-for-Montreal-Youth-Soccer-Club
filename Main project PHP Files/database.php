<?php
//Change information
$servername = "nnc353.encs.concordia.ca";
$username = "nnc353_1";
$password = "comp353L";
$dbname = "nnc353_1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


