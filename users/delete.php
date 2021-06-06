<?php 
session_start();
	if(!isset($_SESSION['loggedin'])){
		header("Location: ../index.php");
		exit();
	}

	include("../config/db_con.php");

	$sql = "DELETE FROM appoinments WHERE id = '".$_GET['rowid']."'";

	if(mysqli_query($conn, $sql)){
		
		header("Location: myAppoinment.php");
	}else{
		echo "error deleting record". mysqli_error($conn);
	}

	mysqli_close($conn);


 ?>