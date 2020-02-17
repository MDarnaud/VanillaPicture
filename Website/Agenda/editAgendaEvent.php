<?php
// Database Connection
include '../Header/dbConnection.php';

//get event information
$eventId = $_POST["eventId"];
$eventTitle = $_POST["eventTitle"];
$eventStart = $_POST["eventStart"]."T00:00:00";
$eventEnd = $_POST["eventEnd"]."T01:00:00";

//update event;
$queryUpdateEvent = "UPDATE events SET eventTitle = '$eventTitle', eventStart = '$eventStart', eventEnd = '$eventEnd' WHERE eventId='$eventId'";
mysqli_query($db, $queryUpdateEvent)or die(mysqli_error($db));


header("Location: agenda.php");
?>

