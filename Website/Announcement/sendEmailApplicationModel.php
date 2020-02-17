<?php

// Database Connection
include '../Header/dbConnection.php';

// Start the session
include '../Header/sessionConnection.php';

// initializing variables
$errors = array();
$email = "";

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

            //TODO: Change this address
            $to = 'arianeouellette@yahoo.ca';

            $name = $nameValue['modelFirstName'] . ' ' . $nameValue['modelLastName'];
            $subject = "Vanilla Website - Model " . $name;
            //Put right link
            $message = '<strong>' . $name . '</strong> has applied to the announcement <b>"' . $titleAnnouncement . '" on Vanilla Picture website. <br> </b>. Here are the answers to his/her application: <br>'
                . '<ul>
                <li>Do you have experience? <strong>' . $experience . '</strong></li>
                <li>Years of experience: <b>' . $years . '</b></li>
                <li>Message : <b>'.$message.'</b></li>
              </ul><br>'. '<br>' .
                ' If you wish to contact this potentiel model, do so via <b>'.$email.'</b>';

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
            $headers .= 'From: <noreply@vanillapicture.rho.productions>' . "\r\n";

            mail($to,$subject,$message,$headers);

                    header('location: ../Home/homepage.php?sendEmailApplication=Email successfully send#announcementSection');

        }
    }
}
