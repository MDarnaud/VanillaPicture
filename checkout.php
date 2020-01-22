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
    <title>Vanilla Picture</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body class="is-preload">

<?php include './navigation/navigation.php' ?>

<div class="gift-up-target" data-site-id="c0505ce1-43e3-4979-bd71-77d36060e96c" data-platform="Other"></div>
<script type="text/javascript">
    (function (g, i, f, t, u, p, s) {
        g[u] = g[u] || function() { (g[u].q = g[u].q || []).push(arguments) };
        p = i.createElement(f);
        p.async = 1;
        p.src = t;
        s = i.getElementsByTagName(f)[0];
        s.parentNode.insertBefore(p, s);
    })(window, document, 'script', 'https://cdn.giftup.app/dist/gift-up.js', 'giftup');
</script>



<!-- Footer -->
<div id="footer">
    <div class="wrapper style2">
        <div class="copyright">
            &copy; Untitled. All rights reserved. Vanilla Picture.
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
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
</body>
</html>


