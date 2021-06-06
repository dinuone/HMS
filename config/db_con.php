<?php 

	$serverName = "localhost";
	$dbusername = "root";
	$dbPassword ="";
	$dbName = "hostpital_system";

    $conn =mysqli_connect($serverName,$dbusername,$dbPassword,$dbName); //conect database

    //check the connection
	if (!$conn) {
		echo "Conenction error: ".mysqli_connect_error();
	}
 ?>
