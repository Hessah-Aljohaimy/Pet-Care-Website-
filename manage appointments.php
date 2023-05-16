<?php
session_start();

if(!isset($_SESSION['email'])) {
  header("location: login.php");
  exit();
}

$query3 = "update appointment set satatus='previous' where date<'".date("20y-m-d")."'";
                       
      
      if(!($database =mysqli_connect("localhost","root","")))
          die("<P>Could not connect to database </p>");
      if(!mysqli_select_db($database,"webpro"))
          die("<P>Could not open Pet Care database </p>");
if(!($result1= mysqli_query($database,$query3))){
    print("<p>Could not execute query</p>");
              die(mysqli_error());}

?>


<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="manageAppointments.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
</script>
    <title>Appointments</title>
</head>
    
<body>
    <div class="appointments-container">
        
        <div class="header">
            <ul>
                <li><img src="logo.png" alt="logo" class="logo"></li>
                <li class="header-item"><a href="home%20page.php">Log Out</a></li>
                <li class="header-item"><a href="#">Appointments</a></li>
                <li class="header-item"><a href="home%20page-manger.php">Home</a></li>
            </ul>
        </div>
        
                <div class="nav">
            <ul>
                <li class="nav-item"><a href="viewApp.php">Available appointments</a></li>
                <li class="nav-item"><a href="#previous-appointments">Previous appointments</a></li>
                <li class="nav-item"><a href="#upcoming-appointments">Upcoming appointments</a></li>
                <li class="nav-item"><a href="#request-list">Requested appointments</a></li>
            </ul>
        </div>
        
        
        <div id="request-list">
            <fieldset><legend>Requests List</legend>
 <?php
                        
$query1 = "SELECT * FROM `appointment`";
                       
      
if(!($database =mysqli_connect("localhost","root","")))
          die("<P>Could not connect to database </p>");
if(!mysqli_select_db($database,"webpro"))
          die("<P>Could not open Pet Care database </p>");
if(!($result1= mysqli_query($database,$query1))){
    print("<p>Could not execute query</p>");
              die(mysqli_error());
    
    
}
  ?>
                
