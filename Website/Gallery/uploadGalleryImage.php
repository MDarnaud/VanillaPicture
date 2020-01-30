<?php
$errors = array();

// connect to the database
$db = mysqli_connect('localhost','root','','photography');

// Check if image file is a actual image or fake image
if(isset($_POST["submit_image"])) {

    // Caption & Category
    $category_form = mysqli_real_escape_string($db, $_POST['category']);
    $caption_form = mysqli_real_escape_string($db, $_POST['caption']);

    if (empty($category_form)) {
        array_push($errors, " Category is required.");
    }


    //Verify if brands
    if ($category_form === 'Brands') {
        $brandType = mysqli_real_escape_string($db, $_POST['brandsName']);
        if (empty($brandType)) {
            array_push($errors, " Please, select a Brand.");
        } else {
            $newBrand_form = $brandType;
            if ($brandType === 'Other') {
                if (empty($_POST['newBrand'])) {
                    array_push($errors, " Please enter the new Brand Name.");
                } else {
                    $newBrand_form = mysqli_real_escape_string($db, $_POST['newBrand']);
                }
            }
        }
    }

    //Verify if events
    if ($category_form === 'Events') {
        $eventType = mysqli_real_escape_string($db, $_POST['eventsName']);
        if (empty($eventType)) {
            array_push($errors, " Please, select an Event.");
        } else {
            $newEvent_form = $eventType;
            if ($eventType === 'Other') {
                if (empty($_POST['newEvent'])) {
                    array_push($errors, " Please enter the new Event Name.");
                } else {
                    $newEvent_form = mysqli_real_escape_string($db, $_POST['newEvent']);
                }
            }
        }
    }

    //Verify if portraits
    if ($category_form === 'Portraits') {
        $portraitType = mysqli_real_escape_string($db, $_POST['portraitsName']);
        if (empty($portraitType)) {
            array_push($errors, " Please, select a Portrait.");
        } else {
            $newPortrait_form = $portraitType;
            if ($portraitType === 'Other') {
                if (empty($_POST['newPortrait'])) {
                    array_push($errors, " Please enter the new Portrait Name.");
                } else {
                    $newPortrait_form = mysqli_real_escape_string($db, $_POST['newPortrait']);
                }
            }
        }
    }

    //Images
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if(isset($_FILES['fileToUpload'])) {
        $file_temp = $_FILES['fileToUpload']['tmp_name'];
        $info = getimagesize($file_temp);

    //If error here for tmp_name not found change size upload in php info()
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        array_push($errors, " File is not an image.");
        $uploadOk = 0;
    }

    if (count($errors) == 0) {
// Check if file already exists
        if (file_exists($target_file)) {
            array_push($errors, " Sorry, file already exists.");
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 5000000000000000) {
            array_push($errors, " Sorry, your file is too large.");
            $uploadOk = 0;
        }
// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            array_push($errors, " Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            array_push($errors, " Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
        } else {
// Valid file extensions
            $extensions_arr = array("jpg", "jpeg", "png", "gif");

// Check extension
            if (in_array($imageFileType, $extensions_arr)) {
                $fileName = $_FILES["fileToUpload"]["name"];
                $name = "uploads/" . $fileName;


                if (count($errors) == 0) {

                    if ($category_form === 'Brands') {
                        $queryImage = "INSERT INTO gallery (galleryTitle, galleryCategory, galleryImage, gallerySubCategory) VALUES('$caption_form','$category_form','$name','$newBrand_form')";
                    }
                    elseif($category_form === 'Events'){
                        $queryImage = "INSERT INTO gallery (galleryTitle, galleryCategory, galleryImage, gallerySubCategory) VALUES('$caption_form','$category_form','$name','$newEvent_form')";
                    }
                    elseif($category_form === 'Portraits'){
                        $queryImage = "INSERT INTO gallery (galleryTitle, galleryCategory, galleryImage, gallerySubCategory) VALUES('$caption_form','$category_form','$name','$newPortrait_form')";
                    }
                    else {
                        $queryImage = "INSERT INTO gallery (galleryTitle, galleryCategory, galleryImage) VALUES('$caption_form','$category_form','$name')";
                    }
                    mysqli_query($db, $queryImage);
                }
                if (mysqli_affected_rows($db) >= 1) {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        array_push($errors, "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.");
                    } else {
                        array_push($errors, " Sorry, there was an error uploading your file.");
                    }
                } else {
                    array_push($errors, " Sorry, there was an error uploading your file in the database.");
                }
            } else {
                array_push($errors, " Sorry, not the right type of file.");
            }
        }
    }
} else {
    array_push($errors, " File not sent to server succesfully!");
    }
}

?>
