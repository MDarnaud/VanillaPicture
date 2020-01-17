<?php include 'serverAnnouncement.php'?>
<!DOCTYPE HTML>

<html lang="en">
	<head>
		<title>Announcement</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

    <?php include './navigation/navigation.php' ?>

		<!-- One -->
			<div id="main">
				<div class="wrapper">
					<div class="inner">
						<header class="major">
							<h1>Announcement</h1>
							<p>Please fill out the form to post an announcement on the home page.</p>
                            <?php include "errorsannouncement.php" ?>
						</header>
                        <div style="margin:auto">
                            <div class="row gtr-200">
                                <!-- Form -->
                                <form method="post" action="announcement.php">
                                    <div class="row gtr-uniform">
                                        <div class="col-8 col-12-xsmall">
                                            <input type="text" name="title" id="title" value="" placeholder="Title" maxlength="50" required/>
                                        </div>
                                        <div class="col-8 col-12-xsmall">
                                            <textarea name="detail" id="detail" value="" placeholder="Announcement Detail" maxlength="300" style="height:150px;weight:100px" required></textarea>
                                        </div>
                                        <div class="col-8 col-12-xsmall">
                                            <p>Start date</p>
                                            <input type="date" name="startDate" id="startDate" value="" placeholder="Start Date" required/>
                                        </div>
                                        <div class="col-8 col-12-xsmall">
                                            <p>End date</p>
                                            <input type="date" name="endDate" id="endDate" value="" placeholder="End Date" required/>
                                        </div>
                                        <div class="col-8 col-12-xsmall">
                                            <br><input type="checkbox" name="modelPost" id="modelPost" value="modelPost" class="elementsTable">
                                            <label for="modelPost"> Yes, this announcement is a model search.</label>
                                        </div>
                                        <!-- Break -->
                                        <div class="col-12">
                                            <ul class="actions">
                                                <li><button type="submit" value="Submit" class="primary" name="submit_announcement">Submit</button></li>
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