<?php

require_once 'database.php';

$details = [];

// SQL query
$query = "
    SELECT DISTINCT cm.*
FROM ClubMembers cm
WHERE cm.member_id NOT IN (
    SELECT cm.member_id
    FROM ClubMembers cm
    LEFT JOIN players p ON cm.member_id = p.club_member_id
    LEFT JOIN teamformations tf ON p.formation_id = tf.formation_id
    LEFT JOIN opponent o ON tf.formation_id = o.formation_id
    LEFT JOIN teamformations opp_tf ON o.opponent_id = opp_tf.formation_id
    WHERE tf.score < opp_tf.score
)
ORDER BY 
    (SELECT l.name FROM Locations l WHERE l.location_id = cmd.locations_id) ASC,
    cm.membership_number ASC;
";

// Prepare and execute the query
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
    <title>Active Club Members Report</title>
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
    <h1>Active Club Members Who Never Lost a Game</h1>
    <table>
        <thead>
            <tr>
                <th>Membership Number</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Location</th>
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
                <td><?php echo htmlspecialchars($detail['email_address']); ?></td>
                <td><?php echo htmlspecialchars($detail['location_name']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
