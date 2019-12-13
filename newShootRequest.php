<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// connect to the database
$db = mysqli_connect('localhost','root','','photography');

//get user email (ID)
$customerId = null;


//GET FORM INFORMATION
//title
$shootTitle = $_POST["title"];
//date
$shootDate = $_POST["date"];
//time
$shootTime = $_POST["time"];
//artists
$artists = null;
if(!empty($_POST["checkboxMakeup"])){
    $artists .= " makeup ";
}
if(!empty($_POST["checkboxHair"])){
    $artists .= " hair ";
}
if(!empty($_POST["checkboxStylist"])){
    $artists .= " stylist ";
}
//package chosen
$shootPackage = $_POST["packageCategory"];
//notes
$customerNotes = $_POST["customerNotes"];

//insert request to the database
$queryShoot = "INSERT INTO shoot (shootTime, shootDate, shootLocation, customerId, shootArtistType, shootCustomerNotes, shootPackage) 
  			  VALUES('$shootTime', '$shootDate', '$shootTitle', '$customerId', '$artists', '$customerNotes', '$shootPackage')";
mysqli_query($db, $queryShoot);
