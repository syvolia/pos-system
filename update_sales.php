<?php
include_once("init.php");
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>POSNIC - Update Supplier</title>

        <!-- Stylesheets -->

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="js/date_pic/date_input.css">
        <link rel="stylesheet" href="lib/auto/css/jquery.autocomplete.css">

        <!-- Optimize for mobile devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!-- jQuery & JS files -->
        <?php include_once("tpl/common_js.php"); ?>
        <script src="js/date_pic/jquery.date_input.js"></script>
        <script src="lib/auto/js/jquery.autocomplete.js "></script>
        <script src="js/script.js"></script>
        <script src="js/update_sales.js"></script>
       
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
                    <li><a href="view_sales.php" class="active-tab sales-tab">Sales</a></li>
                    <li><a href="view_customers.php" class=" customers-tab">Customers</a></li>
                    <li><a href="view_purchase.php" class="purchase-tab">Purchase</a></li>
                    <li><a href="view_supplier.php" class=" supplier-tab">Supplier</a></li>
                    <li><a href="view_product.php" class="stock-tab">Stocks / Products</a></li>
                    <li><a href="view_payments.php" class="payment-tab">Payments / Outstandings</a></li>
                    <li><a href="view_report.php" class="report-tab">Reports</a></li>
                </ul>
                <!-- end tabs -->

                <!-- Change this image to your own company's logo -->
                <!-- The logo will automatically be resized to 30px height. -->
                <a href="#" id="company-branding-small" class="fr"><img src="<?php
