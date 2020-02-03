<?php
// Start the session
include '../Header/sessionConnection.php';

// Initializing variables
$email    = "";
$errors = array();

// Connect to the database
$db = mysqli_connect('localhost','root','','photography');

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $firstName = mysqli_real_escape_string($db, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($db, $_POST['lastName']);
    $dob = mysqli_real_escape_string($db, $_POST['dob']);
    $country = mysqli_real_escape_string($db, $_POST['country']);
    $city = mysqli_real_escape_string($db, $_POST['city']);
    $type = mysqli_real_escape_string($db, $_POST['registrationType']);
    if($type === 'model') {
        $gender = mysqli_real_escape_string($db, $_POST['gender']);
        if($gender === 'female'){
            $genderChar = 'F';
        }
        elseif ($gender === 'male'){
            $genderChar = 'M';
        }
        elseif ($gender === 'other'){
            $genderChar = 'O';
        }
    }
    $currentDate = date("Y-m-d");


    // Form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($email)) { array_push($errors, "Email "); }
    if (empty($password_1)) { array_push($errors, "Password "); }
    if (empty($password_2)) { array_push($errors, "Confirm Password "); }
    if (empty($firstName)) { array_push($errors, "First Name "); }
    if (empty($lastName)) { array_push($errors, "Last Name "); }
    if (empty($dob)) { array_push($errors, "Date of Birth "); }
    if (empty($country)) { array_push($errors, "Country "); }
    if (empty($city)) { array_push($errors, "City "); }
    if (empty($type)) { array_push($errors, "Registration Type "); }
    if($type === 'model') {
        if (empty($gender)) {
            array_push($errors, "Gender ");
        }
    }

    // First check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM all_user WHERE userId='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['userId'] === $email) {
            array_push($errors, "Email already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        //Hash password
         $hash = password_hash($password_1, PASSWORD_DEFAULT);

        if($type === 'customer'){
            // Insert the user information in the table all_user in the database
            $queryUser = "INSERT INTO all_user (userId, userPassword, userType)
                  VALUES('$email', '$hash', 'customer' )";
            mysqli_query($db, $queryUser);

            // Insert the customer information in the table customer in the database
            $queryCustomer = "INSERT INTO customer (userId, customerFirstName, customerLastName, customerDob, customerCountry, customerCity, customerDate)
  			  VALUES('$email', '$firstName', '$lastName', '$dob', '$country', '$city','$currentDate')";
            mysqli_query($db, $queryCustomer);

        }elseif($type === 'model'){
            // Insert the user information in the table all_user in the database
            $queryUser = "INSERT INTO all_user (userId, userPassword, userType)
                  VALUES('$email', '$hash', 'model' )";
            mysqli_query($db, $queryUser);

            // Insert the model information in the table model in the database
            $queryCustomer = "INSERT INTO model (userId, modelFirstName, modelLastName, modelGender, modelDob, modelCountry, modelCity, modelDate)
  			  VALUES('$email', '$firstName', '$lastName', '$genderChar','$dob', '$country', '$city','$currentDate')";
            mysqli_query($db, $queryCustomer);
        }

        if (mysqli_affected_rows($db) >= 1) {
            $_SESSION['userNewAccount'] = $email;
            header('location: ../SignIn/signIn.php');
        }
    }
}
