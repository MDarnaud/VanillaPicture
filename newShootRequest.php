<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// connect to the database
$db = mysqli_connect('localhost','root','','photography');

//get user email (ID)
$customerEmail = $_SESSION["userSignIn"];


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
  			  VALUES('$shootTime', '$shootDate', '$shootTitle', '$customerEmail', '$artists', '$customerNotes', '$shootPackage')";
var_dump($queryShoot);
mysqli_query($db, $queryShoot);



//SEND REQUEST EMAIL
// Retrieve the name associated with the email address
$name_check_query = "SELECT * FROM customer WHERE userId='$customerEmail'";
$resultName = mysqli_query($db, $name_check_query);
$nameValue = mysqli_fetch_assoc($resultName);

$name = $nameValue['customerFirstName'] . ' ' . $nameValue['customerLastName'];
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
    $mail->AddAddress("meganedarnaud@hotmail.com");
} catch (\PHPMailer\PHPMailer\Exception $e) {
}
try {
    //sender
    $mail->SetFrom("ariouellette2000@gmail.com");
} catch (\PHPMailer\PHPMailer\Exception $e) {
}
//        $mail->Subject = $subject . " from " . $name;
$mail->Subject = $subject;
$mail->Body = $message;

try {
    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        $_SESSION['userNewAccount'] = $email;
        header('location: ./agenda.php?sendEmail=Your request has been sent to Vanilla Picture!'); //CREATE TEXTBOX IN AGENDA
    }
} catch (\PHPMailer\PHPMailer\Exception $e) {
    echo $e;
}
