<?php

// initializing variables
$email    = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost','root','','photography');

// REGISTER USER
if (isset($_POST['signIn_user'])) {
    // receive all input values from the form
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);

    // first check the database to make sure
    // a user does exist with the same email
    $user_check_query = "SELECT * FROM all_user WHERE userId='$email'";
    $resultUser = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($resultUser);

    if (!($user)) { // if user exists
        if (!($user['userId'] === $email)) {
            array_push($errors, "Email does not exist. ");
        }
    }
    else{
        //Hash password
        $salt = $email;
        $password = md5($salt.$password_1);
            if ($user['userPassword'] === $password) {
                $_SESSION['userSignIn'] = $email;
                header('location: ./homepage.php');
            }
            else{
                array_push($errors, "Password is invalid. ");
            }
    }
}
