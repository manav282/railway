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
			border: 1.5px solid #030337;
			border-radius: 4px;
			padding: 7px 30px;
		}

		input[type=submit] {
			background-color: #030337;
			color: white;
			border-radius: 4px;
			padding: 7px 45px;
			margin: 0px 390px
		}

		table {
			border-collapse: collapse;
			margin-left: 10%;
			margin-right: 10%;
		}

		tr {
			border: solid thin;
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
	<div style="margin-top:60px;">
		<?php
		$todays_date = date('Y-m-d');
		$thirty_days_before_date = date_create(date('Y-m-d'));
		date_sub($thirty_days_before_date, date_interval_create_from_date_string("30 days"));
		$thirty_days_before_date = date_format($thirty_days_before_date, "Y-m-d");

		$customer_id = $_SESSION['login_user'];
		require_once('Database Connection file/mysqli_connect.php');
		$query = "SELECT pnr,date_of_reservation,train_no,journey_date,class,booking_status,no_of_passengers,payment_id FROM Ticket_Details where user_id=? AND journey_date>=? AND booking_status='CONFIRMED' ORDER BY  journey_date";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "ss", $customer_id, $todays_date);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $pnr, $date_of_reservation, $train_no, $journey_date, $class, $booking_status, $no_of_passengers, $payment_id);
		mysqli_stmt_store_result($stmt);
		if (mysqli_stmt_num_rows($stmt) == 0) {
			echo "<table style=\"margin-left: 600px;background-color:whitesmoke;margin-top:200px;\" cellpadding=\"10\">";
			echo "<caption style=\"font-weight:bold;background-color:#030337;color:whitesmoke;\">Upcoming Trips</caption>";
			echo "<tr><td>No upcoming trips</td></tr>";
			echo "</table>";
		} else {
			echo "<table style=\"margin-left: 220px;background-color:whitesmoke;margin-top:200px;\" cellpadding=\"13\"> ";
			echo "<caption style=\"font-weight:bold;background-color:#030337;color:whitesmoke;\">Upcoming Trips</caption>";
			echo "<tr><th>PNR</th>
				<th>Date of Reservation</th>
				<th>Train No.</th>
				<th>Journey Date</th>
				<th>Booking Status</th>
				<th>No. of Passengers</th>
				<th>Payment ID</th>
				</tr>";
			while (mysqli_stmt_fetch($stmt)) {
				echo "<tr>
        			<td>" . $pnr . "</td>
        			<td>" . $date_of_reservation . "</td>
					<td>" . $train_no . "</td>
					<td>" . $journey_date . "</td>
					<td><strong>" . $booking_status . "</strong></td>
					<td>" . $no_of_passengers . "</td>
					<td>" . $payment_id . "</td>
        			</tr>";
			}
			echo "</table> <br>";
		}

		$query = "SELECT pnr,date_of_reservation,train_no,journey_date,class,booking_status,no_of_passengers,payment_id FROM ticket_details where user_id=? and journey_date<? and journey_date>=? ORDER BY  journey_date";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "sss", $customer_id, $todays_date, $thirty_days_before_date);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $pnr, $date_of_reservation, $train_no, $journey_date, $class, $booking_status, $no_of_passengers, $payment_id);
		mysqli_stmt_store_result($stmt);
		if (mysqli_stmt_num_rows($stmt) == 0) {
			echo "<table style=\"margin-left: 600px;background-color:whitesmoke;margin-top:50px;\" cellpadding=\"10\">";
			echo "<caption style=\"font-weight:bold;background-color:#030337;color:whitesmoke;\">Completed Trips</caption>";
			echo "<tr><td>No trips completed in past 30 days</td></tr>";
			echo "</table>";
		} else {
			echo "<table style=\"margin-left: 200px;background-color:whitesmoke;\" cellpadding=\"10\">";
			echo "<caption style=\"font-weight:bold;background-color:#030337;color:whitesmoke;\">Completed Trips</caption>";
			echo "<tr><th>PNR</th>
				<th>Date of Reservation</th>
				<th>Train No.</th>
				<th>Journey Date</th>
				<th>Class</th>
				<th>Booking Status</th>
				<th>No. of Passengers</th>
				<th>Payment ID</th>
				</tr>";
			while (mysqli_stmt_fetch($stmt)) {
				echo "<tr>
        			<td>" . $pnr . "</td>
        			<td>" . $date_of_reservation . "</td>
					<td>" . $train_no . "</td>
					<td>" . $journey_date . "</td>
					<td>" . $class . "</td>
					<td>" . $booking_status . "</td>
					<td>" . $no_of_passengers . "</td>
					<td>" . $payment_id . "</td>
        			</tr>";
			}
			echo "</table> <br>";
		}
		mysqli_stmt_close($stmt);
		mysqli_close($dbc);
		?>
	</div>
</body>

</html>