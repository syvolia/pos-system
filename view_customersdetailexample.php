<?php
session_start(); // Use session variable on this page. This function must put on the top of page.
if(!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin'){ // if session variable "username" does not exist.
    header("location: index.php?msg=Please%20login%20to%20access%20admin%20area%20!"); // Re-direct to index.php
}
else
{
include_once "db.php";



?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Welcome to Stock Management System !</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" title="no title"
          charset="utf-8"/>
    <link rel="stylesheet" href="css/template.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
    <script src="js/jquery.min.js" type="text/javascript"></script>

    <script src="js/jquery.hotkeys-0.7.9.js"></script>
    <!-- AJAX SUCCESS TEST FONCTION
        <script>function callSuccessFunction(){alert("success executed")}
                function callFailFunction(){alert("fail executed")}
        </script>
    -->


    <script LANGUAGE="JavaScript">
        <!--
        // Nannette Thacker http://www.shiningstar.net
        function confirmSubmit() {
            var agree = confirm("Are you sure you wish to Delete this Entry?");
            if (agree)
                return true;
            else
                return false;
        }

        function confirmDeleteSubmit() {
            var agree = confirm("Are you sure you wish to Delete Seletec Record?");
            if (agree)

                document.deletefiles.submit();
            else
                return false;
        }


        function checkAll() {

            var field = document.forms.deletefiles;
            for (i = 0; i < field.length; i++)
                field[i].checked = true;
        }

        function uncheckAll() {
            var field = document.forms.deletefiles;
            for (i = 0; i < field.length; i++)
                field[i].checked = false;
        }
        // -->
    </script>
    <script>


        $(document).ready(function () {
            // SUCCESS AJAX CALL, replace "success: false," by:     success : function() { callSuccessFunction() },
            $("#name").focus();
            $("#form1").validationEngine(),

                jQuery(document).bind('keydown', 'Ctrl+s', function () {
                    $('#form1').submit();
                    return false;
                });

            jQuery(document).bind('keydown', 'Ctrl+r', function () {
                $('#form1').reset();
                return false;
            });
            jQuery(document).bind('keydown', 'Ctrl+a', function () {
                window.location = "addstock.php";
                return false;
            });
            jQuery(document).bind('keydown', 'Ctrl+0', function () {
                window.location = "admin.php";
                return false;
            });
            jQuery(document).bind('keydown', 'Ctrl+1', function () {
                window.location = "add_purchase.php";
                return false;
            });
            jQuery(document).bind('keydown', 'Ctrl+2', function () {
                window.location = "add_stock_sales.php";
                return false;
            });
            jQuery(document).bind('keydown', 'Ctrl+3', function () {
                window.location = "add_stock.php";
                return false;
            });
            jQuery(document).bind('keydown', 'Ctrl+4', function () {
                window.location = "add_category.php";
                return false;
            });
            jQuery(document).bind('keydown', 'Ctrl+5', function () {
                window.location = "add_supplier_details.php";
                return false;
            });
            jQuery(document).bind('keydown', 'Ctrl+6', function () {
                window.location = "add_customer_details.php";
                return false;
            });
            jQuery(document).bind('keydown', 'Ctrl+7', function () {
                window.location = "view_stock_entries.php";
                return false;
            });
            jQuery(document).bind('keydown', 'Ctrl+8', function () {
                window.location = "view_stock_sales.php";
                return false;
            });
            jQuery(document).bind('keydown', 'Ctrl+9', function () {
                window.location = "view_stock_details.php";
                return false;
            });
            //$.validationEngine.loadValidation("#date")
            //alert($("#formID").validationEngine({returnIsValid:true}))
            //$.validationEngine.buildPrompt("#date","This is an example","error")	 		 // Exterior prompt build example								 // input prompt close example
            //$.validationEngine.closePrompt(".formError",true) 							// CLOSE ALL OPEN PROMPTS
        });
    </script>
    <style type="text/css">
        <!--
        body {
            margin-left: 0px;
            margin-top: 0px;
            margin-right: 0px;
            margin-bottom: 0px;
            background-color: #FFFFFF;
        }

        * {
            padding: 0px;
            margin: 0px;
        }

        #vertmenu {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 100%;
            width: 160px;
            padding: 0px;
            margin: 0px;
        }

        #vertmenu h1 {
            display: block;
            background-color: #FF9900;
            font-size: 90%;
            padding: 3px 0 5px 3px;
            border: 1px solid #000000;
            color: #333333;
            margin: 0px;
            width: 159px;
        }

        #vertmenu ul {
            list-style: none;
            margin: 0px;
            padding: 0px;
            border: none;
        }

        #vertmenu ul li {
            margin: 0px;
            padding: 0px;
        }

        #vertmenu ul li a {
            font-size: 80%;
            display: block;
            border-bottom: 1px dashed #C39C4E;
            padding: 5px 0px 2px 4px;
            text-decoration: none;
            color: #666666;
            width: 160px;
        }

        #vertmenu ul li a:hover, #vertmenu ul li a:focus {
            color: #000000;
            background-color: #eeeeee;
        }

        .style1 {
            color: #000000
        }

        div.pagination {

            padding: 3px;

            margin: 3px;

        }

        div.pagination a {

            padding: 2px 5px 2px 5px;

            margin: 2px;

            border: 1px solid #AAAADD;

            text-decoration: none; /* no underline */

            color: #000099;

        }

        div.pagination a:hover, div.pagination a:active {

            border: 1px solid #000099;

            color: #000;

        }

        div.pagination span.current {

            padding: 2px 5px 2px 5px;

            margin: 2px;

            border: 1px solid #000099;

            font-weight: bold;

            background-color: #000099;

            color: #FFF;

        }

        div.pagination span.disabled {

            padding: 2px 5px 2px 5px;

            margin: 2px;

            border: 1px solid #EEE;

            color: #DDD;

        }

        -->
    </style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center" valign="top">
            <table width="960" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table width="960" border="0" cellpadding="0" cellspacing="0" bgcolor="#ECECEC">
                            <tr>
                                <td height="90" align="left" valign="top"><img src="images/topbanner.jpg" width="960"
                                                                               height="82"></td>
                            </tr>
                            <tr>
                                <td height="800" align="left" valign="top">
                                    <table width="960" border="0" cellpadding="0" cellspacing="0" bgcolor="#ECECEC">
                                        <tr>
                                            <td width="130" align="left" valign="top">

                                                <br>

                                                <strong>Welcome <font
                                                        color="#3399FF"><?php echo $_SESSION['username']; ?>
                                                        !</font></strong><br> <br>
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td align="center"><a href="admin.php"><img
                                                                    src="images/home.png" width="130" height="99"
                                                                    border="0"></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"><a href="add_purchase.php"><img
                                                                    src="images/purchase.png" width="130" height="124"
                                                                    border="0"></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"><a href="add_stock_sales.php"><img
                                                                    src="images/sales.png" width="146" height="111"
                                                                    border="0"></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"><a href="report.php"><img
                                                                    src="images/reports.png" width="131" height="142"
                                                                    border="0"></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center">&nbsp;</td>
                                                    </tr>
                                                </table>


                                            </td>
                                            <td height="500" align="center" valign="top">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td><a href="add_stock_details.php"><img
                                                                    src="images/addstockdetails.png" width="67"
                                                                    height="62" border="0"></a></td>
                                                        <td><a href="add_supplier_details.php"><img
                                                                    src="images/supplier.png" width="67" height="54"
                                                                    border="0"></a></td>
                                                        <td><a href="add_customer_details.php"><img
                                                                    src="images/customer.png" width="67" height="54"
                                                                    border="0"></a></td>
                                                        <td><a href="add_category.php"><img src="images/categories.png"
                                                                                            width="67" height="54"
                                                                                            border="0"></a></td>
                                                        <td><a href="view_stock_sales.php"><img src="images/vsales.png"
                                                                                                width="67" height="54"
                                                                                                border="0"></a></td>
                                                        <td><a href="view_stock_entries.php"><img
                                                                    src="images/vpurchase.png" width="67" height="54"
                                                                    border="0"></a></td>
                                                        <td><a href="view_stock_details.php"><img
                                                                    src="images/stockdetails.png" width="67" height="54"
                                                                    border="0"></a></td>
                                                        <td><a href="view_stock_availability.php"><img
                                                                    src="images/savail.png" width="67" height="54"
                                                                    border="0"></a></td>
                                                        <td align="left" valign="top"><a
                                                                href="view_customer_details.php"><img
                                                                    src="images/customers.png" width="94" height="22"
                                                                    border="0"></a><br> <a
                                                                href="view_supplier_details.php"><img
                                                                    src="images/suppliers.png" width="94" height="22"
                                                                    border="0"></a><br>
                                                            <a href="view_payments.php"><img src="images/payments.png"
                                                                                             width="94" height="22"
                                                                                             border="0"></a></td>
                                                        <td align="left" valign="top"><a
                                                                href="view_stock_sales_payments.php"><img
                                                                    src="images/outstanding.png" width="94" height="22"
                                                                    border="0"></a><br> <a
                                                                href="view_stock_entries_payments.php"><img
                                                                    src="images/pendings.png" width="94" height="22"
                                                                    border="0"></a><br>
                                                            <a href="logout.php"><img src="images/logout.png" width="94"
                                                                                      height="22" border="0"></a></td>
                                                    </tr>
                                                </table>
                                                <table width="700" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>
                                                            <form action="" method="post" name="search">
                                                                <input name="searchtxt" type="text">
                                                                &nbsp;&nbsp;<input name="Search" type="submit"
                                                                                   value="Search">
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="" method="get" name="page">
                                                                Page per Record<input name="limit" type="text"
                                                                                      style="margin-left:5px;"
                                                                                      value="<?php if (isset($_GET['limit'])) echo $_GET['limit']; else echo "10"; ?>"
                                                                                      size="3" maxlength="3">
                                                                <input name="go" type="submit" value="Go">
                                                                <input type="button" name="selectall" value="SelectAll"
                                                                       onClick="checkAll()" style="margin-left:5px;"/>
                                                                <input type="button" name="unselectall"
                                                                       value="DeSelectAll" onClick="uncheckAll()"
                                                                       style="margin-left:5px;"/>
                                                                <input name="dsubmit" type="button"
                                                                       value="Delete Selected" style="margin-left:5px;"
                                                                       onclick="return confirmDeleteSubmit()"/></form>
                                                        </td>
                                                    </tr>
                                                </table>

                                                <?php


                                                $SQL = "SELECT * FROM  customer_details ORDER BY id DESC";
                                                if (isset($_POST['Search']) AND trim($_POST['searchtxt']) != "") {

                                                    $SQL = "SELECT * FROM  customer_details WHERE customer_name LIKE '%" . $_POST['searchtxt'] . "%' OR customer_address LIKE '%" . $_POST['searchtxt'] . "%' OR customer_contact1 LIKE '%" . $_POST['searchtxt'] . "%' OR customer_contact2 LIKE '%" . $_POST['searchtxt'] . "%' ORDER BY id DESC";


                                                }

                                                $tbl_name = "customer_details";        //your table name

                                                // How many adjacent pages should be shown on each side?

                                                $adjacents = 3;


                                                /*

                                                   First get total number of rows in data table.

                                                   If you have a WHERE clause in your query, make sure you mirror it here.

                                                */

                                                $query = "SELECT COUNT(*) as num FROM $tbl_name";
                                                if (isset($_POST['Search']) AND trim($_POST['searchtxt']) != "") {

                                                    $query = "SELECT COUNT(*) as num FROM  customer_details WHERE customer_name LIKE '%" . $_POST['searchtxt'] . "%' OR customer_address LIKE '%" . $_POST['searchtxt'] . "%' OR customer_contact1 LIKE '%" . $_POST['searchtxt'] . "%' OR customer_contact2 LIKE '%" . $_POST['searchtxt'] . "%'";


                                                }


                                                $total_pages = mysqli_fetch_array(mysqli_query($db->connection, $query));

                                                $total_pages = $total_pages['num'];


                                                /* Setup vars for query. */

                                                $targetpage = "view_customer_details.php";    //your file name  (the name of this file)

                                                $limit = 10;                                //how many items to show per page
                                                if (isset($_GET['limit']))
                                                    $limit = $_GET['limit'];


                                                $page = isset($_GET['page']) ? $_GET['page'] : 0;

                                                if ($page)

                                                    $start = ($page - 1) * $limit;            //first item to display on this page

                                                else

                                                    $start = 0;                                //if no page var is given, set start to 0


                                                /* Get data. */

                                                $sql = "SELECT * FROM customer_details  ORDER BY id DESC LIMIT $start, $limit ";
                                                if (isset($_POST['Search']) AND trim($_POST['searchtxt']) != "") {

                                                    $sql = "SELECT * FROM  customer_details WHERE customer_name LIKE '%" . $_POST['searchtxt'] . "%' OR customer_address LIKE '%" . $_POST['searchtxt'] . "%' OR customer_contact1 LIKE '%" . $_POST['searchtxt'] . "%' OR customer_contact2 LIKE '%" . $_POST['searchtxt'] . "%' ORDER BY id DESC  LIMIT $start, $limit";


                                                }


                                                $result = mysqli_query($db->connection, $sql);


                                                /* Setup page vars for display. */

                                                if ($page == 0) $page = 1;                    //if no page var is given, default to 1.

                                                $prev = $page - 1;                            //previous page is page - 1

                                                $next = $page + 1;                            //next page is page + 1

                                                $lastpage = ceil($total_pages / $limit);        //lastpage is = total pages / items per page, rounded up.

                                                $lpm1 = $lastpage - 1;                        //last page minus 1


                                                /*

                                                    Now we apply our rules and draw the pagination object.

                                                    We're actually saving the code to a variable in case we want to draw it more than once.

                                                */

                                                $pagination = "";

                                                if ($lastpage > 1) {

                                                    $pagination .= "<div class=\"pagination\">";

                                                    //previous button

                                                    if ($page > 1)

                                                        $pagination .= "<a href=\"$targetpage?page=$prev&limit=$limit\">� previous</a>";

                                                    else

                                                        $pagination .= "<span class=\"disabled\">� previous</span>";


                                                    //pages

                                                    if ($lastpage < 7 + ($adjacents * 2))    //not enough pages to bother breaking it up

                                                    {

                                                        for ($counter = 1; $counter <= $lastpage; $counter++) {

                                                            if ($counter == $page)

                                                                $pagination .= "<span class=\"current\">$counter</span>";

                                                            else

                                                                $pagination .= "<a href=\"$targetpage?page=$counter&limit=$limit\">$counter</a>";

                                                        }

                                                    } elseif ($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some

                                                    {

                                                        //close to beginning; only hide later pages

                                                        if ($page < 1 + ($adjacents * 2)) {

                                                            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {

                                                                if ($counter == $page)

                                                                    $pagination .= "<span class=\"current\">$counter</span>";

                                                                else

                                                                    $pagination .= "<a href=\"$targetpage?page=$counter&limit=$limit\">$counter</a>";

                                                            }

                                                            $pagination .= "...";

                                                            $pagination .= "<a href=\"$targetpage?page=$lpm1&limit=$limit\">$lpm1</a>";

                                                            $pagination .= "<a href=\"$targetpage?page=$lastpage&limit=$limit\">$lastpage</a>";

                                                        } //in middle; hide some front and some back

                                                        elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                                                            $pagination .= "<a href=\"$targetpage?page=1&limit=$limit\">1</a>";

                                                            $pagination .= "<a href=\"$targetpage?page=2&limit=$limit\">2</a>";

                                                            $pagination .= "...";

                                                            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {

                                                                if ($counter == $page)

                                                                    $pagination .= "<span class=\"current\">$counter</span>";

                                                                else

                                                                    $pagination .= "<a href=\"$targetpage?page=$counter&limit=$limit\">$counter</a>";

                                                            }

                                                            $pagination .= "...";

                                                            $pagination .= "<a href=\"$targetpage?page=$lpm1&limit=$limit\">$lpm1</a>";

                                                            $pagination .= "<a href=\"$targetpage?page=$lastpage&limit=$limit\">$lastpage</a>";

                                                        } //close to end; only hide early pages

                                                        else {

                                                            $pagination .= "<a href=\"$targetpage?page=1&limit=$limit\">1</a>";

                                                            $pagination .= "<a href=\"$targetpage?page=2&limit=$limit\">2</a>";

                                                            $pagination .= "...";

                                                            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {

                                                                if ($counter == $page)

                                                                    $pagination .= "<span class=\"current\">$counter</span>";

                                                                else

                                                                    $pagination .= "<a href=\"$targetpage?page=$counter&limit=$limit\">$counter</a>";

                                                            }

                                                        }

                                                    }


                                                    //next button

                                                    if ($page < $counter - 1)

                                                        $pagination .= "<a href=\"$targetpage?page=$next&limit=$limit\">next �</a>";

                                                    else

                                                        $pagination .= "<span class=\"disabled\">next �</span>";

                                                    $pagination .= "</div>\n";

                                                }

                                                ?>

                                                <form name="deletefiles" action="deleteselected.php" method="post">
                                                    <input name="table" type="hidden" value="customer_details">
                                                    <input name="return" type="hidden"
                                                           value="view_customer_details.php">

                                                    <table width="700" border="0" cellspacing="0" cellpadding="0">

                                                        <tr>

                                                            <td bgcolor="#0099FF">
                                                                <div align="center"><strong><span class="style1">View Supplier Details </span></strong>
                                                                </div>
                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td>&nbsp;</td>

                                                        </tr>

                                                        <tr>

                                                            <td align="center">
                                                                <table width="100%" border="0" cellspacing="0"
                                                                       cellpadding="0">

                                                                    <tr>

                                                                        <td width="100"><strong>Supplier Name </strong>
                                                                        </td>

                                                                        <td width="100"><strong>Supplier
                                                                                Address</strong></td>

                                                                        <td width="100"><strong>Supplier
                                                                                Contact1 </strong></td>

                                                                        <td width="100"><strong>Supplier Cotact
                                                                                2 </strong></td>
                                                                        <td width="100"><strong>View/Edit</strong></td>
                                                                        <td width="100"><strong>Delete</strong></td>
                                                                        <td width="100"><strong>Select</strong></td>

                                                                    </tr>


                                                                    <?php


                                                                    while ($row = mysqli_fetch_array($result)) {


                                                                        $mysqldate = $row['date'];

                                                                        $phpdate = strtotime($mysqldate);

                                                                        $phpdate = date("d/m/Y", $phpdate);


                                                                        ?>

                                                                        <tr>


                                                                            <td width="100"><?php echo $row['customer_name']; ?></td>

                                                                            <td width="100"><?php echo $row['customer_address']; ?></td>

                                                                            <td width="100"><?php echo $row['customer_contact1']; ?></td>


                                                                            <td width="100"><?php echo $row['customer_contact2']; ?></td>
                                                                            <td width="100"><a
                                                                                    href="update_customer_details.php?sid=<?php echo $row['id']; ?>"><img
                                                                                        src="images/edit-icon.png"
                                                                                        border="0" alt="delete"></a>
                                                                            </td>
                                                                            <td width="100"><a
                                                                                    onclick="return confirmSubmit()"
                                                                                    href="delete.php?id=<?php echo $row['id']; ?>&table=customer_details&return=view_customer_details.php"><img
                                                                                        src="images/delete.png"
                                                                                        border="0" alt="delete"></a>
                                                                            </td>
                                                                            <td width="100">
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;<input
                                                                                    type="checkbox"
                                                                                    value="<?php echo $row['id']; ?>"
                                                                                    name="checklist[]"/></td>

                                                                        </tr>


                                                                        <?php


                                                                    }


                                                                    ?>


                                                                </table>
                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td>&nbsp;</td>

                                                        </tr>

                                                        <tr>

                                                            <td align="center">&nbsp;</td>

                                                        </tr>

                                                        <tr>

                                                            <td align="center">
                                                                <div
                                                                    style="margin-left:20px;"><?php echo $pagination; ?></div>
                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td align="center">&nbsp;</td>

                                                        </tr>

                                                        <tr>

                                                            <td>&nbsp;</td>

                                                        </tr>

                                                        <tr>

                                                            <td align="center">&nbsp; </td>

                                                        </tr>

                                                        <tr>

                                                            <td>&nbsp;</td>

                                                        </tr>

                                                    </table>


                                                </form>


                                            </td>

                                        </tr>

                                    </table>

                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
                <tr>
                    <td height="30" align="center" bgcolor="#72C9F4"><span class="style1"><a
                                href="mailto:sridhar.posnic@gmail.com?Subject=Stock%20Management%20System">Any Queries
                                Mail to : sridhar.posnic@gmail.com</a></span></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</td>
</tr>
</table>

</body>
</html>
<?php
}
?>