<?php include 'categorieslist.php';
        include 'uploadGalleryImage.php'; ?>
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
                                <?php include 'errorsgallery.php'?>
							</header>
                        <div style="margin:auto">
							<div class="row gtr-200">
									<!-- Form -->
										<form method="post" action="addImageForm.php" enctype="multipart/form-data">
											<div class="row gtr-uniform">
                                                <div class="col-8 col-12-xsmall" id="dropdownCategory">
                                                    <select name="category" id="category">
                                                        <option value='' selected hidden>-Select Category-</option>
                                                        <?php
                                                        foreach($categories as $key => $value) {
                                                            ?>
                                                            <option value="<?= $key ?>" title="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($value) ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <?php
                                                    // connect to the database
                                                    $db = mysqli_connect('localhost','root','','photography');

                                                $gallery_brand_name_query = "SELECT DISTINCT galleryBrand FROM gallery";
                                                $gallery_result_brand_name = mysqli_query($db, $gallery_brand_name_query);
                                                while ($gallery_brand = mysqli_fetch_assoc($gallery_result_brand_name)) {
                                                    if($gallery_brand['galleryBrand'] != null)
                                                    $brandsChoices[] = $gallery_brand['galleryBrand'];
                                                }
                                                ?>

                                                <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
                                                <script>
                                                    $(document).ready(function () {
                                                        $("#category").change(function () {
                                                                var value = $(this).val();
                                                                $('.dropdownBrandsDiv').remove();
                                                                 if(value == 'Brands') {
                                                                     $('#dropdownCategory').append('<div class="dropdownBrandsDiv"><br>' +
                                                                         '<select name="brandsName" id="brandsName">' +
                                                                         '<option value=\'\' selected hidden>-Select a Brand-</option>' +
                                                                         '<?php foreach($brandsChoices as $choiceBrand) : ?>\n' +
                                                                         '<option value="<?php echo $choiceBrand; ?>">\n' +
                                                                         '<?php echo $choiceBrand; ?>\n' +
                                                                         '</option><?php endforeach; ?>\n' +
                                                                         '<option value="Other"> Other </option>' +
                                                                         '</select>' +
                                                                         '</div>');

                                                                     $("#brandsName").change(function () {
                                                                         $('.newBrand').remove();
                                                                         var value2 = $(this).val();
                                                                         if (value2 == 'Other') {
                                                                             $('.dropdownBrandsDiv').append('<div class ="newBrand"><br><input type="text" name="newBrand" id="newBrand" placeholder="Brand Name" maxlength="100" required/></div>');
                                                                         }
                                                                     });
                                                                 }
                                                         });
                                                    });
                                                </script>

												<div class="col-8 col-12-xsmall">
                                                    <input type="text" name="caption" id="caption" value="" placeholder="Caption" maxlength="100"/>
                                                </div>
                                                <div class="col-8 col-12-xsmall">
<!--                                                    Upload image here-->
                                                    <p style="font-size:18px;">Select image to upload:
                                                    <input type="file" name="fileToUpload" id="fileToUpload" required>
                                                    </p>
                                                </div>
												<!-- Break -->
												<div class="col-12">
													<ul class="actions">
                                                        <li><button type="submit" value="Submit" class="primary" name="submit_image">Submit</button></li>
                                                        <li><button type="reset" value="Cancel" onclick="goGallery()">Back</button></li>
                                                        <script language='javascript' type='text/javascript'>
                                                            function goGallery() {
                                                               window.location.href ="./gallery.php";
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

