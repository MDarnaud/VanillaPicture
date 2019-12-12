<?php session_start(); ?>
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

		<!-- Header -->
		<header id="header" class="alt">
			<nav id="nav">
				<ul>
					<li class="current"><a href="homepage.php">Home</a></li>
					<li>
						<a href="" class="dropdown">Portfolio</a>
						<ul>
							<li><a href="C:\wamp64\www\finalProject\dark\gallery.html">Gallery</a></li>
						</ul>
					</li>
					<li><a href="announcement.php">Announcement</a></li>
					<li><a href="agenda.php">Agenda</a></li>
					<li><a href="packages.php">Packages</a></li>
					<li><a href="request.php">Request a Shoot</a></li>
					<li><a href="signin.php" class="icon fa-user-circle">Sign in</a></li>
				</ul>
			</nav>
		</header>

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
								     </header>
							<div class="row gtr-200">
								<div class="col-12 col-12-medium">

									<!-- Form -->
										<form method="post" action="../homepage.php">
											<div class="row gtr-uniform">
												<div class="col-12 col-12-xsmall">
                                                    <?php if(isset($_SESSION["userNewAccount"])  && !(isset($_GET["cancel"]))):?>
                                                        <input type="email" name="email" id="email" value="<?php echo $_SESSION['userNewAccount']; ?>" placeholder="Email" required/>
                                                    <?php else:?>
                                                    <input type="email" name="email" id="email" value="" placeholder="Email" required/>
                                                    <?php  endif; ?>
                                                </div>
												<div class="col-12 col-12-xsmall">
                                                    <input type="password" name="password" id="password" value="" placeholder="Password"
                                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}"
                                                           title="Password must contain between 6 and 20 characters, including UPPER/lowercase and numbers"
                                                           required/>
                                                </div>
												<!-- Break -->
												<div class="col-12">
													<ul class="actions">
                                                        <li><button type="submit" value="Signup" class="primary" name="reg_user">Sign up</button></li>
                                                        <li><input type="reset" value="Cancel"/></li>
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