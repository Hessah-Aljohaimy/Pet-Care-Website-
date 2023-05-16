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
        <title>My Pets Profile</title>
       <link rel="stylesheet" href="petstyle.css">
        <!--<link rel="stylesheet" href="profileStyle.css">-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



    </head> 
<body>
    <div class="grid">
        <div class="nav-bar">
            <ul id="ul">
              <img src="logo.png" alt="logo" class="nav-bar-logo"width="100">
              <li class="nav-bar-item" id="active"><a href="home page.php">Log Out</a></li>
              <li class="nav-bar-item" id="active"><a href="addPet.php">Add Pet</a></li>
              <li class="nav-bar-item" id="active"><a href="welcom.php">Home</a></li>
            </ul>
        </div>           
    </div>

    <?php


if (!( $database = mysqli_connect( "localhost", "root", "" )))
die( "<p>Could not connect to database</p>" );

if (!mysqli_select_db( $database, "webpro" ))
die( "<p>Could not open URL database</p>" );

$ownerEmail=$_SESSION['email'];
//$ownerEmail="sara@gmail.com";

$query="select name,photo,DOB,gender,breed,SNstatus,vaccination_list,medical_history from pet WHERE owneremail='".$ownerEmail."'";  

$run=mysqli_query($database, $query);  

if($run){

  while($row=mysqli_fetch_row($run)){  
      $vaccination_list=($row[6]==null)?"None":$row[6];
      $medical_history=($row[7]==null)?"None":$row[7];
      
   echo "<div class='container' id='$row[0]'>
   <div class='P-box'>
   <h2>$row[0]</h2>
   <img src='profile_img/$row[1]' alt='$row[1]' class='P-pic'>

   <div class='information'>
       <div class='data'>
           <h4><strong>Date of Birh:</strong></h4><br>
           <p>$row[2]</p>
       </div>
       <div class='data'>
           <h4><strong>Gender:</strong></h4><br>
           <p>$row[3]</p>
       </div>
       <div class='data'>
           <h4><strong>Breed:</strong></h4><br>
           <p>$row[4]</p>
       </div>
       <div class='data'>
           <h4><strong>Spayed/neutred sataus:</strong></h4><br>
           <p>$row[5]</p>
       </div>
       <div class='data'>
           <h4><strong>Vaccinations:</strong></h4><br>
           <ul>
               <li>$vaccination_list</li><br>
           </ul>
       </div>
       <div class='data'>
           <h4><strong>Medical history:</strong></h4><br>
           <ul>
               <li>$medical_history</li><br>
           </ul>
       </div>
   </div>
   
   <button type='submit'  class='button'> <a href='editpet.php?petName=$row[0]'>Edit</a> </button>
   <br>
   <button type='button' class='button'  onclick='deleteAjax($row[0])'>  Delete </button>

  </div>
</div>  

<br><br><br>";

  }
}


?>   
<?php
   ?>

<script type="text/javascript">
	 
	 function deleteAjax(id){
         
       if(confirm('are You sure?')){
           var a = id.getAttribute("id");
              
           $.ajax({
            

              type:'post',
              url:'delete_pet.php',
              data:{a:a},
              success:function(data){
                  $(id).hide();
              }

         });
            
       }
         
	 }

</script>

</body>
</html>