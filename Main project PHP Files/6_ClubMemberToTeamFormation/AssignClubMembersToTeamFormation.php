<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Assign Club Members to a Team Formation</title>
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
        <h2>Assign Club Member to Team Formation</h2>
        <?php
        include 'database.php';

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $formation_id = $_POST['formation_id'];
            $club_member_id = $_POST['club_member_id'];
            $role = $_POST['role'];

            // SQL query to assign club member to team formation
            $sql = "INSERT INTO players (formation_id, club_member_id, role) 
                    VALUES ($formation_id, $club_member_id, '$role')";

            if ($conn->query($sql) === TRUE) {
                echo "Club member assigned to team formation";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        ?>
        <form action="" method="POST">
            <label for="formation_id">Formation ID:</label>
            <input type="number" id="formation_id" name="formation_id" required>

            <label for="club_member_id">Club Member ID:</label>
            <input type="number" id="club_member_id" name="club_member_id" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="Goalkeeper">Goalkeeper</option>
                <option value="Defender">Defender</option>
                <option value="Midfielder">Midfielder</option>
                <option value="Forward">Forward</option>
            </select>

            <input type="submit" value="Assign Member">
        </form>
    </div>
</body>

</html>
