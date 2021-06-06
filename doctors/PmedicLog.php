<?php 

session_start();
if(!isset($_SESSION['log'])){
    header("Location: ../index.php");
    exit();
}

		include("../config/db_con.php");

			$PtID = mysqli_real_escape_string($conn, $_POST['PID']);
			$PtName = mysqli_real_escape_string($conn, $_POST['PNAME']);
			$Ptage = 	mysqli_real_escape_string($conn, $_POST['AGE']);
			$DateVisit = mysqli_real_escape_string($conn, $_POST['Visit']);
			$Dname = mysqli_real_escape_string($conn, $_POST['DocName']);
			$Dcharge = mysqli_real_escape_string($conn, $_POST['DocCHG']);
			$ptSymp = mysqli_real_escape_string($conn, $_POST['Symptom']);
			$ptDrugs = 	mysqli_real_escape_string($conn, $_POST['Drugs']);
			$date = mysqli_real_escape_string($conn, $_POST['DateNow']);
            $time = mysqli_real_escape_string($conn, $_POST['TimeNow']);
            $docID = mysqli_real_escape_string($conn,$_SESSION['id']);

			$sql = "INSERT INTO mediclog(PID,Pname,PAge,AppDate,DocName,DocFee,PtSymptom,Drugs,DateNow,TimeNow,DocID) VALUES('$PtID','$PtName','$Ptage','$DateVisit','$Dname','$Dcharge','$ptSymp','$ptDrugs','$date','$time','$docID')";
			if(mysqli_query($conn, $sql)){
				
				echo "Patient Detials Successfully Added!";

			}else{
				echo "query error" . mysqli_error($conn);
			}

			$sql2 = "DELETE  FROM gen_todaypatient WHERE PID = '$PtID' ";

			if(mysqli_query($conn,$sql2)){
				echo "success";
			}
	
 ?>