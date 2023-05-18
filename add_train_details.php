<?php
session_start();
?>
<html>

<head>
	<title>
		Add Train Schedule Details
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
			margin: 0px 200px
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
	<form action="add_train_details_form_handler.php" method="post">
		<fieldset style="margin: 50px; margin-left:250px; width: 65%;background-color:whitesmoke;">
			<legend style="color:whitesmoke;background-color:#030337">
				<h2>ENTER THE TRAIN SCHEDULE DETAILS <i class="fa fa-train"></i></h2>
			</legend>
			<?php
			if (isset($_GET['msg']) && $_GET['msg'] == 'success') {
				echo "<strong style='color: green'>The Train Schedule has been successfully added.</strong>
						<br>
						<br>";
			} else if (isset($_GET['msg']) && $_GET['msg'] == 'failed') {
				echo "<strong style='color: red'>*Invalid Train Schedule Details, please enter again.</strong>
						<br>
						<br>";
			}
			?>
			<table cellpadding="5">
				<tr>
					<td class="fix_table">Train Number</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="text" name="train_no" required></td>
				</tr>
			</table>
			<br>
			<hr>
			<table cellpadding="5">
				<tr>
					<td class="fix_table">Origin</td>
					<td class="fix_table">Destination</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="text" name="origin" required></td>
					<td class="fix_table"><input type="text" name="destination" required></td>
				</tr>
			</table>
			<br>
			<hr>
			<table cellpadding="5">
				<tr>
					<td class="fix_table">Departure Date</td>
					<td class="fix_table">Reaching Date</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="date" name="dep_date" required></td>
					<td class="fix_table"><input type="date" name="rea_date" required></td>
				</tr>
			</table>
			<br>
			<hr>
			<table cellpadding="5">
				<tr>
					<td class="fix_table">Departure Time</td>
					<td class="fix_table">Reaching Time</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="time" name="dep_time" required></td>
					<td class="fix_table"><input type="time" name="rea_time" required></td>
				</tr>
			</table>
			<br>
			<hr>
			<table cellpadding="5">
				<tr>
					<td class="fix_table">Number of Seats in Sleeper Class</td>
					<td class="fix_table">Number of Seats in AC Class</td>
				</tr>
				<tr>
					<td class="fix_table"><input type="number" name="seats_sleeper" required></td>
					<td class="fix_table"><input type="number" name="seats_ac" required></td>
				</tr>
			</table>
			<br>
			<hr>
			<table cellpadding="5">
				<tr>
					<td class="fix_table">Ticket Price(Sleeper Class)</td>
					<td class="fix_table">Ticket Price(AC Class)</td>
				</tr>
			</table>
			<table cellpadding="5">
				<tr>
					<td class="fix_table">
						<input type="number" name="price_sleeper" required>
					</td>
					<td class="fix_table">
						<input type="number" name="price_ac" required>
					</td>
				</tr>
			</table>
			<br>
			<input type="submit" value="Submit" name="Submit"
				style="margin-top: 10px; margin-left: 400px;padding: 10px;">
		</fieldset>
	</form>
</body>

</html>