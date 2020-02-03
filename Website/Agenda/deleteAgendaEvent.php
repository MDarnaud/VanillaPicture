<?php
// connect to the database
$db = mysqli_connect('localhost','root','','photography');

//get event information
$eventId = $_POST["eventId"];

//DELETE FROM table_name WHERE condition;
$queryDeleteEvent = "DELETE FROM events WHERE eventId='$eventId'";
mysqli_query($db, $queryDeleteEvent)or die(mysqli_error($db));

var_dump($queryDeleteEvent);
header("Location: agenda.php");
?>

