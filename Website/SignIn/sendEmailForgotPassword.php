<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '..\..\emailTool\autoload.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// initializing variables
$errors = array();
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
        if($user['userType'] !== 'administrator') {
            //send a new string password by mail
            //hash the string and save it as the password in the database
            //user enters new string password and can change their password

            // Retrieve the name associated with the email address
            $name_check_query_customer = "SELECT * FROM customer WHERE userId='$email'";
            $resultNameCustomer = mysqli_query($db, $name_check_query_customer);
            if(mysqli_num_rows($resultNameCustomer)>0){
                $nameValueCustomer = mysqli_fetch_assoc($resultNameCustomer);
            }else{
                $name_check_query_model = "SELECT * FROM model WHERE userId='$email'";
                $resultNameModel = mysqli_query($db, $name_check_query_model);
                $nameValueModel = mysqli_fetch_assoc($resultNameModel);
            }


            // Generate a new password
            function randomPassword()
            {
                $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                do {
                    $pass = array(); //remember to declare $pass as an array
                    for ($i = 0; $i < 8; $i++) {
                        $n = rand(0, $alphaLength);
                        $pass[] = $alphabet[$n];
                    }
                }while (1 !== preg_match('~[0-9]~', implode($pass))||1 !== preg_match('~[A-Z]~', implode($pass)));

                return implode($pass); //turn the array into a string
            }

            $newPassword = randomPassword();
            //Insert the new hashed password in the table all_user in the database
            //Hash password
            //encrypt the password before saving in the database
            $newHashedPasswordDb = password_hash($newPassword, PASSWORD_DEFAULT);
            //Save in database
            $queryPassword = "UPDATE all_user SET userPassword='$newHashedPasswordDb' WHERE userId='$email'";
            mysqli_query($db, $queryPassword);

            if(mysqli_num_rows($resultNameCustomer)>0) {
                $name = $nameValueCustomer['customerFirstName'] . ' ' . $nameValueCustomer['customerLastName'];
            }else{
                $name = $nameValueModel['modelFirstName'] . ' ' . $nameValueModel['modelLastName'];
            }
            $subject = "Forgot your password for Vanilla Picture";
            //Put right link
            $message = '<strong>Dear ' . $name . ',</strong><br>' . 'You recently requested a new password for Vanilla Picture website. Your new password is <strong>' . $newPassword . '</strong>.<br>' .
                'Don\'t hesitate to change your password afterward with the "View Profile" options available after ' . '<a href="http://localhost:63342/VanillaPicture3/Website/SignIn/signIn.php">Sign In</a> .<br>' .
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
                    $_SESSION['userNewAccount'] = $email;
                    header('location: signIn.php?sendEmail=Email successfully sent');
                }
            } catch (\PHPMailer\PHPMailer\Exception $e) {
            }

        }
        else{
            array_push($errors, "Administrators are not allowed to reset their password. ");
        }
    }
}


