<?php
session_start();
?>
<html>

<head>
	<title>
		Ticket Booking Successful
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
			margin: 0px 127px
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
	<div style="margin-top:200px">
		<fieldset style="margin: 20px; background-color:#90eea8;">
			<h2>BOOKING SUCCESSFUL <i class="fa fa-check-square"></i></h2>
			<h3>Your payment of &#x20b9;
				<?php echo $_SESSION['total_amount']; ?> has been received.<br><br> Your PNR is <strong>
					<?php echo $_SESSION['pnr']; ?>
				</strong>. Your tickets have been booked successfully.
			</h3>
		</fieldset>
	</div>

</body>

</html>