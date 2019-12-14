<!-- Header -->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
echo '<header id="header" class="alt">
    <nav id="nav">
        <ul>
            <li class="current"><a href="./homepage.php">Home</a></li>
            <li>
                <a href="" class="dropdown">Portfolio</a>
                <ul>
                    <li><a href="C:\wamp64\www\finalProject\dark\gallery.html">Gallery</a></li>
                </ul>
            </li>';
            if(isset($_SESSION['userSignIn'])) {
                if ($_SESSION['userTypeSignIn'] === 'administrator') {
                    echo '<li><a href="./announcement.php">Announcement</a></li>';
                }
            }

            echo '<li><a href="./agenda.php">Agenda</a></li>
                    <li><a href="./packages.php">Packages</a></li>';


//          Verify if user login
            if(!(isset($_SESSION['userSignIn']))) {
                echo '<li><a href="./signIn.php" class="icon fa-user-circle"> Sign in</a></li>';
            }
            else{
                if($_SESSION['userTypeSignIn'] === 'administrator'):
                    echo '<li><a href="./finances.php">Finances</a></li>';
                endif;
                echo '<li><a href="./viewProfile.php" class="icon fa-user-circle"> Profile</a>';
                    echo '<ul>
                        <li><a href="./signOut.php"> Sign Out</a></li>
                    </ul>';
                    echo '</li>';
            }
        echo '</ul>
    </nav>
</header>';
?>