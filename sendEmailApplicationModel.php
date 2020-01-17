<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// initializing variables
$errors = array();
$email = "";

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'photography');

// REGISTER USER
if (isset($_POST['submit_application'])) {
    // receive all input values from the form
    $experience = mysqli_real_escape_string($db, $_POST['experience']);
    if($experience === 'yes') {
        $years = mysqli_real_escape_string($db, $_POST['yearsExperience']);
    }
    $message = mysqli_real_escape_string($db, $_POST['message']);
    $email = $_SESSION['userSignIn'];
    $titleAnnouncement = mysqli_real_escape_string($db, $_POST['titleAnnouncement']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($experience)) {
        array_push($errors, "Experience ");
    }
    if($experience === 'yes'){
        if (empty($years)) {
            array_push($errors, "Years of Experience ");
        }
    }else{
        $years = 0;
    }
    if (empty($message)) {
        array_push($errors, "Message ");
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
        if($user['userType']=='model') {
            //send model application to the photographer by email
            //I the email gave the option to the photographer to request the cv
            //Send a email back to the model if request button press

            // Retrieve the name associated with the email address
            $name_check_query = "SELECT * FROM model WHERE userId='$email'";
            $resultName = mysqli_query($db, $name_check_query);
            $nameValue = mysqli_fetch_assoc($resultName);

            $name = $nameValue['modelFirstName'] . ' ' . $nameValue['modelLastName'];
            $subject = "Vanilla Website - Model " . $name;
            //Put right link
            $message = 'My name is <strong>' . $name . ',</strong><br>' . 'I applied on Vanilla Picture website for the announcement <b>"' . $titleAnnouncement . '"</b>. Here are the answers to my application: <br>'
                . '<ul>
                <li>Do you have experience? <strong>' . $experience . '</strong></li>
                <li>Years of experience: <b>' . $years . '</b></li>
                <li>Message : <b>'.$message.'</b></li>
              </ul><br>'. '<br>' .
                ' If you desire more informations or my CV, contact me with <b>'.$email.'</b><br>Thank you, <br>' . $name;


            $mail = new PHPMailer(true);
            $mail->IsSMTP();
            $mail->SMTPDebug = 1;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465;
            $mail->IsHTML(true);
            $mail->Username = "ariouellette2000@gmail.com"; //sender gmail (website address)
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
//                    header('location: ./homepage.php');
                    header('location: ./homepage.php?sendEmailApplication=Email successfully send#announcementSection');


                }
            } catch (\PHPMailer\PHPMailer\Exception $e) {
            }
        }
    }
}
