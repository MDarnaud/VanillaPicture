<?php
//Database Connection
include '../Header/dbConnection.php';

//get new user information
$eventTitle = $_POST["eventTitle"];
$eventId = $_POST["eventId"];
//add location to title if it was precised
if($_POST["eventLocation"] != null){
    $eventTitle .= " - Location: ".$_POST["eventLocation"];
}
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

$isAvailability = false;
$url = null;
$color = "#5f9ea0";

if(isset($_POST["isAvailability"])){
    $isAvailability = true;
    //go to request if availability is checked
    $url = "requestShootForm.php";
    $color = "#33cccc"; //shoot available
}

//Insert the new event
if($eventEnd == null && $isAvailability == true){
    $queryEvent = "INSERT INTO events (eventId, eventTitle, eventStart, eventUrl, eventColor)
                    VALUES('$eventId', '$eventTitle', '$eventStart', '$url', '$color')";
    mysqli_query($db, $queryEvent)or die(mysqli_error($db));

}
else if($eventEnd == null && $isAvailability == false){
    $queryEvent = "INSERT INTO events (eventId, eventTitle, eventStart, eventColor)
                    VALUES('$eventId', '$eventTitle', '$eventStart', '$color')";
    mysqli_query($db, $queryEvent)or die(mysqli_error($db));
}
else if($isAvailability == false){
    $queryEvent = "INSERT INTO events (eventId, eventTitle, eventStart, eventEnd, eventColor)
                    VALUES('$eventId', '$eventTitle', '$eventStart', '$eventEnd', '$color')";
    mysqli_query($db, $queryEvent)or die(mysqli_error($db));
}
else{
    $queryEvent = "INSERT INTO events (eventId, eventTitle, eventStart, eventEnd, eventUrl, eventColor)
                    VALUES('$eventId', '$eventTitle', '$eventStart', '$eventEnd', '$url', '$color')";
    mysqli_query($db, $queryEvent) or die(mysqli_error($db));


}

header("Location: agenda.php");


?>