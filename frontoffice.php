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
			$sql = "SELECT RID,username,PSW,FullName FROM frontoffice WHERE username = '$usrname'";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);

			if($usrname == $row['username'] && $password == $row['PSW']){
				session_start();
				$_SESSION['logR'] =true;
				$_SESSION['username'] = $row['username'];
				$_SESSION['id'] = $row['RID'];
				$_SESSION['name'] = $row['FullName'];

				header('Location: frontOffice/Dashboard.php');
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
	#para {padding-top: 20px;}
	.red-text{padding-left: 20px;}
</style>


 <div class="container" id="log">
 	<div class="col s6">
 		<div class="card">
 			<h1 id="head1">Receptionist Login</h1>
 			<div class="red-text"><?php echo $errors['msg1']; ?></div>
 			<div class="red-text"><?php echo $errors['msg']; ?></div>
 			<div class="card-content">
 				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
 					<div class="input-field col m6">
 						<i class="material-icons prefix">account_box</i>
 						<input type="text" name="uname" id="icon_prefix" >
 						<label for="icon_prefix">Username</label>
 					</div>

 					<div class="input-field col m6">
 						<i class="material-icons prefix">lock</i>
 						<input type="password" name="psw" id="icon_psw" >
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