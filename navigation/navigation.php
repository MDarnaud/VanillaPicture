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
            </li>
            <li><a href="./announcement.php">Announcement</a></li>
            <li><a href="./agenda.php">Agenda</a></li>
            <li><a href="./packages.php">Packages</a></li>
            <li><a href="./finances.php">Finances</a></li>';

//          Verify if user login
            if(!(isset($_SESSION['userSignIn']))) {
                echo '<li><a href="./signIn.php" class="icon fa-user-circle"> Sign in</a></li>';
            }
            else{
                echo '<li><a href="./signOut.php" class="icon fa-user-circle"> Sign Out</a>';
                if($_SESSION['userTypeSignIn'] !== 'administrator'):
                    echo '<ul>
                        <li><a href="./viewAccount.php">View Account</a></li>
                    </ul>';
                endif;
                    echo '</li>';
            }
        echo '</ul>
    </nav>
</header>';
?>