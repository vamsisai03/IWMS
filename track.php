<?php
	session_start();
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<title>Check Page</title>
<head>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/style4.css">
<link rel="stylesheet" href="css/style3.css">
<link rel="stylesheet" href="css/style5.css">
<link rel="stylesheet" href="css/style6.css">
<link rel="stylesheet" href="css/stylenew.css">
</head>
<body  style="background-image:url('imgs/check.JPG');">
	<form class="track" action="track.php" method="post">
		<p align="right">
		<input name="logout3" type="submit" id="logout_btn3" value="Log Out"/><br><br>
		<a href="homepage2.php"><input name="bthp" type="button" id="bthp" value="Back To Home Page"/></a>
		</p>
	</form>
	<?php
		if(isset($_POST['logout3']))
		{
			session_destroy();
			header('location:index.php');
		}
	?>
	<div id="main-wrapper">
	<form class="track" action="track.php" method="post">
	<center>
	<b><font color="#e84118">Enter your aadhar card no to check status of booking:</font><br><br>
	<input name="adn" type="text" class="inputbookvalues" placeholder="Aadhar No" pattern="[0-9]{12}" required/><br><br>
	<input name="check" type="submit" id="check_btn" value="Check"/>
	</b></center></form></div><br><br><br><br>
	<?php
		if(isset($_POST['check']))
		{
			$adn=$_POST['adn'];
			$query="SELECT b.booking_id,p.payment_id,c.c_id,b.first_name,b.middle_name,b.last_name,b.strength,b.from_date,b.to_date,b.b_date,be.email_id,bp.ph_no,p.fare FROM booking as b INNER JOIN payment as p ON b.payment_id=p.payment_id INNER JOIN confirmed as c ON p.c_id=c.c_id INNER JOIN booking_email_id as be ON b.booking_id=be.booking_id INNER JOIN booking_ph_no as bp ON b.booking_id=bp.booking_id where b.booking_id='$adn'";
			$query_run=mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0)
			{
				while($row=mysqli_fetch_array($query_run))
				{
	?>
	
				<table align="center" border="1px" width=100% id="table1">
				<tr style="color:#4cd137;background:#192a56">
				<th>Booking Id</th><th>Payment Id</th><th>Confirmation Id</th><th>First name</th><th>Middle name</th><th>Last name</th><th>Strength</th><th>From Date</th><th>To Date</th><th>Booking Date</th><th>Email ID</th><th>Phone number</th><th>Fare</th>
				</tr>
				<tr style="color:#1e272e">
					<td><?php echo $row['booking_id']?></td><td><?php echo $row['payment_id']?></td><td><?php echo $row['c_id']?></td><td><?php echo $row['first_name']?></td><td><?php echo $row['middle_name']?></td><td><?php echo $row['last_name']?></td><td><?php echo $row['strength']?></td><td><?php echo $row['from_date']?></td><td><?php echo $row['to_date']?></td><td><?php echo $row['b_date']?></td><td><?php echo $row['email_id']?></td><td><?php echo $row['ph_no']?></td><td><?php echo $row['fare']?></td>
				</tr>
				</table>
				
	<?php
				}
			}
			else
			{
				echo '<script type="text/javascript"> alert("No Data Found!") </script>';
			}
		}
	?>

</body>
</html>