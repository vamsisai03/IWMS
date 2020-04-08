<?php
	session_start();
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<title>Payment page</title>
<head>
<h1 align="center"><font color="#e67e22">Enter payment details</font></h1>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/style3.css">
<link rel="stylesheet" href="css/style4.css">
<link rel="stylesheet" href="css/stylenew.css">
</head>
<body bgcolor="#ecf0f1">
	<div id="main-wrapper">
	<center>
	<form class="paymentpage" action="payment.php" method="post">
	<br><br><font color="#e74c3c"><b>Enter payment id as present time:</b></font><br>
	<input name="pid" type="text" class="inputbookvalues" placeholder="Enter payment id" required/><br><br>
	<font color="#e74c3c"><b>Enter account no:</b></font><br>
	<input name="accno" type="text" class="inputvalues" placeholder="Enter account no" required/><br><br>
	<font color="#e74c3c"><b>Enter password:</b></font><br>
	<input name="pass" type="password" class="inputvalues" placeholder="Enter password" required/><br><br>
	<font color="#27ae60" size="34">Total Fare:RS.
	<?php	echo $_SESSION['strength']*$_SESSION['days']*300 ?>
	</font><br>
	<input name="proceed" type="submit" id="proceed_btn" value="Proceed">
	</form>
	</center>
	<?php
		if(isset($_POST['proceed']))
		{
			$pid=$_POST['pid'];
			$accno=$_POST['accno'];
			$pass=$_POST['pass'];
			$fare=$_SESSION['strength']*300;
			$padate=date('Y-m-d');
			$rawdate4=htmlentities($padate);
			$pdate=date('Y-m-d', strtotime($rawdate4));
			$query="select * from accounts where accno='$accno' and password='$pass'";
			$query_run=mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0)
			{
				$query="insert into payment(payment_id,password,p_date,fare,account_no) values('$pid','$pass','$pdate',$fare,'$accno')";
				$query_run=mysqli_query($con,$query);
				if($query_run)
				{
					$sql = "select balance FROM accounts where accno='$accno'";
					$result = mysqli_query($con,$sql);
					if($result)
					{
						$value = mysqli_fetch_object($result);
						$_SESSION['up']= $value->balance;
						$up=$_SESSION['up'];
						$di=$up-$fare;
						$query="update accounts set balance=$di where accno='$accno'";
						$query_run=mysqli_query($con,$query);
						if($query_run)
						{
							$_SESSION['pid']=$pid;
							$_SESSION['accno']=$accno;
							$_SESSION['pass']=$pass;
							$_SESSION['pdate']=$pdate;
							$_SESSION['fare']=$fare;
							header('location:final.php');
						}
						else
						{
							echo '<script type="text/javascript"> alert("Error!") </script>';
						}
					}
					
				}
				else
				{
					echo '<script type="text/javascript"> alert("Error:Transaction Failed.Please try after some time") </script>';
				}
			}
			else
			{
				echo '<script type="text/javascript"> alert("Error:Bank details incorrect!Please enter correct details") </script>';
			}
		}
	?>
	</div>
</body>
</html>