<?php
	session_start();
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<title>Success Page</title>
<head>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/style4.css">
<link rel="stylesheet" href="css/style3.css">
<link rel="stylesheet" href="css/style5.css">
<link rel="stylesheet" href="css/stylenew.css">
</head>
<body bgcolor="#95a5a6">
	<center>
	<form class="final" action="final.php" method="post">
	<p align="right">
	<input name="logout2" type="submit" id="logout_btn2" value="Log Out"/>
	</p>
	</form>

	<?php
		if(isset($_POST['logout2']))
		{
			session_destroy();
			header('location:index.php');
		}
	?>
	<div id="main-wrapper">
	<img src="imgs/tick.JPG" class="IWMS">
	<font><h1>Success!</h1></font>
	<a href="homepage2.php"><input type="button" id="back_btn" value="Return to Home Page"/></a>
	</div>
	</center>
	<?php
		$v4=$_SESSION['pid'];
		$v5=$_SESSION['boid'];
		$codate=date('Y-m-d');
		$rawdate5=htmlentities($codate);
		$cdate=date('Y-m-d', strtotime($rawdate5));
		$query="update booking set payment_id='$v4' where booking_id='$v5'";
		$query_run=mysqli_query($con,$query);
		if($query_run)
		{
			$query="insert into confirmed(c_date,payment_id,booking_id) values('$cdate','$v4','$v5')";
			$query_run=mysqli_query($con,$query);
			if($query_run)
			{
				$sql = "select c_id FROM confirmed where c_date='$cdate' and payment_id='$v4' and booking_id='$v5'";
				$result = mysqli_query($con,$sql);
				if($result)
				{
					$value = mysqli_fetch_object($result);
					$_SESSION['id']= $value->c_id;
					$cid=$_SESSION['id'];
					$query="update payment set c_id=$cid where payment_id='$v4'";
					$query_run=mysqli_query($con,$query);
					if($query_run)
					{
						echo '<script type="text/javascript"> alert("Success") </script>';
					}
					else
					{
						echo '<script type="text/javascript"> alert("Error4!") </script>';
					}
				}
				else
				{
					echo '<script type="text/javascript"> alert("Error3!") </script>';
				}
			}
			else
			{
				echo '<script type="text/javascript"> alert("Error2!") </script>';
			}
		}
		else
		{
			echo '<script type="text/javascript"> alert("Error!") </script>';
		}
	?>
</body>
</html>