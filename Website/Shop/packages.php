<?php
// Start the session
include '../Header/sessionConnection.php';

// connect to the databases
$db = mysqli_connect('localhost', 'root', '', 'photography');

?>
<!DOCTYPE HTML>

<html lang="en">
<?php include '../Header/favicon.html'; ?>
<head>
    <title>Packages</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link rel="stylesheet" href="../../assets/css/main.css"/>
    <link rel="stylesheet" href="../../assets/css/gallery.css"/>
</head>
<body class="is-preload">

<?php include '../Navigation/navigation.php' ?>


<!-- Gift Cards -->
<div id="three" style="padding-bottom: 5%;">
    <div class="wrapper alt special">
        <header class="major">
            <h2>GIFT CARDS</h2>
            <p style="font-size:x-large">See the different gift cards available for purchase</p>
        </header>
        <div class="wrapper style3">
            <div class="inner">
                <div class="profiles">
                    <div class="profile">
                        <div class="image">
                            <img id="" src="../../images/giftcard_50.jpg" alt=""/>
                        </div>
                        <div class="content">
                            <strong style="font-size:x-large">$50</strong>
                            <p>This $50 gift card can partially cover a shoot. Perfect to offer as a gift!</p>
                            <!--<ul class="actions">
                                <li><a href="#" class="button small">Buy</a></li>
                            </ul>-->
                        </div>
                    </div>
                    <div class="profile">
                        <div class="image">
                            <img id="" src="../../images/giftcard_100.jpg" alt=""/>
                        </div>
                        <div class="content">
                            <strong style="font-size:x-large">$100</strong>
                            <p>This $100 gift card can partially cover a shoot. Contact me for more information on
                                prices!</p>
                        </div>
                    </div>
                    <div class="profile">
                        <div class="image">
                            <img id="" src="../../images/giftcard_200.jpg" alt=""/>
                        </div>
                        <div class="content">
                            <strong style="font-size:x-large">$200</strong>
                            <p>This $200 gift card could cover the price of an entire shoot depending on your needs.
                                Contact me if you wish to know the exact amount you need!</p>
                        </div>
                    </div>
                </div>
                <ul class="customActions">
                    <li><a href="checkout.php" class="button">Buy a gift card</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- Packages -->
<div class="wrapper">
    <div class="inner">
        <div class="row">
            <div class="col-2 col-12-medium"></div>
            <div class="col-8 col-12-medium">
                <div style="text-align: center">
                    <h2>PACKAGES</h2>
                    <p style="font-size:x-large">Your vision, our magic. <br>
                        <i style="font-size: large">We wish to make your ideas reality. If you want to stand out, our
                            bold and unique visual will help you.</i></p>
                </div>
                <p>
                <h3 style="margin-bottom: 0;">Package 1 - Portrait</h3>
                <h4>Portrait Experience</h4>
                <span class="image left"><img id="imagePortrait" src="../../images/package_portrait.jpg" alt=""/></span>
                Do you want beautiful portraits? Wether it is for social media, or to display in your house,
                Vanilla Picture offers you the possibility to have high quality pictures that you will cherish forever.
                Wether it is for you, your family, or your friends, we adapt to all situations! Contact us to learn more
                about this service.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-2 col-12-medium"></div>
            <div class="col-8 col-12-medium">
                <p>
                <h3 style="margin-bottom: 0;">Package 2 - Brand</h3>
                <h4>Let's create your brand image</h4>
                <span class="image right"><img id="imageBrand" src="../../images/package_enterprise2.jpg" alt=""/></span>
                Are you a company looking for the best way to propel your product and / or service? Vanilla Picture and
                its team offer you the
                possibility to re-imagine your social media platforms. We will work together on new ideas in order to
                make your content unique
                and grow your following on social media.
                </p>
            </div>
        </div>
        <div class="row" style="padding-bottom: 2%;">
            <div class="col-2 col-12-medium"></div>
            <div class="col-8 col-12-medium">
                <p>
                <h3 style="margin-bottom: 0;">Package 3 - Travel</h3>
                <h4>Make your ideas travel</h4>
                <span class="image left"><img id="imageTravel" src="../../images/package_travel2.jpg" alt=""/></span>
                Do you want to reach a VAST clientele in a simple and efficient way? This service offers you the chance
                to make you product travel (company or individual) with a complete web marketing team.
                The goal is to create your brand image and then make it grow.
                </p>
            </div>
        </div>
        <ul class="customActions">
            <li><a href="../Gallery/gallery.php" class="button">See Gallery</a></li>
        </ul>
    </div>
</div>


<div id="myModal" class="modal">
    <!--                     The Close Button -->
    <span class="closeModal">&times;</span>
    <!--                     Modal Content (The Image) -->
    <img class="modal-content" id="img01">
</div>

<script language='javascript' type='text/javascript'>
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var modalImg = document.getElementById("img01");

    var imgs = document.getElementsByTagName("img");


    for (var i = 0; i < imgs.length; i++) {
        var img = document.getElementById(imgs[i].id);
        var curImageId = "";
        if (imgs[i].id != "") {
        img.onclick = function () {
            modal.style.display = "block";
            modalImg.src = this.src;
            curImageId = this.id;
        };
    }
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("closeModal")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    };
</script>


<!-- footer -->
<?php include '../Footer/footer.php' ?>

<!--Script Links-->
<?php include '../Footer/scriptsLinks.php' ?>

</body>
</html>