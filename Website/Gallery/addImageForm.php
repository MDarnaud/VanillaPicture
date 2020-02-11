<?php include 'categorieslist.php';
        include 'uploadGalleryImage.php'; ?>
<!DOCTYPE HTML>
<html lang="en">
<?php include '../Header/favicon.html';?>
	<head>
		<title>Add Image</title>
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
								<h1>Add Image</h1>
								<p>Please fill out the form to add an image.</p>
                                <?php include 'errorsGallery.php' ?>
							</header>
                        <div style="margin:auto">
							<div class="row gtr-200">
									<!-- Form -->
										<form method="post" action="addImageForm.php" enctype="multipart/form-data">
											<div class="row gtr-uniform">
                                                <div class="col-8 col-12-small col-12-xsmall" id="dropdownCategory">
                                                    <h5 class="TitleForm">Category: </h5>
                                                    <select name="category" id="category" title="Category" required oninvalid="setCustomValidity('Category is invalid')" oninput="setCustomValidity('')">
                                                        <?php
                                                        foreach($categories as $key => $value) {
                                                            ?>
                                                                <option value="" selected hidden>-Select Category-</option>
                                                                <option value="<?= $key ?>" title="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($value) ?></option>
                                                            <?php }?>
                                                    </select>
                                                </div>

                                                <?php
                                                 // Connect to the database
                                                $db = mysqli_connect('localhost','root','','photography');

                                                // Brands
                                                $gallery_brand_name_query = "SELECT DISTINCT gallerySubCategory FROM gallery WHERE gallerySubCategory IS NOT NULL AND galleryCategory = 'Brands'";
                                                $gallery_result_brand_name = mysqli_query($db, $gallery_brand_name_query);
                                                if (mysqli_num_rows($gallery_result_brand_name) > 0) {
                                                    while ($gallery_brand = mysqli_fetch_assoc($gallery_result_brand_name)) {
                                                            $brandsChoices[] = $gallery_brand['gallerySubCategory'];
                                                    }
                                                }

                                                // Events
                                                $gallery_event_name_query = "SELECT DISTINCT gallerySubCategory FROM gallery WHERE gallerySubCategory IS NOT NULL AND galleryCategory = 'Events'";
                                                $gallery_result_event_name = mysqli_query($db, $gallery_event_name_query);
                                                if (mysqli_num_rows($gallery_result_event_name) > 0) {
                                                    while ($gallery_event = mysqli_fetch_assoc($gallery_result_event_name)) {
                                                        $eventsChoices[] = $gallery_event['gallerySubCategory'];
                                                    }
                                                }

                                                // Portrait
                                                $gallery_portrait_name_query = "SELECT DISTINCT gallerySubCategory FROM gallery WHERE gallerySubCategory IS NOT NULL AND galleryCategory = 'Portraits'";
                                                $gallery_result_portrait_name = mysqli_query($db, $gallery_portrait_name_query);
                                                if (mysqli_num_rows($gallery_result_portrait_name) > 0) {
                                                    while ($gallery_portrait = mysqli_fetch_assoc($gallery_result_portrait_name)) {
                                                        $portraitsChoices[] = $gallery_portrait['gallerySubCategory'];
                                                    }
                                                }
                                                ?>

                                                <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
                                                <script>
                                                    $(document).ready(function () {
                                                        $("#category").change(function () {
                                                                var value = $(this).val();
                                                                $('.dropdownSubDiv').remove();
                                                                 if(value == 'Brands') {
                                                                     $('#dropdownCategory').append('<div class="dropdownSubDiv"><br>' +
                                                                         '<select name="brandsName" id="brandsName">' +
                                                                         '<option value=\'\' selected hidden>-Select a Brand-</option>' +
                                                                         '<?php if (mysqli_num_rows($gallery_result_brand_name) > 0) {foreach($brandsChoices as $choiceBrand) : ?>\n' +
                                                                         '<option value="<?php echo $choiceBrand; ?>">\n' +
                                                                         '<?php echo $choiceBrand; ?>\n' +
                                                                         '</option><?php endforeach;} ?>\n' +
                                                                         '<option value="Other"> Other </option>' +
                                                                         '</select>' +
                                                                         '</div>');
                                                                     $("#brandsName").change(function () {
                                                                         $('.newBrand').remove();
                                                                         var value2 = $(this).val();
                                                                         if (value2 == 'Other') {
                                                                             $('.dropdownSubDiv').append('<div class ="newBrand"><br><input type="text" name="newBrand" id="newBrand" placeholder="Brand Name" maxlength="100" required/></div>');
                                                                         }
                                                                     });
                                                                 }
                                                                 if(value == 'Events'){
                                                                     $('#dropdownCategory').append('<div class="dropdownSubDiv"><br>' +
                                                                         '<select name="eventsName" id="eventsName">' +
                                                                         '<option value=\'\' selected hidden>-Select an Event-</option>' +
                                                                         '<?php if (mysqli_num_rows($gallery_result_event_name) > 0) {foreach($eventsChoices as $choiceEvent) : ?>\n' +
                                                                         '<option value="<?php echo $choiceEvent; ?>">\n' +
                                                                         '<?php echo $choiceEvent; ?>\n' +
                                                                         '</option><?php endforeach;} ?>\n' +
                                                                         '<option value="Other"> Other </option>' +
                                                                         '</select>' +
                                                                         '</div>');
                                                                     $("#eventsName").change(function () {
                                                                         $('.newEvent').remove();
                                                                         var value2 = $(this).val();
                                                                         if (value2 == 'Other') {
                                                                             $('.dropdownSubDiv').append('<div class ="newEvent"><br><input type="text" name="newEvent" id="newEvent" placeholder="Event Name" maxlength="100" required/></div>');
                                                                         }
                                                                     });
                                                                 }
                                                            if(value == 'Portraits') {
                                                                $('#dropdownCategory').append('<div class="dropdownSubDiv"><br>' +
                                                                    '<select name="portraitsName" id="portraitsName">' +
                                                                    '<option value=\'\' selected hidden>-Select a Portrait-</option>' +
                                                                    '<?php if (mysqli_num_rows($gallery_result_portrait_name) > 0) {foreach($portraitsChoices as $choicePortrait) : ?>\n' +
                                                                    '<option value="<?php echo $choicePortrait; ?>">\n' +
                                                                    '<?php echo $choicePortrait; ?>\n' +
                                                                    '</option><?php endforeach;} ?>\n' +
                                                                    '<option value="Other"> Other </option>' +
                                                                    '</select>' +
                                                                    '</div>');
                                                                $("#portraitsName").change(function () {
                                                                    $('.newPortrait').remove();
                                                                    var value2 = $(this).val();
                                                                    if (value2 == 'Other') {
                                                                        $('.dropdownSubDiv').append('<div class ="newPortrait"><br><input type="text" name="newPortrait" id="newPortrait" placeholder="Portrait Name" maxlength="100" required/></div>');
                                                                    }
                                                                });
                                                            }
                                                         });
                                                    });
                                                </script>

												<div class="col-8 col-12-small col-12-xsmall">
                                                    <h5 class="TitleForm">Caption: </h5>
                                                    <input type="text" name="caption" id="caption" value="" placeholder="Caption" maxlength="100" title="Please fill out this field." />
                                                </div>
                                                <div class="col-8 col-12-small col-12-xsmall">
<!--                                                    Upload image here-->
                                                    <h5 class="TitleForm">Select image to upload:</h5>
                                                    <input type="file" name="fileToUpload" id="fileToUpload" required>

                                                </div>
												<!-- Break -->
												<div class="col-12">
													<ul class="actions">
                                                        <li><button type="submit" value="Submit" class="primary" name="submit_image">Submit</button></li>
                                                        <li><button type="reset" value="Cancel" onclick="goGallery()">Back</button></li>
                                                        <script language='javascript' type='text/javascript'>
                                                            function goGallery() {
                                                               window.location.href ="gallery.php";
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

    <?php include '../Footer/footer.php' ?>

    <!--Script Links-->
    <?php include '../Footer/scriptsLinks.php'?>

	</body>
</html>

