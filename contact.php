<?php
session_start();
?>
<html>

<head>
    <title>
        Contact Us
    </title>
    <style type="text/css">
        input {
            border: 1.5px;
            border-radius: 4px;
            padding: 8px 50px;
        }

        .container {
            margin-top: 40px;
            margin-left: 20px;
            margin-right: 20px;
        }

        .header {
            border-radius: 20px 20px 0px 0px;
            padding: 5px 0px;
            background: #030337;
            color: whitesmoke;
            width: 100%;
            display: flex;
            align-content: center;
            justify-content: center;
            font-size: 12px;
        }

        .faq-item {
            margin: 10px;
        }

        .faq-body {
            display: none;
            width: 80%;
        }

        .faq-inner {
            padding: 30px;
            background: aliceblue;
        }

        .faq-plus {
            float: right;
            font-size: 1.4em;
            line-height: 1em;
            cursor: pointer;
        }

        hr {
            background-color: #9b9b9b;
        }
    </style>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    <div class="container">
        <div class="row">
            <div class="faq-wrapper">
                <div class="header">
                    <h1>FAQs</h1>
                </div>
                <div class="faq-inner">
                    <div class="faq-item">
                        <h3>
                            Is ID Proof Required for Booking ?
                            <span class="faq-plus">&plus;</span>
                        </h3>
                        <div class="faq-body">
                            No at the time of booking but required during train journey.
                        </div>
                    </div>
                    <hr>
                    <div class="faq-item">
                        <h3>
                            Authority to Travel
                            <span class="faq-plus">&plus;</span>
                        </h3>
                        <div class="faq-body">
                            Electronic Reservation Slip - printed in standard stationery/VRM/SMS sent by IRCTC along
                            with the original ID of one of the passenger traveling on a PNR.
                        </div>
                    </div>
                    <hr>
                    <div class="faq-item">
                        <h3>
                            Is username change permissible ?
                            <span class="faq-plus">&plus;</span>
                        </h3>
                        <div class="faq-body">
                            No, only password can be changed.
                        </div>
                    </div>
                    <hr>
                    <div class="faq-item">
                        <h3>
                            How can I cancel e-ticket and how will I get refund?
                            <span class="faq-plus">&plus;</span>
                        </h3>
                        <div class="faq-body">
                            Login to your profile, got to "Cancel ticket" section, Enter PNR of the ticket to be
                            cancelled. 85% of the amount will be refunded to your account within 3 to 5 working days.
                        </div>
                    </div>
                    <hr>
                    <div class="faq-item">
                        <h3>
                            How can I make payment to book e-ticket?
                            <span class="faq-plus">&plus;</span>
                        </h3>
                        <div class="faq-body">
                            All payment options have been grouped under specific categories (viz. Credit cards, Net
                            banking, Wallets and Multiple payment service etc.) Select the desired Payment Option from
                            the displayed Payment gateway menus. Click on "Make Payment" button for redirection to
                            selected Bank website.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".faq-plus").on('click', function () {
            $(this).parent().parent().find('.faq-body').slideToggle();
        });
    </script>
    <div style="display:flex;margin-top:20px;justify-content:space-around;">
        <div>
            <form class="float_form" style="font-size:22px;"
                action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <fieldset style="padding: 10px;background-color:whitesmoke;margin-left:50px;margin-top:30px;">
                    <legend style="background-color:#030337;color:whitesmoke;">
                        <h3><i class="fa fa-question-circle" aria-hidden="true"></i>
                            HAVE QUERY</h3>
                    </legend>
                    <table cellpadding='10'>
                        <tr>
                            <td>Enter your email ID</td>
                            <td><input type="email" name="email" required></td>
                        </tr>
                        <tr>
                            <td>Enter your query</td>
                            <td><input type="text" name="query" required></td>
                        </tr>
                        <tr>
                            <td>*Please specify PNR number in case of any booking query</td>
                        </tr>
                    </table>
                    <br>
                    <input type="submit" style="margin-left: 300px;cursor:pointer;" value="Submit" name="Submit">
                    <br>
                </fieldset>
            </form>
        </div>
        <div
            style="background-color:whitesmoke;height:fit-content;width:fit-content;color:#030337;margin-top:70px;border:10px solid #030337;border-radius:5px;padding:5px;">
            <div>
                <p><b>Helpline Number: </b><i class="fa fa-phone" aria-hidden="true"></i>139
            </div>
            <div>
                <p><b>I-tickets/e-tickets:</b> <a href="mailto:care@irctc.co.in">care@irctc.co.in</a></p>
                <p><b>For Cancellation E-tickets:</b> <a href="mailto:etickets@irctc.co.in">etickets@irctc.co.in</a></p>
            </div>
            <div>
                <span style="margin-left:32px;"><a href="https://www.facebook.com/IRCTCofficial/"><i
                            class="fa fa-brands fa-facebook fa-3x" aria-hidden="true"></i></a></span>
                <span style="margin-left:32px;"><a href="https://twitter.com/IRCTCofficial"><i
                            class="fa fa-brands fa-twitter fa-3x" aria-hidden="true"></i></a></span>
                <span style="margin-left:32px;"><a href="https://www.linkedin.com/company/irctcofficial/"><i
                            class="fa fa-brands fa-linkedin fa-3x" aria-hidden="true"></i></a></span>
                <span style="margin-left:32px;"><a href="https://www.instagram.com/irctcofficial/"><i
                            class="fa fa-brands fa-instagram fa-3x" aria-hidden="true"></i></a></span>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['Submit'])) {
        $email = $_POST['email'];
        $query_asked = $_POST['query'];

        require_once('Database Connection file/mysqli_connect.php');
        $query = "INSERT INTO queries (email,query) VALUES (?,?)";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $query_asked);
        mysqli_stmt_execute($stmt);
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        if ($affected_rows == 1) {
            echo '<script type ="text/JavaScript">';
            echo 'alert("Submitted Successfully")';
            echo '</script>';
        } else {
            echo '<script type ="text/JavaScript">';
            echo 'alert("Submit Error")';
            echo '</script>';
        }
    }

    ?>
</body>

</html>