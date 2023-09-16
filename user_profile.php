<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
include 'db_connection.php'; 
session_start();
$id=$_SESSION["uid"];
$name=$_SESSION["name"];
$type=$_SESSION["type"];


$con = OpenCon();

$sql="SELECT * FROM tblusers where uid='$id'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
mysqli_close($con);
if(isset($_POST["btnSave"]))
{
	$target_dir = "user images/";
	$target_file = $target_dir . basename($_FILES["imgfile"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	move_uploaded_file($_FILES['imgfile']['tmp_name'], "user images/$id.$imageFileType");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Cache-Control" content="no-cache, must-revalidate"> 
	<meta http-equiv="Pragma" content="no-cache"> 
	<meta http-equiv="Expires" content="0"> 
	<meta http-equiv="refresh" content="300"> 


	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">



	<style type="text/css">
		.profile{
			margin: 90px 600px;
		}
	</style>
	<title>View Profile</title>
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
		// $pi = pathinfo("user image/$id");
		// $ext = $pi['extension'];
		// echo "$ext";
		if(file_exists("user images/$id.jpg"))
		{
			

			echo "<div style=\"margin: 10px 550px;\">
			<img src=\"user images/$id.jpg\" class=\"img-rounded\" alt=\"Profile Picture\" width=\"304\" height=\"236\">
			</div>";
			
			echo "<form name=\"frmProduct\" method=\"post\" action=\"#\" enctype=\"multipart/form-data\">
				
				<input type=\"file\" name=\"imgfile\" style=\"margin-left: 600px;\"><br><br>
				<input type=\"submit\" name=\"btnSave\" value=\"Upload\" style=\"margin-left: 600px;\" />
			</form>";
		}
		else
		{
			echo "<div style=\"margin: 10px 550px;\">
			<img src=\"user images/img.png\" class=\"img-rounded\" alt=\"Profile Picture\" width=\"304\" height=\"236\">
			</div>
			<form name=\"frmProduct\" method=\"post\" action=\"#\" enctype=\"multipart/form-data\">
				
				<input type=\"file\" name=\"imgfile\" style=\"margin-left: 600px;\"><br><br>
				<input type=\"submit\" name=\"btnSave\" value=\"Upload\" style=\"margin-left: 600px;\" />
			</form>";
		}
	
		?>
<div class="profile">
	<table style="border: 1px solid black;">
		<tr>
			<td ><h5>User ID:</h5></td>
			<td ><?php echo "<h5>$row[0]</h5>"; ?></td>
		</tr>
		<tr>
			<td ><h5>Name:</h5></td>
			<td ><?php echo "<h5>$row[1]</h5>"; ?></td>
		</tr>
		<tr>
			<td ><h5>User Type:</h5></td>
			<td ><?php echo "<h5>$row[3]</h5>"; ?></td>
		</tr>
	</table>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>