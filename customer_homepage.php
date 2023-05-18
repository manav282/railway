<?php
session_start();
?>
<html>

<head>
	<title>
		Welcome
	</title>
	<style>
		td {
			font-size: 20px;
		}

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

		input[type=date] {
			border: 1.5px solid #030337;
			border-radius: 4px;
			padding: 5.5px 44.5px;
		}

		select {
			border: 1.5px solid #030337;
			border-radius: 4px;
			padding: 6.5px 75.5px;
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
	<div style="width:500px;margin-top:150px;margin-left:auto;margin-right:auto;">
		<?php
		echo "<fieldset style=\"margin: 50px;background-color:whitesmoke;color:whitesmoke;\"><legend style=\"background-color:#030337;\"><h2>Welcome " . $_SESSION['login_user'] . " </h2></legend>";
		?>
		<table cellpadding="5">
			<tr>
				<td>
					<h3><a href="book_tickets.php"><i class="fa fa-subway" aria-hidden="true"></i> Book Tickets</a></h3>
				</td>
			</tr>
			<tr>
				<td>
					<h3><a href="view_booked_tickets.php"><i class="fa fa-subway" aria-hidden="true"></i> View Booked
							Tickets</a>
					</h3>
				</td>
			</tr>
			<tr>
				<td>
					<h3><a href="cancel_booked_tickets.php"><i class="fa fa-subway" aria-hidden="true"></i> Cancel
							Tickets</a>
					</h3>
				</td>
			</tr>
			<tr>
				<td>
					<h3><a href="profile.php"><i class="fa fa-subway" aria-hidden="true"></i> Your
							Profile</a>
					</h3>
				</td>
			</tr>
		</table>
	</div>
</body>

</html>