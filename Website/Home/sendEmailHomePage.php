<?php
/*
 * use PHPMailer\PHPMailer\PHPMailer;
 * use PHPMailer\PHPMailer\SMTP;
 * use PHPMailer\PHPMailer\Exception;
 */

//require '../../emailTool/autoload.php';
//Db connection
include '../Header/dbConnection.php';
// Start the session
include '../Header/sessionConnection.php';

// Initializing variables
$errors = array();
$email = "";


// REGISTER USER
if (isset($_POST['sendMessage'])) {
    if (!isset($_SESSION['userSignIn']) || $_SESSION['userTypeSignIn'] !== 'administrator') {
        // Receive all input values from the form
        $name = $db->real_escape_string($_POST['name']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $message = mysqli_real_escape_string($db, $_POST['message']);


        // form validation: ensure that the form is correctly filled ...
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($name)) {
            array_push($errors, "Name ");
        }
        if (empty($email)) {
            array_push($errors, "Email ");
        }
        if (empty($message)) {
            array_push($errors, "Message ");
        }
        if(!empty($errors)){
            header('location: ./homepage.php?sendEmailHome=Please fill all fields.#getInTouch');
        }

        //TODO: Change this address
        $to = 'arianeouellette@yahoo.ca';

        $subject = "Vanilla Website - FAQ";
        // Put right link
        $message = '<strong>' . $name . ',</strong>' . ' has send you this message :<br>' . $message .
            '<br><br> ' . 'If you wish to reply, you can do so via ' . $email . '.';

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
        $headers .= 'From: <noreply@vanillapicture.rho.productions>' . "\r\n";

        mail($to,$subject,$message,$headers);

         header('location: ./homepage.php?sendEmailHome=Email successfully sent#getInTouch');

    } else {
       header('location: ./homepage.php?sendEmailHome=Administrators are not allowed to send FAQ email.#getInTouch');
    }
}


