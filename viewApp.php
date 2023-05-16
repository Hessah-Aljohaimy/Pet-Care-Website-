
<?php
session_start();

if(!isset($_SESSION['email'])) {
  header("location: login.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avalible Appointments</title>
    <link rel="stylesheet" href="Style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
</script>


</head>
<body>
  <div class="grid">
    <div class="nav-bar-logn">
    <ul id="ullogin">
      <li><img src="logo.png" alt="logo" class="nav-bar-logo" ></li>
      <li class="nav-bar-item-logn" id="activelogn"><a href="home%20page.php">Log Out</a></li>
      <li class="nav-bar-item-logn" id="activelogn"><a href="setAppoint.php">New appointment</a></li>
        <li class="nav-bar-item-logn" id="activelogn"><a href="manage%20appointments.php">Appointments</a></li>
        <li class="nav-bar-item-logn" id="activelogn"><a href="home%20page-manger.php">Home</a></li>

      </ul>
</div>
</div>
     
<h1 class="hReq" id ="Available">Available appointment</h1>
<?php


if (!( $database = mysqli_connect( "localhost", "root", "" )))
die( "<p>Could not connect to database</p>" );

if (!mysqli_select_db( $database, "webpro" ))
die( "<p>Could not open URL database</p>" );

$query="select appoNum,serviceName,date,time from appointment WHERE satatus=''"; 
//$query="select appoNum,serviceName,date,time from appointment WHERE satatus IS NULL";  
//$query = "SELECT `appoNum`, `serviceName`,`date`, `time` FROM `appointment` WHERE `appointment`.`satatus` IS NULL;";
$run=mysqli_query($database, $query);  

if($run){
if(mysqli_fetch_row($run) != null){
    $run=mysqli_query($database, $query);  
  while($row=mysqli_fetch_row($run)){  
    $time=date('h:i a',strtotime($row[3]));
  echo "<div class='column' id=$row[0]>
  <div class='card'> <h4>New appointment</h4> 
    <p>Service: $row[1]</p> 
    <p>Date:$row[2]</p> 
    <p>Time: $time</p> 
    <button type='button'  class='EditAndDelet'> <a href='editApp.php?param=$row[0]'>Edit</a> </button>
    <button type='button' class='EditAndDelet'   onclick='deleteAjax($row[0])'>  <a>Delete</a> </button>
  </div>  
  </div>";

  }}else {print("<br><br><br><br><p>No appointment yet</p>");}
}
    

?>

<script type="text/javascript">
	 
	 function deleteAjax(id){
   
       if(confirm('are You sure?')){
         $.ajax({

              type:'post',
              url:'delete appointment.php',
              data:{id:id},
              success:function(data){
              
               $("#"+id).hide("slow");

              }

         });

       }


	 }

</script>
</body>
</html> 


 
