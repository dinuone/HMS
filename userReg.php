<?php 
include('include/header.php');
include('config/db_con.php');

 $fullname = $address = $city = $gender = $email = $password = $repassword = $usrname = '';
 $errors = array('fulname' => '', 'addres' => '','City' => '', 'gender' => '','email' => '','paswrd' => '','paswre'=>'',    'username'=>'');

	if(isset($_POST['submit'])){

		if(empty($_POST['fname'])){
			$errors['fulname'] = "*Name is required <br/>";

		}else{
			$fullname = $_POST['fname'];
			if(!preg_match('/^[a-zA-Z\s]*$/', $fullname)){
				$errors['fulname'] = "Name must be letters and spaces only <br/>";
			}
		}


		if(empty($_POST['adrs'])){
			$errors['addres'] = "*Addres is required <br/>";
		}else{

			$address = $_POST['adrs'];
		}


		if(empty($_POST['city'])){
			$errors['City'] = "*City is required <br/>";
		}else{

			$city = $_POST['city'];
			if(!preg_match('/^[a-zA-Z\s]*$/', $city)){
				$errors['City'] = "City must be letters and spaces only <br/>";
			}
		}


		if(empty($_POST['myradio'])){
			$errors['gender'] = "*Gender is required <br/>";
		}else{

			$gender = $_POST['myradio'];

			}


		if(empty($_POST['email'])){
			$errors['email'] = "*E-mail is required <br/>";
		}else{

			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = "E-mail must be valid email address only <br/>";
			}
		}


		if(empty($_POST['psw'])){
			$errors['paswrd'] = "*password is required";
		}else{

			$password = $_POST['psw'];
			if(strlen($password) > 8 || strlen($password) < 5){
				$errors['paswrd'] = "password must 8 charactors or Less than to 5 <br/> ";
			}
		}


		if(empty($_POST['repsw'])){
			$errors['paswre'] = "*please confirm the password <br/>";
		}else{

			$repassword = $_POST['repsw'];
			if($password !== $repassword){

				$errors['paswre'] = "Your entered password is not match <br/>";
			}
		}

		if(empty($_POST['uname'])){
			$errors['username'] = "*username must be required <br/>";
		}else{
			$usrname = $_POST['uname'];
		}

		if(array_filter($errors)){
			//erroes in form
		}else{

			$fullname = mysqli_real_escape_string($conn, $_POST['fname']);
			$address = mysqli_real_escape_string($conn, $_POST['adrs']);
			$city = mysqli_real_escape_string($conn, $_POST['city']);
			$gender = mysqli_real_escape_string($conn, $_POST['myradio']);
			$email =  mysqli_real_escape_string($conn, $_POST['email']);
			$usrname = mysqli_real_escape_string($conn, $_POST['uname']);
			$password = mysqli_real_escape_string($conn, $_POST['psw']);

			$sql = "INSERT INTO users(FullName,Address,City,Gender,Email,PSW,username) VALUES('$fullname','$address','$city','$gender','$email','$password','$usrname')";

			if(mysqli_query($conn, $sql)){
				header('Location: user.php');

			}else{
				echo "query error" . mysqli_error($conn);
			}

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

	.red-text{padding-left: 40px; font-size: 14px;} }
</style>


 <div class="container" id="log">
 	<div class="col m6 s6">
 		<div class="card">
 			<h1 id="head1">User Sign-Up</h1>
 			<div class="card-content">
 				<form action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="POST">
 					<div class="input-field col m6 s6">
 						<i class="material-icons prefix">perm_contact_calendar</i>
 						<input type="text" name="fname" id="icon_prefix" value="<?php echo htmlspecialchars($fullname)?>">
 						<div class="red-text"><?php echo $errors['fulname']; ?></div>
 						<label for="icon_prefix">Full Name</label>

 					</div>

 					<div class="input-field col m6 s6">
 						<i class="material-icons prefix">home</i>
 						<input type="text" name="adrs" id="icon_addrs" value="<?php echo htmlspecialchars($address)?>">
 						<div class="red-text"><?php echo $errors['addres']; ?></div>
 						<label for="icon_addrs">Address</label>
 					</div>

 					<div class="input-field col m6 s6">
 						<i class="material-icons prefix">location_on</i>
 						<input type="text" name="city" id="icon_city" value="<?php echo htmlspecialchars($city)?>">
 						<div class="red-text"><?php echo $errors['City']; ?></div>
 						<label for="icon_city">city</label>
 					</div>

 					<div class="row m6 s6">
	 					 <p class="col m2">
						    <label>
						      <input class="with-gap" name="myradio" value="male"type="radio"/>
						      <span>Male</span>
						    </label>
						  </p>

						   <p class="col m2 s6">
						    <label>
						      <input class="with-gap" name="myradio" value="female"type="radio"/>
						      <span>Female</span>
						      <div class="red-text"><?php echo $errors['gender']; ?></div>
						    </label>
						  </p>
					</div>

					<div class="input-field col m6 s6">
 						<i class="material-icons prefix">email</i>
 						<input type="text" name="email" id="icon_email" value="<?php echo htmlspecialchars($email)?>">
 						<div class="red-text"><?php echo $errors['email']; ?></div>
 						<label for="icon_email">E-mail Address</label>
 					</div>

 					<div class="input-field col m6 s6">
 						<i class="material-icons prefix">assignment_ind</i>
 						<input type="text" name="uname" id="icon_uname" value="<?php echo htmlspecialchars($usrname)?>">
 						<div class="red-text"><?php echo $errors['username']; ?></div>
 						<label for="icon_uname">username</label>
 					</div>

 					<div class="input-field col m6 s6">
 						<i class="material-icons prefix">vpn_key</i>
 						<input type="text" name="psw" id="icon_psw" value="<?php echo htmlspecialchars($password)?>">
 						<div class="red-text"><?php echo $errors['paswrd']; ?></div>
 						<label for="icon_psw">Password</label>
 					</div>

 					<div class="input-field col m6 s6">
 						<i class="material-icons prefix">vpn_key</i>
 						<input type="text" name="repsw" id="icon_pswre" value="<?php echo htmlspecialchars($repassword)?>">
 						<div class="red-text"><?php echo $errors['paswre']; ?></div>
 						<label for="icon_pswre">Confirm password</label>
 					</div>


 					 <button class="btn waves-effect waves-light" type="submit" name="submit" id="btnlg">Register
    					<i class="material-icons right">login</i>
  					 </button>
  					 
 				</form>			
 			</div>
 		</div>
 	</div>
</div>
 </body>
 </html>