<?php
// initializing variables
$email    = "";
$errors = array();
$email = $_SESSION['userSignIn'];

// connect to the database
$db = mysqli_connect('localhost','root','','photography');

// REGISTER USER
if (isset($_POST['update_User'])) {
    // receive all input values from the form
    $country = mysqli_real_escape_string($db, $_POST['country']);
    $city = mysqli_real_escape_string($db, $_POST['city']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($country)) { array_push($errors, "Country "); }
    if (empty($city)) { array_push($errors, "City "); }
    if (empty($country)) { array_push($errors, "Country "); }


    //Update the customer information in the table customer in the database
    $queryCustomer = "UPDATE customer SET customerCountry='$country', customerCity='$city' WHERE userId='$email'";
    mysqli_query($db, $queryCustomer);
    if (mysqli_affected_rows($db) >= 1) {
        header('location: ./viewProfile.php');
    }

}

if (isset($_POST['change_PW_User'])) {
    // Retrieve new information in the form
    $password_current = mysqli_real_escape_string($db, $_POST['password_current']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // Verify if password field are empty, if so display errors message
    if (!(empty($password_current))||!(empty($password_1))||!(empty($password_2))) {
        if(empty($password_current)): array_push($errors, "Current Password ");
        endif;
        if(empty($password_1)): array_push($errors, "New Password");
        endif;
        if(empty($password_2)): array_push($errors, "Confirm New Password");
        endif;
    }
    if (count($errors) == 0) {
        $email = $_SESSION['userSignIn'];
        // Check the current password is the right one
        $user_check_query = "SELECT * FROM all_user WHERE userId='$email'";
        $userResult = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($userResult);

        $salt = $email;
        $password_current_hashed = md5($salt.$password_current);

        if($password_current_hashed === $user['userPassword']){
            //Update the customer information in the table customer in the database
            //Hash password
            $salt = $email;
            $newHashedPassword = md5($salt.$password_1);//encrypt the password before saving in the database
            $queryPW = "UPDATE all_user SET userPassword='$newHashedPassword' WHERE userId='$email'";
            mysqli_query($db, $queryPW);
            if (mysqli_affected_rows($db) >= 1) {
                header('location: ./viewProfile.php?changePasswordMessage=Password successfully changed.#changePasswordTitle');
            }else{
                header('location: ./viewProfile.php');
            }
        }
        else{
            array_push($errors, "Valid Current Password ");
        }
    }


}
