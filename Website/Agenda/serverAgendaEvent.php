<?php
// connect to the database
$db = mysqli_connect('localhost','root','','photography');

//get new user information
$eventTitle = $_POST["eventTitle"];
$eventId = $_POST["eventId"];
//add location to title if it was precised
if($_POST["eventLocation"] != null){
    $eventTitle .= " - Location: ".$_POST["eventLocation"];
}
$eventStart = $_POST["eventStart"];
$eventEnd = $_POST["eventEnd"];
$isAvailability = false;
$url = null;

if(!empty($_POST["isAvailability"])){
    $isAvailability = true;
    //go to request if availability is checked
    $url = "requestShootForm.php";
}

//Insert the new event
if($eventEnd == null){
    $queryEvent = "INSERT INTO events (eventId, title, start, url)
                    VALUES('$eventId', '$eventTitle', '$eventStart', '$url')";
    mysqli_query($db, $queryEvent)or die(mysqli_error($db));

    var_dump($queryEvent);
}
else if($isAvailability == false){
    $queryEvent = "INSERT INTO events (eventId, title, start, end)
                    VALUES('$eventId', '$eventTitle', '$eventStart', '$eventEnd')";
    mysqli_query($db, $queryEvent)or die(mysqli_error($db));


}
else if($eventEnd == null && $isAvailability == false){
    $queryEvent = "INSERT INTO events (eventId, title, start)
                    VALUES('$eventId', '$eventTitle', '$eventStart')";
    mysqli_query($db, $queryEvent)or die(mysqli_error($db));


}
else{
    $queryEvent = "INSERT INTO events (eventId, title, start, end, url)
                    VALUES('$eventId', '$eventTitle', '$eventStart', '$eventEnd', '$url')";
    mysqli_query($db, $queryEvent) or die(mysqli_error($db));


}

header("Location: agenda.php");


?>