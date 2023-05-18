<?php
session_start();
?>
<html>

<head>
	<title>Add Train Schedule Details</title>
</head>

<body>
	<?php
	if (isset($_POST['Submit'])) {
		$data_missing = array();
		if (empty($_POST['train_no'])) {
			$data_missing[] = 'Train No.';
		} else {
			$train_no = trim($_POST['train_no']);
		}

		if (empty($_POST['origin'])) {
			$data_missing[] = 'Origin';
		} else {
			$origin = $_POST['origin'];
		}
		if (empty($_POST['destination'])) {
			$data_missing[] = 'Destination';
		} else {
			$destination = $_POST['destination'];
		}

		if (empty($_POST['dep_date'])) {
			$data_missing[] = 'Departure Date';
		} else {
			$dep_date = $_POST['dep_date'];
		}
		if (empty($_POST['rea_date'])) {
			$data_missing[] = 'Reaching Date';
		} else {
			$rea_date = $_POST['rea_date'];
		}

		if (empty($_POST['dep_time'])) {
			$data_missing[] = 'Departure Time';
		} else {
			$dep_time = $_POST['dep_time'];
		}
		if (empty($_POST['rea_time'])) {
			$data_missing[] = 'Reaching Time';
		} else {
			$rea_time = $_POST['rea_time'];
		}

		if (empty($_POST['seats_sleeper'])) {
			$data_missing[] = 'Seats(Sleeper)';
		} else {
			$seats_sleeper = $_POST['seats_sleeper'];
		}
		if (empty($_POST['seats_ac'])) {
			$data_missing[] = 'Seats(AC)';
		} else {
			$seats_ac = $_POST['seats_ac'];
		}

		if (empty($_POST['price_sleeper'])) {
			$data_missing[] = 'Price(Sleeper)';
		} else {
			$price_sleeper = $_POST['price_sleeper'];
		}
		if (empty($_POST['price_ac'])) {
			$data_missing[] = 'Price(AC)';
		} else {
			$price_ac = $_POST['price_ac'];
		}

		if (empty($data_missing)) {
			require_once('Database Connection file/mysqli_connect.php');

			$query = "INSERT INTO train_details (train_no,from_city,to_city,departure_date,reaching_date,departure_time,reaching_time,seats_sleeper,seats_ac,price_sleeper,price_ac) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = mysqli_prepare($dbc, $query);
			mysqli_stmt_bind_param($stmt, "sssssssiiii", $train_no, $origin, $destination, $dep_date, $rea_date, $dep_time, $rea_time, $seats_sleeper, $seats_ac, $price_sleeper, $price_ac);
			mysqli_stmt_execute($stmt);
			$affected_rows = mysqli_stmt_affected_rows($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($dbc);
			if ($affected_rows == 1) {
				echo "Successfully Submitted";
				header("location: add_train_details.php?msg=success");
			} else {
				echo "Submit Error";
				header("location: add_train_details.php?msg=failed");
			}
		} else {
			echo "The following data fields were empty! <br>";
			foreach ($data_missing as $missing) {
				echo $missing . "<br>";
			}
		}
	} else {
		echo "Submit request not received";
	}
	?>
</body>

</html>