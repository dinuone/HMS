<?php
include("../config/db_con.php");

$qry = "SELECT * FROM patients ORDER BY PID DESC";
$result = mysqli_query($conn,$qry);

	$result3 = mysqli_query($conn,"SELECT COUNT(*) AS `count3` FROM `patients`");
	$row3 = mysqli_fetch_assoc($result3);
	$count3 = $row3['count3'];

?>



<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
  <!-- databale plugin -->
  	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.css"/>
	<!-- datepicker  -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>
<body>

<?php include('sidebar/side.html') ?>

<style>
	.display-4{color: #303f9f;}
	#icon{color: red; float: right;}
	#icon:hover{color:#c71414;}
	#cont{visibility: hidden;}
	#cont.active{visibility: visible;}
	#filter{margin-left:10px;}
	.red-text{color: red; font-size: 13px;}
	.card{width:1300px; margin-left:-80px;}
	
	.navigation{background-color:  #C71585;}
	.navigation ul li:hover{background: #E6358B;}
</style>


	<div class="container pt-3">
		<div class="card">
			<div class="card-header"><div class="display-4">Patients Report</div></div>
			<div class="card-body">
			<div class="row">
						<div class="form-group col">
							<input type="text" id="start_date" value="" class="form-control" placeholder="Start Date">
						</div>
						<div class="form-group col">	
							<input type="text" id="end_date" value="" class="form-control" placeholder="End Date">
						</div>
						<div class="form-group col">
							<button value="" class="btn btn-success" id="filter">Generate</button>
							<button value="" class="btn btn-outline-danger" id="reset">Reset</button>
						</div>
						<div class="form-group col">
						<h5>Total Patients Count: <span class="badge badge-pill badge-danger"><?php echo $count3 ?></span></h5>
						</div>
					</div>
			</div>
		</div>
	</div>

	<div class="container pt-3">
		<div class="card shadow">
			
			<div class="card-body">
					<table class="table table-borderless table-hover" id="record">
						<thead class="thead-dark">
							<tr>
								<th width="5%" scope="col">ID</th>
								<th width="20%" scope="col">Name</th>
								<th width="10%" scope="col">Address</th>
								<th width="10%"scope="col">Contact</th>
								<th width="5%"scope="col">Age</th>
								<th width="20%" scope="col">Doctor Name</th>
								<th width="20%" scope="col">Doctor Special</th>
								<th width="10%" scope="col">Date</th>
							</tr>
						</thead>
					</table>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Datatables -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.js"></script>
    <!-- Momentjs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

	<!-- datepicker -->
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>	



<script>
  $( function() {
    $( "#start_date" ).datepicker({"dateFormat" : "yy-mm-dd"});
	$( "#end_date" ).datepicker({"dateFormat" : "yy-mm-dd"});
  } );
  </script>

  <script>
	//fetch records

	function fetch(start_date,end_date){
		$.ajax({ 
			url: "records.php",
			type: "POST",
			data: {
				start_date: start_date,
				end_date: end_date 
			},
			dataType:"json",
			success: function(data){
				//datatables 
				var i = "1";

				$('#record').DataTable( {
				"data" : data,
				
				//buttons
				dom: 'Bfrtip',
       			buttons: [  'copy', 'csv', 'excel', 'pdf', 'print'],
				
				"responsive":true,

        		"columns": [
          		
				    { "data": "PID" },
           		
				    { "data": "Pname" },
           	
			   		{ "data": "Address" },
            
					{ "data": "Contact" },

					{ "data": "Age" },
            
					{ "data": "DocName" },
            
					{ "data": "DocSpec" },

					{ "data": "DateNow"}
        ]
    } );
			}
		});
	}
	fetch();

	//filter
	$(document).on("click","#filter", function(e) {
		e.preventDefault();

		var start_date = $("#start_date").val();
		var end_date = $("#end_date").val();

		if(start_date == "" || end_date == "" )
		{
			alert("Select Both Date");
		}else{
			$('#record').DataTable().destroy();
			fetch(start_date,end_date);
		}
	});

	//reset 

	$(document).on("click", "#reset", function(e){
		e.preventDefault();

		$("#start_date").val('');
		$("#end_date").val('');
		 
		$('#record').DataTable().destroy();
		fetch();
	})
  </script>
</body>

</html>