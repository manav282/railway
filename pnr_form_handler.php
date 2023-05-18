<?php
session_start();
?>
<html>

<head>
	<title>
		PNR Status
	</title>
	<style>
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
		<div><a href="home_page.php"><i class="fa fa-home"></i> Home</a></div>
		<div>
			<?php
			if (isset($_SESSION['login_user']) && $_SESSION['user_type'] == 'Customer') {
				echo "<a href=\"customer_homepage.php\"><i class=\"fa fa-ticket\" aria-hidden=\"true\"></i>Dashboard</a>";
			} else if (isset($_SESSION['login_user']) && $_SESSION['user_type'] == 'Administrator') {
				echo "<a href=\"admin_ticket_message.php\"><i class=\"fa fa-ticket\" aria-hidden=\"true\"></i>Dashboard</a>";
			} else {
				echo "<a href=\"login_page.php\"><i class=\"fa fa-ticket\" aria-hidden=\"true\"></i> Book Tickets</a>";
			}
			?>
		</div>
		<div><a href="pnr.php"><i class="fa fa-solid fa-check" aria-hidden="true"></i>PNR Status</a></div>
		<div><a href="contact.php"><i class="fa fa-phone" aria-hidden="true"></i> Contact Us</a></div>
		<div>
			<?php
			if (isset($_SESSION['login_user']) && $_SESSION['user_type'] == 'Customer') {
				echo "<a href=\"login_page.php\"><i class=\"fa fa-sign-in\" aria-hidden=\"true\"></i> Logout</a>";
			} else if (isset($_SESSION['login_user']) && $_SESSION['user_type'] == 'Administrator') {
				echo "<a href=\"login_page.php\"><i class=\"fa fa-sign-in\" aria-hidden=\"true\"></i> Logout</a>";
			} else {
				echo "<a href=\"login_page.php\"><i class=\"fa fa-sign-in\" aria-hidden=\"true\"></i> Login</a>";
			}
			?>
		</div>
	</div>
	<?php
	if (isset($_POST['Check_PNR'])) {
		$data_missing = array();
		if (empty($_POST['pnr'])) {
			$data_missing[] = 'PNR';
		} else {
			$pnr = trim($_POST['pnr']);
		}

		$todays_date = date('Y-m-d');
		require_once('Database Connection file/mysqli_connect.php');
		$query = "SELECT count(*) from ticket_details t WHERE pnr=? and journey_date>=?";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "ss", $pnr, $todays_date);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $cnt);
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_close($stmt);
		if ($cnt != 1) {
			mysqli_close($dbc);
			header("location: pnr.php?msg=failed");
		}

		echo "<h1 style=\"text-align:center;color:whitesmoke;background-color:#030337;\">PNR Status</h1>";

		echo "<div style=\"padding:30px;\">";

		if (empty($data_missing)) {
			require_once('Database Connection file/mysqli_connect.php');

			$query = "SELECT date_of_reservation,train_no,journey_date,class,no_of_passengers,booking_status from ticket_details t WHERE pnr=?";
			$stmt = mysqli_prepare($dbc, $query);
			mysqli_stmt_bind_param($stmt, "s", $pnr);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $date_of_reservation, $train_no, $journey_date, $class, $no_of_pass, $booking_status);
			mysqli_stmt_fetch($stmt);
			mysqli_stmt_close($stmt);

			$query3 = "SELECT from_city,to_city,reaching_date,departure_time,reaching_time from train_details WHERE train_no=?";
			$stmt3 = mysqli_prepare($dbc, $query3);
			mysqli_stmt_bind_param($stmt3, "s", $train_no);
			mysqli_stmt_execute($stmt3);
			mysqli_stmt_bind_result($stmt3, $from_city, $to_city, $reaching_date, $departure_time, $reaching_time);
			mysqli_stmt_fetch($stmt3);

			echo "<table style=\"margin-left: 150px;background-color:whitesmoke;margin-top:60px;\" cellpadding=\"13\">";
			echo "<caption style=\"font-weight:bold;background-color:#030337;color:whitesmoke;\">Booking Details</caption>";
			echo "<tr>";
			echo "<td class=\"fix_table_short\">PNR No.</td>";
			echo "<td class=\"fix_table_short\">Date of reservation</td>";
			echo "<td class=\"fix_table_short\">Train No.</td>";
			echo "<td class=\"fix_table_short\">Source</td>";
			echo "<td class=\"fix_table_short\">Destination</td>";
			echo "<td class=\"fix_table_short\">Journey Date</td>";
			echo "<td class=\"fix_table_short\">Departure Time</td>";
			echo "<td class=\"fix_table_short\">Reaching Date</td>";
			echo "<td class=\"fix_table_short\">Reaching Time</td>";
			echo "<td class=\"fix_table_short\">Class</td>";
			echo "<td class=\"fix_table_short\">No.of Passenger</td>";
			echo "<td class=\"fix_table_short\">Booking Status</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td class=\"fix_table_short\">" . $pnr . "</td>";
			echo "<td class=\"fix_table_short\">" . $date_of_reservation . "</td>";
			echo "<td class=\"fix_table_short\">" . $train_no . "</td>";
			echo "<td class=\"fix_table_short\">" . $from_city . "</td>";
			echo "<td class=\"fix_table_short\">" . $to_city . "</td>";
			echo "<td class=\"fix_table_short\">" . $journey_date . "</td>";
			echo "<td class=\"fix_table_short\">" . $departure_time . "</td>";
			echo "<td class=\"fix_table_short\">" . $reaching_date . "</td>";
			echo "<td class=\"fix_table_short\">" . $reaching_time . "</td>";
			echo "<td class=\"fix_table_short\">" . $class . "</td>";
			echo "<td class=\"fix_table_short\">" . $no_of_pass . "</td>";
			echo "<td class=\"fix_table_short\">" . $booking_status . "</td>";
			echo "</tr>";
			mysqli_stmt_close($stmt3);

			$query2 = "SELECT name,age,gender from passengers where pnr=?";
			$stmt2 = mysqli_prepare($dbc, $query2);
			mysqli_stmt_bind_param($stmt2, "s", $pnr);
			mysqli_stmt_execute($stmt2);
			mysqli_stmt_bind_result($stmt2, $name, $age, $gender);

			echo "<table style=\"margin-left: 640px;background-color:whitesmoke;margin-top:30px;\" cellpadding=\"13\">";
			echo "<caption style=\"font-weight:bold;background-color:#030337;color:whitesmoke;\">Passenger Details</caption>";
			echo "<tr>";
			echo "<td class=\"fix_table_short\">Name</td>";
			echo "<td class=\"fix_table_short\">Age</td>";
			echo "<td class=\"fix_table_short\">Gender</td>";
			echo "</tr>";
			while (mysqli_stmt_fetch($stmt2)) {
				echo "<tr>";
				echo "<td class=\"fix_table_short\">" . $name . "</td>";
				echo "<td class=\"fix_table_short\">" . $age . "</td>";
				echo "<td class=\"fix_table_short\">" . $gender . "</td>";
				echo "</tr>";
			}
			echo "</div>";
			mysqli_stmt_close($stmt2);
		} else {
			echo "Submit Error";
			header("location: pnr.php?msg=failed");
		}
		mysqli_close($dbc);
	}
	?>
</body>

</html>