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
    <title>Set avalible Appointment</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

</head>
<body>
  <div class="grid">
    <div class="nav-bar-logn">
    <ul id="ullogin">
      <li><img src="logo.png" alt="logo" class="nav-bar-logo" ></li>
    
      <li class="nav-bar-item-logn" id="activelogn"><a href="home%20page.php">Log Out</a></li>
      <li class="nav-bar-item-logn" id="activelogn"><a href="viewApp.php">Available appointment</a></li>
        <li class="nav-bar-item-logn" id="activelogn"><a href="manage%20appointments.php">Appointments</a></li>
        <li class="nav-bar-item-logn" id="activelogn"><a href="home%20page-manger.php">Home</a></li>


      </ul>
</div>
</div>
    <form method="post" action="#">
      <h1 class="hReq">Set new appointment</h1>
      <div id="divReq">
        <h3> Choose the Service:</h3>

          <?php
      if ( !( $database = mysqli_connect( "localhost", "root", "" ) ) )
        die( "<p>Could not connect to database</p>" );

    if ( !mysqli_select_db($database, "webpro" ) )
        die( "<p>Could not open URL database</p>" );
            
       $sql2 = "SELECT * FROM `service`;";
    
       $result = mysqli_query($database, $sql2);

       if ($result) {
                     
           while ($data = mysqli_fetch_row($result)) { 
               Print "<label class='container-pet'><input type='radio' name='ChooseService' value='$data[0]'>$data[0]<span class='checkmark'></span></label>";
            }
        }
          mysqli_close($database);
          
          ?>
          
          
    
          <h3>Choose date and time:</h3>
          <div class="form__input-group">
            <input type="text" id="date" class="form__input" placeholder="Choose Date" name="dateM" required>
              
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
                    /*
                       function checkService(){
                        var count = 0;
                        
                        var checked = $("input:radio:checked");
                        var n = checked.length;
                        if(n==0)
                            alert("you should select a service first!");
                        else{  
                            var service = $("input:radio:checked").val();
                                    
                            $.ajax({
            
                                  type:'post',
                                  url:'getPreviousApp.php',
                                  data:{service:service},
                                  success:function(data){
                                        
                                  }

                             });
                            
                             
                        }
                       }
                            
                          /*  
                            var req = new XMLHttpRequest();
                            req.onload = function(){
                                get(this.responseText);
                            };
                            req.open("get","getPreviousApp.php", true);
                            req.send();
                         
                            
                            
                        } }
                  
                  function get(d){
                      var dat = JSON.parse(d).toString();
                      var dates = dat.split(",");
                      alert(dates);
                          $( "#date" ).datepicker({
                                  minDate: 0 ,beforeShowDay: function disableDates(date) {
                                  var string = $.datepicker.formatDate('yy-mm-dd', date);
                                  return [dates.indexOf(string) == -1]
                                }

                                });}*/
                        
                  
              </script>
  
            
         
        </div>   
        <div class="buttonss">
          <button type="submit" class="registerbtn" name="setAppoi">Submit</button>
        </div> 

        </div>

   
  
    </form>
</body>
</html>


<?php  
    if (!( $database = mysqli_connect( "localhost", "root", "" )))
        die( "<p>Could not connect to database</p>" );

    if (!mysqli_select_db( $database, "webpro" ))
        die( "<p>Could not open URL database</p>" );

    if(isset($_POST['setAppoi'])) {  
        if (empty($_POST["ChooseService"])) 
            echo "<script>alert('Please choose service!');</script>";
            else{
        $Sname=$_POST['ChooseService'];    
        $Sdate=$_POST['dateM'];
        $Stime=$_POST['TimeM'];
        
        $sql3 = "SELECT * FROM `appointment` WHERE `appointment`.`date` = '$Sdate' And `appointment`.`time` = '$Stime';";

        $result = mysqli_query($database, $sql3);
          if(mysqli_fetch_row($result) != null){
              echo "<script>alert('This date and time already exist!');</script>"; 
          }
                else{
       $sql = "INSERT INTO `appointment` (`date`, `time`, `satatus`, `note`, `petName`, `owneremail`, `serviceName`) VALUES ('$Sdate', '$Stime','', '', NULL, NULL, '$Sname');";

        if(mysqli_query($database, $sql)) { 
            echo "<script>window.location.href='viewApp.php';</script>";
            //header("location: viewApp.php");
        } else {
             echo "<script>alert('Someting wrong!')</script>"; 
            }
    }}} mysqli_close($database);  
?> 