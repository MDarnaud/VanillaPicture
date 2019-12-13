<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

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

        $name_check_query = "SELECT * FROM customer WHERE userId='$email'";
        $resultName = mysqli_query($db, $name_check_query);
        $nameValue = mysqli_fetch_assoc($resultName);

        $name = $nameValue['customerFirstName'].' '.$nameValue['customerLastName'];
        $subject = "Forgot your password for Vanilla Picture";
        $newpassword ='newnew';
        //Put right link
        $message = '<strong>Dear '.$name.',</strong><br>'.'You recently requested a new password for Vanilla Picture website. Your new password is '.$newpassword.'.<br>'.
            'Don\'t hesitate to change your password afterward with the "Change password" options available on the '.'<a href="http://localhost:63342/VanillaPicture/signIn.php?_ijt=312djvj2nntajak10m12o5ace9">Sign In</a> page.<br>'.
            '<br>Thank you, <br>Vanilla Picture';



        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->IsHTML(true);
        $mail->Username = "ariouellette2000@gmail.com"; //sender gmail
        $mail->Password = 'Spot6516'; //password for the gmail
        try {
            //receiver, replace with email enter
            $mail->AddAddress("arianeouellette@yahoo.ca");
        } catch (\PHPMailer\PHPMailer\Exception $e) {
        }
        try {
            //sender
            $mail->SetFrom("ariouellette2000@gmail.com");
        } catch (\PHPMailer\PHPMailer\Exception $e) {
        }
//        $mail->Subject = $subject . " from " . $name;
        $mail->Subject = $subject;
        $mail->Body = $message;

        try {
            if (!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
            }
        } catch (\PHPMailer\PHPMailer\Exception $e) {
        }


    }
}