if (isset($_SESSION['logo'])) {
    echo "upload/" . $_SESSION['logo'];
} else {
    echo "upload/posnic.png";
}
?>" alt="Point of Sale"/></a>

            </div>
            <!-- end full-width -->

        </div>
        <!-- end header -->


        <!-- MAIN CONTENT -->
        <div id="content">

            <div class="page-full-width cf">

                <div class="side-menu fl">

                    <h3>Sales Management</h3>
                    <ul>
                        <li><a href="add_sales.php">Add Sales</a></li>
                        <li><a href="view_sales.php">View Sales</a></li>

                    </ul>

                </div>
                <!-- end side-menu -->

                <div class="side-content fr">

                    <div class="content-module">

                        <div class="content-module-heading cf">

                            <h3 class="fl">Update sales</h3>
                            <span class="fr expand-collapse-text">Click to collapse</span>
                            <span class="fr expand-collapse-text initial-expand">Click to expand</span>

                        </div>
                        <!-- end content-module-heading -->

                        <div class="content-module-main cf">

                            <?php
                            if (isset($_POST['supplier']) and isset($_POST['stock_name'])) {
                                //$billnumber = mysqli_real_escape_string($db->connection, $_POST['bill_no']);
                                $autoid1 = mysqli_real_escape_string($db->connection, $_POST['id']);

                                $customer = mysqli_real_escape_string($db->connection, $_POST['supplier']);
                                $address = mysqli_real_escape_string($db->connection, $_POST['address']);
                                $contact = mysqli_real_escape_string($db->connection, $_POST['contact']);
                                $count = $db->countOf("customer_details", "customer_name='$customer'");
                                if ($count == 0) {
                                    $db->query("insert into customer_details(customer_name,customer_address,customer_contact1) values('$customer','$address','$contact')");
                                }
                                //$payment = mysqli_real_escape_string($db->connection, $_POST['payment']);
                                //$balance = mysqli_real_escape_string($db->connection, $_POST['balance']);
                                //$newvalue = $balance;
                                $oldvalue = $db->queryUniqueValue("SELECT balance FROM customer_details WHERE customer_name='$customer'");
                                //$diff = $newvalue - $oldvalue;
                                //$temp_balance = isset($temp_balance) ? $temp_balance : 0;
                                //$temp_balance = (int)$temp_balance + (int)$diff;
                                //$db->execute("UPDATE customer_details SET balance='$temp_balance' WHERE customer_name='$customer'");
                                // $selected_date = $_POST['due'];
                                // $selected_date = strtotime($selected_date);
                                // $mysqldate = date('Y-m-d H:i:s', $selected_date);
                                //$due = $mysqldate;
                                $mode = mysqli_real_escape_string($db->connection, $_POST['mode']);


                                //$newvalue = $balance;
                                $oldvalue = $db->queryUniqueValue("SELECT balance FROM customer_details WHERE customer_name='$customer'");
                                // $diff = $newvalue - $oldvalue;
                                //$temp_balance = (int)$temp_balance + (int)$diff;
                                //$db->execute("UPDATE customer_details SET balance='$temp_balance' WHERE customer_name='$customer'");
                                //$selected_date = $_POST['due'];
                                // $selected_date = strtotime($selected_date);
                                //$mysqldate = date('Y-m-d H:i:s', $selected_date);
                                //$due = $mysqldate;
                                $mode = mysqli_real_escape_string($db->connection, $_POST['mode']);
                                $description = mysqli_real_escape_string($db->connection, $_POST['description']);

                                $namet = $_POST['stock_name'];
                                $quantityt = isset($_POST['quanitity']) ? $_POST['quanitity'] : 0;
                                $ratet = $_POST['sell'];
                                $tax = $_POST['tax'];
                                $tax_did = $_POST['tax_dis'];
                                if ($_POST['tax'] == "") {
                                    $tax = 00;
                                }
                                if ($_POST['tax_dis'] == "") {
                                    
                                }

                                $totalt = $_POST['total'];
                                $payable = mysqli_real_escape_string($db->connection, $_POST['subtotal']);
                                $discount = mysqli_real_escape_string($db->connection, $_POST['discount']);
                                $dis_amount = mysqli_real_escape_string($db->connection, $_POST['dis_amount']);
                                if ($_POST['dis_amount'] == "") {
                                    $dis_amount = 00;
                                }
                                if ($_POST['discount'] == "") {
                                    $discount = 00;
                                }
                                $subtotal = mysqli_real_escape_string($db->connection, $_POST['payable']);

                                $username = $_SESSION['username'];

                                $i = 0;
                                $j = 1;

                                foreach ($namet as $name1) {
                                    $autoid = $_POST['s_id'][$i];
                                    $quantity = $_POST['quantity'][$i];
                                    $rate = $_POST['sell'][$i];
                                    $total = $_POST['total'][$i];
                                    $selected_date = $_POST['date'];
                                    $selected_date = strtotime($selected_date);
                                    $mysqldate = date('Y-m-d H:i:s', $selected_date);
                                    $username = $_SESSION['username'];

                                    $count = $db->queryUniqueValue("SELECT count(*) FROM stock_avail WHERE name='$name1' and quantity >='$quantity'");

                                    if ($count == 1) {

                                        $old_quantity = $db->queryUniqueValue("SELECT quantity FROM stock_sales WHERE id='$autoid' and count1='$i'");
                                        $db->query("update stock_sales set tax=$tax,tax_dis='$tax_did', grand_total='$payable',discount='$discount',dis_amount='$dis_amount', stock_name='$name1',selling_price='$rate',quantity='$quantity',amount='$total',date='$mysqldate',username='$username',customer_id='$customer',subtotal='$subtotal',mode='$mode',description='$description' where id='$autoid'");
                                        $quantity_diff = $quantity - $old_quantity;
                                        $quantity = $quantity + $quantity_diff;
                                        $amount = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name1'");
                                        $amount1 = $amount - $quantity;

                                        $db->query("update stock_entries set  stock_id='$autoid',stock_name='$name1',quantity='$quantity',opening_stock='$amount',closing_stock='$amount1',date='$mysqldate',username='$username',type='sales',total='$total',selling_price='$rate' where salesid='$autoid' and count1='$j'");
                                        //echo "<br><font color=green size=+1 >New Sales Added ! Transaction ID [ $autoid ]</font>" ;
                                        //echo "<br><font color=green size=+1> Current Stock Availability is  [ $amount1 ]</font>" ;
                                        $j++;
                                    } else {
                                        echo "<br><font color=green size=+1 >There is no enough stock deliver for $name1! Please add stock !</font>";
                                    }


                                    $i++;
                                }
                                $trans_id = trim($_POST['stockid']);
                                echo "<div style='background-color:yellow;'><br><font color=green size=+1 >Sales Updated ! Transaction ID [" . $_POST['stockid'] . "] !</font></div> ";
                                echo "<script>window.open('add_sales_print.php?sid=$trans_id','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');</script>";
                            }
                            //echo "<div style='background-color:yellow;'><br><font color=green size=+1 >Sales Updated ! Transaction ID [ $autoid ]</font></div> ";
                            //echo "<script>window.open('add_sales_print.php?sid=$autoid','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');</script>";
                            ?>
                            <?php
                            if (isset($_GET['sid']))
                                $id = $_GET['sid'];

                            $line = $db->queryUniqueObject("SELECT * FROM stock_sales WHERE id='$id'");
                            ?>
                            <form name="form1" method="post" id="form1" action="">
                                <input type="hidden" id="posnic_total">
                                <input type="hidden" name="id" value="<?php echo $id ?>">

                                <table class="form" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                            <?php
                            $max = $db->maxOfAll("transactionid", "stock_sales");
                            $max = $max + 1;
                            $autoid = "SL" . $max . "";
                            ?>
                                        <td>Bill no:</td>
                                        <td><input name="stockid" type="text" id="stockid" readonly="readonly" maxlength="200"
                                                   class="round default-width-input" style="width:130px "
                                                   value="<?php echo $line->transactionid; ?>"/></td>

                                        <td>Date:</td>
                                        <td><input name="date" id="test1" placeholder="" value="<?php echo $line->date; ?> "
                                                   style="margin-left: 15px;" type="text" id="name" maxlength="200" class="round default-width-input"/>
                                        </td>


                                    </tr>
                                    <tr>
                                        <td>Customer:</td>
                                        <td><input name="supplier" placeholder="ENTER SUPPLIER" type="text" id="supplier"
                                                   value="<?php echo $line->customer_id; ?> " maxlength="200"
                                                   class="round default-width-input" style="width:130px "/></td>

                                        <td>Address:</td>
                                        <td><input name="address" placeholder="ENTER ADDRESS" type="text"
                                                   value="<?php $quantity = $db->queryUniqueValue("SELECT customer_address FROM customer_details WHERE customer_name='" . $line->customer_id . "'");
                                        echo $quantity;
                            ?>" id="address" maxlength="200"
                                                   class="round default-width-input"/></td>

                                        <td>contact:</td>
                                        <td><input name="contact" placeholder="ENTER CONTACT" type="text"
                                                   value="<?php $quantity = $db->queryUniqueValue("SELECT customer_contact1 FROM customer_details WHERE customer_name='" . $line->customer_id . "'");
                                        echo $quantity;
                            ?>" id="contact1" maxlength="200"
                                                   class="round default-width-input" onkeypress="return numbersonly(event)"
                                                   style="width:120px "/></td>

                                    </tr>
                                </table>
                                <input type="hidden" id="guid">
                                <input type="hidden" id="edit_guid">

                                <table id="hideen_display">
                                    <tr>
                                        <td>Item</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td>Quantity</td>
                                        <td>Selling</td>
                                        <td>Available Stock</td>
                                        <td>Total</td>

                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                    </tr>
                                </table>
                                <table class="form" id="display" style="display:none">
                                    <tr>

                                        <td><input name="" type="text" id="item" maxlength="200" class="round my_with "
                                                   style="width: 150px"
                                                   value="<?php echo isset($supplier) ? $supplier : ''; ?>"/></td>

                                        <td><input name="" type="text" id="quty" maxlength="200" class="round  my_with"
                                                   onKeyPress="quantity_chnage(event);return numbersonly(event)"
                                                   onkeyup="stock_size();total_amount();unique_check();"
                                                   value="<?php echo isset($category) ? $category : ''; ?>"/></td>


                                        <td><input name="" type="text" id="sell" readonly="readonly" maxlength="200"
                                                   class="round  my_with"
                                                   value="<?php echo isset($category) ? $category : ''; ?>"/></td>


                                        <td><input name="" type="text" id="stock" readonly="readonly" maxlength="200"
                                                   class="round  my_with"
                                                   value="<?php echo isset($category) ? $category : ''; ?>"/></td>
                                        <td><input name="" type="text" id="total" maxlength="200"
                                                   class="round default-width-input " style="width:120px;  margin-left: 20px"
                                                   value="<?php echo isset($category) ? $category : ''; ?>"/></td>
                                        <td><input type="button" onclick="add_values()" onkeyup=" balance_amount();"
                                                   id="add_new_code"
                                                   style="margin-left:20px; width:30px;height:30px;border:none;background:url(images/save.png)"
                                                   class="round"></td>
                                        <td><input type="button" value="" id="cancel" onclick="clear_data()"
                                                   style="width:30px;float: right; border:none;height:30px;background:url(images/close_new.png)">
                                        </td>
                                    </tr>
                                </table>
                                <input type="hidden" id="guid">
                                <input type="hidden" id="edit_guid">


                                <div style="overflow:auto ;max-height:300px;  ">
                                    <table class="form" id="item_copy_final">

