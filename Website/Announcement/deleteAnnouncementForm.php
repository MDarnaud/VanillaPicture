
<?php
//Put this page to delete an announcement
//If you have time add a pop up
$annId = $_GET['announcementId'];
// connect to the database
$db = mysqli_connect('localhost','root','','photography');

//Find path of file
$path_announcement_query = "SELECT * FROM announcement WHERE announcementId='$annId'";
$result = mysqli_query($db, $path_announcement_query);
$path = mysqli_fetch_assoc($result);

//// Delete image in the database
$path_announcement_query = "DELETE FROM announcement WHERE announcementId = '$annId'";
mysqli_query($db, $path_announcement_query);

header('location: ../Home/homepage.php?DeleteMessage=The announcement "'.$path['announcementTitle'].'"has been deleted#announcementSection');
?>

