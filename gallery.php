<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'photography');
?>
<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Gallery</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link rel="stylesheet" href="assets/css/main.css"/>
    <link rel="stylesheet" href="assets/css/gallery.css"/>

</head>
<body class="is-preload">

<?php include './navigation/navigation.php' ?>
<!-- Main -->
<div id="main">
    <div class="wrapper">
        <div class="inner">
            <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] === 'administrator') { ?>
                <a href="addImageForm.php"><span>&#43</span> Add Image</a>
            <?php } ?>
            <!-- Elements -->
            <header class="major">
                <h1>Gallery</h1>
                <ul class="actions">
                    <li>
                        <button id="all" type="reset" value="All"
                                onclick="location.href= './gallery.php?categorySelect=all'">All
                        </button>
                    </li>
                    <li>
                        <button id="travel" type="reset" value="Travel"
                                onclick="location.href= './gallery.php?categorySelect=travel'">Travel
                        </button>
                    </li>
                    <li>
                        <button id="events" type="reset" value="Events"
                                onclick="location.href= './gallery.php?categorySelect=events'">Events
                        </button>
                    </li>
                    <?php
                    //Look for any brands name
                    $gallery_brand_name_query = "SELECT DISTINCT galleryBrand FROM gallery";
                    $gallery_result_brand_name = mysqli_query($db, $gallery_brand_name_query);
                    if (mysqli_num_rows($gallery_result_brand_name) > 0) {
                        while ($gallery_brand = mysqli_fetch_assoc($gallery_result_brand_name)) {
                            if ($gallery_brand['galleryBrand'] != null)
                                $brandsChoices[] = $gallery_brand['galleryBrand'];
                        }
                    }
                    ?>
                    <li class="dropdownBrands">
                        <button style="margin-bottom:7px;" id="brands" type="reset" value="Brands"
                                onclick="location.href= './gallery.php?categorySelect=brands'">Brands
                        </button>
                        <div class="dropContents">
                            <ul class="dropotron level-0 right"
                                style=" user-select:none; position:absolute; z-index:100000; opacity:1;margin-top: 0px;">
                                <?php if (mysqli_num_rows($gallery_result_brand_name) > 0) { ?>
                                    <?php foreach ($brandsChoices as $choiceBrand) : ?>
                                        <li style="cursor:pointer;padding-left:0px;">
                                            <button class="navdrop"
                                                    onclick="location.href= './gallery.php?categorySelect=brands&brandsName=<?php echo $choiceBrand; ?>'"
                                                    style="box-shadow:none;white-space: nowrap; "><small
                                                        style="color:white;"><?php echo $choiceBrand; ?></small>
                                            </button>
                                        </li>
                                    <?php endforeach; ?>
                                <?php } else { ?>
                                    <li style="cursor:pointer;padding-left:0px;">
                                        <button class="navdrop"
                                                onclick="location.href= './gallery.php?categorySelect=brands&'"
                                                style="box-shadow:none;white-space: nowrap; "><small
                                                    style="color:white;">All</small></button>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <button id="individual" type="reset" value="Individual"
                                onclick="location.href= './gallery.php?categorySelect=individual'">Individual
                        </button>
                    </li>
                </ul>
            </header>
            <div class="row">

                <!--                 The Modal -->
                <div id="myModal" class="modal" style="z-index:100;">

                    <!--                     The Close Button -->
                    <span class="closeModal">&times;</span>

                    <!--                     Modal Content (The Image) -->
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                    <?php if (isset($_SESSION['userSignIn']) && $_SESSION['userTypeSignIn'] === 'administrator') { ?>
                        <!--                     Modal Caption (Image Text) -->
                        <div id="deleteButton">
                            <button style="width:30%;border:1px solid white; color:white;background-color: transparent;"
                                    id="deleteImg" class="reset" value="deleteImg">Delete
                            </button>
                        </div>
                    <?php } else { ?>
                        <div id="buttons">
                            <button style="width:30%;border:1px solid white; color:white;background-color: transparent;"
                                    id="previousImg" class="reset" value="previousImg">Previous
                            </button>
                            <button style="width:30%;border:1px solid white; color:white;background-color: transparent;"
                                    id="nextImg" class="reset" value="nextImg">Next
                            </button>
                        </div>
                    <?php } ?>
                </div>
                <?php
                $categorySelected = '';
                if (isset($_GET['categorySelect'])) {
                    $categorySelected = $_GET['categorySelect'];
                }

                if (!($categorySelected === '' || $categorySelected === 'all')) {
                    // Select query for specific gallery elements
                    $gallery_check_query = "SELECT * FROM gallery WHERE galleryCategory='$categorySelected'";
                    if (isset($_GET['brandsName'])) {
                        $brandsNameSelected = $_GET['brandsName'];
                        if ($brandsNameSelected !== '') {
                            $gallery_check_query = "SELECT * FROM gallery WHERE galleryCategory='$categorySelected' AND galleryBrand='$brandsNameSelected'";
                        }
                    }
                } else {
//                         Select query for all gallery elements
                    $gallery_check_query = "SELECT * FROM gallery";
                }
                $gallery_result = mysqli_query($db, $gallery_check_query);

                if (mysqli_affected_rows($db) >= 1) {
                    // Loop through all images
                    while ($gallery = mysqli_fetch_assoc($gallery_result)) {
                        $images[] = $gallery['galleryImage'];
                        $ids[] = $gallery['galleryId'];
                        $captions[] = $gallery['galleryTitle'];
                        $brandsName[] = $gallery['galleryBrand'];
                    }

                    // Initialize column indexx
                    $columnIndex = 1;

                    // Display images
                    echo '<div class="column 1">';

                    for ($i = 0; $i < count($images); $i++) {
                        if ($columnIndex > 4) {
                            $columnIndex = 1;
                        }
                        if ($columnIndex == 1) {
                            echo '<img class="imgGallery" id="' . $ids[$i] . '"src="' . $images[$i] . '" alt="' . $captions[$i] . '" value="' . $brandsName[$i] . '">';
                        }
                        $columnIndex++;
                    }
                    echo '</div>';

                    $columnIndex = 1;
                    echo '<div class="column">';
                    for ($i = 0; $i < count($images); $i++) {
                        if ($columnIndex > 4) {
                            $columnIndex = 1;
                        }
                        if ($columnIndex == 2) {
                            echo '<img class="imgGallery" id="' . $ids[$i] . '"src="' . $images[$i] . '" alt="' . $captions[$i] . '" value="' . $brandsName[$i] . '">';
                        }
                        $columnIndex++;
                    }
                    echo '</div>';

                    $columnIndex = 1;
                    echo '<div class="column">';
                    for ($i = 0; $i < count($images); $i++) {
                        if ($columnIndex > 4) {
                            $columnIndex = 1;
                        }
                        if ($columnIndex == 3) {
                            echo '<img class="imgGallery" id="' . $ids[$i] . '"src="' . $images[$i] . '" alt="' . $captions[$i] . '" value="' . $brandsName[$i] . '">';
                        }
                        $columnIndex++;
                    }
                    echo '</div>';

                    $columnIndex = 1;
                    echo '<div class="column">';
                    for ($i = 0; $i < count($images); $i++) {
                        if ($columnIndex > 4) {
                            $columnIndex = 1;
                        }
                        if ($columnIndex == 4) {
                            echo '<img class="imgGallery" id="' . $ids[$i] . '"src="' . $images[$i] . '" alt="' . $captions[$i] . '" value="' . $brandsName[$i] . '">';
                        }
                        $columnIndex++;
                    }
                    echo '</div>';
                } else {
                    echo '<p>The selected category has no pictures.</p>';
                }
                ?>
                <script language='javascript' type='text/javascript'>
                    var modal = document.getElementById("myModal");

                    // Get the image and insert it inside the modal - use its "alt" text as a caption
                    var modalImg = document.getElementById("img01");
                    var captionText = document.getElementById("caption");
                    var imgs = document.getElementsByTagName("img");
                    var deleteButton = document.getElementById("deleteImg");
                    var nextButton = document.getElementById('nextImg');
                    var previousButton = document.getElementById('previousImg');
                    for (var i = 0; i < imgs.length; i++) {
                        var img = document.getElementById(imgs[i].id);
                        var curImageId = "";
                        img.onclick = function () {
                            // alert(curImageId);
                            var jsnewArrayId = new Array();
                            var jsnewArrayCaption = new Array();
                            var jsnewArraySource = new Array();
                            var jsnewArrayBrand = new Array();
                            <?php foreach($ids as $key => $val){ ?>
                            jsnewArrayId.push('<?php echo $val; ?>');
                            <?php } ?>
                            <?php foreach($captions as $key => $val){ ?>
                            jsnewArrayCaption.push('<?php echo $val; ?>');
                            <?php } ?>
                            <?php foreach($images as $key => $val){ ?>
                            jsnewArraySource.push('<?php echo $val; ?>');
                            <?php } ?>
                            <?php foreach($brandsName as $key => $val){ ?>
                            jsnewArrayBrand.push('<?php echo $val; ?>');
                            <?php } ?>


                            modal.style.zIndex = "20000";
                            modal.style.display = "block";
                            modalImg.src = this.src;
                            var altText = this.alt;
                            var brandName = this.getAttribute("value");
                            captionText.innerHTML = altText
                                <?php if(isset($_SESSION['userSignIn']) && $_SESSION['userTypeSignIn'] === 'administrator'):?>
                                + '&nbsp;' + '<a href="./modifyImageForm.php?modificationId=' + this.id + '" class="pencil"><i class="fa fa-pencil"></i></a>'
                                <?php endif; ?>.concat("<br><i>".concat(brandName.concat("</i>")));
                            curImageId = this.id;

                            if (this.id === jsnewArrayId[jsnewArrayId.length - 1]) {
                                // alert(nextId)
                                nextButton.style.visibility = "hidden";
                            } else {
                                nextButton.style.visibility = "visible";
                            }

                            if (this.id === jsnewArrayId[0]) {
                                previousButton.style.visibility = "hidden";
                            } else {
                                previousButton.style.visibility = "visible";
                            }

                            previousButton.onclick = function () {
                                var boolArray2 = false;
                                var previousId = "";
                                var previousCaption = "";
                                var previousSource = "";
                                var previousBrand = "";

                                for (var i = jsnewArrayId.length; i >= 0; i--) {
                                    if (boolArray2 === true) {
                                        previousId = jsnewArrayId[i];
                                        previousCaption = jsnewArrayCaption[i];
                                        previousSource = jsnewArraySource[i];
                                        previousBrand = jsnewArrayBrand[i];
                                        boolArray2 = false;
                                    }
                                    if (jsnewArrayId[i] === curImageId) {
                                        boolArray2 = true;
                                    }
                                }

                                if (previousId === jsnewArrayId[jsnewArrayId.length - 1]) {
                                    // alert(nextId)
                                    nextButton.style.visibility = "hidden";
                                } else {
                                    nextButton.style.visibility = "visible";
                                }

                                if (previousId === jsnewArrayId[0]) {
                                    previousButton.style.visibility = "hidden";
                                } else {
                                    previousButton.style.visibility = "visible";
                                }


                                modalImg.src = previousSource;
                                var altText = previousCaption;
                                var brandName = previousBrand;
                                captionText.innerHTML = altText
                                    <?php if(isset($_SESSION['userSignIn']) && $_SESSION['userTypeSignIn'] === 'administrator'):?>
                                    + '&nbsp;' + '<a href="./modifyImageForm.php?modificationId=' + previousId + '" class="pencil"><i class="fa fa-pencil"></i></a>'
                                    <?php endif; ?>.concat("<br><i>".concat(brandName.concat("</i>")));
                                curImageId = previousId;
                            };

                            nextButton.onclick = function () {
                                var boolArray = false;
                                var nextId = "";
                                var nextCaption = "";
                                var nextSource = "";
                                var nextBrand = "";

                                for (var i = 0; i < jsnewArrayId.length; i++) {
                                    if (boolArray === true) {
                                        nextId = jsnewArrayId[i];
                                        nextCaption = jsnewArrayCaption[i];
                                        nextSource = jsnewArraySource[i];
                                        nextBrand = jsnewArrayBrand[i];
                                        boolArray = false;
                                    }
                                    if (jsnewArrayId[i] === curImageId) {
                                        boolArray = true;
                                    }
                                }

                                if (nextId === jsnewArrayId[jsnewArrayId.length - 1]) {
                                    // alert(nextId)
                                    nextButton.style.visibility = "hidden";
                                } else {
                                    nextButton.style.visibility = "visible";
                                }

                                if (nextId === jsnewArrayId[0]) {
                                    previousButton.style.visibility = "hidden";
                                } else {
                                    previousButton.style.visibility = "visible";
                                }
                                modalImg.src = nextSource;
                                var altText = nextCaption;
                                var brandName = nextBrand;
                                captionText.innerHTML = altText
                                    <?php if(isset($_SESSION['userSignIn']) && $_SESSION['userTypeSignIn'] === 'administrator'):?>
                                    + '&nbsp;' + '<a href="./modifyImageForm.php?modificationId=' + nextId + '" class="pencil"><i class="fa fa-pencil"></i></a>'
                                    <?php endif; ?>.concat("<br><i>".concat(brandName.concat("</i>")));
                                curImageId = nextId;
                            };


                            <?php if(isset($_SESSION['userType']) && $_SESSION['userType'] === 'administrator'){?>

                                deleteButton.onclick = function () {
                                    <?php if(!isset($_GET["categorySelect"])){?>
                                    window.location.href = './deleteGalleryImage.php?categorySelect=&brandsName=&idImageDelete='.concat(imgId);
                                    <?php }else{?>
                                    <?php if(isset($_GET["brandsName"])){?>
                                    window.location.href = './deleteGalleryImage.php?categorySelect=<?php //////echo $_GET["categorySelect"];?>//////&brandsName=<?php //////echo $_GET["brandsName"];?>//////&idImageDelete='.concat(imgId);
                                    <?php }else{?>
                                    window.location.href = './deleteGalleryImage.php?categorySelect=<?php //////echo $_GET["categorySelect"];?>//////&brandsName=&idImageDelete='.concat(imgId);
                                    <?php } ?>
                                    <?php } ?>
                                };
                            <?php }?>
                        }
                    }


                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("closeModal")[0];

                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function () {
                        modal.style.display = "none";
                    }
                </script>
            </div>
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