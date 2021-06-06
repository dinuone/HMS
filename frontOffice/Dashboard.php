<?php 

	session_start();
	if(!isset($_SESSION['logR'])){
		header("Location: ../index.php");
		exit();
	}
	
	$usrid = $_SESSION['id'];

	include("../config/db_con.php");
	

	date_default_timezone_set("Asia/colombo");
	$today = date("Y/m/d");

	//count for today ptient list
	$result3 = mysqli_query($conn,"SELECT COUNT(*) AS `count3` FROM `patients` WHERE  DateNow = '$today'");
	$row3 = mysqli_fetch_assoc($result3);
	$count3 = $row3['count3'];

 ?>

 <!DOCTYPE html>
 <html>
 <head>
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

   <link rel="stylesheet" type="text/css" href="../users/style.css">
 </head>
 <body>
 	<?php include('sidebar/side.html') ?>


<style> 
	#ic{font-size: 60px; margin-top: -20px; margin-bottom: -20px; padding: 5px;}
	.navigation{background-color: #7a0bb5;}
	.navigation ul li:hover{background: #ad4beb;}
	#icn1{color: #7a0bb5;}
	#icn1:hover{color:#ad4beb; }
	#btn1{padding-bottom:30px;}
	;
</style>

 	<div class="container pt-3">
 		<div class="row" id="row1">
 			<div class="col">
	 			<div class="card shadow">
	 				<div class="card-header text-center"> <div class="display-4">My Profile</div></div>
	 				<div class="card-body">
	 					<a href="../frontOffice/Myprofile.php">
							<p class="icon" id="icn1"><i class="fas fa-address-card"></i></p>
						</a>
						<h5> Name: <span><?php echo $_SESSION['name']; ?></span></h5>
	 				</div>
	 			</div>
 			</div>

 			<div class="col">
	 			<div class="card shadow">
	 				<div class="card-header text-center"> <div class="display-4">Add Patients</div></div>
	 				<div class="card-body">
	 					<a href="../frontOffice/addpatient.php">
							<p class="icon" id="icn1"><i class="fa fa-hospital-user"></i></p>
						</a>
						<h5>Today Total Patients: <span class="badge badge-pill badge-danger"><?php echo $count3; ?></span></h5>
	 				</div>
	 			</div>
 			</div>
 		</div>

 		<div class="row" id="row2">
 			<div class="col">
	 			<div class="card shadow">
	 				<div class="card-header text-center"> <div class="display-4">Check Doctors List</div></div>
	 				<div class="card-body">
	 					<a href="../frontOffice/checkdoct.php">
							<p class="icon" id="icn1"><i class="fa fa-user-md"></i></p>
						</a>
						<h5>Time: <span class="badge badge-pill badge-danger"><?php echo date("h:i:a") ?></span></h5>
	 				</div>
	 			</div>
 			</div>
 		</div>

		 <div class="row" id="row2">
		 <div class="col">
	 			<div class="card shadow">
	 				<div class="card-header text-center"> <div class="display-4">Today Patient List</div></div>
	 				<div class="card-body">
	 					<a href="../frontOffice/todaylist.php">
							<p class="icon" id="icn1"><i class="fa fa-file-import"></i></p>
						</a>
						
	 				</div>
	 			</div>
 			</div>
		</div>

 		<div class="row" id="btn1">
 			<div class="col">
 				<a href="../frontOffice/signout.php">
					<button class="btn btn-danger btn-block" id="btnsg">
						<p id="ic"><i class="fa fa-sign-out-alt"></i></p>
					</button>
				</a>
 			</div>
 		</div>
 	</div>


 
 </html>

 