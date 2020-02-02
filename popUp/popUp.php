<a class="linkHomeAnnouncement" id="demo1">Delete</a>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/msc-style.css">
<link rel="icon" type="image/png" href="/favicon.png">
        <script src="js/msc-script.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var demobtn = document.querySelector("#demo1");
                demobtn.addEventListener("click", function () {
                    mscConfirm("Delete?", function () {

                    });
                });
            });
        </script>