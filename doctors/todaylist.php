<?php

session_start();
if(!isset($_SESSION['log'])){
    header("Location: ../index.php");
    exit();
}
include("../config/db_con.php");

date_default_timezone_set("Asia/colombo");

 $today = date("Y/m/d");

    $usrid = $_SESSION['id'];
    $name = $_SESSION['name'];
 
    $sql = "SELECT Pname,Age,PID,TimeNow,DateNow,docFee FROM patients WHERE DocName = '$name' AND DateNow = '$today' ";

    $data = mysqli_query($conn, $sql);

    $result = mysqli_fetch_all($data,MYSQLI_ASSOC);
    
    $daymsg="";
    if(mysqli_num_rows($data)==0){
        $daymsg = "Still You Dont Have Any Patient";
    }
    
?>


<!DOCTYPE html>
<html>

<body>
<?php include('sidebar/side.html') ?>
    <style>
        .container{padding-top:30px;}
        .navigation{background-color: #16a30f;}
	    .navigation ul li:hover{background: #32de16;}
        .display-4{color:  #303f9f;}
		#cont{padding-top: 40px;  }

		#icon{color: red; float: right;}
		#icon:hover{color:#c71414;}
		.red-text{color: red; font-size: 13px;}
		#cont{visibility: hidden;}
		#cont.active{visibility: visible;}
        #msg{text-align:center; color:red;}
    </style>

    <div class="container">
        <div class="card">
            <div class="card-header"><div class="display-4">Today Patients List</div></div>
            <div class="card-body">
                <table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Patient ID</th>
								<th scope="col">Patient Name</th>
                                <th scope="col">Age</th>
                                <th scope="col">Time</th>
                                <th scope="col">Date Visit</th>
                                <th scope="col">Consultancy Fee</th>
								<th scope="col"></th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($result as $results) { ?>
							<tr>
								<td><?php echo htmlspecialchars($results['PID']); ?></td>
								<td><?php echo htmlspecialchars($results['Pname']); ?></td>
                                <td><?php echo htmlspecialchars($results['Age']); ?></td>
                                <td><?php echo htmlspecialchars($results['TimeNow']);?></td>
                                <td><?php echo htmlspecialchars($results['DateNow']);?></td>
                                <td><?php echo htmlspecialchars($results['docFee']);?></td>
                                <td><button class="btn btn-primary btn-sm" id="btnget">Add Log</button></td>
							</tr>
						<?php } ?>
						</tbody>
                </table>
                <h5 id="msg"><?php echo $daymsg; ?></h5>
            </div>
        </div>
    </div>


    <div class="container" id="cont">
		<div class="card">
			<div class="card-header"><div class="display-4">Add to Medical Log<i class="fa fa-window-close" id="icon"></i></div></div>
			<div class="card-body">
                    <div class="row">
						<div class="form-group col">
							<label>Patient ID</label>
							<input type="text"  class="form-control" readonly  value="" id="pID">
						</div>
						<div class="form-group col">
							<label>Patient Name</label>
							<input type="text"  class="form-control" readonly  value="" id="pName">
						</div>
					</div>
					<div class="row">
                        <div class="form-group col">
							<label>Age</label>
							<input type="text"  class="form-control" readonly  value="" id="ptAge">
						</div>
						<div class="form-group col">
							<label>Date Visit</label>
							<input type="text"  class="form-control" readonly id="Datevisit" value="">
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label>Doctor Name</label>
							<input type="text" class="form-control" readonly  value="<?php echo $_SESSION['name'] ?>" id="dcname">
                        </div>
                        <div class="form-group col">
							<label>Consultancy Fee</label>
							<input type="text" class="form-control" readonly  value="" id="dfee">
						</div>
					</div>
					<div class="form-group">
						<label> Patient's Symptom</label>
						<textarea class="form-control" id="symptom" value=""></textarea>
					</div>
					<div class="form-group">
						<label> Prescription drugs</label>
						<textarea class="form-control" id="drugs" value=""></textarea>
					</div>
					<div class="row">
						<div class="form-group col">
							<label>Date</label>
							<input type="text" id="datenow" class="form-control" readonly value="<?php echo date("Y/m/d") ?>">
						</div>
						<div class="form-group col">
							<label>Time</label>
							<input type="text" id="timenow" class="form-control" readonly value=" <?php echo date("h:i:a") ?>">
						</div>
					</div>

					<div class="form-group">
						<button type="button"  class="btn btn-primary" id="btnsave">Add to Medical Log</button>	
					</div>
			</div>
		</div>
    </div>
    
    <script>
        $('.table tbody').on('click','#btnget', function(){
			var curntrow = $(this).closest('tr');
			var col1 = curntrow.find('td:eq(0)').text();
			var col2 = curntrow.find('td:eq(1)').text();
			var col3 = curntrow.find('td:eq(2)').text();
			var col5 = curntrow.find('td:eq(4)').text();
            var col6 = curntrow.find('td:eq(5)').text();
			

			$("#cont").addClass("active");
			
			$("#pID").val(col1);
			$("#pName").val(col2);
			$("#ptAge").val(col3);
			$("#Datevisit").val(col5);
            $("#dfee").val(col6);
			
		});


		$('#icon').on('click', function(){
			$('#cont').removeClass("active");
		});



        $('#btnsave').on('click',function(){
            
            var pid = $('#pID').val();
            var pname = $('#pName').val();
            var age = $('#ptAge').val();
            var visitDate = $('#Datevisit').val();
            var docname = $('#dcname').val();
            var dchg = $('#dfee').val();
            var patientSymptom = $('#symptom').val();
            var patientDrugs = $('#drugs').val();
            var DateNw = $('#datenow').val();
            var TimeNw = $('#timenow').val();

            if(patientSymptom!='' && patientDrugs!='' ){

                $.post('PmedicLog.php' ,
                {
                    PID : pid,
                    PNAME : pname,
                    AGE : age,
                    Visit : visitDate,
                    DocName : docname,
                    DocCHG : dchg,
                    Symptom : patientSymptom,
                    Drugs :  patientDrugs,
                    DateNow : DateNw,
                    TimeNow : TimeNw
                
                }, 
                
                function(data){
                    swal({
							  title: "Success!",
							  text: "Patient Details Successfully Add to Medical Log!",
							  icon: "success",
							  button: "ok",
						}).then(function(){
					                window.location="http://localhost:7882/Hossys/doctors/todaylist.php";
				        });

						

                });

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