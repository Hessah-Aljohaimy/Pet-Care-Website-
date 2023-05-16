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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Welcome page</title>
  
    <style>
        *{
            margin: 0;
            padding: 0;
            text-align: center;
            
        }

        body{
      

    font-family: "be vietnam"; 
   
    background-image: linear-gradient(rgba(0,0,0,0.1),rgba(0,0,0,0.1)),url(Background.jpg);

    background-attachment: fixed;
    background-size: cover;


        }

        
    /*========Start of profile navigation bar============*/    


 nav{
     position: relative;
    top: 10px;
    
     border: 2px solid rgb(255, 255, 255);
     font-weight: bold;
     color: white;
     
     text-align: center;
     width: 10em;
     
     width: 150px;
    
    background-color: #DB9428;
border-radius: 18px;
box-shadow: -5px 5px 10px 0 rgba(0,0,0,0.4);
 }
    
   nav ul{
       border-top:2px solid rgb(255, 255, 255);
       display: block;
       list-style: none;
       margin: 0;
       padding: 0;
      

   }    

    nav ul li a {
        font-size: 20px;
      
       
        text-decoration: none;
        color:white;
    }
          nav ul li a:hover {
        font-size: 20px;
      
       
        text-decoration: none;
        color:#486F72;
    }
        
        
       /*========End of profile navigation bar============*/    
        



/*============ main navigation ========================*/
        
header .a-navbar{
    padding: 40px 0;

    font-size: 23px;
}


.nav-bar-logo{
    width: 250px;
    height: 150px;
}
.nav-profile{
    position: absolute;
    right: 10px;
    
}
        .nav-profile img{
            border-radius: 50%;
            width: 140px;
            height: 140px;
}

.navigationBar{
grid-area: header;

}
.nav-bar-logo{
    width: auto;
    margin-left: 20px;
    float: left;
}

.navigationItem{
    text-align: center;
    padding: 10px 30px;
    padding-top: 5px;
    border-radius: 10px;
    margin-right: 20px;
    width: 200px;
    background-color: #DB9428;
    transition: transform .3s;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);

}


.navigationItem:hover{
    background-color: black;
    cursor: pointer;
    transform: translateY(5px);
    
}
.navigationStart{
    display: grid;
    grid-template-areas:
    'header header'
   
}
.a-navbar{
text-decoration: none;
color: #fff;
}
.a-navbar:hover{
    cursor: pointer;
    color: #fff;
    text-decoration: none;
}
#navigationUL{
    list-style-type: none;
            padding: 0;
            margin: 30px 55px 0;
            display: flex;
           
}
        /*============End main navigation ========================*/
        
#logout{
   float: right;
   transform: translate(10px,-100px);
   width: 150px;

}
.profile-link{
    position: relative;
   
}
          /*========== Cats picture ==========*/
.welcome{
    background-color:#995c00;
    position: relative;
color: #fff;
    width: 78%;
    margin: 0 auto;
   border-radius: 15px;
    border: 3px solid #fefefe;
    
}
      
.yellowCat{
    width:90%;
    margin: 0 ;
    height: 470px;
    position: relative;
   
    
}
.cat-div{
    
    position: absolute;  
     top: 8px;
      left: 16px; 
       z-index: 2;
         font-weight: bold; 
         font-size: 35px; 
         text-align: center;
          
}
/*================ Our Servises===============*/

.service-title{
  
   height: 70px;
   width:300px;
   grid-area: service-title;
   margin-bottom: 15px;
   
   padding: 2px 30px;
margin-left: auto;
margin-right: auto;
   text-align: center;
   border-radius: 10px;
   background-color: #9C4E5B;
   font-size: 1px;
   color: white;
   box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
}

.service-title:not(:first-of-type):hover{
    cursor: pointer;
    transform: scale(1.1);
    transition: transform .3s;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
}

.services {
    margin-left: auto;
margin-right: auto;
    display: flex;
    justify-content: center;

    overflow:auto;
  grid-area: services;
  display: grid;
  width: 83.4%;
  grid-template-columns: 250px 250px 250px;
  grid-column-gap: 50px;
  grid-template-areas: "serv1 serv2 serv3";
  margin: 55px;
  height: auto;
  
}


