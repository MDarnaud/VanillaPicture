<?php
// initializing variables
$email    = "";
$password_1 = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost','root','','photography');

// REGISTER USER
if (isset($_POST['update_User'])) {
    // receive all input values from the form
    $country = mysqli_real_escape_string($db, $_POST['country']);
    $city = mysqli_real_escape_string($db, $_POST['city']);
    $email = $_SESSION['userSignIn'];

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($country)) { array_push($errors, "Country "); }
    if (empty($city)) { array_push($errors, "City "); }

    //Update the customer information in the table customer in the database
    $queryCustomer = "UPDATE customer SET customerCountry='$country', customerCity='$city' WHERE userId='$email'";
    mysqli_query($db, $queryCustomer);
    if (mysqli_affected_rows($db) >= 1) {
        header('location: ./viewProfile.php');
    }

}
