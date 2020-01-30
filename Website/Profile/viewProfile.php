<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// connect to the database
$db = mysqli_connect('localhost','root','','photography');

include '../Registration/countrieslist.php';
include './serverViewProfile.php'
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>View Account</title>
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
								<h1>View Profile</h1>
                            </header>
							<div class="row gtr-200">
								<div class="col-8 col-8-medium col-12-small col-12-xsmall">
<!--                                    Select all profile information-->
                                    <?php
                                    $email = $_SESSION['userSignIn'];
                                    $user_check_query = "SELECT * FROM all_user WHERE userId='$email'";
                                    $resultUser = mysqli_query($db, $user_check_query);
                                    $user = mysqli_fetch_assoc($resultUser);

                                    if($user['userType'] === 'customer') {
                                        $customer_check_query = "SELECT * FROM customer WHERE userId='$email'";
                                        $resultCustomer = mysqli_query($db, $customer_check_query);
                                        $customer = mysqli_fetch_assoc($resultCustomer);
                                    }
                                    elseif($user['userType'] === 'model'){
                                        $model_check_query = "SELECT * FROM model WHERE userId='$email'";
                                        $resultModel = mysqli_query($db, $model_check_query);
                                        $model = mysqli_fetch_assoc($resultModel);
                                    }

                                    ?>

                                    <?php if($user['userType'] === 'model' || $user['userType'] === 'customer'){?>
									<!-- Form -->
										<form method="post" action="viewProfile.php">
											<div class="row gtr-uniform">
                                                <div class="col-8 col-8-medium col-12-small col-12-xsmall">
                                                    <h3>Profile</h3>
                                                </div>
												<div class="col-12 col-12-xsmall">
                                                    <p><strong>Email :</strong>&nbsp; &nbsp;<?php echo $user['userId']; ?></p>
                                                </div>
												<div class="col-12 col-12-xsmall">
                                                    <p><strong>Name :</strong>&nbsp; &nbsp;<?php if($user['userType'] === 'customer'){echo $customer['customerFirstName'].' '.$customer['customerLastName'];}
                                                    elseif($user['userType'] === 'model'){echo $model['modelFirstName'].' '.$model['modelLastName'];}?></p>
                                                </div>
                                                <div class="col-12 col-12-xsmall">
                                                    <p><strong>Date of Birth :</strong>&nbsp; &nbsp;<?php if($user['userType'] === 'customer'){echo $customer['customerDob']; }
                                                    elseif($user['userType'] === 'model'){echo $model['modelDob']; }?></p>
                                                </div>
                                                <div class="col-12 col-12-xsmall">
                                                    <p><strong>Country :</strong>&nbsp; &nbsp;
                                                        <select name="country" id="country" title="Country">
                                                            <option value="" selected hidden>-Select Country-</option>
                                                            <?php
                                                                foreach($countries as $key => $value) {
                                                                    if($user['userType'] === 'customer') {
                                                                        if ($customer['customerCountry'] == $key) {
                                                                            ?>
                                                                            <option value="<?= $key ?>"
                                                                                    title="<?= htmlspecialchars($value) ?>"
                                                                                    selected><?= htmlspecialchars($value) ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    elseif($user['userType'] === 'model') {
                                                                        if ($model['modelCountry'] == $key) {
                                                                            ?>
                                                                            <option value="<?= $key ?>"
                                                                                    title="<?= htmlspecialchars($value) ?>"
                                                                                    selected><?= htmlspecialchars($value) ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            ?>

                                                            <?php
                                                            foreach($countries as $key => $value) {
                                                                ?>
                                                                <option value="<?= $key ?>" title="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($value) ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </p>
                                                </div>
                                                <div class="col-12 col-12-xsmall">
                                                    <p><strong>City :</strong>&nbsp; &nbsp; <input type="text" name="city" id="city" value=<?php if($user['userType'] === 'customer'){ echo $customer['customerCity'];}
                                                        elseif($user['userType'] === 'model'){ echo $model['modelCity'];}?> title="City" placeholder="City" required/><br></p>
                                                </div>
                                                <!-- Break -->
                                                <div class="col-12">
                                                    <ul class="actions">
                                                        <li><button type="submit" value="Update" class="primary" name="update_User">Update</button></li>
                                                        <li><button type="reset" value="Cancel" onclick="goHome()">Cancel</button></li>
                                                        <script language='javascript' type='text/javascript'>
                                                            function goHome() {
                                                                window.location.href='../Home/homepage.php';
                                                            }
                                                        </script>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>

                                    <?php }else{ ?>
                                    <div class="row gtr-uniform">
                                        <div class="col-8 col-12-xsmall">
                                            <h3>Profile</h3>
                                            <div class="col-12 col-12-xsmall">
                                                <p><strong>Email :</strong>&nbsp; &nbsp;<?php echo $user['userId']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                            <?php }?>



<!--                                Change password section-->
<hr>
                                    <form method="post" action="viewProfile.php">
                                        <div class="row gtr-uniform">
                                                <div class="col-8 col-12-xsmall">
                                                    <h3 id="changePasswordTitle"><br><br>Change password</h3>
                                                    <p><?php include('../Registration/errorsRegistration.php');?></p>
                                                    <p><?php if(isset($_GET['changePasswordMessage'])){echo $_GET['changePasswordMessage'];}?></p>
                                                </div>
                                                <div class="col-12 col-12-xsmall">
                                                    <p><strong>Current Password : </strong>&nbsp; &nbsp; <input type="password" name="password_current" id="password_current" value="" placeholder="Current Password"
                                                    title="Current Password""/>
                                                </div>
                                                <div class="col-12 col-12-xsmall">
                                                    <p><strong>Password : </strong>&nbsp; &nbsp; <input type="password" name="password_1" id="password_1" value="" placeholder="Password"
                                                                                                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}"
                                                                                                                title="Password must contain between 6 and 20 characters, including UPPER/lowercase and numbers"
                                                                                                        required oninvalid="setCustomValidity('New password is invalid')" oninput="setCustomValidity('')"/>
                                                </div>
                                                <div class="col-12 col-12-xsmall">
                                                    <p><strong>Confirm Password :</strong>&nbsp; &nbsp;
                                                        <input type="password" name="password_2" id="password_2" value="" placeholder="Confirm Password"
                                                               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}"
                                                               title="Please enter the same Password as above"
                                                               oninput="check(this)"
                                                               />
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
                                                    </p>
                                                </div>
                                            <!-- Break -->
                                            <div class="col-12">
                                                <ul class="actions">
                                                    <li><button type="submit" value="Change_PW" class="primary" name="change_PW_User">Change Password</button></li>
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
    <?php include '../../footer/footer.php' ?>

		<!-- Scripts -->
			<script src="../../assets/js/jquery.min.js"></script>
			<script src="../../assets/js/jquery.dropotron.min.js"></script>
			<script src="../../assets/js/browser.min.js"></script>
			<script src="../../assets/js/breakpoints.min.js"></script>
			<script src="../../assets/js/util.js"></script>
			<script src="../../assets/js/main.js"></script>

	</body>
</html>