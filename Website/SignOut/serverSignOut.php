<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['userSignIn'])) {
    if (isset($_POST['signOut_user'])) {
    unset($_SESSION['userSendEmail']);
    unset($_SESSION['userSignIn']);
    unset($_SESSION['userTypeSignIn']);
    header('location: ../Home/homepage.php');
}
}else{
header('location: ../Home/homepage.php');
}

