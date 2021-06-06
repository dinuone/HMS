<?php 
	
	if(isset($_POST['postdata']) && isset($_POST['postdata2'])){
		include("../config/db_con.php");

		$docName = $_POST['postdata'];
		$docspec = $_POST['postdata2'];
		$sql = "SELECT docFees FROM doctor WHERE doctorName = '$docName' AND docSpec = '$docspec'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		
		if(mysqli_num_rows($result)>0){
			echo $row['docFees'];
		}else{
		
			echo "Doctor name & Specialization not match";
		}
		
			
		
	}else{

		echo "error";
	}
 ?>