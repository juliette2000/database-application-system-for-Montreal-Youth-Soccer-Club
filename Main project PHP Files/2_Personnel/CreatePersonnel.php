<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Create Personnel</title>
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
        <h2>Create a New Personnel</h2>
        <?php
        include 'database.php';

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $personnel_id = $_POST['personnel_id'];
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

            // SQL query to insert data
            $sql = "INSERT INTO Personnel (personnel_id, first_name, last_name, date_of_birth, ssn, medicare_number, phone_number, address, city, province, postal_code, email, role, mandate) 
                    VALUES ($personnel_id, '$first_name', '$last_name', '$date_of_birth', '$ssn', '$medicare_number', '$phone_number', '$address', '$city', '$province', '$postal_code', '$email', '$role', '$mandate')";

            if ($conn->query($sql) === TRUE) {
                echo "New personnel created in database";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        ?>
        <form action="" method="POST">
            <label for="personnel_id">Personnel ID:</label>
            <input type="number" id="personnel_id" name="personnel_id" required>

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>

            <label for="ssn">SSN:</label>
            <input type="text" id="ssn" name="ssn" required>

            <label for="medicare_number">Medicare Number:</label>
            <input type="text" id="medicare_number" name="medicare_number">

            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number">

            <label for="address">Address:</label>
            <input type="text" id="address" name="address">

            <label for="city">City:</label>
            <input type="text" id="city" name="city">

            <label for="province">Province:</label>
            <input type="text" id="province" name="province">

            <label for="postal_code">Postal Code:</label>
            <input type="text" id="postal_code" name="postal_code">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="Administrator">Administrator</option>
                <option value="Trainer">Trainer</option>
                <option value="Other">Other</option>
            </select>

            <label for="mandate">Mandate:</label>
            <select id="mandate" name="mandate" required>
                <option value="Volunteer">Volunteer</option>
                <option value="Salary">Salary</option>
            </select>

            <input type="submit" value="Create Personnel">
        </form>
    </div>
</body>

</html>
