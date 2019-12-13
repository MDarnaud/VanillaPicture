<?php
//start session
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Agenda</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="assets/css/main.css" />

        <script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

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
                    /*eventClick: function(info) {
                        info.jsEvent.preventDefault();

                        if (info.event.url) {
                            var startDate=info.event.start;
                            var title = info.event.title;
                            var startDateString = startDate.toDateString();
                            var queryString = "?startDate=" + startDateString + "&title=" + title;

                            window.alert(info.event.url + queryString);
                            window.open(info.event.url + queryString);
                        }
                    },*/

                    eventClick: function(info) {
                        info.jsEvent.preventDefault();

                        var url = "deleteAgendaEvent.php";

                        var id = (info.event.id).toString();
                        var queryString = "?eventId=" + id;

                        var conf = confirm("Do you want to delete this event?");
                        if (conf == true){
                            //var ev = calendar.getEventById(id);
                            //ev.remove();
                            window.open(url + queryString);
                        }
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
                    ],
                    /*eventRender: function(event, element) {
                        element.append( "<span class='removebtn'>X</span>" );
                       /* element.find(".removebtn").click(function() {
                            $('#calendar').fullCalendar('removeEvents',event_id);
                        });
                    },*/

                    /*eventRender: function(event, element, view) {
                        element.append('<td class="w3-center"><button class="fc-delete-item ">Delete</button></td>');
                        element.find(".w3-center").on("click", function() {
                            var result = confirm("Delete Event");
                            if (result) {
                                console.log(event);
                                localStorage.setItem("delete_id", event.id);
                                $('#cal2').fullCalendar('removeEvents', event.id);
                            }
                        });
                    }*/

                    /*eventRender: function(eventObj, $el) {
                        $el.popover({ title: "BookName", content: eventObj.title, trigger: 'hover', placement: 'top', container: 'body' }); },*/

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

    <?php include './navigation/navigation.php' ?>

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