<?php

session_start();
$usrid = $_SESSION['id'];

    if(isset($_POST['confirmpassword'])){
        include("../config/db_con.php");

 
        $cmpsw = mysqli_real_escape_string($conn,$_POST['confirmpassword']);

        $sql = "UPDATE doctor SET PSW = '$cmpsw' WHERE dctID = '$usrid'";

				if(mysqli_query($conn, $sql)){
					echo "success";
				}else{
					echo "query error" . mysqli_error($conn);
				}
    }
?>