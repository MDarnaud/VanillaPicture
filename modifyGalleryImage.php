<?php
// connect to the database
$db = mysqli_connect('localhost','root','','photography');

if(isset($_POST["save_caption"])) {
    // Caption
    $caption_form = mysqli_real_escape_string($db, $_POST['caption']);
    if($caption_form === ''){
        $caption_form = null;
    }
    $id_form = mysqli_real_escape_string($db, $_POST['imgId']);
    $category_form = mysqli_real_escape_string($db, $_POST['imgCategory']);
    $sub_category_form = mysqli_real_escape_string($db, $_POST['imgSubCategory']);

    $queryGalleryUpdate = "UPDATE gallery SET galleryTitle='$caption_form' WHERE galleryId='$id_form'";
    mysqli_query($db, $queryGalleryUpdate);

    $currentCategory = $_GET['categorySelect'];
    $currentSubCategory = $_GET['subCategorySelect'];

        if($currentCategory === 'Brands'||$currentCategory === 'Portraits'||$currentCategory === 'Events') {
            header("location: ./gallery.php?categorySelect=" . $currentCategory . "&subCategorySelect=" . $currentSubCategory . "#". $imgId);
        }else{
            header("location: ./gallery.php?categorySelect=" . $currentSubCategory. "#". $id_form);
        }

}
