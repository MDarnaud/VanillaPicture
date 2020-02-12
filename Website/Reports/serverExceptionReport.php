<?php

$errors = "";

// Database Connection
include '../Header/dbConnection.php';

// Initialize variables
$errors = "";
$customer = "";
$announcement = "";
$shoot = "";
$payment = "";
$period = "";
$year = "";
$month = "";
$age = "";
$location = "";
$packages = "";
$paymentDropDown = "";



// Include server instead of action
if(isset($_POST['submit'])) {
// Receive all input values from the form
    $period = mysqli_real_escape_string($db, $_POST['period']);
    if($period === "year"){
        $year = mysqli_real_escape_string($db, $_POST['dropdownYear']);
    }elseif ($period === "month"){
        $month = mysqli_real_escape_string($db, $_POST['dropdownMonth']);
    }

    //Errors
    if (empty($period)) {
        $errors = "Select a Year or Month. ";
    }
    elseif($year === '' && $month === '') {
        $errors = "Select a precise period. ";
    }

    if($errors === '') {
        if ($year != "" || $month != "") {
            if (isset($_POST['customer'])) {
                $customer = mysqli_real_escape_string($db, $_POST['customer']);
                // Filters
                // Customer
                $periodAge = mysqli_real_escape_string($db, $_POST['age']);
                $age = '';

                // Variables
                if ($periodAge === 'over') {
                    $age = 'over';
                } elseif ($periodAge === 'under') {
                    $age = 'under';
                }
            }
            if (isset($_POST['announcement'])) {
                $announcement = mysqli_real_escape_string($db, $_POST['announcement']);
                //Filters

            }
            if (isset($_POST['shoot'])) {
                $shoot = mysqli_real_escape_string($db, $_POST['shoot']);
                // Filters
                //Location
                $locationShoot = mysqli_real_escape_string($db, $_POST['locationShoot']);
                $location = '';
                //Package
                $packageShoot = mysqli_real_escape_string($db, $_POST['packages']);
                $packages = '';

                // Variables
                if ($locationShoot != '') {
                    $location = $locationShoot;
                }
            }
            if (isset($_POST['payment'])) {
                $payment = mysqli_real_escape_string($db, $_POST['payment']);
                // Filters
                $paymentShoot = mysqli_real_escape_string($db, $_POST['paymentAmount']);
                $paymentDropDown = '';

                // Variables
                if ($packageShoot != '') {
                    $packages = $packageShoot;
                }
            }
        }
    }






    header('location: ./reportsException.php?reportSelect=exception&errors='.$errors.'&customer='.$customer.'&announcement='.$announcement
        .'&shoot='.$shoot.'&payment='.$payment.'&period='.$period.'&year='.$year.'&month='.$month.'&age='.$age
    .'&location='.$location.'&packages='.$packages.'&paymentDropDown='.$paymentDropDown);
}?>
