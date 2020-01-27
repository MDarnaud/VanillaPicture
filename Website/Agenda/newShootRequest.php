<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../emailTool/autoload.php';

// connect to the database
$db = mysqli_connect('localhost','root','','photography');

if($db->connect_error)
{
    echo $db->connect_error;
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//get user email (ID)
$customerEmail = $_SESSION["userSignIn"];

//GET FORM INFORMATION
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
//$result = mysqli_query($db, $queryShoot) or die(mysqli_error($db));





//SEND REQUEST EMAIL

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


$mail = new PHPMailer(true);
$mail->IsSMTP();
$mail->SMTPDebug = 1;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->IsHTML(true);
$mail->Username = "meganedarnaud@gmail.com"; //sender gmail
$mail->Password = 'Chat1234!'; //password for the gmail
try {
    //receiver, replace with email enter
    $mail->AddAddress("meganedarnaud@gmail.com");
} catch (Exception $e) {
    echo $e."add address";
}
try {
    //sender
    $mail->SetFrom("meganedarnaud@gmail.com");
} catch (Exception $e) {
    echo $e."set from";
}
$mail->Subject = $subject;
$mail->Body = $message;

try {
    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        $_SESSION['userNewAccount'] = $email;
        header('location: ./agenda.php?sendEmail=Your request has been sent to Vanilla Picture!');
    }
} catch (Exception $e) {
    echo $e."add address";
}
