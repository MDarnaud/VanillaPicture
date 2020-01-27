<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// connect to the database
$db = mysqli_connect('localhost','root','','photography');
?>
<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Reports</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="../../assets/css/main.css" />
    <link rel="stylesheet" href="../../assets/css/gallery.css" />

</head>
<body class="is-preload">

<!-- Main -->
<div id="main">
    <div class="wrapper">
        <div class="inner">
            <!-- Elements -->
            <header class="major">
                <h1>Reports</h1>
                <ul class="actions">
                    <li><button id="Summary" type="reset" value="Summary" onclick="location.href= 'reportsSummary.php'" >Summary</button></li>
                    <li><button id="Detail" type="reset" value="Detail" onclick="location.href= 'reportsDetail.php'" >Detail</button></li>
                    <li><button id="Exception" type="reset" value="Exception" onclick="location.href= 'reportsException.php'"  >Exception</button></li>
                </ul>
            </header>
