<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// connect to the database
$db = mysqli_connect('localhost','root','','photography');

?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>View Account</title>
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
								<h1>View Profile</h1>
                            </header>
							<div class="row gtr-200">
								<div class="col-12 col-12-medium">
<!--                                    Select all profile information-->
                                    <?php
                                    $email = $_SESSION['userSignIn'];
                                    $user_check_query = "SELECT * FROM all_user WHERE userId='$email'";
                                    $resultUser = mysqli_query($db, $user_check_query);
                                    $user = mysqli_fetch_assoc($resultUser);

                                    $customer_check_query = "SELECT * FROM customer WHERE userId='$email'";
                                    $resultCustomer = mysqli_query($db, $customer_check_query);
                                    $customer = mysqli_fetch_assoc($resultCustomer);
                                    ?>

									<!-- Form -->
										<form method="post" action="./signIn.php">
											<div class="row gtr-uniform">
                                                <div class="col-8 col-12-xsmall">
                                                    <h3>Account</h3>
                                                </div>
												<div class="col-12 col-12-xsmall">
                                                    <p><strong>Email :</strong>&nbsp; &nbsp;<?php echo $user['userId']; ?></p>
                                                </div>
                                                <div class="col-8 col-12-xsmall">
                                                    <h3>Profile</h3>
                                                </div>
												<div class="col-12 col-12-xsmall">
                                                    <p><strong>Name :</strong>&nbsp; &nbsp;<?php echo $customer ?></p>
                                                </div>
                                                <div class="col-12 col-12-xsmall">
                                                    <a href="forgotPasswordForm.php"><strong style="text-decoration:underline">Forgot password?</strong></a>
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