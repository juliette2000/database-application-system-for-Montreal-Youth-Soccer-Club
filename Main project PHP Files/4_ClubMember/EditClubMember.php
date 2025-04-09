<?php
        include 'database.php'; // Ensure the path is correct

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

      
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $member_id = $_POST['member_id'];
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
            $active = isset($_POST['active']) ? 1 : 0;

        
            $sql = "UPDATE ClubMembers SET first_name='$first_name', last_name='$last_name', date_of_birth='$date_of_birth',social_security_number='$social_security_number',medicare_card_number='$medicare_card_number, telephone_number='$telephone_number', address='$address', city='$city', province='$province', postal_code='$postal_code', family_member_id='$family_member_id', active=$active WHERE member_id=$member_id";

            if ($conn->query($sql) === TRUE) {
                
                // Redirect to display member page
                header("Location:https://nnc353.encs.concordia.ca/DisplayClubMember.php");
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } elseif (isset($_GET['member_id'])) {
            $member_id = $_GET['member_id'];

            // Get current club member information
            $sql = "SELECT * FROM ClubMembers WHERE member_id = $member_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "No club member found with ID $member_id";
                exit;
            }
        } else {
            echo "No member ID provided. Please access this page through the display page.";
            exit;
        }

        $conn->close();
        ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Club Member</title>
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
        <h2>Edit Club Member</h2>
        
        <form action="EditClubMember.php" method="POST">
            <input type="hidden" id="member_id" name="member_id" value="<?php echo $row['member_id']; ?>" required>

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required>

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo $row['date_of_birth']; ?>" required>

            <label for="telephone_number">Telephone Number:</label>
            <input type="text" id="telephone_number" name="telephone_number" value="<?php echo $row['telephone_number']; ?>" required>
            
            <label for="social_security_number"> SSN:</label>
            <input type="text" id="social_security_number" name="social_security_number" value="<?php echo $row['social_security_number']; ?>" required>
            
            <label for="medicare_card_number">Address:</label>
            <input type="text" id="medicare_card_number" name="medicare_card_number" value="<?php echo $row['medicare_card_number']; ?>" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>" required>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" value="<?php echo $row['city']; ?>" required>

            <label for="province">Province:</label>
            <input type="text" id="province" name="province" value="<?php echo $row['province']; ?>" required>

            <label for="postal_code">Postal Code:</label>
            <input type="text" id="postal_code" name="postal_code" value="<?php echo $row['postal_code']; ?>" required>

            <label for="active">Active:</label>
            <input type="checkbox" id="active" name="active" <?php if($row['active']) echo 'checked'; ?>>

            <input type="submit" value="Update Club Member">
        </form>
    </div>
</body>
</html>
