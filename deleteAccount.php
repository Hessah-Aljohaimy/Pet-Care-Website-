<?php
session_start();

if(!isset($_SESSION['email'])) {
  header("location: login.php");
  exit();
}

$Email=$_SESSION['email'];
if (!( $database = mysqli_connect( "localhost", "root", "" )))
die( "<p>Could not connect to database</p>" );

if (!mysqli_select_db( $database, "webpro" ))
die( "<p>Could not open URL database</p>" );


  $s = mysqli_query($database,"DELETE FROM petowner WHERE  email='".$Email."'");

  ?>