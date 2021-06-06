<?php 
	session_start();
	if(!isset($_SESSION['logR'])){
		header("Location: ../index.php");
		exit();
    }

    include("../config/db_con.php");
    
    date_default_timezone_set("Asia/colombo");
     $today = date("Y/m/d");


	$usrid = $_SESSION['id'];

	$sql = "SELECT * FROM patients WHERE DateNow = '$today'";

	$data = mysqli_query($conn, $sql);

    $result = mysqli_fetch_all($data,MYSQLI_ASSOC);
    

    //count for today ptient list
	$result3 = mysqli_query($conn,"SELECT COUNT(*) AS `count3` FROM `patients` WHERE  DateNow = '$today'");
	$row3 = mysqli_fetch_assoc($result3);
    $count3 = $row3['count3'];
	
	
	$daymsg="";
    if(mysqli_num_rows($data)==0){
        $daymsg = "Still Patients didn't visit to hospital";
    }
    
?>


<!DOCTYPE html>
<html>
<body>

<?php include('sidebar/side.html') ?>

    <style>
    	.navigation{background-color: #7a0bb5;}
		.navigation ul li:hover{background: #ad4beb;}
    	.card{width: 80%; margin-left: 200px; }
		.display-4{color:  #303f9f;}
		.box{padding-top: 30px;}
        #msg{text-align:center; color:red;}
    </style>

<div class="box">
		<div class="card">
			<div class="card-header"><div class="display-4">Today Patient List</div></div>
			<div class="card-body">
                <h5>Total Records Count : <span class="badge badge-pill badge-danger"><?php echo $count3?></span></h5>
               
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Patient ID</th>
								<th scope="col">Patient Name</th>
								<th scope="col">Age</th>
								<th scope="col">Doctor Name</th>
								<th scope="col">Doctor Specailization</th>
								<th scope="col">Date visit</th>
								<th scope="col">Time</th>
								<th scope="col">PayAmount</th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($result as $results) { ?>
							<tr>
								<td><?php echo htmlspecialchars($results['PID']); ?></td>
								<td><?php echo htmlspecialchars($results['Pname']); ?></td>
								<td><?php echo htmlspecialchars($results['Age']); ?></td>
								<td><?php echo htmlspecialchars($results['DocName']); ?></td>
								<td><?php echo htmlspecialchars($results['DocSpec']); ?></td>
								<td><?php echo htmlspecialchars($results['DateNow']); ?></td>
								<td><?php echo htmlspecialchars($results['TimeNow']); ?></td>
								<td><?php echo htmlspecialchars($results['payamount']); ?></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
					<h5 id="msg"><?php echo $daymsg; ?></h5>
			</div>
		</div>
    </div>
    
  
</body>
</html>