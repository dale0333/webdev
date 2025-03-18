<?php
session_start();
include("connect.php");
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 10%;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: inline-block;
        }
        h1 {
            font-size: 50px;
            font-weight: bold;
            color: #333;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            font-size: 18px;
            color: white;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hello 
        <?php 
        if(isset($_SESSION['email'])){
            $email = $_SESSION['email'];
            $query = mysqli_query($conn, "SELECT users.* FROM `users` WHERE users.email='$email'");
            while($row = mysqli_fetch_array($query)){
                echo $row['firstName'] . ' ' . $row['lastName'];
            }
        }
        ?>
        :)</h1>
        <a href="logout.php" class="btn">Logout</a>
        <a href="display_users.php" class="btn">View Users</a>
    </div>
</body>
</html>
