<?php 
	
	session_start();
	if(!isset($_SESSION['log'])){
		header("Location: ../index.php");
		exit();
	}

	$usrid = $_SESSION['id'];

	include("../config/db_con.php");

	$sql2 = "SELECT doctorName, Address, Gender, PSW, usrName,docSpec,docFees,contact FROM doctor WHERE dctID = '$usrid'";

	$data2 = mysqli_query($conn, $sql2);

	$result = mysqli_fetch_array($data2, MYSQLI_ASSOC);


	if(isset($_POST['submit'])){

		$fulname = $_POST['fullname'];
		$cont = $_POST['contact'];
		$adrs = $_POST['address'];
		$gender = $_POST['gender'];
		$username = $_POST['usrname'];
		
		

		$sql = "UPDATE doctor SET  doctorName = '$fulname', Address = '$adrs', contact = '$cont', Gender = '$gender', usrName = '$username' WHERE dctID = '$usrid' ";

		if(mysqli_query($conn, $sql)){
				header("Location: Myprofile.php");

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

	.navigation{background-color: #16a30f;}
	.navigation ul li:hover{background: #32de16;}
</style>


	<div class="container pt-3">
		<div class="card">
			<div class="card-header"><div class="display-4">My Profile Details</div></div>
			<div class="card-body">
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
					<div class="form-group">
						<label for="name">Full Name</label>
						<input type="text" name="fullname" value="<?php echo htmlspecialchars($result['doctorName']) ?>" class="form-control">
					</div>
					<div class="form-group">
						<label for="name">contact</label>
						<input type="text" name="contact" value="<?php echo htmlspecialchars($result['contact']) ?>" class="form-control">
					</div>
					<div class="form-group">
						<label for="name">Address</label>
						<input type="text" name="address" value="<?php echo htmlspecialchars($result['Address']) ?>" class="form-control">
					</div>
					<div class="form-group">
						<label for="gen">Gender</label>
						<input type="text" name="gender" value="<?php echo htmlspecialchars($result['Gender']) ?>" class="form-control" readonly>
					</div>
					<div class="row">
						<div class="form-group col">
							<label for="docspec">Specialization</label>
							<input type="text" name="docspec" value="<?php echo htmlspecialchars($result['docSpec']) ?>" class="form-control" readonly>
						</div>
						<div class="form-group col">
							<label for="docfee">Counsultancy Fee</label>
							<input type="text" name="docfeec" value="<?php echo htmlspecialchars($result['docFees']) ?>" class="form-control" readonly>
						</div>
						
					</div>
					<div class="row">
						<div class="form-group col">
							<label for="City">Username</label>
							<input type="text" name="usrname" value="<?php echo htmlspecialchars($result['usrName']) ?>" class="form-control">
						</div>
						<div class="form-group col">
							<label for="gen">Currrent Password</label>
							<input type="text" name="paswd" value="<?php echo htmlspecialchars($result['PSW']) ?>" class="form-control" id="pswrd" readonly>
						</div>
					</div>

					<div class="form-group">
						<button class="btn btn-primary" type="submit" name="submit">Save Changes</button>		
					</div>
				</form>
				<div class="form-group">
				<button class="btn btn-success"  id="chngpsw">Change Password</button>
			</div>
			</div>
			
		</div>
	</div>

	<div class="container pt-4" id="cont">
		<div class="card">
			<div class="card-header"><div class="display-4">Change Password<i class="fa fa-window-close" id="icon"></i></div></div>
			<div class="card-body">
					<div class="form-group">
						<label for="newp">New Password</label>
						<input type="text"  class="form-control" id="newpsw" value="">
					</div>
					<div class="form-group">
						<label for="newp">Confirm Password</label>
						<input type="text"  class="form-control" id="conpsw" value="">
					</div>
					<div class="form-group">
						<button class="btn btn-primary" type="button" id="btnsave">Save Changes</button>
					</div>
			</div>
		</div>
	</div>
<script>
	$('#chngpsw').on('click', function(){
			$('#cont').addClass("active");
		});

	$('#icon').on('click', function(){
			$('#cont').removeClass("active");
		});

	$('#btnsave').on('click',function(){
			var newpass = $('#newpsw').val();
			var confirmpass = $('#conpsw').val();

			if(newpass == '' || confirmpass ==''){
				swal({
				  title: "Error!",
				  text: "All Fields Are Reqiured!",
				  icon: "error",
				  button: "ok",
				})
			}else{

				if((newpass.length < 5) || (newpass.length > 8 )){
					swal({
					title: "Error!",
					text: "password must be 5-8 Charactors!",
					icon: "error",
					button: "ok",
					})
				}else{

					if($('#newpsw').val()==$('#conpsw').val()){
						
						$.post('changepsw.php', {

							confirmpassword : confirmpass
						},
						
						function(data){
							swal({
							  title: "Success!",
							  text: "Your Password Change Successfully!",
							  icon: "success",
							  button: "ok",
							}).then(function(){
								window.location="http://localhost:7882/Hossys/doctors/Myprofile.php";
							})
						});
					}else{
						swal({
							title: "Error!",
							text: "Confirm password Not Match!",
							icon: "error",
							button: "ok",
						})
					}
				}
			}

			
	});


</script>

</body>
</html>