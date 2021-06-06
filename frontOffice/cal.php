<?php 

	if(isset($_POST['hostcharge']) && isset($_POST['srvcharge']) && isset($_POST['doccharge'])){

		$hoscharge = $_POST['hostcharge'];
		$serivcechg = $_POST['srvcharge'];
		$doccharge = $_POST['doccharge'];

		$total = $hoscharge + $serivcechg + $doccharge;
		echo $total;
	}

	else{

		echo "error";
	}

 ?>