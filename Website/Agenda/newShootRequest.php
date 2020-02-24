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
$shootDateConv = strtotime($shootDate);
$shootTime = date("h:m A", $shootDateConv);


//message to customer
$messageEmail = null;

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

//check if shoot has already been requested
$queryCheckUnique = "SELECT count(shootId) as sameShoots FROM shoot WHERE customerId='$customerId' AND shootDate='$shootDate'";
$resultQueryCheckUnique = mysqli_query($db, $queryCheckUnique);
$isUniqueShoot = mysqli_fetch_assoc($resultQueryCheckUnique);
$textCheckUnique = $isUniqueShoot['sameShoots'];


if($textCheckUnique == 0 ) {
//insert into table shoot the new request
    $queryShoot = "INSERT INTO shoot (shootDate, shootTime, shootLocation, customerId, shootArtistType, shootCustomerNotes, shootPackage)
VALUES ('$shootDate', '$shootTime', '$shootTitle', '$customerId', '$artists', '$customerNotes', '$shootPackage')";
    $result = mysqli_query($db, $queryShoot) or die(mysqli_error($db));

//Hide event
    $queryHideEvent = "UPDATE events SET eventHidden = 'true' WHERE eventId='$eventId'";
    mysqli_query($db, $queryHideEvent) or die(mysqli_error($db));

    //confirm message
    $messageEmail = "<div class=\"isa_success\"><i class=\"fa fa-check-circle\"></i>Your request has been sent to Vanilla Picture!</div>";
}
else {
    //confirm message
    $messageEmail = "<div class=\"isa_error\"><i class=\"fa fa-times-circle\"></i>You have already made this request</div>";
}


//SEND REQUEST EMAIL
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <noreply@vanillapicture.rho.productions>' . "\r\n";

$subject = "Vanilla Website - New Shoot Request";
//Put right link
$message = '<strong>' . $name . '</strong> has requested the shoot <b>"' . $shootTitle . '" on Vanilla Picture website. <br> </b>. Here are the details: <br>'
    . '<ul>
                <li>Shoot Date: <b>' . $shootDate . '</b></li>
                <li>Shoot Time: <b>' . $shootTime . '</b></li>
                <li>Customer Email <b>' . $customerEmail . '</b></li>
                <li>Artists Requested: <b>' . $artists . '</b></li>
                <li>Package Chosen : <b>'.$shootPackage.'</b></li>
                <li>Notes : <b>'.$customerNotes.'</b></li>
              </ul><br>'. '<br>' .
    ' To communicate with '.$name.' Send a message to '. $customerEmail.'</b>';

//TODO: Change this address
$to = 'arianeouellette@yahoo.ca';

mail($to,$subject,$message,$headers);

header("location: ./agenda.php?sendEmail=$messageEmail");

