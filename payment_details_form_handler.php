<?php
session_start();
?>
<html>

<head>
	<title>Submit Payment Details</title>
</head>

<body>
	<?php
	if (isset($_POST['Pay_Now'])) {
		$no_of_pass = $_SESSION['no_of_pass'];
		$train_no = $_SESSION['train_no'];
		$journey_date = $_SESSION['journey_date'];
		$class = $_SESSION['class'];
		$pnr = $_SESSION['pnr'];
		$payment_id = $_SESSION['payment_id'];
		$total_amount = $_SESSION['total_amount'];
		$payment_date = $_SESSION['payment_date'];
		$payment_mode = $_POST['payment_mode'];

		require_once('Database Connection file/mysqli_connect.php');
		if ($_SESSION['class'] == 'sleeper') {
			$query = "UPDATE train_details SET seats_sleeper=seats_sleeper-? WHERE train_no=? AND departure_date=?";
			$stmt = mysqli_prepare($dbc, $query);
			mysqli_stmt_bind_param($stmt, "iss", $no_of_pass, $train_no, $journey_date);
			mysqli_stmt_execute($stmt);
			$affected_rows_1 = mysqli_stmt_affected_rows($stmt);
			echo $affected_rows_1 . '<br>';
			mysqli_stmt_close($stmt);
		} else {
			$query = "UPDATE train_details SET seats_ac=seats_ac-? WHERE train_no=? AND departure_date=?";
			$stmt = mysqli_prepare($dbc, $query);
			mysqli_stmt_bind_param($stmt, "iss", $no_of_pass, $train_no, $journey_date);
			mysqli_stmt_execute($stmt);
			$affected_rows_1 = mysqli_stmt_affected_rows($stmt);
			echo $affected_rows_1 . '<br>';
			mysqli_stmt_close($stmt);
		}


		if ($affected_rows_1 == 1) {
			echo "Successfully Updated Seats<br>";

			$query = "INSERT INTO payment_details (payment_id,pnr,payment_date,payment_amount,payment_mode) VALUES (?,?,?,?,?)";
			$stmt = mysqli_prepare($dbc, $query);
			mysqli_stmt_bind_param($stmt, "sssis", $payment_id, $pnr, $payment_date, $total_amount, $payment_mode);
			mysqli_stmt_execute($stmt);
			$affected_rows_2 = mysqli_stmt_affected_rows($stmt);
			echo $affected_rows_2 . '<br>';
			mysqli_stmt_close($stmt);
			if ($affected_rows_2 == 1) {
				echo "Successfully Updated Payment Details<br>";
				header('location:ticket_success.php');
			} else {
				echo "Submit Error";
			}
		} else {
			echo "Submit Error";
		}
		mysqli_close($dbc);
	} else {
		echo "Payment request not received";
	}
	?>
</body>

</html>