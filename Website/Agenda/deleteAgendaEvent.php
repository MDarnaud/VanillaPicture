<?php
// Database Connection
include '../Header/dbConnection.php';

//get event information
$eventId = $_GET["eventId"];

//delete event requested from agenda
$queryDeleteEvent = "DELETE FROM events WHERE eventId = '$eventId'";
$result = mysqli_query($db, $queryDeleteEvent) or die(mysqli_error($db));

header("Location: agenda.php");


