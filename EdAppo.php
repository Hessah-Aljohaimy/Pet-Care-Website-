<?php
session_start();

if(!isset($_SESSION['email'])) {
  header("location: login.php");
  exit();
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
    <link rel="stylesheet" href="Style.css">
<style>
 

</style>
</head>
<body>
  <div class="grid">
    <div class="nav-bar-logn">
    <ul id="ullogin">
      <li><img src="logo.png" alt="logo" class="nav-bar-logo" ></li>
      <li class="nav-bar-item-logn" id="activelogn"><a href="home%20page.php">Log Out</a></li>
      <li class="nav-bar-item-logn" id="activelogn"><a href="App.php">Back</a></li>
        <li class="nav-bar-item-logn" id="activelogn"><a href="welcom.php">Home</a></li>


      </ul>
</div>
</div>
    <form method="post" action="#">
      <h1 class="hReq">Edit appointment</h1>

    <div id="divReq"><h1> Choose new pet:</h1>
        
         <?php

      $query = "SELECT * FROM `pet`WHERE `owneremail`='".$_SESSION['email']."'; ";
      
      if(!($database =mysqli_connect("localhost","root","")))
          die("<P>Could not connect to database </p>");
      if(!mysqli_select_db($database,"webpro"))
          die("<P>Could not open Pet Care database </p>");
if(!($result= mysqli_query($database,$query))){
    print("<p>Could not execute query</p>");
              die(mysqli_error());

} 
      
      
      ?>
        <?php
//fetch each recored 
      if(mysqli_num_rows($result)>0){
         for($counter=0;$row=mysqli_fetch_assoc($result);++$counter){
//bulid the div element
             $name=$row['name'];

             print("  <label class='container-pet'>$name <input type='radio' ");
                   if(($counter==0))
                   print("checked='checked'");
             
                print(" name='ChoosePet' value='$name'><span class='checkmark'></span>
     </label> ");
         
         }//end for
      }//end if

      
 
      ?>  
        
        
<!--
        
      <label class="container-pet">Goosy
        <input type="radio" checked="checked" name="ChoosePet" checked>
        <span class="checkmark"></span>
      </label>
      <label class="container-pet">Loosy
        <input type="radio" name="ChoosePet">
        <span class="checkmark"></span>
      </label>
-->
     
    </div>

    
    <div id="divReq"><h1> Choose the  new service, date and time:</h1>

    <?php
$appointmentNumber = $_GET['param']; 

//global $sNumber;      
global $sName;
global $sDate;
global $sTime;
$query="select serviceName,date,time,appoNum from appointment WHERE satatus=''";
$run=mysqli_query($database,$query);  

if(mysqli_num_rows($run)>0){

  while($row=mysqli_fetch_row($run)){  
    $time=date('h:i a',strtotime($row[2]));
  echo "  <label class='container-pet'>$row[0] $row[1] $time
  <input type='radio' checked='checked' name='appInfo' id='$row[3]' value='$row[3]'>
  <span class='checkmark'></span>
</label>";
      $sName= $row[0];
      $sDate=$row[1];
      $sTime=$row[2];
//  $sNumber=$row[3];
  }

}
else
    echo "<h3>No appointment available yet</h3>";

?>
 </div>
<div id="divReq"><h1> Any Addtional Note:</h1>

    <textarea rows="5" cols="5" class="form__input" placeholder="Note" name="lnO" id="ln" ></textarea>

</div>    


<div class="buttonss">

    <button type="submit" class="registerbtn">Save</button>
  
</div>
    </form>
      
    <?php
    

    
   /*
   
   
  //query
    $qq="UPDATE `appointment` SET `satatus`='',`note`='',`petName`=NULL,`owneremail`=NULL WHERE `appoNum`='$appointmentNumber';";
    
    
  $run= 
  mysqli_query($database, $qq) or die (mysqli_error());  
    if($run){
        echo "<script>alert('The appointment has been cancelled successfully');</script>";
    }
    else{
      echo "<script>alert('The appointment  failed to cancel');</script>";  
    }

   
   
   */ 
  
        //form inputs
   
//       
//if (isset($_POST['submit'])) {
       
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
$petName=$_POST["ChoosePet"];            
$Note=$_POST['lnO'];
$ownerEmail=$_SESSION['email'];
$appontmentInfo=$_POST['appInfo'];
    
//    echo "<script>alert('$appontmentInfo');</script>";
    
    //set null to prevoius appointment
    $qq="UPDATE `appointment` SET `satatus`='',`note`='',`petName`=NULL,`owneremail`=NULL WHERE `appoNum`='$appointmentNumber';";
     mysqli_query($database, $qq) or die (mysqli_error());  
    
    
    
    //set new values to new appointment

    $queryUpdate= "UPDATE `appointment` SET `satatus`='request',`note`=' $Note',`petName`='$petName',`owneremail`='$ownerEmail' WHERE `appoNum` =  '$appontmentInfo' ";
            
   
           if(!(mysqli_query($database,$queryUpdate)) )
            echo "<script>alert('could not edit Appointment!')</script>"; 
            
           else{
            echo "<script>alert('Appointment has been edited successfully!')</script>";
               mysqli_close($database);
            echo "<script>window.location.assign('app.php')</script>";}
      
       
           
//         header("Location: app.php");
        }
//    }
        ?>

 <?php include("footer.php"); ?>
</body>
</html>