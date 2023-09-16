<?php
include 'db_connection.php';
session_start();
$name=$_SESSION["name"];
$type=$_SESSION["type"];
$_SESSION['previous_location'] = 'add_student';
//echo date_diff(date_create('1970-01-01'), date_create('today'))->y;
if(isset($_POST["btnsubmit"]) && $_POST["txtfname"]!="")
{
	$con=OpenCon();
	$sid=$_POST["txtsid"];
	$fname=$_POST["txtfname"];
	$lname=$_POST["txtlname"];
	$address=$_POST["txtaddress"];
	$tp=$_POST["txttp"];
	$bd=$_POST["txtbirthday"];
	$sql="INSERT INTO students(sid,fname,lname,address,tp,bd) VALUES('$sid','$fname','$lname','$address','$tp','$bd')";
	$result=mysqli_query($con,$sql);
	if($result==1)
	{
		//$sql1="CREATE TABLE $sid(exid int NOT NULL AUTO_INCREMENT PRIMARY KEY,exam varchar(25) NOT NULL)";
    $sql1="CREATE TABLE $sid(year int NOT NULL,exam varchar(25) NOT NULL,PRIMARY KEY(year,exam))";
		$result1=mysqli_query($con,$sql1);
		if(!empty($_POST['Subjects']))
		{
      		foreach($_POST['Subjects'] as $checked)
      		{
        		$sql2="ALTER TABLE $sid ADD $checked DECIMAL(4,2)";//int
        		$result2=mysqli_query($con,$sql2);
      		}

    	}

		 echo "<script language=\"javascript\" type=\"text/javascript\">alert(\"Student added successfully\")</script>";
	}
	else
	{
		 echo "<script language=\"javascript\" type=\"text/javascript\">alert(\"Student adding failed, try again...!\")</script>";
	}
	mysqli_close($con);
	header("Location:redirect.php");
}


$con = OpenCon();
	
	$sql="SELECT MAX(index_no) AS index_no FROM students";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
	$b=$row[0];
	$a=(int)$b;
	$a++;
	$id1="S".str_pad($a, 5, '0', STR_PAD_LEFT);
	mysqli_close($con);
?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
    body 
    {
        background-image: url('images/std.jpg');
        height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
    }
    </style>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Add New Student</title>
  </head>




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
            <?php if($type=="Admin"){echo "<li><a class=\"dropdown-item\" href=\"enter_results.php\">Enter/Update Results</a></li>";}?>
            <li><a class="dropdown-item" href="view_results.php">View Results</a></li>
            <li><a class="dropdown-item" href="student_reports.php">View Student's Reports</a></li>
            <?php if($type=="Admin"){echo "<li><a class=\"dropdown-item\" href=\"add_new_student.php\">Add New Student</a></li>";}?>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Manage System Users
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="view_users.php">View Users</a></li>
            <?php if($type=="Admin"){echo "<li><a class=\"dropdown-item\" href=\"add_users.php\">Add new user</a></li>";}?>
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




  <body>
    <h2>Add New Student</h2>
    <form name="addstudent" method="POST" action="#">
	<table cellpadding="18px">
		<tr>
			<td>Student ID</td>
			<td><input type="text" class="form-control" name="txtsid" readonly value="<?php echo $id1; ?>"></td>
		</tr>
		<tr>
			<td>First Name</td>
			<td><input type="text" class="form-control" name="txtfname" required></td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td><input type="text" class="form-control" name="txtlname" required></td>
		</tr>
		<tr>
			<td>Address</td>
			<td><input type="text" class="form-control" name="txtaddress" required></td>
		</tr>
		<tr>
			<td>Telephone No.</td>
			<td><input type="tel" class="form-control" name="txttp" pattern="^(?:7|0|(?:\+94))[0-9]{9,10}$" maxlength="10" required></td>
		</tr>
		<tr>
			<td>Birth Day</td>
			<td><input type="date" class="form-control" name="txtbirthday" required></td>
		</tr>
		<tr>
			<td>Subjects</td>
			<td>
				<input class="form-check-input" type="checkbox" value="Sinhala" name="Subjects[]" id="Sinhala" checked>
  				<label class="form-check-label" for="Sinhala">Sinhala</label>
  				<input class="form-check-input" type="checkbox" value="English" name="Subjects[]" id="English" checked>
  				<label class="form-check-label" for="English">English</label><br>
  				<input class="form-check-input" type="checkbox" value="Mathematics" name="Subjects[]" id="Mathematics" checked>
  				<label class="form-check-label" for="Mathematics">Mathematics</label>
  				<input class="form-check-input" type="checkbox" value="Science" name="Subjects[]" id="Science" checked>
  				<label class="form-check-label" for="Science">Science</label><br>
  				<input class="form-check-input" type="checkbox" value="IT" name="Subjects[]" id="IT">
  				<label class="form-check-label" for="IT">IT</label>
  				<input class="form-check-input" type="checkbox" value="Commerce" name="Subjects[]" id="Commerce">
  				<label class="form-check-label" for="Commerce">Commerce</label><br>
  				<input class="form-check-input" type="checkbox" value="Agriculture" name="Subjects[]" id="Agriculture">
  				<label class="form-check-label" for="Agriculture">Agriculture</label>
  				<input class="form-check-input" type="checkbox" value="Music" name="Subjects[]" id="Music">
  				<label class="form-check-label" for="Music">Music</label><br>
  				<input class="form-check-input" type="checkbox" value="Geography" name="Subjects[]" id="Geography">
  				<label class="form-check-label" for="Geography">Geography</label>
  				<input class="form-check-input" type="checkbox" value="History" name="Subjects[]" id="History">
  				<label class="form-check-label" for="History">History</label>

  			</td>
		</tr>
	</table>
	<input type="submit" name="btnsubmit" value="Add Student" class="btn btn-primary btn-lg">
	</form>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    
  </body>
</html>