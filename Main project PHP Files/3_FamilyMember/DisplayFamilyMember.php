 <?php
include 'database.php';

$sql = "SELECT * FROM FamilyMembers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Family Members</h2>";
    echo "<table border='1'>
            <tr>
                <th>Family Member ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Social Security Number</th>
                <th>Medicare Card Number</th>
                <th>Telephone Number</th>
                <th>Address</th>
                <th>City</th>
                <th>Province</th>
                <th>Postal Code</th>
                <th>Personnel ID</th>
                <th>Email Address</th>
                <th>Primary Family Member ID</th>
                <th>Actions</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["family_member_id"]. "</td>
                <td>" . $row["first_name"]. "</td>
                <td>" . $row["last_name"]. "</td>
                <td>" . $row["date_of_birth"]. "</td>
                <td>" . $row["social_security_number"]. "</td>
                <td>" . $row["medicare_card_number"]. "</td>
                <td>" . $row["telephone_number"]. "</td>
                <td>" . $row["address"]. "</td>
                <td>" . $row["city"]. "</td>
                <td>" . $row["province"]. "</td>
                <td>" . $row["postal_code"]. "</td>
                <td>" . $row["personnel_id"]. "</td>
                <td>" . $row["email_address"]. "</td>
                <td>" . $row["primary_family_member_id"]. "</td>
                <td>
                    <a href='EditFamilyMember.php?family_member_id=" . $row["family_member_id"]. "'>Edit</a> | 
                    <a href='DeleteFamilyMember.php?family_member_id=" . $row["family_member_id"]. "'>Delete</a>
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
