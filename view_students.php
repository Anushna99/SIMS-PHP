<?php
include 'db_connection.php'; 
session_start();
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

    <title>View Students</title>
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

<?php
if($type=="Admin")
{
    if(isset($_POST["SID"]) && $_POST["SID"]!="")
{
  
  $con = OpenCon();

  $sid=$_POST["SID"];
  $sql="DELETE FROM students WHERE sid='$sid'";
  $result=mysqli_query($con,$sql);
  if(mysqli_affected_rows($con)==0)
  {
    echo "<script language=\"javascript\" type=\"text/javascript\">alert(\"Student ID is incorrect...!\")</script>";
  }
  $sid=lcfirst($sid);
  $sql1="DROP TABLE $sid";
  $result1=mysqli_query($con,$sql1);
mysqli_close($con);
}
}
?>

<?php
$con = OpenCon();

$sql="SELECT * FROM students";
$result=mysqli_query($con,$sql);
echo "<table style=\"float:left; width:80%;\" id=\"tblStudent\" class=\"table table-striped table-hover\">";
echo "<tr>";
echo "<th>Student ID</th>";
echo "<th>First Name</th>";
echo "<th>Last Name</th>";
echo "<th>Address</th>";
echo "<th>Telephone No.</th>";
echo "<th>Birthday</th>";
echo "<th>Age</th>";
echo "</tr>";
while ($row=mysqli_fetch_assoc($result))
{
	echo "<tr>";
	echo "<td>".$row["sid"]."</td>";
	echo "<td>".$row["fname"]."</td>";
	echo "<td>".$row["lname"]."</td>";
	echo "<td>".$row["address"]."</td>";
	echo "<td>".$row["tp"]."</td>";
	echo "<td>".$row["bd"]."</td>";
	echo "<td>".date_diff(date_create($row["bd"]), date_create('today'))->y."</td>";

}
echo "</table>";
mysqli_close($con);

if($type=="Admin")
{
  echo "<form style=\"float:right; margin-right: 20px; margin-top:20px;\" class=\"row-g-2\" name=\"remove\" method=\"POST\" action=\"#\">
        <input type=\"text\" class=\"form-control\" id=\"SID\" name=\"SID\" placeholder=\"Student ID\" readonly>
        <button type=\"submit\" class=\"btn btn-primary mb-3\">Remove Student</button>
        </form>";
}
?>
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
  document.getElementById("SID").value=id;
  
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