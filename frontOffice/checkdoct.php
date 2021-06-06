<?php

session_start();
	if(!isset($_SESSION['logR'])){
		header("Location: ../index.php");
		exit();
	}

	include("../config/db_con.php");

	$usrid = $_SESSION['id'];

	$sql = "SELECT dctID,doctorName,docSpec,docFees FROM doctor ";

	$data = mysqli_query($conn, $sql);

	$result = mysqli_fetch_all($data,MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>

<body>
<?php include('sidebar/side.html') ?>

    <style>
        .display-4{color:  #303f9f;}
        .navigation{background-color: #7a0bb5;}
        .navigation ul li:hover{background: #ad4beb;}
    </style>


<div class="container pt-3">
		<div class="card">
			<div class="card-header">
				<div class="display-4">List of Doctors</div></div>
				<div class="card-body">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Id</th>
								<th scope="col">Doctor Name</th>
								<th scope="col">Doctor Specialization</th>
								<th scope="col">Consultancy Fees</th>
								<th scope="col"></th>
							</tr>
						</thead>

						<tbody>
						<?php foreach ($result as  $results) { ?>
							<tr>
								<td><?php echo htmlspecialchars($results['dctID']); ?></td>
								<td><?php echo htmlspecialchars($results['doctorName']); ?></td>
								<td><?php echo htmlspecialchars($results['docSpec']); ?></td>
								<td><?php echo htmlspecialchars($results['docFees']); ?></td>
								
							</tr>
						  <?php } ?>
						</tbody>
					</table>
			  </div>
		</div>
	</div>
</body>
</html>