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
    $brand_name_form = mysqli_real_escape_string($db, $_POST['imgBrandName']);

    $queryGalleryUpdate = "UPDATE gallery SET galleryTitle='$caption_form' WHERE galleryId='$id_form'";
    mysqli_query($db, $queryGalleryUpdate);

        if($category_form === 'Brands') {
            header("location: ./gallery.php?categorySelect=" . $category_form . "&brandName=" . $brand_name_form);
        }else{
            header("location: ./gallery.php?categorySelect=" . $category_form);
        }

}
