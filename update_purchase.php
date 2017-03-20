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
    <script src="js/update_purchase.js"></script>
   
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
            <li><a href="view_purchase.php" class="active-tab purchase-tab">Purchase</a></li>
            <li><a href="view_supplier.php" class=" supplier-tab">Supplier</a></li>
            <li><a href="view_product.php" class="stock-tab">Stocks / Products</a></li>
            <li><a href="view_payments.php" class="payment-tab">Payments / Outstandings</a></li>
            <li><a href="view_report.php" class="report-tab">Reports</a></li>
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

            <h3>Purchase Management</h3>
            <ul>
                <li><a href="add_purchase.php">Add Purchase</a></li>
                <li><a href="view_purchase.php">View Purchase </a></li>
            </ul>

        </div>
        <!-- end side-menu -->

        <div class="side-content fr">

            <div class="content-module">

                <div class="content-module-heading cf">

                    <h3 class="fl">Update Purchase</h3>
                    <span class="fr expand-collapse-text">Click to collapse</span>
                    <span class="fr expand-collapse-text initial-expand">Click to expand</span>

                </div>
                <!-- end content-module-heading -->

                <div class="content-module-main cf">

                    <?php
                    if (isset($_POST['supplier']) and isset($_POST['stock_name'])) {
                        //$billnumber = mysqli_real_escape_string($db->connection, $_POST['bill_no']);
                        $autoid = mysqli_real_escape_string($db->connection, $_POST['id']);

                        $supplier = mysqli_real_escape_string($db->connection, $_POST['supplier']);

                        //$payment = mysqli_real_escape_string($db->connection, $_POST['payment']);
                        //$balance = mysqli_real_escape_string($db->connection, $_POST['balance']);
                        $address = mysqli_real_escape_string($db->connection, $_POST['address']);
                        $contact = mysqli_real_escape_string($db->connection, $_POST['contact']);
                        $count = $db->countOf("supplier_details", "supplier_name='$supplier'");
                        if ($count == 0) {
                            $db->query("insert into supplier_details(supplier_name,supplier_address,supplier_contact1) values('$supplier','$address','$contact')");
                        }
                        $temp_balance = $db->queryUniqueValue("SELECT balance FROM supplier_details WHERE supplier_name='$supplier'");
                        //$temp_balance = (int)$temp_balance + (int)$balance;
                        $db->execute("UPDATE supplier_details SET balance='$temp_balance' WHERE supplier_name='$supplier'");
                        //$selected_date = $_POST['due'];
                        //$selected_date = strtotime($selected_date);
                        //$mysqldate = date('Y-m-d H:i:s', $selected_date);
                        //$due = $mysqldate;
                        $mode = mysqli_real_escape_string($db->connection, $_POST['mode']);
                        $description = mysqli_real_escape_string($db->connection, $_POST['description']);

                        $namet = $_POST['stock_name'];
                        $quantityt = isset($_POST['quanitity']) ? $_POST['quanitity'] : '';
                        $bratet = $_POST['cost'];
                        $sratet = $_POST['sell'];
                        $totalt = $_POST['total'];

                        $subtotal = mysqli_real_escape_string($db->connection, $_POST['subtotal']);

                        $username = $_SESSION['username'];

                        $i = 0;
                        $j = 1;


                        $selected_date = $_POST['date'];
                        $selected_date = strtotime($selected_date);
                        $mysqldate = date('Y-m-d H:i:s', $selected_date);

                        foreach ($namet as $name1) {

                            $quantity = $_POST['quantity'][$i];
                            $brate = $_POST['cost'][$i];
                            $srate = $_POST['sell'][$i];
                            $total = $_POST['total'][$i];
                            $sysid = $_POST['gu_id'][$i];


                            $count = $db->countOf("stock_avail", "name='$name1'");

                            $amount = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name1'");
                            $oldquantity = $db->queryUniqueValue("SELECT quantity FROM stock_entries WHERE id='$sysid' ");
                            $amount1 = ($amount + $quantity) - $oldquantity;


                            $db->execute("UPDATE stock_avail SET quantity='$amount1' WHERE name='$name1'");
                            $db->query("UPDATE stock_entries SET stock_name='$name1', stock_supplier_name='$supplier', quantity='$quantity', company_price='$brate', selling_price='$srate', opening_stock='$amount', closing_stock='$amount1', date='$mysqldate', username='$username', type='entry', total='$total', mode='$mode', description='$description', subtotal='$subtotal' WHERE id='$sysid'");
                            //INSERT INTO `stock`.`stock_entries` (`id`, `stock_id`, `stock_name`, `stock_supplier_name`, `category`, `quantity`, `company_price`, `selling_price`, `opening_stock`, `closing_stock`, `date`, `username`, `type`, `salesid`, `total`, `payment`, `balance`, `mode`, `description`, `due`, `subtotal`, `count1`)
                            //VALUES (NULL, '$autoid1', '$name1', '$supplier', '', '$quantity', '$brate', '$srate', '$amount', '$amount1', '$mysqldate', 'sdd', 'entry', 'Sa45', '432.90', '2342.90', '24.34', 'cash', 'sdflj', '2010-03-25 12:32:02', '45645', '1');


                            $i++;
                            $j++;
                        }
                        echo "<br><font color=green size=+1 >Parchase order Updated successfully Ref: [" . $_POST['purchaseid'] . "] !</font>";


                    }
                    ?>
                    <?php
                    if (isset($_GET['sid']))
                        $id = $_GET['sid'];
                    $line = $db->queryUniqueObject("SELECT * FROM stock_entries WHERE id='$id'");
                    ?>
                    <form name="form1" method="post" id="form1" action="">
                        <input type="hidden" id="posnic_total">
                        <input type="hidden" name="id" value="<?php echo $id ?>">

                        <table class="form" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <?php
                                $str = $db->maxOfAll("stock_id", "stock_entries"); 
                                $array = explode(' ', $str);                           
                                $autoid = ++$array[0];
                                  ?>
                                <td>Purchase ID:</td>
                                <td><input name="purchaseid" type="text" id="purchaseid" readonly="readonly" maxlength="200"
                                           class="round default-width-input" style="width:130px "
                                           value="<?php echo $line->stock_id; ?>"/></td>

                                <td>Date:</td>
                                <td><input name="date" id="test1" placeholder="" style="margin-left: 15px;" value="<?php echo $line->date; ?> "
                                           type="text" id="name" maxlength="200" class="round default-width-input"/>
                                </td>
                               

                            </tr>
                            <tr>
                                <td><span class="man">*</span>Supplier:</td>
                                <td><input name="supplier" placeholder="ENTER SUPPLIER" type="text" id="supplier"
                                           value="<?php echo $line->stock_supplier_name; ?> " maxlength="200"
                                           class="round default-width-input" style="width:130px "/></td>

                                <td>Address:</td>
                                <td><input name="address" placeholder="ENTER ADDRESS" type="text"
                                           value="<?php $quantity = $db->queryUniqueValue("SELECT supplier_address FROM supplier_details WHERE supplier_name='" . $line->stock_supplier_name . "'");
                                           echo $quantity; ?>" id="address" maxlength="200"
                                           class="round default-width-input"/></td>

                                <td>contact:</td>
                                <td><input name="contact" placeholder="ENTER CONTACT" type="text"
                                           value="<?php $quantity = $db->queryUniqueValue("SELECT supplier_contact1 FROM supplier_details WHERE supplier_name='" . $line->stock_supplier_name . "'");
                                           echo $quantity; ?>" id="contact1" maxlength="200"
                                           class="round default-width-input" onkeypress="return numbersonly(event)"
                                           style="width:120px "/></td>

                            </tr>
                        </table>
                        <input type="hidden" id="guid">
                        <input type="hidden" id="edit_guid">
                        <table id="hideen_display">
                            <tr>
                                <td style="width: 174px">Item</td>
                                
                                <td style="width: 20px">Quantity</td>
                                <td style="width: 87px">Cost</td>
                                <td style="width: 87px">Selling</td>
                                <td style="width: 97px">Available Stock</td>
                                <td style="width: 160x float: Left;">Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								
                               
                            </tr>
                        </table>
                        <table class="form" id="display" style="display:none">
                            <tr>

                                <td><input name="" type="text" id="item" maxlength="200" class="round my_with "
                                           style="width: 238px"
                                           value="<?php echo isset($supplier) ? $supplier : ''; ?>"/></td>

                                <td><input name="" type="text" id="quty" maxlength="200" class="round  my_with" style="width: 75px"
                                           onKeyPress="quantity_chnage(event);return numbersonly(event)"
                                           onkeyup="total_amount();unique_check()"
                                           value="<?php echo isset($category) ? $category : ''; ?>"/></td>

                                <td><input name="" type="text" id="cost" readonly="readonly" maxlength="200" style="width: 133px" 
                                           class="round my_with"
                                           value="<?php echo isset($category) ? $category : ''; ?>"/></td>


                                <td><input name="" type="text" id="sell" readonly="readonly" maxlength="200" style="width: 130px" 
                                           class="round  my_with"
                                           value="<?php echo isset($category) ? $category : ''; ?>"/></td>

 
                                <td><input name="" type="text" id="stock" readonly="readonly" maxlength="200" style="width: 143px"
                                           class="round  my_with"
                                           value="<?php echo isset($category) ? $category : ''; ?>"/></td>
                                <td><input name="" type="text" id="total" maxlength="200"
                                           class="round default-width-input " style="width:45px;"
                                           value="<?php echo isset($category) ? $category : ''; ?>"/></td>
                                <td><input type="button" onclick="add_values()" onkeyup=" balance_amount();"
                                           id="add_new_code"
                                           style="width:30px;border:none;height:30px;background:url(images/save.png)"
                                           class="round">
                                </td>
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
                                $sid = $line->stock_id;
                                $max = $db->maxOf("count1", "stock_entries", "stock_id='$sid'");

                                for ($i = 1; $i <= $max; $i++) {
                                    $line1 = $db->queryUniqueObject("SELECT * FROM stock_entries WHERE stock_id='$sid' and count1=$i");

                                    $item = $db->queryUniqueValue("SELECT stock_id FROM stock_details WHERE stock_name='" . $line1->stock_name . "'");
                                    ?>

                                    <tr>

                                        <td><input name="stock_name[]" type="text" id="<?php echo $item . "st" ?>"
                                                   maxlength="30" style="width: 238px" readonly="readonly"
                                                   class="round "
                                                   value="<?php echo $line1->stock_name; ?>"/></td>

                                        <td><input name="quantity[]" type="text" id="<?php echo $item . "q" ?>"
                                                   maxlength="20" style="width: 75px" class="round my_with"
                                                   value="<?php echo $line1->quantity; ?>" readonly="readonly"
                                                   onkeypress="return numbersonly(event)"/></td>


                                        <td><input name="cost[]" type="text" id="<?php echo $item . "c" ?>"
                                                   maxlength="20" style="width: 133px" class="round my_with"
                                                   value="<?php echo $line1->company_price; ?>" readonly="readonly"
                                                   onkeypress="return numbersonly(event)"/></td>


                                        <td><input name="sell[]" style="width: 130px" type="text" id="<?php echo $item . "s" ?>"
                                                   maxlength="20" readonly="readonly" class="round my_with"
                                                   value="<?php echo $line1->selling_price; ?>"
                                                   onkeypress="return numbersonly(event)"/></td>
                                        <td><input name="stock[]"  style="width: 143px" type="text" id="<?php echo $item . "p" ?>"
                                                   readonly="readonly" maxlength="200" class="round  my_with"
                                                   value="<?php $quantity = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='" . $line1->stock_name . "'");
                                                   echo $quantity; ?>"/></td>
<td>
                                        <input name="total[]" type="text" id="<?php echo $item . "to" ?>"
                                                   readonly="readonly" maxlength="20"
                                                   style="width: 45px" class="round "
                                                   value="<?php echo $line1->total; ?>"/></td>
                                        <input type="hidden" id="<?php echo $item . "my_tot" ?>" maxlength="20"
                                                   style="margin-left:20px;width: 120px" class="round "
                                                   value="<?php echo $line1->total; ?>"/>
                                        <input type="hidden" id="<?php echo $item; ?>"><input type="hidden"
                                                                                                  name="gu_id[]"
                                                                                                  value="<?php echo $line1->id ?>">
                                        
                                        <td><input type=button value="" id="<?php echo $item; ?>"
                                                   style="float: right;width:30px;border:none;height:30px;background:url(images/edit_new.png)"
                                                   class="round" onclick="edit_stock_details(this.id)"></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div> 
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
                                <td>Grand Total:<input type="hidden" readonly="readonly" id="grand_total"
                                                       value="<?php echo $line->subtotal; ?>" name="subtotal">
                                    <input type="text" id="main_grand_total" class="round default-width-input"
                                           value="<?php echo $line->subtotal; ?>" style="text-align:right;width: 120px">
                                </td>
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