<?php
// Start the session
include '../Header/sessionConnection.php';

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

if(isset($_SESSION['userSignIn'])){
if($_SESSION['userTypeSignIn'] === 'administrator'){
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
                <div class="col-8 col-8-medium col-12-small col-12-xsmall">
                    <!-- Form -->
                    <form method="post" action="serverAgendaEvent.php">
                        <div class="row gtr-uniform">
                            <div class="col-8 col-8-medium col-12-small col-12-xsmall">
                                <input type="hidden" name="eventId" id="eventId" value="<?php echo $id?>" placeholder="Event Id"/>
                            </div>
                            <div class="col-8 col-8-medium col-12-small col-12-xsmall">
                                <h4 class="TitleForm">Title:</h4>
                                <i style="font-size:13px">ex: write a title such as "Available", for customers to understand they can request a shoot on this date</i>
                                <input type="text" name="eventTitle" id="eventTitle" value="" placeholder="Title" required oninvalid="setCustomValidity('Title is invalid')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="col-8 col-8-medium col-12-small col-12-xsmall">

                                <h4 class="TitleForm">Location:</h4>
                                <input type="text" name="eventLocation" id="eventLocation" value="" placeholder="Location"/>
                            </div>
                            <div class="col-8 col-8-medium col-12-small col-12-xsmall">

                                <h4 class="TitleForm">Start Date:</h4>
                                <input type="date" name="eventStart" id="eventStart" required/>
                            </div>
                            <div class="col-8 col-8-medium col-12-small col-12-xsmall">
                                <h4 class="TitleForm">End Date:</h4>
                                <i style="font-size:13px">If you wish for an event to last one day, leave blank</i><br>
                                <input type="date" name="eventEnd" id="eventEnd" value="" oninput="check(this)"/>
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
                            <div class="col-8 col-8-medium col-12-small col-12-xsmall">
                                <label>This event is a shoot availability that customers can book</label>
                                <input type="checkbox" id="isAvailability" name="isAvailability" >
                                <label for="isAvailability">Yes, it is available</label>
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