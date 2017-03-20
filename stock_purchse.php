<?php
include_once("init.php");
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT * FROM stock_details ");
while ($line = $db->fetchNextObject()) {

    if (strpos(strtolower($line->stock_name), $q) !== false) {
        echo "$line->stock_name\n";

    }
}

?>