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
$periodAge = "";



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
                if (isset($_POST['age'])) {
                    $periodAge = mysqli_real_escape_string($db, $_POST['age']);
                }
                // Variables
                if ($periodAge === 'over') {
                    $age = 'over';
                } elseif ($periodAge === 'under') {
                    $age = 'under';
                }
            }
            if (isset($_POST['announcement'])) {
                $announcement = mysqli_real_escape_string($db, $_POST['announcement']);
            }
            if (isset($_POST['shoot'])) {
                $shoot = mysqli_real_escape_string($db, $_POST['shoot']);
                // Filters
                //Location
                if(isset($_POST['locationShoot'])){
                $location = mysqli_real_escape_string($db, $_POST['locationShoot']);
            }

                //Package
                if(isset($_POST['packages'])) {
                    $packages = mysqli_real_escape_string($db, $_POST['packages']);
                }

            }
            if (isset($_POST['payment'])) {
                $payment = mysqli_real_escape_string($db, $_POST['payment']);
                // Filters
                if (isset( $_POST['paymentAmount'])) {
                    $paymentDropDown = mysqli_real_escape_string($db, $_POST['paymentAmount']);
                }
            }
        }
    }






    header('location: ./reportsException.php?reportSelect=exception&errors='.$errors.'&customer='.$customer.'&announcement='.$announcement
        .'&shoot='.$shoot.'&payment='.$payment.'&period='.$period.'&year='.$year.'&month='.$month.'&age='.$age
    .'&location='.$location.'&packages='.$packages.'&paymentDropDown='.$paymentDropDown);
}?>
