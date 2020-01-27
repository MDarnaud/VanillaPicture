<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'sendEmailForgotPassword.php'; ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Forgot Password</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="../../assets/css/main.css" />
</head>
<body class="is-preload">

<?php include '../Navigation/navigation.php' ?>

<!-- Main -->
<div id="main">
    <div class="wrapper">
        <div class="inner">

            <!-- Elements -->
            <header class="major">
                <h1>Find Your Password</h1>
                <p> An email will be sent with a new password.</p>
                <?php include 'errorsSignIn.php' ?>
            </header>
            <div class="row gtr-200">
                <div class="col-12 col-12-medium">

                    <!-- Form -->
                    <form method="post" action="forgotPasswordForm.php">
                        <div class="row gtr-uniform">
                            <div class="col-12 col-12-xsmall">
                                <h5 class="TitleForm">Email:</h5>
                                <?php if(isset($_SESSION["userNewAccount"])  && !(isset($_GET["cancel"]))):?>
                                    <input type="email" name="email" id="email" value="<?php echo $_SESSION['userNewAccount']; ?>" placeholder="Email" required oninvalid="setCustomValidity('Email is invalid')" oninput="setCustomValidity('')"/>
                                <?php else:?>
                                    <input type="email" name="email" id="email" value="" placeholder="Email" required oninvalid="setCustomValidity('Email is invalid')" oninput="setCustomValidity('')"/>
                                <?php  endif; ?>
                            </div>
                        </div>
                        <br>
                        <!-- Break -->
                        <div class="col-12">
                            <ul class="actions">
                                <li><button type="submit" value="SignIn" class="primary" name="forgot_password">Submit</button></li>
                                <li><button type="reset" value="Cancel" onclick="window.location.href='signIn.php'">Cancel</button></li>
                            </ul>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Footer -->
<div id="footer">
    <div class="wrapper style2">
        <div class="copyright">
            &copy; Untitled. All rights reserved. Lorem ipsum dolor sit amet.
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/jquery.dropotron.min.js"></script>
<script src="../../assets/js/browser.min.js"></script>
<script src="../../assets/js/breakpoints.min.js"></script>
<script src="../../assets/js/util.js"></script>
<script src="../../assets/js/main.js"></script>

</body>
</html>
