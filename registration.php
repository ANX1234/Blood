<?php

$dbhost="localhost";
		$dbuser="root";
		$dbpass="";
		$dbname="bdmsdb";

		$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

		if(mysqli_connect_errno())
		{
			die("Database Connection Failed ");
		}

$fnameErr = $lnameErr = $dobErr = $dodErr = $emailErr = $numberErr = $passErr = $fname = $lname = $dob = $dod =$address = $email = $phone = $username = $password = $cpassword = "";

if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
	if($_POST["fname"]) {
		$fname =$_POST["fname"] ;
	}
	if($_POST["lname"]) {
		$lname =  $_POST["lname"] ;
	}
	if($_POST["address"]) {
		$address = $_POST["address"] ;
	}
	if($_POST["dob"]) {
		$dob = $_POST["dob"] ;
	}
	if($_POST["dod"]) {
		$dod = $_POST["dod"];
	}
	if($_POST["email"]) {
		$email =  $_POST["email"];
	}
	if($_POST["phone"]) {
		$phone =  $_POST["phone"] ;
	}
	if($_POST["username"]) {
		$username =$_POST["username"] ;
	}
	if($_POST["password"]) {
		$password =  $_POST["password"];
	}
	if($_POST["cpassword"]) {
		$cpassword = $_POST["cpassword"] ;
	}
	
	$isValid = true;
	
	if( $fname != "" && $lname != "" && $dob != "" && $address != "" && $email != "" 
	&& $phone != "" && $username != "" && $password != "" 
	&& $cpassword != "" ) {	
		if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
			$fnameErr = "*Only letters and white space allowed<br>";
			$isValid = false;
		}
		
		if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
			$lnameErr = "*Only letters and white space allowed<br>";
			$isValid = false;
		}
		
		if(preg_match("/^\d{2}\/\d{2}\/\d{4}$/",$dob)) {
			list($month, $date, $year) = explode("/", $dob);
			if(checkdate($month,$date,$year)) {
				$d1=strtotime($dob);
				$d2=ceil((time()-$d1)/60/60/24);
				if($d2 > 6575) {
					$isValid = true;
				}
				else {
					$dobErr = "*You must have to be 18 years old<br>";
					$isValid = false;
				}
			}
			else {	
				$dobErr = "*Invalid Date<br>";
				$isValid = false;
			}	
		}
		else {
			$dobErr = "*Invalid Date Format<br>";
			$isValid = false;
		}
		
		if(isset($_POST["dod"]) && trim($_POST["dod"]) != "") {
			if(preg_match("/^\d{2}\/\d{2}\/\d{4}$/",$dod)) {
				list($month, $date, $year) = explode("/", $dod);
				if(checkdate($month,$date,$year)) {
					$d1=strtotime($dod);
					$d2=ceil((time()-$d1)/60/60/24);
					if($d2 > 0) {
						$isValid = true;
					}
					else {
						$dodErr = "*Invalid Information<br>";
						$isValid = false;
					}
				}
				else {	
					$dodErr = "*Invalid Date<br>";
					$isValid = false;
				}	
			}
			else {
				$dodErr = "*Invalid Date Format<br>";
				$isValid = false;
			}
		}
		else {
			$isValid = true;
		}
			
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "*Invalid Email<br>";
			$isValid = false;
		}
		
		
		
	
		if($password != $cpassword) {
			$passErr = "*The password did not matched<br>";
			$isValid = false;
		}
		
		$password = $cpassword = "";
	} else {
		echo "<script>alert('Please fill up all fields...')</script>";
		$isValid = false;
	}
	
	if ( $isValid ) {
		//header("Location: success.php");
		include('insert_query.php');
		//exit();
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>.: Sign Up :.</title>
	
	<style rel="stylesheet">
	.form_area
			{
				position: absolute;
				left: 33%;
				top:.8%;				
				height: 98.4%;
				width: 400px;
				position: absolute;				
				background-color:#f1f1f1;
				opacity:.9;

			}
			.form_inner_area
			{
				top:1%;
				height: 200px;
				width: 600px;
				position: absolute;
				left: 50px;						
			}
	body	
	{
		margin:0 auto;
		background: url("res/images/signup.jpg") no-repeat;
		background-size: 100%;
		font-family: 'Open Sans', sans-serif;
	}
	.error {
		color: #FF0000;
		//display: inline-block;
	}
	input[type=submit] {
			width: 50%;
			background-color: #4CAF50;
			color: white;
			padding: 14px 20px;
			margin: 3px 0;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			top:55%;
			
			
		}
		
			input[type=submit]:hover {
			background-color: #45a049;
		}

		
		input[type=text] {
			width: 50%;
			padding: 12px 20px;
			margin: 3px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			font-family: inherit;
			font-size: 0.95em;
		}
		
			input[type=password] {
			width: 50%;
			padding: 12px 20px;
			margin: 3px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			font-family: inherit;
			font-size: 0.95em;
		}
		
		select {
			width:24.65%;
			padding: 12px 20px;
			margin: 3px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			font-family: inherit;
			font-size: 0.95em;
		}
		
			.copyright {
		position: absolute;				
		height: 6%;
		width: 20%;
		position: absolute;				
		background-color:#f1f1f1;
		opacity:.9;
		border-radius: 4px;
		bottom: 1%;
		right: .5%;
		text-align: center;
	}
		
	</style>
	
	<script type="text/javascript">
	function redirectRegistration(obj) { 
		window.location.href = "registration.php";
	}
	</script>
</head>
<body>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="form_area">
	<div class="form_inner_area">
	
		<input type="text" name="fname" placeholder="First Name" size="30" value="<?=$fname?>" />
		<span class="error"><?php echo $fnameErr;?></span>
	
		<input type="text" name="lname" placeholder="Last Name" size="30" value="<?=$lname?>" />
		<span class="error"><?php echo $lnameErr;?></span>
		
		<br>
		<select name="gender">
			<option value="Female">Female</option>
			<option value="Male">Male</option>
			<option value="Others">Others</option>
		</select>
		<select name="blood">
			<option value="O+">O+</option>
			<option value="O-">O-</option>
			<option value="A+">A+</option>
			<option value="A-">A-</option>
			<option value="B+">B+</option>
			<option value="B-">B-</option>
			<option value="AB+">AB+</option>
			<option value="AB-">AB-</option>
		</select>
		<br>
		
		<input type="text" name="dob" placeholder="Date of Birth : mm/dd/yyyy" size="30" value="<?=$dob?>">
		<span class="error"><?php echo $dobErr;?></span>
		
		<input type="text" name="dod" placeholder="Last Date of Donation : mm/dd/yyyy" size="30" value="<?=$dod?>">
		<span class="error"><?php echo $dodErr;?></span>
		
		<input type="text" name="address" placeholder="Address" size="30" value="<?=$address?>" />

		<input type="text" name="email" size="30" placeholder="Email" value="<?=$email?>" />
		<span class="error"><?php echo $emailErr;?></span>
	
		<input type="text" name="phone" size="30" placeholder="Mobile Number" value="<?=$phone?>" />
		<span class="error"><?php echo $numberErr;?></span>
	
		<input type="text" name="username" size="30" placeholder="Username" value="<?=$username?>" />
	
		<input type="password" name="password" size="30" placeholder="Your Password" value="<?=$password?>" />
		<span class="error"><?php echo $passErr;?></span>
	
		<input type="password" name="cpassword" size="30" placeholder="Confirm Password"value="<?=$cpassword?>" />
	
		<input type="submit" value="Submit" >
	</div>
	</div>
</form>
	<div class="copyright">
		&copy; 2016-<?php echo date("Y");?>  by Manas Datta All Rights Reserved
	</div>
</body>
</html>
