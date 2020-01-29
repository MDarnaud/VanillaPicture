<?php
session_start();
if (isset($_SESSION['userSignIn'])) {
        unset($_SESSION['userSendEmail']);
        unset($_SESSION['userSignIn']);
        unset($_SESSION['userTypeSignIn']);
        header('location: ../Registration/register.php');
}else{
    header('location: ../Registration/register.php');
}

?>
