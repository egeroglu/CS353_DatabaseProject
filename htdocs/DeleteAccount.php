<?php
include 'connect.php';
session_start();

if(!isset($_SESSION['check']))
{
    header('location: index.php');
}
$username = $_SESSION['sessionUserName'];

$rez = mysqli_query($conn, "DELETE FROM users WHERE username = '$username';");

unset($_SESSION["check"]);
unset($_SESSION["sessionUserName"]);
session_destroy();
header("Location:index.php");
?>
