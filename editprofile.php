<?php
session_start();

if(!isset($_SESSION['email'])) {
  header("location: login.php");
  exit();
}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit my profile</title>
        <link rel="stylesheet" href="EdProSt.css">
        <link rel="stylesheet" href="profileStyle.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    </head>
    <body>
        <div class="grid">
            <div class="nav-bar">
            <ul id="ul">
              <img src="./PetcareLogo.png" alt="logo" class="nav-bar-logo"width="100" height="130"  >
              <li class="nav-bar-item" id="active"><a href="home%20page.php">Log Out</a></li>
              <li class="nav-bar-item" id="active"><a href="userProfile.php">Back</a></li>
              <li class="nav-bar-item" id="active"><a href="welcom.php">Home</a></li>
              
              </ul>
        </div>
        </div>        
        <form action="" method="post" enctype="multipart/form-data" class="test">
            
            <div class="container">
            <div class="P-box">
                <h2>Edit My Profile</h2>
            
            <?php

           if (!( $database = mysqli_connect( "localhost", "root", "" )))
           die( "<p>Could not connect to database</p>" );

            if (!mysqli_select_db( $database, "webpro" ))
            die( "<p>Could not open URL database</p>" );

            $Email=$_SESSION['email'];

          $query="select Fname,Lname,profilePhoto,phoneNumber,email,gender,password from petowner WHERE email='".$Email."'";  
          $result=mysqli_query($database,$query);
          $row=mysqli_fetch_row($result);
                
                $male="";
                $famale="";
                $gender=$row[5];
                $oldphone = $row[3];
                if($gender=="Male"){
                    $male = "checked";
                }
                else{
                    $famale = "checked";
                }
                    
            
                Print " <center> <label>
                <div class='profile-pic-div'>
                  <img src='profile_img/$row[2]' id='photo'>
                    <input type='file' id='file' name='uploadfile'>
                    <label for='file' id='uploadBtn'>Choose Photo</label>
                    <script src='profilePhpto.js'></script>
                  </div>
               </label></center> 
                <div class='data'><label for='FName'><h4>First Name:</h4></label>
                <input type='text' name='new_fname' class='Fcont' id='Email' placeholder= 'first name'   value='".$row[0]."' required></div><br><div class='data'><label for='lName'><h4>Last Name:</h4></label><input type='text' name='new_lname' class='Fcont' id='Email' placeholder=' last name ' value='".$row[1]."' required></div><br><div class='data'><label for='phone'><h4>Phone:</h4></label><input type='text' name='new_phn' class='Fcont' id='Phone' placeholder= 'phone number' maxlength='10' minlength='10' value= '".$row[3]."' required></div><br><div class='data'>
                   <label for='Email'><h4>Email:</h4></label>
                    <input type='email' class='Fcont' id='Email' placeholder='enter email' value='".$row[4]."' name='new_email' >
                </div><br>
                <div class='data'>
                   <label for='pass'><h4>Password:</h4></label>
                    <input type='password' class='Fcont' id='pass' placeholder='enter password' value='".$row[6]."' name='new_password' >
                </div><br>   
                <div class='data'>
                    <h4>Gender:</h4>
                    <label><input name='new_gender' type='radio' value='Female' ".$famale."  >
                    Female</label><br>
                    <label><input name='new_gender' type='radio' value='Male' ".$male." >Male
                    </label><br><br>";
                        
                          ?> 
                <!--<div class="data">
                   <label for="Email"><h4>Email:</h4></label>
                    <input type="text" class="Fcont" id="Email" placeholder="enter email">
                </div><br>
                <div class="data">
                    <h4>Gender:</h4>
                    <label><input name="Gender" type="radio" value="Female" checked >
                    Female</label><br>
                    <label><input name="Gender" type="radio" value="Male"  >Male
                    </label><br><br>-->
                    <input type="submit" name="update" value="Save" class="button">
                    
                </div>
            </div>
        
        <br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br> </form>

        
        
        <?php

if(isset($_POST['update'])){
    
    

    $FName = $_POST["new_fname"];
    $LName = $_POST["new_lname"];
    $phn = $_POST["new_phn"];
    $nemail = $_POST["new_email"];
    $ngender = $_POST["new_gender"];
    $npass = $_POST["new_password"];
    
    $photo_name=($_FILES['uploadfile']['name']!=null)?$_FILES['uploadfile']['name']:"";


    if($photo_name!=""){
    $photo_tmp_name=$_FILES['uploadfile']['tmp_name'];
    $imageFileType = strtolower(pathinfo( $photo_name,PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed!')</script>";
      exit();
      }}
else{
    $query="select profilePhoto from petowner WHERE email='".$Email."'";  
          $result=mysqli_query($database,$query);
          $row=mysqli_fetch_row($result);
          $photo_name=$row[0];
}
if($oldphone != $phn){
 if(!preg_match('/^[0-9]{10}+$/', $phn)){
  echo "<script>alert('phone number should be NUMBERS only!')</script>";  
  exit();
}}

    if (preg_match('/[0-9]+/', $FName)) {
    echo "<script>alert('Name should not have a number!')</script>";  
    exit();
  }
  
  if (preg_match('/[0-9]+/', $LName)) {
    echo "<script>alert('Name should not have a number!')</script>";  
    exit();
  }
    

  

  move_uploaded_file($photo_tmp_name, 'profile_img/'.$photo_name);

  
    $sql="UPDATE petowner SET Fname='$FName',Lname='$LName',phoneNumber='$phn',profilePhoto='$photo_name',email='".$nemail."',gender='".$ngender."',password='".$npass."' WHERE email='".$_SESSION['email']."' ";
    
 
    $result=mysqli_query($database,$sql);
    if($result){
        echo"<script>alert('profile updated successfully !! ');</script>";
        $_SESSION['email'] = $nemail;
        header("location: userProfile.php");
    }
    else{
        echo"<script>alert('profile can't updated !');</script>"; 
    }
}
        
        
?>
    </body>
</html>