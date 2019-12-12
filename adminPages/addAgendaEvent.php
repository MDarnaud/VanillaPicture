<?php
//get new user information
$eventTitle = $_POST["eventTitle"];
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
$url = "../requestForm.php";

//file path
$file = "../json/events.json";

//get file
$json = file_get_contents($file);
//put file into associative array
$eventsArray = json_decode($json,true);

//var_dump($eventsArray);

var_dump($isAvailability);

//create array to hold new user information
//array for user input
$newEventArray = array();
if($eventEnd == null){
    $newEventArray = array("title"=>$eventTitle,"start"=>$eventStart, "url"=>$url);
}
else if($isAvailability == false){
    $newEventArray = array("title"=>$eventTitle,"start"=>$eventStart, "end"=>$eventEnd);
}
else if($eventEnd == null && $isAvailability == false){
    $newEventArray = array("title"=>$eventTitle,"start"=>$eventStart);
}
else{
    $newEventArray = array("title"=>$eventTitle,"start"=>$eventStart, "end"=>$eventEnd, "url"=>$url);
}


//add user to file
//file_put_contents($file,json_encode($newEventArray,JSON_PRETTY_PRINT));
//header("Location:register.php");

array_push($eventsArray, $newEventArray);
$jsonData = json_encode($eventsArray,JSON_PRETTY_PRINT);
file_put_contents($file, $jsonData);

?>