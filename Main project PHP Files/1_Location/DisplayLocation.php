<?php
include 'database.php';

$sql = "SELECT * FROM Locations";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Locations</h2>";
    echo "<table border='1'>
            <tr>
                <th>Location ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Province</th>
                <th>Postal Code</th>
                <th>Phone Number</th>
                <th>Web Address</th>
                <th>Type</th>
                <th>Capacity</th>
                <th>Actions</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["location_id"]. "</td>
                <td>" . $row["name"]. "</td>
                <td>" . $row["address"]. "</td>
                <td>" . $row["city"]. "</td>
                <td>" . $row["province"]. "</td>
                <td>" . $row["postal_code"]. "</td>
                <td>" . $row["phone_number"]. "</td>
                <td>" . $row["web_address"]. "</td>
                <td>" . $row["type"]. "</td>
                <td>" . $row["capacity"]. "</td>
                <td>
                    <a href='EditLocation.php?location_id=" . $row["location_id"]. "'>Edit</a> | 
                    <a href='DeleteLocation.php?location_id=" . $row["location_id"]. "'>Delete</a>
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
