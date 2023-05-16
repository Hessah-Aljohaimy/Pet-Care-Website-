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
        
        <meta charset="UTF-8">
        <title>Owner Appointments</title>
        <link rel="stylesheet" href="appintmentOwner.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
    <div class="grid">
        <div class="nav-bar">
                <ul>
                    
                    <li><img src="logo.png" alt="logo" class="nav-bar-logo"width="100"></li>
                    <li class="nav-bar-item"><a  href="home%20page.php">Log Out</a></li>
                    <li class="nav-bar-item"><a href="#previous-appiontment">Previous</a></li>
                    <li class="nav-bar-item"><a href="#Req-appiontment">Request</a></li>
                    <li class="nav-bar-item"><a href="#uppcomming-appiontment">Uppcoming</a></li>
                    <li class="nav-bar-item"><a href="RequestApp.php">Request New Appointment</a></li>
                    <li class="nav-bar-item"><a href="welcom.php">Home</a></li>
                </ul>
        </div>
    </div>
          
               
                <div class="child1">
                    <div class="lable-b">
                       <h4 id="uppcomming-appiontment">Upcoming Appointment</h4> 
                    </div>
                    
                    
                    
                    
                    
                    <div class="container">
                        
                        
                        <?php
                        
   $query1 = "SELECT * FROM `appointment` WHERE `owneremail`='".$_SESSION['email']."';";
                       
      
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
            
         
            
             print(" <form method='POST' action='#' ><div class='card'>
             
              <img src='profile_img/$immmg' alt='pet picture' class='pet-pic' name= 'imgPet'>
             <div class='pet-data'>
             <h5>Pet Name:</h5>
              <p name='petName'>".$row['petName']."</p>
                            </div>
                            
                             <div class='pet-data'>
                                <h5>Service:</h5>
                                <p name='serviceName'>".$row['serviceName']."</p>
                            </div>
                            <div class='pet-data'>
                                <h5>Time:</h5>
                                <p name='serTime'>".date("h:i", strtotime($row['time'])).$amOrpm."</p>
                            </div>
                            
                            <div class='pet-data'>
                                <h5>Date:</h5>
                                <p name =serDate>".$row['date']."</p>
                            </div>
                            <div class='pet-data'>
                                <h5>Note:</h5>
                                <p name='serNote'>
             
             ".$row['note']."</p>
             </div>
                            </div>
                            
                         
                            
                                </form>
                            
                            "); 
                 print("<br>");
                        
             }}
      
      print("</div>");
      }
                  
                        
                        ?>
                       
                        
                        
<!--
                        <div class="card">
                            <img src="./whiteCat.jpg" alt="pet picture" class="pet-pic">
                            <div class="pet-data">
                                <h5>Pet Name:</h5>
                                <p>Goosy</p>
                            </div>
                            <div class="pet-data">
                                <h5>Service:</h5>
                                <p>Grooming</p>
                            </div>
                            <div class="pet-data">
                                <h5>Time:</h5>
                                <p>10am</p>
                            </div>
                            <div class="pet-data">
                                <h5>Date:</h5>
                                <p>12/4/2022</p>
                            </div>
                            <div class="pet-data">
                                <h5>Note:</h5>
                                <p>Make her a lion hairstyle (:</p><br>
                            </div> 
                            
                        </div>
-->
<!--
                        <div class="card">
                            <img src="./littelKitten.jpg" alt="pet picture" class="pet-pic">
                            <div class="pet-data">
                                <h5>Pet Name:</h5>
                                <p>Loosy</p>
                            </div>
                            <div class="pet-data">
                                <h5>Service:</h5>
                                <p>Grooming</p>
                            </div>
                            <div class="pet-data">
                                <h5>Time:</h5>
                                <p>4pm</p>
                            </div>
                            <div class="pet-data">
                                <h5>Date:</h5>
                                <p>13/4/2022</p>
                            </div>
                            <div class="pet-data">
                                <h5>Note:</h5>
                                <p>Please give her a trim</p><br>
                            </div> 
                            
                        </div>
-->
                    </div><!--end continaer 1-->
                    </div><!--end child 1 -->
                
                
                
              
                
                    
                    
                   
                <div class="child2">
                    <div class="lable-b">
                       <h4 id="previous-appiontment">Previous Appointment</h4> 
                    </div>
                    <div class="container">
                        
         
                                                <?php
                        
   $query1 = "SELECT * FROM `appointment` WHERE `owneremail`='".$_SESSION['email']."';";
                       
      
      if(!($database =mysqli_connect("localhost","root","")))
          die("<P>Could not connect to database </p>");
      if(!mysqli_select_db($database,"webpro"))
          die("<P>Could not open Pet Care database </p>");
if(!($result1= mysqli_query($database,$query1))){
    print("<p>Could not execute query</p>");
              die(mysqli_error());
    
    
}
   ?>     
                        
                         <?php if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) { ?>
                        <div class="success-message" style="margin-bottom: 20px;font-size: 20px;color: green;"><?php echo $_SESSION['success_message']; ?></div>
                        <?php
                        unset($_SESSION['success_message']);
                    }
                    ?>
                         <?php             
