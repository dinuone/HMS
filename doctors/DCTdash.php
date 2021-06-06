<?php 

	session_start();
	if(!isset($_SESSION['log'])){
		header("Location: ../index.php");
		exit();
	}

	date_default_timezone_set("Asia/colombo");
	$today = date("Y/m/d");
	$usrid = $_SESSION['id'];
	$name = $_SESSION['name'];

	include("../config/db_con.php");
	//count for appoinments
	$result = mysqli_query($conn,"SELECT COUNT(*) AS `count` FROM `appoinments` WHERE docID = '$usrid'");
	$row = mysqli_fetch_assoc($result);
	$count = $row['count'];


	//count for medical log
	$result2 = mysqli_query($conn,"SELECT COUNT(*) AS `count2` FROM `mediclog` WHERE DocID = '$usrid'");
	$row2 = mysqli_fetch_assoc($result2);
	$count2 = $row2['count2'];

	//count for today ptient list
	$result3 = mysqli_query($conn,"SELECT COUNT(*) AS `count3` FROM `patients` WHERE DocName = '$name' AND DateNow = '$today'");
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
	#icndash:hover{color: #32de16;}
	#icndash{color: #16a30f;}
	.navigation{background-color: #16a30f;}
	.navigation ul li:hover{background: #32de16;}
	

</style>

 	<div class="container pt-3">
 		<div class="row" id="row1">
 			<div class="col">
	 			<div class="card shadow">
	 				<div class="card-header text-center"> <div class="display-4">My Profile</div></div>
	 				<div class="card-body">
	 					<a href="../doctors/Myprofile.php">
							<p class="icon" id="icn1"><i class="fas fa-address-card" id="icndash"></i></p>
						</a>
						<h5> Name: <span><?php echo $_SESSION['name']; ?></span></h5>
	 				</div>
	 			</div>
 			</div>

 			<div class="col">
	 			<div class="card shadow">
	 				<div class="card-header text-center"> <div class="display-4">Appoinments</div></div>
	 				<div class="card-body">
	 					<a href="../doctors/myAppoinment.php">
							<p class="icon" id="icn2"><i class="fas fa-calendar-check" id="icndash"></i></p>
						</a>
						<h5>Total Received Appoinments: <span class="badge badge-pill badge-danger"><?php echo $count; ?></span></h5>
	 				</div>
	 			</div>
 			</div>
 		</div>

 		<div class="row" id="row2">
 			<div class="col">
	 			<div class="card shadow">
	 				<div class="card-header text-center"> <div class="display-4">Medical Log</div></div>
	 				<div class="card-body">
	 					<a href="../doctors/MedicHistory.php">
							<p class="icon" id="icn2"><i class="fas fa-briefcase-medical" id="icndash"></i></p>
						</a>
						<h5>Total Medical Logs: <span class="badge badge-pill badge-danger"><?php echo $count2; ?></span></h5>
	 				</div>
	 			</div>
 			</div>

 			<div class="col">
	 			<div class="card shadow">
	 				<div class="card-header text-center"> <div class="display-4">Today Patients List</div></div>
	 				<div class="card-body">
	 					<a href="../doctors/todaylist.php">
							<p class="icon" id="icn2"><i class="fa fa-notes-medical" id="icndash"></i></i></p>
						</a>
						<h5>Total Awaiting Patients: <span class="badge badge-pill badge-danger"><?php echo $count3 ?></span></h5>
	 				</div>
	 			</div>
 			</div>
 		</div>

		<div class="row" id="row2">
			<div class="col">
				<div class="card shadow">
				<div class="card-header text-center"> <div class="display-4">My Schedule</div></div>
					<div class="card-body">
					<a href="../doctors/schedule.php">
						<p class="icon" id="icn2"><i class="fas fa-briefcase-medical" id="icndash"></i></p>
					</a>
					<h5>Click here to Add schedules</h5>
					</div>
				</div>
			</div>
		</div>

 		<div class="row" id="btn1">
 			<div class="col">
 				<a href="../doctors/signout.php">
					<button class="btn btn-danger btn-block" id="btnsg">
						<p id="ic"><i class="fa fa-sign-out-alt"></i></p>
					</button>
				</a>
 			</div>
 		</div>

 	</div>



 
 </html>

 