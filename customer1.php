<?php
include_once("init.php");
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT * FROM customer_details");
while ($line = $db->fetchNextObject()) {

    if (strpos(strtolower($line->customer_name), $q) !== false) {
        echo "$line->customer_name \n";

    }
}

?>