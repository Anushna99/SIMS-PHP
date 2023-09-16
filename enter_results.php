<?php
include 'db_connection.php'; 
session_start();
$name=$_SESSION["name"];
$type=$_SESSION["type"];
$_SESSION['previous_location'] = 'enter_results';

if(isset($_POST["btnsubmit"]))
{
  $con=OpenCon();
  $id=lcfirst($_SESSION["sid"]);
  $exam=$_POST["txtexam"];
  $year=$_POST["txtyear"];
  $col=implode(",", $_SESSION["Field"]);
  $DataArr = array();
  foreach ($_POST["values"] as $mark) {
    $DataArr[]="'$mark'";
  }
  $val=implode(",", $DataArr);
  $sql="INSERT INTO $id(year,exam,$col) VALUES('$year','$exam',$val)";
  if($result=mysqli_query($con,$sql))
  {
  mysqli_close($con);
  header("Location:redirect.php");
  }
  else{
    echo "<script language=\"javascript\" type=\"text/javascript\">alert(\"Results for $exam in $year has already been inserted.\")</script>";
  }
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

    <title>Enter/Update Results</title>
    <link rel="stylesheet" href="dist/yearpicker.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  </head>
  <body>
    


    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SIMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Students
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="view_students.php">View Students</a></li>
            <?php if($type=="admin"){echo "<li><a class=\"dropdown-item\" href=\"enter_results.php\">Enter/Update Results</a></li>";}?>
            <li><a class="dropdown-item" href="view_results.php">View Results</a></li>
            <li><a class="dropdown-item" href="student_reports.php">View Student's Reports</a></li>
            <?php if($type=="admin"){echo "<li><a class=\"dropdown-item\" href=\"add_new_student.php\">Add New Student</a></li>";}?>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Manage System Users
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="view_users.php">View Users</a></li>
            <?php if($type=="admin"){echo "<li><a class=\"dropdown-item\" href=\"add_users.php\">Add new user</a></li>";}?>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Hi..! <?php echo "$name"; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="index.php">Logout</a></li>
            <li><a class="dropdown-item" href="user_profile.php">View Profile</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


<img src="images/exam-results.jpg" alt="" width="200" height="100" style="vertical-align:middle;margin:0px 500px;position: fixed;">
<form name="addstudent" method="POST" action="#">
  <table cellpadding="18px">
    <tr>
      <td>Student ID</td>
      <td><input type="text" class="form-control" name="txtsid" id="txtsid" readonly></td>
      <td><input type="submit" name="btngo" value="GO" class="btn btn-primary btn-lg"></td>
    </tr>
    </table>
  </form>

<?php

$con = OpenCon();

$sql="SELECT * FROM students";
$result=mysqli_query($con,$sql);
echo "<table style=\"float:right; width:20%; margin-top:-30px; margin-right:20px;\" id=\"tblStudent\" class=\"table table-striped table-hover\">";
echo "<tr>";
echo "<th>Student ID</th>";
echo "<th>First Name</th>";
echo "</tr>";
while ($row=mysqli_fetch_assoc($result))
{
  echo "<tr>";
  echo "<td>".$row["sid"]."</td>";
  echo "<td>".$row["fname"]."</td>";

}
echo "</table>";
mysqli_close($con);

?>

  <?php  

  if(isset($_POST["btngo"]))
{
  $con = OpenCon();

  $id=lcfirst($_POST["txtsid"]);
  $sql="DESCRIBE $id";
  $result=mysqli_query($con,$sql);
  echo "<h5>Student ID: ".ucfirst($id)."</h5>";
  echo " <form name=\"enter_results\" method=\"POST\" action=\"#\">";
  echo "<table cellpadding=\"10px\">";
  $a=array();
  while ($row=mysqli_fetch_assoc($result))
  {
    if($row["Field"]=="year"){
      
      echo "<tr>";
      echo "<td>Year</td>";
      echo "<td><input class=\"yearpicker form-control\" type=\"text\" name=\"txtyear\" required></td>";
      echo "</tr>";
      continue;
    }
    
    if($row["Field"]=="exam")
    {
    
    echo "<tr>";
    echo "<td>".$row["Field"]."</td>";
    echo "<td><select class=\"form-select\" name=\"txtexam\" required><option>First Term</option><option>Second Term</option><option>Third Term</option></select></td>";
    echo "</tr>";
    continue;
    }
    array_push($a,$row["Field"]);
    echo "<tr>";
    echo "<td>".$row["Field"]."</td>";
    echo "<td><input type=\"number\" class=\"form-control\" name=\"values[]\" required step=\"0.01\" min=\"0\" max=\"100\"></td>";
    echo "</tr>";
  }
  $_SESSION["Field"]=$a;
  $_SESSION["sid"]=$id;
  echo "</table>";
  echo "<input type=\"submit\" name=\"btnsubmit\" value=\"Enter Results\" class=\"btn btn-primary btn-lg\">";
  echo "</form>";
  mysqli_close($con);
}


  ?>
<script src="dist/yearpicker.js"></script>
     <script>
      $(document).ready(function() {
        $(".yearpicker").yearpicker({
          year: new Date().getFullYear(),
          startYear: 2000,
          endYear: 2030
        });
      });
    </script>

<script type="text/javascript">
  var table = document.getElementById("tblStudent");
if (table) {
  for (var i = 0; i < table.rows.length; i++) {
    table.rows[i].onclick = function() {
      tableText(this);
    };
  }
}

function tableText(tableRow) {
  var id = tableRow.childNodes[0].innerHTML;
  document.getElementById("txtsid").value=id;
  
}
</script>
  
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