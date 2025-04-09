<?php
include 'database.php';

$sql = "SELECT * FROM Personnel";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Personnel</h2>";
    echo "<table border='1'>
            <tr>
                <th>Personnel ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>SSN</th>
                <th>Medicare Number</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>City</th>
                <th>Province</th>
                <th>Postal Code</th>
                <th>Email</th>
                <th>Role</th>
                <th>Mandate</th>
                <th>Actions</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["personnel_id"] . "</td>
                <td>" . $row["first_name"] . "</td>
                <td>" . $row["last_name"] . "</td>
                <td>" . $row["date_of_birth"] . "</td>
                <td>" . $row["ssn"] . "</td>
                <td>" . $row["medicare_number"] . "</td>
                <td>" . $row["phone_number"] . "</td>
                <td>" . $row["address"] . "</td>
                <td>" . $row["city"] . "</td>
                <td>" . $row["province"] . "</td>
                <td>" . $row["postal_code"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["role"] . "</td>
                <td>" . $row["mandate"] . "</td>
                <td>
                    <a href='EditPersonnel.php?personnel_id=" . $row["personnel_id"] . "'>Edit</a> | 
                    <a href='DeletePersonnel.php?personnel_id=" . $row["personnel_id"] . "'>Delete</a>
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
