<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}?>
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
                <div class="column">
                    <img src="dark/images/fulls/01.jpg">
                    <img src="dark/images/fulls/02.jpg">
                    <img src="dark/images/fulls/03.jpg">
                    <img src="dark/images/fulls/04.jpg">
                    <img src="dark/images/fulls/05.jpg">
                    <img src="dark/images/fulls/06.jpg">
                    <img src="dark/images/fulls/07.jpg">
                </div>
                <div class="column">
                    <img src="dark/images/fulls/08.jpg">
                    <img src="dark/images/fulls/09.jpg">
                    <img src="dark/images/fulls/10.jpg">
                    <img src="dark/images/fulls/11.jpg">
                    <img src="dark/images/fulls/12.jpg">
                    <img src="dark/images/fulls/01.jpg">
                </div>
                <div class="column">
                    <img src="dark/images/fulls/02.jpg">
                    <img src="dark/images/fulls/03.jpg">
                    <img src="dark/images/fulls/04.jpg">
                    <img src="dark/images/fulls/05.jpg">
                    <img src="dark/images/fulls/06.jpg">
                    <img src="dark/images/fulls/07.jpg">
                    <img src="dark/images/fulls/08.jpg">
                </div>
                <div class="column">
                    <img src="dark/images/fulls/09.jpg">
                    <img src="dark/images/fulls/10.jpg">
                    <img src="dark/images/fulls/11.jpg">
                    <img src="dark/images/fulls/12.jpg">
                    <img src="dark/images/fulls/01.jpg">
                    <img src="dark/images/fulls/02.jpg">
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