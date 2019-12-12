<?php
session_start();

// initializing variables
$username = "";
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
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $dob = mysqli_real_escape_string($db, $_POST['dob']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $country = mysqli_real_escape_string($db, $_POST['country']);
    $city = mysqli_real_escape_string($db, $_POST['city']);


    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($email)) { array_push($errors, "Email "); }
    if (empty($password_1)) { array_push($errors, "Password "); }
    if (empty($password_2)) { array_push($errors, "Confirm Password "); }
    if (empty($firstname)) { array_push($errors, "First Name "); }
    if (empty($lastname)) { array_push($errors, "Last Name "); }
    if (empty($dob)) { array_push($errors, "Date of Birth "); }
    if (empty($address)) { array_push($errors, "Address "); }
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
        $password = md5($password_1);//encrypt the password before saving in the database

        //Insert the user information in the table all_user in the database
        $queryuser = "INSERT INTO all_user (userId, userPassword, userType) 
  			  VALUES('$email', '$password_1', 'customer' )";
        mysqli_query($db, $queryuser);
        mysqli_query($db, $queryuser);

        //Insert the customer information in the table customer in the database
        $querycustomer = "INSERT INTO customer (userId, customerFirstName, customerLastName, customerDob, customerAddress, customerCountry, customerCity) 
  			  VALUES('$email', '$firstname', '$lastname', '$dob', '$address', '$country', '$city')";
        mysqli_query($db, $querycustomer);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: register.php');
    }
}