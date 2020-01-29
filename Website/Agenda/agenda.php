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
        $message = "(Please sign in/register to make a shoot request)";
    } else if ($userType != null) {
        if ($userType == "customer") {
            $message = "(To make a shoot reservation, click on an availability.)";
        } else if ($userType == "photographer") {
            $message = "(To add an event, click on the 'add' dropdown of the agenda Navigation, to remove an event, click on the event directly in the calendar)";
        }
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
                            var url = "deleteAgendaEvent.php";

                            var id = (info.event.id).toString();
                            var queryString = "?eventId=" + id;

                            var conf = confirm("Do you want to delete this event?");
                            if (conf == true){
                                window.open(url + queryString);
                            }
                        }
                    },

                    /*eventRender: function(event, eventElement) {
                        eventElement.find("div.fc-content").prependToElement("<a href=''>&#10006;</a>");
                    },*/

                    navLinks: true, // can click day/week names to navigate views
                    editable: false,
                    eventLimit: true, // allow "more" link when too many events
                    eventSources: [
                        {
                            url: '../../json/events.json',
                            type: 'POST',
                            data: {
                                //custom_param1: 'something',
                            },
                            error: function() {
                                alert('there was an error while fetching events!');
                            },
                            backgroundColor: '#5f9ea0',
                            borderColor: 'white' // a non-ajax option
                        }
                    ],

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