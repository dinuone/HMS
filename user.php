<?php 
include('include/header.php');
include('config/db_con.php');
	
	$usrname = $password = '';
	
	$err1 = "";
	$err2 = "";

	
	if(isset($_POST['submit'])){

			$usrname = $_POST['uname'];
			$password = $_POST['psw'];

		if(empty($_POST['uname']) || empty($_POST['psw'])){
			$err1 = "*Username & Password must be required <br/>";
		}else{
			$sql = "SELECT uID,username,PSW,FullName FROM users WHERE username = '$usrname'";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);

			if($usrname == $row['username'] && $password == $row['PSW']){
				session_start();
				$_SESSION['loggedin'] =true;
				$_SESSION['username'] = $row['username'];
				$_SESSION['id'] = $row['uID'];
				$_SESSION['name'] = $row['FullName'];

				header('Location: users/USRdash.php');
			}else{

				$err2 ="Invalid Username or Password <br/>";
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
 			<h1 id="head1">User Login</h1>
 			<div class="red-text"><?php echo $err1; ?></div>
 			<div class="red-text"><?php echo $err2 ?></div>
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
  					 <p id="para">Don't have Account <a href="userReg.php">Sign-up here</a></p>
 				</form>			
 			</div>
 		</div>
 	</div>
</div>
 </body>
 </html>