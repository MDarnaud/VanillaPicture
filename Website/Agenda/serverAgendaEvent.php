<?php
//get new user information
$eventTitle = $_POST["eventTitle"];
$eventId = $_POST["eventId"];
//add location to title if it was precised
if($_POST["eventLocation"] != null){
    $eventTitle .= " - Location: ".$_POST["eventLocation"];
}
$eventStart = $_POST["eventStart"];
$eventEnd = $_POST["eventEnd"];
$isAvailability = true;

if(empty($_POST["isAvailability"])){
    $isAvailability = false;
}


//go to request if availability is checked
$url = "requestShootForm.php";

//file path
$file = "../../json/events.json";

//get file
$json = file_get_contents($file);
//put file into associative array
$eventsArray = json_decode($json,true);


//create array to hold new user information
//array for user input
$newEventArray = array();
if($eventEnd == null){
    $newEventArray = array("id"=>$eventId,"title"=>$eventTitle,"start"=>$eventStart, "url"=>$url);
}
else if($isAvailability == false){
    $newEventArray = array("id"=>$eventId,"title"=>$eventTitle,"start"=>$eventStart, "end"=>$eventEnd);
}
else if($eventEnd == null && $isAvailability == false){
    $newEventArray = array("id"=>$eventId,"title"=>$eventTitle,"start"=>$eventStart);
}
else{
    $newEventArray = array("id"=>$eventId,"title"=>$eventTitle,"start"=>$eventStart, "end"=>$eventEnd, "url"=>$url);
}

array_push($eventsArray, $newEventArray);
$jsonData = json_encode($eventsArray,JSON_PRETTY_PRINT);
file_put_contents($file, $jsonData);
header("Location: agenda.php");

?>