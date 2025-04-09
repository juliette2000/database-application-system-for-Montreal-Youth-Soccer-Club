<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Team Formations</title>
    <style>
        body {
            background-color: #f0f8ff;
            color: #333;
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #2e8b57;
            font-size: 200%;
        }

        .table-container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            border: 2px solid #ccc;
            padding: 20px;
            text-align: left;
            font-size: 16px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .actions {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h2>Team Formations</h2>
        <?php
        include 'database.php';

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM teamformations";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Formation ID</th>
                        <th>Team ID</th>
                        <th>Session Date</th>
                        <th>Session Time</th>
                        <th>Session Type</th>
                        <th>Score</th>
                        <th>Session Address</th>
                        <th>Actions</th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["formation_id"] . "</td>
                        <td>" . $row["team_id"] . "</td>
                        <td>" . $row["session_date"] . "</td>
                        <td>" . $row["session_time"] . "</td>
                        <td>" . $row["session_type"] . "</td>
                        <td>" . $row["score"] . "</td>
                        <td>" . $row["session_address"] . "</td>
                        <td class='actions'>
                            <a href='editteamformation.php?formation_id=" . $row["formation_id"] . "'>Edit</a> | 
                            <a href='deleteteamformation.php?formation_id=" . $row["formation_id"] . "'>Delete</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
