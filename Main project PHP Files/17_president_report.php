<?php

require_once 'database.php';

$details = [];
$query = "
    SELECT 
        p.first_name,
        p.last_name,
        pl.start_date,
        pl.end_date
    FROM 
        Personnel p
    left JOIN 
        PersonnelLocation pl ON p.personnel_id = pl.personnel_id
    left JOIN 
        Locations l ON pl.location_id = l.location_id
    WHERE 
        p.role = 'Administrator'
    ORDER BY 
        p.first_name ASC,
        p.last_name ASC,
        pl.start_date ASC;
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
    <title>Club Presidents Report</title>
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
    <h1>Report of Club Presidents</h1>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Start Date as President</th>
                <th>Last Date as President</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($details as $detail): ?>
            <tr>
                <td><?php echo htmlspecialchars($detail['first_name']); ?></td>
                <td><?php echo htmlspecialchars($detail['last_name']); ?></td>
                <td><?php echo htmlspecialchars($detail['start_date']); ?></td>
                <td><?php echo htmlspecialchars($detail['end_date']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<?php

$conn->close();
?>
