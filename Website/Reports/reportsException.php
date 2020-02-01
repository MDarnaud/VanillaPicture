
<?php
include "reportsSimilar.php";
include "serverExceptionReport.php";
?>
<!--        Exception Report-->
    <div id="main">
        <div class="wrapper">
            <div class="inner">
                <?php if (isset($_GET['errors'])) {
                    echo $_GET['errors'];
                }

                ?>
                <div class="wrapper special">
                    <form method="post" action="reportsException.php" class="announcementHome" style="text-align:center">

                        <div class="formDivision">
                            <h3> Choose your report preferences</h3>
<!--                Year or month choice radiobutton-->
                            <strong> Period: </strong>&nbsp; &nbsp;
                            <input type="radio" name="period" id="year" value="year">
                            <label for="year"> Year </label>

                            <input type="radio" name="period" id="month" value="month">
                            <label for="month"> Month </label>

<!--                 When radiobutton above clicked, rest of the form appears-->
                            <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
                            <script>
                                $(document).ready(function () {
                                    // If a radio button is clicked
                                    $("input[type='radio']").click(function () {
                                        // Remove the section added if the raiod button had been previously clicked
                                        $('.dropdownPeriod').remove();
                                        // Retrieve value of the clicked radio button
                                        var radioValue = $("input[name='period']:checked").val();
                                        // Verify if the user selected year
                                        if (radioValue == 'year') {
                                            // Append a year dropdown
                                            $('.formDivision').append('<div class="dropdownPeriod"><strong> Year: </strong>&nbsp; &nbsp;</div>');
                                            $('.formDivision').append('<div class="dropdownPeriod"><?php $years = range(2000, strftime("%Y", time())); ?>\n' +
                                                '<select name="dropdownYear" id="dropdownYear" required oninvalid="setCustomValidity(\'Year is required\')" oninput="setCustomValidity(\'\')">\n' +
                                                '<option value="">Select Year</option>\n' +
                                                '<?php foreach($years as $year) : ?>\n' +
                                                '<option value="<?php echo $year; ?>">\n' +
                                                '    <?php echo $year; ?>\n' +
                                                '</option><?php endforeach; ?>\n' +
                                                '</select></div>');


                                        }
                                        // Verify if the user selected month
                                        if (radioValue == 'month') {
                                            // Append a month dropdown
                                            $('.formDivision').append('<div class="dropdownPeriod"><strong> Month: </strong>&nbsp; &nbsp;' +
                                                '<input type="month" name="dropdownMonth" id="dropdownMonth"></div>');
                                        }
                                        // Append selection of all tables choices in checkbox format
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
                                        // If a checkbox is clicked
                                        $(":checkbox").change(function () {
                                            // Remove a paragraph which appears if a checkbox has previsoulsy been selected
                                            $('.filters').remove();
                                            checkboxValue = [];
                                            // Verify which checkbox has been clicked
                                            $(':checkbox:checked').each(function (i) {
                                                //Store checkbox value in an array
                                                checkboxValue[i] = $(this).val();
                                            });

                                            $('.formDivision').append('<div class="filters"><br><strong>Filters: </strong>');

                                            // Looping through the selected checkboxes
                                            $(checkboxValue).each(function (i) {
                                                if (checkboxValue[i] == 'customer') {
                                                    // Customer (Over 18 years old or Under choices)
                                                    $('.filters').append('<p><h5>Customer Registration</h5><input type="radio" name="age" id="over" value="over" class="elementsTable">\n' +
                                                        '<label for="over"> Over 18 years old</label>\n' + '<input type="radio" name="age" id="under" value="under" class="elementsTable">\n' +
                                                        '    <label for="under"> Under 18 years old</label>\n' + '</p>');
                                                }
                                                if (checkboxValue[i] == 'announcement') {
                                                    // Announcement (No filters)
                                                    $('.filters').append('<p><h5>Announcements</h5>');
                                                    $('.filters').append('No filters for this subject </p>');
                                                }
                                                if (checkboxValue[i] == 'shoot') {
                                                    // Shoot (Location and Package number choices)
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
                        </div>
                        <br>
                        <input type="submit" class="primary" name="submit" id="submit" value="Submit">
                    </form>
                </div>
            </div>
            <?php
            // Year Selection
            // Verify if there is any error with the preferences form (If so, dont display)
            if (isset($_GET['errors'])) {
                if ($_GET['errors'] === '') {
                    // Verify if the user selected "year" as a period
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
                                    // Age filter
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
                                    <?php $currentYear = date("Y"); ?>
                                    <?php
                                    // Announcement
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
                            // Verify if user has apply a filter for the Location
                            if ($_GET['location'] != '') {
                                $location = $_GET['location'];
                                // Verify if user has apply a filter for the Packages
                                if ($_GET['packages'] != '') {
                                    $packages = $_GET['packages'];
                                    // Both input precised
                                    $shoot_exception_y_query = "SELECT * FROM shoot WHERE year(shootDate)='$selectedYear' AND shootLocation = '$location' AND shootPackage = '$packages'";
                                } else {
                                    //only location precised
                                    $shoot_exception_y_query = "SELECT * FROM shoot WHERE year(shootDate)='$selectedYear' AND shootLocation = '$location'";
                                }
                            } else if ($_GET['packages'] != '') {
                                // Only package precised
                                $packages = $_GET['packages'];
                                $shoot_exception_y_query = "SELECT * FROM shoot WHERE year(shootDate)='$selectedYear' AND shootPackage = '$packages'";

                            }
                            else {
                                // No exception precised
                                $shoot_exception_y_query = "SELECT * FROM shoot WHERE year(shootDate)='$selectedYear'";
                            }
                            echo '<h5>Shoots</h5>';
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
                            // Verify if the user selected a payment amount filter
                            if ($_GET['paymentDropDown'] != '') {
                                $paymentDd = $_GET['paymentDropDown'];
                                if ($paymentDd != '') {
                                    if ($paymentDd === '050') {
                                        // 0-50$
                                        $payment_exception_y_query = "SELECT * FROM payment WHERE year(paymentDate)='$selectedYear' AND paymentTotal >= 0 AND paymentTotal <= 50";

                                    } elseif ($paymentDd === '51100') {
                                        // 51-100$
                                        $payment_exception_y_query = "SELECT * FROM payment WHERE year(paymentDate)='$selectedYear' AND paymentTotal >= 51 AND paymentTotal <= 100";

                                    } elseif ($paymentDd === '101200') {
                                        // 101-200$
                                        $payment_exception_y_query = "SELECT * FROM payment WHERE year(paymentDate)='$selectedYear' AND paymentTotal >= 101 AND paymentTotal <= 200";

                                    } elseif ($paymentDd === '201') {
                                        // 201$ and more
                                        $payment_exception_y_query = "SELECT * FROM payment WHERE year(paymentDate)='$selectedYear' AND paymentTotal >= 201";

                                    }
                                } else {
                                    //no filters
                                    $payment_exception_y_query = "SELECT * FROM payment WHERE year(paymentDate)='$selectedYear'";
                                }
                                echo '<h5>Payments</h5>';
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

                                    <?php
                                    $currentMonth = date("m");
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

                                    <?php
                                    $currentMonth = date("m");
                                    $currentYear = date("Y"); ?>
                                    <?php
                                    // New announcement
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

                            //Verify if user selected location filters
                            if ($_GET['location'] != '') {
                                $location = $_GET['location'];
                                //Verify if user selected packages filters
                                if ($_GET['packages'] != '') {
                                    $packages = $_GET['packages'];
                                    // Both options precised
                                    $shoot_exception_m_query = "SELECT * FROM shoot WHERE month(shootDate)='$selectedMonth' AND year(shootDate)='$selectedYearWithMonth'AND shootLocation = '$location' AND shootPackage = '$packages'";
                                } else {
                                    // Only location precised
                                    $shoot_exception_m_query = "SELECT * FROM shoot WHERE month(shootDate)='$selectedMonth' AND year(shootDate)='$selectedYearWithMonth'AND shootLocation = '$location'";
                                }
                            } else if ($_GET['packages'] != '') {
                                // Only package precised
                                $packages = $_GET['packages'];
                                $shoot_exception_m_query = "SELECT * FROM shoot WHERE month(shootDate)='$selectedMonth' AND year(shootDate)='$selectedYearWithMonth'AND shootPackage = '$packages'";
                            } else {
                                // No preferences precised
                                $shoot_exception_m_query = "SELECT * FROM shoot WHERE month(shootDate)='$selectedMonth' AND year(shootDate)='$selectedYearWithMonth'";
                            }
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

                                    <?php

                                    $currentYear = date("Y");

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
                            // Verify if the user made payment filters
                                if ($_GET['paymentDropDown'] != '') {
                                    $paymentDd = $_GET['paymentDropDown'];
                                    if ($paymentDd != '') {
                                        if ($paymentDd === '050') {
                                            // 0-50$
                                            $payment_exception_m_query = "SELECT * FROM payment WHERE month(paymentDate)='$selectedMonth' AND year(paymentDate)='$selectedYearWithMonth' AND paymentTotal >= 0 AND paymentTotal <= 50";

                                        } elseif ($paymentDd === '51100') {
                                            // 51-100$
                                            $payment_exception_m_query = "SELECT * FROM payment WHERE month(paymentDate)='$selectedMonth' AND year(paymentDate)='$selectedYearWithMonth' AND paymentTotal >= 51 AND paymentTotal <= 100";

                                        } elseif ($paymentDd === '101200') {
                                            // 101-200$
                                            $payment_exception_m_query = "SELECT * FROM payment WHERE month(paymentDate)='$selectedMonth' AND year(paymentDate)='$selectedYearWithMonth' AND paymentTotal >= 101 AND paymentTotal <= 200";

                                        } elseif ($paymentDd === '201') {
                                            // 201 and more
                                            $payment_exception_m_query = "SELECT * FROM payment WHERE month(paymentDate)='$selectedMonth' AND year(paymentDate)='$selectedYearWithMonth' AND paymentTotal >= 201";

                                        }
                                    } else {
                                        // no filters
                                        $payment_exception_m_query = "SELECT * FROM payment WHERE month(paymentDate)='$selectedMonth' AND year(paymentDate)='$selectedYearWithMonth'";
                                    }
                                    echo "<h5> Payments </h5>";
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


                                    <hr>
                                    <?php
                                }
                        }
                    }
                }
            }


            ?>
        </div>
    </div>


    <br>
    <br>




</div>
</div>
</div>
<!-- footer -->
<?php include '../Footer/footer.php' ?>

<!-- Scripts -->
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/jquery.dropotron.min.js"></script>
<script src="../../assets/js/browser.min.js"></script>
<script src="../../assets/js/breakpoints.min.js"></script>
<script src="../../assets/js/util.js"></script>
<script src="../../assets/js/main.js"></script>


</body>
</html>

