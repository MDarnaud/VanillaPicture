<?php include 'countrieslist.php';
        include 'serversignup.php'; ?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Register</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="../assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Header -->
		<header id="header" class="alt">
			<nav id="nav">
				<ul>
					<li class="current"><a href="../homepage.php">Home</a></li>
					<li>
						<a href="" class="dropdown">Portfolio</a>
						<ul>
							<li><a href="C:\wamp64\www\finalProject\dark\gallery.html">Gallery</a></li>
						</ul>
					</li>
					<li><a href="../announcement.php">Announcement</a></li>
					<li><a href="../agenda.php">Agenda</a></li>
					<li><a href="../packages.php">Packages</a></li>
					<li><a href="../reservation.php">Request a Shoot</a></li>
					<li><a href="../signIn/signIn.php" class="icon fa-user-circle">Sign in</a></li>
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
                                <?php include "errorssignup.php" ?>
							</header>
                        <div style="margin:auto">
							<div class="row gtr-200">
									<!-- Form -->
										<h3>Register</h3>
										<form method="post" action="register.php">
											<div class="row gtr-uniform">
                                                <div class="col-8 col-12-xsmall">
                                                    <input type="email" name="email" id="email" value="" placeholder="Email" required/>
                                                </div>
												<div class="col-8 col-12-xsmall">
													<input type="password" name="password_1" id="password_1" value="" placeholder="Password"
                                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}"
                                                           title="Password must contain between 6 and 20 characters, including UPPER/lowercase and numbers"
                                                           required/>
												</div>
                                                <div class="col-8 col-12-xsmall">
                                                    <input type="password" name="password_2" id="password_2" value="" placeholder="Confirm Password"
                                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}"
                                                           title="Please enter the same Password as above"
                                                           oninput="check(this)"
                                                           required/>
                                                    <script language='javascript' type='text/javascript'>
                                                        function check(input) {
                                                            if (input.value != document.getElementById('password_1').value) {
                                                                input.setCustomValidity('Password Must Match.');
                                                            } else {
                                                                // input is valid -- reset the error message
                                                                input.setCustomValidity('');
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                                <div class="col-8 col-12-xsmall">
                                                    <h3>About you...</h3>
                                                </div>
                                                <div class="col-8 col-12-xsmall">
                                                    <input type="text" name="firstName" id="firstName" value="" placeholder="First Name"
                                                           maxlength="20" required/>
                                                </div>
                                                <div class="col-8 col-12-xsmall">
                                                    <input type="text" name="lastName" id="lastName" value="" placeholder="Last Name"
                                                           maxlength="20" required/>
                                                </div>
												<div class="col-8 col-12-xsmall">
													<p>Date of Birth</p>
													<input type="date" name="dob" id="dob" value="" placeholder="Date of Birth" required/>
												</div>
												<div class="col-8 col-12-xsmall">
<!--													<input type="text" name="demo-name" id="demo-country" value="" placeholder="Country" />-->
												        <select name="country" id="country">
                                                            <option value="" selected hidden>-Select Country-</option>
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
                                                    <input type="text" name="city" id="city" value="" placeholder="City" required/>
                                                </div>
												<!-- Break -->
												<div class="col-12">
													<ul class="actions">
                                                        <li><button type="submit" value="Signup" class="primary" name="reg_user">Sign up</button></li>
                                                        <li><button onclick="location.href='../signIn/signIn.php'" type="reset" value="Cancel">Cancel</button></li>
													</ul>
												</div>
											</div>
										</form>
							</div>
						</div>
                        <p>
                            Already a member? <a href="../signIn/signIn.php">Sign in</a>
                        </p>
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
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.dropotron.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>

