<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login_signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-6 form1">
                <h5>LOGIN</h5>
                <form action="action.php" method="post">
                    <i class="fa-solid fa-phone icn" id="phone1"></i>
                    <input type="number" placeholder="Phone Number" name="phone"><br><br>
                    <i class="fa-solid fa-lock icn" id="pass1"></i>
                    <input type="password" placeholder="Password" name="pass"><br><br>
                    <input type="submit" id="sub" value="Login Now" name="login">
                    <p>Do not have an account?? <a href="signup.php">Signup</a></p>
                </form>
            </div>
            <div class="col-6 image"></div>
        </div>
    </div>
</body>
</html>