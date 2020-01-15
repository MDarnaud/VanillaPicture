<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "serverExceptionReport.php";
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
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/gallery.css" />

    </head>
    <body class="is-preload">

<?php include './navigation/navigation.php' ?>
<!-- Main -->
<div id="main">
    <div class="wrapper">
        <div class="inner">
            <!-- Elements -->
            <header class="major" >
                <h1>Reports</h1>

            </header>
<div style=" display: block;margin-left: auto;margin-right: auto; width: 50%;">
            <ul class="actions">
                <li><button id="Summary" type="reset" value="Summary" onclick="location.href= './reports.php?reportSelect=summary'" >Summary</button></li>
                <li><button id="Detail" type="reset" value="Detail" onclick="location.href= './reports.php?reportSelect=detail'" >Detail</button></li>
                <li><button id="Exception" type="reset" value="Exception" onclick="location.href= './reports.php?reportSelect=exception'"  >Exception</button></li>
            </ul>
</div>

<!--        Set or retrieve the chosen type of report-->
            <?php
            $reportSelect = '';
            if(isset($_GET['reportSelect'])) {
                $reportSelect= $_GET['reportSelect'];
            }else{
                $reportSelect = 'summary';
            }
            ?>

<!--        Summary Report-->
            <?php
            if($reportSelect === 'summary'){

                echo '<h3>Yearly</h3>';
                $currentYear = date("Y");
            // Yearly
                $years = array();
                for($i=0; $i<5;$i++) {
                    // New customer
                    $customer_summary_y_query = "SELECT count(customerId) as totalCustomer FROM customer WHERE year(customerDate)='$currentYear'";
                    $customer_s_y_result = mysqli_query($db, $customer_summary_y_query);
                    $totalNewCustomerY = mysqli_fetch_assoc($customer_s_y_result);
                    $textCustomerY = $totalNewCustomerY['totalCustomer'];

                    // Announcement
                    $customer_summary_query = "SELECT count(announcementId) as totalAnnouncement FROM announcement WHERE year(announcementStartDate)='$currentYear'";
                    $customer_result = mysqli_query($db, $customer_summary_query);
                    $totalNewAnnouncementY = mysqli_fetch_assoc($customer_result);
                    $textAnnouncementY = $totalNewAnnouncementY['totalAnnouncement'];

                    // Booked Shoot
                    // MEGANE (count num of shootId where date booked = this year)
                    $bookedShoot_summary_y_query ="SELECT count(shootId) as totalShoots FROM shoot WHERE year(shootDate)='$currentYear'";
                    $bookedShoot_result = mysqli_query($db, $bookedShoot_summary_y_query);
                    $totalBookedShootY = mysqli_fetch_assoc($bookedShoot_result);
                    $textNumBookedShootY = $totalBookedShootY['totalShoots'];


                    // % booked hours (available / booked)
                    // MEGANE (count number of available hour where date put = this year, count number of hours shoot booked where date booked = this year, calculate %)
                    $textPBookedHoursY = '%';

                    // $ spends per customer
                    // MEGANE (count total balance where date bought = this year, count total customer, divide $ by customer)
                    $averageSpent_summary_y_query = "SELECT AVG(paymentTotal) as averagePayments FROM payment WHERE year(paymentDate)='$currentYear'";
                    $averagePayments_result = mysqli_query($db, $averageSpent_summary_y_query);
                    $averagePaymentsY = mysqli_fetch_assoc($averagePayments_result);
                    $textAveragePaymentY = '$'.$averagePaymentsY['averagePayments'];

                    // number of giftcards
                    // MEGANE (count num of giftcards id where date bought = this year)
                    $giftCard_summary_y_query = "SELECT count(paymentId) as totalGiftCards FROM payment WHERE year(paymentDate)='$currentYear'";
                    $giftCards_result = mysqli_query($db, $giftCard_summary_y_query);
                    $totalGiftCardsY = mysqli_fetch_assoc($giftCards_result);
                    $textNumGiftcardY = $totalGiftCardsY['totalGiftCards'];

                    // amount of gitcards
                    // MEGANE (count total balance of all giftcards where date bought = this year)
                    $totalPayment_summar_y_query = "SELECT SUM(paymentTotal) as totalPaymentsAmount FROM payment WHERE year(paymentDate)='$currentYear'";
                    $totalPayments_result = mysqli_query($db, $totalPayment_summar_y_query);
                    $totalPaymentsY = mysqli_fetch_assoc($totalPayments_result);
                    $textSpentGiftcardY = '$'.$totalPaymentsY['totalPaymentsAmount'];

                    //Two dimensional array
                    $newdata = array(
                            "Number of New Customer" => $textCustomerY,
                            "Number of Announcement" => $textAnnouncementY,
                            "Amount Spent per Customer" => $textAveragePaymentY,
                            "Number of Giftcards" => $textNumGiftcardY,
                            "Amount of Giftcards" => $textSpentGiftcardY,
                            "Number of Shoot Booked" => $textNumBookedShootY,
                            "Percentage of Booked Hours" => $textPBookedHoursY
                    );
                    array_push($years,array($currentYear=>$newdata));
                    $currentYear = $currentYear -1;
                }
            ?>
                <div class="table-wrapper">
                <table class="alt">
                    <tbody>
                        <tr>
                            <th>

                            </th>
                            <th>
                                Number of New Customer
                            </th>
                            <th>
                                Number of Announcement
                            </th>
                            <th>
                                Amount Spent per Customer
                            </th>
                            <th>
                                Number of Giftcards
                            </th>
                            <th>
                                Amount of Giftcards
                            </th>
                            <th>
                                Number of Shoot Booked
                            </th>
                            <th>
                                Percentage of Booked Hours
                            </th>
                        </tr>

                        <?php $currentYear = date("Y");?>
                        <?php for($i=0;$i<5;$i++){?>
                        <tr>
                            <th>
                                <?php echo $currentYear;?>
                            </th>
                            <td>
                                <?php echo $years[$i][$currentYear]['Number of New Customer']?>
                            </td>
                            <td>
                                <?php echo $years[$i][$currentYear]['Number of Announcement']?>
                            </td>
                            <td>
                                <?php echo $years[$i][$currentYear]['Amount Spent per Customer']?>
                            </td>
                            <td>
                                <?php echo $years[$i][$currentYear]['Number of Giftcards']?>
                            </td>
                            <td>
                                <?php echo $years[$i][$currentYear]['Amount of Giftcards']?>
                            </td>
                            <td>
                                <?php echo $years[$i][$currentYear]['Number of Shoot Booked']?>
                            </td>
                            <td>
                                <?php echo $years[$i][$currentYear]['Percentage of Booked Hours']?>
                            </td>
                        </tr>
                    <?php  $currentYear = $currentYear -1;
                        }?>
                    </tbody>
                </table>
                </div>

                <hr>
            <?php
            //Monthly
                echo '<h3>Monthly</h3>';
                // New customer
                $currentYear = date("Y");
                $currentMonth = date("m");
                $months = array();
                for($i=0; $i<5;$i++) {
                $currentMonth = date("m", strtotime("-".$i."months", $currentMonth));

                $customer_summary_month_query = "SELECT count(customerId) as totalCustomer FROM customer WHERE month(customerDate)='$currentMonth' AND year(customerDate)='$currentYear'";
                $customer_s_m_result = mysqli_query($db, $customer_summary_month_query);
                $totalNewCustomerM = mysqli_fetch_assoc($customer_s_m_result);
                $textCustomerM = $totalNewCustomerM['totalCustomer'];

                // Announcement
                $customer_summary_month_query = "SELECT count(announcementId) as totalAnnouncement FROM announcement WHERE month(announcementStartDate)='$currentMonth' AND year(announcementStartDate)='$currentYear'";
                $customer_s_m_result = mysqli_query($db, $customer_summary_month_query);
                $totalNewAnnouncementM = mysqli_fetch_assoc($customer_s_m_result);
                $textAnnouncementM = $totalNewAnnouncementM['totalAnnouncement'];

                // Booked Shoot
                // MEGANE (count num of shootId where date booked = this month) and year!!!
                    $BookedShoot_summary_M_query ="SELECT count(shootId) as totalShoots FROM shoot WHERE month(shootDate)='$currentMonth' AND year(shootDate)='$currentYear'"; //change shootDate to requestDate
                    $bookedShoot_result = mysqli_query($db, $bookedShoot_summary_y_query);
                    $totalBookedShootM = mysqli_fetch_assoc($bookedShoot_result);
                    $textNumBookedShootM = $totalBookedShootM['totalShoots'];

                // % booked hours (available / booked)
                // MEGANE (count number of available hour where date put = this month, count number of hours shoot booked where date booked = this month, calculate %)and year!!!
                    $textPBookedHoursM = ' %';

                // $ spends per customer
                // MEGANE (count total balance where date bought = this month, count total customer, divide $ by customer)and year!!!
                    $averageSpent_summary_M_query = "SELECT AVG(paymentTotal) as averagePayments FROM payment WHERE month(paymentDate)='$currentMonth' AND year(paymentDate)='$currentYear'";
                    $averagePayments_result = mysqli_query($db, $averageSpent_summary_M_query);
                    $averagePaymentsM = mysqli_fetch_assoc($averagePayments_result);
                    $textSpentCustomerM = '$'.$averagePaymentsM['averagePayments'];

                // number of giftcards
                // MEGANE (count num of giftcards id where date bought = this month)and year!!!
                    $numGiftcard_summary_M_query = "SELECT count(paymentId) as totalGiftCards FROM payment WHERE month(paymentDate)='$currentMonth' AND year(paymentDate)='$currentYear'";
                    $giftCards_result = mysqli_query($db, $numGiftcard_summary_M_query);
                    $totalGiftCardsM = mysqli_fetch_assoc($giftCards_result);
                    $textNumGiftcardM = $totalGiftCardsM['totalGiftCards'];

                // amount of gitcards
                // MEGANE (count total balance of all giftcards where date bought = this month)and year!!!
                    $totalPayment_summary_m_query = "SELECT SUM(paymentTotal) as totalPaymentsAmount FROM payment WHERE year(paymentDate)='$currentYear'";
                    $totalPayments_result = mysqli_query($db, $totalPayment_summary_m_query);
                    $totalPaymentsM = mysqli_fetch_assoc($totalPayments_result);
                    $textSpentGiftcardM = '$'.$totalPaymentsM['totalPaymentsAmount'];

                   //Two dimensional array
                    $newdata = array(
                            "Number of New Customer" => $textCustomerM,
                            "Number of Announcement" => $textAnnouncementM,
                            "Amount Spent per Customer" => $textSpentCustomerM,
                            "Number of Giftcards" => $textNumGiftcardM,
                            "Amount of Giftcards" => $textSpentGiftcardM,
                            "Number of Shoot Booked" => $textNumBookedShootM,
                            "Percentage of Booked Hours" => $textPBookedHoursM
                    );
                    array_push($months,array($currentMonth=>$newdata));

                }
            ?>
                <div class="table-wrapper">
                    <table class="alt">
                        <tbody>
                        <tr>
                            <th>

                            </th>
                            <th>
                                Number of New Customer
                            </th>
                            <th>
                                Number of Announcement
                            </th>
                            <th>
                                Amount Spent per Customer
                            </th>
                            <th>
                                Number of Giftcards
                            </th>
                            <th>
                                Amount of Giftcards
                            </th>
                            <th>
                                Number of Shoot Booked
                            </th>
                            <th>
                                Percentage of Booked Hours
                            </th>
                        </tr>

                        <?php $currentMonth = date("m");?>
                        <?php $currentDate = date("Y-m-d")?>
                        <?php for($i=0;$i<5;$i++) { ?>
                            <tr>
                                <th>
                                    <?php
                                    $currentMonth = date("m", strtotime("-".$i."months", $currentMonth));
                                    $dateObj = DateTime::createFromFormat('!m', $currentMonth);
                                    $monthName = $dateObj->format('F');
                                    echo $monthName;
                                    ?>
                                </th>
                                <td>
                                    <?php echo $months[$i][$currentMonth]['Number of New Customer'] ?>
                                </td>
                                <td>
                                    <?php echo $months[$i][$currentMonth]['Number of Announcement'] ?>
                                </td>
                                <td>
                                    <?php echo $months[$i][$currentMonth]['Amount Spent per Customer'] ?>
                                </td>
                                <td>
                                    <?php echo $months[$i][$currentMonth]['Number of Giftcards'] ?>
                                </td>
                                <td>
                                    <?php echo $months[$i][$currentMonth]['Amount of Giftcards'] ?>
                                </td>
                                <td>
                                    <?php echo $months[$i][$currentMonth]['Number of Shoot Booked'] ?>
                                </td>
                                <td>
                                    <?php echo $months[$i][$currentMonth]['Percentage of Booked Hours'] ?>
                                </td>
                            </tr>
                            <?php
                        }?>
                        </tbody>
                    </table>
                </div>
<!--                Loop for a few weeks-->
            <?php
            //Weekly
                $day = date('w');

                $week_start_day = date('Y-m-d', strtotime('-'.$day.' days'));
                $week_end_day=date('Y-m-d', strtotime('+'.(6-$day).' days'));

                $currentMonth = date("m");

                $weeks = array();

                echo '<hr>';
                echo '<h3>Weekly</h3>';

                $months = array();
                for($i=0; $i<5;$i++) {
                // New customer
                $customer_summary_week_query = "SELECT count(customerId) as totalCustomer FROM customer WHERE customerDate>='$week_start_day' AND customerDate<='$week_end_day'";
                $customer_s_w_result = mysqli_query($db, $customer_summary_week_query);
                $totalNewCustomerW = mysqli_fetch_assoc($customer_s_w_result);
                $textCustomerW = $totalNewCustomerW['totalCustomer'];

                // Announcement
                $announcement_summary_week_query = "SELECT count(announcementId) as totalAnnouncement FROM announcement WHERE announcementStartDate>='$week_start_day' AND announcementStartDate<='$week_end_day'";
                $announcement_s_w_result = mysqli_query($db, $announcement_summary_week_query);
                $totalNewAnnouncementW = mysqli_fetch_assoc($announcement_s_w_result);
                $textAnnouncementW = $totalNewAnnouncementW['totalAnnouncement'];

                // Booked Shoot
                // MEGANE (count num of shootId where date booked = this week)
                    $numShoot_summary_w_query ="SELECT count(shootId) as totalShoots FROM shoot WHERE shootDate>='$week_start_day' AND shootDate<='$week_end_day'"; //change shootDate to requestDate
                    $bookedShoot_result = mysqli_query($db, $numShoot_summary_w_query);
                    $totalBookedShootW = mysqli_fetch_assoc($bookedShoot_result);
                    $textNumBookedShootW = $totalBookedShootW['totalShoots'];

                // % booked hours (available / booked)
                // MEGANE (count number of available hour where date put = this week, count number of hours shoot booked where date booked = this month, calculate %)
                    $textPBookedHoursW = ' %';

                // $ spends per customer
                // MEGANE (count total balance where date bought = this week, count total customer, divide $ by customer)
                    $averageSpent_summary_w_query = "SELECT AVG(paymentTotal) as averagePayments FROM payment WHERE paymentDate>='$week_start_day' AND paymentDate<='$week_end_day'";
                    $averagePayments_result = mysqli_query($db, $averageSpent_summary_w_query);
                    $averagePaymentsW = mysqli_fetch_assoc($averagePayments_result);
                    $textSpentCustomerW = '$'.$averagePaymentsW['averagePayments'];

                // number of giftcards
                // MEGANE (count num of giftcards id where date bought = this week)
                    $numGiftcard_summary_w_query = "SELECT count(paymentId) as totalGiftCards FROM payment WHERE paymentDate>='$week_start_day' AND paymentDate<='$week_end_day'";
                    $giftCards_result = mysqli_query($db, $numGiftcard_summary_w_query);
                    $totalGiftCardsW = mysqli_fetch_assoc($giftCards_result);
                    $textNumGiftcardW = $totalGiftCardsM['totalGiftCards'];

                // amount of gitcards
                // MEGANE (count total balance of all giftcards where date bought = this week)
                    $totalPayment_summary_w_query = "SELECT SUM(paymentTotal) as totalPaymentsAmount FROM payment WHERE year(paymentDate)='$currentYear'";
                    $totalPayments_result = mysqli_query($db, $totalPayment_summary_w_query);
                    $totalPaymentsW = mysqli_fetch_assoc($totalPayments_result);
                    $textSpentGiftcardW = ' $'.$totalPaymentsM['totalPaymentsAmount'];


                    //Two dimensional array
                    $newdata = array(
                        "Number of New Customer" => $textCustomerW,
                        "Number of Announcement" => $textAnnouncementW,
                        "Amount Spent per Customer" => $textSpentCustomerW,
                        "Number of Giftcards" => $textNumGiftcardW,
                        "Amount of Giftcards" => $textSpentGiftcardW,
                        "Number of Shoot Booked" => $textNumBookedShootW,
                        "Percentage of Booked Hours" => $textPBookedHoursW
                    );
                    array_push($weeks, array($week_start_day=>$newdata));
                    $week_start_day=date('Y-m-d', strtotime($week_start_day. ' - 7 days'));
                    $week_end_day=date('Y-m-d', strtotime($week_end_day. ' - 7 days'));

                }
            ?>

            <?php
                $week_start_day = date('Y-m-d', strtotime('-'.$day.' days'));
                $week_end_day=date('Y-m-d', strtotime('+'.(6-$day).' days'));
            ?>
            <div class="table-wrapper">
                <table class="alt">
                    <tbody>
                    <tr>
                        <th>

                        </th>
                        <th>
                            Number of New Customer
                        </th>
                        <th>
                            Number of Announcement
                        </th>
                        <th>
                            Amount Spent per Customer
                        </th>
                        <th>
                            Number of Giftcards
                        </th>
                        <th>
                            Amount of Giftcards
                        </th>
                        <th>
                            Number of Shoot Booked
                        </th>
                        <th>
                            Percentage of Booked Hours
                        </th>
                    </tr>
                    <?php for($i=0;$i<5;$i++) { ?>
                        <tr>
                            <th>
                                <?php
                                $week_start = date('F d Y', strtotime($week_start_day));
                                $week_end = date('F d Y', strtotime($week_end_day));

                                echo $week_start.' to '.$week_end?>
                            </th>
                            <td>
                                <?php echo $weeks[$i][$week_start_day]['Number of New Customer'] ?>
                            </td>
                            <td>
                                <?php echo $weeks[$i][$week_start_day]['Number of Announcement'] ?>
                            </td>
                            <td>
                                <?php echo $weeks[$i][$week_start_day]['Amount Spent per Customer'] ?>
                            </td>
                            <td>
                                <?php echo $weeks[$i][$week_start_day]['Number of Giftcards'] ?>
                            </td>
                            <td>
                                <?php echo $weeks[$i][$week_start_day]['Amount of Giftcards'] ?>
                            </td>
                            <td>
                                <?php echo $weeks[$i][$week_start_day]['Number of Shoot Booked'] ?>
                            </td>
                            <td>
                                <?php echo $weeks[$i][$week_start_day]['Percentage of Booked Hours'] ?>
                            </td>
                        </tr>
                    <?php
                        $week_start_day=date('Y-m-d', strtotime($week_start_day. ' - 7 days'));
                        $week_end_day=date('Y-m-d', strtotime($week_end_day. ' - 7 days'));
                    } ?>
                    </tbody>
                </table>
            </div>
    <?php }?>



