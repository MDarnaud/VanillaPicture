<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
        $message = '<i class="linkHomeAnnouncement" style="text-decoration: none;">If you wish to request a shoot please <a class="linkHomeAnnouncement" href="../Registration/register.php">sign up</a> as a "Customer"</i>';
    } else if ($userType != null) {
        if ($userType == "customer") {
            $message = "(To make a shoot reservation, click on an availability.)";
        } else if ($userType == "administrator") {
            $message = "(To add an event, click on the 'add' button, to edit an event, click on the event directly in the calendar)";
        }
    }
}


// connect to the database
$db = mysqli_connect('localhost','root','','photography');
//get events from database
$event_query = "SELECT eventId as id, title, start, end, url FROM events";
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
                            if (info.event.url) {
                                var startDate = info.event.start;
                                var title = info.event.title;
                                var startDateString = startDate.toDateString();
                                var queryString = "?startDate=" + startDateString + "&title=" + title;

                                window.open(info.event.url + queryString);
                            }
                        }
                        else if(userType == "administrator"){
                                var url = "editAgendaEventForm.php";
                                var id = (info.event.id).toString();
                                var startDate = info.event.start;
                                var endDate = null;
                                var endDateString = null;

                                if(info.event.end != null){
                                    endDate = info.event.end;
                                    endDateString = endDate.toDateString();
                                }

                                var title = info.event.title;
                                var startDateString = startDate.toDateString();

                                var queryString = "?id=" + id + "&startDate=" + startDateString + "&title=" + title + "&endDate=" + endDateString;
                                window.open(url + queryString);

                        }
                    },

                    /*eventRender: function(event, eventElement) {
                        eventElement.find("div.fc-content").prependToElement("<a href=''>&#10006;</a>");
                    },*/

                    navLinks: true, // can click day/week names to navigate views
                    editable: false,
                    eventLimit: true, // allow "more" link when too many events
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
					<div class="inner">
						<header class="major">
							<h1>AGENDA</h1>
                            <p>See Sophie's availabilities and request a shoot accordingly</p>
                                <h4><?php echo $message ?></h4></p>
                            <?php
                            if ($userType == "administrator"){
                            ?>
                            <ul class="customActions">
                                <li><button id="addEvent" value="addEvent" onclick="location.href='addAgendaEventForm.php'">Add Event</button></li>
                            </ul>
                            <?php }?>

                            <br>
						</header>
                        <div id='calendar'></div>
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