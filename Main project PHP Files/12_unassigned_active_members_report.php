<?php

require_once 'database.php';

$query = "
    SELECT 
        cm.membership_number,
        cm.first_name,
        cm.last_name,
        TIMESTAMPDIFF(YEAR, cm.date_of_birth, CURDATE()) AS age,
        cm.telephone_number,
        fm.email_address AS email,
        l.name AS current_location_name
    FROM 
        ClubMembers cm
    LEFT JOIN 
        players p ON cm.member_id = p.club_member_id
    LEFT JOIN 
        teamformations tf ON p.formation_id = tf.formation_id
    LEFT JOIN 
        Teams t ON tf.team_id = t.TeamID
    LEFT JOIN
	ClubMemberDate cmd ON cm.member_id = cmd.member_id
    LEFT JOIN 
        Locations l ON cmd.location_id = l.location_id
    LEFT JOIN 
        FamilyMembers fm ON cm.family_member_id = fm.family_member_id
    WHERE 
        cm.active = TRUE
        AND p.club_member_id IS NULL
    ORDER BY 
        l.name ASC, 
        cm.membership_number ASC;
";

$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$details = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Club Members Without Assignments Report</title>
    <style>
        body {
            font-family: Verdana, sans-serif;
            margin: 20px;
            padding: 0;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: lightgrey;
        }
    </style>
</head>
<body>
    <h1>Active Club Members Without Team Assignments</h1>
    <a href="index.php" class="home-link">Back to Homepage</a>
    <table>
        <thead>
            <tr>
                <th>Membership Number</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Current Location Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($details as $detail): ?>
            <tr>
                <td><?php echo htmlspecialchars($detail['membership_number']); ?></td>
                <td><?php echo htmlspecialchars($detail['first_name']); ?></td>
                <td><?php echo htmlspecialchars($detail['last_name']); ?></td>
                <td><?php echo htmlspecialchars($detail['age']); ?></td>
                <td><?php echo htmlspecialchars($detail['telephone_number']); ?></td>
                <td><?php echo htmlspecialchars($detail['email']); ?></td>
                <td><?php echo htmlspecialchars($detail['current_location_name']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<?php

$conn->close();
?>
