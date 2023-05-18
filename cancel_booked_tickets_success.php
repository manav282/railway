<?php
session_start();
?>
<html>

<head>
	<title>
		Cancel Booked Tickets
	</title>
	<style>
		input {
			border: 1.5px solid #030337;
			border-radius: 4px;
			padding: 7px 30px;
		}

		input[type=submit] {
			background-color: #030337;
			color: white;
			border-radius: 4px;
			padding: 7px 45px;
			margin: 0px 68px
		}
	</style>
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<div class="navbar">
		<span id="title">
			MyRailway
		</span>
		<div><a href="home_page.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></div>
		<div><a href="customer_homepage.php"><i class="fa fa-desktop" aria-hidden="true"></i> Dashboard</a></div>
		<div><a href="pnr.php"><i class="fa fa-solid fa-check" aria-hidden="true"></i>PNR Status</a></div>
		<div><a href="contact.php"><i class="fa fa-phone" aria-hidden="true"></i> Contact Us</a></div>
		<div><a href="logout_handler.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></div>
	</div>
	<fieldset style="margin: 50px; background-color:#ffcccb;">
		<legend>
			<h2>CANCELLATION DETAILS <i class="fa fa-ban"></i></h2>
		</legend>
		<h3 style='padding-left: 40px;'>Your ticket has been cancelled successfully.<br><br>Your amount of &#x20b9;
			<?php echo $_SESSION['refund_amount'] ?> will be refunded to your bank account <br>
			<h5 style="margin-left: 50px;"> **(Cancellation charge on 15% of your ticket amount has been deducted).</h5>
			</td>
		</h3>
		<br>
	</fieldset>
</body>

</html>