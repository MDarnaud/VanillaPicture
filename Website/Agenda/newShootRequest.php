<?php


//Database Connection
include '../Header/dbConnection.php';

// Start the session
include '../Header/sessionConnection.php';



if($db->connect_error)
{
    echo $db->connect_error;
}

//get user email (ID)
$customerEmail = $_SESSION["userSignIn"];

//GET FORM INFORMATION
//title
$eventId = mysqli_real_escape_string($db, $_POST['eventId']);
//title
$shootTitle = mysqli_real_escape_string($db, $_POST['title']);
//date
$shootDate = mysqli_real_escape_string($db,$_POST["date"]);
//time
$shootTime = mysqli_real_escape_string($db,$_POST["time"]);
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
$shootPackage = mysqli_real_escape_string($db,$_POST["packageCategory"]);
//notes
$customerNotes = mysqli_real_escape_string($db,$_POST["customerNotes"]);


//get customer ID and name with email
$id_check_query = "SELECT * FROM customer WHERE userId='$customerEmail'";
$resultId = mysqli_query($db, $id_check_query);
$customer = mysqli_fetch_assoc($resultId);
//ID
$customerId = $customer['customerId'];
//Name
$name = $customer['customerFirstName'] . ' ' . $customer['customerLastName'];

//insert into table shoot the new request
$queryShoot = "INSERT INTO shoot (shootTime, shootDate, shootLocation, customerId, shootArtistType, shootCustomerNotes, shootPackage)
VALUES ('$shootTime', '$shootDate', '$shootTitle', '$customerId', '$artists', '$customerNotes', '$shootPackage')";
$result = mysqli_query($db, $queryShoot) or die(mysqli_error($db));

//delete event requested from agenda
$queryDeleteEvent = "DELETE FROM events WHERE eventId = '$eventId'";
$result = mysqli_query($db, $queryDeleteEvent) or die(mysqli_error($db));



//SEND REQUEST EMAIL
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <noreply@vanillapicture.rho.productions>' . "\r\n";

$subject = "New Shoot Request";
//Put right link
$message = 'A customer has requested a shoot in one of your availabilities <br>
            Customer Name: '. $name .'<br>
            Customer Email: '. $name .'<br>
            Location: '. $shootTitle .'<br>
            Date: '. $shootDate .'<br>
            Time: '. $shootTime .'<br>
            Artists Requested: '. $artists .'<br>
            Customer Notes: '. $customerNotes .'<br>
            Package chosen: '. $shootPackage .'<br>
            To communicate with '.$name.' Send a message to '. $customerEmail;

//TODO: Change this address
$to = 'arianeouellette@yahoo.ca';

mail($to,$subject,$message,$headers);

        header('location: ./agenda.php?sendEmail=Your request has been sent to Vanilla Picture!');

