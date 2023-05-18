<?php
session_start();
?>
<html>

<head>
    <title>
        Welcome
    </title>
    <style>
        table,
        td,
        tr {
            border: 2px solid #030337;
        }

        td {
            font-size: 20px;
        }

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
            margin: 0px 127px
        }
    </style>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    $password = $email_id = $phone = "";
    $passwordErr = $emailErr = $phoneErr = "";
    $flag = 0;
    $user = $_SESSION['login_user'];

    if (isset($_POST['Submit'])) {

        if (empty($_POST['password'])) {
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
                require_once('Database Connection file/mysqli_connect.php');
                $query = "UPDATE users SET pwd=? WHERE user_id=?";
                $stmt = mysqli_prepare($dbc, $query);
                mysqli_stmt_bind_param($stmt, "ss", $password, $user);
                mysqli_stmt_execute($stmt);
                $affected_rows = mysqli_stmt_affected_rows($stmt);
                if ($affected_rows == 1) {
                    $flag = 1;
                    $passwordErr = 'Password updated successfully';
                    $password = "";
                }
                mysqli_stmt_close($stmt);
            }
        }

        if (empty($_POST['email'])) {
            $flag = 0;
        } else {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Enter valid email address";
                $flag = 0;
            } else {
                $email_id = trim($_POST['email']);
                require_once('Database Connection file/mysqli_connect.php');
                $query = "UPDATE users SET email=? WHERE user_id=?";
                $stmt = mysqli_prepare($dbc, $query);
                mysqli_stmt_bind_param($stmt, "ss", $email_id, $user);
                mysqli_stmt_execute($stmt);
                $affected_rows = mysqli_stmt_affected_rows($stmt);
                if ($affected_rows == 1) {
                    $flag = 1;
                    $emailErr = 'Email ID updated successfully';
                    $email_id = "";
                }
                mysqli_stmt_close($stmt);
            }
        }

        if (empty($_POST['phone_no'])) {
            $flag = 0;
        } else {
            if (preg_match('/^[0-9]+$/', $_POST['phone_no']) && strlen($_POST['phone_no']) != 10) {
                $phoneErr = "Enter valid phone number";
                $flag = 0;
            } else {
                $phone = trim($_POST['phone_no']);
                require_once('Database Connection file/mysqli_connect.php');
                $query = "UPDATE users SET phone_no=? WHERE user_id=?";
                $stmt = mysqli_prepare($dbc, $query);
                mysqli_stmt_bind_param($stmt, "ss", $phone, $user);
                mysqli_stmt_execute($stmt);
                $affected_rows = mysqli_stmt_affected_rows($stmt);
                if ($affected_rows == 1) {
                    $flag = 1;
                    $phoneErr = 'Mobile Number updated successfully';
                    $phone = "";
                }
                mysqli_stmt_close($stmt);
            }
        }
    }
    ?>
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
    <div style="width:500px;margin-top:150px;margin-left:auto;margin-right:auto;">
        <?php
        echo "<fieldset style=\"margin: 50px;background-color:whitesmoke;color:whitesmoke;\"><legend style=\"background-color:#030337;\"><h2>Welcome " . $_SESSION['login_user'] . " </h2></legend>";

        require_once('Database Connection file/mysqli_connect.php');
        $query = "SELECT email,phone_no,pwd FROM users WHERE user_id=?";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $mail, $mobile_no, $pwd);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        ?>
        <form class="float_form" style="font-size:22px;margin-top:20px;"
            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <table cellpadding="5">
                <tr>
                    <td>
                        Your Email ID
                    </td>
                    <td>
                        <?php echo $mail; ?>
                    </td>
                    <td>
                        <input type="text" name="email" value="<?php echo $email_id; ?>"
                            placeholder="Enter new email id"><span class="Error">
                            <?php echo $emailErr; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Your Mobile Number
                    </td>
                    <td>
                        <?php echo $mobile_no; ?>
                    </td>
                    <td>
                        <input type="text" name="phone_no" value="<?php echo $phone; ?>"
                            placeholder="Enter new mobile no"><span class="Error">
                            <?php echo $phoneErr; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Your password
                    </td>
                    <td>
                        <?php echo $pwd; ?>
                    </td>
                    <td>
                        <input type="password" name="password" value="<?php echo $password; ?>"
                            placeholder="Enter new password"><span class="Error">
                            <?php echo $passwordErr; ?>
                    </td>
                </tr>
            </table>
            <input type="submit" style="margin-left: 160px;cursor:pointer;margin-top:30px;" value="Update"
                name="Submit">
        </form>
    </div>
</body>

</html>