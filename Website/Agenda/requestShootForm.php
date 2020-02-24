<?php
//Database Connection
include '../Header/dbConnection.php';
// Start the session
include '../Header/sessionConnection.php';

//get date to fill form
$convertedStartDate = null;
$title = "";
if (isset($_GET["startDate"])){
    $startDateString = $_GET["startDate"];
    $convertedStartDate = date('Y-m-d\TH:i', strtotime($startDateString));
}
if(isset($_GET["title"])){
    $title = $_GET["title"];
}
if(isset($_GET["id"])){
    $eventId = $_GET["id"];
}
if(isset($_SESSION['userSignIn'])){
    if($_SESSION['userTypeSignIn'] === 'customer'){
?>

<!DOCTYPE HTML>

<html lang="en">
        <?php include '../Header/favicon.html';?>
	<head>
		<title>Request Shoot</title>
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
								<h1>Request a Shoot</h1>
								<p>Fill the form to request a shoot on the date selected</p>
							</header>
							<div class="row gtr-200">
								<div class="col-6 col-12-medium">
									<!-- Form -->
										<form method="post" action="newShootRequest.php">
											<div class="row gtr-uniform">
                                                <input type="hidden" name="eventId" id="eventId" value="<?php echo $eventId?>">
												<div class="col-8 col-12-xsmall">
													<input style="background-color: lightgray" type="text" name="title" id="title" value="<?php echo $title?>" placeholder="Location" READONLY/>
												</div>
												<div class="col-8 col-12-xsmall">
													<h5 class="TitleForm">Date/Time:</h5>
													<input style="background-color: lightgray" type="datetime-local" name="date" id="date" value="<?php echo $convertedStartDate?>" READONLY/>
												</div>

												<!-- Break -->
												<div class="col-12 col-12-small">
                                                    <h5 class="TitleForm">Artist Choice:</h5>
												</div>
												<div class="col-4 col-12-small">
													<input type="checkbox" id="checkboxMakeup" name="checkboxMakeup">
													<label for="checkboxMakeup">Makeup</label>
												</div>
												<div class="col-4 col-12-small">
													<input type="checkbox" id="checkboxHair" name="checkboxHair">
													<label for="checkboxHair">Hair</label>
												</div>
												<div class="col-4 col-12-small">
													<input type="checkbox" id="checkboxStylist" name="checkboxStylist">
													<label for="checkboxStylist">Stylist</label>
												</div>

												<div class="col-12">
                                                    <h5 class="TitleForm">Package Choice:</h5>
                                                    <i style="font-size:smaller">If you wish to learn about the different packages, <a href="../Shop/shop.php#packagesAnchor" style="color:#5f9ea0 !important;"target="_blank">click here</a></i>
													<select name="packageCategory" id="packageCategory" required>
														<option value="">- Select -</option>
														<option value="package1">Package 1 - Portrait</option>
														<option value="package2">Package 2 - Brand</option>
														<option value="package3">Package 3 - Travel</option>
													</select>
												</div>

												<div class="col-12">
													<textarea name="customerNotes" id="customerNotes" placeholder="Write your request here" rows="6" maxlength="100"></textarea>
												</div>
												<!-- Break -->
												<div class="col-12">
													<ul class="actions">
														<li><input type="submit" value="Request" class="primary"/></li>
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

    <!-- footer -->
    <?php include '../Footer/footer.php' ?>

    <!--Script Links-->
    <?php include '../Footer/scriptsLinks.php'?>

	</body>
</html>

    <?php }else{
        header('location: ../../Website/Home/homepage.php');
    }
}else{
    header('location: ../../Website/Home/homepage.php');
}