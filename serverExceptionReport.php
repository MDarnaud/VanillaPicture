<?php

/* Get the form data
 * Display error message when field empty
 * Display the write table
 * Display the right informations
 * Megane message to do it
 */

$errors = "";

// connect to the database
$db = mysqli_connect('localhost','root','','photography');


//incude server instead of action
if(isset($_POST['submit'])) {
// receive all input values from the form
    $period = mysqli_real_escape_string($db, $_POST['period']);
    $year = mysqli_real_escape_string($db, $_POST['dropdownYear']);
    $month = mysqli_real_escape_string($db, $_POST['dropdownMonth']);
    $customer = mysqli_real_escape_string($db, $_POST['customer']);
    $announcement = mysqli_real_escape_string($db, $_POST['announcement']);
    $shoot = mysqli_real_escape_string($db, $_POST['shoot']);
    $payment = mysqli_real_escape_string($db, $_POST['payment']);


    if (empty($period)) {
        $errors = "Select a Year or Month. ";
    }
    elseif($year === '' && $month === '') {
        $errors = "Select a precise period. ";
    }

    header('location: ./reports.php?reportSelect=exception&errors='.$errors);
}?>
