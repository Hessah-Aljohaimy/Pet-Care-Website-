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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add pet</title>
    <link rel="stylesheet" href="Style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
<!--#D9C1BE #486F72 #DB9428 #B36672 #F2DBD6;-->

<form method="post" action="#" enctype="multipart/form-data">
    <div class="grid"> 

    <div class="nav-bar-logn">
        <ul id="ullogin">
            <li><img src="logo.png" alt="logo" class="nav-bar-logo" ></li>

            <li><img src="logo.png" alt="logo" class="nav-bar-logo" ></li>
            <li class="nav-bar-item-logn" id="activelogn"><a href="home page.php">Log Out</a></li>
            <li class="nav-bar-item-logn" id="activelogn"><a href="petprof.php">Back</a></li> 
              <li class="nav-bar-item-logn" id="activelogn"><a href="welcom.php">Home</a></li>
        </ul>
    </div>
    </div>
    <div class="container"> 
    <h1>Add pet</h1>

<div class="form__input-group">
    <input type="text" class="form__input" placeholder="Pet name" name="petname" id="petname" required>
    <br>
    <label><h4>Date of birth:</h4>
    <input type="text" id="datepicker"   name="dateO"  class="form__input" placeholder="Click here to chooes Date" required>
    <!-- <input type="date" class="form__input" placeholder="Date of birth" name="petdate" id="petdate" required></label> -->
    <br>
    
<center><label> <b>Gender:</b> 
        
        <input name="Gender" type="radio" value="Male" id="Male"checked><label for="Male">Male</label>
   
        <input name="Gender" type="radio" value="Female" id="Female"><label for="Female">Female</label>
   </label></center>
   <br>
    
    <input type="text" class="form__input" placeholder="Breed" name="breed" id="breed" required>
    <br>
    <br>
  </center> <label>
<center>  <div class="profile-pic-div">
        <img src="images.png" id="photo">
        <input type="file" id="file" name="uploadfile">
        <label for="file" id="uploadBtn">Choose Photo</label>
        <script src="profilePhpto.js"></script>

      </div>
   </label></center>
   <br>
   <br>
<center> <label> <b>Spayed/Neutered?:</b> 
        
        <input name="SN" type="radio" value="Spayed" id="Spayed" checked ><label for="Spayed">Spayed</label>
   
        <input name="SN" type="radio" value="Neutered" id="Neutered"><label for="Neutered">Neutered</label>
   </label></center>
   <textarea rows="4" cols="3" class="form__input" placeholder="Vaccination list" name="VL" id="vl" ></textarea>


<textarea rows="4" cols="3" class="form__input" placeholder="Medical history" name="MH" id="MH" ></textarea>

</div>    
   


  <br>
    <button type="submit" class="registerbtn">Add pet</button>

  </div> 
</form>
<script>
$( "#datepicker" ).datepicker({
   maxDate: 0 //restrict user to choose future date
}); </script>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (!( $database = mysqli_connect( "localhost", "root", "" )))
die( "<p>Could not connect to database</p>" );

if (!mysqli_select_db( $database, "webpro" ))
die( "<p>Could not open URL database</p>" );
    


$petName=$_POST["petname"];  
$petDOB=$_POST["dateO"];
$petGender=$_POST["Gender"];
$breed=$_POST["breed"];  
$SorN=$_POST["SN"];  
$VacList=isset($_POST["VL"])?$_POST["VL"]:"";
$MedHistory=isset($_POST["MH"])?$_POST["MH"]:"";
$filename = $_FILES['uploadfile']['name'];
$tempname = $_FILES['uploadfile']['tmp_name'];    

$ownerEmail= $_SESSION['email'];
 
 if($filename==null){
  echo "<script>alert('Please choose photo')</script>";  
    exit();
}

$imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));

if (preg_match('/[0-9]+/', $petName)) {
  echo "<script>alert('Name should not have a number!')</script>";  
  exit();
}

// $DOBDate = strtotime(date('Y-m-d', strtotime($petDOB) ) );
// $currentDate = strtotime(date('Y-m-d'));

// if($DOBDate <= $currentDate==false) {
//     echo "<script>alert('Date of birth should not be in the future!')</script>";
//     exit();
// }

if (preg_match('/[0-9]+/', $breed)) {
  echo "<script>alert('Breed should not have a number!')</script>";  
  exit();
}

$DOBDateForQ = date('Y-d-m', strtotime($petDOB) ) ;

$dob = date('Y-m-d', strtotime($_POST["dateO"]));  
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed!')</script>";
exit();
}
move_uploaded_file($tempname, 'profile_img/'.$filename);

$query="select name from pet WHERE name='$petName' AND owneremail='".$ownerEmail."'";
$run=mysqli_query($database, $query); 

$queryinsert="INSERT INTO pet (name, DOB, breed,vaccination_list,photo,medical_history,gender,SNstatus,ownerEmail) VALUES ('".$petName."','".$dob."','".$breed."','".$VacList."','".$filename."','".$MedHistory."','".$petGender."','".$SorN."','".$ownerEmail."');";

if($row=mysqli_fetch_row($run)==null ) {
  mysqli_query($database,$queryinsert);  
  echo "<script>alert('Pet added successfully!')</script>"; 
}

else  
  echo "<script>alert('Pet name is used before!')</script>"; 

}

?>




</div>
</body>
</html>