<?php
session_start();
include 'connect.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid user ID.");
}

$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("User not found.");
}

$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];

    $updateSql = "UPDATE users SET firstName='$firstName', lastName='$lastName', email='$email' WHERE id=$id";
    if ($conn->query($updateSql) === TRUE) {
        header("Location: display_users.php");
        exit();
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }
        .form-container {
            width: 50%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            border: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Update User</h2>
        <form method="post">
            <label>First Name:</label>
            <input type="text" name="firstName" value="<?php echo $user['firstName']; ?>" required>

            <label>Last Name:</label>
            <input type="text" name="lastName" value="<?php echo $user['lastName']; ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

            <button type="submit" name="update" class="btn">Update</button>
            <a href="display_users.php" class="btn">Cancel</a>
        </form>
    </div>
</body>
</html>
