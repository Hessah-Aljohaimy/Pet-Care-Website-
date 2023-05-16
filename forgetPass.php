<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget password</title>
    <link rel="stylesheet" href="Style.css">

</head>
<body>
    <form method="post" action="forgetPass.php">
        <div class="grid">
            <div class="nav-bar-logn">
                <ul id="ullogin">
                    <li><img src="logo.png" alt="logo" class="nav-bar-logo" ></li>

                    <li class="nav-bar-item-logn" id="activelogn"><a href="home Page.php">Home page</a></li>
                  </ul>
            </div>
            </div>
        <div class="container"> 
        <h1>Reset passsword</h1>
    <div class="form__input-group">
    <input type="email" class="form__input" placeholder="Enter Email" name="email" id="emailResetpas" required>
    <br>
        <input type="password" class="form__input" placeholder="Enter New Password" name="psw" id="resetpsw" required>
       
        <button type="submit" class="registerbtn" name="resetPass">Reset password</button>
        <p>Back to <a h href="login.php">log in</a></p>
      </div>
    </form>
</body>
</html>

<?php


if (!( $database = mysqli_connect( "localhost", "root", "" )))
die( "<p>Could not connect to database</p>" );

if (!mysqli_select_db( $database, "webpro" ))
die( "<p>Could not open URL database</p>" );

if(isset($_POST['resetPass'])) {  

$email=$_POST['email'];  
$password=$_POST['psw'];  


$query1="select * from  veterinary WHERE email='$email'";  
$query2="select * from petowner WHERE email='$email'";  
  
$run1=mysqli_query($database, $query1);  
$run2=mysqli_query($database, $query2);  

if($row=mysqli_fetch_row($run1)!=null ) {
    $sql = "UPDATE veterinary SET password='$password' WHERE email='$email'"; 
    $run2=mysqli_query($database,   $sql);  
    echo "<script>alert('The password has been set successfully')</script>"; 
}
   else if ($row=mysqli_fetch_row($run2)!=null ){
    $sql = "UPDATE petowner SET password='$password' WHERE email='$email'"; 
    $run2=mysqli_query($database,   $sql);  
    echo "<script>alert('The password has been set successfully')</script>"; 


        }


else  {
  echo "<script>alert('No account with this email!')</script>";  
}
  }




?>