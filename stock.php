<?php
include_once("init.php");
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT * FROM stock_avail where quantity >0 ");
while ($line = $db->fetchNextObject()) {

    if (strpos(strtolower($line->name), $q) !== false) {
        echo "$line->name\n";

    }
}

?>