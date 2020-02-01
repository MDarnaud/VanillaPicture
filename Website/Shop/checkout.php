<?php
// Start the session
include '../../Header/SessionConnection.php';

// connect to the database
$db = mysqli_connect('localhost','root','','photography');

$email = "";
$name = "";

//user type
$userType = null;
if(isset($_SESSION['userSignIn'])){
    $userType = $_SESSION['userTypeSignIn'];
    $email = $_SESSION['userSignIn'];
    $user_check_query = "SELECT * FROM all_user WHERE userId='$email'";
    $resultUser = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($resultUser);

    if($user['userType'] === 'customer') {
        $customer_check_query = "SELECT * FROM customer WHERE userId='$email'";
        $resultCustomer = mysqli_query($db, $customer_check_query);
        $customer = mysqli_fetch_assoc($resultCustomer);
        $name = $customer['customerFirstName'];
    }
    elseif($user['userType'] === 'model'){
        $model_check_query = "SELECT * FROM model WHERE userId='$email'";
        $resultModel = mysqli_query($db, $model_check_query);
        $model = mysqli_fetch_assoc($resultModel);
        $name = $model['modelFirstName'];
    }
}



?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Vanilla Picture</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="../../assets/css/main.css" />
</head>
<body class="is-preload">

<?php include '../Navigation/navigation.php' ?>

<div class="gift-up-target" data-site-id="c0505ce1-43e3-4979-bd71-77d36060e96c" data-platform="Other" data-purchaser-name="<?php echo $name ?>" data-recipient-email="<?php echo $email ?>" data-purchaser-email="<?php echo $email ?>"></div>
<script type="text/javascript">
    (function (g, i, f, t, u, p, s) {
        g[u] = g[u] || function() { (g[u].q = g[u].q || []).push(arguments) };
        p = i.createElement(f);
        p.async = 1;
        p.src = t;
        s = i.getElementsByTagName(f)[0];
        s.parentNode.insertBefore(p, s);
    })(window, document, 'script', 'https://cdn.giftup.app/dist/gift-up.js', 'giftup');
</script>





<!-- footer -->
<?php include '../../Footer/Footer.php' ?>

<!-- Scripts -->
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/jquery.dropotron.min.js"></script>
<script src="../../assets/js/browser.min.js"></script>
<script src="../../assets/js/breakpoints.min.js"></script>
<script src="../../assets/js/util.js"></script>
<script src="../../assets/js/main.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
</body>
</html>


