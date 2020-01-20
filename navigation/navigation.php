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
                    <a href="gallery.php">Gallery</a>
            </li>';

            echo '<li><a href="./packages.php">Packages</a></li>
                    <li><a href="./agenda.php">Agenda</a></li>
                    ';



//          Verify if user login
            if(!(isset($_SESSION['userSignIn']))) {
                echo '<li><a href="./signIn.php" class="icon fa-user-circle"> Sign in</a></li>';
            }
            else{
                if ($_SESSION['userTypeSignIn'] === 'administrator') :
                    echo '<li><a>Administration</a>
                            <ul>
                                <li><a class="navdrop" href="./announcement.php" style="color:white;">Announcement</a></li>
                                 <li><a class="navdrop" href="" style="color:white;">Review</a></li>
                                <li><a class="navdrop" href="./reportsSummary.php" style="color:white;">Reports</a></li>
                            </ul>
                          </li>';
                endif;


                echo '<li><a href="./viewProfile.php" class="icon fa-user-circle"> Profile</a>';
                    echo '<ul>
                        <li><a class="navdrop" href="./signOut.php" style="color:white;"> Sign Out</a></li>
                    </ul>';
                    echo '</li>';
            }
        echo '</ul>
    </nav>
</header>';
?>