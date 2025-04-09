<?php
require_once 'database.php';

// Check if form data is submitted and retrieve the input values
$location_id = isset($_GET['location_id']) ? $_GET['location_id'] : '';
$day = isset($_GET['day']) ? $_GET['day'] : '';
$team_formations = [];

if ($location_id && $day) {
    // Updated query with LEFT JOIN to include all formations even if there are no players
    $query = "
        SELECT
		p.first_name AS coach_first_name,
        p.last_name AS coach_last_name,
        tf.session_time AS start_time,
        l.name AS address,
        tf.session_type AS nature,
        t.TeamName AS team_name,
        CASE 
            WHEN tf.session_date > ? THEN NULL
            ELSE tf.score
        END AS score,
        cm.first_name AS player_first_name,
        cm.last_name AS player_last_name,
        pl.role
FROM teamformations tf
left JOIN Teams t ON tf.team_id = t.TeamID
left JOIN Locations l ON t.location_id = l.location_id 
left JOIN Personnel p ON t.HeadCoachID = p.personnel_id
LEFT JOIN players pl ON pl.formation_id = tf.formation_id
LEFT JOIN ClubMembers cm ON pl.club_member_id = cm.member_id
WHERE tf.team_id IN (
        SELECT TeamID 
        FROM Teams
        WHERE location_id = ?
    ) 
    AND tf.session_date = ?
    ORDER BY tf.session_time ASC
    ";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("sss", $day, $location_id, $day); 
        $stmt->execute();
        $result = $stmt->get_result();
        $team_formations = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    } else {
        echo "Failed to prepare SQL statement: " . $conn->error;
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Formations</title>
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
        .header {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Team Formations</h1>
    <form method="get" action="">
        <label for="location_id">Location ID:</label>
        <input type="text" id="location_id" name="location_id" value="<?php echo htmlspecialchars($location_id); ?>" required>
        <br><br>
        <label for="day">Date (MM-DD-YYYY):</label>
        <input type="date" id="day" name="day" value="<?php echo htmlspecialchars($day); ?>" required>
        <br><br>
        <input type="submit" value="Search">
    </form>

    <?php if ($location_id && $day): ?>
        <a href="index.php" class="home-link">Back to Homepage</a>

        <?php if (!empty($team_formations)): ?>
            <h2>Team Formations</h2>
            <table>
                <thead>
                    <tr>
                        <th>Head Coach First Name</th>
                        <th>Head Coach Last Name</th>
                        <th>Start Time</th>
                        <th>Address</th>
                        <th>Nature</th>
                        <th>Team Name</th>
                        <th>Score</th>
                        <th>Player First Name</th>
                        <th>Player Last Name</th>
                        <th>Player Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($team_formations as $formation): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($formation['coach_first_name']); ?></td>
                        <td><?php echo htmlspecialchars($formation['coach_last_name']); ?></td>
                        <td><?php echo htmlspecialchars($formation['start_time']); ?></td>
                        <td><?php echo htmlspecialchars($formation['address']); ?></td>
                        <td><?php echo htmlspecialchars($formation['nature']); ?></td>
                        <td><?php echo htmlspecialchars($formation['team_name']); ?></td>
                        <td><?php echo htmlspecialchars($formation['score']); ?></td>
                        <td><?php echo htmlspecialchars($formation['player_first_name']); ?></td>
                        <td><?php echo htmlspecialchars($formation['player_last_name']); ?></td>
                        <td><?php echo htmlspecialchars($formation['role']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No team formations found for the given location and day.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