<?php
$sid = $line->transactionid;
$max = $db->maxOf("count1", "stock_sales", "transactionid ='$sid'");

for ($i = 1; $i <= $max; $i++) {
    $line1 = $db->queryUniqueObject("SELECT * FROM stock_sales WHERE transactionid ='$sid' and count1=$i");

    $item = $db->queryUniqueValue("SELECT transactionid  FROM stock_sales WHERE stock_name='" . $line1->stock_name . "'");
    ?>

                                            <tr>

                                                <td><input name="stock_name[]" type="text" id="<?php echo $item . "st" ?>"
                                                           maxlength="20" style="width: 150px" readonly="readonly"
                                                           class="round "
                                                           value="<?php echo $line1->stock_name; ?>"/></td>

                                                <td><input name="quantity[]" type="text" id="<?php echo $item . "q" ?>"
                                                           maxlength="20" class="round my_with"
                                                           value="<?php echo $line1->quantity; ?>" readonly="readonly"
                                                           onkeypress="return numbersonly(event)"/></td>


                                                <td><input type="hidden" name="s_id[]" value="<?php echo $line1->id; ?>"> <input
                                                        name="sell[]" type="text" id="<?php echo $item . "s" ?>" maxlength="20"
                                                        readonly="readonly" class="round my_with"
                                                        value="<?php echo $line1->selling_price; ?>"
                                                        onkeypress="return numbersonly(event)"/></td>
                                                <td><input name="stock[]" type="text" id="<?php echo $item . "p" ?>"
                                                           readonly="readonly" maxlength="200" class="round  my_with"
                                                           value="<?php $quantity = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='" . $line1->stock_name . "'");
                                        echo $quantity;
                                        ?>"/></td>

                                                <td><input name="total[]" type="text" id="<?php echo $item . "to" ?>"
                                                           readonly="readonly" maxlength="20"
                                                           style="margin-left:20px;width: 120px" class="round "
                                                           value="<?php echo $line1->amount; ?>"/></td>
                                                <td><input type="hidden" id="<?php echo $item . "my_tot" ?>" maxlength="20"
                                                           style="margin-left:20px;width: 120px" class="round "
                                                           value="<?php echo $line1->amount; ?>"/></td>
                                                <td><input type="hidden" id="<?php echo $item; ?>"><input type="hidden"
                                                                                                          name="gu_id[]"
                                                                                                          value="<?php echo $line1->id ?>">
                                                </td>
                                                <td><input type=button value="" id="<?php echo $item; ?>"
                                                           style="width:30px;border:none;height:30px;background:url(images/edit_new.png)"
                                                           class="round" onclick="edit_stock_details(this.id)"></td>
                                            </tr>
