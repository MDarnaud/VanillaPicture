<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//generate a random number that will be the event id
function randomId()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    do {
        $ids = array(); //remember to declare $pass as an array
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $ids[] = $alphabet[$n];
        }
    }while (1 !== preg_match('~[0-9]~', implode($ids))||1 !== preg_match('~[A-Z]~', implode($ids)));

    return implode($ids); //turn the array into a string
}

$id = randomId();
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
                <h1>ADD AGENDA EVENT</h1>
            </header>
            <div class="row gtr-200">
                <div class="col-12 col-12-medium">
                    <!-- Form -->
                    <form method="post" action="addAgendaEvent.php">
                        <div class="row gtr-uniform">
                            <div class="col-8 col-12-xsmall">
                                <input type="hidden" name="eventId" id="eventId" value="<?php echo $id?>" placeholder="Event Id"/>
                            </div>
                            <div class="col-8 col-12-xsmall">
                                <label for="eventTitle">Enter Event Title (ex: write "Available", for customers to be able to request a shoot on this date)</label>
                                <input type="text" name="eventTitle" id="eventTitle" value="" placeholder="Event Title" required/>
                            </div>
                            <div class="col-8 col-12-xsmall">
                                <label for="eventLocation">Enter Event Location (ex: Toronto)</label>
                                <input type="text" name="eventLocation" id="eventLocation" value="" placeholder="Event Location"/>
                            </div>
                            <div class="col-12 col-12-xsmall">
                                <label for="eventStart">Enter Event Start (Date and Time)</label>
                                <input type="datetime-local" name="eventStart" id="eventStart" value="" required/>
                            </div>
                            <div class="col-12 col-12-xsmall">
                                <label for="eventEnd">Enter Event End (if you wish for the event to last all day, leave blank)</label>
                                <input type="datetime-local" name="eventEnd" id="eventEnd" value="" />
                            </div>
                            <div class="col-6 col-12-small">
                                <label>Check the box if this event is a shoot availability (for customers to book)</label>
                                <input type="checkbox" id="isAvailability" name="isAvailability" >
                                <label for="isAvailability">Photoshoot Availability</label>
                            </div>
                            <!-- Break -->
                            <div class="col-12">
                                <ul class="actions">
                                    <li><input type="submit" value="Add Event" class="primary" /></li>
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
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/jquery.dropotron.min.js"></script>
<script src="../assets/js/browser.min.js"></script>
<script src="../assets/js/breakpoints.min.js"></script>
<script src="../assets/js/util.js"></script>
<script src="../assets/js/main.js"></script>

</body>
</html>