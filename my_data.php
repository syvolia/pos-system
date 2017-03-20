<?php
$data = $_REQUEST['stock_name'];
for ($i = 0; $i < count($data); $i++) {
    echo $data[$i];
}
?>
