<?php
include 'database.php';

// Calculate the date two years ago from today
$two_years_ago = date('Y-m-d', strtotime('-2 years'));

// SQL query to fetch the required details
$query = "SELECT cm.membership_number, cm.first_name, cm.last_name
          FROM ClubMembers cm
          JOIN (
              SELECT cmd.member_id
              FROM ClubMemberDate cmd
              WHERE cmd.end_date IS NULL OR cmd.end_date <= CURDATE()
              GROUP BY cmd.member_id
              HAVING COUNT(DISTINCT cmd.location_id) >= 4
          ) AS filtered_members ON cm.member_id = filtered_members.member_id
          WHERE cm.active = 1 
            AND (
              SELECT TIMESTAMPDIFF(YEAR, MIN(cmd.start_date), CURDATE())
              FROM ClubMemberDate cmd
              WHERE cmd.member_id = cm.member_id
            ) <= 2
          ORDER BY cm.membership_number ASC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Club Members</title>
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
    <h1>Active Club Members</h1>
    <a href="index.php" class="home-link">Back to Homepage</a>
    <table>
        <thead>
            <tr>
                <th>Club Membership Number</th>
                <th>First Name</th>
                <th>Last Name</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['membership_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>

<?php mysqli_close($conn); ?>
