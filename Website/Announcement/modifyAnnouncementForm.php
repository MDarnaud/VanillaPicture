<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'addAnnouncement.php';

// connect to the database
$db = mysqli_connect('localhost','root','','photography');

// Get the selected announcement from the database
$idSelect = $_GET['announcementId'];
$id_check_query = "SELECT * FROM announcement WHERE announcementId='$idSelect'";
$modif_result = mysqli_query($db, $id_check_query);
$modifPost = mysqli_fetch_assoc($modif_result);

 ?>
<!DOCTYPE HTML>

<html lang="en">
<head>
    <title>Announcement</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="../../assets/css/main.css" />
</head>
<body class="is-preload">

<?php include '../Navigation/navigation.php' ?>

<!-- One -->
<div id="main">
    <div class="wrapper">
        <div class="inner">
            <header class="major">
                <h1>Modify Announcement</h1>
                <p>Please fill out the form to modify an announcement on the home page.</p>
            </header>
            <div style="margin:auto">
                <div class="row gtr-200">
                    <!-- Form -->
                    <form method="post" action="addAnnouncement.php">
                        <div class="row gtr-uniform">
                            <div class="col-8  col-12-small col-12-xsmall">
                                <input type="hidden" name="id" id="id" value="<?php echo $modifPost['announcementId']?>"/>
                                <input type="text" name="title" id="title" value="<?php echo $modifPost['announcementTitle']?>" placeholder="Title" maxlength="50" required oninvalid="setCustomValidity('Title is invalid')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="col-8 col-12-small col-12-xsmall">
                                <textarea name="detail" id="detail" placeholder="Announcement Detail" maxlength="300" style="height:150px;weight:100px" required oninvalid="setCustomValidity('Details is invalid')" oninput="setCustomValidity('')"><?php echo $modifPost['announcementDetail']?></textarea>
                            </div>
                            <div class="col-8 col-12-small col-12-xsmall">
                                <p>Start date</p>
                                <input type="date" name="startDate" id="startDate" value="<?php echo $modifPost['announcementStartDate']?>" placeholder="Start Date" required/>
                            </div>
                            <div class="col-8 col-12-small col-12-xsmall">
                                <p>End date</p>
                                <input type="date" name="endDate" id="endDate" value="<?php echo $modifPost['announcementEndDate']?>" placeholder="End Date" required oninput="check(this)"/>
                            </div>
                            <script language='javascript' type='text/javascript'>
                                function check(input) {
                                    if (!(input.value > document.getElementById('startDate').value)) {
                                        input.setCustomValidity('End Date is before the start date.');
                                    } else {
                                        // input is valid -- reset the error message
                                        input.setCustomValidity('');
                                    }

                                    if (!(input.value > new Date())) {
                                        input.setCustomValidity('End Date is before today\'s date.');
                                    } else {
                                        // input is valid -- reset the error message
                                        input.setCustomValidity('');
                                    }
                                }
                            </script>
                            <div class="col-8 col-12-xsmall">
                                    <br><input type="checkbox" name="modelPost" id="modelPost" value="modelPost" class="elementsTable" <?php if($modifPost['announcementModel'] === '1'){ echo 'checked';}?>>
                                    <label for="modelPost"> Yes, this announcement is a model search.</label>
                            </div>
                            <!-- Break -->
                            <div class="col-12">
                                <ul class="actions">
                                    <li><button type="submit" value="Update" class="primary" name="update_announcement">Update</button></li>
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
<?php include '../../footer/footer.php' ?>

<!-- Scripts -->
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/jquery.dropotron.min.js"></script>
<script src="../../assets/js/browser.min.js"></script>
<script src="../../assets/js/breakpoints.min.js"></script>
<script src="../../assets/js/util.js"></script>
<script src="../../assets/js/main.js"></script>

</body>
</html>