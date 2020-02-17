<?php
// Database Connection
include '../Header/dbConnection.php';

// Start the session
include '../Header/sessionConnection.php';


include '../Registration/countrieslist.php';
include './serverViewProfile.php';

if(isset($_SESSION['userSignIn'])){
?>
<!DOCTYPE HTML>
<html lang="en">
    <?php include '../Header/favicon.html';?>
	<head>
		<title>Profile</title>
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
                                                <?php if(isset($_GET['changeUserMessage'])){?>

                                                    <div class="isa_success col-12 col-12-medium col-12-small col-12-xsmall" style="padding-top:0px; text-align: center">
                                                        <i class="fa fa-check-circle" style="margin-top: 0px;vertical-align:middle;"></i>
                                                        <?php echo $_GET['changeUserMessage'];?>
                                                    </div>
                                                <?php }?>
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
                                                <?php if($user['userType'] === 'model'){?>
                                                <div class="col-12 col-12-xsmall">
                                                    <p><strong>Gender :</strong> &nbsp; <?php if($user['userType'] === 'model'){ if($model['modelGender'] === 'F'){echo 'Female';}elseif($model['modelGender'] === 'M'){echo 'Male';}else{echo 'Other';}} ?><br></p>
                                                </div>
                                                <?php } ?>
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
                                                <div class="col-12 col-12-xsmall">
                                                    <h3 id="changePasswordTitle"><br><br>Change password</h3>

                                                    <?php if(isset($_GET['changePasswordMessage'])){?>

                                                    <div class="isa_success" >
                                                        <i class="fa fa-check-circle"></i>
                                                        <?php echo $_GET['changePasswordMessage'];?>
                                                    </div>
                                                       <?php }?>
                                                            <?php include 'errorsProfile.php' ?>
                                                </div>

                                                <div class="col-11 col-11-xsmall">
                                                    <p><strong>Current Password : </strong>&nbsp; &nbsp; <input type="password" name="password_current" id="password_current" value="" placeholder="Current Password"
                                                    title="Current Password""/>
                                                </div>
                                                <div class="col-1 col-1-xsmall">
                                                    <i id="pass-status-current" style="font-size: 125%;margin-top: 40px"
                                                       class="fa fa-eye" aria-hidden="true" onClick="myFunction()"></i>
                                                </div>

                                                <script>
                                                    function myFunction() {
                                                        var passwordInput = document.getElementById('password_current');
                                                        var passStatus = document.getElementById('pass-status-current');

                                                        if (passwordInput.type == 'password'){
                                                            passwordInput.type='text';
                                                            passStatus.className='fa fa-eye-slash';

                                                        }
                                                        else{
                                                            passwordInput.type='password';
                                                            passStatus.className='fa fa-eye';
                                                        }
                                                    }
                                                </script>


                                                <div class="col-11 col-11-xsmall">
                                                    <p><strong>Password : </strong>&nbsp; &nbsp; <input type="password" name="password_1" id="password_1" value="" placeholder="Password"
                                                                                                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}"
                                                                                                                title="Password must contain between 6 and 20 characters, including UPPER/lowercase and numbers"
                                                                                                        required oninvalid="setCustomValidity('New password is invalid')" oninput="setCustomValidity('')"/>
                                                </div>
                                        <div class="col-1 col-1-xsmall">
                                            <i id="pass-status-pw" style="font-size: 125%;margin-top: 40px"
                                               class="fa fa-eye" aria-hidden="true" onClick="myFunction2()"></i>
                                        </div>
                                        <!--                                                    <button onclick="myFunction()">Show Password</button>-->
                                        <script>
                                            function myFunction2() {
                                                var passwordInput = document.getElementById('password_1');
                                                var passStatus = document.getElementById('pass-status-pw');

                                                if (passwordInput.type == 'password'){
                                                    passwordInput.type='text';
                                                    passStatus.className='fa fa-eye-slash';

                                                }
                                                else{
                                                    passwordInput.type='password';
                                                    passStatus.className='fa fa-eye';
                                                }
                                            }
                                        </script>
                                                <div class="col-11 col-11-xsmall">
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
                                        <div class="col-1 col-1-xsmall">
                                            <i id="pass-status-confirmPW" style="font-size: 125%;margin-top: 40px"
                                               class="fa fa-eye" aria-hidden="true" onClick="myFunction3()"></i>
                                        </div>
                                        <!--                                                    <button onclick="myFunction()">Show Password</button>-->
                                        <script>
                                            function myFunction3() {
                                                var passwordInput = document.getElementById('password_2');
                                                var passStatus = document.getElementById('pass-status-confirmPW');

                                                if (passwordInput.type == 'password'){
                                                    passwordInput.type='text';
                                                    passStatus.className='fa fa-eye-slash';

                                                }
                                                else{
                                                    passwordInput.type='password';
                                                    passStatus.className='fa fa-eye';
                                                }
                                            }
                                        </script>
                                                </div>
                                        <br>
                                            <!-- Break -->
                                            <div class="col-12">
                                                <ul class="actions">
                                                    <li><button type="submit" value="Change_PW" class="primary" name="change_PW_User">Change Password</button></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </form>
								</div>
                        <hr>
                        <div  style="text-align:center; margin-top:10%;">
                            <button onclick="location.href ='../SignOut/signOut.php'"> Sign Out</button>
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
    header('location: ../../Website/SignIn/signIn.php');
}?>