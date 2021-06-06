<?php 
include('include/header.php');
include('config/db_con.php');
	
	$usrname = $password = '';
	$errors = array('msg' => '', 'msg1'=>'');

	if(isset($_POST['submit'])){

			$usrname = $_POST['uname'];
			$password = $_POST['psw'];

		if(empty($_POST['uname']) || empty($_POST['psw'])){
			$errors['msg'] = "*Username & Password must be required <br/>";
		}else{
			$sql = "SELECT dctID,usrName,PSW,doctorName FROM doctor WHERE usrName = '$usrname'";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);

			if($usrname == $row['usrName'] && $password == $row['PSW']){
				session_start();
				$_SESSION['log'] = true;
				$_SESSION['username'] = $row['usrName'];
				$_SESSION['id'] = $row['dctID'];
				$_SESSION['name'] = $row['doctorName'];

				header('Location: doctors/DCTdash.php');
			}else{

				$errors['msg1'] ="Invalid Username or Password <br/>";
			}

			mysqli_close($conn);
		}
	}
 ?>

 <!DOCTYPE html>
 <html>
 <body>
 
<style type="text/css"> 

	#log{ width: 800px;}
	#head1{ padding-top: 20px; padding-left: 20px; color: grey; }
	#btnlg{background-color:#3949ab; }
	.red-text{padding-left: 20px;}
</style>


 <div class="container" id="log">
 	<div class="col s6">
 		<div class="card">
 			<h1 id="head1">Doctors Login</h1>
 			<div class="red-text"><?php echo $errors['msg1']; ?></div>
 			<div class="red-text"><?php echo $errors['msg']; ?></div>
 			<div class="card-content">
 				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
 					<div class="input-field col m6">
 						<i class="material-icons prefix">account_box</i>
 						<input type="text" name="uname" id="icon_prefix">
 						<label for="icon_prefix">Username</label>
 					</div>

 					<div class="input-field col m6">
 						<i class="material-icons prefix">lock</i>
 						<input type="Password" name="psw" id="icon_psw">
 						<label for="icon_psw">Password</label>
 					</div>

 					 <button class="btn waves-effect waves-light" type="submit" name="submit" id="btnlg">Login
    					<i class="material-icons right">login</i>
  					 </button>
 				</form>			
 			</div>
 		</div>
 	</div>
</div>
 </body>
 </html>