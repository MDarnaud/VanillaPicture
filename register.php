<!DOCTYPE HTML>
<?php include 'countrieslist.php'?>
<html lang="en">
	<head>
		<title>Register</title>
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
					<li><a href="reservation.php">Request a Shoot</a></li>
					<li><a href="login.php" class="icon fa-user-circle"> Login</a></li>
				</ul>
			</nav>
		</header>

		<!-- Main -->
			<div id="main">
				<div class="wrapper">
					<div class="inner">
						<!-- Elements -->
							<header class="major">
								<h1>Sign up</h1>
								<p>Create a new account here</p>
							</header>

							<div class="row gtr-200">
								<div class="col-6 col-12-medium">
									<!-- Form -->
										<h3>Register</h3>
										<form method="post" action="#">
											<div class="row gtr-uniform ">

												<div class="col-8 col-12-xsmall">
													<input type="text" name="demo-name" id="demo-name" value="" placeholder="Username" />
                                                </div>
												<div class="col-8 col-12-xsmall">
													<input type="password" name="demo-password" id="demo-password" value="" placeholder="Password" />
												</div>
												<div class="col-8 col-12-xsmall">
													<input type="email" name="demo-email" id="demo-email" value="" placeholder="Email" />
												</div>
                                                <div class="col-8 col-12-xsmall">
                                                    <h3>About you...</h3>
                                                </div>
                                                <div class="col-8 col-12-xsmall">
                                                    <input type="text" name="demo-firstname" id="demo-firstname" value="" placeholder="First Name" />
                                                </div>
                                                <div class="col-8 col-12-xsmall">
                                                    <input type="text" name="demo-lastname" id="demo-lastname" value="" placeholder="Last Name" />
                                                </div>
												<div class="col-8 col-12-xsmall">
													<p>Date of Birth</p>
													<input type="date" name="demo-dob" id="demo-dob" value="" placeholder="Date of Birth" />
												</div>
												<div class="col-8 col-12-xsmall">
													<input type="text" name="demo-name" id="demo-address" value="" placeholder="Address" />
												</div>
												<div class="col-8 col-12-xsmall">
<!--													<input type="text" name="demo-name" id="demo-country" value="" placeholder="Country" />-->
												        <select name="countries">
                                                            <option value="" selected disabled hidden>-Select Country-</option>
                                                            <?php
                                                            foreach($countries as $key => $value) {
                                                                ?>
                                                                <option value="<?= $key ?>" title="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($value) ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                </div>
												<div class="col-8 col-12-xsmall">
													<input type="text" name="demo-name" id="demo-state" value="" placeholder="State" />
												</div>
												<!-- Break -->
												<div class="col-12">
													<ul class="actions">
														<li><input type="submit" value="Sign up" class="primary" /></li>
														<li><input type="reset" value="Reset" /></li>
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