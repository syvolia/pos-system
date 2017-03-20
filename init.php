<?php
session_start(); // Use session variable on this page. This function must put on the top of page.
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') { // if session variable "username" does not exist.
    header("location: index.php?msg=Please%20login%20to%20access%20admin%20area%20!&type=error"); // Re-direct to index.php
}

include("lib/db.class.php");
if (!include_once "config.php") {
    header("location: install_step1.php");
}

// Open the base (construct the object):
$db = new DB($config['database'], $config['host'], $config['username'], $config['password']);

# Note that filters and validators are separate rule sets and method calls. There is a good reason for this.

require "lib/gump.class.php";

$gump = new GUMP();


// Messages Settings
$POSNIC = array();
$POSNIC['username'] = $_SESSION['username'];
$POSNIC['usertype'] = $_SESSION['usertype'];
$POSNIC['msg'] = '';
if (isset($_REQUEST['msg']) && isset($_REQUEST['type'])) {

    if ($_REQUEST['type'] == "error")
        $POSNIC['msg'] = "<div class='error-box round'>" . $_REQUEST['msg'] . "</div>";
    else if ($_REQUEST['type'] == "warning")
        $POSNIC['msg'] = "<div class='warning-box round'>" . $_REQUEST['msg'] . "</div>";
    else if ($_REQUEST['type'] == "confirmation")
        $POSNIC['msg'] = "<div class='confirmation-box round'>" . $_REQUEST['msg'] . "</div>";
    else if ($_REQUEST['type'] == "infomation")
        $POSNIC['msg'] = "<div class='information-box round'>" . $_REQUEST['msg'] . "</div>";
}
?>