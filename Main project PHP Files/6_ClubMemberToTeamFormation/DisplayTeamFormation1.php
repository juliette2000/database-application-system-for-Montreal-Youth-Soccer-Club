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
        <h2>Team Member</h2>
        <?php
        include 'database.php';

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT p.player_id,
		p.formation_id,
		p.club_member_id,
		p.role,cm.membership_number,
		cm.first_name,
		cm.last_name,
		cm.date_of_birth, 
		cm.social_security_number,
		cm.medicare_card_number,
		cm.family_member_id,
		cm.active
		FROM players p
		left join ClubMembers cm ON p.club_member_id=cm.member_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>player ID</th>
			<th>formation ID</th>
			<th>club member ID</th>
			<th>role</th>
                        <th>Membership Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th>SSN</th>
                        <th>MCN</th>
                        <th>Family Member ID</th>
                        <th>Active</th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
			<td>" . $row["player_id"] . "</td>
			<td>" . $row["formation_id"] . "</td>
                        <td>" . $row["club_member_id"] . "</td>
			<td>" . $row["role"] . "</td>
                        <td>" . $row["membership_number"] . "</td>
                        <td>" . $row["first_name"] . "</td>
                        <td>" . $row["last_name"] . "</td>
                        <td>" . $row["date_of_birth"] . "</td>
                        <td>" . $row["social_security_number"] . "</td>
                        <td>" . $row["medicare_card_number"] . "</td>
                        <td>" . $row["family_member_id"] . "</td>
                        <td>" . $row["active"] . "</td>
                        <td class='actions'>
                            <a href='EditClubMemberToTeamFormation.php?player_id=" . $row["player_id"] . "'>Edit</a> | 
                            <a href='DeleteClubMemberToTeamFormation.php?player_id=" . $row["player_id"] . "'>Delete</a>
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
