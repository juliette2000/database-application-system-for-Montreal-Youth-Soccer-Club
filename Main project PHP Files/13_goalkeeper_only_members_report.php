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
    JOIN 
        players p ON cm.member_id = p.club_member_id
    JOIN 
        teamformations tf ON p.formation_id = tf.formation_id
    JOIN 
        Teams t ON tf.team_id = t.TeamID
    JOIN 
        Locations l ON t.location_id = l.location_id
    LEFT JOIN 
        players p2 ON cm.member_id = p2.club_member_id AND p2.role != 'Goalkeeper'
    LEFT JOIN 
        FamilyMembers fm ON cm.family_member_id = fm.family_member_id
    WHERE 
        cm.active = TRUE
        AND p2.club_member_id IS NULL
    GROUP BY 
        cm.member_id
    ORDER BY 
        l.name ASC, 
        cm.membership_number ASC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goalkeeper Report</title>
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
    <h1>Goalkeeper Report</h1>
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
                <th>Current Location</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['membership_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['age']); ?></td>
                    <td><?php echo htmlspecialchars($row['telephone_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['current_location_name']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>

<?php mysqli_close($conn); ?>
 
