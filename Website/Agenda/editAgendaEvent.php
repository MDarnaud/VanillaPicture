<?php
// Database Connection
include '../Header/dbConnection.php';

//get event information
$eventId = $_POST["eventId"];
$eventTitle = $_POST["eventTitle"];

$eventStart = null;
$eventEnd = null;

if ($_POST["eventStart"] == $_POST["eventEnd"]){
    $eventStart = $_POST["eventStart"];
}
else{
    $eventStart = $_POST["eventStart"];
    $eventEndBad = $_POST["eventEnd"];
    echo $eventEnd;
    //add one day because the calendar excludes the end date
    $eventEnd = date('Y-m-d', strtotime($eventEndBad. ' +1 day'));

}

//update event;
$queryUpdateEvent = "UPDATE events SET eventTitle = '$eventTitle', eventStart = '$eventStart', eventEnd = '$eventEnd' WHERE eventId='$eventId'";
mysqli_query($db, $queryUpdateEvent)or die(mysqli_error($db));


header("Location: agenda.php");
?>