<?php             
//fetch each recored 
if(mysqli_num_rows($result1)>0){
          
          
   //  <button  name='aceeptApp' ></button>       
          print("<div class='row'>");
          
         for($counter=0;$row=mysqli_fetch_assoc($result1);++$counter){
//bulid the div element
//             print_r($row[3]);
             if(strcmp($row['satatus'], 'request') == 0){
           $amOrpm;      
        if( $row['time']<11)
            $amOrpm='am';
                 else
                     $amOrpm='pm';
         
                 
                 $x=$row['petName'];
                 
   $query2 = "SELECT * FROM `pet` WHERE name ='$x'"; 
      
                 
                 
       if(!($database2 =mysqli_connect("localhost","root","")))
          die("<P>Could not connect to database </p>");
      if(!mysqli_select_db($database2,"webpro"))
          die("<P>Could not open Pet Care database </p>");           
         $result2 = mysqli_query($database2,$query2) or die (mysqli_error());  
                 
                 
$rr=mysqli_fetch_assoc($result2);
                 $immmg=$rr['photo'];
            
         
            
             print(" 
             
                
             <div class='appion-card'>
           <form method='POST' id='".$row['appoNum']."'> 
                <h4>Pet Name: ".$row['petName']."<a 
                class='anchor-profile' href='viewPetProfile.php?param1=".$row['owneremail']."
               &amp;param2=".$row['petName']."
                ' >view profile</a></h4>
                <p>Service: ".$row['serviceName']."</p>
              <p>Time: ".date("h:i", strtotime($row['time'])).$amOrpm."</p>
              <p>Date: ".$row['date']."</p>
              <p>note:  ".$row['note']."</p>
          
           
           
 <a id=accept onClick='acceptId(".$row['appoNum'].")' name='accept' type='submit'
 
  href='manage appointments.php?param=".$row['appoNum']."'>Accept</a>         

<a id=decline onclick='deleteAjax(".$row['appoNum'].")' name='decline'>Decline</a>
               
               
             </form>
                </div>
                  
             "); 
              
                        
             }}

        print("</div>");
  
      }
          
                
                        
                    ?>
<!--
                <div class="appion-card">
                <h4>Pet Name: Goosy<a class="anchor-profile" href="viewPetProfile.html">view profile</a></h4>
                <p>Service: Grooming</p>
                <p>Time: 1pm</p>
                <p>Date: 15/5/2022</p>
                <p>note: be careful</p>
                <a>Accept</a>
                <a>Decline</a>
                </div>
-->
            </fieldset>
        </div>
        
        
 
        <script>

                
//function acceptId(id){
//
//    alert("111111111"+" "+id);
// $.ajax({
// type:"POST",
//url:'acceptApp.php',
//
//    data:{id:id},
//           contentType: "application/json; charset=utf-8",
//            dataType: "json",
//    success:function(data){
//        if(data==true)
//alert("The Appointment has been accepted successfully");
//            }
//     failure: function (response) {
//                alert(data);
//            }
//        });
//}
         
            
        function deleteAjax(id){
            if(confirm('Are You Sure To Decline The Request?')){
                $.ajax({
 type:"POST",
url:'delete appointment.php',

    data:{id:id},
    success:function(data){
$("#card"+id).hide("slow");
            }
        });
                
            }window.location.assign("manage%20appointments.php");
            
        } 
                

        
        //for takeing inputs
         

   
               </script>
        
        
      <?php 


    
     if(!($database =mysqli_connect("localhost","root","")))
          die("<P>Could not connect to database </p>");
      if(!mysqli_select_db($database,"webpro"))
          die("<P>Could not open Pet Care database </p>");       
    
    
    if(isset($_GET['param'])){
        $id = $_GET['param'];
        $update = "UPDATE `appointment` SET `satatus`='upcoming' WHERE  `appoNum` = '".$id."';";
        
  if(mysqli_query($database, $update))
      echo "<script>window.location.assign('manage%20appointments.php')</script>";  
    }

//header("Refresh:0");
        
        
//?>                
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <div id="upcoming-appointments">
            <fieldset><legend>Upcoming Appointments</legend>
                                                      <?php
                        
   $query1 = "SELECT * FROM `appointment`";
                       
      
      if(!($database =mysqli_connect("localhost","root","")))
          die("<P>Could not connect to database </p>");
      if(!mysqli_select_db($database,"webpro"))
          die("<P>Could not open Pet Care database </p>");
if(!($result1= mysqli_query($database,$query1))){
    print("<p>Could not execute query</p>");
              die(mysqli_error());
    
    
}
   ?>  
                
                <?php             
//fetch each recored 
if(mysqli_num_rows($result1)>0){
          
          
          
          
           print("<div class='row'>");
         for($counter=0;$row=mysqli_fetch_assoc($result1);++$counter){
//bulid the div element
//             print_r($row[3]);
             if(strcmp($row['satatus'], 'upcoming') == 0){
           $amOrpm;      
        if( $row['time']<11)
            $amOrpm='am';
                 else
                     $amOrpm='pm';
         
                 
                 $x=$row['petName'];
                 
   $query2 = "SELECT * FROM `pet` WHERE name ='$x'"; 
      
                 
                 
       if(!($database2 =mysqli_connect("localhost","root","")))
          die("<P>Could not connect to database </p>");
      if(!mysqli_select_db($database2,"webpro"))
          die("<P>Could not open Pet Care database </p>");           
         $result2 = mysqli_query($database2,$query2) or die (mysqli_error());  
                 
                 
$rr=mysqli_fetch_assoc($result2);
                 $immmg=$rr['photo'];
            
         
            
             print(" <div class='appion-card'>
                <h4>Pet Name: ".$row['petName']."<a 
                class='anchor-profile' href='viewPetProfile.php?param1=".$row['owneremail']."
               &amp;param2=".$row['petName']."
                ' >view profile</a></h4>
                <p>Service: ".$row['serviceName']."</p>
              <p>Time: ".date("h:i", strtotime($row['time'])).$amOrpm."</p>
              <p>Date: ".$row['date']."</p>
              <p>note:  ".$row['note']."</p>
             <a href=mailto:".$row['owneremail'].">Contact the owner</a>
                </div>
             "); 
              
                        
             }}
      
        print("</div>");
      }
                  
                        
                        ?>
                
                
                
                
<!--
                <div class="appion-card">
                <h4>Pet Name: Goosy <a class="anchor-profile" href="viewPetProfile.html">view profile</a></h4>
                <p>Service: Grooming</p>
                <p>Time: 10am</p>
                <p>Date: 12/4/2022</p>
                <p>note: Make her a lion hairstyle</p>
                <a href="mailto:petOwenr@example.com">Contact the owner</a>
                </div>
                
                <div class="appion-card">
                <h4>Pet Name: Loosy <a class="anchor-profile" href="viewPetProfile1.html">view profile</a></h4>
                <p>Service: Grooming</p>
                <p>Time: 4pm</p>
                <p>Date: 13/4/2022</p>
                <p>note: Please give her a trim</p>
                <a href="mailto:petOwenr@example.com">Contact the owner</a>
                </div>
-->
                
            </fieldset>
        </div>
        
        <div id="previous-appointments">
            <fieldset><legend>Previous Appointments</legend>
                                                      <?php
                        
   
    
    $query1 = "select * FROM `appointment` ";
                       
      
      if(!($database =mysqli_connect("localhost","root","")))
          die("<P>Could not connect to database </p>");
      if(!mysqli_select_db($database,"webpro"))
          die("<P>Could not open Pet Care database </p>");
if(!($result1= mysqli_query($database,$query1))){
    print("<p>Could not execute query</p>");
              die(mysqli_error());
    
}
   ?>  
                 
                <?php             
//fetch each recored 
if(mysqli_num_rows($result1)>0){
          
          
          
          
              print("<div class='row'>");
         for($counter=0;$row=mysqli_fetch_assoc($result1);++$counter){
//bulid the div element
//             print_r($row[3]);
             if(strcmp($row['satatus'], 'previous') == 0){
           $amOrpm;      
        if( $row['time']<11)
            $amOrpm='am';
                 else
                     $amOrpm='pm';
         
                 
                 $x=$row['petName'];
                 
   $query2 = "SELECT * FROM `pet` WHERE name ='$x'"; 
      
                 
                 
       if(!($database2 =mysqli_connect("localhost","root","")))
          die("<P>Could not connect to database </p>");
      if(!mysqli_select_db($database2,"webpro"))
          die("<P>Could not open Pet Care database </p>");           
         $result2 = mysqli_query($database2,$query2) or die (mysqli_error());  
                 
                 
$rr=mysqli_fetch_assoc($result2);
                 $immmg=$rr['photo'];
            
         
            
             print(" <div class='appion-card'>
                <h4>Pet Name: ".$row['petName']."<a 
                class='anchor-profile' href='viewPetProfile.php?param1=".$row['owneremail']."
               &amp;param2=".$row['petName']."
                ' >view profile</a></h4>
                <p>Service: ".$row['serviceName']."</p>
              <p>Time: ".date("h:i", strtotime($row['time'])).$amOrpm."</p>
              <p>Date: ".$row['date']."</p>
              <p>note:  ".$row['note']."</p>
             
                </div>
             "); 
                
                        
             }}
      
        print("</div>");
      }
                  
                        
                        ?>
                
                
                
                
<!--
                <div class="appion-card">
                <h4>Pet Name: Loosy<a class="anchor-profile" href="viewPetProfile1.html">view profile</a></h4>
                <p>Service: Grooming</p>
                <p>Time: 10am</p>
                <p>Date: 22/3/2022</p>
                <p>note: Make her a lion hairstyle</p>
                <h5>Owner Review: Loveit!</h5>
                </div>
                
                 <div class="appion-card">
                <h4>Pet Name: Goosy<a class="anchor-profile" href="viewPetProfile.html">view profile</a></h4>
                <p>Service: boarding</p>
                <p>Time: 12pm</p>
                <p>Date: 1/3/2022</p>
                <p>note: be careful</p>
                <h5>Owner Review: Like it</h5>
                </div>
                
                 <div class="appion-card">
                <h4>Pet Name: Goosy<a class="anchor-profile" href="viewPetProfile.html">view profile</a></h4>
                <p>Service: Checkup</p>
                <p>Time: 6pm</p>
                <p>Date: 7/3/2022</p>
                <p>note: doesn’t feel will</p>
                <h5>Owner Review: Loveit!</h5>
                </div>
-->
                
            </fieldset>
        </div>
        
    </div>
    
    
    
    
    <div><?php include("footer.php"); ?></div>
    
    
</body>

</html>