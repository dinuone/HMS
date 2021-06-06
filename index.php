<!DOCTYPE html>
<html>
<head>
	<title>HMS</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
     
     <link rel="stylesheet" type="text/css" href="css/style.css">
</head>	

<style type="text/css">

#btn1{
	
	background-color: #0288d1;
}

#btn2{
	background-color: #7cb342;
}

#btn3 {
	background-color: #ad1457;
}

#btn4{background-color:#7a0bb5; }

#crd2{text-align: center;}
</style>

<body>

<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">Hospital Management System</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="index.php">Home</a></li>
        <li><a href="">About Us</a></li>
        <li><a href="">Contact Us</a></li>
      </ul>
    </div>
  </nav>
</div>

  <div class="container">
  	<div class="card">
  		<div class="card-image">
  			<img src="img/staff01.jpg">
  		</div>
  	</div>
  </div>

  <div class="container">
  	<div class="row">
	  	<div class="col  s4 m4">
	  		<div class="card" id="crd">
	  			<div class="card-title" id="crd1"><h5>Patients login</h5></div>
	  			 <i class="material-icons medium">account_box</i>
	  			 <div class="card-action">
	  			 	<a class="waves-effect waves-light btn" id="btn1" href="user.php">Click Here</a>
	  			 </div>
	  		</div>
	  	</div>

	  	<div class="col s4 m4">
	  		<div class="card" id="crd">
	  			<div class="card-title" id="crd1"><h5>Doctors login</h5></div>
	  			 <i class="material-icons medium">medical_services</i>
	  			  <div class="card-action">
	  			 	<a class="waves-effect waves-light btn" id="btn2" href="doctor.php">Click here</a>
	  			 </div>
	  		</div>
	  	</div>

	  	<div class="col s4 m4">
	  		<div class="card" id="crd">
	  			<div class="card-title" id="crd1"><h5>Front Office Login</h5></div>
	  			 <i class="material-icons medium">supervised_user_circle</i>
	  			  <div class="card-action">
	  			 	<a class="waves-effect waves-light btn" id="btn4" href="frontoffice.php">Click Here</a>
	  			 </div>
	  		</div>
	  	</div>
	 </div>
	 <div class="row">
	 	<div class="col s12 m12">
	 		<div class="card" id="crd2">
	 			<div class="card-title" ><h5>Admin Login</h5></div>
	  			 <i class="material-icons medium">admin_panel_settings</i>
	  			  <div class="card-action">
	  			 	<a class="waves-effect waves-light btn" id="btn3" href="admin.php">Click Here</a>
	  			 </div>
	 		</div>
	 	</div>
	 </div>
  </div>

</html>