<?php } ?>
                                    </table>
                                </div>


                                <table class="form">

                                    <tr>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td><input type="checkbox" id="round" onclick="discount_type()">Discount As Amount</td>
                                    </tr>
                                    <tr>
                                        <td> &nbsp;</td>
                                        <td>Discount %<input type="text" maxlength="3" value="<?php echo $line->discount; ?>"
                                                             class="round" onkeyup=" discount_amount();
                                                                     "
                                                             onkeypress="return numbersonly(event);" name="discount"
                                                             id="discount">
                                        </td>

                                        <td>Discount Amount:<input type="text" readonly="readonly"
                                                                   value="<?php echo $line->dis_amount; ?>"
                                                                   onkeypress="return numbersonly(event);"
                                                                   onkeyup=" discount_as_amount();
                                                                           " class="round"
                                                                   id="disacount_amount" name="dis_amount">
                                        </td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td>Grand Total:<input type="hidden" readonly="readonly"
                                                               value="<?php echo $line->grand_total; ?>" id="grand_total"
                                                               name="subtotal">
                                            <input type="text" id="main_grand_total" readonly="readonly"
                                                   value="<?php echo $line->grand_total; ?>" class="round default-width-input"
                                                   style="text-align:right;width: 120px">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td> &nbsp;</td>
                                        <td> Tax:<input type="text" name="tax" value="<?php echo $line->tax ?>"
                                                        onkeypress="return numbersonly(event);"></td>
                                        <td>Tax Description:<input type="text" <?php echo $line->tax_dis ?> name="tax_dis"></td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td>Payable Amount:<input type="hidden" readonly="readonly" id="grand_total">
                                            <input type="text" id="payable_amount" value="<?php echo $line->subtotal; ?>"
                                                   readonly="readonly" name="payable" class="round default-width-input"
                                                   style="text-align:right;width: 120px">
                                        </td>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td>Mode &nbsp;</td>
                                        <td>
                                            <select name="mode">
                                                <option value="cheque">Cheque</option>
                                                <option value="cheque">Cash</option>
                                                <option value="cheque">Other</option>
                                            </select>
                                        </td>



                                        <td>Description</td>
                                        <td><textarea name="description"><?php echo $line->description; ?></textarea></td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                    </tr>
                                </table>
                                <table class="form">
                                    <tr>
                                        <td>
                                            <input class="button round blue image-right ic-add text-upper" type="submit"
                                                   name="Submit" value="Add">
                                        </td>
                                        <td> (Control + S)
                                            <input class="button round red   text-upper" type="reset" name="Reset"
                                                   value="Reset"></td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                    </tr>
                                </table>
                            </form>


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
                <p>Any Queries email to <a href="mailto:sridhar.posnic@gmail.com?subject=Stock%20Management%20System">sridhar.posnic@gmail.com</a>.
                </p>

            </div>
            <!-- end footer -->

    </body>
</html>