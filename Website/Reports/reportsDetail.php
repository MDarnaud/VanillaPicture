<?php
// Include the header of reports
include "reportsSimilar.php";
if(isset($_SESSION['userSignIn'])){
    if($_SESSION['userTypeSignIn'] === 'administrator'){
?>
<!--        Detail Report-->
<?php
$currentYear = date("Y");
    // Yearly
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
            <!-- Get the information for new customers for years-->
            <?php $currentYear = date("Y");?>
            <?php
            // New Customer
            // Retrieve all records for the registration for the current year
            $customer_detail_y_query = "SELECT * FROM customer WHERE year(customerDate)='$currentYear'";
            $customer_d_y_result = mysqli_query($db, $customer_detail_y_query);
            // Verify if their is record
            if(mysqli_num_rows($customer_d_y_result)>0){
                // Get the records in variables
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
            <?php $currentYear = date("Y");?>
            <?php
            // New announcement
            $announcement_detail_y_query = "SELECT * FROM announcement WHERE year(announcementStartDate)='$currentYear'";
            $announcement_d_y_result = mysqli_query($db, $announcement_detail_y_query);
            // Verify is there is announcement
            if(mysqli_num_rows($announcement_d_y_result)>0){
                // Get the announcement from the db in variables
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
            // Booked Shoot
            $shoot_detail_y_query = "SELECT * FROM shoot WHERE year(shootDate)='$currentYear'";
            $shoot_d_y_result = mysqli_query($db, $shoot_detail_y_query);
            // Verify if there is any booked shoot in the database
            if(mysqli_num_rows($shoot_d_y_result)>0){
                // Get the information from the db to variables
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

    <?php echo '<h5>Payments</h5>'; ?>

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
            // Number of giftcards
            $payment_detail_y_query = "SELECT * FROM payment WHERE year(paymentDate)='$currentYear'";
            $payment_d_y_result = mysqli_query($db, $payment_detail_y_query);
            // Verify if there is any records
            if(mysqli_num_rows($payment_d_y_result)>0){
                // Get the giftcards information from the db in variables
                while ($row2 = mysqli_fetch_assoc($payment_d_y_result)) {
                    $textPaymentCustomerY = $row2['userId'];
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


    <hr style="margin-top: 15%;margin-bottom: 15%;">

    <!--               Monthly-->

    <?php // Monthly
    $currentMonth = date("F"); // get the current month in a word format
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
            <?php
            $currentMonth = date("m"); // get the current month in number format
            $currentYear = date("Y"); // get the current year in number format
            ?>
            <?php
            // New customer
            $customer_detail_m_query = "SELECT * FROM customer WHERE month(customerDate)='$currentMonth' AND year(customerDate)='$currentYear'";
            $customer_d_m_result = mysqli_query($db, $customer_detail_m_query);
            // Verify if there is any records
            if(mysqli_num_rows($customer_d_m_result)>0){
                // Get information from the db and put it in variables
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
            <?php
            $currentMonth = date("m"); // get the current month in number format
            $currentYear = date("Y"); // get the current year in number format

            // New customer
            $announcement_detail_m_query = "SELECT * FROM announcement WHERE month(announcementStartDate)='$currentMonth' AND year(announcementStartDate)='$currentYear'";
            $announcement_d_m_result = mysqli_query($db, $announcement_detail_m_query);
            // Verify if there is any records
            if(mysqli_num_rows($announcement_d_m_result)>0){
                // Get information from the db and put it in variables
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
            $shoot_detail_m_query = "SELECT * FROM shoot WHERE month(shootDate)='$currentMonth' AND year(shootDate)='$currentYear'";
            $shoot_d_m_result = mysqli_query($db, $shoot_detail_m_query);
            //Verify if there is any records
            if(mysqli_num_rows($shoot_d_m_result)>0){
                // Get information from the db and put it in variables
                while ($row2 = mysqli_fetch_assoc($shoot_d_m_result)) {
                    $textShootTimeM = $row2['shootTime'];
                    $textShootDateM = $row2['shootDate'];
                    $textShootLocationM = $row2['shootLocation'];
                    $textShootArtistM = $row2['shootArtistType'];
                    $textShootPackageM = $row2['shootPackage'];
                    ?>
                    <tr>
                        <td>
                            <?php echo $textShootTimeM;?>
                        </td>
                        <td>
                            <?php echo $textShootDateM?>
                        </td>
                        <td>
                            <?php echo $textShootLocationM?>
                        </td>
                        <td>
                            <?php echo $textShootArtistM?>
                        </td>
                        <td>
                            <?php echo $textShootPackageM?>
                        </td>
                    </tr>
                <?php }
            }?>
            </tbody>
        </table>
    </div>
    <hr>

    <?php echo '<h5>Payments</h5>'; ?> <!--PAYMENTS-->

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
            // Number of Giftcards
            $payment_detail_m_query = "SELECT * FROM payment WHERE month(paymentDate)='$currentMonth' AND year(paymentDate)='$currentYear'";
            $payment_d_m_result = mysqli_query($db, $payment_detail_m_query);
            // Verify if there is any records
            if(mysqli_num_rows($payment_d_m_result)>0){
                // Get information from the db and put it in variables
                while ($row2 = mysqli_fetch_assoc($payment_d_m_result)) {
                    $textPaymentCustomerM = $row2['userId'];
                    $textPaymentDateM = $row2['paymentDate'];
                    $textPaymentTotalM = $row2['paymentTotal'];
                    ?>
                    <tr>
                        <td>
                            <?php echo $textPaymentCustomerM?>
                        </td>
                        <td>
                            <?php echo $textPaymentDateM?>
                        </td>
                        <td>
                            <?php echo '$'.$textPaymentTotalM?>
                        </td>
                    </tr>
                <?php }
            }?>
            </tbody>
        </table>
    </div>


    <hr>


</div>
</div>
</div>

<!-- footer -->
<?php include '../Footer/footer.php' ?>

<!--Script Links-->
<?php include '../Footer/scriptsLinks.php'?>


</body>
</html>
<?php }else{
    header('location: ../../Website/Home/homepage.php');
}
}else{
    header('location: ../../Website/Home/homepage.php');
}
