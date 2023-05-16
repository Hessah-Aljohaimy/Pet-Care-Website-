
<?php
if (!( $database = mysqli_connect( "localhost", "root", "" )))
die( "<p>Could not connect to database</p>" );

if (!mysqli_select_db( $database, "webpro" ))
die( "<p>Could not open URL database</p>" );

$id = $_POST['id'];
  $query = mysqli_query($database,"DELETE FROM appointment WHERE appoNum=$id");



  ?>