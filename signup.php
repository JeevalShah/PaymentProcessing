<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login_signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 img"></div>
            <div class="col-6 form">
                <h5>SIGNUP</h5>
                <form action="action.php" method="post" onsubmit="return formValidator()">
                    <i class="fa-solid fa-user" id="profile"></i>
                    <input type="text" placeholder="Name" name="name" required><br><br>
                    <i class="fa-solid fa-phone" id="phone"></i>
                    <input type="number" placeholder="Phone Number" name="phone" required><br><br>
                    <i class="fa-regular fa-envelope" id="email"></i>
                    <input type="email" placeholder="Email ID" name="email" required><br><br>
                    <i class="fa-solid fa-lock" id="pass"></i>
                    <input type="password" placeholder="Password" name="pass" required><br><br>
                    <i class="fa-solid fa-lock" id="cpass"></i>
                    <input type="password" placeholder="Confirm Password" name="cpass" required><br><br>
                    <input type="submit" id="sub" value="Sign Up" name="signup">
                    <p>Already have an account?? <a href="login.php">Log In</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

<script>
  function formValidator(){
    var name = document.getElementById('name');
    var email = document.getElementById('email');
    var pass = document.getElementById('pass');
    var cpass = document.getElementById('cpass');

    if(isEmpty(name,"Please enter the name")){
      if(isAlpha(name,"Please enter the correct name")){
        if(isEmpty(email,"Please enter the email")){
          if(isemail(email,"Please enter the correct email")){
            if(isEmpty(pass,"Please enter the password")){
              if(ispass(pass,"Please enter the correct password with 6 to 16 characters that would include 1 uppercase letter, 1 lowercase letter, 1 number and any special character")){
                if(isEmpty(cpass,"Please confirm the password")){
                  if(Cpass(pass,cpass,"Please check your password")){
                    return true;
                  }
                }
              }
            }
          }
        }
      }
    }
    return false;
  }
  function isEmpty(ele,msg){
    if(ele.value!=''){
      return true;
    }
    else{
      alert(msg);
      ele.focus();
      return false;
    }
  }
  function isAlpha(ele,msg){
    exp = /\b([A-ZÀ-ÿ][-,a-z. ']+[ ]*)+/gm;
    if(ele.value.match(exp)){
      return true;
    }
    else{
      alert(msg);
      ele.focus();
      return false;
    }
  }
  function isemail(ele,msg){
    exp = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(ele.value.match(exp)){
      return true;
    }
    else{
      alert(msg);
      ele.focus();
      return false;
    }
  }
  function ispass(ele,msg){
    exp = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/gm;
    if(ele.value.match(exp)){
      return true;
    }
    else{
      alert(msg);
      ele.focus();
      return false;
    }
  }
  function Cpass(ele1,ele2,msg){
    if(ele1.value === ele2.value){
      return true;
    }
    else{
      alert(msg);
      ele.focus();
      return false;
    }
  }

</script>
</html>