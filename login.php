<?php  
    session_start();
?>  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
<link rel="stylesheet" href="Style.css">
</head>
<body>
<!--#D9C1BE #486F72 #DB9428 #B36672 #F2DBD6;-->
<form method="post" action="login.php">
    <div class="grid">
    <div class="nav-bar-logn">
        <ul id="ullogin">
            <li><img src="logo.png" alt="logo" class="nav-bar-logo" ></li>
            <li class="nav-bar-item-logn" id="activelogn"><a href="home Page.php">Home page</a></li>
          </ul>
    </div>
    </div>

    <div class="container"> 
    <h1>Log in</h1>
<div class="form__input-group">
    <input type="email" class="form__input" placeholder="Enter Email" name="email" id="email" required>
    <br>
    <input type="password" class="form__input" placeholder="Enter Password" name="psw" id="psw" required>
    <label> <b>Log in as:</b> 
        
        <input name="loginAs" type="radio" value="Pet owner" checked >Pet owner
   
        <input name="loginAs" type="radio" value="Veterinary" >Veterinary
   </label>

    <button type="submit" class="registerbtn" value="login" name="login" >Log in</button>
    <p><a h href="forgetPass.php">Forgot password?</a></p>
    <p>Don't have an account? <a h href="register.php">creat account</a></p>
  </div> 
</form>
</body>
</html>

<?php

if (!( $database = mysqli_connect( "localhost", "root", "" )))
die( "<p>Could not connect to database</p>" );

if (!mysqli_select_db( $database, "webpro" ))
die( "<p>Could not open URL database</p>" );

if(isset($_POST['login'])) {  
$email=$_POST['email'];  
$password=$_POST['psw'];  
$type=$_POST["loginAs"];

/*echo "<script>alert('$type')</script>";  

$query="select * from  veterinary WHERE email='$email'AND password='$password'";  
$run=mysqli_query($database, $query);  

if($row=mysqli_fetch_row($run) ) {
    header("location: home page-manger.php");
    $_SESSION['name']=$row[3];
    $_SESSION['email']=$email;
}
else  
  echo "<script>alert('Email or password is incorrect!')</script>";  

$type=$_POST['loginAs'];*/
if($type=="Veterinary") 
    $query="SELECT * FROM `veterinary` WHERE `veterinary`.`email`='$email' AND `veterinary`.`password`='$password';";   
  

  else
$query="select * from petowner WHERE email='$email'AND password='$password'";  
  
$run=mysqli_query($database, $query);  

if($row=mysqli_fetch_row($run) ) {
  if( $type=="Veterinary" ) {  
    header("location: home%20page-manger.php");
    $_SESSION['name']=$row[3];
    $_SESSION['email']=$email;
    }

   else{
     header("location: welcom.php");
     $_SESSION['name']=$row[3];
      $_SESSION['email']=$email;
        }
}

else  {
  echo "<script>alert('Email or password is incorrect!')</script>";  
}
  }

  

?>