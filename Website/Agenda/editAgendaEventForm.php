<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// connect to the database
$db = mysqli_connect('localhost','root','','photography');

//get event info
//get new user information
$eventTitle = $_GET["title"];
$eventId = $_GET["id"];
$eventStart = $_GET["startDate"];



if ($_GET["endDate"] != "null"){
    var_dump($_GET["endDate"]);
    $eventEnd = $_GET["endDate"];
    $endTime = strtotime($eventEnd);
    $convertedEndDate = date( 'yy-m-d', $endTime );
}


//convert string to date for input boxes
$startTime = strtotime($eventStart);
$convertedStartDate = date( 'yy-m-d', $startTime );



?>

<!DOCTYPE HTML>


<html lang="en">
<head>
    <title>Agenda Event Form</title>
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
                                <input type="text" name="eventTitle" id="eventTitle" value="<?php echo $eventTitle?>" placeholder="Title" required oninvalid="setCustomValidity('Title is invalid')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="col-8 col-8-medium col-12-small col-12-xsmall">

                                <h4 class="TitleForm">Start Date:</h4>
                                <input type="date" name="eventStart" id="eventStart" value="<?php echo $convertedStartDate ?>" required/>
                            </div>
                            <div class="col-8 col-8-medium col-12-small col-12-xsmall">
                                <h4 class="TitleForm">End Date:</h4>
                                <i style="font-size:13px">If you wish for an event to last one day, leave blank</i><br>
                                <input type="date" name="eventEnd" id="eventEnd" value="<?php if ($_GET["endDate"] != "null"){echo $convertedEndDate;}?>" oninput="check(this)"/>
                                <script language='javascript' type='text/javascript'>
                                    function check(input) {
                                        if (!(input.value > document.getElementById('eventStart').value)) {
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
<!--                                <ul class="actions">-->
<!--                                    <button type="submit" class="button primary icon fa-pencil">Update Event</button>-->
<!--                                </ul>-->
                                <ul class="actions">
                                    <button type="submit" class="button icon fa-pencil-square">Update Event</button>
                                </ul>
                            </div>
                        </div>
                    </form>
                    <div class="col-2 col-2-medium col-2-small col-2-xsmall">
                    <form method="post" action="deleteAgendaEvent.php">
                        <input type="hidden" name="eventId" id="eventId" value="<?php echo $eventId?>" placeholder="Event Id"/>
                        <ul class="actions">
                            <button type="submit" class="button icon fa-trash" id="deleteEventButton">Delete Event</button>
                        </ul>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- footer -->
<?php include '../Footer/footer.php' ?>

<!--Script Links-->
<?php include '../Footer/scriptsLinks.php'?>

</body>
</html>