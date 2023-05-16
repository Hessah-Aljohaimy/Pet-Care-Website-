<?php
session_start();

if(!isset($_SESSION['email'])) {
  header("location: login.php");
  exit();
}

$ownerEmail=$_SESSION['email'];

if (!( $database = mysqli_connect( "localhost", "root", "" )))
die( "<p>Could not connect to database</p>" );

if (!mysqli_select_db( $database, "webpro" ))
die( "<p>Could not open URL database</p>" );

$id = $_POST['a'];
  $s = mysqli_query($database,"DELETE FROM pet WHERE name='$id' AND owneremail='".$ownerEmail."'")

  ?>