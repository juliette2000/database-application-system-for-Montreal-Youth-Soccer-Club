<?php
require_once 'database.php';

$query = "SELECT l.name, l.address, l.city, l.province, l.postal_code, l.phone_number, l.web_address, l.type, l.capacity, p.first_name AS general_manager_first_name, p.last_name AS general_manager_last_name, COUNT(cm.member_id) AS num_club_members
          FROM Locations l
	  LEFT JOIN ClubMemberDate cmd ON l.location_id = cmd.location_id
          LEFT JOIN ClubMembers cm ON cmd.member_id = cm.member_id
          LEFT JOIN PersonnelLocation g ON l.location_id = g.location_id
          Left join Personnel p ON p.personnel_id =g.personnel_id 
          WHERE p.role = 'Administrator' AND g.end_date IS NULL
          GROUP BY l.location_id, p.first_name, p.last_name
          ORDER BY l.province ASC, l.city ASC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Details</title>
    <style>
        body {
            font-family: Verdana, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: lightgrey;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: lightgrey;
        }
    </style>
</head>
<body>
    <h1>Location Details</h1>
    <a href="index.php" class="home-link">Back to Homepage</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Province</th>
                <th>Postal Code</th>
                <th>Phone Number</th>
                <th>Web Address</th>
                <th>Type</th>
                <th>Capacity</th>
                <th>General Manager Name</th>
                <th>Number of Club Members</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                    <td><?php echo htmlspecialchars($row['city']); ?></td>
                    <td><?php echo htmlspecialchars($row['province']); ?></td>
                    <td><?php echo htmlspecialchars($row['postal_code']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['web_address']); ?></td>
                    <td><?php echo htmlspecialchars($row['type']); ?></td>
                    <td><?php echo htmlspecialchars($row['capacity']); ?></td>
                    <td><?php echo htmlspecialchars($row['general_manager_first_name'] . ' ' . $row['general_manager_last_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['num_club_members']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>

<?php mysqli_close($conn); ?>
