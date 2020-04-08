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
</head>
<body bgcolor="#ecf0f1" style="background-image:url('imgs/homepage3.JPG');">
	<div id="main-wrapper3">
	<center>
		<img src="imgs/homepage.JPG" class="IWMS"/><br><br>
	<form class="homepage" action="homepage.php" method="post">
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
	<div id="main-wrapper2">
	<form class="homepage2" action="homepage.php" method="post">
	<h1>Enter the following details to Book</h1><br>
	<b><font color="#e84118">Enter your first name:</font>&nbsp&nbsp
	<font color="#e84118">Enter your middle name:</font>&nbsp&nbsp
	<font color="#e84118">Enter your last name:</font><br>&nbsp&nbsp
	<input name="firstname" type="text" class="inputbookvalues" placeholder="First name" required/>&nbsp
	<input name="middlename" type="text" class="inputbookvalues" placeholder="Middle name" required/>&nbsp
	<input name="lastname" type="text" class="inputbookvalues" placeholder="Last name" required/>&nbsp<br><br>
	<font color="#e84118">From Date:</font>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	<font color="#e84118">To Date:</font><br>
	<input name="fromdate" type="date" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" max="2020-05-27" required/>&nbsp
	<input name="todate" type="date"  min="<?php echo date('Y-m-d'); ?>" max="2020-05-27" required/><br><br>
	<font color="#e84118">Enter Strength:</font><br>
	<input name="strength" type="number" min="1" max="20" required/><br><br>
	<font color="#e84118">Enter Email Address:</font><br>
	<input name="mail" type="email" id="email" pattern=".+@gmail.com" size="30" required/><br><br>
	<font color="#e84118">Enter phone number:</font><br>
	<input type="tel" id="phone" name="phone" pattern="[1-9]{1}[0-9]{9}" required/><br><br>
	<input name="book" type="submit" id="book_btn" value="Book"/>
	</b>
	</form>
	<?php
	if(isset($_POST['book']))
	{
		$firstname=$_POST['firstname'];
		$middlename=$_POST['middlename'];
		$lastname=$_POST['lastname'];
		$bodate=date('Y-m-d');
		$rawdate3=htmlentities($bodate);
		$bdate=date('Y-m-d', strtotime($rawdate3));
		$todate=$_POST['todate'];
		$fromdate=date('Y-m-d');
		$rawdate2=htmlentities($_POST['todate']);
		$todate=date('Y-m-d', strtotime($rawdate2));
		$rawdate=htmlentities($_POST['fromdate']);
		$fromdate=date('Y-m-d', strtotime($rawdate));
		$strength=$_POST['strength'];
		$mail=$_POST['mail'];
		$phone=$_POST['phone'];
		if($todate>$fromdate)
		{
			$query="select * from booking_email_id where email_id='$mail'";
			$query_run=mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0)
			{
				echo '<script type="text/javascript"> alert("Emailid already exists") </script>';
			}
			else
			{
				$query="select * from booking_ph_no where ph_no='$phone'";
				$query_run=mysqli_query($con,$query);
				if(mysqli_num_rows($query_run)>0)
				{
					echo '<script type="text/javascript"> alert("Phone number already exists") </script>';
				}
				else
				{
					$query="insert into booking(strength,to_date,from_date,first_name,middle_name,last_name,b_date) values($strength,'$todate','$fromdate','$firstname','$middlename','$lastname','$bdate')";
					$query_run=mysqli_query($con,$query);
					if($query_run)
					{
						$query="insert into booking_email_id(email_id) values('$mail')";
						$query_run=mysqli_query($con,$query);
						if($query_run)
						{
							$query="insert into booking_ph_no(ph_no) values('$phone')";
							$query_run=mysqli_query($con,$query);
							echo '<script type="text/javascript"> alert("Data Entered successfully") </script>';
							$_SESSION['strength']=$strength;
							header('location:payment.php');
						}
						else
						{
							echo '<script type="text/javascript"> alert("Error1!") </script>';
						}
					}
					else
					{
						echo '<script type="text/javascript"> alert("Error2!") </script>';
					}
				}
			}
		}
		else
		{
			echo '<script type="text/javascript"> alert("Enter Dates in correct order") </script>';
		}
	}
	?>
	</div>
	</center>
</body>
</html>   