<?php
	session_start();

    if (!( $database = mysqli_connect( "localhost", "root", "" )))
        die( "<p>Could not connect to database</p>" );

    if (!mysqli_select_db( $database, "webpro" ))
        die( "<p>Could not open URL database</p>" );

        $sql = "SELECT * FROM `veterinary`;";

        $run=mysqli_query($database, $sql);  

        if($row=mysqli_fetch_row($run)) {  
            $description=$row[2];
            $photo=$row[3];
            $loc=$row[4];
        }

?>


<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Home page</title>
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
        <link rel="stylesheet" href="homePageStyle.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        
        
    
    </head>
    
    <body>
        
        <div class="grid">
            
            <div class="nav-bar">
            <ul>
                <li><img src="logo.png" alt="logo" class="nav-bar-logo" ></li>
                <li class="nav-bar-item"><a href="register.php">Register</a></li>
                <li class="nav-bar-item"><a href="login.php">Login</a></li>
                <li class="nav-bar-item" id="active"><a href="#">Home</a></li>
            </ul>
        </div>
            
            
      <div class="grid-about-us">
        <div class="card">
          <div class="card-content">
            <h1 class="card-header"><strong>ABOUT US</strong></h1>
            <img src="<?php echo "profile_img/$photo" ?>">
            <p class="card-text">
                 <?php echo $description ; ?>
            </p>
              
            <a href="<?php echo $loc ?>"><button class="card-btn">location <span>&rarr;</span></button></a>
              
          </div>
        </div>
      </div>
            
            <div class="service-title" ><h1>Our Services</h1></div>
                
    <div class="services">
        
           <?php
            
       $sql2 = "SELECT * FROM `service`;";
    
       $result = mysqli_query($database, $sql2);

       if ($result) {
                     
           while ($data = mysqli_fetch_row($result)) {
               Print "<div class='serv' ><div class='card-image' style='background-image: url(profile_img/".$data[1].")'></div><div class='card-text1'><h2>". $data[0]."</h2><p>".$data[2]."</p></div><div class='card-stats'><div class='type'>price</div><div class='value'>".$data[3]."SR</div></div></div>"; 
            }
        }

        else
        echo "There are no Services.";
               
               
?>
        
        </div>
            
        </div>
        
        
       <!-- test-->
    
            <div class="Reviwes-title" >
                <h2>Customers Reviwes</h2>
            </div>
   
        
        <section class="reviwe">
            
    <div class="swiper mySwiper container">
      <div class="swiper-wrapper content">
          
          

          
          <?php
            
       $sql2 = "SELECT * FROM `review`;";
    
       $result = mysqli_query($database, $sql2);

       if ($result) {
           
           if (mysqli_fetch_row($result) != null){
               
               $result = mysqli_query($database, $sql2);
                     
           while ($data = mysqli_fetch_row($result)) {
               
               $app = "SELECT `owneremail`,`date` FROM `appointment` WHERE `appointment`.`appoNum` = ".$data[2].";";
               
               $resultApp = mysqli_query($database, $app);
               
               $dataApp = mysqli_fetch_row($resultApp);
               
                   
               $petOwner = "SELECT `Fname`,`Lname`,`profilePhoto` FROM `petowner` WHERE `petowner`.`email`= '".$dataApp[0]."';";
               
               $resultOwner = mysqli_query($database, $petOwner);
               
               $dataOwner = mysqli_fetch_row($resultOwner);
               
               Print "<div class='swiper-slide cardR'><div class='card-contentR'><div class='image'><img src='profile_img/".$dataOwner[2]."' alt='profilePic'></div><div class='name-profession'><span class='name'>".$dataOwner[0]." ".$dataOwner[1]."</span><span class='profession'>".$data[0]."</span></div><p class='line'>ــــــــــــــــــــــــــــــــــــ</p><div class='rating'><span class='Rnote'>".$data[1]."</span><br><span class='Rnote'>".$dataApp[1]."</span></div></div></div>";    
               
            }
        }else
        print("<p>No Reviwes yet</p>");
       }
          
          mysqli_close($database);

        
?>         
  
               
          
      </div>
    </div>

    <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
  </section>
        
        
        
        
        <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 3,
      spaceBetween: 30,
      slidesPerGroup: 3,
      loop: true,
      loopFillGroupWithBlank: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>
        
        
        
        
        
        <!-- test -->
            
         <footer id="foot" >    
        <div class="icon">
        <i class ="fa fa-phone" style="float: left; padding-left: 40px; "> 92000675 </i>
        <br>
        </div>
        <div class="icon">
            <i class ="fa fa-envelope" style="float: left;  padding-left: 40px; "> <a href="mailto:PetCare@Clinic.com" style="text-decoration: none; color: #fff; ">PetCare@Clinic.com</a>  </i>
        <div class="icon"> <i class ="fa fa-twitter" style="float: right; padding-right: 40px; "><a href="#" style="text-decoration: none; color: #fff; "></a>@pet_clinic</i></div>
        <br>
        <div class="icon"> <i class ="fa fa-facebook" style="float: right; padding-right: 40px; "><a href="#" style="text-decoration: none; color: #fff; "></a>@pet_clinic</i></div>
      </div> 
      
      <p>All rights reserved for &copy; 2022 PET CARE copany</p></footer>
            
        
    </body>
</html>