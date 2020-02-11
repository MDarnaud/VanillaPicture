<?php include 'serverAnnouncement.php';

if(isset($_SESSION['userSignIn'])) {
    if ($_SESSION['userTypeSignIn'] === 'administrator') {
        ?>
        <!DOCTYPE HTML>

        <html lang="en">
        <?php include '../Header/favicon.html';?>
        <head>
            <title>Announcement</title>
            <meta charset="utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
            <meta name="description" content=""/>
            <meta name="keywords" content=""/>
            <link rel="stylesheet" href="../../assets/css/main.css"/>
        </head>
        <body class="is-preload">

        <?php include '../Navigation/navigation.php' ?>

        <!-- One -->
        <div id="main">
            <div class="wrapper">
                <div class="inner">
                    <header class="major">
                        <h1>Announcement</h1>
                        <p>Please fill out the form to post an announcement on the home page.</p>
                        <?php include "errorsAnnouncement.php" ?>
                    </header>
                    <div style="margin:auto">
                        <div class="row gtr-200">
                            <!-- Form -->
                            <form method="post" action="announcement.php">
                                <div class="row gtr-uniform">
                                    <div class="col-8 col-12-small col-12-xsmall">
                                        <h5 class="TitleForm">Title:</h5>
                                        <input type="text" name="title" id="title" value="" placeholder="Title"
                                               maxlength="50" required oninvalid="setCustomValidity('Title is invalid')"
                                               oninput="setCustomValidity('')"/>
                                    </div>
                                    <div class="col-8 col-12-small col-12-xsmall">
                                        <h5 class="TitleForm">Details:</h5>
                                        <textarea name="detail" id="detail" value="" placeholder="Announcement Details"
                                                  maxlength="300" style="height:150px;weight:100px" required
                                                  oninvalid="setCustomValidity('Details is invalid')"
                                                  oninput="setCustomValidity('')"></textarea>
                                    </div>
                                    <div class="col-8 col-12-small col-12-xsmall">
                                        <h5 class="TitleForm">Start date:</h5>
                                        <input type="date" name="startDate" id="startDate" value=""
                                               placeholder="Start Date" required "/>
                                    </div>
                                    <div class="col-8 col-12-small col-12-xsmall">
                                        <h5 class="TitleForm">End date:</h5>
                                        <input type="date" name="endDate" id="endDate" value="" placeholder="End Date"
                                               required oninput="check(this)"/>
                                        <script language='javascript' type='text/javascript'>
                                            function check(input) {
                                                if (!(input.value >= document.getElementById('startDate').value)) {
                                                    input.setCustomValidity('End Date is before the start date.');
                                                } else {
                                                    // input is valid -- reset the error message
                                                    input.setCustomValidity('');
                                                }

                                                if (input.value < new Date()) {
                                                    input.setCustomValidity('End Date is before today\'s date.');
                                                } else {
                                                    // input is valid -- reset the error message
                                                    input.setCustomValidity('');
                                                }
                                            }
                                        </script>
                                    </div>
                                    <div class="col-8 col-12-xsmall">
                                        <br><input type="checkbox" name="modelPost" id="modelPost" value="modelPost"
                                                   class="elementsTable">
                                        <label for="modelPost"><h5 class="TitleForm">Yes, this announcement is a model
                                                search.</h5></label>
                                    </div>
                                    <!-- Break -->
                                    <div class="col-12">
                                        <ul class="actions">
                                            <li>
                                                <button type="submit" value="Submit" class="primary"
                                                        name="submit_announcement">Submit
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!-- footer -->
        <?php include '../Footer/footer.php' ?>

        <!--Script Links-->
        <?php include '../Footer/scriptsLinks.php' ?>

        </body>
        </html>

    <?php } else {
        header('location: ../../Website/Home/homepage.php');
    }
}else{
    header('location: ../../Website/SignIn/signIn.php');
}
?>