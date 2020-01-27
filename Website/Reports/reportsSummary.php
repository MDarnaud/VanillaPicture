<?php include('reportsSimilar.php'); ?>

<!--        Summary Report-->
            <?php

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


        </div>
    </div>
</div>

<!-- footer -->
<?php include '../../footer/footer.php' ?>

<!-- Scripts -->
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/jquery.dropotron.min.js"></script>
<script src="../../assets/js/browser.min.js"></script>
<script src="../../assets/js/breakpoints.min.js"></script>
<script src="../../assets/js/util.js"></script>
<script src="../../assets/js/main.js"></script>


    </body>
</html>