<!--        Detail Report-->
            <?php
            if($reportSelect === 'detail'){

            // Yearly
                $currentYear = date("Y");
                echo '<h3>Year '.$currentYear.'</h3>';
                echo '<h5>Customer Registration</h5>';
            ?>

            <div class="table-wrapper">
                <table class="alt">
                    <tbody>
                    <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Date of Birth
                        </th>
                        <th>
                            Country
                        </th>
                        <th>
                            City
                        </th>
                    </tr>
<!---->
                    <?php $currentYear = date("Y");?>
                    <?php
                    // New customer
                    $customer_detail_y_query = "SELECT * FROM customer WHERE year(customerDate)='$currentYear'";
                    $customer_d_y_result = mysqli_query($db, $customer_detail_y_query);
                    if(mysqli_num_rows($customer_d_y_result)>0){
                    while ($row = mysqli_fetch_assoc($customer_d_y_result)) {
                        $textCustomerUserIdY = $row['userId'];
                        $textCustomerNameY = $row['customerFirstName'] . ' ' . $row['customerLastName'];
                        $textCustomerDobY = $row['customerDob'];
                        $textCustomerCountryY = $row['customerCountry'];
                        $textCustomerCityY = $row['customerCity'];
                    ?>
                        <tr>
                            <td>
                               <?php echo $textCustomerUserIdY;?>
                            </td>
                           <td>
                               <?php echo $textCustomerNameY?>
                            </td>
                            <td>
                                <?php echo $textCustomerDobY?>
                            </td>
                            <td>
                                <?php echo $textCustomerCountryY?>
                            </td>
                            <td>
                                <?php echo $textCustomerCityY?>
                            </td>
                        </tr>
                    <?php }
            }?>
                    </tbody>
                </table>
            </div>

            <hr>

               <?php
                echo '<h5>Announcement</h5>'; ?>

                <div class="table-wrapper">
                    <table class="alt">
                        <tbody>
                        <tr>
                            <th>
                                Title
                            </th>
                            <th>
                                Text
                            </th>
                            <th>
                                Start Date
                            </th>
                            <th>
                                End Date
                            </th>
                        </tr>
                        <!---->
                        <?php $currentYear = date("Y");?>
                        <?php
                        // New customer
                        $announcement_detail_y_query = "SELECT * FROM announcement WHERE year(announcementStartDate)='$currentYear'";
                        $announcement_d_y_result = mysqli_query($db, $announcement_detail_y_query);
                        if(mysqli_num_rows($announcement_d_y_result)>0){
                            while ($row2 = mysqli_fetch_assoc($announcement_d_y_result)) {
                                $textAnnouncementUserIdY = $row2['announcementTitle'];
                                $textAnnouncementNameY = $row2['announcementDetail'];
                                $textAnnouncementDobY = $row2['announcementStartDate'];
                                $textAnnouncementCountryY = $row2['announcementEndDate'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $textAnnouncementUserIdY;?>
                                    </td>
                                    <td>
                                        <?php echo $textAnnouncementNameY?>
                                    </td>
                                    <td>
                                        <?php echo $textAnnouncementDobY?>
                                    </td>
                                    <td>
                                        <?php echo $textAnnouncementCountryY?>
                                    </td>
                                </tr>
                            <?php }
                        }?>
                        </tbody>
                    </table>
                </div>

                <hr>



<?php echo '<h5>Shoot</h5>'; ?>

                <div class="table-wrapper">
                    <table class="alt">
                        <tbody>
                        <tr>
                            <th>
                                Time
                            </th>
                            <th>
                                Date
                            </th>
                            <th>
                                Location
                            </th>
                            <th>
                                Artists
                            </th>
                            <th>
                                Package
                            </th>
                        </tr>

            <?php $currentYear = date("Y");?>
            <?php
            $shoot_detail_y_query = "SELECT * FROM shoot WHERE year(shootDate)='$currentYear'";
            $shoot_d_y_result = mysqli_query($db, $shoot_detail_y_query);
            if(mysqli_num_rows($shoot_d_y_result)>0){
                while ($row2 = mysqli_fetch_assoc($shoot_d_y_result)) {
                    $textShootTimeY = $row2['shootTime'];
                    $textShootDateY = $row2['shootDate'];
                    $textShootLocationY = $row2['shootLocation'];
                    $textShootArtistY = $row2['shootArtistType'];
                    $textShootPackageY = $row2['shootPackage'];
                    ?>
                    <tr>
                        <td>
                            <?php echo $textShootTimeY;?>
                        </td>
                        <td>
                            <?php echo $textShootDateY?>
                        </td>
                        <td>
                            <?php echo $textShootLocationY?>
                        </td>
                        <td>
                            <?php echo $textShootArtistY?>
                        </td>
                        <td>
                            <?php echo $textShootPackageY?>
                        </td>
                    </tr>
                <?php }
            }?>
            </tbody>
            </table>
        </div>
                <hr>

                <?php echo '<h5>Gift Cards</h5>'; ?> <!--PAYMENTS-->

                <div class="table-wrapper">
                    <table class="alt">
                        <tbody>
                        <tr>
                            <th>
                                Customer ID
                            </th>
                            <th>
                                Payment Date
                            </th>
                            <th>
                                Amount Paid
                            </th>
                        </tr>

                        <?php $currentYear = date("Y");?>
                        <?php
                        $payment_detail_y_query = "SELECT * FROM payment WHERE year(paymentDate)='$currentYear'";
                        $payment_d_y_result = mysqli_query($db, $shoot_detail_y_query);
                        if(mysqli_num_rows($shoot_d_y_result)>0){
                            while ($row2 = mysqli_fetch_assoc($shoot_d_y_result)) {
                                $textPaymentCustomerY = $row2['customerId'];
                                $textPaymentDateY = $row2['paymentDate'];
                                $textPaymentTotalY = $row2['paymentTotal'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $textPaymentCustomerY?>
                                    </td>
                                    <td>
                                        <?php echo $textPaymentDateY?>
                                    </td>
                                    <td>
                                        <?php echo '$'.$textPaymentTotalY?>
                                    </td>
                                </tr>
                            <?php }
                        }?>
                        </tbody>
                    </table>
                </div>


                <hr>

<!--               Monthly-->

               <?php // Monthly
                $currentMonth = date("F");
                echo '<h3>Month of '.$currentMonth.'</h3>';
                echo '<h5>Customer Registration</h5>'; ?>


            <div class="table-wrapper">
                <table class="alt">
                    <tbody>
                    <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Date of Birth
                        </th>
                        <th>
                            Country
                        </th>
                        <th>
                            City
                        </th>
                    </tr>
<!---->
                    <?php $currentMonth = date("m");
                    $currentYear = date("Y");

                    ?>
                    <?php
                    // New customer
                    $customer_detail_m_query = "SELECT * FROM customer WHERE month(customerDate)='$currentMonth' AND year(customerDate)='$currentYear'";
                    $customer_d_m_result = mysqli_query($db, $customer_detail_m_query);
                    if(mysqli_num_rows($customer_d_m_result)>0){
                    while ($row = mysqli_fetch_assoc($customer_d_m_result)) {
                        $textCustomerUserIdM = $row['userId'];
                        $textCustomerNameM = $row['customerFirstName'] . ' ' . $row['customerLastName'];
                        $textCustomerDobM = $row['customerDob'];
                        $textCustomerCountryM = $row['customerCountry'];
                        $textCustomerCityM = $row['customerCity'];
                    ?>
                        <tr>
                            <td>
                               <?php echo $textCustomerUserIdM;?>
                            </td>
                           <td>
                               <?php echo $textCustomerNameM?>
                            </td>
                            <td>
                                <?php echo $textCustomerDobM?>
                            </td>
                            <td>
                                <?php echo $textCustomerCountryM?>
                            </td>
                            <td>
                                <?php echo $textCustomerCityM?>
                            </td>
                        </tr>
                    <?php }
            }?>
                    </tbody>
                </table>
            </div>

            <hr>

                <?php echo '<h5>Announcement</h5>'; ?>

                <div class="table-wrapper">
                    <table class="alt">
                        <tbody>
                        <tr>
                            <th>
                                Title
                            </th>
                            <th>
                                Text
                            </th>
                            <th>
                                Start Date
                            </th>
                            <th>
                                End Date
                            </th>
                        </tr>
                        <!---->
                        <?php
                        $currentMonth = date("m");
                        $currentYear = date("Y");?>
                        <?php
                        // New customer
                        $announcement_detail_m_query = "SELECT * FROM announcement WHERE month(announcementStartDate)='$currentMonth' AND year(announcementStartDate)='$currentYear'";
                        $announcement_d_m_result = mysqli_query($db, $announcement_detail_m_query);
                        if(mysqli_num_rows($announcement_d_m_result)>0){
                            while ($row2 = mysqli_fetch_assoc($announcement_d_m_result)) {
                                $textAnnouncementUserIdM = $row2['announcementTitle'];
                                $textAnnouncementNameM = $row2['announcementDetail'];
                                $textAnnouncementDobM = $row2['announcementStartDate'];
                                $textAnnouncementCountryM = $row2['announcementEndDate'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $textAnnouncementUserIdM;?>
                                    </td>
                                    <td>
                                        <?php echo $textAnnouncementNameM?>
                                    </td>
                                    <td>
                                        <?php echo $textAnnouncementDobM?>
                                    </td>
                                    <td>
                                        <?php echo $textAnnouncementCountryM?>
                                    </td>
                                </tr>
                            <?php }
                        }?>
                        </tbody>
                    </table>
                </div>

                <hr>

                <?php echo '<h5>Shoot</h5>'; ?>

                <div class="table-wrapper">
                    <table class="alt">
                        <tbody>
                        <tr>
                            <th>
                                Time
                            </th>
                            <th>
                                Date
                            </th>
                            <th>
                                Location
                            </th>
                            <th>
                                Artists
                            </th>
                            <th>
                                Package
                            </th>
                        </tr>

                        <?php $currentYear = date("Y");?>
                        <?php
                        $shoot_detail_y_query = "SELECT * FROM shoot WHERE month(shootDate)='$currentMonth' AND year(shootDate)='$currentYear'";
                        $shoot_d_y_result = mysqli_query($db, $shoot_detail_y_query);
                        if(mysqli_num_rows($shoot_d_y_result)>0){
                            while ($row2 = mysqli_fetch_assoc($shoot_d_y_result)) {
                                $textShootTimeY = $row2['shootTime'];
                                $textShootDateY = $row2['shootDate'];
                                $textShootLocationY = $row2['shootLocation'];
                                $textShootArtistY = $row2['shootArtistType'];
                                $textShootPackageY = $row2['shootPackage'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $textShootTimeY;?>
                                    </td>
                                    <td>
                                        <?php echo $textShootDateY?>
                                    </td>
                                    <td>
                                        <?php echo $textShootLocationY?>
                                    </td>
                                    <td>
                                        <?php echo $textShootArtistY?>
                                    </td>
                                    <td>
                                        <?php echo $textShootPackageY?>
                                    </td>
                                </tr>
                            <?php }
                        }?>
                        </tbody>
                    </table>
                </div>
                <hr>

                <?php echo '<h5>Gift Cards</h5>'; ?> <!--PAYMENTS-->

                <div class="table-wrapper">
                    <table class="alt">
                        <tbody>
                        <tr>
                            <th>
                                Customer ID
                            </th>
                            <th>
                                Payment Date
                            </th>
                            <th>
                                Amount Paid
                            </th>
                        </tr>

                        <?php $currentYear = date("Y");?>
                        <?php
                        $payment_detail_y_query = "SELECT * FROM payment WHERE month(paymentDate)='$currentMonth' AND year(paymentDate)='$currentYear'";
                        $payment_d_y_result = mysqli_query($db, $payment_detail_y_query);
                        if(mysqli_num_rows($payment_d_y_result)>0){
                            while ($row2 = mysqli_fetch_assoc($payment_d_y_result)) {
                                $textPaymentCustomerY = $row2['customerId'];
                                $textPaymentDateY = $row2['paymentDate'];
                                $textPaymentTotalY = $row2['paymentTotal'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $textPaymentCustomerY?>
                                    </td>
                                    <td>
                                        <?php echo $textPaymentDateY?>
                                    </td>
                                    <td>
                                        <?php echo '$'.$textPaymentTotalY?>
                                    </td>
                                </tr>
                            <?php }
                        }?>
                        </tbody>
                    </table>
                </div>


                <hr>


            <?php }
            ?>




<!--        Exception Report-->
            <?php
            if($reportSelect === 'exception'){
            ?>
            <!--                Year or month choice radiobutton-->
            <div id="main">
                <div class="wrapper">
                    <div class="inner">
                        <?php if (isset($_GET['errors'])) {
                            echo $_GET['errors'];
                        }

                        ?>
                        <div class="wrapper special">
                            <form method="post" action="reports.php" class="announcementHome" style="text-align:center">

                                <div class="formDivision">
                                    <h3> Choose your report preferences</h3>

                                    <strong> Period: </strong>&nbsp; &nbsp;
                                    <input type="radio" name="period" id="year" value="year">
                                    <label for="year"> Year </label>

                                    <input type="radio" name="period" id="month" value="month">
                                    <label for="month"> Month </label>

                                    <!--                                    RadioButton clicked show the right dropdown-->
                                    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
                                    <script>
                                        $(document).ready(function () {
                                            $("input[type='radio']").click(function () {
                                                $('.dropdownPeriod').remove();
                                                var radioValue = $("input[name='period']:checked").val();
                                                if (radioValue == 'year') {
                                                    $('.formDivision').append('<div class="dropdownPeriod"><strong> Year: </strong>&nbsp; &nbsp;</div>');
                                                    $('.formDivision').append('<div class="dropdownPeriod"><?php $years = range(2000, strftime("%Y", time())); ?>\n' +
                                                        '<select name="dropdownYear" id="dropdownYear">\n' +
                                                        '<option value="">Select Year</option>\n' +
                                                        '<?php foreach($years as $year) : ?>\n' +
                                                        '<option value="<?php echo $year; ?>">\n' +
                                                        '    <?php echo $year; ?>\n' +
                                                        '</option><?php endforeach; ?>\n' +
                                                        '</select></div>');


                                                }
                                                if (radioValue == 'month') {
                                                    $('.formDivision').append('<div class="dropdownPeriod"><strong> Month: </strong>&nbsp; &nbsp;<input type="month" name="dropdownMonth" id="dropdownMonth"></div>');
                                                }
                                                $('.formDivision').append('<div class="dropdownPeriod"><br><strong> Elements: </strong>&nbsp; &nbsp;</div>');
                                                $('.formDivision').append('<div class="dropdownPeriod"><input type="checkbox" name="customer" id="customer" value="customer" class="elementsTable">\n' +
                                                    '     <label for="customer"> Customer Registration</label>\n' +
                                                    '                <input type="checkbox" name="annoucement" id="announcement" value="announcement" class="elementsTable">\n' +
                                                    '     <label for="announcement"> Announcements </label>\n' +
                                                    '                <input type="checkbox" name="shoot" id="shoot" value="shoot" class="elementsTable">\n' +
                                                    '     <label for="shoot"> Shoots </label>\n' +
                                                    '                <input type="checkbox" name="payment" id="payment" value="payment" class="elementsTable">\n' +
                                                    '     <label for="payment"> Payments </label></div>');

                                                var checkboxValue;
                                                $(":checkbox").change(function () {
                                                    $('.filters').remove();
                                                    checkboxValue = [];
                                                    $(':checkbox:checked').each(function (i) {
                                                        checkboxValue[i] = $(this).val();
                                                    });

                                                    $('.formDivision').append('<div class="filters"><br><strong>Filters: </strong>');

                                                    $(checkboxValue).each(function (i) {
                                                        if (checkboxValue[i] == 'customer') {
                                                            // Customer (Over 18 years old)
                                                            //Put radio button
                                                            $('.filters').append('<p><h5>Customer Registration</h5><input type="radio" name="age" id="over" value="over" class="elementsTable">\n' +
                                                                '<label for="over"> Over 18 years old</label>\n' + '<input type="radio" name="age" id="under" value="under" class="elementsTable">\n' +
                                                                '    <label for="under"> Under 18 years old</label>\n' + '</p>');
                                                        }
                                                        if (checkboxValue[i] == 'announcement') {
                                                            $('.filters').append('<p><h5>Announcements</h5>');
                                                            $('.filters').append('No filters for this subject </p>');
                                                        }
                                                        if (checkboxValue[i] == 'shoot') {
                                                            $('.filters').append('<p><h5>Shoots</h5>');
                                                            // Shoot(Location)
                                                            $('.filters').append('Location <input type="text" name="locationShoot" id="amountPay" value="" placeholder="ex: Toronto">\n');
                                                            //Shoot(Packages -123)
                                                            $('.filters').append('Packages Choice <select name="packages" id="packages"><option value="" selected hidden>--Select Package--</option><option value="1">Package 1</option><option value="2">Package 2</option><option value="3">Package 3</option></select>\n' + '</p>');

                                                        }
                                                        if (checkboxValue[i] == 'payment') {
                                                            // Payment (Over certain amount)
                                                            $('.filters').append('<p><h5>Payments</h5>Payment amount between <select name="paymentAmount"><option value="" selected hidden>--Select Range--</option><option value="050"> 0 - 50 $</option><option value="51100"> 51 - 100 $</option><option value="101200"> 101 - 200 $</option><option value="201"> 201 $ and more .. </option></select>\n' + '</p>');
                                                        }
                                                    })
                                                    $('.formDivision').append('</div>');

                                                });
                                            });
                                        });
                                    </script>


                                    <!--                                    We here (Depending of the selected table put possible filters)-->
                                    <!--                                    Missing payment to do
                                                                            Payment (Over certain amount)
                                    -->


                                </div>
                                <br>
                                <input type="submit" name="submit" id="submit" value="Submit">
                            </form>
                        </div>
                    </div>
                    <?php
                    //Year Selection
                    if (isset($_GET['errors'])) {
                        if ($_GET['errors'] === '') {
                            if ($_GET['period'] === 'year') {
                                //Checkbox elements selection
                                //Save the choosen year
                                $selectedYear = $_GET['year'];
                                // Year Title
                                echo '<h3>Year ' . $selectedYear . '</h3>';

                                //Customer Registration
                                if ($_GET['customer'] === 'customer') {
                                    ?>

                                    <h5>Customer Registration</h5>';
                                    <div class="table-wrapper">
                                        <table class="alt">
                                            <tbody>
                                            <tr>
                                                <th>
                                                    Id
                                                </th>
                                                <th>
                                                    Name
                                                </th>
                                                <th>
                                                    Date of Birth
                                                </th>
                                                <th>
                                                    Country
                                                </th>
                                                <th>
                                                    City
                                                </th>
                                            </tr>
                                            <?php
                                            // New customer
                                            //Age filter
                                            $dateAdult = date('Y-m-d', strtotime('18 years ago'));
                                            if ($_GET['age'] === 'over') {
                                                $customer_exception_y_query = "SELECT * FROM customer WHERE year(customerDate)='$selectedYear' AND $dateAdult > customerDob";
                                            } elseif ($_GET['age'] === 'under') {
                                                $customer_exception_y_query = "SELECT * FROM customer WHERE year(customerDate)='$selectedYear' AND $dateAdult <= customerDob";
                                            } else {
                                                $customer_exception_y_query = "SELECT * FROM customer WHERE year(customerDate)='$selectedYear'";
                                            }
                                            $customer_e_y_result = mysqli_query($db, $customer_exception_y_query);
                                            if (mysqli_num_rows($customer_e_y_result) > 0) {
                                                while ($row = mysqli_fetch_assoc($customer_e_y_result)) {
                                                    $textCustomerUserIdY = $row['userId'];
                                                    $textCustomerNameY = $row['customerFirstName'] . ' ' . $row['customerLastName'];
                                                    $textCustomerDobY = $row['customerDob'];
                                                    $textCustomerCountryY = $row['customerCountry'];
                                                    $textCustomerCityY = $row['customerCity'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $textCustomerUserIdY; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textCustomerNameY ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textCustomerDobY ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textCustomerCountryY ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textCustomerCityY ?>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <hr>
                                    <?php
                                }
                                //Announcement
                                if ($_GET['announcement'] === 'announcement') {
                                    ?>

                                    <?php echo '<h5>Announcements</h5>'; ?>

                                    <div class="table-wrapper">
                                        <table class="alt">
                                            <tbody>
                                            <tr>
                                                <th>
                                                    Title
                                                </th>
                                                <th>
                                                    Text
                                                </th>
                                                <th>
                                                    Start Date
                                                </th>
                                                <th>
                                                    End Date
                                                </th>
                                            </tr>
                                            <!---->
                                            <?php $currentYear = date("Y"); ?>
                                            <?php
                                            //announcement
                                            $announcement_exception_y_query = "SELECT * FROM announcement WHERE year(announcementStartDate)='$selectedYear'";
                                            $announcement_e_y_result = mysqli_query($db, $announcement_exception_y_query);
                                            if (mysqli_num_rows($announcement_e_y_result) > 0) {
                                                while ($row2 = mysqli_fetch_assoc($announcement_e_y_result)) {
                                                    $textAnnouncementUserIdY = $row2['announcementTitle'];
                                                    $textAnnouncementNameY = $row2['announcementDetail'];
                                                    $textAnnouncementDobY = $row2['announcementStartDate'];
                                                    $textAnnouncementCountryY = $row2['announcementEndDate'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $textAnnouncementUserIdY; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textAnnouncementNameY ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textAnnouncementDobY ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textAnnouncementCountryY ?>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <hr>
                                    <?php
                                }
                                //Shoots
                                if ($_GET['shoot'] === 'shoot') {
                                    if ($_GET['location'] != '') {
                                        $location = $_GET['location'];
                                        if ($_GET['packages'] != '') {
                                            $packages = $_GET['packages'];
                                            if ($_GET['paymentDropdown'] != '') {
                                                //Add report
                                                $shoot_exception_y_query = "SELECT * FROM shoot WHERE year(shootDate)='$selectedYear' AND shootLocation = '$location' AND shootPackage = '$packages'";
                                            } else {
                                                $shoot_exception_y_query = "SELECT * FROM shoot WHERE year(shootDate)='$selectedYear' AND shootLocation = '$location' AND shootPackage = '$packages'";
                                            }
                                        } else {
                                            $shoot_exception_y_query = "SELECT * FROM shoot WHERE year(shootDate)='$selectedYear' AND shootLocation = '$location'";
                                        }
                                    } else {
                                        if ($_GET['packages'] != '') {
                                            $packages = $_GET['packages'];
                                            $shoot_exception_y_query = "SELECT * FROM shoot WHERE year(shootDate)='$selectedYear' AND shootPackage = '$packages'";
                                        }
                                        $shoot_exception_y_query = "SELECT * FROM shoot WHERE year(shootDate)='$selectedYear'";
                                    }
                                    echo '<h5>Shoots</h5>';
                                    /*
                                     * MEGANE look above and do the same for shoot table, copy paste what you did in detail report but change current year for selected year
                                     */
                                    ?>
                                    <div class="table-wrapper">
                                        <table class="alt">
                                            <tbody>
                                            <tr>
                                                <th>
                                                    Time
                                                </th>
                                                <th>
                                                    Date
                                                </th>
                                                <th>
                                                    Location
                                                </th>
                                                <th>
                                                    Artists
                                                </th>
                                                <th>
                                                    Package
                                                </th>
                                            </tr>

                                            <?php $currentYear = date("Y"); ?>
                                            <?php
                                            $shoot_e_y_result = mysqli_query($db, $shoot_exception_y_query);
                                            if (mysqli_num_rows($shoot_e_y_result) > 0) {
                                                while ($row2 = mysqli_fetch_assoc($shoot_e_y_result)) {
                                                    $textShootTimeY = $row2['shootTime'];
                                                    $textShootDateY = $row2['shootDate'];
                                                    $textShootLocationY = $row2['shootLocation'];
                                                    $textShootArtistY = $row2['shootArtistType'];
                                                    $textShootPackageY = $row2['shootPackage'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $textShootTimeY; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textShootDateY ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textShootLocationY ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textShootArtistY ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textShootPackageY ?>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>

                                    <?php
                                }

                                //Payments
                                if ($_GET['payment'] === 'payment') {
                                    if ($_GET['paymentDropDown'] != '') {
                                        $paymentDd = $_GET['paymentDropDown'];
                                        if ($paymentDd != '') {
                                            if ($paymentDd === '050') {

                                                $payment_exception_y_query = "SELECT * FROM payment WHERE year(paymentDate)='$selectedYear' AND paymentTotal =< 0 AND paymentTotal => 50";

                                            } elseif ($paymentDd === '51100') {

                                                $shoot_exception_y_query = "SELECT * FROM payment WHERE year(paymentDate)='$selectedYear' AND paymentTotal =< 51 AND paymentTotal => 100";

                                            } elseif ($paymentDd === '101200') {

                                                $shoot_exception_y_query = "SELECT * FROM payment WHERE year(paymentDate)='$selectedYear' AND paymentTotal =< 101 AND paymentTotal => 200";

                                            } elseif ($paymentDd === '201') {

                                                $shoot_exception_y_query = "SELECT * FROM payment WHERE year(paymentDate)='$selectedYear' AND paymentTotal =< 201";

                                            }
                                        } else {
                                            $payment_exception_y_query = "SELECT * FROM payment WHERE year(paymentDate)='$selectedYear'";
                                        }
                                        echo '<h5>Payments</h5>';
                                        /*
                                        * MEGANE look above and do the same for payment table, copy paste what you did in detail report but change current year for selected year
                                        */
                                        ?>

                                        <div class="table-wrapper">
                                            <table class="alt">
                                                <tbody>
                                                <tr>
                                                    <th>
                                                        Customer ID
                                                    </th>
                                                    <th>
                                                        Payment Date
                                                    </th>
                                                    <th>
                                                        Amount Paid
                                                    </th>
                                                </tr>

                                                <?php $currentYear = date("Y");?>
                                                <?php
                                                $payment_e_y_result = mysqli_query($db, $payment_exception_y_query);
                                                if(mysqli_num_rows($payment_e_y_result)>0){
                                                    while ($row2 = mysqli_fetch_assoc($payment_e_y_result)) {
                                                        $textPaymentCustomerY = $row2['customerId'];
                                                        $textPaymentDateY = $row2['paymentDate'];
                                                        $textPaymentTotalY = $row2['paymentTotal'];
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $textPaymentCustomerY?>
                                                            </td>
                                                            <td>
                                                                <?php echo $textPaymentDateY?>
                                                            </td>
                                                            <td>
                                                                <?php echo $textPaymentTotalY?>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                }?>
                                                </tbody>
                                            </table>
                                        </div>


                                        <hr>

                                        <?php

                                    }
                                }
                            }
                            //Month
                            elseif ($_GET['period'] === 'month') {
                                $selectedMonthNotFormat = $_GET['month']; //January 2020 -> 2020-01
                                $selectedMonthName = date('F', strtotime($selectedMonthNotFormat));
                                $selectedMonth = date('m', strtotime($selectedMonthNotFormat));
                                $selectedYearWithMonth = date('Y', strtotime($selectedMonthNotFormat));
                                echo '<h3>Month of ' . $selectedMonthName . ' ' . $selectedYearWithMonth . '</h3>';
                                //Customer
                                if ($_GET['customer'] === 'customer') {
                                    echo '<h5>Customer Registration</h5>'; ?>
                                    <div class="table-wrapper">
                                        <table class="alt">
                                            <tbody>
                                            <tr>
                                                <th>
                                                    Id
                                                </th>
                                                <th>
                                                    Name
                                                </th>
                                                <th>
                                                    Date of Birth
                                                </th>
                                                <th>
                                                    Country
                                                </th>
                                                <th>
                                                    City
                                                </th>
                                            </tr>
                                            <!---->
                                            <?php $currentMonth = date("m");
                                            $currentYear = date("Y");

                                            ?>
                                            <?php
                                            // New customer
                                            //Age filter
                                            $dateAdult = date('Y-m-d', strtotime('18 years ago'));
                                            if ($_GET['age'] === 'over') {
                                                $customer_exception_m_query = "SELECT * FROM customer WHERE month(customerDate)='$selectedMonth' AND year(customerDate)='$selectedYearWithMonth' AND $dateAdult > customerDob";
                                            } elseif ($_GET['age'] === 'under') {
                                                $customer_exception_m_query = "SELECT * FROM customer WHERE month(customerDate)='$selectedMonth' AND year(customerDate)='$selectedYearWithMonth' AND $dateAdult <= customerDob";
                                            } else {
                                                $customer_exception_m_query = "SELECT * FROM customer WHERE month(customerDate)='$selectedMonth' AND year(customerDate)='$selectedYearWithMonth'";
                                            }
                                            $customer_e_m_result = mysqli_query($db, $customer_exception_m_query);
                                            if (mysqli_num_rows($customer_e_m_result) > 0) {
                                                while ($row = mysqli_fetch_assoc($customer_e_m_result)) {
                                                    $textCustomerUserIdM = $row['userId'];
                                                    $textCustomerNameM = $row['customerFirstName'] . ' ' . $row['customerLastName'];
                                                    $textCustomerDobM = $row['customerDob'];
                                                    $textCustomerCountryM = $row['customerCountry'];
                                                    $textCustomerCityM = $row['customerCity'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $textCustomerUserIdM; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textCustomerNameM ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textCustomerDobM ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textCustomerCountryM ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textCustomerCityM ?>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <hr>
                                    <?php
                                }
                                //Announcement
                                if ($_GET['announcement'] === 'announcement') {
                                    echo '<h5>Announcements</h5>'; ?>

                                    <div class="table-wrapper">
                                        <table class="alt">
                                            <tbody>
                                            <tr>
                                                <th>
                                                    Title
                                                </th>
                                                <th>
                                                    Text
                                                </th>
                                                <th>
                                                    Start Date
                                                </th>
                                                <th>
                                                    End Date
                                                </th>
                                            </tr>
                                            <!---->
                                            <?php
                                            $currentMonth = date("m");
                                            $currentYear = date("Y"); ?>
                                            <?php
                                            // New customer
                                            $announcement_exception_m_query = "SELECT * FROM announcement WHERE month(announcementStartDate)='$selectedMonth' AND year(announcementStartDate)='$selectedYearWithMonth'";
                                            $announcement_e_m_result = mysqli_query($db, $announcement_exception_m_query);
                                            if (mysqli_num_rows($announcement_e_m_result) > 0) {
                                                while ($row2 = mysqli_fetch_assoc($announcement_e_m_result)) {
                                                    $textAnnouncementUserIdM = $row2['announcementTitle'];
                                                    $textAnnouncementNameM = $row2['announcementDetail'];
                                                    $textAnnouncementDobM = $row2['announcementStartDate'];
                                                    $textAnnouncementCountryM = $row2['announcementEndDate'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $textAnnouncementUserIdM; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textAnnouncementNameM ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textAnnouncementDobM ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textAnnouncementCountryM ?>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <hr>
                                    <?php
                                }
                                //Shoots
                                if ($_GET['shoot'] === 'shoot') {
                                    echo "<h5> Shoots </h5>";

                                    if ($_GET['location'] != '') {
                                        $location = $_GET['location'];
                                        if ($_GET['packages'] != '') {
                                            $packages = $_GET['packages'];
                                            $shoot_exception_m_query = "SELECT * FROM shoot WHERE month(shootDate)='$selectedMonth' AND year(shootDate)='$selectedYearWithMonth'AND shootLocation = '$location' AND shootPackage = '$packages'";
                                        } else {
                                            $shoot_exception_m_query = "SELECT * FROM shoot WHERE month(shootDate)='$selectedMonth' AND year(shootDate)='$selectedYearWithMonth'AND shootLocation = '$location'";
                                        }
                                    } else {
                                        if ($_GET['packages'] != '') {
                                            $packages = $_GET['packages'];
                                            $shoot_exception_m_query = "SELECT * FROM shoot WHERE month(shootDate)='$selectedMonth' AND year(shootDate)='$selectedYearWithMonth'AND shootPackage = '$packages'";
                                        } else {
                                            $shoot_exception_m_query = "SELECT * FROM shoot WHERE month(shootDate)='$selectedMonth' AND year(shootDate)='$selectedYearWithMonth'";
                                        }
                                    }

                                    /*
                                     * MEGANE look above and do the same for shoot table, copy paste what you did in detail report but change current month for selected month
                                     */ ?>
                                    <div class="table-wrapper">
                                        <table class="alt">
                                            <tbody>
                                            <tr>
                                                <th>
                                                    Time
                                                </th>
                                                <th>
                                                    Date
                                                </th>
                                                <th>
                                                    Location
                                                </th>
                                                <th>
                                                    Artists
                                                </th>
                                                <th>
                                                    Package
                                                </th>
                                            </tr>

                                            <?php $currentYear = date("Y"); ?>
                                            <?php
                                            $shoot_e_m_result = mysqli_query($db, $shoot_exception_m_query);
                                            if (mysqli_num_rows($shoot_e_m_result) > 0) {
                                                while ($row2 = mysqli_fetch_assoc($shoot_e_m_result)) {
                                                    $textShootTimeY = $row2['shootTime'];
                                                    $textShootDateY = $row2['shootDate'];
                                                    $textShootLocationY = $row2['shootLocation'];
                                                    $textShootArtistY = $row2['shootArtistType'];
                                                    $textShootPackageY = $row2['shootPackage'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $textShootTimeY; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textShootDateY ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textShootLocationY ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textShootArtistY ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $textShootPackageY ?>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <?php
                                }
                                //Payments
                                    if ($_GET['payment'] === 'payment') {
                                        if ($_GET['paymentDropDown'] != '') {
                                            $paymentDd = $_GET['paymentDropDown'];
                                            if ($paymentDd != '') {
                                                if ($paymentDd === '050') {

                                                    $payment_exception_m_query = "SELECT * FROM payment WHERE month(paymentDate)='$selectedMonth' AND year(paymentDate)='$selectedYearWithMonth' AND paymentTotal =< 0 AND paymentTotal => 50";

                                                } elseif ($paymentDd === '51100') {

                                                    $payment_exception_m_query = "SELECT * FROM payment WHERE month(paymentDate)='$selectedMonth' AND year(paymentDate)='$selectedYearWithMonth' AND paymentTotal =< 51 AND paymentTotal => 100";

                                                } elseif ($paymentDd === '101200') {

                                                    $payment_exception_m_query = "SELECT * FROM payment WHERE month(paymentDate)='$selectedMonth' AND year(paymentDate)='$selectedYearWithMonth' AND paymentTotal =< 101 AND paymentTotal => 200";

                                                } elseif ($paymentDd === '201') {

                                                    $payment_exception_m_query = "SELECT * FROM payment WHERE month(paymentDate)='$selectedMonth' AND year(paymentDate)='$selectedYearWithMonth' AND paymentTotal =< 201";

                                                }
                                            }
                                        }
                                        else {
                                                $payment_exception_m_query = "SELECT * FROM payment WHERE month(paymentDate)='$selectedMonth' AND year(paymentDate)='$selectedYearWithMonth'";
                                                echo "hi";
                                            }

                                            /*
                                            * MEGANE look above and do the same for payment table, copy paste what you did in detail report but change current month for selected month
                                            */

                                            ?>
                                            <div class="table-wrapper">
                                                <table class="alt">
                                                    <tbody>
                                                    <tr>
                                                        <th>
                                                            Customer ID
                                                        </th>
                                                        <th>
                                                            Payment Date
                                                        </th>
                                                        <th>
                                                            Amount Paid
                                                        </th>
                                                    </tr>

                                                    <?php $currentYear = date("Y");?>
                                                    <?php
                                                    $payment_e_m_result = mysqli_query($db, $payment_exception_m_query);
                                                    var_dump($payment_e_m_result);
                                                    if(mysqli_num_rows($payment_e_m_result)>0){
                                                        while ($row2 = mysqli_fetch_assoc($payment_e_m_result)) {
                                                            $textPaymentCustomerY = $row2['customerId'];
                                                            $textPaymentDateY = $row2['paymentDate'];
                                                            $textPaymentTotalY = $row2['paymentTotal'];
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $textPaymentCustomerY?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $textPaymentDateY?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $textPaymentTotalY?>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php

                                    }
                            }
                        }
                    }

                            ?>



                <br>
                        <!--Year or month dropdown-->
                    <br>

<!--                Table choice-->

                <?php
            }

            ?>
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
