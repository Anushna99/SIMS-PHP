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

    <title>Student Reports</title>
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
if(isset($_POST["btnView"]))
{
$con = OpenCon();
$sid=lcfirst($_POST["Id"]);
$exam=$_POST["selectExam"];
$year=$_POST["selectYear"];
$sql="SELECT * FROM $sid WHERE exam='$exam' and year='$year'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
$sql1="DESCRIBE $sid";
$result1=mysqli_query($con,$sql1);
$subjects=array();
$index=2;
while ($row1=mysqli_fetch_assoc($result1)) {
	if($row1["Field"]=="year" || $row1["Field"]=="exam"){continue;}
	$subjects[$row1["Field"]]=$row[$index];
	$index=$index+1;
}


$dataPoints = array(
	
);



foreach($subjects as $subject=>$mark) {
	$val=array("y" => $mark, "label" => $subject);
	array_push($dataPoints,$val);
}
 mysqli_close($con);
}
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Results Of Term Test"
	},
	axisY: {
		title: "Marks"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

var chart1 = new CanvasJS.Chart("chartContainer1", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "Term Test Results"
  },
  axisY: {
    title: "Marks"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart1.render();
 
}


</script>
</head>
<body>

	<form name="selectStudent" method="POST" action="#">
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
echo "<table style=\"float:right; width:20%;\" id=\"tblStudent\" class=\"table table-striped table-hover\">";
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
  		$sql="SELECT exam FROM $id";
  		$result=mysqli_query($con,$sql);
      $sql1="SELECT year FROM $id";
      $result1=mysqli_query($con,$sql1);

  		if($result==TRUE)
  		{
  			echo "<form name=\"selectExam\" method=\"POST\" action=\"#\">";
  			echo "<table cellpadding=\"10px\">";
  			echo "<tr>";
  			echo "<td><select name=\"selectExam\" class=\"form-select\">";
  			while($row=mysqli_fetch_assoc($result))
  			{
  				$val=$row["exam"];
  				echo "<option value=\"$val\">".$row["exam"]."</option>";
  			}
  			echo "</select></td>";
        echo "<td><select name=\"selectYear\" class=\"form-select\">";
        while($row1=mysqli_fetch_assoc($result1))
        {
          $val=$row1["year"];
          echo "<option value=\"$val\">".$row1["year"]."</option>";
        }
        echo "</select></td>";
  			echo "<td><input type=\"submit\" name=\"btnView\" value=\"View Report\" class=\"btn btn-primary btn-lg\"></td>";
  			echo "<td><input type=\"hidden\" id=\"Id\" name=\"Id\" value=\"$id\"></td>";
  			echo "</tr>";
  			echo "</table>";
  			echo "</form>";
  		}else{
         echo "<font color=\"RED\">No Entries Available!...</font>";
      }
  		mysqli_close($con);

  	}

  ?>
  <?php

if(isset($_POST["btnView"]))
{
	echo "<h5> ".ucfirst($_POST["Id"])." ".$_POST["selectExam"]." in ".$_POST["selectYear"]."</h5>";
  echo "<div id=\"chartContainer1\" style=\"height: 370px; width: 40%; float: left;\"></div>";
	echo"<div id=\"chartContainer\" style=\"height: 370px; width: 40%;\"></div>";
  echo"<script src=\"https://canvasjs.com/assets/script/canvasjs.min.js\"></script>";
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