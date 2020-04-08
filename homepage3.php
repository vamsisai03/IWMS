<?php
	session_start();
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<title>Book Page</title>
<head>
<h1 align="center"><font color="#1e3799">Integrated Workplace Management System</font></h1>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/style3.css">
<link rel="stylesheet" href="css/style4.css">
<link rel="stylesheet" href="css/style5.css">
<link rel="stylesheet" href="css/stylenew.css">
</head>
<body style="background-image:url('imgs/bookpage3.JPG');">
<form class="homepage3" action="homepage3.php" method="post">
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
<center>
<div id="main-wrapper2">
	<form class="homepage2" action="homepage3.php" method="post">
	<h1>Enter the following details to Book</h1><br>
	<b><font color="#e84118">Enter your aadhar card no:</font>&nbsp&nbsp<br>
	<input name="boid" type="text" class="inputbookvalues" placeholder="Aadhar No" pattern="[0-9]{12}" required/><br><br>
	<font color="#e84118">Enter your first name:</font>&nbsp&nbsp
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
	<input name="book1" type="submit" id="book_btn" value="Book"/>
	</b>
	</form>
	<?php
	if(isset($_POST['book1']))
	{
		$boid=$_POST['boid'];
		$firstname=$_POST['firstname'];
		$middlename=$_POST['middlename'];
		$lastname=$_POST['lastname'];
		$bodate=date('Y-m-d');
		$rawdate3=htmlentities($bodate);
		$bdate=date('Y-m-d', strtotime($rawdate3));
		$todate=$_POST['todate'];
		$fromdate=$_POST['fromdate'];
		$fromdate=date('Y-m-d');
		$rawdate2=htmlentities($_POST['todate']);
		$todate=date('Y-m-d', strtotime($rawdate2));
		$rawdate=htmlentities($_POST['fromdate']);
		$fromdate=date('Y-m-d', strtotime($rawdate));
		$strength=$_POST['strength'];
		$mail=$_POST['mail'];
		$phone=$_POST['phone'];
		$v1=$_SESSION['loginid'];
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
					$query="insert into booking(booking_id,strength,to_date,from_date,first_name,middle_name,last_name,b_date) values('$boid',$strength,'$todate','$fromdate','$firstname','$middlename','$lastname','$bdate')";
					$query_run=mysqli_query($con,$query);
					if($query_run)
					{
						$query="insert into booking_email_id(email_id,booking_id) values('$mail','$boid')";
						$query_run=mysqli_query($con,$query);
						if($query_run)
						{
							$query="insert into booking_ph_no(ph_no,booking_id) values('$phone','$boid')";
							$query_run=mysqli_query($con,$query);
							if($query_run)
							{
								$query="insert into booking_workspace(login_id,booking_id) values('$v1','$boid')";
								$query_run=mysqli_query($con,$query);
								if($query_run)
								{
									echo '<script type="text/javascript"> alert("Data Entered successfully") </script>';
									$date1 = $_POST['fromdate'];
									$date2 = $_POST['todate'];
									$diff = (abs(strtotime($date2) - strtotime($date1)))/86400;
									$_SESSION['days']=$diff;
									$_SESSION['strength']=$strength;
									$_SESSION['boid']=$boid;
									header('location:payment.php');
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