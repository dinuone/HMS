<?php
session_start();
if(!isset($_SESSION['log'])){
    header("Location: ../index.php");
    exit();
}
include("../config/db_con.php");
$usrid = $_SESSION['id'];

$err = "";
if(isset($_POST['submit'])){

    if(empty($_POST['schDate']) || empty($_POST['schTime']) || empty($_POST['appcount']) || empty($_POST['HosCount'])){

        $err = "*Please Fill Blank Fileds";
    }else{


        $ScheduleDate = $_POST['schDate'];
        $ScheduleTime = $_POST['schTime'];
        $AppoinmentPtCount = $_POST['appcount'];
        $HosPtCount = $_POST['HosCount'];
        $DoctorName = $_POST['docName'];
        $TimeNow = $_POST['timenow'];	
        $DoctorID = $_SESSION['id'];
        


        $sql2 = "INSERT INTO schedule (DoctID,scheduleDate,scheduleTime,maxAppmnt,maxHos,DocName,TimeNow) VALUES('$DoctorID','$ScheduleDate','$ScheduleTime','$AppoinmentPtCount','$HosPtCount','$DoctorName','$TimeNow')";

        if(mysqli_query($conn, $sql2)){

                header("Location: schedule.php");

        }else{
            echo "error query".$sql2."".mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
    $limit = 5;
    
    $sql = "SELECT * FROM schedule WHERE DoctID = '$usrid' LIMIT $limit";
    $data = mysqli_query($conn, $sql);

    $result = mysqli_fetch_all($data,MYSQLI_ASSOC);
    
    
?>


<!DOCTYPE html>
<html>

	<?php include('sidebar/side.html') ?>

<style>
    .container{padding-top:30px;}
    .red-text{color: red; font-size: 14px;}
    .navigation{background-color: #16a30f;}
	.navigation ul li:hover{background: #32de16;}
</style>
<div class="container">
		<div class="card">
			<div class="card-header"><div class="display-4">Add Schedule</div></div>
			<div class="card-body">
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
					
				<div class="row">
                    <div class="form-group col">
                        <label>Select Schedule Date</label>
                        <div class="red-text"><?php echo $err ?></div>
                        <input type="date" class="form-control"  name="schDate" required>
                    </div> 
                    <div class="form-group col">
                        <label>Select Visit Time</label>
                        <div class="red-text"><?php echo $err ?></div>
                        <input type="time" class="form-control" name="schTime" />
                    </div>
                </div>
						
					
					<div class="row">
						<div class="form-group col">
							<label>Check Maximum Patients Appoinments</label>
                            <div class="red-text"><?php echo $err ?></div>
							<input type="text" name="appcount" class="form-control"  value="">
						</div>
						<div class="form-group col">
							<label>Doctor Name</label>
							<input type="text" name="docName" class="form-control" readonly  value="<?php echo $_SESSION['name'] ?>">
						</div>
					</div>
					<div class="row">
                    <div class="form-group col">
							<label>Check Maximum Patients in Hospital</label>
                            <div class="red-text"><?php echo $err ?></div>
							<input type="text" name="HosCount" class="form-control"  value="">
						</div>
						<div class="form-group col">
							<label>Time</label>
							<input type="text" name="timenow" class="form-control" readonly value=" <?php echo date("h:i:a") ?>">
						</div>
					</div>

					<div class="form-group">
						<button type="submit"  class="btn btn-primary" name="submit">
  							Add Schedule</button>	
					</div>
             </div>
            </form>
         </div>     
     </div>      
</div>

<div class="container">
        <div class="card">
            <div class="card-header"><div class="display-4">My Schedule List</div></div>
            <div class="card-body">
                <table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Schedule Date</th>
                                <th scope="col">Schedule Time</th>
                                <th scope="col">Max Appoinments</th>
                                <th scope="col">Max Patients</th>
                                <th scope="col">Created Time</th>
								<th scope="col"></th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($result as $results) { ?>
							<tr>
								<td><?php echo htmlspecialchars($results['id']); ?></td>
								<td><?php echo htmlspecialchars($results['scheduleDate']); ?></td>
                                <td><?php echo htmlspecialchars($results['scheduleTime']); ?></td>
                                <td><?php echo htmlspecialchars($results['maxAppmnt']);?></td>
                                <td><?php echo htmlspecialchars($results['maxHos']);?></td>
                                <td><?php echo htmlspecialchars($results['TimeNow']);?></td>
                                <td><button class="btn btn-danger btn-sm" id="btnget">Remove</button></td>
							</tr>
						<?php } ?>
						</tbody>
                </table>
                
            </div>
        </div>
    </div>

</html>