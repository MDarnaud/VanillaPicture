<?php

$errors = "";

// connect to the database
$db = mysqli_connect('localhost','root','','photography');

// Include server instead of action
if(isset($_POST['submit'])) {
// Receive all input values from the form
    $period = mysqli_real_escape_string($db, $_POST['period']);
    $year = mysqli_real_escape_string($db, $_POST['dropdownYear']);
    $month = mysqli_real_escape_string($db, $_POST['dropdownMonth']);
    $customer = mysqli_real_escape_string($db, $_POST['customer']);
    $announcement = mysqli_real_escape_string($db, $_POST['announcement']);
    $shoot = mysqli_real_escape_string($db, $_POST['shoot']);
    $payment = mysqli_real_escape_string($db, $_POST['payment']);

    // Filters
    // Customer
    $periodAge = mysqli_real_escape_string($db, $_POST['age']);
    $age = '';

    // Shoot
    //Location
    $locationShoot = mysqli_real_escape_string($db, $_POST['locationShoot']);
    $location = '';
    //Package
    $packageShoot = mysqli_real_escape_string($db, $_POST['packages']);
    $packages = '';
    //Payment
    $paymentShoot = mysqli_real_escape_string($db, $_POST['paymentAmount']);
    $paymentDropDown = '';



    if (empty($period)) {
        $errors = "Select a Year or Month. ";
    }
    elseif($year === '' && $month === '') {
        $errors = "Select a precise period. ";
    }


    if($errors === ''){
        if($periodAge === 'over'){
            $age = 'over';
        }
        elseif ($periodAge === 'under'){
            $age = 'under';
        }

        if($locationShoot != ''){
            $location = $locationShoot;
        }

        if($packageShoot != ''){
            $packages = $packageShoot;
        }

        if($paymentShoot !=''){
            $paymentDropDown = $paymentShoot;
        }
    }

    header('location: ./reportsException.php?reportSelect=exception&errors='.$errors.'&customer='.$customer.'&announcement='.$announcement
        .'&shoot='.$shoot.'&payment='.$payment.'&period='.$period.'&year='.$year.'&month='.$month.'&age='.$age
        .'&location='.$location.'&packages='.$packages.'&paymentDropDown='.$paymentDropDown);
}?>