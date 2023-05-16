
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
    <title>Edit avilable appointment</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

</head>
<body>
<!--#D9C1BE #486F72 #DB9428 #B36672 #F2DBD6;-->

<form method="post" action="#">
    <div class="grid"> 

    <div class="nav-bar-logn">
        <ul id="ullogin">
            <li><img src="logo.png" alt="logo" class="nav-bar-logo" ></li>

       <li class="nav-bar-item-logn" id="activelogn"><a href="home page.php">Log Out</a></li>
       <li class="nav-bar-item-logn" id="activelogn"><a href="viewApp.php">Back</a></li>
       <li class="nav-bar-item-logn" id="activelogn"><a href="manage appointments.php">Appointment</a></li>
       <li class="nav-bar-item-logn" id="activelogn"><a href="home page-manger.php">Home</a></li>


        </ul>
    </div>
    </div>
    <div class="container"> 
    <h1>Edit appointment</h1>
    <h3>Choose new Service:</h3>
        
        
        
          <?php
      
      $query = "SELECT * FROM `service`";
      
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

             print(" <label class='container-pet'>$name <input type='radio' ");
                   if(($counter==0))
                   print("checked='checked'");
             
                print(" name='ChooseService' value='$name'><span class='checkmark'></span>
     </label> ");
         
         }//end for
      }//end if

       mysqli_close($database);
 
      ?>  
        
        
        
<!--
    <label class="container-pet">Checkup
        <input type="radio" checked="checked" name="ChooseService">
        <span class="checkmark"></span>
      </label>
      <label class="container-pet">Grooming
        <input type="radio" name="ChooseService"checked>
        <span class="checkmark" ></span>
      </label>
      <label class="container-pet">Boarding
        <input type="radio" name="ChooseService">
        <span class="checkmark"></span>
      </label>
      
-->

      <div class="form__input-group">
        <h3>Choose new Date and Time:</h3>
        <input type="text" class="form__input" placeholder="Enter Date" name="dateM" id="date" required>
        <br>
        <input type="text" class="form__input" placeholder="Enter Time" name="TimeM" id="timr" required>
    
          <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
              <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
		      <script>
                  $( "#date" ).datepicker({
                                  minDate: 0 ,dateFormat: 'yy-mm-dd'
                                });
                  
                  $('#timr').timepicker({
                    timeFormat: 'h:mm p',
                    interval: 30,
                    minTime: '6',
                    maxTime: '11:30am',
                    defaultTime: '6',
                    startTime: '06:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
                });
               </script>   
                  
    </div>    
  
    <button type="submit" class="registerbtn" name = "submit" value = "Submit">Save</button>

        
        

        <?php
       
    
      
    
         $appointmentNumber=$_GET['param']; 
      
        //form inputs
        
       
         if (isset($_POST['submit'])) {
             
        
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (!( $database = mysqli_connect( "localhost", "root", "" )))
die( "<p>Could not connect to database</p>" );

if (!mysqli_select_db( $database, "webpro" ))
die( "<p>Could not open URL database</p>" );
    
            
$serviceName=$_POST["ChooseService"];  
$serviceDate=$_POST["dateM"];  
$serviceTime=$_POST["TimeM"];
  

  
 $ServiceDate1 = strtotime(date('Y-m-d', strtotime($serviceDate) ) );
$currentDate = strtotime(date('Y-m-d'));

          $sql3 = "SELECT * FROM `appointment` WHERE `appointment`.`serviceName` = '$serviceName' AND `appointment`.`date` = '$serviceDate' And `appointment`.`time` = '$serviceTime';";

        $result = mysqli_query($database, $sql3);
          if(mysqli_fetch_row($result) != null){
              echo "<script>alert('This date and time already exist!');</script>"; 
          }
                else{
          
        $queryUpdate= "UPDATE `appointment` SET `date`='$serviceDate',`time`='$serviceTime',`note`='',`serviceName`='$serviceName' WHERE `appoNum` = $appointmentNumber ";
   
    mysqli_query($database,$queryUpdate);
        
  
if(!(mysqli_query($database,$queryUpdate))) 
  echo "<script>alert('could not edit Appointment!')</script>";           
else          
echo "<script>alert('Appointment has been edited successfully!')</script>";
echo "<script>window.location.href='viewApp.php';</script>";
         mysqli_close($database);  
        

        }}}

        ?>
  
        
        
        
</div></form>
    
    <?php include("footer.php"); ?>
    
    
    
    </body></html>