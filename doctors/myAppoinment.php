
<?php 

	session_start();
	if(!isset($_SESSION['log'])){
		header("Location: ../index.php");
		exit();
	}
	date_default_timezone_set("Asia/colombo");

	include("../config/db_con.php");

	$usrid = $_SESSION['id'];

	$sql = "SELECT docfees,appDate,timeAdd,dateAdd,usrName,uID FROM appoinments WHERE docID = '$usrid'";

	$data = mysqli_query($conn, $sql);

	$result = mysqli_fetch_all($data,MYSQLI_ASSOC);

	$appmsg="";
    if(mysqli_num_rows($data)==0){
        $appmsg = "Still You didn't get Any Appointments";
    }

	//---------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------------------

	$err = "";
	if(isset($_POST['submit'])){

		if(empty($_POST['symptom']) || empty($_POST['drugs'])){

			$err = "*Please Fill Blank Fileds";
		}else{


			$patientName = $_POST['Pname'];
			$AppoinmentDate = $_POST['apdate'];
			$DocFees = $_POST['docfees'];
			$DoctorName = $_POST['docName'];
			$PatientSymptom = $_POST['symptom'];
			$Drugs = $_POST['drugs'];
			$DateNow = $_POST['datenow'];
			$TimeNow = $_POST['timenow'];	
			$DoctorID = $_SESSION['id'];
			$patientID = $_POST['pID'];


			$sql2 = "INSERT INTO mediclog (Pname,AppDate,DocFee,DocName,PtSymptom,Drugs,DateNow,TimeNow,DocID,PID) VALUES('$patientName','$AppoinmentDate','$DocFees','$DoctorName','$PatientSymptom','$Drugs','$DateNow','$TimeNow','$DoctorID','$patientID')";

			if(mysqli_query($conn, $sql2)){
				$sql3 = "DELETE FROM appoinments WHERE uID = '$patientID'";
			
				if(mysqli_query($conn, $sql3)){

					header("Location: myAppoinment.php");
					
				}

				
			}else{
				echo "error query".$sql2."".mysqli_error($conn);
			}

			mysqli_close($conn);
		}
	}
 ?>
<!DOCTYPE html>
<html>

	<?php include('sidebar/side.html') ?>

<style>
	.display-4{color:  #303f9f;}
	#icon{color: red; float: right;}
	#icon:hover{color:#ba0b0b; }
	#msg{text-align:center; color:red;}
	
	#cont{padding-top: 30px;}
	#cont{visibility: hidden;}
	#cont.active{visibility: visible;}

	.red-text{color: red; font-size: 14px;}
	.navigation{background-color: #16a30f;}
	.navigation ul li:hover{background: #32de16;}
</style>

	<div class="container pt-3">
		<div class="card shadow">
			<div class="card-header"><div class="display-4">Received Appoinments</div></div>
			<div class="card-body">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Patient ID</th>
								<th scope="col">Patient Name</th>
								<th scope="col">Appoinment Date</th>
								<th scope="col">consultanzy Fees</th>
								<th scope="col">Time</th>
								<th scope="col">Date</th>
								<th scope="col"></th>
								<th scope="col"></th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($result as $results) { ?>
							<tr>
								<td><?php echo htmlspecialchars($results['uID']); ?></td>
								<td><?php echo htmlspecialchars($results['usrName']); ?></td>
								<td><?php echo htmlspecialchars($results['appDate']); ?></td>
								<td><?php echo htmlspecialchars($results['docfees']); ?></td>
								<td><?php echo htmlspecialchars($results['timeAdd']); ?></td>
								<td><?php echo htmlspecialchars($results['dateAdd']); ?></td>
								<td><button class="btn btn-success" id="btnget">Add Log</button></td>
								
							</tr>
						<?php } ?>
						</tbody>
					</table>
					<h5 id="msg"><?php echo $appmsg; ?></h5>
			</div>
		</div>
	</div>

	<div class="container" id="cont">
		<div class="card">
			<div class="card-header"><div class="display-4">Add to Medical Log<i class="fa fa-window-close" id="icon"></i></div></div>
			<div class="card-body">
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
					
					<div class="row">
						<div class="form-group col">
							<label>Patient Name</label>
							<input type="text" name="Pname" class="form-control" readonly id="PatienName" value="">
						</div>
						<div class="form-group col">
							<label>Appoinment Date</label>
							<input type="text" name="apdate" class="form-control" readonly id="AppDate" value="">
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label>Consultancy Fees</label>
							<input type="text" name="docfees" class="form-control" readonly id="Dfee" value="">
						</div>
						<div class="form-group col">
							<label>Doctor Name</label>
							<input type="text" name="docName" class="form-control" readonly  value="<?php echo $_SESSION['name'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label>Patient ID</label>
						<input type="text" name="pID" class="form-control" readonly  value="" id="ptID">
					</div>
					<div class="form-group">
						<label> Patient's Symptom</label>
						<div class="red-text"><?php echo $err ?></div>
						<textarea class="form-control" name="symptom"></textarea>
					</div>
					<div class="form-group">
						<label> Prescription drugs</label>
						<div class="red-text"><?php echo $err ?></div>
						<textarea class="form-control" name="drugs"></textarea>
					</div>
					<div class="row">
						<div class="form-group col">
							<label>Date</label>
							<input type="text" name="datenow" class="form-control" readonly value="<?php echo date("Y/m/d") ?>">
						</div>
						<div class="form-group col">
							<label>Time</label>
							<input type="text" name="timenow" class="form-control" readonly value=" <?php echo date("h:i:a") ?>">
						</div>
					</div>

					<div class="form-group">
						<button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  							Add to Medical Log</button>	
					</div>
					
						<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel">Do you want add Patient to Medical Log?</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						        <button type="submit" class="btn btn-primary" name="submit">Yes</button>
						      </div>
						    </div>
						  </div>
						</div>
				</form>
			</div>
		</div>
	</div>



<script>
		$('.table tbody').on('click','#btnget', function(){
			var curntrow = $(this).closest('tr');
			var col1 = curntrow.find('td:eq(0)').text();
			var col2 = curntrow.find('td:eq(1)').text();
			var col3 = curntrow.find('td:eq(2)').text();
			var col4 = curntrow.find('td:eq(3)').text();
			

			$("#cont").addClass("active");
			
			$("#ptID").val(col1);
			$("#PatienName").val(col2);
			$("#AppDate").val(col3);
			$("#Dfee").val(col4);
			
		});

		$('#icon').on('click', function(){
			$('#cont').removeClass("active");
		});
		
	</script>
</body>
</html>