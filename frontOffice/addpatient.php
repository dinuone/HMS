<?php 

	session_start();
	if(!isset($_SESSION['logR'])){
		header("Location: ../index.php");
		exit();
	}
	
	$usrid = $_SESSION['id'];

	include("../config/db_con.php");
	

	date_default_timezone_set("Asia/colombo");


 ?>


 <!DOCTYPE html>
 <html>
 <body>

 	<?php include('sidebar/side.html') ?>

 	<style>
 		.navigation{background-color: #7a0bb5;}
		.navigation ul li:hover{background: #ad4beb;}
		.crd{padding-top: 30px;}
		#btnpay{margin-top: 30px;}
		.red-text{color: red; font-size: 14px;}
		#btncal{margin-top: 30px;}
 	</style>

 	<div class="container pt-3">
 		<form>
	 		<div class="card">
	 			<div class="card-header"><h6>Patient Details</h5></div>
	 			<div class="card-body">
	 				<div class="row">
		 				<div class="form-group col">
		 					<label>Patient Name</label>
		 					<input type="text" id="pname" class="form-control" value="">
		 				</div>
		 				<div class="form-group col">
		 					<label>Address</label>
		 					<input type="text" id="address" class="form-control" value="">
		 				</div>
		 			</div>

		 			<div class="row">
		 				<div class="form-group col">
		 					<label>Contact</label>
		 					<input type="text" id="contact" class="form-control" value="">
		 				</div>
		 				<div class="form-group col">
		 					<label>Age</label>
		 					<input type="text" id="age" class="form-control" value="">
		 				</div>
		 			</div>
	 			</div>
	 		</div>
	 		<div class="crd">
		 		<div class="card">
		 			<div class="card-header"><h6>Doctor Details</h6></div>
		 			<div class="card-body">
		 				<div class="form-group col">
			 				<label>Doctor Specialization</label>
			 				<select name="docspecial" class="form-control" id="dspec">			 					
			 					<option value="">Select Specialization</option>

			 					<?php $rst = mysqli_query($conn,"SELECT * FROM doctor"); 
			 						 while ($row = mysqli_fetch_array($rst)) { ?>
			 							<option value="<?php echo $row['docSpec']; ?>">
			 								<?php echo $row['docSpec']; ?>
			 							</option>
			 					<?php } ?>
			 				</select>
			 			</div>
			 			<div class="form-group col">
			 				<label>Doctor Name</label>
			 				<select name="docname" class="form-control" id="Dname">
			 					<option value="">Select Doctor Name</option>

			 					<?php $rst2 = mysqli_query($conn,"SELECT * FROM doctor"); 
			 						 while ($row2 = mysqli_fetch_array($rst2)) { ?>
			 							<option value="<?php echo ($row2['doctorName']); ?>">
			 								<?php echo ($row2['doctorName']); ?>
			 							</option>
			 					<?php } ?>
			 				</select>
			 			</div>
			 			<div class="form-group col">
			 				<label>Consultancy Fees</label>
			 					<input type="text" class="form-control" value="" readonly id="docfee">
			 			</div>
			 			<div class="form-group col">
			 				<button class="btn btn-primary" id="btncheck" type="button">Check</button>
			 			</div>
		 			</div>
		 		</div>
		 	</div>

		 	<div class="crd">
		 		<div class="card">
		 			<div class="card-header"><h6>Channeling Details</h6></div>
		 			<div class="card-body">
		 				
			 			<div class="form-group col">
			 				<label>Hospital Charge</label>
			 				<input type="text" name="hoschg" class="form-control" value="500" readonly id="hchg">
			 			</div>
			 			<div class="form-group col">
			 				<label>Service Charge</label>
			 				<input type="text" name="svchg" class="form-control" value="200" readonly id="schg">
			 			</div>
			 			<div class="row col">
			 				<div class="form-group col-md-3 ">
			 					<label>Time</label>
			 					<input type="text" value="<?php echo date("h:i:a") ?>" class="form-control" id="nowtime" readonly>
			 				</div>
			 				<div class="form-group col-md-3">
			 					<label>Date</label>
			 					<input type="text" value="<?php echo date("Y/m/d") ?>" class="form-control" id="nowdate" readonly>
			 				</div>
			 				<div class="form-group col-md-3">
			 					<button class="btn btn-warning" id="btncal" type="button">Calculate Total</button>
			 				</div>
						</div>
			 			

		 			</div>

		 			<div class="card-body">
		 				<div class="row">
			 				<div class="form-group col">
			 					<h5>Sub Total</h5><input type="text" name="payAmount" value="" class="form-control" id="amount">
			 				</div>
			 				<div class="form-group col">
			 					<button class="btn btn-success btn-block" type="button" id="btnpay">Pay & Add patient</button>
			 				</div>
						</div>
		 			</div>
		 		</div>
		 	</div>

 		</form>
 	</div>
 
<script>
	$('#btncheck').on('click',function(){
		var docname = $('#Dname').val();
		var docspec = $('#dspec').val();
		if(docname != '' || docspec != ''){
			$.post('docfee.php',{postdata : docname, postdata2 : docspec}, function(data){
				$('#docfee').val(data);
			});
		}else{ 
			swal({
				  title: "Error!",
				  text: "Please Select Values!",
				  icon: "error",
				  button: "ok",
				})
		}
	});

	$('#btncal').on('click',function(){
		var hoschg = $('#hchg').val();
		var svchg = $('#schg').val();
		var doctorfee = $('#docfee').val();

		if(doctorfee != ''){

			$.post('cal.php', {hostcharge : hoschg, srvcharge : svchg, doccharge : doctorfee}, function(data){
				$('#amount').val(data);
			});
		}else{
			swal({
				  title: "Error!",
				  text: "Please check Doctor Fees!",
				  icon: "error",
				  button: "ok",
				})
		}
			
	});


	$('#btnpay').on('click', function(){
		var ptname = $('#pname').val();
		var adrss = $('#address').val();
		var age = $('#age').val();
		var cont = $('#contact').val();
		var doctorspec = $('#dspec').val();
		var doctorname = $('#Dname').val();
		var doctorfee = $('#docfee').val();
		var amount = $('#amount').val();
		var time = $('#nowtime').val();
		var date = $('#nowdate').val();

		if(ptname != '' && adrss !='' && age !='' && cont !='' && amount !=''){
			$.post('patient.php', 
					{	patientname : ptname, 
						address : adrss,
						Age : age,
						Contact : cont,
						DSpec : doctorspec,
						DName : doctorname,
						DFee : doctorfee,
						Amount : amount,
						Ntime : time,
						Ndate : date
					},

					function(data){
						swal({
							  title: "Success!",
							  text: "Patient Details Added Successfully!",
							  icon: "success",
							  button: "ok",
							}).then(function(){
					window.location="http://localhost:7882/Hossys/frontOffice/addpatient.php";
				});
					})
			}else{
				swal({
				  title: "Error!",
				  text: "Please Check All Fields Are Required!",
				  icon: "error",
				  button: "ok",
				})
			}
		
	});

</script>

 </body>
 </html>