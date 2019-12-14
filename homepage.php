<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Vanilla Picture</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

    <?php include './navigation/navigation.php' ?>

		<!-- Banner -->
			<div id="banner">
				<div class="wrapper style1 special">
					<div class="inner">
						<h1 class="heading alt">VANILLA PICTURE</h1>
						<p>Lorem feugiat consequat phasellus ultrices nulla quis nibh lorem ligula</p>
						<div class="image fit special">
							<img src="images/pic01.jpg" alt="" />
						</div>
						<ul class="feature-icons">
							<li><span class="icon fa-instagram"></span><span class="label">Magna aliquam</span></li>
							<li><span class="icon fa-facebook"></span><span class="label">Etiam feugiat</span></li>
							<li><span class="icon fa-envelope"></span><span class="label">Nisl adipiscing</span></li>
						</ul>
					</div>
				</div>
			</div>

		<!-- One -->
			<div id="one">
				<div class="wrapper special">
					<div class="inner">
						<header class="major">
							<h2>BIOGRAPHY</h2>
						</header>
						<div class="image fit special">
							<img src="images/pic02.jpg" alt="" />
						</div>
						<p class="special">Sed egestas, ante et vulputate volutpat pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum lorem ipsum dolor sit amet consequat hendrerit tortor semper lorem at felis.</p>
						<ul class="actions">
							<li><a href="#" class="button">Contact</a></li>
						</ul>
					</div>
				</div>
			</div>


		

		<!-- Footer -->
			<div id="footer">
				<div class="wrapper style2">
					<div class="inner">
						<header class="major">
							<h2>Get in touch</h2>
							<p>Sed egestas, ante et vulputate volutpat pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum lorem ipsum dolor sit amet consequat hendrerit tortor semper lorem at felis.</p>
						</header>
						<div class="content">
							<div class="form">
								<form method="post" action="#">
									<div class="fields">
										<div class="field half">
											<input name="name" id="name" placeholder="Name" type="text" />
										</div>
										<div class="field half">
											<input name="email" id="email" placeholder="Email" type="email" />
										</div>
										<div class="field">
											<textarea name="message" id="message" rows="6" placeholder="Message"></textarea>
										</div>
									</div>
									<ul class="actions special">
										<li><input type="button" class="button" value="Send Message" /></li>
									</ul>
								</form>
							</div>
							<ul class="icons">
								<li>
									<span class="icon fa-home"></span>
									<div>
										<strong>Address</strong>
										1234 Somewhere Road #543<br />
										Nashville, TN 00000
									</div>
								</li>
								<li>
									<span class="icon fa-envelope"></span>
									<div>
										<strong>Email</strong>
										<a href="mailto:information@domain.ext">information@domain.ext</a>
									</div>
								</li>
								<li>
									<span class="icon fa-phone"></span>
									<div>
										<strong>Phone</strong>
										(000) 000-0000 ext 0000
									</div>
								</li>
							</ul>
						</div>
					</div>
                    <div class="copyright">
                        &copy; Untitled. All rights reserved. Vanilla Picture.
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