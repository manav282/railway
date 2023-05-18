<?php
session_start();
?>
<html>

<head>
    <title>
        PNR Status
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
            margin: 0px 68px
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
        <div><a href="home_page.php"><i class="fa fa-home"></i> Home</a></div>
        <div>
            <?php
            if (isset($_SESSION['login_user']) && $_SESSION['user_type'] == 'Customer') {
                echo "<a href=\"customer_homepage.php\"><i class=\"fa fa-desktop\" aria-hidden=\"true\"></i>Dashboard</a>";
            } else if (isset($_SESSION['login_user']) && $_SESSION['user_type'] == 'Administrator') {
                echo "<a href=\"admin_homepage.php\"><i class=\"fa fa-desktop\" aria-hidden=\"true\"></i>Dashboard</a>";
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
    <form action="pnr_form_handler.php" method="post">
        <fieldset style="margin-left:400px; width:40%;background-color:whitesmoke;margin-top:200px;">
            <legend style="background-color:#030337;">
                <h2 style="color:whitesmoke;">PNR Status</h2>
            </legend>
            <?php
            if (isset($_GET['msg']) && $_GET['msg'] == 'failed') {
                echo "<strong style='color: red'>*Invalid PNR, please enter PNR again</strong>
						<br>
						<br>";
            }
            ?>
            <table cellpadding="5" style="padding-left: 30px;">
                <tr>
                    <td class="fix_table">Enter the PNR</td>
                </tr>
                <tr>
                    <td class="fix_table"><input type="text" name="pnr" required></td>
                </tr>
            </table>
            <br>
            <input type="submit" value="Check Status" name="Check_PNR">
        </fieldset>
    </form>
</body>

</html>