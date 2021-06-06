<?php 
	session_start();
	if(!isset($_SESSION['loggedin'])){
		header("Location: ../index.php");
		exit();
	}

	include("../config/db_con.php");

	$usrid = $_SESSION['id'];

	$sql = "SELECT Pname,AppDate,DocFee,DocName,PtSymptom,Drugs,DateNow,TimeNow FROM mediclog WHERE PID = '$usrid'";

	$data = mysqli_query($conn, $sql);

	$result = mysqli_fetch_all($data,MYSQLI_ASSOC);

 ?>

<!DOCTYPE html>
<html>

	<?php include('sidebar/side.html') ?>
	<style>	
		.card{width: 80%; margin-left: 200px; }
		.display-4{color: #303f9f;}
		.box{padding-top: 30px;}
	</style>
	<div class="box">s
		<div class="card">
			<div class="card-header"><div class="display-4">Medical History</div></div>
			<div class="card-body">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Patient Name</th>
								<th scope="col">Appoinment Date</th>
								<th scope="col">consultanzy Fees</th>
								<th scope="col">Doctor Name</th>
								<th scope="col">Visit Date</th>
								<th scope="col">Visit Time</th>
								<th scope="col">Prescription Drugs</th>
								<th scope="col">Symptom</th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($result as $results) { ?>
							<tr>
								<td><?php echo htmlspecialchars($results['Pname']); ?></td>
								<td><?php echo htmlspecialchars($results['AppDate']); ?></td>
								<td><?php echo htmlspecialchars($results['DocFee']); ?></td>
								<td><?php echo htmlspecialchars($results['DocName']); ?></td>
								<td><?php echo htmlspecialchars($results['DateNow']); ?></td>
								<td><?php echo htmlspecialchars($results['TimeNow']); ?></td>
								<td><?php echo htmlspecialchars($results['PtSymptom']); ?></td>
								<td><?php echo htmlspecialchars($results['Drugs']); ?></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
			</div>
		</div>
	</div>
</body>
</html>