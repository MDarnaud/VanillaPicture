<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// initializing variables
$email = "";

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'photography');

// REGISTER USER
if (isset($_POST['forgot_password'])) {
    // receive all input values from the form
    $email = mysqli_real_escape_string($db, $_POST['email']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($email)) {
        array_push($errors, "Email ");
    }

    // first check the database to make sure
    // a user does exist with the same email
    $user_check_query = "SELECT * FROM all_user WHERE userId='$email'";
    $resultUser = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($resultUser);

    if (!($user)) { // if user exists
        if (!($user['userId'] === $email)) {
            array_push($errors, "Email does not exist. ");
        }
    } else {
        //send a new string password by mail
        //hash the string and save it as the password in the database
        //user enters new string password and can change their password
        $password = 'ABC123';
        $emailTo = $email;
        $subject = "Forgot your password";
        $message = "Your password for Vanilla Picture website is ".$password;
        $emailTest = 'arianeouellette@yahoo.ca';
        mail($emailTest, $subject, $message);
    }
}

