<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "anushna";
 $dbpass = "#anushna99";
 $db = "myfirstdb";
 $con = mysqli_connect($dbhost, $dbuser, $dbpass,$db);
 
 return $con;
 }
 

   
?>