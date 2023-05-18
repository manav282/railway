<?php
session_start();
?>
<html>

<head>
    <title>
        Train Status
    </title>
    <style>
        label {
            font-weight: bold;
            padding-left: 100px;
            margin-left: 300px;
        }

        h3 {
            padding-left: 100px;
            margin-left: 300px;

        }

        h2 {
            padding-left: 100px;
            margin-left: 300px;
            margin-bottom: 0px;
        }

        input {
            border: 1.5px solid #030337;
            border-radius: 4px;
            padding: 7px 30px;
        }

        input[type=submit],
        button {
            background-color: #030337;
            color: white;
            border-radius: 4px;
            padding: 7px 45px;
            margin: 0px 390px
        }

        table {
            border-collapse: collapse;
        }

        tr {
            border: solid thin;
        }
    </style>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div>
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
                    echo "<a href=\"admin_homepage.php\"><i class=\"fa fa-ticket\" aria-hidden=\"true\"></i>Dashboard</a>";
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
        <br><br>
        <div style="margin-top:140px;">
            <?php
            if (isset($_POST['Search'])) {
                $data_missing = array();
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
                    $dep_date = trim($_POST['dep_date']);
                }

                if (empty($_POST['class'])) {
                    $data_missing[] = 'Class';
                } else {
                    $class = trim($_POST['class']);
                }

                if (empty($data_missing)) {
                    $_SESSION['class'] = $class;
                    $count = 1;
                    $_SESSION['count'] = $count;
                    $_SESSION['journey_date'] = $dep_date;
                    require_once('Database Connection file/mysqli_connect.php');
                    if ($class == "sleeper") {
                        $query = "SELECT train_no,from_city,to_city,departure_date,departure_time,reaching_date,reaching_time,seats_sleeper,price_sleeper FROM train_details where from_city=? and to_city=? and departure_date=? ORDER BY  departure_time";
                        $stmt = mysqli_prepare($dbc, $query);
                        mysqli_stmt_bind_param($stmt, "sss", $origin, $destination, $dep_date);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $train_no, $from_city, $to_city, $departure_date, $departure_time, $reaching_date, $reaching_time, $seats_sleeper, $price_sleeper);
                        mysqli_stmt_store_result($stmt);
                        if (mysqli_stmt_num_rows($stmt) == 0) {
                            echo "<div style=\"background-color:whitesmoke;color:#030337;width:fit-content;height:100px;padding:20px;margin-left:50px;margin-top:100px;\"><h1> No Trains are available from " . $origin . " to " . $destination . " on " . $dep_date . "</h1></div>";
                            echo "<a href=\"home_page.php\"> <button style=\"margin-left:500px;font-size:15px; margin-top: 20px;cursor:pointer;background-color:#030337;color:whitesmoke;\">Go Home</button></a>";
                        } else {
                            echo "<form action=\"home_page.php\" method=\"post\">";
                            echo "<table style=\"margin-left: 160px;color:navy;background-color:whitesmoke;\" cellpadding=\"13\">";
                            echo "<caption style=\"font-weight:bold;background-color:#030337;color:whitesmoke;font-size:\">Available Trains</caption>";
                            echo "<tr><th>Train No.</th>
							<th>Origin</th>
							<th>Destination</th>
							<th>Departure Date</th>
							<th>Departure Time</th>
							<th>Reaching Date</th>
							<th>Reaching Time</th>
                            <th>Seats(Sleeper)</th>
							<th>Price(Sleeper)</th>
							</tr>";
                            while (mysqli_stmt_fetch($stmt)) {
                                echo "<tr>
        						<td>" . $train_no . "</td>
        						<td>" . $from_city . "</td>
								<td>" . $to_city . "</td>
								<td>" . $departure_date . "</td>
								<td>" . $departure_time . "</td>
								<td>" . $reaching_date . "</td>
								<td>" . $reaching_time . "</td>
                                <td>" . $seats_sleeper . "</td>
								<td>&#x20b9; " . $price_sleeper . "</td>
        						</tr>";
                            }
                            echo "</table> <br>";
                            echo "<input style=\"margin-left:700px;font-size:15px; margin-top: 20px;cursor:pointer;\" type=\"submit\" value=\"Go Home\" name=\"Select\">";
                            echo "</form>";
                        }
                    } else if ($class = "ac") {
                        $query = "SELECT train_no,from_city,to_city,departure_date,departure_time,reaching_date,reaching_time,seats_ac,price_ac FROM train_details where from_city=? and to_city=? and departure_date=? ORDER BY  departure_time";
                        $stmt = mysqli_prepare($dbc, $query);
                        mysqli_stmt_bind_param($stmt, "sss", $origin, $destination, $dep_date);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $train_no, $from_city, $to_city, $departure_date, $departure_time, $reaching_date, $reaching_time, $seats_ac, $price_ac);
                        mysqli_stmt_store_result($stmt);
                        if (mysqli_stmt_num_rows($stmt) == 0) {
                            echo "<div style=\"background-color:whitesmoke;color:#030337;width:fit-content;height:100px;padding:20px;margin-left:50px;margin-top:100px;\"><h1> No Trains are available from " . $origin . " to " . $destination . " on " . $dep_date . "</h1></div>";
                            echo "<a href=\"home_page.php\"> <button style=\"margin-left:500px;font-size:15px; margin-top: 20px;cursor:pointer;background-color:#030337;color:whitesmoke;\">Go Home</button></a>";
                        } else {
                            echo "<form action=\"book_tickets2.php\" method=\"post\">";
                            echo "<table style=\"margin-left: 160px;color:navy;background-color:whitesmoke;\" cellpadding=\"13\">";
                            echo "<caption style=\"font-weight:bold;background-color:#030337;color:whitesmoke;\">Available Trains</caption>";
                            echo "<tr><th>Train No.</th>
								<th>Origin</th>
								<th>Destination</th>
								<th>Departure Date</th>
								<th>Departure Time</th>
								<th>Reaching Date</th>
								<th>Reaching Time</th>
                                <th>Seats(AC)</th>
								<th>Price(AC)</th>
								</tr>";
                            while (mysqli_stmt_fetch($stmt)) {
                                echo "<tr>
									<td>" . $train_no . "</td>
									<td>" . $from_city . "</td>
									<td>" . $to_city . "</td>
									<td>" . $departure_date . "</td>
									<td>" . $departure_time . "</td>
									<td>" . $reaching_date . "</td>
									<td>" . $reaching_time . "</td>
                                    <td>" . $seats_ac . "</td>
									<td>&#x20b9; " . $price_ac . "</td>
									</tr>";
                            }
                            echo "</table> <br>";
                            echo "<input style=\"margin-left:700px;font-size:15px; margin-top: 20px;cursor:pointer;\" type=\"submit\" value=\"Go Home\" name=\"Select\">";
                            echo "</form>";
                        }
                    }
                } else {
                    echo "The following data fields were empty! <br>";
                    foreach ($data_missing as $missing) {
                        echo $missing . "<br>";
                    }
                }
            } else {
                echo "Search request not received";
            }
            ?>
        </div>
    </div>
</body>

</html>