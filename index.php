<?php 
include 'db_connection.php';
  session_start();

  if(isset($_POST["txtUserName"]))
  {
  
  $name=$_POST["txtUserName"];
  $password=$_POST["pwd"];
  // $con=mysqli_connect("localhost","anushna","#anushna99");
  // mysqli_select_db($con,"myfirstdb");


  $con = OpenCon();

  $sql="SELECT * FROM tblusers WHERE uid='$name'";
  $result=mysqli_query($con,$sql);
  if(mysqli_num_rows($result)!=0)
  {
    $row=mysqli_fetch_array($result);
    if($row[2]==$password && $row[2]!="")
    {
      $_SESSION["type"]=$row[3];
      $_SESSION["uid"]=$row[0];
      $_SESSION["name"]=$row[1];

       /*if($_POST["remember"]==1)   
   {  
    setcookie ("member_login",$name,time()+ (10 * 365 * 24 * 60 * 60),"/");
    //$_SESSION["admin_name"] = $name;
   }  
   else  
   {  
    if(isset($_COOKIE["member_login"]))   
    {  
     setcookie ("member_login","", time() - 3600);  
    }  
   
   } */

      header("Location:home.php");
    }
    else
    {
      //echo "<script language=\"javascript\" type=\"text/javascript\">alert(\"Password is incorrect...!\")</script>";
      $message = "Invalid Login,Password is incorrect";

    }
  }
  else
  {
    //echo "<script language=\"javascript\" type=\"text/javascript\">alert(\"User Name is incorrect...!\")</script>";
    $message = "Invalid Login,User ID is incorrect";
  }
  mysqli_close($con);
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style type="text/css">
      .login_form
    {
      align-items: center;
        background-color: #eff8ff;
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, .1), 0 8px 16px rgba(0, 0, 0, .1);
        box-sizing: border-box;
        margin: 480px 30px 0;
        padding: 30px;

        width: 500px;
    }
    body 
    {
        background-image: url('images/loginBackground.jpg');
    }
    </style>
    <title>Login Page</title>
  </head>
  <body>
    <div class="login_form">
      <form class="row g-3"name="login" method="POST" action="#">
        <div class="text-danger"><?php if(isset($message)) { echo $message; } ?></div>
      <input type="text" class="form-control" name="txtUserName" placeholder="User ID" required autofocus="true" style="text-transform:uppercase">
      <br/><br/>
      <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Password" required><br/>
      <div class="form-check">
      <input class="form-check-input" type="checkbox" name="remember" id="remember">
      <label class="form-check-label" for="remember">
        Remember me
      </label>
    </div><br/><br/>
      <input type="submit" name="btn_submit" class="btn btn-outline-primary" value="Login">
    </form>
    </div>
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