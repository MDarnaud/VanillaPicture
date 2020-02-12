<?php
// Start the session
include '../Header/sessionConnection.php';

// connect to the database
$db = mysqli_connect('localhost','root','','photography');

/*$amount = mysqli_real_escape_string($db, $_POST['amount']);
$userId = mysqli_real_escape_string($db, $_POST['userId']);*/
$amount = $_COOKIE['paymentAmount'];
$userId = $_SESSION['userSignIn'];


$queryEvent = "INSERT INTO payment (userId,paymentDate,paymentTotal)
VALUES ('$userId', CURDATE(), '$amount')";
mysqli_query($db, $queryEvent)or die(mysqli_error($db));
$db->close();
?>