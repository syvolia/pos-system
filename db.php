<?php

include("db.class.php");

// Open the base (construct the object):
$base = "stock";
$server = "localhost";
$user = "root";
$pass = "";
$db = new DB($base, $server, $user, $pass);
/*


$base="arstock";
$server="arstock.db.5298872.hostedresource.com";
$user="arstock";
$pass="Reset123";
$db = new DB($base, $server, $user, $pass);
*/
?>