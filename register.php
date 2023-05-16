
<?php  
    session_start();
?>  
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="Style.css">

</head>
<body>
<form method="post" action="register.php" enctype="multipart/form-data">
    <div class="grid"> 

    <div class="nav-bar-logn">
        <ul id="ullogin">
            <li><img src="logo.png" alt="logo" class="nav-bar-logo" ></li>

       <li class="nav-bar-item-logn" id="activelogn"><a href="home%20page.php">Home page</a></li>

        </ul>
    </div>
    </div>
    <div class="container"> 
    <h1>Register</h1>
<p>Please fill in this form to create an account.</p>

<div class="form__input-group">
    <input type="email" class="form__input" placeholder="Enter Email" name="email" id="email" required>
    <br>
    <input type="password" class="form__input" placeholder="Enter Password" name="psw" id="psw" required>
    <br>
    <input type="text" class="form__input" placeholder="Enter Phone number" name="phn" id="phn" maxlength="10" minlength="10" required>
    <br>
    <input type="text" class="form__input" placeholder="Enter First name" name="fn" id="fn" required>
    <br>
    <input type="text" class="form__input" placeholder="Enter Last name" name="ln" id="ln" required>

</div>    
  <center> <label> <b>Gender:</b> 
        
        <input name="Gender" type="radio" value="Male" id="Male" checked><label for="Male">Male</label>
   
        <input name="Gender" type="radio" value="Female" id="Female" ><label for="Female">Female</label>
   </label>


<br><br>
   <label>
    <div class="profile-pic-div">
      <img src="images.png" id="photo">
        <input type="file" id="file" name="uploadfile">
        <label for="file" id="uploadBtn">Choose Photo</label>
        <script src="profilePhpto.js"></script>
      </div>
   </label></center> 
  <br>
    <button type="submit" class="registerbtn"  value="register" name="register">Register</button>
    <p>have an account? <a h href="login.php">log in</a></p>
  </div> 
</form>
</div>



<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (!( $database = mysqli_connect( "localhost", "root", "" )))
die( "<p>Could not connect to database</p>" );

if (!mysqli_select_db( $database, "webpro" ))
die( "<p>Could not open URL database</p>" );

$email=$_POST["email"];  
$passwor=$_POST["psw"];  
$phoneNo=$_POST["phn"];
$gender=$_POST["Gender"];
$fname=$_POST["fn"];  
$lname=$_POST['ln'];  
$filename = $_FILES['uploadfile']['name'];
$tempname = $_FILES['uploadfile']['tmp_name'];    

if($filename==null){
  $filename='images.png';
}

$imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));



if(!preg_match('/^[0-9]{10}+$/', $phoneNo)){
  echo "<script>alert('phone number should be NUMBERS only!')</script>";  
  exit();

}

if (preg_match('/[0-9]+/', $fname)||preg_match('/[0-9]+/', $lname)) {
  echo "<script>alert('name should not have a number!')</script>";  
  exit();
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed!')</script>";
exit();
}
move_uploaded_file($tempname, 'profile_img/'.$filename);

$query="select email from petowner WHERE email='$email'";  
$query2="select email from veterinary WHERE email='$email'"; 
$run=mysqli_query($database, $query); 
$run2=mysqli_query($database, $query2);  

$queryinsert="INSERT INTO petowner (email, password, profilePhoto,phoneNumber,gender,Fname,Lname) VALUES ('".$email."','".$passwor."','".$filename."','".$phoneNo."','".$gender."','".$fname."','".$lname."');";
if( ( $row=mysqli_fetch_row($run)==null ) && ( $row=mysqli_fetch_row($run2)==null)) {
  $_SESSION['email']=$email;
  mysqli_query($database,$queryinsert);  
    header("location: welcom.php");
  
}

else  
  echo "<script>alert('This email is used before!')</script>";  


  
  }




?>

</body>

</html>
