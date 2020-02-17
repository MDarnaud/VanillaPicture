<?php
// Start the session
include '../Header/sessionConnection.php';

include '../Header/dbConnection.php';

$amount = mysqli_real_escape_string($db, $_POST['amount']);
$email = $_SESSION['userSignIn'];


if ($amount != null and $email != null){
$queryEvent = "INSERT INTO payment (userId,paymentDate,paymentTotal)
VALUES ('$email', CURDATE(), '$amount')";
mysqli_query($db, $queryEvent)or die(mysqli_error($db));
$db->close();
}
?>