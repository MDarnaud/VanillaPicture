<?php include 'categorieslist.php'
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Add Image</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="./assets/css/main.css" />
	</head>
	<body class="is-preload">

    <?php include './navigation/navigation.php' ?>

		<!-- Main -->
			<div id="main">
				<div class="wrapper">
					<div class="inner">
						<!-- Elements -->
							<header class="major">
								<h1>Add Image</h1>
								<p>Please fill out the form to add an image.</p>
							</header>
                        <div style="margin:auto">
							<div class="row gtr-200">
									<!-- Form -->
										<form method="post" action="uploadGalleryImage.php" enctype="multipart/form-data">
											<div class="row gtr-uniform">
                                                <div class="col-8 col-12-xsmall">

                                                    <select name="category" id="category">
                                                        <option value="" selected hidden>-Select Category-</option>
                                                        <?php
                                                        foreach($categories as $key => $value) {
                                                            ?>
                                                            <option value="<?= $key ?>" title="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($value) ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
												<div class="col-8 col-12-xsmall">
                                                    <input type="text" name="caption" id="caption" value="" placeholder="Caption" maxlength="40" required/>
                                                </div>
                                                <div class="col-8 col-12-xsmall">
<!--                                                    Upload image here-->
                                                    <p style="font-size:18px;">Select image to upload:
                                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                                    </p>
                                                </div>
												<!-- Break -->
												<div class="col-12">
													<ul class="actions">
                                                        <li><button type="submit" value="Submit" class="primary" name="submit_image">Submit</button></li>
                                                        <li><button type="reset" value="Cancel" onclick="goBack()">Cancel</button></li>
                                                        <script language='javascript' type='text/javascript'>
                                                            function goBack() {
                                                                window.history.back();
                                                            }
                                                        </script></ul>
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
			<script src="./assets/js/jquery.min.js"></script>
			<script src="./assets/js/jquery.dropotron.min.js"></script>
			<script src="./assets/js/browser.min.js"></script>
			<script src="./assets/js/breakpoints.min.js"></script>
			<script src="./assets/js/util.js"></script>
			<script src="./assets/js/main.js"></script>

	</body>
</html>

