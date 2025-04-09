<?php

require_once 'database.php';

$query = "
    SELECT 
        l.name AS location_name,
        COUNT(CASE WHEN tf.session_type = 'Training' THEN 1 END) AS total_training,
        COALESCE(SUM(CASE WHEN tf.session_type = 'Training' THEN player_count ELSE 0 END), 0) AS total_players_in_training,
        COUNT(CASE WHEN tf.session_type = 'Game' THEN 1 END) AS total_game,
        COALESCE(SUM(CASE WHEN tf.session_type = 'Game' THEN player_count ELSE 0 END), 0) AS total_players_in_game
    FROM 
        Locations l
    LEFT JOIN 
        Teams t ON l.location_id = t.location_id
    LEFT JOIN 
        teamformations tf ON t.TeamID = tf.team_id AND tf.session_date BETWEEN '2024-08-01' AND '2024-08-05'
    LEFT JOIN 
        (SELECT formation_id, COUNT(*) AS player_count FROM players GROUP BY formation_id) p ON tf.formation_id = p.formation_id
    GROUP BY 
        l.location_id
    HAVING 
        COUNT(tf.session_type = 'Game') >= 3
    ORDER BY 
        total_game DESC;
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
    <title>Teams Formation Report</title>
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
    <h1>Teams Formation Report (2024-08-01 to 2024-08-05)</h1>
    <table>
        <thead>
            <tr>
                <th>Location Name</th>
                <th>Total Training Sessions</th>
                <th>Total Players in Training Sessions</th>
                <th>Total Game Sessions</th>
                <th>Total Players in Game Sessions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($details as $detail): ?>
            <tr>
                <td><?php echo htmlspecialchars($detail['location_name']); ?></td>
                <td><?php echo htmlspecialchars($detail['total_training']); ?></td>
                <td><?php echo htmlspecialchars($detail['total_players_in_training']); ?></td>
                <td><?php echo htmlspecialchars($detail['total_game']); ?></td>
                <td><?php echo htmlspecialchars($detail['total_players_in_game']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<?php

$conn->close();
?>
