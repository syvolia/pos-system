<?php
include_once("init.php");

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>POSNIC - Report</title>

    <!-- Stylesheets -->

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="js/date_pic/date_input.css">

    <!-- Optimize for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- jQuery & JS files -->
    <?php include_once("tpl/common_js.php"); ?>
    <script src="js/date_pic/jquery.date_input.js"></script>
    <script src="js/script.js"></script>
    <script src="js/view_report.js"></script>
    

</head>
<body>

<!-- TOP BAR -->
<?php include_once("tpl/top_bar.php"); ?>
<!-- end top-bar -->


<!-- HEADER -->
<div id="header-with-tabs">

    <div class="page-full-width cf">

        <ul id="tabs" class="fl">
            <li><a href="dashboard.php" class="dashboard-tab">Dashboard</a></li>
            <li><a href="view_sales.php" class="sales-tab">Sales</a></li>
            <li><a href="view_customers.php" class=" customers-tab">Customers</a></li>
            <li><a href="view_purchase.php" class="purchase-tab">Purchase</a></li>
            <li><a href="view_supplier.php" class=" supplier-tab">Supplier</a></li>
            <li><a href="view_product.php" class="stock-tab">Stocks / Products</a></li>
            <li><a href="view_payments.php" class=" payment-tab">Payments / Outstandings</a></li>
            <li><a href="view_report.php" class="active-tab report-tab">Reports</a></li>
        </ul>
        <!-- end tabs -->

        <!-- Change this image to your own company's logo -->
        <!-- The logo will automatically be resized to 30px height. -->
        <a href="#" id="company-branding-small" class="fr"><img src="<?php if (isset($_SESSION['logo'])) {
                echo "upload/" . $_SESSION['logo'];
            } else {
                echo "upload/posnic.png";
            } ?>" alt="Point of Sale"/></a>

    </div>
    <!-- end full-width -->

</div>
<!-- end header -->


<!-- MAIN CONTENT -->
<div id="content">

    <div class="page-full-width cf">

        <div class="side-menu fl">

            <h3>Report</h3>
            <ul>
                <ul>
                    <li><a></a></li>

                </ul>
            </ul>


        </div>
        <!-- end side-menu -->

        <div class="side-content fr">

            <div class="content-module">

                <div class="content-module-heading cf">

                    <h3 class="fl">Report</h3>
                    <span class="fr expand-collapse-text">Click to collapse</span>
                    <span class="fr expand-collapse-text initial-expand">Click to expand</span>

                </div>
                <!-- end content-module-heading -->

                <div class="content-module-main cf">
                    <form action="">

                        <table class="form" border="0" cellspacing="0" cellpadding="0">
                            <form action="sales_report.php" method="post" name="form1" id="form1" name="sales_report"
                                  id="sales_report" target="myNewWinsr">
                                <tr>

                                    <td><strong>Sales Report </strong></td>
                                    <td>From</td>
                                    <td><input name="from_sales_date" type="text" id="from_sales_date"
                                               style="width:80px;"></td>
                                    <td>To</td>
                                    <td><input name="to_sales_date" type="text" id="to_sales_date" style="width:80px;">
                                    </td>
                                    <td><div style="padding-left: 15px;"><input class="button round blue image" name="submit" type="button" value="Show" onClick='sales_report_fn();'>
                                        </div></td>

                                </tr>
                            </form>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                            <form action="purchase_report.php" method="post" name="purchase_report" target="_blank">
                                <tr>
                                    <td><strong>Purchase Report </strong></td>
                                    <td>From</td>
                                    <td><input name="from_purchase_date" type="text" id="from_purchase_date"
                                               style="width:80px;"></td>
                                    <td>To</td>
                                    <td><input name="to_purchase_date" type="text" id="to_purchase_date"
                                               style="width:80px;"></td>
                                    <td><div style="padding-left: 15px;"><input class="button round blue image" name="submit" type="button" value="Show" onClick='purchase_report_fn();'>
                                        </div></td>
                                </tr>
                            </form>

                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                            <form action="sales_purchase_report.php" method="post" name="sales_purchase_report"
                                  target="_blank">
                                <tr>
                                    <td><strong>Purchase Stocks </strong></td>
                                    <td>From</td>
                                    <td><input name="from_sales_purchase_date" type="text" id="from_sales_purchase_date"
                                               style="width:80px;"></td>
                                    <td>To</td>
                                    <td><input name="to_sales_purchase_date" type="text" id="to_sales_purchase_date"
                                               style="width:80px;"></td>
                                    
                                    <td><div style="padding-left: 15px;"><input  class="button round blue image" name="submit" type="button" value="Show"
                                                onClick='sales_purchase_report_fn();'></div></td>
                                </tr>
                            </form>

                        </table>


                </div>
                <!-- end content-module-main -->


            </div>
            <!-- end content-module -->


        </div>
        <!-- end full-width -->

    </div>
    <!-- end content -->


    <!-- FOOTER -->
    <div id="footer">
       <p>Any Queries email to <a href="mailto:syvoliamary@gmail.com?subject=Stock%20Management%20System">syvoliamary@gmail.com</a>.
    </p>

    </div>
    <!-- end footer -->

</body>
</html>