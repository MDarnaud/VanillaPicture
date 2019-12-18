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
        <title>Reports</title>
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
            <!-- Elements -->
            <header class="major">
                <h1>Reports</h1>
                <ul class="actions">
                    <li><button id="Summary" type="reset" value="Summary" onclick="location.href= './reports.php?reportSelect=summary'" >Summary</button></li>
                    <li><button id="Detail" type="reset" value="Detail" onclick="location.href= './reports.php?reportSelect=detail'" >Detail</button></li>
                    <li><button id="Exception" type="reset" value="Exception" onclick="location.href= './reports.php?reportSelect=exception'"  >Exception</button></li>
                    </ul>
            </header>
<!--        Set or retrieve the choosen type of report-->
            <?php
            $reportSelect = '';
            if(isset($_GET['reportSelect'])) {
                $reportSelect= $_GET['reportSelect'];
            }else{
                $reportSelect = 'summary';
            }
            ?>

<!--        Summary Report-->
            <?php
            if($reportSelect === 'summary'){





            }
            ?>








<!--        Detail Report-->
            <?php
            if($reportSelect === 'detail'){
                echo 'detail';
            }
            ?>
<!--        Exception Report-->
            <?php
            if($reportSelect === 'exception'){
                echo 'exception';
            }
            ?>




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
