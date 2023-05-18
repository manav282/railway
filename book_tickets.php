<?php
session_start();
?>
<html>

<head>
	<title>
		View Available Trains
	</title>
	<style>
		td {
			padding-left: 100px;
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
	<br><br>
	<div style="margin-top:100px">
		<form class="float_form" style="padding-left: 100px; font-size: 20px;" action="view_trains_form_handler.php"
			method="POST">
			<fieldset style="padding: 10px;background-color:whitesmoke;">
				<legend style="background-color:#030337;">
					<h3 style="color:whitesmoke;">SEARCH FOR AVAILABLE TRAINS</h3>
				</legend>
				<table cellpadding="5">
					<tr>
						<td class="fix_table">Enter the Souce</td>
						<td class="fix_table">Enter the Destination</td>
					</tr>
					<tr>
						<td class="fix_table">
							<input type="text" name="origin" placeholder="From" required>
						</td>
						<td class="fix_table">
							<input type="text" name="destination" placeholder="To" required>
						</td>
					</tr>
				</table>
				<table cellpadding="5">
					<tr>
						<td class="fix_table">Enter the Departure Date</td>
						<td class="fix_table">Select the class</td>
					</tr>
					<tr>
						<td class="fix_table"><input type="date" name="dep_date" min=<?php
						$todays_date = date('Y-m-d');
						echo $todays_date;
						?> max=<?php
						 $max_date = date_create(date('Y-m-d'));
						 date_add($max_date, date_interval_create_from_date_string("30 days"));
						 echo date_format($max_date, "Y-m-d");
						 ?> required></td>
						<td class="fix_table"><select name="class">
								<option value="sleeper">Sleeper</option>
								<option value="ac">AC</option>
							</select></td>
					</tr>
				</table>
				<br>
				<input type="submit" value="Search for Trains" name="Search"
					style="margin-top:10px;margin-left:300px;cursor:pointer;font-size:15px;">
			</fieldset>
		</form>
	</div>
</body>

</html>