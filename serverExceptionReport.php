<?php

/* Get the form data and display form
 *
 */

// receive all input values from the form
$period = mysqli_real_escape_string($db, $_POST['period']);
$year = mysqli_real_escape_string($db, $_POST['password_1']);
$month = mysqli_real_escape_string($db, $_POST['password_1']);
$elements = mysqli_real_escape_string($db, $_POST['password_1']);

// first check the database to make sure
// a user does exist with the same email
$user_check_query = "SELECT * FROM all_user WHERE userId='$email'";
$resultUser = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($resultUser);


header('location: ./reports.php?reportSelect=exception');
?>
