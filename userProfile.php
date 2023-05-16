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
        <meta charset="utf-8">
        <title>My Profile</title>
        <link rel="stylesheet" href="profileStyle.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
<body>

        
        <div class="grid">
            <div class="nav-bar">
            <ul id="ul">
              <img src="logo.png" alt="logo" class="nav-bar-logo"width="100">
              <li class="nav-bar-item" id="active"><a href="home page.php">Log Out</a></li>
              <li class="nav-bar-item" id="active"><a href="welcom.php">Home</a></li>
              
              </ul>
              
        </div>
        </div>   
        <?php

if (!( $database = mysqli_connect( "localhost", "root", "" )))
die( "<p>Could not connect to database</p>" );

if (!mysqli_select_db( $database, "webpro" ))
die( "<p>Could not open URL database</p>" );

$Email=$_SESSION['email'];

$query="select email,Fname,Lname,profilePhoto,phoneNumber,gender from petowner WHERE email='".$Email."'";  

$run=mysqli_query($database, $query);  

if($run){
    while($row=mysqli_fetch_row($run)){ 
echo"<div class='container' id='$row[0]'>
            <div class='P-box'>
                <h2 >My Profile</h2>
                <img src='profile_img/$row[3]' alt='$row[3]' class='P-pic'>
                <div class='information'>
                    <div class='data'>
                        <h4><strong>First name:</strong></h4>
                        <p>$row[1]</p>
                    </div>
                    <div class='information'>
                    <div class='data'>
                        <h4><strong>Last name:</strong></h4>
                        <p>$row[2]</p>
                    </div>
                    <div class='data'>
                       <h4>Phone:</h4>
                       <p>$row[4]</p>
                    </div>
                    <div class='data'>
                        <h4>Email:</h4>
                        <p>$row[0]</p>
                    </div>
                    <div class='data'>
                        <h4>Gender:</h4>
                        <p>$row[5]</p>
                    </div>
                </div>
                <button type='button'  class='button'> <a href=' editprofile.php?param=$row[0]'>Edit</a> </button><br>
                <button type='button' class='button'  onclick='deleteAjax()'>  Delete </button><br>
               
             
            </div>

         </div>";
}   }   
	 
	 

?>
<script type="text/javascript">
	 
	 function deleteAjax(){
         
       if(confirm('are You sure?')){
      
              
           $.ajax({
            

              type:'post',
              url:'deleteAccount.php',
              success:function(data){
                  window.location.assign("home%20page.php");
              }

         });
             
       }
         
	 }

</script>

</body>
</html>