<?php

// Start session
include '../Header/sessionConnection.php';

// Verify if the user is sign in
if (isset($_SESSION['userSignIn'])) {
        // Unset sessions, set during the sign in
        unset($_SESSION['userSendEmail']);
        unset($_SESSION['userSignIn']);
        unset($_SESSION['userTypeSignIn']);
        // Go back to the home page when a user sign out
        header('location: ../Registration/register.php');
}else{
    // Go back to the home page if a user is not sign in
    header('location: ../Registration/register.php');
}

?>
