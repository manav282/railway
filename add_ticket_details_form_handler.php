<?php
session_start();
?>
<html>

<head>
	<title>Add Ticket Details</title>
</head>

<body>
	<?php
	$i = 1;
	if (isset($_POST['Submit'])) {
		$pnr = rand(1000000, 9999999);
		$date_of_res = date("Y-m-d");
		$train_no = $_SESSION['train_no'];
		$journey_date = $_SESSION['journey_date'];
		$booking_status = "PENDING";
		$no_of_pass = $_SESSION['no_of_pass'];
		$insurance = $_POST['insurance'];
		$total_no_of_meals = 0;
		$_SESSION['pnr'] = $pnr;
		$class = $_SESSION['class'];

		$_SESSION['insurance'] = $insurance;

		$payment_id = NULL;
		$customer_id = $_SESSION['login_user'];

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

		$query = "INSERT INTO ticket_details (pnr,date_of_reservation,train_no,journey_date,class,booking_status,no_of_passengers,insurance,payment_id,user_id) VALUES (?,?,?,?,?,?,?,?,?,?)";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "ssssssssis", $pnr, $date_of_res, $train_no, $journey_date, $class, $booking_status, $no_of_pass, $insurance, $payment_id, $customer_id);
		mysqli_stmt_execute($stmt);
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		echo $affected_rows . '<br>';

		if ($affected_rows == 1) {
			echo "Successfully Submitted<br>";
		} else {
			echo "Submit Error";
		}

		for ($i = 1; $i <= $no_of_pass; $i++) {

			$query = "INSERT INTO passengers (passenger_id,pnr,name,age,gender,meal_choice) VALUES (?,?,?,?,?,?)";
			$stmt = mysqli_prepare($dbc, $query);

			if ($_POST['pass_meal'][$i - 1] == 'yes')
				$total_no_of_meals++;
			mysqli_stmt_bind_param($stmt, "ississ", $i, $pnr, $_POST['pass_name'][$i - 1], $_POST['pass_age'][$i - 1], $_POST['pass_gender'][$i - 1], $_POST['pass_meal'][$i - 1]);
			mysqli_stmt_execute($stmt);
			$affected_rows = mysqli_stmt_affected_rows($stmt);
			echo 'Passenger added ' . $affected_rows . '<br>';
		}
		$_SESSION['total_no_of_meals'] = $total_no_of_meals;
		mysqli_stmt_close($stmt);
		mysqli_close($dbc);

		header("location: payment_details.php");
	} else {
		echo "Submit request not received";
	}
	?>
</body>

</html>