//fetch each recored 
      if(mysqli_num_rows($result1)>0){
                    print("<div class='row'>");
            $i=0;
         for($counter=0;$row=mysqli_fetch_assoc($result1);++$counter){
////bulid the div element
//             print_r($row[3]);
          
             $appoNumber[$i]=$row['appoNum'];
             $i++;
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
                 //<form method='POST' action='#' id=>
$apponum=$row['appoNum'];
              
                 print("<form method='POST' action='#' ><div class='card' name='appoNum'>
                  <img src='profile_img/$immmg' alt='pet picture' class='pet-pic' name= 'imgPet'>
                  
                  
                  <input name='appoNum' value='$apponum' type='hidden'>
                  
                  
                  
                  
                  
             <div class='pet-data'>
             <h5>Pet Name:</h5>
              <p name='petName'>".$row['petName']."</p>
                            </div>
             
                                       <div class='pet-data'>
                                <h5>Service:</h5>
                                <p name='serviceName'>".$row['serviceName']."</p>
                            </div>
                            <div class='pet-data'>
                                <h5>Time:</h5>
                                <p name='serTime'>".date("h:i", strtotime($row['time'])).$amOrpm."</p>
                            </div>
                            
                            <div class='pet-data'>
                                <h5>Date:</h5>
                                <p name =serDate>".$row['date']."</p>
                            </div>
                            <div class='pet-data'>
                                <h5>Note:</h5>
                                <p name='serNote'>
             
             ".$row['note']."</p>
                            </div>
                            
                         <div class='pet-data'>
                                <h5>how was you appointment:</h5>
                                
                                          <label><input name='rating' type='radio' value='Love it!' checked>Love it! </label>
                                <label><input name='rating' type='radio' value='Like it'>Like it </label>
                                <label><input name='rating' type='radio' value='It was okay'> It was okay</label><br>
                                <label><input name='rating' type='radio' value='Dislike'> Dislike</label>
                                <label><input name='rating' type='radio' value='Bad'>Bad </label>
                            </div>
                                
                               <div class='pet-data' >
                                <h5>Any Additional Notes:</h5>
                              <textarea rows='3' cols='28' style='width: 198px; height: 103px;' name='review'></textarea>
                            </div><input type='submit' value='Submit' class='button' name='Submit'>
                                                      
                           <div id='msgAdd'></div>
                           
                           
                           </div> 
                            
                          </form>      
                 
                 ");
                 
 
             
                 
             }
         
         
         
         
         //onclick='addReview(".$row['appoNum'].")'
         
         }
          
      //   <input type='submit' value='submit' class='button'>
          //      
            print("</div>");
          
          
      }
          
                        
                        
                        
         ?>
           
       <?php
if(isset($_POST['appoNum'])){
                            
            $num =  $_POST['appoNum'];               
if (!( $database = mysqli_connect( "localhost", "root", "" )))
die( "<p>Could not connect to database</p>" );

if (!mysqli_select_db( $database, "webpro" ))
die( "<p>Could not open URL database</p>" );
                            
 $queryCheck="SELECT * FROM review Where appoNum = $num ";                           
  $res= mysqli_query($database, $queryCheck);                          
   $isHere=0;
    
   if(mysqli_fetch_row($res)!= null){
       $isHere=1;}
        /*print($_POST['appoNum']);                        
         for($counter=0;$row=mysqli_fetch_assoc($res);++$counter){
//           
//     if($row[$counter]==$_POST['appoNum'])    
           $isHere=1;         
                        }*/
                        
                                                  
       if( $isHere==0){                     

 $addQuery="INSERT INTO `review`(`rating`, `note`, `appoNum`) VALUES ('".$_POST['rating']."','".$_POST['review']."','".$_POST['appoNum']."')";
                            
mysqli_query($database, $addQuery);       
// print_r($_POST); 
         echo "<script>alert('reviewed successfully');</script>";                   
             }
    else{

    
    echo "<script>alert('already reviewed');</script>";
    }
                 }       ?>
                        
 
                        
