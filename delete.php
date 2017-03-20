<?php
include_once "init.php";
// Use session variable on this page. This function must put on the top of page.
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') { // if session variable "username" does not exist.
    header("location: index.php?msg=Please%20login%20to%20access%20admin%20area%20!"); // Re-direct to index.php
} else {

    
    if (isset($_GET['id']) && isset($_GET['table'])) {
        $id = $_GET['id'];
        $tablename = $_GET['table'];
        $return = $_GET['return'];

        if ($tablename == "stock_entries") {
            $difference = $db->queryUniqueValue("SELECT quantity FROM stock_entries WHERE id='$id'");

            $name = $db->queryUniqueValue("SELECT stock_name FROM stock_entries WHERE id='$id'");
            $result = $db->query("SELECT * FROM stock_entries where id > '$id'");
            while ($line2 = $db->fetchNextObject($result)) {
                $osd = $line2->opening_stock - $difference;
                $csd = $line2->closing_stock - $difference;
                $cid = $line2->id;
                $db->execute("UPDATE stock_entries SET opening_stock='" . $osd . "',closing_stock='" . $csd . "' WHERE id='$cid'");

            }
            $total = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name'");
            $total = $total - $difference;
            $db->execute("UPDATE stock_avail SET quantity='$total' WHERE name='$name'");
        }
        if ($tablename == "stock_sales") {
            $difference = $db->queryUniqueValue("SELECT quantity FROM stock_sales WHERE id='$id'");
            $sid = $db->queryUniqueValue("SELECT transactionid FROM stock_sales WHERE id='$id'");
            $id = $db->queryUniqueValue("SELECT id FROM stock_entries WHERE salesid='$sid'");
            $name = $db->queryUniqueValue("SELECT stock_name FROM stock_entries WHERE id='$id'");
            $result = $db->query("SELECT * FROM stock_entries where id > '$id'");
            while ($line2 = $db->fetchNextObject($result)) {
                $osd = $line2->opening_stock + $difference;
                $csd = $line2->closing_stock + $difference;
                $cid = $line2->id;
                $db->execute("UPDATE stock_entries SET opening_stock='" . $osd . "',closing_stock='" . $csd . "' WHERE id='$cid'");

            }
            echo "sale $name";
            $total = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name'");
            $total = $total + $difference;
            $db->execute("UPDATE stock_avail SET quantity='$total' WHERE name='$name'");
            $db->execute("DELETE FROM $tablename WHERE id='$id'");
        }
        $id = $_GET['id'];

        $db->execute("DELETE FROM $tablename WHERE id='$id'");

        header("location: $return?msg=Record Deleted Successfully!&id=$id");
    }
    if (isset($_POST['table']) && isset($_POST['checklist'])) {
        $data = $_REQUEST['checklist'];
        $tablename = $_POST['table'];
        $return = $_REQUEST['return'];
        for ($i = 0; $i < count($data); $i++) {
            $db->execute("DELETE FROM $tablename WHERE id='$data[$i]'");
        }
        header("location: $return?msg=Record Deleted Successfully!");
    }
    if (isset($_POST['return'])) {
        header("location: $return");
    }
}
?>