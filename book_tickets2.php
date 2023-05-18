<?php
session_start();
?>
<html>

<head>
	<title>
		Enter Ticket Details
	</title>
	<style>
		td {
			margin-left: 100px;
			padding-left: 100px;
		}

		input {
			border: 1.5px solid #030337;
			border-radius: 4px;
			padding: 7px 10px;
		}

		input[type=number] {
			border: 1.5px solid #030337;
			border-radius: 4px;
			padding: 7px 0px;
		}

		input[type=submit] {
			background-color: #030337;
			color: white;
			border-radius: 4px;
			padding: 7px 45px;
			margin: 0px 500px
		}

		input[type=radio] {
			margin-right: 30px;
		}

		select {
			border: 1.5px solid #030337;
			border-radius: 4px;
			padding: 6.5px 15px;
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
	<?php
	$no_of_pass = $_POST['no_of_pass'];
	$class = $_SESSION['class'];
	$count = $_SESSION['count'];
	$train_no = $_POST['select_train'];
	$_SESSION['train_no'] = $train_no;
	$_SESSION['no_of_pass'] = $no_of_pass;

	require_once('Database Connection file/mysqli_connect.php');
	if ($class == "Sleeper") {
		$query = "SELECT seats_sleeper FROM train_details WHERE train_no=?";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "s", $train_no);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $seats_sleeper);
		mysqli_stmt_store_result($stmt);

		while (mysqli_stmt_fetch($stmt)) {
			$total_seats = $seats_sleeper;
		}
	} else {
		$query = "SELECT seats_ac FROM train_details WHERE train_no=?";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "s", $train_no);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $seats_ac);
		mysqli_stmt_store_result($stmt);
		while (mysqli_stmt_fetch($stmt)) {
			$total_seats = $seats_ac;
		}
	}

	if ($no_of_pass > $total_seats)
		echo "<h2 style=\"color:whitesmoke;text-align:center;\">Only " . $total_seats . " seats available</h2>";

	echo "<fieldset style=\" margin:10px;background-color:whitesmoke;\"><legend class=\"fa fa-user\" style=\" font-size: 25px;background-color:#030337;color:whitesmoke;\"> <strong>ADD PASSENGERS DETAILS </strong></legend>";
	echo "<form action=\"add_ticket_details_form_handler.php\" method=\"post\">";
	while ($count <= $no_of_pass) {
		echo "<p><strong>PASSENGER " . $count . "<strong></p>";
		echo "<table cellpadding=\"0\">";
		echo "<tr>";
		echo "<td class=\"fix_table_short\">Passenger's Name</td>";
		echo "<td class=\"fix_table_short\">Passenger's Age</td>";
		echo "<td class=\"fix_table_short\">Passenger's Gender</td>";
		echo "<td class=\"fix_table_short\">Passenger's Onboard Meal</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td class=\"fix_table_short\"><input type=\"text\" name=\"pass_name[]\" required></td>";
		echo "<td class=\"fix_table_short\"><input type=\"number\" name=\"pass_age[]\" required></td>";
		echo "<td class=\"fix_table_short\">";
		echo "<select name=\"pass_gender[]\">";
		echo "<option value=\"male\">Male</option>";
		echo "<option value=\"female\">Female</option>";
		echo "<option value=\"other\">Other</option>";
		echo "</select>";
		echo "</td>";
		echo "<td class=\"fix_table_short\">";
		echo "<select name=\"pass_meal[]\">";
		echo "<option value=\"yes\">Yes</option>";
		echo "<option value=\"no\">No</option>";
		echo "</select>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		echo "<br><hr>";
		$count = $count + 1;
	}
	echo "<br><h3>ENTER TRAVEL DETAILS</h3>";
	echo "<table cellpadding=\"5\">";
	echo "<tr>";
	echo "<td class=\"fix_table_short\">Do you want to purchase Travel Insurance?</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"fix_table\">";
	echo "Yes <input type='radio' name='insurance' value='yes' checked/> No <input type='radio' name='insurance' value='no'/>";
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "<br><br>";
	echo "<input type=\"submit\" value=\"Submit Ticket Details\" name=\"Submit\">";
	echo "</form></fieldset>";
	?>
</body>

</html>