<?php

//Put this page to delete an announcement
//If you have time add a pop up
$annId = $_GET['announcementId'];
// connect to the database
$db = mysqli_connect('localhost','root','','photography');

//Find path of file
$path_get_query = "SELECT * FROM gallery WHERE galleryId='$imgId'";
$result = mysqli_query($db, $path_get_query);
$path = mysqli_fetch_assoc($result);

$file_pointer = $path['galleryImage'];
// Use unlink() function to delete a file
if (!unlink($file_pointer)) {
    echo ("$file_pointer cannot be deleted due to an error");
}
else {

//  Delete image in the database
    $queryGallery = "DELETE FROM gallery WHERE galleryId = '$imgId'";
    mysqli_query($db, $queryGallery);

    header('location: ./gallery.php?categorySelect='.$_GET["categorySelect"].'&brandsName='.$_GET["brandsName"]);
}
?>