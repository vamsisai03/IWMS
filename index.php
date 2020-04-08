<?php
	session_start();
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<title>Login Page</title>
<head>
<h1 align="center"><font color="#d63031">Integrated Workplace Management System</font></h1>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/style4.css">
<link rel="stylesheet" href="css/style3.css">
<link rel="stylesheet" href="css/style6.css">
<link rel="stylesheet" href="css/stylenew.css">
</head>
<body style="background-image:url('imgs/newlogin.JPEG');" >
	<div id="main-wrapper">
	<center>
		<font color="red"><h2>Login Credentials</h2></font>
		<img src="imgs/IWMSlogin.JPG" class="IWMS"/><br><br>
	<form class="loginpage" action="index.php" method="post">
		<font color="red"><label><b>Login id:</b></label></font><br>
		<input name="loginid" type=text class="inputvalues" placeholder="Type your login id" required/><br><br>
		<font color="red"><label><b>Password:</b></label></font><br>
		<input name="password" type=password class="inputvalues" placeholder="Type your password" required/><br><br>
		<input name="login" type=submit id="login_btn" value="Login"/><br><br>
		<a href="signup.php"><input type=button id="signup_btn" value="Signup"/></a>
	</form>
	</center>
	<?php
		if(isset($_POST['login']))
		{
			$loginid=$_POST['loginid'];
			$password=$_POST['password'];
			$query="select * from login where login_id='$loginid' and password='$password'";
			$query_run=mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0)
			{
				  //valid
				$_SESSION['loginid']=$loginid;
				header('location:homepage2.php');
			}
			else
			{
				echo '<script type="text/javascript"> alert("Invalid credentials") </script>';
			}
		}
	?>
	</div>
</body>
</html>   