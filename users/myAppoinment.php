
<?php 

	session_start();
	if(!isset($_SESSION['loggedin'])){
		header("Location: ../index.php");
		exit();
	}

	include("../config/db_con.php");

	$usrid = $_SESSION['id'];

	$sql = "SELECT id,docName,docspec,docfees,appDate,timeAdd,dateAdd FROM appoinments WHERE uID = '$usrid'";

	$data = mysqli_query($conn, $sql);

	$result = mysqli_fetch_all($data,MYSQLI_ASSOC);


 ?>
<!DOCTYPE html>
<html>

	<?php include('sidebar/side.html') ?>

<style>
	.display-4{color: #303f9f;}
</style>

	<div class="container pt-3">
		<div class="card shadow">
			<div class="card-header"><div class="display-4">My Appoinments</div></div>
			<div class="card-body">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Doctor Name</th>
								<th scope="col">Doctor Specialization</th>
								<th scope="col">consultanzy Fees</th>
								<th scope="col">Appointment Date</th>
								<th scope="col">Time</th>
								<th scope="col">Date</th>
								<th scope="col"></th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($result as $results) { ?>
							<tr>
								<td><?php echo htmlspecialchars($results['docName']); ?></td>
								<td><?php echo htmlspecialchars($results['docspec']); ?></td>
								<td><?php echo htmlspecialchars($results['docfees']); ?></td>
								<td><?php echo htmlspecialchars($results['appDate']); ?></td>
								<td><?php echo htmlspecialchars($results['timeAdd']); ?></td>
								<td><?php echo htmlspecialchars($results['dateAdd']); ?></td>
								<td>
									<div class="form-group">
										<button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Cancel
										</button>	
									</div>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
					
			</div>
		</div>
	</div>

	<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						 <div class="modal-header">
						    <h5 class="modal-title" id="exampleModalLabel">Do you want Cancel Appoinment?</h5>
						    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						       <span aria-hidden="true">&times;</span>
						     </button>
						   </div>
						  <div class="modal-footer">
						    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						    <a href="../users/delete.php?rowid=<?php echo $results['id'];?>" class="btn btn-danger">Yes</a>
						  </div>
					</div>
				</div>
			</div>

</body>
</html>