<?php
// Database Connection
include '../Header/dbConnection.php';

// Start the session
include '../Header/sessionConnection.php';

//agenda message
$message = "";
//user type
$userType = null;
if(isset($_SESSION['userSignIn'])){
    $userType = $_SESSION['userTypeSignIn'];
}

//check user type/origin and display message accordingly
if(isset($_GET["sendEmail"])){
    $message = '<p style="color: darkslategrey">'.$_GET["sendEmail"].'</p>';
}
else {
    if ($userType == null) {
        $message = '<i class="linkHomeAnnouncement" style="text-decoration: none;">If you wish to request a shoot please <a class="linkHomeAnnouncement" href="../SignOut/SignOutToRegister.php">sign up</a> as a "Customer"</i>';
    } else if ($userType != null) {
        if ($userType == "customer") {
            $message = "(To make a shoot reservation, click on an availability.)";
        } else if ($userType == "administrator") {
            $message = "(To add an event, click on the 'add' button, to edit an event, click on the event directly in the calendar)";
        } else{
            $message = "(To make a shoot reservation, <a class=\"linkHomeAnnouncement\" href=\"../SignOut/SignOutToRegister.php\">sign up</a> as a \"customer\")";
        }
    }
}


// connect to the database
$db = mysqli_connect('localhost','root','','photography');
//get events from database
$event_query = "SELECT eventId as id, eventTitle as title, eventStart as start, eventEnd as end, eventUrl as url, eventColor as color FROM events";
$result = mysqli_query($db,$event_query);
$myArray = array();
if ($result->num_rows > 0) {
// output data of each row
    while($row = $result->fetch_assoc()) {
        $myArray[] = $row;
    }
}

?>
<!DOCTYPE HTML>
<html lang="en">
<?php include '../Header/favicon.html';?>
	<head>
		<title>Agenda</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="../../assets/css/main.css" />


        <link href='../../packages/core/agenda.css' rel='stylesheet' />
        <link href='../../packages/daygrid/main.css' rel='stylesheet' />
        <link href='../../packages/timegrid/main.css' rel='stylesheet' />
        <link href='../../packages/list/main.css' rel='stylesheet' />
        <script src='../../packages/core/main.js'></script>
        <script src='../../packages/interaction/main.js'></script>
        <script src='../../packages/daygrid/main.js'></script>
        <script src='../../packages/timegrid/main.js'></script>
        <script src='../../packages/list/main.js'></script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: [ 'dayGrid', 'timeGrid', 'list', 'interaction' ],
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    eventClick: function(info) {
                        info.jsEvent.preventDefault();
                        var userType = "<?php echo $userType ?>";

                        if(userType == "customer")
                        {
                            if (info.event.url == "requestShootForm.php") {
                                var id = (info.event.id).toString();
                                var startDate = info.event.start;
                                var endDate = info.event.end;

                                var title = info.event.title;
                                if(endDate != null) {
                                    var endDateString = endDate.toDateString();
                                }
                                else {
                                    var endDateString = startDate.toDateString();;
                                }
                                var startDateString = startDate.toDateString();

                                var queryString = "?startDate=" +  startDateString + "&endDate=" + endDateString + "&title=" + title + "&id=" + id;

                                window.open(info.event.url + queryString);
                            }
                        }
                        else if(userType == "administrator"){
                                var url = "editAgendaEventForm.php";
                                var id = (info.event.id).toString();
                                var startDate = info.event.start;
                                var endDate = info.event.end;

                                var title = info.event.title;
                                if(endDate != null) {
                                    var endDateString = endDate.toDateString();
                                }
                                else {
                                    var endDateString = startDate.toDateString();;
                                }
                                var startDateString = startDate.toDateString();



                                var queryString = "?id=" + id + "&startDate=" + startDateString + "&title=" + title + "&endDate=" + endDateString;
                                window.open(url + queryString);

                        }
                    },


                    navLinks: true, // can click day/week names to navigate views
                    editable: false,
                    eventLimit: true, // allow "more" link when too many events
                    nextDayThreshold: '00:00:00',
                    displayEventTime: false,
                    events: <?php echo json_encode($myArray); ?>,

                });


                calendar.render();
            });
        </script>


        <style>

            #calendar {
                max-width: 900px;
                margin: 0 auto;
            }

        </style>

	</head>

	<body class="is-preload">

    <?php include '../Navigation/navigation.php' ?>

		<!-- One -->
			<div id="main">
				<div class="wrapper">
					<div class="inner"><?php
                        if ($userType == "administrator"){
                        ?>
                        <div style="text-align:left !important;">
                            <a href="addAgendaEventForm.php"><span>&#43</span> Add Event</a>
                        </div>
                        <?php }?>

						<header class="major">
							<h1>AGENDA</h1>
                            <p>See Sophie's availabilities and request a shoot accordingly <br>
                                <i style=" font-size: large"><?php echo $message ?></i></p>

                            <br>
						</header>
                        <div id='calendar'></div>
					</div>
				</div>
			</div>

    <!-- footer -->
    <?php include '../Footer/footer.php' ?>

    <!--Script Links-->
    <?php include '../Footer/scriptsLinks.php'?>


	</body>
</html>