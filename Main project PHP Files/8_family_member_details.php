<?php
require_once 'database.php';

// Check if the form is submitted and retrieve the input values
$first_name = isset($_GET['first_name']) ? $_GET['first_name'] : '';
$last_name = isset($_GET['last_name']) ? $_GET['last_name'] : '';

$details = [];

if ($first_name && $last_name) {
    $query = "
        SELECT fm2.first_name AS sec_first_name,
            fm2.last_name AS sec_last_name,
            fm2.telephone_number AS sec_telephone_number,
            cm.membership_number,
            cm.first_name AS club_first_name,
            cm.last_name AS club_last_name,
            cm.date_of_birth,
            cm.social_security_number,
            cm.medicare_card_number,
            cm.telephone_number AS club_telephone_number,
            cm.address,
            cm.city,
            cm.province,
            cm.postal_code,
            fm.first_name AS primary_first_name,
            fm.last_name AS primary_last_name,
            cmfm.relationship
        FROM FamilyMembers fm
        JOIN ClubMembersFamilyMembers cmfm ON fm.family_member_id = cmfm.family_member_id
        JOIN ClubMembers cm ON cmfm.club_member_id = cm.member_id
        JOIN FamilyMembers fm2 ON fm.primary_family_member_id = fm2.family_member_id
        WHERE fm2.first_name = ? AND fm2.last_name = ?
    ";

    // Prepare and execute the query
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ss", $first_name, $last_name); // Bind parameters (two strings)
        $stmt->execute();
        $result = $stmt->get_result();
        $details = $result->fetch_all(MYSQLI_ASSOC);
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
    <title>Family Member Details</title>
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
    <h1>Family Member Details</h1>
    <form method="get" action="">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>
        <br><br>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>
        <br><br>
        <input type="submit" value="Search">
    </form>

    <?php if ($first_name && $last_name): ?>
        <h2>Family Member Details for <?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></h2>
        <a href="index.php" class="home-link">Back to Homepage</a>

        <?php if (!empty($details)): ?>
            <h2>Associated Club Members</h2>
            <table>
                <thead>
                    <tr>
                        <th>Club Membership Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th>Social Security Number</th>
                        <th>Medicare Card Number</th>
                        <th>Telephone Number</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Province</th>
                        <th>Postal Code</th>
                        <th>Primary Family Member First Name</th>
                        <th>Primary Family Member Last Name</th>
                        <th>Relationship with Secondary Family Member</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($details as $detail): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($detail['membership_number']); ?></td>
                        <td><?php echo htmlspecialchars($detail['club_first_name']); ?></td>
                        <td><?php echo htmlspecialchars($detail['club_last_name']); ?></td>
                        <td><?php echo htmlspecialchars($detail['date_of_birth']); ?></td>
                        <td><?php echo htmlspecialchars($detail['social_security_number']); ?></td>
                        <td><?php echo htmlspecialchars($detail['medicare_card_number']); ?></td>
                        <td><?php echo htmlspecialchars($detail['club_telephone_number']); ?></td>
                        <td><?php echo htmlspecialchars($detail['address']); ?></td>
                        <td><?php echo htmlspecialchars($detail['city']); ?></td>
                        <td><?php echo htmlspecialchars($detail['province']); ?></td>
                        <td><?php echo htmlspecialchars($detail['postal_code']); ?></td>
                        <td><?php echo htmlspecialchars($detail['primary_first_name']); ?></td>
                        <td><?php echo htmlspecialchars($detail['primary_last_name']); ?></td>
                        <td><?php echo htmlspecialchars($detail['relationship']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No details found for <?php echo htmlspecialchars($first_name . ' ' . $last_name); ?>.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
