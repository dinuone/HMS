<?php
	include("../config/db_con.php");
    
    ?>


<!DOCTYPE html>
<html>

<body>
<?php include('sidebar/side.html') ?>
<style>
    .navigation{background-color: #C71585;}
	.navigation ul li:hover{background: #E6358B;}
    .box{margin-left:100px; margin-right:60px; padding-top:30px;}
    #rw2{padding-top:30px;}
    .icn{font-size:80px;text-align: center;margin-bottom:-30px; margin-top:-20px;}
    #icn1:hover{background:#22CC7E;border-radius:10px;}
    #icn2:hover{background:#F2C527;border-radius:10px;}
    #icn3:hover{background:#C9D0D9;border-radius:10px;}
    #icn4:hover{background:#05C7C3;border-radius:10px;}
    .display-3{color:#0A79DF;}
    #money{font-size:103px; text-align:center; margin-bottom:-30px;}
    #money:hover{color:#F2C527;}
   
</style>

    <div class="box">
        <div class="row">
            <div class="col">
                <div class="card" id="icn1">
                    <div class="card-header" id="hd1"><h3>Doctors</h3></div>
                    <div class="card-body" >
                    <a href="../admin/addDoctor.php">
                        <p class="icn"><i class="fas fa-briefcase-medical"></i></p>
                      
                    </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card"id="icn2">
                    <div class="card-header"><h3>Receptionist</h3></div>
                    <div class="card-body" >
                    <p class="icn" ><i class="fas fa-user-tie"></i></i></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card"  id="icn3">
                    <div class="card-header"><h3>Users</h3></div>
                    <div class="card-body">
                    <p class="icn" ><i class="fas fa-briefcase-medical"></i></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" id="icn4">
                    <div class="card-header"><h3>Patients List</h3></div>
                    <div class="card-body" >
                    <p class="icn" ><i class="fas fa-briefcase-medical"></i></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="rw2">
            <div class="col">
                <div class="card">
                    <div class="card-header"><h3>Today Income</h3></div>
                    <div class="card-body">
                        <div class="display-3 text-center">Rs.1500/=</div>
                        <button class="btn btn-primary"><i class="fas fa-eye"></i> <span>View</span></button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header"><h3>Reports</h3></div>
                    <div class="card-body">
                    <a href="../admin/reports.php">
                         <p id="money"><i class="far fa-chart-bar"></i></p>
                    </a>
                    </div>
                   
                </div>
            </div>
        </div>

        <div class="row" id="rw2">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                       <h2 align="center">Hospital Income Analyze</h2>
                       <div id="chart" style="height: 250px;">

                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Doctors Charge</div>
                        <div class="card-body"></div>
                    </div>
                </div>
        </div>

        
    </div>
    <script>
     new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'chart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    { year: '2008', value: 20 },
    { year: '2009', value: 10 },
    { year: '2010', value: 15 },
    { year: '2011', value: 7 },
    { year: '2012', value: 20 },
    { year: '2013', value:24},
    { year: '2014', value:24},
    { year: '2015', value:40},
    
 
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'year',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value'],
   hideHover:'auto'
  
});
    </script>
</body>
</html>



