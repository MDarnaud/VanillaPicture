<?php
session_start();

// initializing variables
$email    = "";
$errors = array();

// connect to the database
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


    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($email)) { array_push($errors, "Email "); }
    if (empty($password_1)) { array_push($errors, "Password "); }
    if (empty($password_2)) { array_push($errors, "Confirm Password "); }
    if (empty($firstName)) { array_push($errors, "First Name "); }
    if (empty($lastName)) { array_push($errors, "Last Name "); }
    if (empty($dob)) { array_push($errors, "Date of Birth "); }
    if (empty($country)) { array_push($errors, "Country "); }
    if (empty($city)) { array_push($errors, "City "); }

    // first check the database to make sure
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
        $salt = $email;
        $password = md5($salt.$password_1);//encrypt the password before saving in the database

        //Insert the user information in the table all_user in the database
        $queryUser = "INSERT INTO all_user (userId, userPassword, userType) 
  			  VALUES('$email', '$password', 'customer' )";
        mysqli_query($db, $queryUser);

        //Insert the customer information in the table customer in the database
        $queryCustomer = "INSERT INTO customer (userId, customerFirstName, customerLastName, customerDob, customerCountry, customerCity) 
  			  VALUES('$email', '$firstName', '$lastName', '$dob', '$country', '$city')";
        mysqli_query($db, $queryCustomer);

        if (mysqli_affected_rows($db) >= 1) {
            $_SESSION['userNewAccount'] = $email;
            header('location: ../signin.php');
        }
    }
}
