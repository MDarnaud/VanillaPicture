<?php
// connect to the database
$db = mysqli_connect('localhost','root','','photography');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'sendEmailApplicationModel.php';
?>
    <!DOCTYPE HTML>
    <html lang="en">
    <head>
        <title>Model Application</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link rel="stylesheet" href="./assets/css/main.css" />
    </head>
    <body class="is-preload">

    <?php include './navigation/navigation.php' ?>

    <!-- Main -->
    <div id="main">
        <div class="wrapper">
            <div class="inner">
                <!-- Elements -->
                <header class="major">
                    <h1>Model Application</h1>
                    <p>You are currently applying to the announcement "<b><?php echo $_GET['announcementTitle'];?></b>".</p>
<!--                    Place to put error page-->
                </header>
                <div style="margin:auto">
                    <div class="row gtr-200">
                        <!-- Form -->
                        <?php $linkAnnouncement = "applyAnnouncementForm.php?announcementId=".$_GET['announcementId']."&announcementTitle=".$_GET['announcementTitle'];?>
                        <form method="post" action="<?php echo $linkAnnouncement;?>">
                            <div class="row gtr-uniform">
                                <div class="col-8 col-12-xsmall" id="firstParagraphApply">
                                    Do you have past experience as a model?<br>
                                        <input type="radio" name="experience" id="yes" value="yes">
                                        <label for="yes"> Yes </label>
                                        <input type="radio" name="experience" id="no" value="no" checked>
                                        <label for="no"> No </label>
                                </div>

                                <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
                                <script>
                                    $(document).ready(function () {
                                        $("input[type='radio']").click(function () {
                                            var value = $(this).val();
                                            $('.yesExperienceTextbox').remove();
                                            if(value == 'yes') {
                                                $('#firstParagraphApply').append('<div class="yesExperienceTextbox"><br>' +
                                                    'How many year(s) of experience do you have?<br>' +
                                                    '<input type="number" name="yearsExperience" id="yearsExperience" max="100" min="1" required oninvalid="setCustomValidity(\'A number of year(s) is required\')">'+
                                                    '</div>');
                                            }
                                        });
                                    });
                                </script>
<!--                                <script language='javascript' type='text/javascript'>-->
<!--                                    function getRadioValue(theRadioGroup)-->
<!--                                    {-->
<!--                                        var elements = document.getElementsByName(theRadioGroup);-->
<!--                                        for (var i = 0, l = elements.length; i < l; i++)-->
<!--                                        {-->
<!--                                            if (elements[i].checked)-->
<!--                                            {-->
<!--                                                return elements[i].value;-->
<!--                                            }-->
<!--                                        }-->
<!--                                    }-->
<!--                                    function check(input) {-->
<!--                                        if (getRadioValue("experience") === 'yes') {-->
<!--                                            if (input.value === "") {-->
<!--                                                input.setCustomValidity('wrong.');-->
<!--                                            }-->
<!--                                        } else {-->
<!--                                            input.setCustomValidity('right.');-->
<!--                                        }-->
<!--                                    }-->
<!--                                </script>-->
                                <div class="col-8 col-12-xsmall field"">
                                    Tell me a little about you...<br><small style="font-size:12px;"><i>(Why should I pick you, what characterizes you physically or you can give an example of a previous shoot.)</i></small><br>
                                        <textarea name="message" id="message" rows="6" placeholder="Message" required oninvalid="setCustomValidity('A message is required')"></textarea>
                                <input type="hidden" name="titleAnnouncement" id="titleAnnouncement" value="<?php echo $_GET['announcementTitle'];?>">
                                </div>
                                <!-- Break -->
                                <div class="col-12">
                                    <ul class="actions">
                                        <li><button type="submit" value="Submit" class="primary" name="submit_application">Submit</button></li>
                                        <li><button type="reset" value="Cancel" onclick="goHome()">Back</button></li>
                                        <script language='javascript' type='text/javascript'>
                                            // function goHome() {
                                                window.location.href ="./homepage.php";
                                            }
                                        </script></ul>
                                </div>
                            </div>
                        </form>
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
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/jquery.dropotron.min.js"></script>
    <script src="./assets/js/browser.min.js"></script>
    <script src="./assets/js/breakpoints.min.js"></script>
    <script src="./assets/js/util.js"></script>
    <script src="./assets/js/main.js"></script>

    </body>
    </html>

