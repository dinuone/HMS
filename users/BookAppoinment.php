<?php 
session_start();
	if(!isset($_SESSION['loggedin'])){
		header("Location: ../index.php");
		exit();
	}

include("../config/db_con.php");
	
	$sql = 'SELECT  dctID,doctorName,docSpec,docFees FROM doctor';

	$result = mysqli_query($conn, $sql);

	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);

	
	date_default_timezone_set("Asia/colombo");

	$err="";

	if(isset($_POST['submit'])){

		if(empty($_POST['apdate'])){
			$err="please Enter Appoinment Date";
		}else{

			$doctorid = $_POST['docid'];
			$doctorname = $_POST['docname'];
			$doctorfee = $_POST['docfees'];
			$docspecial = $_POST['docspec'];
			$appoinmentDate = $_POST['apdate'];
			$TimeNow = $_POST['timenow'];
			$DateNow = $_POST['datenow'];
			$userid = $_SESSION['id'];	
			$name =  $_SESSION['name'];


			$sql2 = "INSERT INTO appoinments (uID,docID,docName,usrName,timeAdd,dateAdd,appDate,docfees,docspec) VALUES('$userid','$doctorid','$doctorname','$name','$TimeNow','$DateNow','$appoinmentDate','$doctorfee','$docspecial')";

			if(mysqli_query($conn, $sql2)){
				header("Location: USRdash.php");
				
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
		.display-4{color: #303f9f;}
		#cont{padding-top: 40px;  }

		#icon{color: red; float: right;}
		#icon:hover{color:#c71414;}
		.red-text{color: red; font-size: 13px;}
		#cont{visibility: hidden;}
		#cont.active{visibility: visible;}
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
						<?php foreach ($data as  $datas) { ?>
							<tr>
								<td><?php echo htmlspecialchars($datas['dctID']); ?></td>
								<td><?php echo htmlspecialchars($datas['doctorName']); ?></td>
								<td><?php echo htmlspecialchars($datas['docSpec']); ?></td>
								<td><?php echo htmlspecialchars($datas['docFees']); ?></td>
								<td><button class="btn btn-success" id="btnget">Book</button></td>
							</tr>
						  <?php } ?>
						</tbody>
					</table>
			  </div>
		</div>
	</div>

	<div class="container" id="cont">
		<div class="card">
			<div class="card-header"><div class="display-4">Book Appoinment<i class="fa fa-window-close" id="icon"></i></div></div>
			<div class="card-body">
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
					<div class="row">
						<div class="form-group col">
							<label for="docID">Dctor Id</label>
							<input type="text" name="docid" class="form-control" readonly id="did" value="">
						</div>
						<div class="form-group col">
							<label for="docID">Dctor Name</label>
							<input type="text" name="docname" class="form-control" readonly id="dname" value="">
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label for="docID">Dctor Specialization</label>
							<input type="text" name="docspec" class="form-control" readonly id="dspec" value="">
						</div>
						<div class="form-group col">
							<label for="docID">Consultancy Fees</label>
							<input type="text" name="docfees" class="form-control" readonly id="dfee" value="">
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<div class="red-text"><?php echo $err; ?></div>
							<label for="docID">Appintment Date</label>
							<input type="date" name="apdate" class="form-control" placeholder="YY-MM-DD" value="">
						</div>
						<div class="form-group col">
							<label for="docID">Date</label>
							<input type="text" name="datenow" class="form-control" readonly value="<?php echo date("Y/m/d") ?>">
						</div>
						<div class="form-group col">
							<label for="docID">Time</label>
							<input type="text" name="timenow" class="form-control" readonly value=" <?php echo date("h:i:a") ?>">
						</div>
					</div>

					<div class="form-group">
						<button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  							Book Appoinment</button>	
					</div>
					
					<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel">Do you confirm this Appoinment?</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
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
		

			$("#did").val(col1);
			$("#dname").val(col2);
			$("#dspec").val(col3);
			$("#dfee").val(col4);
		});

		$('#icon').on('click', function(){
			$('#cont').removeClass("active");
		});
		
	</script>
</body>
</html>