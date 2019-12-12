<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Agenda</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="assets/css/main.css" />

        <link href='packages/core/agenda.css' rel='stylesheet' />
        <link href='packages/daygrid/main.css' rel='stylesheet' />
        <link href='packages/timegrid/main.css' rel='stylesheet' />
        <link href='packages/list/main.css' rel='stylesheet' />
        <script src='packages/core/main.js'></script>
        <script src='packages/interaction/main.js'></script>
        <script src='packages/daygrid/main.js'></script>
        <script src='packages/timegrid/main.js'></script>
        <script src='packages/list/main.js'></script>
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
                    navLinks: true, // can click day/week names to navigate views
                    editable: false,
                    eventLimit: true, // allow "more" link when too many events
                    eventSources: [
                        {
                            url: 'json/events.json',
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
                    ]
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

		<!-- Header -->
		<header id="header" class="alt">
			<nav id="nav">
				<ul>
					<li class="current"><a href="homepage.php">Home</a></li>
					<li>
						<a href="" class="dropdown">Portfolio</a>
						<ul>
							<li><a href="C:\wamp64\www\finalProject\dark\gallery.html">Gallery</a></li>
						</ul>
					</li>
					<li><a href="announcement.php">Announcement</a></li>
					<li><a href="agenda.php">Agenda</a></li>
					<li><a href="packages.php">Packages</a></li>
					<li><a href="requestForm.php">Request a Shoot</a></li>
					<li><a href="signin/signin.php" class="icon fa-user-circle"> Login</a></li>
				</ul>
			</nav>
		</header>

		<!-- One -->
			<div id="main">
				<div class="wrapper">
					<div class="inner">
						<header class="major">
							<h1>AGENDA</h1>
							<p>See Sophie's availabilities and request a shoot accordingly</p>
						</header>
                        <div id='calendar'></div>
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
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>