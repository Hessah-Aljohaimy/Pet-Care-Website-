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
    <title>add service</title>
    <link rel="stylesheet" href="Add-service.css">
</head>

<body>
    
    <div class="grid">
            
            <div class="nav-bar">
            <ul>
                <li><img src="logo.png" alt="logo" class="nav-bar-logo" ></li>
                <li class="nav-bar-item"><a href="home%20page.php">Log Out</a></li>
                <li class="nav-bar-item" ><a href="home%20page-manger.php">back</a>
                <li class="nav-bar-item" ><a href="home%20page-manger.php">Home</a></li>
            </ul>
        </div>
        <h1>Add new service</h1>
        <div class="addServ-continer">
            
            <form method="post" action="#"  enctype="multipart/form-data" > 
                <label> Choose photo:</label>
                <input type="file" id="file" class="box-img" name="photo" required>
                <br>
            
                <label>Service Name:
                <input name = "Sname" type = "text" value ="" placeholder="Pet Adoption" class="box" required></label>
                <br>
    

                <label>Service Discription:
                <textarea name = "discription" type = "text" maxlength="300" placeholder="Ready to add a new love to your family? There are so many wonderful pets in your community waiting for loving homes. Put your love into action by adopting today" class="box" required></textarea></label>
                <br>
    
   
                <label>Service Price:
                <input name = "price" type="number"  min="1" placeholder="350" class="box" max="10000"required></label>
                <br>
    
                <input type="submit" value="Submit" name="addServ" class="button"> 
           
            </form>
              
        </div>
    </div>       

</body>

</html>



<?php  
    if (!( $database = mysqli_connect( "localhost", "root", "" )))
        die( "<p>Could not connect to database</p>" );

    if (!mysqli_select_db( $database, "webpro" ))
        die( "<p>Could not open URL database</p>" );

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $Sname=$_POST['Sname'];
        

        if (preg_match('/[0-9]+/', $Sname)) {
            echo "<script>alert('name should not have a number!')</script>";  
            exit();
          }
        $test = "SELECT * FROM `service` WHERE `service`.`name` = '$Sname';";
        
        $res = mysqli_query($database, $test);
        
        $photo = $_FILES["photo"]["name"];
            
        if (mysqli_fetch_row($res) == null){
        
         $check = true;
        
            $allowed = array('gif', 'png', 'jpg','jpeg');   
            $filename = $_FILES["photo"]["name"];
            $target_dir = "profile_img/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $tempname = $_FILES['photo']['tmp_name'];  
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
            echo "<script>alert('only png,jpg,gif are allowed')</script>";
            $check = false;
        }else
            move_uploaded_file($tempname, $target_file);
           
            
         if($check){   
        $description=$_POST['discription'];
        $price=$_POST['price'];
            
            
        $sql = "INSERT INTO `service` (`name`, `photo`, `description`, `price`) VALUES ('$Sname', '$photo', '$description', '$price') ;";
        
         //. $_SESSION["email"] .""

        if(mysqli_query($database, $sql)) {  
            echo "<script>alert('Service successfully added')</script>";
            mysqli_close($database);
             echo "<script>window.location.assign('home%20page-manger.php')</script>";
            
        } else {
             echo "<script>alert('Somting wrong!')</script>"; 
            
            }}
        }
        else
          echo "<script>alert('Service already there!')</script>";   
    }
mysqli_close($database);

?>  