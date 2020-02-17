<?php

// Database Connection
include '../Header/dbConnection.php';

// Start the session
include '../Header/sessionConnection.php';

// initializing variables
$errors = array();
$email = "";


// REGISTER USER
if (isset($_POST['forgot_password'])) {
    // receive all input values from the form
    $email = mysqli_real_escape_string($db, $_POST['email']);

    // Form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($email)) {
        array_push($errors, "Email ");
    }

    // First check the database to make sure
    // a user does exist with the same email
    $user_check_query = "SELECT * FROM all_user WHERE userId='$email'";
    $resultUser = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($resultUser);

    // Verify if a record if found in the db
    if (!($user)) {
        //Verify if the user has already register
        if (!($user['userId'] === $email)) {
            array_push($errors, "Email does not exist. ");
        }
    } else {
        // Verify if the user is an administrator
        if($user['userType'] !== 'administrator') {
            // Forgot password steps
                // Send a new string password by mail
                // Hash the string and save it as the password in the database
                // User enters new string password and can change their password

            // Retrieve the name associated with the email address
            $name_check_query_customer = "SELECT * FROM customer WHERE userId='$email'";
            $resultNameCustomer = mysqli_query($db, $name_check_query_customer);

            // Verify if the email is found in the customer, if not search the model table
            if(mysqli_num_rows($resultNameCustomer)>0){
                $nameValueCustomer = mysqli_fetch_assoc($resultNameCustomer);
            }else{
                $name_check_query_model = "SELECT * FROM model WHERE userId='$email'";
                $resultNameModel = mysqli_query($db, $name_check_query_model);
                $nameValueModel = mysqli_fetch_assoc($resultNameModel);
            }


            // Generate a random new password
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

            // Hash password, encrypt the password before saving in the database
            $newHashedPasswordDb = password_hash($newPassword, PASSWORD_DEFAULT);

            // Insert the new hashed password in the table all_user in the database
            $queryPassword = "UPDATE all_user SET userPassword='$newHashedPasswordDb' WHERE userId='$email'";
            mysqli_query($db, $queryPassword);

            // Found the right name either for a model or customer
            if(mysqli_num_rows($resultNameCustomer)>0) {
                $name = $nameValueCustomer['customerFirstName'] . ' ' . $nameValueCustomer['customerLastName'];
            }else{
                $name = $nameValueModel['modelFirstName'] . ' ' . $nameValueModel['modelLastName'];
            }

            //TODO: Change this address
            $to = 'arianeouellette@yahoo.ca';

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <noreply@vanillapicture.rho.productions>' . "\r\n";

            $subject = "Forgot your password for Vanilla Picture";
            // Write the message for the email
            $message = '<strong>Dear ' . $name . ',</strong><br>' . 'You recently requested a new password for Vanilla Picture website. Your new password is <strong>' . $newPassword . '</strong>.<br>' .
                'Don\'t hesitate to change your password afterward with the "View Profile" options available after ' . '<a href="http://localhost:63342/VanillaPicture3/Website/SignIn/signIn.php">Sign In</a> .<br>' .
                '<br>Thank you, <br>Vanilla Picture';

            mail($to,$subject,$message,$headers);

                    header('location: signIn.php?sendEmail=Email successfully sent');

        }
        else{
            array_push($errors, "Administrators are not allowed to reset their password. ");
        }
    }
}


