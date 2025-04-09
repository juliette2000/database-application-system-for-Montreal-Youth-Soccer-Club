<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Create Location</title>
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
        <h2>Create a New Location</h2>
        <?php
        include 'database.php';

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $location_id = $_POST['location_id'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $province = $_POST['province'];
            $postal_code = $_POST['postal_code'];
            $phone_number = $_POST['phone_number'];
            $web_address = $_POST['web_address'];
            $type = $_POST['type'];
            $capacity = $_POST['capacity'];

            // SQL query to insert data
            $sql = "INSERT INTO Locations (location_id, name, address, city, province, postal_code, phone_number, web_address, type, capacity) 
                    VALUES ($location_id, '$name', '$address', '$city', '$province', '$postal_code', '$phone_number', '$web_address', '$type', $capacity)";

            if ($conn->query($sql) === TRUE) {
                echo "New location created in database";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        ?>
        <form action="" method="POST">
            <label for="location_id">Location ID:</label>
            <input type="number" id="location_id" name="location_id" required>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>

            <label for="province">Province:</label>
            <input type="text" id="province" name="province" required>

            <label for="postal_code">Postal Code:</label>
            <input type="text" id="postal_code" name="postal_code" required>

            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>

            <label for="web_address">Web Address:</label>
            <input type="text" id="web_address" name="web_address">

            <label for="type">Type:</label>
            <select id="type" name="type" required>
                <option value="Head">Head</option>
                <option value="Branch">Branch</option>
            </select>

            <label for="capacity">Capacity:</label>
            <input type="number" id="capacity" name="capacity" required>

            <input type="submit" value="Create Location">
        </form>
    </div>
</body>

</html>
