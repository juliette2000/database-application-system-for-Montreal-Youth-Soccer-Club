<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Create Club Member</title>
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
        <h2>Create a New Club Member</h2>
        <?php
        include 'database.php';

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $member_id = $_POST['member_id'];
            $membership_number = $_POST['membership_number'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $date_of_birth = $_POST['date_of_birth'];
            $social_security_number = $_POST['social_security_number'];
            $medicare_card_number = $_POST['medicare_card_number'];
            $telephone_number = $_POST['telephone_number'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $province = $_POST['province'];
            $postal_code = $_POST['postal_code'];
            $family_member_id = $_POST['family_member_id'];
            $active = $_POST['active'];

            // SQL query to insert data
            $sql = "INSERT INTO ClubMembers (member_id, membership_number, first_name, last_name, date_of_birth, social_security_number, medicare_card_number, telephone_number, address, city, province, postal_code, family_member_id, active) 
                    VALUES ($member_id, '$membership_number', '$first_name', '$last_name', '$date_of_birth', '$social_security_number', '$medicare_card_number', '$telephone_number', '$address', '$city', '$province', '$postal_code', '$family_member_id', '$active')";

            if ($conn->query($sql) === TRUE) {
                echo "New club member created in database";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        ?>
        <form action="" method="POST">
            <label for="member_id">Member ID:</label>
            <input type="number" id="member_id" name="member_id" required>

            <label for="membership_number">Membership Number:</label>
            <input type="number" id="membership_number" name="membership_number" required>

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>

            <label for="social_security_number">Social Security Number:</label>
            <input type="text" id="social_security_number" name="social_security_number" required>

            <label for="medicare_card_number">Medicare Card Number:</label>
            <input type="text" id="medicare_card_number" name="medicare_card_number">

            <label for="telephone_number">Telephone Number:</label>
            <input type="text" id="telephone_number" name="telephone_number">

            <label for="address">Address:</label>
            <input type="text" id="address" name="address">

            <label for="city">City:</label>
            <input type="text" id="city" name="city">

            <label for="province">Province:</label>
            <input type="text" id="province" name="province">

            <label for="postal_code">Postal Code:</label>
            <input type="text" id="postal_code" name="postal_code">

            <label for="family_member_id">Family Member ID:</label>
            <input type="number" id="family_member_id" name="family_member_id">

            <label for="active">Active:</label>
            <select id="active" name="active" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>

            <input type="submit" value="Create Member">
        </form>
    </div>
</body>

</html>
