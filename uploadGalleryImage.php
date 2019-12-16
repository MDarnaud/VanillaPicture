<?php
$errors = array();

// connect to the database
$db = mysqli_connect('localhost','root','','photography');

// Check if image file is a actual image or fake image
if(isset($_POST["submit_image"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        array_push($errors, " File is not an image.");
        $uploadOk = 0;
    }

    // Caption & Category
    $category_form = mysqli_real_escape_string($db, $_POST['category']);
    $caption_form = mysqli_real_escape_string($db, $_POST['caption']);

    if (empty($category_form)) {
        array_push($errors, " Category is required.");
    }
    if (empty($caption_form)) {
        array_push($errors, " Caption is required");
    }

    if (count($errors) == 0) {
// Check if file already exists
        if (file_exists($target_file)) {
            array_push($errors, " Sorry, file already exists.");
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000000) {
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
//            echo '<br>' . $name;
                $queryImage = "INSERT INTO gallery (galleryTitle, galleryCategory, galleryImage) VALUES('$caption_form','$category_form','$name')";
                mysqli_query($db, $queryImage);
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
// header("location: addImageForm.php");
}

?>