<!--
                        
                        
                        
                        
                        
                        <div class="card">
                            <img src="./whiteCat.jpg" alt="pet picture" class="pet-pic">
                            <div class="pet-data">
                                <h5>Pet Name:</h5>
                                <p>Goosy</p>
                            </div>
                            <div class="pet-data">
                                <h5>Service:</h5>
                                <p>Checkup</p>
                            </div>
                            <div class="pet-data">
                                <h5>Time:</h5>
                                <p>10am</p>
                            </div>
                            <div class="pet-data">
                                <h5>Date:</h5>
                                <p>22/3/2022</p>
                            </div>
                            <div class="pet-data">
                                <h5>Note:</h5>
                                <p>need a vaccination</p>
                            </div> 
                            <div class="pet-data">
                                <h5>how was you appointment:</h5>
                                <label><input name="rating" type="radio" value="Love it!" checked>Love it! </label>
                                <label><input name="rating" type="radio" value="Like it">Like it </label>
                                <label><input name="rating" type="radio" value="It was okay"> It was okay</label><br>
                                <label><input name="rating" type="radio" value="Dislike"> Dislike</label>
                                <label><input name="rating" type="radio" value="Bad">Bad </label>
                            </div>

                            <div class="pet-data">
                                <h5>Any Additional Notes:</h5>
                                <textarea rows="5" cols="33"></textarea>
                            </div>
                            <form method="get" action="#"> <input type="submit" value="submit" class="button"></form>
                        </div>

                        <div class="card">
                            <img src="./littelKitten.jpg" alt="pet picture" class="pet-pic">
                            <div class="pet-data">
                                <h5>Pet Name:</h5>
                                <p>Loosy</p>
                            </div>
                            <div class="pet-data">
                                <h5>Service:</h5>
                                <p>Grooming</p>
                            </div>
                            <div class="pet-data">
                                <h5>Time:</h5>
                                <p>10am</p>
                            </div>
                            <div class="pet-data">
                                <h5>Date:</h5>
                                <p>22/3/2022</p>
                            </div>
                            <div class="pet-data">
                                <h5>Note:</h5>
                                <p>Make her a lion hairstyle (:</p>
                            </div> 
                            <div class="pet-data">
                                <h5>how was you appointment:</h5>
                                <label><input name="rating" type="radio" value="Love it!" checked>Love it! </label>
                                <label><input name="rating" type="radio" value="Like it" >Like it </label>
                                <label><input name="rating" type="radio" value="It was okay"> It was okay</label><br>
                                <label><input name="rating" type="radio" value="Dislike"> Dislike</label>
                                <label><input name="rating" type="radio" value="Bad">Bad </label>
                            </div>

                            <div class="pet-data">
                                <h5>Any Additional Notes:</h5>
                                <textarea rows="5" cols="33"style="resize: none;"></textarea>
                            </div>
                            <form method="get" action="#"> <input type="submit" value="submit" class="button"></form>
                        </div>

                        <div class="card">
                            <img src="./whiteCat.jpg" alt="pet picture" class="pet-pic">
                            <div class="pet-data">
                                <h5>Pet Name:</h5>
                                <p>Goosy</p>
                            </div>
                            <div class="pet-data">
                                <h5>Service:</h5>
                                <p>boarding</p>
                            </div>
                            <div class="pet-data">
                                <h5>Time:</h5>
                                <p>12pm</p>
                            </div>
                            <div class="pet-data">
                                <h5>Date:</h5>
                                <p>1/3/2022</p>
                            </div>
                            <div class="pet-data">
                                <h5>Note:</h5>
                                <p>be careful &lt;3</p>
                            </div> 
                            <div class="pet-data">
                                <h5>how was you appointment:</h5>
                                <label><input name="rating1" type="radio" value="Love it!">Love it! </label>
                                <label><input name="rating1" type="radio" value="Like it"checked>Like it </label>
                                <label><input name="rating1" type="radio" value="It was okay"> It was okay</label><br>
                                <label><input name="rating1" type="radio" value="Dislike"> Dislike</label>
                                <label><input name="rating1" type="radio" value="Bad">Bad </label>
                            </div>
                            <div class="pet-data">
                                <h5>Any Additional Notes:</h5>
                                <textarea rows="5" cols="33" style="resize: none;"></textarea>
                            </div>
                             <form method="get" action="#"> <input type="submit" value="submit" class="button"></form>
                        </div>

                        <div class="card">
                            <img src="./whiteCat.jpg" alt="pet picture" class="pet-pic">
                            <div class="pet-data">
                                <h5>Pet Name:</h5>
                                <p>Goosy</p>
                            </div>
                            <div class="pet-data">
                                <h5>Service:</h5>
                                <p>Checkup</p>
                            </div>
                            <div class="pet-data">
                                <h5>Time:</h5>
                                <p>6pm</p>
                            </div>
                            <div class="pet-data">
                                <h5>Date:</h5>
                                <p>7/3/2022</p>
                            </div>
                            <div class="pet-data">
                                <h5>Note:</h5>
                                <p>dose not feel will ):</p>
                            </div> 
                            <div class="pet-data">
                                <h5>how was you appointment:</h5>
                                <label><input name="rating2" type="radio" value="Love it!"checked>Love it! </label>
                                <label><input name="rating2" type="radio" value="Like it">Like it </label>
                                <label><input name="rating2" type="radio" value="It was okay"> It was okay</label><br>
                                <label><input name="rating2" type="radio" value="Dislike"> Dislike</label>
                                <label><input name="rating2" type="radio" value="Bad">Bad </label>
                            </div>

                            <div class="pet-data">
                                <h5>Any Additional Notes:</h5>
                                <textarea rows="5" cols="33" style="resize: none;"></textarea>
                            </div>
                            <form method="get" action="#"> <input type="submit" value="submit" class="button"></form>
                        </div>
