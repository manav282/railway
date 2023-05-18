<?php
session_start();
?>
<html>

<head>
	<title>
		Admin Home
	</title>
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
	<div style="width:500px;margin-top:200px;margin-left:auto;margin-right:auto;">
		<fieldset style="margin: 50px;background-color:whitesmoke;margin-top:120px;width:fit-content;">
			<legend style="background-color:#030337;color:whitesmoke;">
				<h2>Welcome Admin <i class="fa fa-address-card"></i></h2>
			</legend>
			<table cellpadding="5">

				<tr>
					<td class="admin_func"><a href="admin_view_booked_tickets.php">
							<h3> <i class="fa fa-train" aria-hidden="true"></i> View List of Booked Tickets</h3>
						</a>
					</td>
				</tr>
				<tr>
					<td class="admin_func"><a href="add_train_details.php">
							<h3> <i class="fa fa-train" aria-hidden="true"></i> Add Train Schedule Details</h3>
						</a>
					</td>
				</tr>

			</table>
		</fieldset>
	</div>
</body>

</html>