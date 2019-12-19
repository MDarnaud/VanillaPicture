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
            <header class="major">
                <h1>Reports</h1>
                <ul class="actions">
                    <li><button id="Summary" type="reset" value="Summary" onclick="location.href= './reports.php?reportSelect=summary'" >Summary</button></li>
                    <li><button id="Detail" type="reset" value="Detail" onclick="location.href= './reports.php?reportSelect=detail'" >Detail</button></li>
                    <li><button id="Exception" type="reset" value="Exception" onclick="location.href= './reports.php?reportSelect=exception'"  >Exception</button></li>
                    </ul>
            </header>
<!--        Set or retrieve the choosen type of report-->
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

                echo 'Yearly for '. date("Y").'<br>';
            // Yearly
                // New customer
                $currentYear = date("Y");
                $customer_summary_y_query = "SELECT count(customerId) as totalCustomer FROM customer WHERE year(customerDate)='$currentYear'";
                $customer_s_y_result = mysqli_query($db, $customer_summary_y_query);
                $totalNewCustomerY = mysqli_fetch_assoc($customer_s_y_result);
                $textCustomerY = 'New Customer: '.$totalNewCustomerY['totalCustomer'].'<br>';

                // Announcement
                $customer_summary_query = "SELECT count(announcementId) as totalAnnouncement FROM announcement WHERE year(announcementStartDate)='$currentYear'";
                $customer_result = mysqli_query($db, $customer_summary_query);
                $totalNewAnnouncementY = mysqli_fetch_assoc($customer_result);
                $textAnnouncemntY = 'Announcement: '.$totalNewAnnouncementY['totalAnnouncement'].'<br>';

                // Booked Shoot
                // MEGANE (count num of shootId where date booked = this year)

                // % booked hours (available / booked)
                // MEGANE (count number of available hour where date put = this year, count number of hours shoot booked where date booked = this year, calculate %)

                // $ spends per customer
                // MEGANE (count total balance where date bought = this year, count total customer, divide $ by customer)

                // number of giftcards
                // MEGANE (count num of giftcards id where date bought = this year)

                // amount of gitcards
                // MEGANE (count total balance of all giftcards where date bought = this year)

            ?>
                <table class="">
                    <tr>
                        <th>
                            New Customer
                        </th>
                        <td>
                            <?php echo $textCustomerY?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Total Announcement
                        </th>
                        <td>
                            <?php echo $textAnnouncemntY?>
                        </td>
                    </tr>
                </table>

                //do tables for year, month and week with the css

            <?php
            //Monthly
                echo '<br>Monthly for '. date("F").'<br>';
                // New customer
                $currentMonth = date("m");
                $customer_summary_month_query = "SELECT count(customerId) as totalCustomer FROM customer WHERE month(customerDate)='$currentMonth'";
                $customer_s_m_result = mysqli_query($db, $customer_summary_month_query);
                $totalNewCustomerM = mysqli_fetch_assoc($customer_s_m_result);
                echo 'New Customer: '.$totalNewCustomerM['totalCustomer'].'<br>';

                // Announcement
                $customer_summary_month_query = "SELECT count(announcementId) as totalAnnouncement FROM announcement WHERE month(announcementStartDate)='$currentMonth'";
                $customer_s_m_result = mysqli_query($db, $customer_summary_month_query);
                $totalNewAnnouncementM = mysqli_fetch_assoc($customer_s_m_result);
                echo 'Announcement: '.$totalNewAnnouncementM['totalAnnouncement'].'<br>';

                // Booked Shoot
                // MEGANE (count num of shootId where date booked = this month)

                // % booked hours (available / booked)
                // MEGANE (count number of available hour where date put = this month, count number of hours shoot booked where date booked = this month, calculate %)

                // $ spends per customer
                // MEGANE (count total balance where date bought = this month, count total customer, divide $ by customer)

                // number of giftcards
                // MEGANE (count num of giftcards id where date bought = this month)

                // amount of gitcards
                // MEGANE (count total balance of all giftcards where date bought = this month)


            //Weekly
                $day = date('w');
                $week_start = date('d F Y', strtotime('-'.$day.' days'));
                $week_end = date('d F Y', strtotime('+'.(6-$day).' days'));

                $week_start_day = date('Y-m-d', strtotime('-'.$day.' days'));
                $week_end_day=date('Y-m-d', strtotime('+'.(6-$day).' days'));

                echo '<br>Weekly for '. $week_start.' to '.$week_end.'<br>';
                // New customer
                $customer_summary_week_query = "SELECT count(customerId) as totalCustomer FROM customer WHERE customerDate>='$week_start_day' AND customerDate<='$week_end_day'";
                $customer_s_w_result = mysqli_query($db, $customer_summary_week_query);
                $totalNewCustomerW = mysqli_fetch_assoc($customer_s_w_result);
                echo 'New Customer: '.$totalNewCustomerW['totalCustomer'].'<br>';

                // Announcement
                $currentMonth = date("m");
                $customer_summary_week_query = "SELECT count(announcementId) as totalAnnouncement FROM announcement WHERE announcementStartDate>='$week_start_day' AND announcementStartDate<='$week_end_day'";
                $customer_s_w_result = mysqli_query($db, $customer_summary_week_query);
                $totalNewAnnouncementW = mysqli_fetch_assoc($customer_s_w_result);
                echo 'Announcement: '.$totalNewAnnouncementW['totalAnnouncement'].'<br>';

                // Booked Shoot
                // MEGANE (count num of shootId where date booked = this week)

                // % booked hours (available / booked)
                // MEGANE (count number of available hour where date put = this week, count number of hours shoot booked where date booked = this month, calculate %)

                // $ spends per customer
                // MEGANE (count total balance where date bought = this week, count total customer, divide $ by customer)

                // number of giftcards
                // MEGANE (count num of giftcards id where date bought = this week)

                // amount of gitcards
                // MEGANE (count total balance of all giftcards where date bought = this week)

            }
            ?>








<!--        Detail Report-->
            <?php
            if($reportSelect === 'detail'){
                echo 'detail';
            }
            ?>
<!--        Exception Report-->
            <?php
            if($reportSelect === 'exception'){
                echo 'exception';
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
