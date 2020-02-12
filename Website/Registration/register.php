<?php
// Database Connection
include '../Header/dbConnection.php';

include 'countrieslist.php';
        include 'serverRegistration.php';

if(!isset($_SESSION['userSignIn'])){?>

<!DOCTYPE HTML>
<html lang="en">
    <?php include '../Header/favicon.html';?>
	<head>
		<title>Register</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="../../assets/css/main.css" />
	</head>
	<body class="is-preload">

    <?php include '../Navigation/Navigation.php' ?>

		<!-- Main -->
			<div id="main">
				<div class="wrapper">
					<div class="inner">
						<!-- Elements -->
							<header class="major">
								<h1>Sign up</h1>
								<p>Create a new account here</p>
                                <?php include "errorsRegistration.php" ?>
							</header>
                        <div style="margin:auto">
							<div class="row gtr-200">
									<!-- Form -->
										<h3>Register</h3>
										<form method="post" action="register.php">
											<div class="row gtr-uniform">
                                                <div class="col-8 col-12-small col-12-xsmall">
                                                    <h5 class="TitleForm">Email:</h5>
                                                    <input type="email" name="email" id="email" value="" placeholder="Email" required oninvalid="setCustomValidity('Email is invalid')" oninput="setCustomValidity('')"/>
                                                </div>
												<div class="col-8 col-11-small col-11-xsmall">
                                                    <h5 class="TitleForm">Password:</h5>
													<input type="password" name="password_1" id="password_1" value="" placeholder="Password"
                                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}"
                                                           title="Password must contain between 6 and 20 characters, including UPPER/lowercase and numbers"
                                                           required oninvalid="setCustomValidity('Password is invalid')" oninput="setCustomValidity('')"/>
												</div>
                                                <div class="col-1 col-1-xsmall">
                                                    <i id="pass-status" style="font-size: 125%;margin-top: 30px"
                                                       class="fa fa-eye" aria-hidden="true" onClick="myFunction()"></i>
                                                </div>

                                                <script>
                                                    function myFunction() {
                                                        var passwordInput = document.getElementById('password_1');
                                                        var passStatus = document.getElementById('pass-status');

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
                                                <div class="col-8 col-11-small col-11-xsmall">
                                                    <h5 class="TitleForm">Confirm password:</h5>
                                                    <input type="password" name="password_2" id="password_2" value="" placeholder="Confirm Password"
                                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}"
                                                           title="Please enter the same Password as above"
                                                           oninput="check(this)"
                                                           required/>
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
                                                    <i id="pass-status-2" style="font-size: 125%;margin-top: 30px"
                                                       class="fa fa-eye" aria-hidden="true" onClick="myFunction2()"></i>
                                                </div>

                                                <script>
                                                    function myFunction2() {
                                                        var passwordInput = document.getElementById('password_2');
                                                        var passStatus = document.getElementById('pass-status-2');

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
                                                <div class="col-8 col-12-small col-12-xsmall">
                                                    <h3>About you...</h3>
                                                </div>
                                                <div class="col-8 col-12-small col-12-xsmall">
                                                    <h5 class="TitleForm">FirstName:</h5>
                                                    <input type="text" name="firstName" id="firstName" value="" placeholder="First Name"
                                                           maxlength="20" required oninvalid="setCustomValidity('FirstName is invalid')" oninput="setCustomValidity('')"/>
                                                </div>
                                                <div class="col-8 col-12-small col-12-xsmall">
                                                    <h5 class="TitleForm">LastName:</h5>
                                                    <input type="text" name="lastName" id="lastName" value="" placeholder="Last Name"
                                                           maxlength="20" required oninvalid="setCustomValidity('LastName is invalid')" oninput="setCustomValidity('')"/>
                                                </div>
												<div class="col-8 col-12-small col-12-xsmall">
                                                    <h5 class="TitleForm">Date of Birth:</h5>
													<input type="date" name="dob" id="dob" value="" placeholder="Date of Birth" required
                                                           oninput="checkDob(this)"/>
                                                    <script language='javascript' type='text/javascript'>
                                                        function checkDob(input) {
                                                            var todayDate = new Date().toISOString().slice(0,10);
                                                            if (input.value > todayDate) {
                                                                var dobElement = document.getElementById('dob');
                                                                dobElement.setCustomValidity('Date of Birth is invalid.');
                                                            } else {
                                                                // input is valid -- reset the error message
                                                                input.setCustomValidity('');
                                                            }
                                                        }
                                                    </script>
												</div>
												<div class="col-8 col-12-small col-12-xsmall">
                                                    <h5 class="TitleForm">Country:</h5>
													<select name="country" id="country">
                                                            <option value="" selected hidden>-Select Country-</option>
                                                            <?php
                                                            foreach($countries as $key => $value) {
                                                                ?>
<!--                                                            Country dropdown from another page    -->
                                                                <option value="<?= $key ?>" title="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($value) ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                </div>
                                                <div class="col-8 col-12-small col-12-xsmall">
                                                    <h5 class="TitleForm">City:</h5>
                                                    <input type="text" name="city" id="city" value="" placeholder="City" required
                                                           oninvalid="setCustomValidity('City is invalid')" oninput="setCustomValidity('')"/>
                                                </div>
                                                <div id="radioRegistration" class="col-8 col-12-small col-12-xsmall">
                                                     Registration Type: &nbsp; &nbsp;
                                                    <input type="radio" name="registrationType" id="customer" value="customer" checked>
                                                    <label for="customer"> Customer </label>

                                                    <input type="radio" name="registrationType" id="model" value="model">
                                                    <label for="model"> Model </label>
                                                </div>

                                                <!--                                    RadioButton clicked show the right dropdown-->
                                                <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
                                                <script>
                                                    // If the non-user selected a "Model"
                                                    $(document).ready(function () {
                                                        $("input[type='radio']").click(function () {
                                                            $('.genderChoice').remove();
                                                            var radioValue = $("input[name='registrationType']:checked").val();
                                                            if (radioValue === 'model') {
                                                                $('#radioRegistration').append('<div class="genderChoice">' +
                                                                    ' Gender: &nbsp; &nbsp;\n' +
                                                                    '                                    <input type="radio" name="gender" id="female" value="female" checked>\n' +
                                                                    '                                    <label for="female"> Female </label>\n' +
                                                                    '\n' +
                                                                    '                                    <input type="radio" name="gender" id="male" value="male">\n' +
                                                                    '                                    <label for="male"> Male </label>\n'+
                                                                '\n' +
                                                                '                                    <input type="radio" name="gender" id="other" value="other">\n' +
                                                                '                                    <label for="other"> Other </label>\n'+ '</div>');
                                                            }
                                                        });
                                                     });
                                                </script>
												<!-- Break -->
												<div class="col-12">
													<ul class="actions">
                                                        <li><button type="submit" value="Signup" class="primary" name="reg_user">Sign up</button></li>
                                                        <li><button onclick="location.href='../SignIn/signIn.php'" type="reset" value="Cancel">Cancel</button></li>
													</ul>
												</div>
											</div>
										</form>
							</div>
						</div>
                        <p>
                            Already a member? <a href="../SignIn/signIn.php" style="color:lightseagreen; text-decoration: underline">Sign in</a>
                        </p>
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
    header('location: ../../Website/SignOut/signOut.php');
}?>

