<?php
session_start();
unset($_SESSION["check"]);
unset($_SESSION["sessionUserName"]);
session_destroy();
header("Location:index.php");
?>