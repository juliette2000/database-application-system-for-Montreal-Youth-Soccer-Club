<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Create Team Formation</title>
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
        <h2>Create a New Team Formation</h2>
        <?php
        include 'database.php';

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $formation_id = $_POST['formation_id'];
            $team_id = $_POST['team_id'];
            $session_date = $_POST['session_date'];
            $session_time = $_POST['session_time'];
            $session_type = $_POST['session_type'];
            $score = $_POST['score'];
            $session_address = $_POST['session_address'];

            $sql = "INSERT INTO teamformations (formation_id, team_id, session_date, session_time, session_type, score, session_address) 
            VALUES ($formation_id, $team_id, '$session_date', '$session_time', '$session_type', $score, '$session_address')";


            if ($conn->query($sql) === TRUE) {
                echo "New team formation created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        ?>
        <form action="" method="POST">
            <label for="formation_id">Formation ID:</label>
            <input type="number" id="formation_id" name="formation_id" required>
            
            <label for="team_id">Team ID:</label>
            <input type="number" id="team_id" name="team_id" required>

            <label for="session_date">Session Date:</label>
            <input type="date" id="session_date" name="session_date" required>

            <label for="session_time">Session Time:</label>
            <input type="time" id="session_time" name="session_time" required>

            <label for="session_type">Session Type:</label>
            <select id="session_type" name="session_type" required>
                <option value="Game">Game</option>
                <option value="Training">Training</option>
            </select>

            <label for="score">Score:</label>
            <input type="number" id="score" name="score">

            <label for="session_address">Session Address:</label>
            <input type="text" id="session_address" name="session_address" required>

            <input type="submit" value="Create Team Formation">
        </form>
    </div>
</body>
</html>
