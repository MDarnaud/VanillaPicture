<?php
//get event information
$eventId = $_GET["eventId"];


//file path
$file = "../../json/events.json";

//get file
$json = file_get_contents($file);
//put file into associative array
$eventsArray = json_decode($json,true);


var_dump($eventsArray);


/*for ($x = 0; sizeof($eventsArray); $x++) {


}*/



foreach($eventsArray as $key => $event) {
    foreach($event as $value){
        if($value == $eventId){
            unset($eventsArray[$key]);
        }
    }
}


//,JSON_PRETTY_PRINT
$jsonData = json_encode(array_values($eventsArray));
file_put_contents("../../json/events.json", $jsonData);
header("Location: agenda.php");
?>

