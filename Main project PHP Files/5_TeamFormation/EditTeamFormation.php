<?php
include 'database.php'; 


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

    
    $sql = "UPDATE teamformations SET team_id='$team_id', session_date='$session_date', session_time='$session_time', session_type='$session_type', score=$score, session_address='$session_address' WHERE formation_id=$formation_id";

    if ($conn->query($sql) === TRUE) {
        
        header("Location: DisplayTeamFormations.php");
        exit; 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif (isset($_GET['formation_id'])) {
    $formation_id = $_GET['formation_id'];

    
    $sql = "SELECT * FROM teamformations WHERE formation_id = $formation_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No team formation found with ID $formation_id";
        exit;
    }
} else {
    echo "No formation ID provided. Please access this page through the display page.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Team Formation</title>
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
        <h2>Edit Team Formation</h2>
        
        <form action="editteamformation.php" method="POST">
            <input type="hidden" id="formation_id" name="formation_id" value="<?php echo $row['formation_id']; ?>" required>

            <label for="team_id">Team ID:</label>
            <input type="number" id="team_id" name="team_id" value="<?php echo $row['team_id']; ?>" required>

            <label for="session_date">Session Date:</label>
            <input type="date" id="session_date" name="session_date" value="<?php echo $row['session_date']; ?>" required>

            <label for="session_time">Session Time:</label>
            <input type="time" id="session_time" name="session_time" value="<?php echo $row['session_time']; ?>" required>

            <label for="session_type">Session Type:</label>
            <select id="session_type" name="session_type" required>
                <option value="Game" <?php if($row['session_type'] == 'Game') echo 'selected'; ?>>Game</option>
                <option value="Training" <?php if($row['session_type'] == 'Training') echo 'selected'; ?>>Training</option>
            </select>

            <label for="score">Score:</label>
            <input type="number" id="score" name="score" value="<?php echo $row['score']; ?>">

            <label for="session_address">Session Address:</label>
            <input type="text" id="session_address" name="session_address" value="<?php echo $row['session_address']; ?>" required>

            <input type="submit" value="Update Team Formation">
        </form>
    </div>
</body>
</html>
