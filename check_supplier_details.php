<?php
include_once("init.php");

$line = $db->queryUniqueObject("SELECT * FROM supplier_details  WHERE supplier_name='" . $_POST['stock_name1'] . "'");
$address = $line->supplier_address;
$contact1 = $line->supplier_contact1;
$contact2 = $line->supplier_contact2;

if ($line != NULL) {

    $arr = array("address" => "$address", "contact1" => "$contact1", "contact2" => "$contact2");
    echo json_encode($arr);

} else {
    $arr1 = array("no" => "no");
    echo json_encode($arr1);

}
?>