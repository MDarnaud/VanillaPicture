<?php include('reportsSimilar.php'); ?>

<!--        Summary Report-->
            <?php


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
                    $bookedShoot_summary_y_query ="SELECT count(shootId) as totalShoots FROM shoot WHERE year(shootDate)='$currentYear'";
                    $bookedShoot_result = mysqli_query($db, $bookedShoot_summary_y_query);
                    $totalBookedShootY = mysqli_fetch_assoc($bookedShoot_result);
                    $textNumBookedShootY = $totalBookedShootY['totalShoots'];


                    // % booked hours (available / booked)
                    // MEGANE (count number of available hour where date put = this year, count number of hours shoot booked where date booked = this year, calculate %)
                    $textPBookedHoursY = '%';

                    // $ spends per customer
                    $averageSpent_summary_y_query = "SELECT AVG(paymentTotal) as averagePayments FROM payment WHERE year(paymentDate)='$currentYear'";
                    $averagePayments_result = mysqli_query($db, $averageSpent_summary_y_query);
                    $averagePaymentsY = mysqli_fetch_assoc($averagePayments_result);
                    $textAveragePaymentY = '$'.$averagePaymentsY['averagePayments'];

                    // number of giftcards
                    $giftCard_summary_y_query = "SELECT count(paymentId) as totalGiftCards FROM payment WHERE year(paymentDate)='$currentYear'";
                    $giftCards_result = mysqli_query($db, $giftCard_summary_y_query);
                    $totalGiftCardsY = mysqli_fetch_assoc($giftCards_result);
                    $textNumGiftcardY = $totalGiftCardsY['totalGiftCards'];

                    // amount of gitcards
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


<!--Graphs Begin-->
<?php


//First
$currentYear = date("Y");
$dataPoints1 = array();
for($i=0;$i<5;$i++) {
    array_push($dataPoints1, array("label" => "$currentYear", "y" => $years[$i][$currentYear]['Number of New Customer']));
    $currentYear = $currentYear - 1;
}


//Second
$currentYear = date("Y");
$dataPoints2 = array();
for($i=0;$i<5;$i++) {
    array_push($dataPoints2, array("label" => "$currentYear", "y" => $years[$i][$currentYear]['Number of Announcement']));
    $currentYear = $currentYear - 1;
}


//Third
$currentYear = date("Y");
$dataPoints3 = array();
for($i=0;$i<5;$i++) {
    array_push($dataPoints3, array("label" => "$currentYear", "y" => $years[$i][$currentYear]['Amount Spent per Customer']));
    $currentYear = $currentYear - 1;
}

//Fourth
$currentYear = date("Y");
$dataPoints4 = array();
for($i=0;$i<5;$i++) {
    array_push($dataPoints4, array("label" => "$currentYear", "y" => $years[$i][$currentYear]['Number of Giftcards']));
    $currentYear = $currentYear - 1;
}


//Fifth
$currentYear = date("Y");
$dataPoints5 = array();
for($i=0;$i<5;$i++) {
    array_push($dataPoints5, array("label" => "$currentYear", "y" => $years[$i][$currentYear]['Amount of Giftcards']));
    $currentYear = $currentYear - 1;
}

//Sixth
$currentYear = date("Y");
$dataPoints6 = array();
for($i=0;$i<5;$i++) {
    array_push($dataPoints6, array("label" => "$currentYear", "y" => $years[$i][$currentYear]['Number of Shoot Booked']));
    $currentYear = $currentYear - 1;
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "light2",
                title: {
                    text: "Summary chart"
                },
                subtitles: [{
                    text: "Vanilla Picture"
                }],
                axisY: {
                    includeZero: false
                },
                legend:{
                    cursor: "pointer",
                    itemclick: toggleDataSeries
                },
                toolTip: {
                    shared: true
                },
                data: [{
                    type: "stackedArea",
                    name: "Customers",
                    showInLegend: true,
                    visible: false,
                    yValueFormatString: "#,##0 ",
                    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                },
                    {
                        type: "stackedArea",
                        name: "Announcements",
                        showInLegend: true,
                        yValueFormatString: "#,##0 ",
                        dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "stackedArea",
                        name: "$/User",
                        showInLegend: true,
                        visible: false,
                        yValueFormatString: "#,##0 $",
                        dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "stackedArea",
                        name: "#Giftcards",
                        showInLegend: true,
                        visible: false,
                        yValueFormatString: "#,##0 ",
                        dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "stackedArea",
                        name: "$Giftcards",
                        showInLegend: true,
                        visible: false,
                        yValueFormatString: "#,##0 $",
                        dataPoints: <?php echo json_encode($dataPoints5, JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "stackedArea",
                        name: "Shoots",
                        showInLegend: true,
                        yValueFormatString: "#,##0 ",
                        dataPoints: <?php echo json_encode($dataPoints6, JSON_NUMERIC_CHECK); ?>
                    }]
            });

            chart.render();

            function toggleDataSeries(e){
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                }
                else{
                    e.dataSeries.visible = true;
                }
                chart.render();
            }

        }
    </script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
