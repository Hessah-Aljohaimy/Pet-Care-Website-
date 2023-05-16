<?php
session_start();

if(!isset($_SESSION['email'])) {
  header("location:login.php");
  exit();
}

?>



<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="viewPetProfile.css">
    <title>Pet profile</title>
</head>
    
<body>
        
        <div class="header">
            <ul>
                <li><img src="logo.png" alt="logo" class="logo"></li>
                <li class="header-item"><a href="home%20page.php">Log out</a></li>
                <li class="header-item"><a href="manage%20appointments.php">back</a></li>
                <li class="header-item"><a href="home%20page-manger.php">Home</a></li>
            </ul>
        </div>
<br><br><br><br>

    
    
    <?php
   $appointmentNumber = $_GET['param1']; 
    $appointmentPetName=$_GET['param2'];
//        print_r($_GET);
//        echo $appointmentNumber;

                        
   $queryPets = "SELECT `name`, `DOB`, `breed`, `vaccination_list`, `photo`, `medical_history`, `gender`, `SNstatus`, `ownerEmail` FROM `pet` WHERE `ownerEmail`='$appointmentNumber'AND `name`='$appointmentPetName';";
                       
      
      if(!($database =mysqli_connect("localhost","root","")))
          die("<P>Could not connect to database </p>");
      if(!mysqli_select_db($database,"webpro"))
          die("<P>Could not open Pet Care database </p>");
if(!($resultPets= mysqli_query($database,$queryPets))){
    print("<p>Could not execute query</p>");
              die(mysqli_error());
    
    
}
   ?>   
    
   <?php             
//fetch each recored 
      if(mysqli_num_rows($resultPets)>0){
           
          
          
          
          
         for($counter=0;$row=mysqli_fetch_assoc($resultPets);++$counter){

          
$vaccination_list=($row['vaccination_list']==null)?"None":$row['vaccination_list'];             
 $medical_history=($row['medical_history']==null)?"None":$row['medical_history'];            

             
             
             
             
             
             
 print("    <div class='container'>
<div class='P-box'>
            <h2>".$row['name']."</h2>
            <img src=".$row['photo']." alt='pet pic' class='P-pic' name='imgPet'>
            <div class='information'>
                <div class='data'>
                    <h4><strong >Date of Birh:</strong></h4><br>
            <p name='DOB'>".$row['DOB']."</p>
                </div>
                <div class='data'>
                    <h4><strong>Gender:</strong></h4><br>
            <p name='gender'>".$row['gender']."</p>
                </div>
                <div class='data'>
                    <h4><strong>Breed:</strong></h4><br>
            <p name='breed'>".$row['breed']."</p>
                </div>
                <div class='data'>
                    <h4><strong>Spayed/neutred sataus:</strong></h4><br>
             <p name='SNstatus'>".$row['SNstatus']."</p>
                </div>
                <div class='data'>
                    <h4><strong>Vaccinations:</strong></h4>
            <ul name='vaccination_list'>
                      <li>$vaccination_list</li><br>
                    </ul>
                </div>
                    <div class='data'>
                    <h4><strong>Medical History:</strong></h4>
               <ul name='medical_history'>
                      <li>$medical_history</li><br>
                    </ul>
                            
                    
                    
                </div>
            </div>
            
            
            
            
            
                        <a href='mailto:".$_GET['param1']."'><button  type='button' class='button'>Contact the owner</button></a>
        </div>
    </div>
           
   
    
            
            
            ");
                 
         
   
                 
             }
         
         
         
         
       
         
         }
          
           
       
          
      
          
                        
                        
                        
         ?>
            
    
    
    

    
    
    
    
    
    
    
    
<!--
    
    
    
    
    
<div class="container">
<div class="P-box">
            <h2 name='name'>Goosy</h2>
            <img src="./whiteCat.jpg" alt="Goosy pic" class="P-pic" name='imgPet'>
            <div class="information">
                <div class="data">
                    <h4><strong >Date of Birh:</strong></h4><br>
                    <p name='DOB'>12/3/2021</p>
                </div>
                <div class="data">
                    <h4><strong>Gender:</strong></h4><br>
                    <p name='gender'>Female</p>
                </div>
                <div class="data">
                    <h4><strong>Breed:</strong></h4><br>
                    <p name='breed'>Norwegian Forest</p>
                </div>
                <div class="data">
                    <h4><strong>Spayed/neutred sataus:</strong></h4><br>
                    <p name='SNstatus'>Spayed</p>
                </div>
                <div class="data">
                    <h4><strong>Vaccinations:</strong></h4>
                    <ul name='vaccination_list'>
                        <li>Rabies</li><br>
                        <li>Bordetella</li>
                    </ul>
                </div>
            </div>
            <a href="mailto:petOwenr@example.com"><button  type="button" class="button">Contact the owner</button></a>
        </div>
    </div>
    
-->
    <div><?php include("footer.php"); ?></div>
    </body>
</html>