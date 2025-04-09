<?php
include 'database.php';

if (isset($_GET['personnel_id'])) {
    $personnel_id = $_GET['personnel_id'];

    // Fetch the existing data for the selected personnel
    $sql = "SELECT * FROM Personnel WHERE personnel_id = $personnel_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No personnel found with the provided ID.";
        exit();
    }
} else {
    echo "No personnel_id provided.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $ssn = $_POST['ssn'];
    $medicare_number = $_POST['medicare_number'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $postal_code = $_POST['postal_code'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $mandate = $_POST['mandate'];

    // SQL query to update the personnel entry
    $sql = "UPDATE Personnel SET first_name='$first_name', last_name='$last_name', date_of_birth='$date_of_birth', ssn='$ssn', medicare_number='$medicare_number', phone_number='$phone_number', address='$address', city='$city', province='$province', postal_code='$postal_code', email='$email', role='$role', mandate='$mandate' WHERE personnel_id=$personnel_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect to display location page
        header("Location:https://nnc353.encs.concordia.ca/DisplayPersonnel.php");
        exit; // Ensure no further code is executed
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Edit Personnel</title>
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

        .form-container {
            width: 600px;
            background-color: #fff;
            color: #333;
            border: 2px solid #ccc;
            margin: 50px auto;
            padding: 20px;
            text-align: left;
            font-size: 16px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container label {
            display: block;
            margin: 10px 0 5px;
        }

        .form-container input,
        .form-container select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container input[type="submit"] {
            width: auto;
            background-color: #2e8b57;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .form-container input[type="submit"]:hover {
            background-color: #4682b4;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Edit Personnel</h2>
        <form action="" method="POST">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required>

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo $row['date_of_birth']; ?>" required>

            <label for="ssn">SSN:</label>
            <input type="text" id="ssn" name="ssn" value="<?php echo $row['ssn']; ?>" required>

            <label for="medicare_number">Medicare Number:</label>
            <input type="text" id="medicare_number" name="medicare_number" value="<?php echo $row['medicare_number']; ?>">

            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo $row['phone_number']; ?>">

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>">

            <label for="city">City:</label>
            <input type="text" id="city" name="city" value="<?php echo $row['city']; ?>">

            <label for="province">Province:</label>
            <input type="text" id="province" name="province" value="<?php echo $row['province']; ?>">

            <label for="postal_code">Postal Code:</label>
            <input type="text" id="postal_code" name="postal_code" value="<?php echo $row['postal_code']; ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="Administrator" <?php if ($row['role'] == 'Administrator') echo 'selected'; ?>>Administrator</option>
                <option value="Trainer" <?php if ($row['role'] == 'Trainer') echo 'selected'; ?>>Trainer</option>
                <option value="Other" <?php if ($row['role'] == 'Other') echo 'selected'; ?>>Other</option>
            </select>

            <label for="mandate">Mandate:</label>
            <select id="mandate" name="mandate" required>
                <option value="Volunteer" <?php if ($row['mandate'] == 'Volunteer') echo 'selected'; ?>>Volunteer</option>
                <option value="Salary" <?php if ($row['mandate'] == 'Salary') echo 'selected'; ?>>Salary</option>
            </select>

            <input type="submit" value="Update Personnel">
        </form>
    </div>
</body>

</html>
