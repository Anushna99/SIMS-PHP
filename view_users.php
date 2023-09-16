<?php
include 'db_connection.php'; 
session_start();
$name=$_SESSION["name"];
$type=$_SESSION["type"];
//header( "refresh:10;url=index.php" );
?>


<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


<style type="text/css">
	table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  width: 500px;
}
th, td {
  padding: 15px;
}

table.center {
  margin-top: 100px;
  margin-left: 200px; 
  /*margin-right: 90px;*/
}

</style>

	<title>View System users</title>
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

<h2>Users Details</h2>

<?php
if($type=="Admin")
{
  echo "<div style=\"margin-left:1000px;\"><form class=\"row-g-2\" name=\"remove\" method=\"POST\" action=\"#\">
  
  <div class=\"col-md-6\">
    
    <input type=\"text\" class=\"form-control\" id=\"UID\" name=\"UID\" placeholder=\"User ID\" readonly>
  </div>
  <br>
  <div class=\"col-md-6\">
    <button type=\"submit\" class=\"btn btn-primary mb-3\">Remove User</button>
   <div> Please select the user you wish to remove</div>
  </div>
</form></div>";
if(isset($_POST["UID"]) && $_POST["UID"]!="")
{
  if($_POST["UID"]=="U001")
  {
    echo "<script language=\"javascript\" type=\"text/javascript\">alert(\"Sorry root Admin cannot be deleted...!\")</script>";
    //unset($_POST["UID"]);
  }
  else{
  $con = OpenCon();

  $uid=$_POST["UID"];
  $sql="DELETE FROM tblusers WHERE uid='$uid'";
  $result=mysqli_query($con,$sql);
  if(mysqli_affected_rows($con)==0)
  {
    echo "<script language=\"javascript\" type=\"text/javascript\">alert(\"UID is incorrect...!\")</script>";
  }
mysqli_close($con);
}
}
}

 ?>




<?php
// $con=mysqli_connect("localhost","anushna","#anushna99");
// mysqli_select_db($con,"myfirstdb");

$con = OpenCon();

$sql="SELECT * FROM tblusers ORDER BY uid";
$result=mysqli_query($con,$sql);
echo "<table class=\"center\" id=\"usersTable\">";
echo "<tr>";
echo "<th>User ID</th>";
echo "<th>User Name</th>";
echo "<th>User Type</th>";
echo "</tr>";
$count=0;
$color="White";
while ($row=mysqli_fetch_assoc($result))
{
	if($count%2==0)
	{
		$color="FloralWhite";
	}
	else
	{
		$color="Grey";
	}
	$count++;
	echo "<tr bgcolor=$color>";
	echo "<td>".$row["uid"]."</td>";
	echo "<td>".$row["uname"]."</td>";
	echo "<td>".$row["type"]."</td>";
	echo "</tr>";
}
echo "</table>";;
mysqli_close($con);
?>

<script type="text/javascript">
  var table = document.getElementById("usersTable");
if (table) {
  for (var i = 0; i < table.rows.length; i++) {
    table.rows[i].onclick = function() {
      tableText(this);
    };
  }
}

function tableText(tableRow) {
  var id = tableRow.childNodes[0].innerHTML;
  document.getElementById("UID").value=id;
  
}
</script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>



</body>
</html>
