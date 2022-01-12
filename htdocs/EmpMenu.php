<?php
include 'connect.php';
session_start();

if(!isset($_SESSION['check']))
{
    header('location: index.php');
}
$username = $_SESSION['sessionUserName'];
echo 'Welcommeee ' .$username;

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .body {
            background-color: darkseagreen;
            padding: 2%;
            padding-left: 5%;
            padding-right: 5%;
        }

        .jumbotron {
            background-color: white;
        }

        .baslik {
            text-align: center;
            color: black;
            padding-bottom: 2%;
        }
        .button2{
            color: black;
            padding: 10px 250px;
            background-color: #C5C5C5;

        }
        .button3{
            color: black;
            padding: 10px 20px;
            background-color: ##E2DED0;
            float:right

        }


    </style>
</head>
<body class="body">
  <button class="button3"><a href="logout.php" onclick="return confirm('Are you sure?')">Logout</a></button>
    <h1 class="baslik">&emsp;&emsp;&nbsp   MENU</h1>
    <div class="jumbotron">
        <a href="selectSubmissionEmp.php"><button type="button" name="viewProfileButton" class="btn btn-outline-dark btn-lg btn-block ">Assign Courier For Pick-up</button></a>
	<br>
	<a href="AcceptSubmission.php"><button type="button" name="viewProfileButton" class="btn btn-outline-dark btn-lg btn-block ">Accept Submission</button></a>
	<br>
	<a href="Transfer.php"><button type="button" name="viewProfileButton" class="btn btn-outline-dark btn-lg btn-block ">Transfer A Submission</button></a>
	<br>
	<a href="AcceptSubmissionFromTransfer.php"><button type="button" name="viewProfileButton" class="btn btn-outline-dark btn-lg btn-block ">Accept Submission From Transfer</button></a>
	<br>
  <a href="AssignCourierForDeliverySubmission.php"><button type="button" name="myDeliveriesButton"class="btn btn-outline-dark btn-lg btn-block ">Assign Courier For Delivery</button></a>
  <br>
  <a href="ManageReports.php"><button type="button" name="myDeliveriesButton"class="btn btn-outline-dark btn-lg btn-block ">Report Management</button></a>
  <br>
  <a href="SeeEvaluations.php"><button type="button" name="myDeliveriesButton"class="btn btn-outline-dark btn-lg btn-block ">See Evaluations</button></a>
    </div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
