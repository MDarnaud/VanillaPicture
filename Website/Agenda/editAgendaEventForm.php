<?php
// Database Connection
include '../Header/dbConnection.php';

//Start session
include '../Header/sessionConnection.php';

//get event info
//get new user information
$eventTitle = $_GET["title"];
$eventId = $_GET["id"];
$eventStart = $_GET["startDate"];
$eventEnd = $_GET["endDate"];


//convert string to date for input boxes
$startTime = strtotime($eventStart);
$convertedStartDate = date( 'Y-m-d\TH:i', $startTime );

$endTime = strtotime($eventEnd);
$convertedEndDate = date( 'Y-m-d\TH:i', $endTime );

if(isset($_SESSION['userSignIn'])){
if($_SESSION['userTypeSignIn'] === 'administrator'){

?>

<!DOCTYPE HTML>


<html lang="en">
    <?php include '../Header/favicon.html';?>
<head>
    <title>Agenda Event</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="../../assets/css/main.css" />
</head>
<body class="is-preload">
<?php include '../Navigation/navigation.php' ?>

<!-- Main -->
<div id="main">
    <div class="wrapper">
        <div class="inner">

            <!-- Elements -->
            <header class="major">
                <h1>EDIT AGENDA EVENT</h1>
            </header>
            <div class="row gtr-200">
                <div class="col-8 col-8-medium col-12-small col-12-xsmall">
                    <!-- Form -->
                    <form method="post" action="editAgendaEvent.php">
                        <div class="row gtr-uniform">
                            <div class="col-8 col-8-medium col-12-small col-12-xsmall">
                                <input type="hidden" name="eventId" id="eventId" value="<?php echo $eventId?>" placeholder="Event Id"/>
                            </div>
                            <div class="col-8 col-8-medium col-12-small col-12-xsmall">
                                <h4 class="TitleForm">Title and Location:</h4>
                                <input type="text" name="eventTitle" id="eventTitle" value="<?php echo $eventTitle?>" placeholder="Title" required oninvalid="setCustomValidity('Title is invalid')" oninput="setCustomValidity('')" maxlength="100"/>
                            </div>
                            <div class="col-8 col-8-medium col-12-small col-12-xsmall">

                                <h4 class="TitleForm">Start Date/Time:</h4>
                                <i>Date Format: month/day/year hour/minute/AM or PM</i>
                                <input type="datetime-local" name="eventStart" id="eventStart" value="<?php echo $convertedStartDate?>" required/>
                            </div>
                            <div class="col-8 col-8-medium col-12-small col-12-xsmall">
                                <h4 class="TitleForm">End Date/Time:</h4>
                                <input type="datetime-local" name="eventEnd" id="eventEnd" value="<?php echo $convertedEndDate?>" oninput="check(this)" required/>
                                <script language='javascript' type='text/javascript'>
                                    function check(input) {
                                        if (!(input.value >= document.getElementById('eventStart').value)) {
                                            input.setCustomValidity('End Date is before the start date.');
                                        } else {
                                            // input is valid -- reset the error message
                                            input.setCustomValidity('');
                                        }
                                    }
                                </script>
                            </div>
                            <!-- Break -->
                            <div class="col-12">

                                <ul class="actions">
                                    <button type="submit" class="button icon fa-pencil-square">Update Event</button>
                                </ul>
                            </div>
                        </div>
                    </form>
                    <div class="col-2 col-2-medium col-2-small col-2-xsmall">
                        <ul class="actions">
                            <button type="submit" class="button icon fa-trash" id="deleteEventButton" onclick="myDelete('<?php echo $eventId?>');">Delete Event</button>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../popUp/js/msc-script.js"></script>
<link rel="stylesheet" href="../../popUp/css/msc-style.css">
<link rel="icon" type="image/png" href="/favicon.png">
<script>
    function myDelete(event_id){
        var typeOfPage = "event";
        var categorySelect = "";
        var subCategorySelect = "";
        mscConfirm(typeOfPage, categorySelect, subCategorySelect, event_id, "Delete?", function () {
            mscAlert("Event deleted");
        });
    }
</script>

<!-- footer -->
<?php include '../Footer/footer.php' ?>

<!--Script Links-->
<?php include '../Footer/scriptsLinks.php'?>

</body>
</html>

<?php }else{
    header('location: ../../Website/Home/homepage.php');
}
}else{
    header('location: ../../Website/Home/homepage.php');
}