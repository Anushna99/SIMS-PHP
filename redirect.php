<?php
session_start();
$previous_location = $_SESSION['previous_location'];
if($previous_location=='add_student')
    {
      header( "refresh:2;url=add_new_student.php" );
    }

    if($previous_location=='add_user')
    {
      header( "refresh:2;url=add_users.php" );
    }
    
    if($previous_location=='enter_results')
    {
      header( "refresh:2;url=enter_results.php" );
    }
include 'db_connection.php'; 
$name=$_SESSION["name"];
$type=$_SESSION["type"];

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Redirect</title>
  </head>
  <body>
    <?php
    if($previous_location=='add_student')
    {
      echo "<h1>Student Added Successfully...!!</h1>";
    }

    if($previous_location=='add_user')
    {
      echo "<h1>User Added Successfully...!!</h1>";
    }
    
    if($previous_location=='enter_results')
    {
      echo "<h1>Results Entered Successfully...!!</h1>";
    }

    ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>