<?php
session_start();
?>
<html>

<head>
	<title>
		Account Login
	</title>
	<style>
		input {
			border: 1.5px;
			border-radius: 4px;
			padding: 7px 30px;
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
			if (isset($_SESSION['login_user']) && $_SESSION['user_type'] == 'Customer') {
				echo "<a href=\"customer_homepage.php\"><i class=\"fa fa-sign-in\" aria-hidden=\"true\"></i> Login</a>";
			} else if (isset($_SESSION['login_user']) && $_SESSION['user_type'] == 'Administrator') {
				echo "<a href=\"admin_homepage.php\"><i class=\"fa fa-sign-in\" aria-hidden=\"true\"></i> Login</a>";
			} else {
				echo "<a href=\"login_page.php\"><i class=\"fa fa-sign-in\" aria-hidden=\"true\"></i> Login</a>";
			}
			?>
		</div>
	</div>
	<br><br>
	<div style="margin-top:30px;">
		<form class="float_form" style="padding-left: 200px; font-size: 20px;" action="login_handler.php" method="POST">
			<fieldset style="padding: 40px;background-color:whitesmoke;">
				<legend style="background-color:#030337;">
					<h4 style="color:whitesmoke;">Login Details</h4>
				</legend>
				<strong>Username:</strong><br>
				<input type="text" name="username" placeholder="Enter your username" required><br><br>
				<strong>Password:</strong><br>
				<input type="password" name="password" placeholder="Enter your password" required><br><br>
				<strong>User Type:</strong><br>
				<input type='radio' style="margin-right:10px;font-size:15px;" name='user_type' value='Customer'
					checked />Customer<br>
				<input type='radio' style="margin-right:10px;font-size:15px;" name='user_type'
					value='Administrator' />Admin
				<br>
				<?php
				if (isset($_GET['msg']) && $_GET['msg'] == 'failed') {
					echo "<br>
						<strong style='color:red'>Invalid Username/Password</strong>
						<br><br>";
				}
				?>
				<br>
				<input type="submit" style="margin-left: 55px;cursor:pointer;font-size:15px;" name="Login"
					value="Login">
			</fieldset>
			<br>
			<a href="new_user.php" style="color:whitesmoke;"><i class="fa fa-user-plus" aria-hidden="true"></i> Creat
				New User Account?</a>
		</form>
	</div>
</body>

</html>