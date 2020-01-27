<?php include 'serverSignOut.php';?>
<?php
//if (isset($_SESSION['userSignIn'])) {?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Sign Out</title>
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
								<h1>Sign Out</h1>
                                <p>Are You Sure You Want to Exit?</p>
							<div class="row gtr-200">
								<div class="col-12 col-12-medium">

                                    <!-- Form -->
                                    <form method="post" action="signOut.php">
                                        <div class="row gtr-uniform">
                                    <div class="col-12">
                                        <ul class="actions">
                                            <li><button type="submit" value="SignOut" class="primary" name="signOut_user">Sign Out</button></li>
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
			<script src="../../assets/js/jquery.min.js"></script>
			<script src="../../assets/js/jquery.dropotron.min.js"></script>
			<script src="../../assets/js/browser.min.js"></script>
			<script src="../../assets/js/breakpoints.min.js"></script>
			<script src="../../assets/js/util.js"></script>
			<script src="../../assets/js/main.js"></script>

	</body>
</html>