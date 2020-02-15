<?php
// Database Connection
include '../Header/dbConnection.php';

//get event information
$eventId = $_POST["eventId"];
$eventTitle = $_POST["eventTitle"];
$eventStart = $_POST["eventStart"];
$eventEnd = $_POST["eventEnd"];

//update event;
$queryUpdateEvent = "UPDATE events SET title = '$eventTitle', start = '$eventStart', end = '$eventEnd' WHERE eventId='$eventId'";
mysqli_query($db, $queryUpdateEvent)or die(mysqli_error($db));


header("Location: agenda.php");
?>

