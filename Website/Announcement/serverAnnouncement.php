<?php
// Database Connection
include '../Header/dbConnection.php';

// Start the session
include '../Header/sessionConnection.php';

// Initializing variables
$errors = array();
$errorsDate = array();
$postAnnouncement = array();


// REGISTER USER
if (isset($_POST['submit_announcement'])||isset($_POST['update_announcement'])) {
    // Receive all input values from the form
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $detail = mysqli_real_escape_string($db, $_POST['detail']);
    $startDate = mysqli_real_escape_string($db, $_POST['startDate']);
    $endDate = mysqli_real_escape_string($db, $_POST['endDate']);
    if(isset( $_POST['modelPost'])){
        $modelSearch = mysqli_real_escape_string($db, $_POST['modelPost']);
        if($modelSearch === 'modelPost'){
            $modelSearch = 1;
        }
    }else{
        $modelSearch = 0;
    }



    // Form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($title)) {
        array_push($errors, "Title ");
    }
    if (empty($detail)) {
        array_push($errors, "Detail ");
    }
    if (empty($startDate)) {
        array_push($errors, "Start Date ");
    }
    if (empty($endDate)) {
        array_push($errors, "End Date ");
    }

    // Verify if end date is after start date
    if (strtotime($endDate) < strtotime($startDate)) {
        array_push($errorsDate, " End Date is before the start date.");
    }
    // Verify if end date is before now
    if (strtotime($endDate) < strtotime('now')) {
        array_push($errorsDate, " End Date is before today's date.");
    }
}

if (isset($_POST['submit_announcement'])) {
    $today =   date_create()->format('Y-m-d H:i:s');
    // Insert if no errors
    if (count($errors) == 0 && count($errorsDate) == 0) {
        // Insert the announcement information in the table announcement in the database
        $queryAnnouncement = "INSERT INTO announcement (announcementTitle, announcementDetail, announcementStartDate, announcementEndDate, announcementModel,announcementCreation) 
  			  VALUES('$title', '$detail', '$startDate', '$endDate', '$modelSearch','$today')";
        mysqli_query($db, $queryAnnouncement);

        if (mysqli_affected_rows($db) >= 1) {
            array_push($postAnnouncement, " Announcement \" " . $title . " \"is saved");
        }
    }
}

if(isset($_POST['update_announcement'])){

    // Insert if no errors
    if (count($errors) == 0 && count($errorsDate) == 0) {
        $id = mysqli_real_escape_string($db, $_POST['id']);
        // Insert the announcement information in the table announcement in the database
        $queryAnnouncement = "UPDATE announcement SET announcementDetail='$detail', announcementTitle='$title', announcementStartDate='$startDate', announcementEndDate='$endDate', announcementModel='$modelSearch' WHERE announcementId='$id'";
        mysqli_query($db, $queryAnnouncement);

        header("location: ../Home/homepage.php#announcementSection");
        /*if (mysqli_affected_rows($db) >= 1) { //does not work if no value is updated
            header("location: ../Home/homepage.php#announcementSection");
        }*/
    }
}