.serv1{
  background-color: white;
  display: grid;
  grid-template-rows: 180px 190px 85px;
  grid-column-gap: 50px;
  grid-template-areas: "image" "text" "stats";
  border-radius: 18px;
  box-shadow: 5px 5px 15px rgba(0,0,0,0.9);
  font-family: roboto;
  text-align: center;
  transition: 0.5s ease;
  cursor: pointer;
}

.serv1:hover {
  transform: scale(1.05);
  box-shadow: 5px 5px 15px rgba(0,0,0,0.6);
}


 .card-image{
height: 180px;
width: 210px;
        }
        
.card-image1 {
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
  background-size: cover;
}


.card-text1 {
  grid-area: text;
  margin: 25px;
}

.card-text1 p {
  color: grey;
  font-size:15px;
  font-weight: 300;
}
.card-text1  {
  margin-top:0px;
  font-size:28px;
}

.card-stats1 {
  grid-area: stats; 
  border-bottom-left-radius: 15px;
  border-bottom-right-radius: 15px;
  background: #9C4E5B;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  color: white;
  padding:10px;
}




/*================== Our mession =====================*/
    .ourmession-title{
   height: 70px;
   width:300px;
   grid-area: service-title;
   margin-bottom: 15px;
   
   padding: 2px 30px;
margin-left: auto;
margin-right: auto;
   text-align: center;
   border-radius: 10px;
   background-color: #486F72;
   font-size: 1px;
   color: white;
   box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
}



.col-md-3:hover{
    background: linear-gradient(rgba(0,0,0,0.5), #486F72);
    cursor: pointer;
 
    box-shadow: -5px 5px 10px 0 rgba(0,0,0,0.4);
    transition:0.5s ;
    border: 2px solid pink;
}
.col-md-3{
/*50px;*/
   
    padding: 0px 0px;
 display: inline-block;
    border-radius: 25px;
    background-color: #486F72;
width:290px;
    height: 320px;
  margin: 10px 30px 10px 30px;

   
}



.col-md-3 .icon{

   margin: 20px auto;
   padding: 18px;
   height: 70px;
   width: 70px;
   border: 1px solid #F2DBD6;
   border-radius: 50px;
    
    
}
.col-md-3 p{
   font-size: 15px;
   margin-top: 10px;
   color:#F2DBD6;
   padding: 20px;

  
  
}
 
 .Onwername{
           font-size: 40px; 
}

 



    </style>
    
</head>
<body>

    <header>
        <div class="navigationStart">
            
            <div class="navigationBar">
                <img src="petlogo.png" alt="logo" class="nav-bar-logo" >
            <ul id="navigationUL">
           
                <li class="navigationItem" ><a class="a-navbar" href="#">Home</a></li>
                <li class="navigationItem" ><a class="a-navbar" href="#ourServices">Service</a></li>
                <li class="navigationItem" ><a class="a-navbar" href="app.php">Appointment</a></li>
             
                <li class="navigationItem" ><a  class="a-navbar"href="#foot">Contact US</a></li>

                <li class="navigationItem" ><a  class="a-navbar"href="home page.php">Log Out</a></li>
            </ul>
            
        </div>
    


        <nav class="nav-profile" ><a class="profile-link" href="userProfile.php">
                      <?php
//connection
          $email=$_SESSION['email'];
           
//take email from post array
       $queryChoosingOwner="SELECT `profilePhoto` FROM `petowner` WHERE `email`='$email';";

       
        
         if(!($database =mysqli_connect("localhost","root","")))
          die("<P>Could not connect to database </p>");
        //database
      if(!mysqli_select_db($database,"webpro"))
          die("<P>Could not open Pet Care database </p>");

   if(!($resultOwner= mysqli_query($database,$queryChoosingOwner))){
    print("<p>Could not execute query</p>");
              die(mysqli_error());

}
        

      
//mysqli_close($database);
          
            
           
        while ($row=mysqli_fetch_row($resultOwner)){
      
            foreach($row as $key=>$value)
              
                  print("<img src='profile_img/$value' alt ='profile picture' style=>");
        }
  
      ?>
            </a>
            <ul >
                
              
                    <li ><a  href="userProfile.php"> My Profile</a></li>
                <li > <a href="petprof.php"> My Pets Profile</a></li>
        
            </ul>
        </nav> 
    </header>
   



        
        
    <div class="welcome">
        
        
        <?php
//connection
        $email=$_SESSION['email'];
//take email from post array
       $queryChoosingOwner="SELECT `Fname`,`Lname` FROM `petowner` WHERE email='$email';";
   
       
        
         if(!($database =mysqli_connect("localhost","root","")))
          die("<P>Could not connect to database </p>");
        //database
      if(!mysqli_select_db($database,"webpro"))
          die("<P>Could not open Pet Care database </p>");

   if(!($resultOwner= mysqli_query($database,$queryChoosingOwner))){
    print("<p>Could not execute query</p>");
              die(mysqli_error());

}
        

      
mysqli_close($database);
           print("<span class='Onwername'>Welcome Back "); 
        while ($row=mysqli_fetch_row($resultOwner)){
           
            foreach($row as $key=>$value)
            print (" ".$value." "); 
        }
  print("!</span>");
      ?>
        
        <div  class ="cat-div">
        </div>
       

    </div>
 <img src="catyellow.jpg" alt="pets picture" class="yellowCat" > 













<div class="parent"> 
    <div class="child1">
        <br>
        <div class="service-title" ><h1 id="ourServices">Our Services</h1></div>
                
        <div class="services">
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
             $photo=$row['photo'];
             $description=$row['description'];
             $price=$row["price"];
             $castprice=(string)$price;
             print(" <div class='serv1'>
            <div class='card-image1'><img class='card-image'src='$photo' ></div>
            <div class='card-text1'>
             <h2>$name</h2><p> $description</p>
            </div>
                <div class='card-stats1'>
            <div class='type'>price</div>
             <div class='value'>$castprice</div>
             </div>
            </div>" );
         
         }//end for
      }//end if

      
  mysqli_close($database);
      ?>
            
            
            
            
            
            
            <!--serv1-->
