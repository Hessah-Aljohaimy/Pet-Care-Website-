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

        <title>Edit pet profile</title>

        <link rel="stylesheet" href="EdProSt.css">
        <link rel="stylesheet" href="profileStyle.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    </head>

    <body>

        <div class="grid">
            <div class="nav-bar">

            <ul id="ul">

              <img src="./PetcareLogo.png" alt="logo" class="nav-bar-logo"width="100" height="130"  >

              <li class="nav-bar-item" id="active"><a href="home%20page.php">Log Out</a></li>
              <li class="nav-bar-item" id="active"><a href="petprof.php">Back</a></li>
              <li class="nav-bar-item" id="active"><a href="welcom.php">Home</a></li>

              </ul>

        </div>

        </div>        

        <div class="container">

            <div class="P-box">

                <h2>Edit My Pet Profile</h2>

                <form method='post' action='#' enctype="multipart/form-data" >
                    
                    <?php 
                    
                    if (!( $database = mysqli_connect( "localhost", "root", "" )))
           die( "<p>Could not connect to database</p>" );

            if (!mysqli_select_db( $database, "webpro" ))
            die( "<p>Could not open URL database</p>" );
            $petName=$_GET['petName'];
            $Email=$_SESSION['email'];
                    
          $query="select * from pet WHERE ownerEmail='".$Email."' AND name = '".$petName."'";  
                    
          $result=mysqli_query($database,$query);
          $row=mysqli_fetch_row($result);

                
                /*
                
                <div class="PPic">
                    <img src="whiteCat.jpg"  id="pic" >

                        <input type="file" id="File">

                        <label for="File" id="upload">Edit</label>

                </div>

                
                
                */
                $Spayed="";
                $Neutered="";
                $male="";
                $female="";
                    $gender=$row[6];
                if($gender=="Male"){
                    $male = "checked";
                }
                else{
                    $female = "checked";
                }
                    
                       $SNstutes=$row[7];
                if($SNstutes=="Spayed"){
                    $Spayed = "checked";
                }
                else{
                    $Neutered = "checked";
                }
                    
                    
                    Print " <center> <label>
                <div class='profile-pic-div'>
                  <img src='profile_img/$row[4]' id='photo'>
                    <input type='file' id='file' name='uploadfile'>
                    <label for='file' id='uploadBtn'>Choose Photo</label>
                    <script src='profilePhpto.js'></script>
                  </div>
               </label></center>
               
                <div class='data'>

                    <label for='Pet name'><h4>Pet name:</h4></label>

                    <input type='text' class='Fcont' id='Email' name='Pname' value='$row[0]' required>

                </div><br>

                <div class='data'>

                    <label for='petBirth'><h4>Date of birth:</h4></label>

                    <input type='text' class='Fcont' id='Phone' name='PDOB' value='$row[1]' required>

                </div><br>

               

                <div class='data'>

                    <h4>Gender:</h4>

                    <label><input name='Gender' type='radio' value='Female' ".$female." >

                    Female</label><br>

                    <label><input name='Gender' type='radio' value='Male' ".$male.">Male

                    </label><br><br>

                </div>

                <div class='data'>

                    <label for='breed'><h4>Breed:</h4></label>

                    <input type='text' class='Fcont' id='Email' name='breed' value='$row[2]' required >

                </div><br>

                <div class='data'>

                    <h4>Spayed/Neutered?:</h4>

                    <label><input name='status' type='radio' value='Spayed' $Spayed >

                        Spayed</label><br>

                    <label><input name='status' type='radio' value='Neutered' $Neutered >Neutered

                    </label><br><br>

                </div>

 

                <div class='data'>

                    <label for='Vac'><h4>Vaccination:</h4></label>

                    <input type='text' class='Fcont' name='VaccList' id='ln' value='$row[3]' ></input>

                               

            </div><br>

 

            <div class='data'>

                <label for='Vac'><h4>Medical history:</h4></label>

                <input type='text' class='Fcont' name='MedHis' id='ln' value='$row[5]' ></input>

                            </div><br>

 
            
        "

?>
                    
          <input type="submit" name="update" value="Save" class="button">

                    
                    <script>
$( "#Phone" ).datepicker({
   maxDate: 0,dateFormat: 'yy-mm-dd' //restrict user to choose future date
}); </script>
                    
                    
                    </form>
        </div>

       
</div>
        
     <?php

if(isset($_POST['update'])){
    
    $Pname = $_POST["Pname"];
    $DOB = $_POST["PDOB"];
    $gender = $_POST["Gender"];
    $breed = $_POST["breed"];
    $status = $_POST["status"];
    $VaccList = $_POST["VaccList"];
    $MedHis = $_POST["MedHis"];
    
    $photo_name=($_FILES['uploadfile']['name']!=null)?$_FILES['uploadfile']['name']:"";

//     $query="select name from pet WHERE ownerEmail='".$Email."' AND name = '".$petName."' ";  
//     $result=mysqli_query($database,$query);
    
//    if(mysqli_fetch_row($result)!=null){
//     echo "<script>alert('you have a pet with the same name!')</script>";
//     exit();
//    }


    if($photo_name!=""){
    $photo_tmp_name=$_FILES['uploadfile']['tmp_name'];
    $imageFileType = strtolower(pathinfo( $photo_name,PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed!')</script>";
      exit();
      }}
else{
    $query="select photo from pet WHERE ownerEmail='".$Email."' AND name = '".$petName."' ";  
          $result=mysqli_query($database,$query);
          $row=mysqli_fetch_row($result);
          $photo_name=$row[0];
}


    if (preg_match('/[0-9]+/', $Pname)) {
    echo "<script>alert('Name should not have a number!')</script>";  
    exit();
  }
  
  if (preg_match('/[0-9]+/', $breed)) {
    echo "<script>alert('Breed should not have a number!')</script>";  
    exit();
  }
    

   
    
  move_uploaded_file($photo_tmp_name, 'profile_img/'.$photo_name);

  
    $sql="UPDATE pet SET name='$Pname',DOB='$DOB',breed='$breed',gender='$gender',SNstatus='".$status."',	vaccination_list='".$VaccList."',medical_history='".$MedHis."' ,photo='$photo_name' WHERE ownerEmail='".$_SESSION['email']."' AND name = '".$petName."' ";
    
 
    $result=mysqli_query($database,$sql);
    if($result){
        echo"<script>alert('Pet profile updated successfully !! ');</script>";
        echo "<script>window.location.assign('petprof.php')</script>";
    }
    else{
        echo"<script>alert('Pet profile can't updated !');</script>"; 
    }
}
        
        
?>
    </body>
</html>