<!--Graph End-->




<br><br>
            <h3>Yearly</h3>
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
                $BookedShoot_summary_M_query ="SELECT count(shootId) as totalShoots FROM shoot WHERE month(shootDate)='$currentMonth' AND year(shootDate)='$currentYear'"; //change shootDate to requestDate
                    $bookedShoot_result = mysqli_query($db, $bookedShoot_summary_y_query);
                    $totalBookedShootM = mysqli_fetch_assoc($bookedShoot_result);
                    $textNumBookedShootM = $totalBookedShootM['totalShoots'];

                // % booked hours (available / booked)
                // MEGANE (count number of available hour where date put = this month, count number of hours shoot booked where date booked = this month, calculate %)and year!!!
                    $textPBookedHoursM = ' %';

                // $ spends per customer
                    $averageSpent_summary_M_query = "SELECT AVG(paymentTotal) as averagePayments FROM payment WHERE month(paymentDate)='$currentMonth' AND year(paymentDate)='$currentYear'";
                    $averagePayments_result = mysqli_query($db, $averageSpent_summary_M_query);
                    $averagePaymentsM = mysqli_fetch_assoc($averagePayments_result);
                    $textSpentCustomerM = '$'.$averagePaymentsM['averagePayments'];

                // number of giftcards
                    $numGiftcard_summary_M_query = "SELECT count(paymentId) as totalGiftCards FROM payment WHERE month(paymentDate)='$currentMonth' AND year(paymentDate)='$currentYear'";
                    $giftCards_result = mysqli_query($db, $numGiftcard_summary_M_query);
                    $totalGiftCardsM = mysqli_fetch_assoc($giftCards_result);
                    $textNumGiftcardM = $totalGiftCardsM['totalGiftCards'];

                // amount of gitcards
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

<!--                Loop for a five weeks-->
            <?php
            //Weekly
                $day = date('w');

                $week_start_day = date('Y-m-d', strtotime('-'.$day.' days'));
                $week_end_day=date('Y-m-d', strtotime('+'.(6-$day).' days'));

                $currentMonth = date("m");

                $weeks = array();

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
                $numShoot_summary_w_query ="SELECT count(shootId) as totalShoots FROM shoot WHERE shootDate>='$week_start_day' AND shootDate<='$week_end_day'"; //change shootDate to requestDate
                    $bookedShoot_result = mysqli_query($db, $numShoot_summary_w_query);
                    $totalBookedShootW = mysqli_fetch_assoc($bookedShoot_result);
                    $textNumBookedShootW = $totalBookedShootW['totalShoots'];

                // % booked hours (available / booked)
                // MEGANE (count number of available hour where date put = this week, count number of hours shoot booked where date booked = this month, calculate %)
                    $textPBookedHoursW = ' %';

                // $ spends per customer
                    $averageSpent_summary_w_query = "SELECT AVG(paymentTotal) as averagePayments FROM payment WHERE paymentDate>='$week_start_day' AND paymentDate<='$week_end_day'";
                    $averagePayments_result = mysqli_query($db, $averageSpent_summary_w_query);
                    $averagePaymentsW = mysqli_fetch_assoc($averagePayments_result);
                    $textSpentCustomerW = '$'.$averagePaymentsW['averagePayments'];

                // number of giftcards
                    $numGiftcard_summary_w_query = "SELECT count(paymentId) as totalGiftCards FROM payment WHERE paymentDate>='$week_start_day' AND paymentDate<='$week_end_day'";
                    $giftCards_result = mysqli_query($db, $numGiftcard_summary_w_query);
                    $totalGiftCardsW = mysqli_fetch_assoc($giftCards_result);
                    $textNumGiftcardW = $totalGiftCardsM['totalGiftCards'];

                // amount of gitcards
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


        </div>
    </div>
</div>

<!-- footer -->
<?php include '../Footer/footer.php' ?>

<!--Script Links-->
<?php include '../Footer/scriptsLinks.php'?>


    </body>
</html>
