<?php
session_start();
include("connection.php");

if(isset($_POST['signup'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    // Check if email or phone already exists
    $check_query = mysqli_query($connection, "SELECT * FROM `user_accounts` WHERE `Email`='$email' OR `Phone`='$phone'");
    if(mysqli_num_rows($check_query) > 0) {
        echo '<script type="text/javascript">
        setTimeout(function() {
            alert("Already Signed Up!");
            window.location.href = "login.php";
            }, 10);
        </script>';

        exit();
    }

    // Insert new user if not already registered
    mysqli_query($connection,"INSERT INTO `user_accounts`(`ID`, `Name`, `Phone`, `Email`, `Password`, `Wallet`, `Income`, `Expense`) VALUES ('','$name','$phone','$email','$pass','500','0','0')");

    header("location: login.php");
    $_SESSION['Phone'] = $phone;
    exit(); // Stop further execution
}

else if(isset($_POST['login'])){
    $phone = $_POST['phone'];
    $pass = $_POST['pass'];

    // Check if provided login credentials are valid
    $login_query = mysqli_query($connection, "SELECT * FROM `user_accounts` WHERE `Phone`='$phone' AND `Password`='$pass'");
    if(mysqli_num_rows($login_query) == 1) {
        $_SESSION['Phone'] = $phone;
        header("location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid Login Credentials')</script>";
        header("location: login.php");
        exit();
    }
}
?>