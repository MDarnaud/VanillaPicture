<?php
// Database Connection
include '../Header/dbConnection.php';

//get event information
$eventId = $_GET["eventId"];

//DELETE FROM table_name WHERE condition;
$queryDeleteEvent = "DELETE FROM events WHERE eventId='$eventId'";
mysqli_query($db, $queryDeleteEvent)or die(mysqli_error($db));

var_dump($queryDeleteEvent);
header("Location: agenda.php");
?>

