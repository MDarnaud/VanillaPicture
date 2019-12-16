<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// connect to the database
$db = mysqli_connect('localhost','root','','photography');
?>
<!DOCTYPE HTML>
<html lang="en">
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
                    <li><button type="reset" value="Cancel" >All</button></li>
                    <li><button type="reset" value="Travel" >Travel</button></li>
                    <li><button type="reset" value="Events" >Events</button></li>
                    <li><button type="reset" value="Brands" >Brands</button></li>
                    <li><button type="reset" value="Individual" >Individual</button></li>
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
                    // Display picture
                    //  Admin can delete picture
                    //  people can zoom on pictures


                    // Select query for all gallery elements
                    $gallery_check_query = "SELECT * FROM gallery";
                    $gallery_result = mysqli_query($db, $gallery_check_query);

                    // Loop through all images
                    while($gallery = mysqli_fetch_assoc($gallery_result)){
                        $images[] = $gallery['galleryImage'];
                    }

                     // Initialize column index
                    $columnIndex = 1;
                    // Display images

                    echo '<div class="column">';
                    foreach($images as $image) {
                        if($columnIndex < 4){
                            $columnIndex == 1;
                        }
                        if ($columnIndex == 1) {
                            echo '<img src="'.$image.'">';
                        }
                        $columnIndex ++;
                    }
                    echo '</div>';

                    $columnIndex = 1;
                    echo '<div class="column">';
                    foreach($images as $image) {
                        if($columnIndex < 4){
                            $columnIndex == 1;
                        }
                        if ($columnIndex == 2) {
                            echo '<img src="'.$image.'">';
                        }
                        $columnIndex ++;
                    }
                    echo '</div>';

                    $columnIndex = 1;
                    echo '<div class="column">';
                    foreach($images as $image) {
                        if($columnIndex < 4){
                            $columnIndex == 1;
                        }
                        if ($columnIndex == 3) {
                            echo '<img src="'.$image.'">';
                        }
                        $columnIndex ++;
                    }
                    echo '</div>';

                    $columnIndex = 1;
                    echo '<div class="column">';
                    foreach($images as $image) {
                        if($columnIndex < 4){
                            $columnIndex == 1;
                        }
                        if ($columnIndex == 4) {
                            echo '<img src="'.$image.'">';
                        }
                        $columnIndex ++;
                    }
                    echo '</div>';

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