<!--
            <div class="serv1">
            <div class="card-image1"></div>
            <div class="card-text1">
                <h2>Checkup</h2>
                <p>We believe that Regular checkups are a vital part of your pet’s healthcare plan. We recommend all cats and dogs receive a yearly physical exam</p>
            </div>
            <div class="card-stats1">
            <div class="type">price</div>
            <div class="value">150SR</div>
            </div>
            </div>
-->
            <!--serv2-->
<!--
            <div class="serv2">
            <div class="card-image2"></div>
            <div class="card-text2">
                <h2>Grooming</h2>
                <p>improve pets’ hygiene and enhance their physical appearance. They bathe, brush, dry , clean their teeth and ears,trim their nails and hair/fur</p>
            </div>
            <div class="card-stats2">
            <div class="type">price</div>
            <div class="value">400SR</div>
            </div>
            </div>
-->
            <!--serv3-->
<!--
            <div class="serv3">
            <div class="card-image3"></div>
            <div class="card-text3">
                <h2>Boarding</h2>
                <p>Our staff are compassionate and are here to provide individualized care for your pet at all times</p>
            </div>
            <div class="card-stats3">
            <div class="type">price</div>
            <div class="value">700SR</div>
            </div>
            </div>
-->
                
            </div>
    </div>

      



    <div class="child2">
        <!--========= Our Mession =====-->

<div class="ourmession-title" ><h1>
    Our Mission
</h1> </div>


  <!--====================== Our Mession ===================-->


      
      
    <!--------------------first mession ------------------->

 <div class = "col-md-3 "  style="width:'200'">

<div class="icon">
<i class ="fa fa-scissors"></i>

</div>
<h3>
OUR <span>Quality</span><p>
 We provid for your pet the best cleaning 
and grooming services  with the highest qualty and 
professional workers and apllying international guidelines in grooming services
</p>
</h3></div>

<!--------------------second mession -------------------->

<div class = "col-md-3">
<div class="icon">
<i class ="fa fa-heart"></i>

</div>
<h3>
OUR <span>Care</span><p>
We provid those services in a professional manner we treat your pet friend in a lovely way full of sympathy and passionate
</p>
</h3></div>


<!---------------------- third mession ----------------------->

 <div class = "col-md-3">
<div class="icon">
<i class ="fa fa-hospital-o"></i>

</div>
<h3>
OUR <span>Medical care</span><p>
 Our doctors and staff are driven by a sincere love for animals and concern for their well-being and treat them in the best way.  
</p>
</h3></div>








 




<!--============ End of Our Mession===================-->
<!--    </div>-->
       </div> 
    <div><?php include("footer.php"); ?></div>















<!--================= Footer ======================-->





   

</body>
</html>