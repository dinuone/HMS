<?php 
	session_start();
	if(!isset($_SESSION['log'])){
		header("Location: ../index.php");
		exit();
	}

	include("../config/db_con.php");

	$usrid = $_SESSION['id'];

	$sql = "SELECT Pname,AppDate,DocName,PtSymptom,Drugs,DateNow,TimeNow,DocFee FROM mediclog WHERE DocID = '$usrid'";

	$data = mysqli_query($conn, $sql);

	$result = mysqli_fetch_all($data,MYSQLI_ASSOC);


 ?>


<!DOCTYPE html>
<html>

<body>
<?php include('sidebar/side.html') ?>

	<style>
		.display-4{color:  #303f9f;}
		.navigation{background-color: #16a30f;}
		.navigation ul li:hover{background: #32de16;}
		.box{padding-top: 30px;}
		.card{width: 80%; margin-left: 200px; }
	</style>
	
	<div class="box">
		<div class="card">
			<div class="card-header"><div class="display-4">Your Patients Medical Log</div></div>
			<div class="card-body">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Patient Name</th>
								<th scope="col">Appoinment Date</th>
								<th scope="col">consultanzy Fees</th>
								<th scope="col">Ptient's Symptom</th>
								<th scope="col">Prescription Drugs</th>
								<th scope="col">Date</th>
								<th scope="col">Time</th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($result as $results) { ?>
							<tr>
								<td><?php echo htmlspecialchars($results['Pname']); ?></td>
								<td><?php echo htmlspecialchars($results['AppDate']); ?></td>
								<td><?php echo htmlspecialchars($results['DocFee']); ?></td>
								<td><?php echo htmlspecialchars($results['PtSymptom']); ?></td>
								<td><?php echo htmlspecialchars($results['Drugs']); ?></td>
								<td><?php echo htmlspecialchars($results['DateNow']); ?></td>
								<td><?php echo htmlspecialchars($results['TimeNow']); ?></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
			</div>
		</div>
	</div>
</body>
</html>