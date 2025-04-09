<?php
include 'database.php';

$sql = "SELECT * FROM ClubMembers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Club Members</h2>";
    echo "<table border='1'>
            <tr>
                <th>Member ID</th>
                <th>Membership Number</th>
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
                <th>Family Member ID</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["member_id"]. "</td>
                <td>" . $row["membership_number"]. "</td>
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
                <td>" . $row["family_member_id"]. "</td>
                <td>" . ($row["active"] ? 'Yes' : 'No') . "</td>
                <td>
                    <a href='EditClubMember.php?member_id=" . $row["member_id"]. "'>Edit</a> | 
                    <a href='DeleteClubMember.php?member_id=" . $row["member_id"]. "'>Delete</a>
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
