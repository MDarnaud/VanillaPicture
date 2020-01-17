<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// connect to the database
$db = mysqli_connect('localhost','root','','photography');

?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Vanilla Picture</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

    <?php include './navigation/navigation.php' ?>

		<!-- Banner -->
			<div id="banner">
				<div class="wrapper style1 special">
					<div class="inner">
						<h1 class="heading alt">VANILLA PICTURE</h1>
						<p>Be different, Taste Vanilla</p>
						<div class="image fit special video">
							<img src="images/homepage_frontcover.jpg" alt="" />
						</div>
						<ul class="feature-icons">
                            <li><a href=https://www.instagram.com/vanilla_picture/?hl=fr-ca" class="a_socialMedia"><span class="icon fa-instagram"></span><span class="label">Instagram</span></a></li>
                            <li><a href="http://facebook.com/VANILLAPICTURE/" class="a_socialMedia"><span class="icon fa-facebook"></span><span class="label">Facebook</span></a></li>
                            <li><a href="#getInTouch" class="a_socialMedia"><span class="icon fa-envelope"></span><span class="label">Gmail</span></a></li>
						</ul>
					</div>
				</div>
			</div>

		<!-- One -->
			<div id="one">
				<div class="wrapper special">
					<div class="inner">
						<header class="major">
							<h2>BIOGRAPHY</h2>
						</header>
						<div class="image fit special biblio">
							<img src="images/homepage_biblio.jpg" alt="" />
						</div>
						<p class="special">Sed egestas, ante et vulputate volutpat pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum lorem ipsum dolor sit amet consequat hendrerit tortor semper lorem at felis.</p>
						<ul class="actions">
							<li><a href="./gallery.php" class="button">My work</a></li>
						</ul>
					</div>
				</div>
			</div>

    <!-- Two -->
                            <!--                            Announcement -->
                            <?php
                            //Insert the announcement information in the table announcement in the database
                            $queryAnnouncement = "SELECT * FROM announcement";
                            $resultPost = mysqli_query($db, $queryAnnouncement);

                            if ($resultPost) { // if user exists
                                echo '<br><br>
                                    <div id="one">
                                        <div class="wrapper special">
                                            <div class="inner">
                                                <header class="major">
                                                    <h2>ANNOUNCEMENT</h2>
                                                </header>';
                                $noElements = false;
                                foreach ($resultPost as $eachPost) {
                                    //verify if end date is after now and start date is before now
                                    if ((strtotime($eachPost['announcementEndDate']) > strtotime('now')) && strtotime($eachPost['announcementStartDate']) <= strtotime('now')) {
                                        echo '<p class="announcementHome"> <strong>'.$eachPost['announcementTitle'].'</strong><br>'
                                            .$eachPost['announcementDetail'].'  - <small><i>By Sophie Perras</i></small>';
                                        //Only administrator can modify annoucement
                                        if(isset($_SESSION['userSignIn']) && $_SESSION['userTypeSignIn'] === 'administrator'){
                                            $idLink = 'modifyAnnouncementForm.php?announcementId='.$eachPost['announcementId'];
                                            echo '<br><a class="linkHomeAnnouncement" href='.$idLink.'> Modify </a>';
                                        }
                                        else if(isset($_SESSION['userSignIn']) && $_SESSION['userTypeSignIn'] === 'model'){
                                            $idLink = 'applyAnnouncementForm.php?announcementId='.$eachPost['announcementId'].'&announcementTitle='.$eachPost['announcementTitle'];
                                            echo '<br><a class="linkHomeAnnouncement" href='.$idLink.'> Apply </a>';
                                        }
                                        else{
                                            $idLink = 'applyAnnouncementForm.php?announcementId='.$eachPost['announcementId'];
                                            echo '<br><i class="linkHomeAnnouncement" style="text-decoration: none;">***If you wish to apply please <a class="linkHomeAnnouncement" href="../registration/register.php">sign up</a> as a "Model"</i>';
                                        }
                                        echo '</p>';
                                        $noElements = true;
                                    }
                                }
                            if($noElements === false){
                                    echo '<p> No announcements posted for now. Please come back later.</p>';
                                }
                                echo '                    <hr>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>';
                            }
                            ?>


		

		<!-- Footer -->
			<div id="footer">
				<div class="wrapper style2">
					<div class="inner">
						<header class="major">
							<h2 id = "getInTouch">Get in touch</h2>
							<p>Please fill out this form with your own information, to send an email to Sophie Perras.</p>
						</header>
						<div class="content">
							<div class="form">
								<form method="post" action="#">
									<div class="fields">
										<div class="field half">
											<input name="name" id="name" placeholder="Name" type="text" />
										</div>
										<div class="field half">
											<input name="email" id="email" placeholder="Email" type="email" />
										</div>
										<div class="field">
											<textarea name="message" id="message" rows="6" placeholder="Message"></textarea>
										</div>
									</div>
									<ul class="actions special">
										<li><input type="button" class="button" value="Send Message" /></li>
									</ul>
								</form>
							</div>
							<ul class="icons">
								<li>
									<span class="icon fa-id-badge"></span>
									<div>
										<strong>Personal Account</strong>
                                        <a href="https://www.instagram.com/vanillashowx/?hl=fr-ca">@vanillashowx</a>
									</div>
								</li>
								<li>
									<span class="icon fa-envelope"></span>
									<div>
										<strong>Email</strong>
										<a href="mailto:information@domain.ext">Vanilla.picture@gmail.com</a>
									</div>
								</li>
								<li>
									<span class="icon fa-phone"></span>
									<div>
										<strong>Phone</strong>
										(450) 806-6346
									</div>
								</li>
							</ul>
						</div>
					</div>
                    <div class="copyright">
                        &copy; Untitled. All rights reserved. Vanilla Picture.
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