-->
                        
                    </div><!--end continaer 2-->
                </div><!--end child 2 -->
            
                
                
                
                
                
              
                    
                    
                    
          
                <div class="child3">
                    <div class="lable-b">
                       <h4 id="Req-appiontment">Request Appointment</h4> 
                    </div>
                    
                    
                    <div class="container">
                                           <?php 
                    
                    
 $query1 = "SELECT * FROM `appointment` WHERE `owneremail`='".$_SESSION['email']."';";
                       
      
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
             <div class='card'>
             <img src='profile_img/$immmg' alt='pet picture' class='pet-pic' name= 'imgPet'>
             <div class='pet-data'>
             <h5>Pet Name:</h5>
              <p name='petName'>".$row['petName']."</p>
                            </div>
                            
                             <div class='pet-data'>
                                <h5>Service:</h5>
                                <p name='serviceName'>".$row['serviceName']."</p>
                            </div>
                            <div class='pet-data'>
                                <h5>Time:</h5>
                                <p name='serTime'>".date("h:i", strtotime($row['time'])).$amOrpm."</p>
                            </div>
                            
                            <div class='pet-data'>
                                <h5>Date:</h5>
                                <p name=serDate>".$row['date']."</p>
                            </div>
                            <div class='pet-data'>
                                <h5>Note:</h5>
                                <p name=serNote>".$row['note']."</p>
                            </div>
                        
  <button class='button' style='margin-bottom: 0px;' name='editReq'><a id='editBtn' href='EdAppo.php?param=".$row['appoNum']."'>Edit</a></button>
  
  
  
  
 <form method='POST' action='#'>
   <input type='hidden' value='".$row['appoNum']."' name='action'>   
 <button  class='button' name='cancleReq'  >Cancle</button>

                             </div>
                                </form>
                            
                            "); 
                        
             }}
            print("</div>");
      }
                   
                         
                        
                        ?>
                        
                        
                        
<?php
if(isset($_POST['cancleReq'])){

$Number=$_POST['action'];
//connection
    if(!($database =mysqli_connect("localhost","root","")))
          die("<P>Could not connect to database </p>");
      if(!mysqli_select_db($database,"webpro"))
          die("<P>Could not open Pet Care database </p>");         

  //query
    $qq="UPDATE `appointment` SET `satatus`='',`note`='',`petName`=NULL,`owneremail`=NULL WHERE `appoNum`='$Number';";
    
    
  $run= mysqli_query($database, $qq) or die (mysqli_error());  
    if($run){
        echo "<script>alert('The appointment has been cancelled successfully');</script>";
        echo "<script>window.location.assign('app.php')</script>";
    }
    else{
      echo "<script>alert('The appointment  failed to cancel');</script>";  
    }


}                        
    ?>
                        
                        
                        
                        
                        
                        

                          
<!--
                        </div>




            </div>
-->

              
            </div><!--end continaer 3-->
        
        
        
        
        
        
                </div><!--end child 3 -->
        
        
        
        
     
<div>
<?php include("footer.php"); ?>
        </div>
        
        
        
        
        
        
        
        
        
  
   
</body>
</html>