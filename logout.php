<?php
session_start();
session_destroy();
unset($_SESSION["id"]);
unset($_SESSION["username"]);
unset($_SESSION["usertype"]);
header("location: index.php?msg=You%20have%20been%20logged%20out!&type=information");
?>