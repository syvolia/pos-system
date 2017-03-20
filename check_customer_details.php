<?php
include_once("init.php");

$line = $db->queryUniqueObject("SELECT * FROM customer_details  WHERE customer_name='" . $_POST['stock_name1'] . "'");
$address = $line->customer_address;
$contact1 = $line->customer_contact1;
$contact2 = $line->customer_contact2;

if ($line != NULL) {

    $arr = array("address" => "$address", "contact1" => "$contact1", "contact2" => "$contact2");
    echo json_encode($arr);

} else {
    $arr1 = array("no" => "no");
    echo json_encode($arr1);

}
?>