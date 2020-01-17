<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// initializing variables
$errors = array();
$errorsDate = array();
$postAnnouncement = array();

// connect to the database
$db = mysqli_connect('localhost','root','','photography');

// REGISTER USER
if (isset($_POST['submit_announcement'])||isset($_POST['update_announcement'])) {
    // receive all input values from the form
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $detail = mysqli_real_escape_string($db, $_POST['detail']);
    $startDate = mysqli_real_escape_string($db, $_POST['startDate']);
    $endDate = mysqli_real_escape_string($db, $_POST['endDate']);
    $modelSearch = mysqli_real_escape_string($db, $_POST['modelPost']);
    if($modelSearch === 'modelPost'){
        $modelSearch = 1;
    }else{
        $modelSearch = 0;
    }


    // form validation: ensure that the form is correctly filled ...
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
    if (empty($modelSearch)) {
        array_push($errors, "Model Search Checkbox ");
    }

    //verify if end date is after start date
    if (!(strtotime($endDate) > strtotime($startDate))) {
        array_push($errorsDate, " End Date is before the start date.");
    }

    //verify if end date is after start date
    if (!(strtotime($endDate) > strtotime($startDate))) {
        array_push($errorsDate, " End Date is before the start date.");
    }
    //verify if end date is before now
    if (!(strtotime($endDate) > strtotime('now'))) {
        array_push($errorsDate, " End Date is before today's date.");
    }
}

    if (isset($_POST['submit_announcement'])) {
    // Insert if no errors
    if (count($errors) == 0 && count($errorsDate) == 0) {
    //Insert the announcement information in the table announcement in the database
        $queryAnnouncement = "INSERT INTO announcement (announcementTitle, announcementDetail, announcementStartDate, announcementEndDate, announcementModel) 
  			  VALUES('$title', '$detail', '$startDate', '$endDate', '$modelSearch')";
        mysqli_query($db, $queryAnnouncement);

        if (mysqli_affected_rows($db) >= 1) {
            array_push($postAnnouncement, " Announcement \" ".$title." \"is saved");
        }
    }
}

if(isset($_POST['update_announcement'])){
    // Insert if no errors
    if (count($errors) == 0 && count($errorsDate) == 0) {
        $id = mysqli_real_escape_string($db, $_POST['id']);
        //Insert the announcement information in the table announcement in the database
        $queryAnnouncement = "UPDATE announcement SET announcementDetail='$detail', announcementTitle='$title', announcementStartDate='$startDate', announcementEndDate='$endDate' WHERE announcementId='$id'";
        mysqli_query($db, $queryAnnouncement);

        if (mysqli_affected_rows($db) >= 1) {

            header("location: ./homepage.php");
        }
    }
}