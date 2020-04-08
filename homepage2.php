<?php
	session_start();
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<title>Home Page</title>
<head>
<h1 align="center"><font color="#1e3799">Integrated Workplace Management System</font></h1>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/style3.css">
<link rel="stylesheet" href="css/style4.css">
<link rel="stylesheet" href="css/stylenew.css">

</head>
<body bgcolor="#ecf0f1" style="background-image:url('imgs/homepage3.JPG');">
	<div id="main-wrapper">
	<center>
		<img src="imgs/homepage.JPG" class="IWMS"/><br><br>
	<form class="homepage" action="homepage2.php" method="post">
		<font color="#e67e22" size="34">Welcome 
		<?php echo $_SESSION['loginid'] ?>
		</font><br>
		<input name="logout" type=submit id="logout_btn" value="Log Out"/><br><br>
	</form>
	</center>
	<?php
		if(isset($_POST['logout']))
		{
			session_destroy();
			header('location:index.php');
		}
	?>
	</div>
	<br><br><br><br><br><br>
	<center>
<a href="homepage3.php"><input type="button" id="book_btn" value="Click Here to Book"/></a>
<a href="track.php"><input type="button" id="book_btn" value="Click Here to check booking status"/></a>
</center>
</body>
</html>   