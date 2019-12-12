<!DOCTYPE HTML>

<html lang="en">
	<head>
		<title>Announcement Form</title>
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
								<h1>CREATE ANNOUNCEMENT</h1>
							</header>
							<div class="row gtr-200">
								<div class="col-12 col-12-medium">
									<!-- Form -->
										<form method="post" action="#">
											<div class="row gtr-uniform">
												<div class="col-12 col-12-xsmall">
													<input type="text" name="announcementTitle" id="announcementTitle" value="" placeholder="Announcement Title" />
												</div>
												<div class="col-12">
													<textarea name="demo-textarea" id="demo-textarea" placeholder="Announcement Details" rows="6"></textarea>
												</div>
												<!-- Break -->
												<div class="col-12">
													<ul class="actions">
														<li><input type="submit" value="Submit" class="primary" /></li>
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