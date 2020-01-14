<?php

/*
 * Display the write table according to elements selected
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

    //Filters
        //Customer
        $overAge = mysqli_real_escape_string($db, $_POST['over']);
        $underAge = mysqli_real_escape_string($db, $_POST['under']);
        $age = '';

        //Shoot
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
        if($overAge === 'over'){
            $age = 'over';
        }
        elseif ($underAge === 'under'){
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

    header('location: ./reports.php?reportSelect=exception&errors='.$errors.'&customer='.$customer.'&announcement='.$announcement
        .'&shoot='.$shoot.'&payment='.$payment.'&period='.$period.'&year='.$year.'&month='.$month.'&age='.$age
    .'&location='.$location.'&packages='.$packages.'&paymentDropDown='.$paymentDropDown);
}?>
