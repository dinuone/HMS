<?php 

	session_start();
	if(!isset($_SESSION['loggedin'])){
		header("Location: ../index.php");
		exit();
	}
	
	$usrid = $_SESSION['id'];

	include("../config/db_con.php");
	//count for appoinments
	$result = mysqli_query($conn,"SELECT COUNT(*) AS `count` FROM `appoinments` WHERE uID = '$usrid'");
	$row = mysqli_fetch_assoc($result);
	$count = $row['count'];

	//count for medical log
	$result2 = mysqli_query($conn,"SELECT COUNT(*) AS `count2` FROM `mediclog` WHERE PID = '$usrid'");
	$row2 = mysqli_fetch_assoc($result2);
	$count2 = $row2['count2'];

	date_default_timezone_set("Asia/colombo");

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
	
</style>

 	<div class="container pt-3">
 		<div class="row" id="row1">
 			<div class="col">
	 			<div class="card shadow">
	 				<div class="card-header text-center"> <div class="display-4">My Profile</div></div>
	 				<div class="card-body">
	 					<a href="../users/Myprofile.php">
							<p class="icon" id="icn1"><i class="fas fa-address-card"></i></p>
						</a>
						<h5> Name: <span><?php echo $_SESSION['name']; ?></span></h5>
	 				</div>
	 			</div>
 			</div>

 			<div class="col">
	 			<div class="card shadow">
	 				<div class="card-header text-center"> <div class="display-4">My Appoinments</div></div>
	 				<div class="card-body">
	 					<a href="../users/myAppoinment.php">
							<p class="icon" id="icn2"><i class="fas fa-calendar-check"></i></p>
						</a>
						<h5>Total Appoinments: <span class="badge badge-pill badge-danger"><?php echo $count; ?></span></h5>
	 				</div>
	 			</div>
 			</div>
 		</div>

 		<div class="row" id="row2">
 			<div class="col">
	 			<div class="card shadow">
	 				<div class="card-header text-center"> <div class="display-4">Book Appoinments</div></div>
	 				<div class="card-body">
	 					<a href="../users/BookAppoinment.php">
							<p class="icon" id="icn2"><i class="fas fa-briefcase-medical"></i></p>
						</a>
						<h5>Time: <span class="badge badge-pill badge-danger"><?php echo date("h:i:a") ?></span></h5>
	 				</div>
	 			</div>
 			</div>

 			<div class="col">
	 			<div class="card shadow">
	 				<div class="card-header text-center"> <div class="display-4">Medical History</div></div>
	 				<div class="card-body">
	 					<a href="../users/MedicHistory.php">
							<p class="icon" id="icn2"><i class="fas fa-hand-holding-medical"></i></p>
						</a>
						<h5>Total Medical Logs: <span class="badge badge-pill badge-danger"><?php echo $count2; ?></span></h5>
	 				</div>
	 			</div>
 			</div>
 		</div>

 		<div class="row" id="btn1">
 			<div class="col">
 				<a href="../users/signout.php">
					<button class="btn btn-danger btn-block" id="btnsg">
						<p id="ic"><i class="fa fa-sign-out-alt"></i></p>
					</button>
				</a>
 			</div>
 		</div>
 	</div>


 
 </html>

 