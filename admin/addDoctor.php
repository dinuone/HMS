<?php 
	
	session_start();
	if(!isset($_SESSION['logadmin'])){
		header("Location: ../index.php");
		exit();
	}

	$usrid = $_SESSION['logadmin'];

	include("../config/db_con.php");

	$sql2 = "SELECT * FROM doctor";

	$data2 = mysqli_query($conn, $sql2);

	$result = mysqli_fetch_array($data2, MYSQLI_ASSOC);


	if(isset($_POST['submit'])){

		$docname = $_POST['fullname'];
		$cont = $_POST['contact'];
		$adrs = $_POST['address'];
		$gender = $_POST['gender'];
		$username = $_POST['usrname'];
		$psw = $_POST['paswd'];
		$docspec = $_POST['docspec'];
		$docfee = $_POST['docfee'];
		
		
		$sql = "INSERT INTO doctor(doctorName,Address,contact,Gender,usrName,PSW,docSpec,docFees) VALUES('$docname','$adrs','$cont','$gender','$username','$psw','$docspec','$docfee')";
		if(mysqli_query($conn, $sql)){
			
			
			echo "success";

		}else{
			echo "query error" . mysqli_error($conn);
		}


	}



 ?>


<!DOCTYPE html>
<html>

<body>

<?php include('sidebar/side.html') ?>

<style>
	.display-4{color: #303f9f;}
	#icon{color: red; float: right;}
	#icon:hover{color:#c71414;}
	#cont{visibility: hidden;}
	#cont.active{visibility: visible;}

	.red-text{color: red; font-size: 13px;}

	.navigation{background-color:  #C71585;}
	.navigation ul li:hover{background: #E6358B;}
</style>


	<div class="container pt-3">
		<div class="card">
			<div class="card-header"><div class="display-4">Add Doctor</div></div>
			<div class="card-body">
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
					<div class="form-group">
						<label for="name">Full Name</label>
						<input type="text" name="fullname" value="" class="form-control">
					</div>
					<div class="form-group">
						<label for="name">contact</label>
						<input type="text" name="contact" value="" class="form-control">
					</div>
					<div class="form-group">
						<label for="name">Address</label>
						<input type="text" name="address" value="" class="form-control">
					</div>
					<div class="form-group">
						<label for="gen">Gender</label>
						<select name="gender" value="" class="form-control">
						<option value="Male">Male</option>
						<option value="Female">Female</option>
						</select>
					</div>
					<div class="row">
						<div class="form-group col">
							<label for="docspec">Specialization</label>
							<input type="text" name="docspec" value="" class="form-control">
						</div>
						<div class="form-group col">
							<label for="docfee">Counsultancy Fee</label>
							<input type="text" name="docfee" value="" class="form-control">
						</div>
						
					</div>
					<div class="row">
						<div class="form-group col">
							<label for="City">Username</label>
							<input type="text" name="usrname" value="" class="form-control">
						</div>
						<div class="form-group col">
							<label for="gen">Password</label>
							<input type="text" name="paswd" value="" class="form-control" id="pswrd">
						</div>
					</div>

					<div class="form-group">
						<button class="btn btn-primary" type="submit" name="submit">Save Changes</button>		
					</div>
				</form>
			</div>
			
		</div>
	</div>




<script>
	
		
</script>

</body>
</html>