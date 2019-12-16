<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// connect to the database
$db = mysqli_connect('localhost','root','','photography');
?>
<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Gallery</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/gallery.css" />

</head>
<body class="is-preload">

<?php include './navigation/navigation.php' ?>
<!-- Main -->
<div id="main">
    <div class="wrapper">
        <div class="inner">
            <a href="addImageForm.php"><span>&#43</span> Add Image</a>
            <!-- Elements -->
            <header class="major">
                <h1>Gallery</h1>
                <ul class="actions">
                    <li><button id="all" type="reset" value="All" onclick="location.href= './gallery.php?categorySelect=all'" >All</button></li>
                    <li><button id="travel" type="reset" value="Travel" onclick="location.href= './gallery.php?categorySelect=travel'"  >Travel</button></li>
                    <li><button id="events" type="reset" value="Events" onclick="location.href= './gallery.php?categorySelect=events'" >Events</button></li>
                    <li><button id="brands" type="reset" value="Brands" onclick="location.href= './gallery.php?categorySelect=brands'" >Brands</button></li>
                    <li><button id="individual" type="reset" value="Individual" onclick="location.href= './gallery.php?categorySelect=individuals'" >Individual</button></li>
                </ul>
            </header>
            <div class="row">
                    <?php
                    // x Access path in db
                    // x Do loop through all images
                    // x Add caption and other thing in form
                    // x Max of character caption form
                    // x Add other things in db
                    // x Made them not null available in db
                    // x Display picture
                    // x Add cancel button
                    // x After form add image succesfull or unsuccessful do something
                    // x Filter picture by category
                    //  people can zoom on pictures
                    //  Admin can delete picture
                    $categorySelected = '';
                    if(isset($_GET['categorySelect'])) {
                        $categorySelected = $_GET['categorySelect'];
                    }
                    if(!($categorySelected === ''||$categorySelected === 'all')){
                        // Select query for specific gallery elements
                        $gallery_check_query = "SELECT * FROM gallery WHERE galleryCategory='$categorySelected'";
                    }else {
//                         Select query for all gallery elements
                        $gallery_check_query = "SELECT * FROM gallery";
                        }
                    $gallery_result = mysqli_query($db, $gallery_check_query);

                    if (mysqli_affected_rows($db) >= 1) {
                        // Loop through all images
                        while ($gallery = mysqli_fetch_assoc($gallery_result)) {
                            $images[] = $gallery['galleryImage'];
                        }

                        // Initialize column index
                        $columnIndex = 1;

                        // Display images
                        echo '<div class="column 1">';

                        foreach ($images as $image) {
                            if ($columnIndex > 4) {
                                $columnIndex = 1;
                            }
                            if ($columnIndex == 1) {
                                echo '<img src="' . $image . '">';
                            }
                            $columnIndex++;
                        }
                        echo '</div>';

                        $columnIndex = 1;
                        echo '<div class="column">';
                        foreach ($images as $image) {
                            if ($columnIndex > 4) {
                                $columnIndex = 1;
                            }
                            if ($columnIndex == 2) {
                                echo '<img src="' . $image . '">';
                            }
                            $columnIndex++;
                        }
                        echo '</div>';

                        $columnIndex = 1;
                        echo '<div class="column">';
                        foreach ($images as $image) {
                            if ($columnIndex > 4) {
                                $columnIndex = 1;
                            }
                            if ($columnIndex == 3) {
                                echo '<img src="' . $image . '">';
                            }
                            $columnIndex++;
                        }
                        echo '</div>';

                        $columnIndex = 1;
                        echo '<div class="column">';
                        foreach ($images as $image) {
                            if ($columnIndex > 4) {
                                $columnIndex = 1;
                            }
                            if ($columnIndex == 4) {
                                echo '<img src="' . $image . '">';
                            }
                            $columnIndex++;
                        }
                        echo '</div>';
                    }
                    else{
                        echo '<p>The selected category has no pictures.</p>';
                    }
                    ?>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<div id="footer">
    <div class="wrapper style2">
        <div class="copyright">
            &copy; Untitled. All rights reserved. Lorem ipsum dolor sit amet.
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.dropotron.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>