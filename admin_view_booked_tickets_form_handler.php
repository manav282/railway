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
		}

		tr

		/*:nth-child(3)*/
			{
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
		<div><a href="admin_homepage.php"><i class="fa fa-desktop" aria-hidden="true"></i> Dashboard</a></div>
		<div><a href="logout_handler.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></div>
	</div>
	<div style="margin-top:200px;">
		<?php
		if (isset($_POST['Submit'])) {
			$data_missing = array();
			if (empty($_POST['train_no'])) {
				$data_missing[] = 'Train No.';
			} else {
				$train_no = trim($_POST['train_no']);
			}
			if (empty($_POST['departure_date'])) {
				$data_missing[] = 'Departure Date';
			} else {
				$departure_date = $_POST['departure_date'];
			}
			if (empty($data_missing)) {
				require_once('Database Connection file/mysqli_connect.php');
				$query = "SELECT pnr,date_of_reservation,no_of_passengers,payment_id,user_id FROM ticket_details where train_no=? and journey_date=? and booking_status='CONFIRMED'";
			}
			$stmt = mysqli_prepare($dbc, $query);
			mysqli_stmt_bind_param($stmt, "ss", $train_no, $departure_date);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $pnr, $date_of_reservation, $no_of_passengers, $payment_id, $customer_id);
			mysqli_stmt_store_result($stmt);
			if (mysqli_stmt_num_rows($stmt) == 0) {
				echo "<h3 style=\"margin-left:300px;\">No booked tickets information is available!</h3>";
			} else {
				echo "<table cellpadding=\"10\" style=\"margin-left:500px;background-color:whitesmoke;\">";
				echo "<caption style=\"font-weight:bold;background-color:#030337;color:whitesmoke;\">List of Booked Tickets</caption>";
				echo "<tr><th>PNR</th>
						<th>Date of Reservation</th>
						<th>No. of Passengers</th>
						<th>Payment ID</th>
						<th>Customer ID</th>
						</tr>";
				while (mysqli_stmt_fetch($stmt)) {
					echo "<tr>
							<td>" . $pnr . "</td>
							<td>" . $date_of_reservation . "</td>
							<td>" . $no_of_passengers . "</td>
							<td>" . $payment_id . "</td>
							<td>" . $customer_id . "</td>
        					</tr>";
				}
				echo "</table> <br>";
			}
			mysqli_stmt_close($stmt);
			mysqli_close($dbc);
		} else {
			echo "The following data fields were empty! <br>";
			foreach ($data_missing as $missing) {
				echo $missing . "<br>";
			}
		}

		?>
	</div>
</body>

</html>