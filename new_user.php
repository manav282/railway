<html>

<head>
	<title>
		Create New User Account
	</title>
	<style>
		input {
			border: 1.5px;
			border-radius: 4px;
			padding: 8px 50px;
		}

		.error {
			color: red;
		}
	</style>
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<?php
	$user = $password = $email = $name = $phone = $address = "";
	$userErr = $passwordErr = $emailErr = $nameErr = $phoneErr = $addressErr = "";
	$flag = 1;

	if (isset($_POST['Submit'])) {
		if (empty($_POST['username'])) {
			$userErr = "Required";
			$flag = 0;
		} else {
			$user = trim($_POST['username']);
		}
		if (empty($_POST['password'])) {
			$passwordErr = "Required";
			$flag = 0;
		} else {
			$uppercase = preg_match('/[A-Z]/', $_POST['password']);
			$lowercase = preg_match('/[a-z]/', $_POST['password']);
			$number = preg_match('/[0-9]/', $_POST['password']);
			$specialChars = preg_match('/[^\w]/', $_POST['password']);
			if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST['password']) < 8) {
				$passwordErr = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
				$flag = 0;
			} else {
				$password = trim($_POST['password']);
			}
		}
		if (empty($_POST['email'])) {
			$emailErr = "Required";
			$flag = 0;
		} else {
			if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Enter valid email address";
				$flag = 0;
			} else {
				$email = trim($_POST['email']);
			}
		}

		if (empty($_POST['name'])) {
			$nameErr = "Required";
			$flag = 0;
		} else {
			if (preg_match("/^[A-Za-z]+$/", $_POST['name'])) {
				$name = $_POST['name'];
			} else {
				$nameErr = "Only alphabets are allowed";
				$flag = 0;
			}
		}
		if (empty($_POST['phone_no'])) {
			$phoneErr = "Required";
			$flag = 0;
		} else {
			if (preg_match('/^[0-9]+$/', $_POST['phone_no']) && strlen($_POST['phone_no']) != 10) {
				$phoneErr = "Enter valid phone number";
				$flag = 0;
			} else {
				$phone = trim($_POST['phone_no']);
			}
		}
		if (empty($_POST['address'])) {
			$addressErr = "Required";
			$flag = 0;
		} else {
			$address = $_POST['address'];
		}


		if ($flag == 1) {
			require_once('Database Connection file/mysqli_connect.php');
			$query2 = "SELECT count(*) from users WHERE user_id=?";
			$stmt2 = mysqli_prepare($dbc, $query2);
			mysqli_stmt_bind_param($stmt2, "s", $user);
			mysqli_stmt_execute($stmt2);
			mysqli_stmt_bind_result($stmt2, $cnt);
			mysqli_stmt_fetch($stmt2);
			mysqli_stmt_close($stmt2);

			if ($cnt == 0) {
				$query = "INSERT INTO users (user_id,pwd,name,email,phone_no,address) VALUES (?,?,?,?,?,?)";
				$stmt = mysqli_prepare($dbc, $query);
				mysqli_stmt_bind_param($stmt, "ssssss", $user, $password, $name, $email, $phone, $address);
				mysqli_stmt_execute($stmt);
				$affected_rows = mysqli_stmt_affected_rows($stmt);
				mysqli_stmt_close($stmt);
				mysqli_close($dbc);
				if ($affected_rows == 1) {
					header('location:user_reg_success.php');
				} else {
					echo "Submit Error";
				}
			} else {

				echo '<script type ="text/JavaScript">';
				echo 'alert("Duplicate User ID")';
				echo '</script>';
			}

		}
	}
	?>
	<div class="navbar">
		<span id="title">
			MyRailway
		</span>
		<div><a href="home_page.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></div>
		<div>
			<?php
			if (isset($_SESSION['login_user']) && $_SESSION['user_type'] == 'Customer') {
				echo "<a href=\"book_tickets.php\"><i class=\"fa fa-desktop\" aria-hidden=\"true\"></i> Dashboard</a>";
			} else if (isset($_SESSION['login_user']) && $_SESSION['user_type'] == 'Administrator') {
				echo "<a href=\"admin_homepage.php\"><i class=\"fa fa-desktop\" aria-hidden=\"true\"></i> Dashboard</a>";
			} else {
				echo "<a href=\"login_page.php\"><i class=\"fa fa-ticket\" aria-hidden=\"true\"></i> Book Tickets</a>";
			}
			?>
		</div>
		<div><a href="pnr.php"><i class="fa fa-solid fa-check" aria-hidden="true"></i>PNR Status</a></div>
		<div><a href="contact.php"><i class="fa fa-phone" aria-hidden="true"></i> Contact Us</a></div>
		<div>
			<?php
			echo "<a href=\"login_page.php\"><i class=\"fa fa-sign-in\" aria-hidden=\"true\"></i> Login</a>";
			?>
		</div>
	</div>
	<br>
	<form class="float_form" style="font-size:22px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
		method="POST">
		<fieldset style="padding: 10px;background-color:whitesmoke;margin-left:150px">
			<legend style="background-color:#030337;color:whitesmoke;">
				<h3><i class="fa fa-user-plus" aria-hidden="true"></i> CREATE NEW USER ACCOUNT</h3>
			</legend>
			<table cellpadding='10'>
				<strong>ENTER LOGIN DETAILS</strong>
				<tr>
					<td>Enter a valid username </td>
					<td><input type="text" name="username" value="<?php echo $user; ?>"><span class="Error">
							<?php echo $userErr; ?><br><br></td>
				</tr>
				<tr>
					<td>Enter your desired password </td>
					<td><input type="password" name="password" value="<?php echo $password; ?>"><span class="Error">
							<?php echo $passwordErr; ?><br><br></td>
				</tr>
				<tr>
					<td>Enter your email ID</td>
					<td><input type="text" name="email" value="<?php echo $email; ?>"><span class="Error">
							<?php echo $emailErr; ?><br><br></td>
				</tr>
			</table>
			<br>
			<table cellpadding='10'>
				<strong>ENTER CUSTOMER'S PERSONAL DETAILS</strong>
				<tr>
					<td>Enter your name </td>
					<td><input type="text" name="name" value="<?php echo $name; ?>"><span class="Error">
							<?php echo $nameErr; ?><br><br></td>
				</tr>
				<tr>
					<td>Enter your phone no.</td>
					<td><input type="text" name="phone_no" value="<?php echo $phone; ?>"><span class="Error">
							<?php echo $phoneErr; ?><br><br></td>
				</tr>
				<tr>
					<td>Enter your address</td>
					<td><input type="text" name="address" value="<?php echo $address; ?>"><span class="Error">
							<?php echo $addressErr; ?><br><br></td>
				</tr>
			</table>
			<br>
			<input type="submit" style="margin-left: 135px;cursor:pointer;" value="Submit" name="Submit">
			<br>
		</fieldset>
	</form>
</body>

</html>