<?php
include 'db_connection.php';
session_start();
$name=$_SESSION["name"];
$type=$_SESSION["type"];
$_SESSION['previous_location'] = 'add_user';

	$con = OpenCon();
	
	$sql="SELECT MAX(index_no) AS index_no FROM tblusers";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
	$b=$row[0];
	$a=(int)$b;
	$a++;
	$id1="U".str_pad($a, 3, '0', STR_PAD_LEFT);
	mysqli_close($con);
	
if(isset($_POST["txtUserID"]) && $_POST["txtUserName"]!="" && $_POST["pwd"]==$_POST["cpwd"] && strlen($_POST["pwd"])>=6)
{
	// $con=mysqli_connect("localhost","anushna","#anushna99");
	// mysqli_select_db($con,"myfirstdb");

	$con = OpenCon();

	$id=$_POST["txtUserID"];
	$name1=$_POST["txtUserName"];
	$type1=$_POST["userType"];
	$pwd=$_POST["pwd"];
	$sql="INSERT INTO tblusers(uid,uname,password,type,index_no) VALUES('$id','$name1','$pwd','$type1','$a')";
	$result=mysqli_query($con,$sql);
	//unset($_POST["txtUserID"]);
if($result==1)
{
 header("Location:redirect.php");
}
else
{
	echo "User adding failed...!";
}
mysqli_close($con);

}
	// $con=mysqli_connect("localhost","anushna","#anushna99");
	// mysqli_select_db($con,"myfirstdb");

	/*$con = OpenCon();
	
	$sql="SELECT MAX(index_no) AS index_no FROM tblusers";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
	$b=$row[0];
	$a=(int)$b;
	$a++;
	$id1="U".str_pad($a, 3, '0', STR_PAD_LEFT);
	mysqli_close($con);*/
?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

	<title>Add Users</title>
	<style type="text/css">
		.form
		{
			align-items: center;
    		background-color: #a7c5eb;
    		border: none;
    		border-radius: 8px;
    		box-shadow: 0 2px 4px rgba(0, 0, 0, .1), 0 8px 16px rgba(0, 0, 0, .1);
    		box-sizing: border-box;
    		margin: 200px 480px 0;
    		padding: 20px 20px 28px 20px;
    		
		}
		.heading
		{
			text-align: center;
		}
		.btns
		{
			margin: 0;
  			position: absolute;
  			left: 50%;
  			-ms-transform: translate(-50%, -50%);
  			transform: translate(-50%, -50%);
		}
		input[type=submit]
		{
			background-color: #adce74;
			font-size: 16px;
			padding: 10px 24px;
			border-radius: 8px;
			color: #a20a0a ;
		}
		button
		{
			background-color: #adce74;
			font-size: 16px;
			padding: 10px 24px;
			border-radius: 8px;
		}
		body
		{
        background-image: url('images/add user page.jpg');
        height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
    }
	</style>
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


	<div class="form">
		<div class="heading">
			<h1>Add Users</h1>
		</div>
<form name="addUser" method="POST" action="#">
	<table cellpadding="10px" cellspacing="10px">
		<tr>
			<td><label>User ID:</label></td>
			<td><input type="text" name="txtUserID" class="form-control" readonly value="<?php echo $id1; ?>"></td>
		</tr>
		<tr>
			<td><label>User Name:</label></td>
			<td><input type="text" class="form-control" name="txtUserName">
			<?php 
				if(isset($_POST["txtUserName"]) && $_POST["txtUserName"]=="")
				{
					
						echo "<span><font color=\"RED\">username cannot be blank</font></span>";
				}
			?>
			</td>
		</tr>
		<tr>
			<td><label>User Type:</label></td>
			<td>
				<select name="userType" class="form-select">
					<option value="Regular">Regular User</option>
					<option value="Admin">Admin</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><label>Password:</label></td>
			<td><input type="Password" class="form-control" name="pwd">
				<?php 
					if(isset($_POST["pwd"]) && strlen($_POST["pwd"])<6)
					{
						echo "<font color=\"RED\">password should have more than 6 characters</font>";
					}
				?>
			</td>
		</tr>
		<tr>
			<td><label>Confirm Password:</label></td>
			<td><input type="Password" class="form-control" name="cpwd">
			<?php
			if(isset($_POST["pwd"]) && ($_POST["pwd"]!=$_POST["cpwd"]))
			{
				echo "<span><font color=\"RED\">Confirmed Password Does Not Match</font></span>";
			}
			?>
		</td>
		</tr>
    </table>
	<br>
	<div class="btns">
		<input type="submit" name="btn_submit" class="btn btn-primary btn=lg" value="Add User">
		<!-- <button><a href='home.php' style="color: #a20a0a;">Back To Home</a></button> -->
	</div>
</form>
</div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>
</html>