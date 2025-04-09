<?php
require_once 'database.php';

// Initialize the location name
$location_name = '';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the location name from the form input
    $location_name = $_POST['location_name'];

    $query = "
        SELECT DISTINCT fm.first_name, fm.last_name, fm.telephone_number
        FROM FamilyMembers fm
        JOIN ClubMembers cm ON fm.family_member_id = cm.family_member_id
        JOIN Personnel p ON fm.personnel_id = p.personnel_id
        JOIN Teams t ON fm.personnel_id = t.HeadCoachID
        LEFT JOIN Locations l ON t.location_id = l.location_id
        WHERE l.name = ?
        ORDER BY fm.last_name ASC, fm.first_name ASC
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $location_name);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head Coaches Report</title>
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
    <h1>Head Coaches Report</h1>
    <a href="index.php" class="home-link">Back to Homepage</a>

    <!-- Form to input the location name -->
    <form method="POST" action="">
        <label for="location_name">Enter Location Name:</label>
        <input type="text" id="location_name" name="location_name" required>
        <input type="submit" value="Generate Report">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <h2>Results for Location: <?php echo htmlspecialchars($location_name); ?></h2>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['telephone_number']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>

<?php
if (isset($stmt)) {
    $stmt->close();
}
mysqli_close($conn);
?>
