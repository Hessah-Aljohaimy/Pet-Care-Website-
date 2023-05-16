<?php
session_start();

if(!isset($_SESSION['email'])) {
  header("location: login.php");
  exit();
}
if (!( $database = mysqli_connect( "localhost", "root", "" )))
die( "<p>Could not connect to database</p>" );

if (!mysqli_select_db( $database, "webpro" ))
die( "<p>Could not open URL database</p>" );

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request new appointment</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


</head>
<body>
  <div class="grid">
    <div class="nav-bar-logn">
    <ul id="ullogin">
      <li><img src="logo.png" alt="logo" class="nav-bar-logo" ></li>
      <li class="nav-bar-item-logn" id="activelogn"><a href="home page.php">Log Out</a></li>
        <li class="nav-bar-item-logn" id="activelogn"><a href="App.php">Appointment</a></li>
        <li class="nav-bar-item-logn" id="activelogn"><a href="welcom.php">Home</a></li>
      </ul>
</div>
</div>
    <form method="post" action="RequestApp.php">
      <h1 class="hReq">Request an appointment</h1>

    <div id="divReq"><h1> Choose the pet:</h1>

<?php
$ownerEmail=$_SESSION['email'];
$query="SELECT name FROM pet Where ownerEmail='$ownerEmail'";
$run=mysqli_query($database, $query);  

if(mysqli_num_rows($run)>0){

  while($row=mysqli_fetch_row($run)){  
  echo "<label class='container-pet'>$row[0]
  <input type='radio' checked='checked' name='ChoosePet' id='$row[0]'  value='$row[0]'>
  <span class='checkmark'></span>
</label>";
  }
}


?>
     
    </div>
    <!-- <div id="divReq"><h1> Choose the Service:</h1>

    <
$query="SELECT name FROM service";
$run=mysqli_query($database, $query);  

if(mysqli_num_rows($run)>0){

  while($row=mysqli_fetch_row($run)){  
  echo "<label class='container-pet'>$row[0]
  <input type='radio' checked='checked' name='ChooseService' id='$row[0]' value='$row[0]'>
  <span class='checkmark'></span>
</label>";
  }
}




    </div> -->

    <div id="divReq"><h1> Choose the service, date and time:</h1>

    <?php
$query="select serviceName,date,time from appointment WHERE satatus=''";
$run=mysqli_query($database, $query);  

if(mysqli_num_rows($run)>0){

  while($row=mysqli_fetch_row($run)){  
    $time=date('h:i a',strtotime($row[2]));
  echo "  <label class='container-pet'>$row[0] $row[1] $time
  <input type='radio' checked='checked' name='appInfo' id='$row[0]' value='$row[0] $row[1] $row[2]'>
  <span class='checkmark'></span>
</label>";
  }

}
else

echo "<h3>No appointment available yet</h3>";

?>
    </div>

<div id="divReq"><h1>Any note if you want:</h1>
  <div class="form__input-group">
  <!-- <input type="text" id="datepicker"   name="dateO"  class="form__input" placeholder="Click here to chooes Date">
   <br>
    <input type="date" class="form__input" placeholder="Enter Date" name="dateO" id="date" required>
    <br>
    <input type="time" class="form__input" placeholder="Enter Time" name="TimeO" id="timr" required>
    <br> -->
    <textarea rows="5" cols="5" class="form__input" placeholder="Note" name="lnO" id="ln" ></textarea> 
    </textarea>
</div>    

</div>
<div class="buttonss">
  <button type="submit" class="registerbtn" name='newApp'>Submit</button>
</div>
    </form>
  </div>
</div>



</body>
</html>


<?php

if(isset($_POST['newApp'])) {  


 if(!isset($_POST["ChoosePet"])){
  echo "<script>alert('You have not any pet!')</script>"; 
exit();
} 
    else
        $petName=$_POST["ChoosePet"];
$appInfo=$_POST["appInfo"];
$fullIfo=explode(" ", $appInfo);
$serviceName=$fullIfo[0];
$dateOfApp=date('Y-m-d', strtotime($fullIfo[1])); 
$timeOfApp=date('H:i:s', strtotime($fullIfo[2]));
$note=isset($_POST["lnO"])?$_POST["lnO"]:"";

$ownerEmail=$_SESSION['email'];
//$ownerEmail='sara@gmail.com';




if($serviceName==null){
  echo "<script>alert('No service available yet!')</script>"; 
  exit();
}

$query="INSERT INTO appointment(date,time,satatus,note,petName,owneremail,serviceName) VALUES ('".$dateOfApp."','".$timeOfApp."','request','".$note."','".$petName."','".$ownerEmail."','".$serviceName."');";
$query3="select appoNum from appointment WHERE date='$dateOfApp'AND time='$timeOfApp'";

$run=mysqli_query($database, $query3); 
$row=mysqli_fetch_row($run);

$query2="update appointment set satatus='request',note='$note',petName='$petName',owneremail='$ownerEmail' WHERE appoNum=$row[0]";
$run=mysqli_query($database, $query2); 

echo "<script>alert('you request new appointment successfully!')</script>"; 


header("Refresh:0"); 
}
?>


  
  