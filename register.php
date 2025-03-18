<?php 

include 'connect.php';

if(isset($_POST['signUp'])){
    $firstName = trim($_POST['fName']);
    $lastName = trim($_POST['lName']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    
    if(empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword)) {
        echo "All fields are required!";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit();
    }

    if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
        exit();
    }

    if (strlen($password) < 6) {
        echo "Password must be at least 6 characters long!";
        exit();
    }

    $password=md5($password);
    
    $checkEmail="SELECT * From users where email='$email'";
    $result=$conn->query($checkEmail);
    
    if($result->num_rows > 0){
        echo "Email Address Already Exists!";
    } else {
        $insertQuery="INSERT INTO users(firstName,lastName,email,password)
                       VALUES ('$firstName','$lastName','$email','$password')";
            if($conn->query($insertQuery)==TRUE){
                header("location: index.php");
            }
            else{
                echo "Error:".$conn->error;
            }
    
    }
}

if(isset($_POST['signIn'])){

        $email=$_POST['email'];
        $password=$_POST['password'];
        $password=md5($password);
        
        $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
        $result=$conn->query($sql);
        if($result->num_rows>0){
            session_start();
            $row=$result->fetch_assoc();
            $_SESSION['email']=$row['email'];
            header("Location: homepage.php");
            exit();
        }
        else{
         echo "Not Found, Incorrect Email or Password";
        }
    
}
?>
