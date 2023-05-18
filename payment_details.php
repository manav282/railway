<?php
session_start();
?>
<html>

<head>
	<title>
		Enter Payment Details
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
			margin: 0px 357px
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
	<form action="payment_details_form_handler.php" method="post" style="margin:10px;">
		<fieldset style="padding: 10px;background-color:whitesmoke;">
			<legend style="background-color:#030337;">
				<h2 style="color:whitesmoke;">ENTER THE PAYMENT DETAILS <i class="fa fa-credit-card-alt"></i></h2>
			</legend>
			<h3 style="margin-left: 30px"><u>Payment Summary</u></h3>
			<?php
			$train_no = $_SESSION['train_no'];
			$journey_date = $_SESSION['journey_date'];
			$no_of_pass = $_SESSION['no_of_pass'];
			$total_no_of_meals = $_SESSION['total_no_of_meals'];
			$payment_id = rand(100000000, 999999999);
			$pnr = $_SESSION['pnr'];
			$_SESSION['payment_id'] = $payment_id;
			$payment_date = date('Y-m-d');
			$_SESSION['payment_date'] = $payment_date;


			require_once('Database Connection file/mysqli_connect.php');
			if ($_SESSION['class'] == 'sleeper') {
				$query = "SELECT price_sleeper FROM train_details where train_no=? and departure_date=?";
				$stmt = mysqli_prepare($dbc, $query);
				mysqli_stmt_bind_param($stmt, "ss", $train_no, $journey_date);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $ticket_price);
				mysqli_stmt_fetch($stmt);
			} else if ($_SESSION['class'] == 'ac') {
				$query = "SELECT price_ac FROM train_details where train_no=? and departure_date=?";
				$stmt = mysqli_prepare($dbc, $query);
				mysqli_stmt_bind_param($stmt, "ss", $train_no, $journey_date);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $ticket_price);
				mysqli_stmt_fetch($stmt);
			}
			mysqli_stmt_close($stmt);
			mysqli_close($dbc);
			$total_ticket_price = $no_of_pass * $ticket_price;
			$total_meal_price = 250 * $total_no_of_meals;
			if ($_SESSION['insurance'] == 'yes') {
				$total_insurance_fee = 100 * $no_of_pass;
			} else {
				$total_insurance_fee = 0;
			}
			$total_amount = $total_ticket_price + $total_meal_price + $total_insurance_fee;
			$_SESSION['total_amount'] = $total_amount;

			echo "<table cellpadding=\"5\"	style='margin-left: 50px'>";
			echo "<tr>";
			echo "<td class=\"fix_table\">Base Fare, Fuel and Transaction Charges (Fees & Taxes included):</td>";
			echo "<td class=\"fix_table\">&#x20b9; " . $total_ticket_price . "</td>";
			echo "</tr>";

			echo "</table>";

			echo "<hr style='margin-right:900px; margin-left: 50px'>";
			echo "<table cellpadding=\"5\" style='margin-left: 50px'>";
			echo "<tr>";
			echo "<td class=\"fix_table\"><strong>Total:</strong></td>";
			echo "<td class=\"fix_table\">&#x20b9; " . $total_amount . "</td>";
			echo "</tr>";
			echo "</table>";
			echo "<hr style='margin-right:900px; margin-left: 50px'>";
			echo "<br>";
			echo "<p style=\"margin-left:50px\">Your Payment/Transaction ID is <strong>" . $payment_id . ".</strong> Please note it down for future reference.</p>";
			echo "<br>";
			?>
			<table cellpadding="5" style='margin-left: 50px'>
				<tr>
					<td class="fix_table"><strong>Enter the Payment Mode:-</strong></td>
				</tr>
				<tr>
					<td class="fix_table"><i class="fa fa-credit-card" aria-hidden="true"></i> Credit Card <input
							type="radio" name="payment_mode" value="credit card" checked></td>
					<td class="fix_table"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Debit Card <input
							type="radio" name="payment_mode" value="debit card"></td>
					<td class="fix_table"><i class="fa fa-desktop" aria-hidden="true"></i> Net Banking <input
							type="radio" name="payment_mode" value="net banking"></td>
				</tr>
			</table>
			<br>
			<input type="submit" value="Pay Now" name="Pay_Now">
		</fieldset>
	</form>
</body>

</html>