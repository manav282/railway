<?php
session_start();
?>
<html>

<head>
	<title>
		View Booked Tickets
	</title>
	<style>
		input {
			border: 1.5px;
			border-radius: 4px;
			padding: 7px 30px;
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
		<div><a href="admin_homepage.php"><i class="fa fa-desktop" aria-hidden="true"></i> Dashboard</a></div>
		<div><a href="logout_handler.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></div>
	</div>
	<form action="admin_view_booked_tickets_form_handler.php" method="post">
		<fieldset style="margin:50px;background-color:whitesmoke;margin-top:200px;width:fit-content;">
			<legend style="background-color:#030337;color:whitesmoke;">
				<h2>VIEW LIST OF BOOKED TICKETS</h2>
			</legend>
			<div>
				<table cellpadding="5">
					<tr>
						<td class="fix_table">Enter the Train No.</td>
						<td class="fix_table">Enter the Departure Date</td>
					</tr>
					<tr>
						<td class="fix_table"><input type="text" name="train_no" required></td>
						<td class="fix_table"><input type="date" name="departure_date" required></td>
					</tr>
				</table>
				<br>
				<br>
				<input style="margin-left:220px;" type="submit" value="Submit" name="Submit">
			</div>
		</fieldset>
	</form>
</body>

</html>