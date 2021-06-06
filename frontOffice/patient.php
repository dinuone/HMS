
<?php 

	
		include("../config/db_con.php");

			$pname = mysqli_real_escape_string($conn, $_POST['patientname']);
			$adres = mysqli_real_escape_string($conn, $_POST['address']);
			$age = 	mysqli_real_escape_string($conn, $_POST['Age']);
			$cont = mysqli_real_escape_string($conn, $_POST['Contact']);
			$dspec = mysqli_real_escape_string($conn, $_POST['DSpec']);
			$dname = mysqli_real_escape_string($conn, $_POST['DName']);
			$dfee = mysqli_real_escape_string($conn, $_POST['DFee']);
			$amt = 	mysqli_real_escape_string($conn, $_POST['Amount']);
			$time = mysqli_real_escape_string($conn, $_POST['Ntime']);
			$date = mysqli_real_escape_string($conn, $_POST['Ndate']);

			$sql = "INSERT INTO patients(Pname,Address,Contact,Age,DocName,DocSpec,DateNow,TimeNow,docFee,payamount) VALUES('$pname','$adres','$cont','$age','$dname','$dspec','$date','$time','$dfee','$amt')";
			if(mysqli_query($conn, $sql)){
				
				
				echo "success";

			}else{
				echo "query error" . mysqli_error($conn);
			}

			$sql2 = "INSERT INTO gen_todaypatient(Pname,Age,DocName,DocSpec,DateNow,TimeNow,docFee) VALUES('$pname','$age','$dname','$dspec','$date','$time','$dfee')";
			if(mysqli_query($conn,$sql2)){
					echo "success";
			}else{
				echo "query error" . mysqli_error($conn);
			}

 ?>