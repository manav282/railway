<html>

<head>
	<title>
		Register Success
	</title>
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
				echo "<a href=\"login_page.php\"><i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i> Logout</a>";
			} else if (isset($_SESSION['login_user']) && $_SESSION['user_type'] == 'Administrator') {
				echo "<a href=\"login_page.php\"><i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i> Logout</a>";
			} else {
				echo "<a href=\"login_page.php\"><i class=\"fa fa-sign-in\" aria-hidden=\"true\"></i> Login</a>";
			}
			?>
		</div>
	</div>
	<br>
	<h1 style="margin-top:100px;"></h1>
	<div style="margin-top:230px">
		<fieldset style="margin: 20px; background-color:#90eea8;">
			<h2>New user successfully registered! <i class="fa fa-check-square"></i></h2>
			<h3>Login into your account to book tickets.</h3>
		</fieldset>
	</div>
</body>

</html>