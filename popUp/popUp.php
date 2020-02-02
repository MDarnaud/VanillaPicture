<link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/msc-style.css">
<link rel="icon" type="image/png" href="/favicon.png">
<html>
<body>
<p><button id="demo1">Simplest</button> </p>
<script src="js/msc-script.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var demobtn = document.querySelector("#demo1");
        demobtn.addEventListener("click", function () {
            mscConfirm("Delete?", function () {
                mscAlert("Post deleted");
            });
        });
    });
</script>
</body>
</html>