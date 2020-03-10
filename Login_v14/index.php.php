<!DOCTYPE html>
<html lang="en">
<head>
	<title>Account Application</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

	
</head>
<body style="background-color: white; " dir="rtl" >
	
	<div class="limiter" style="background-color: green;">
		<div class="container-login100" style="background-image: url('bg.jpg')">
			
			<div  class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form class="login100-form validate-form flex-sb flex-w" method="post" action="">

					<span class="login100-form-title p-b-32">
						
						<center><b>LOG IN</b></center>
					</span>

						<br>
					<span class="txt1 p-b-11">
				<b>User Name</b>
					</span>
					
					<div class="wrap-input100 validate-input m-b-36" data-validate = "اسم المستخدم مطلوب">
						<input class="input100" type="text" name="username" >
						<span class="focus-input100"></span>
					</div>
					
					<span class="txt1 p-b-11">
						<b>
							Password
						</b>
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "كلمة المرور مطلوبة">
						<span class="btn-show-pass" style="float: right;">
							
						</span>
						<input class="input100" type="password" name="pass" >
						<span class="focus-input100"></span>
						


						
					</div>
					
					<div class="flex-sb-m w-full p-b-48">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
							تذكرني
							</label>
						</div>

						<div>
							
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="login">
						Login
						</button>
					</div>
					<?php session_start(); 
			include("../connection.php");

					if(isset($_POST['login']))
						{
							extract($_POST);
							$query="select * from user where username='$username' && password='$pass'";
$con=con_function();
   $r=$con->query($query);
   $numrows = mysqli_num_rows($r);

			  
			  if ($numrows ==1){
			  	$row = mysqli_fetch_assoc($r);
			  	
				  $_SESSION['username'] = $username;
				  $_SESSION['typee'] = $row['type'];
				  $_SESSION['id'] = $row['uid'];
				  header('location:../index.php');
			  }else{
				  echo "<center style='color:red'>اسم المستخدم أو كلمة السر غير صحيحة! </center>"; 
			  }
						} ?>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>

	<script src="vendor/animsition/js/animsition.min.js"></script>

	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>

	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>

	<script src="js/main.js"></script>
	

</body>
</html>