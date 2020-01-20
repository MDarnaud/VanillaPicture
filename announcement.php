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
                                            <h5 class="TitleForm">Title:</h5>
                                            <input type="text" name="title" id="title" value="" placeholder="Title" maxlength="50" required oninvalid="setCustomValidity('Title is invalid')" oninput="setCustomValidity('')"/>
                                        </div>
                                        <div class="col-8 col-12-xsmall">
                                            <h5 class="TitleForm">Details:</h5>
                                            <textarea name="detail" id="detail" value="" placeholder="Announcement Details" maxlength="300" style="height:150px;weight:100px" required oninvalid="setCustomValidity('Details is invalid')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                        <div class="col-8 col-12-xsmall">
                                            <h5 class="TitleForm">Start date:</h5>
                                            <input type="date" name="startDate" id="startDate" value="" placeholder="Start Date" required "/>
                                        </div>
                                        <div class="col-8 col-12-xsmall">
                                            <h5 class="TitleForm">End date:</h5>
                                            <input type="date" name="endDate" id="endDate" value="" placeholder="End Date" required oninput="check(this)"/>
                                            <script language='javascript' type='text/javascript'>
                                                function check(input) {
                                                    if (!(input.value > document.getElementById('startDate').value)) {
                                                        input.setCustomValidity('End Date is before the start date.');
                                                    } else {
                                                        // input is valid -- reset the error message
                                                        input.setCustomValidity('');
                                                    }

                                                    if (!(input.value > new Date())) {
                                                        input.setCustomValidity('End Date is before today\'s date.');
                                                    } else {
                                                        // input is valid -- reset the error message
                                                        input.setCustomValidity('');
                                                    }
                                                }
                                            </script>
                                        </div>
                                        <div class="col-8 col-12-xsmall">
                                            <br><input type="checkbox" name="modelPost" id="modelPost" value="modelPost" class="elementsTable">
                                            <label for="modelPost"> <h5 class="TitleForm">Yes, this announcement is a model search.</h5></label>
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