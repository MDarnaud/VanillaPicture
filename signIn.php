<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'serverSignIn.php'; ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Sign in</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

    <?php include './navigation/navigation.php' ?>

		<!-- Main -->
			<div id="main">
				<div class="wrapper">
					<div class="inner">

						<!-- Elements -->
							<header class="major">
								<h1>Sign In</h1>
                                <p>Not a member yet? Register <a href="registration/register.php"><strong style="color:cadetblue; text-decoration:underline">HERE</strong></a></p>
                                <?php if(isset($_SESSION["userNewAccount"]) && !(isset($_GET["cancel"]))):?>
                                    <p>Sign in to your new account.</p>
                                <?php  endif; ?>
                                <?php include 'errorssignin.php' ?>
								     </header>
							<div class="row gtr-200">
								<div class="col-12 col-12-medium">

									<!-- Form -->
										<form method="post" action="signIn.php">
											<div class="row gtr-uniform">
												<div class="col-12 col-12-xsmall">
                                                    <?php if(isset($_SESSION["userNewAccount"])  && !(isset($_GET["cancel"]))):?>
                                                        <input type="email" name="email" id="email" value="<?php echo $_SESSION['userNewAccount']; ?>" placeholder="Email" required/>
                                                    <?php else:?>
                                                    <input type="email" name="email" id="email" value="" placeholder="Email" required/>
                                                    <?php  endif; ?>
                                                </div>
												<div class="col-12 col-12-xsmall">
                                                    <input type="password" name="password_1" id="password_1" value="" placeholder="Password"
                                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}"
                                                           title="Password must contain between 6 and 20 characters, including UPPER/lowercase and numbers"
                                                           oninput="check(this)"
                                                           required/>
                                                    <script language='javascript' type='text/javascript'>
                                                        function check(input) {
                                                            <?php if (isset($_COOKIE['invalidPW'])) : ?>
                                                                input.setCustomValidity('Invalid Password.');
                                                            <?php else : ?>
                                                                // input is valid -- reset the error message
                                                                input.setCustomValidity('');
                                                            <?php endif; ?>
                                                        }
                                                    </script>
                                                </div>
                                                <div class="col-12 col-12-xsmall">
                                                    <a href="forgotPasswordForm.php"><strong style="text-decoration:underline">Forgot password?</strong></a>
                                                    or
                                                    <a href="changePasswordForm.php"><strong style="text-decoration:underline">Change password.</strong></a>
                                                </div>
												<!-- Break -->
												<div class="col-12">
													<ul class="actions">
                                                        <li><button type="submit" value="SignIn" class="primary" name="signIn_user">Sign In</button></li>
                                                        <li><button type="reset" value="Cancel" onclick="goBack()">Cancel</button></li>
                                                        <script language='javascript' type='text/javascript'>
                                                            function goBack() {
                                                                window.history.back();
                                                            }
                                                        </script>
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
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>