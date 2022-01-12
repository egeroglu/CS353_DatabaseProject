<?php
include 'connect.php';
session_start();

if(!isset($_SESSION['check']))
{
    header('location: index.php');
}
$username = $_SESSION['sessionUserName'];
echo 'Welcommeee ' .$username;
$userQuery = mysqli_query($conn, "SELECT userID FROM customer where username = '$username';");
$userQueryResult = mysqli_fetch_array($userQuery, MYSQLI_ASSOC);
$userID = $userQueryResult['userID'];
if(!empty($_POST['submitReport']))
{

  $clerkScore = $_POST['clerk'];
  $deliveryScore = $_POST['delivery'];
  $courierScore = $_POST['courier'];
  $submissionID = $_SESSION['submissionID'];
  $clerkIDQuery = mysqli_query($conn, "SELECT clerkID,courierID FROM deliveryassignment where submissionID = '$submissionID';");
  $clerkIDQueryResult = mysqli_fetch_array($clerkIDQuery, MYSQLI_ASSOC);
  $clerkID = $clerkIDQueryResult['clerkID'];
  $courierID = $clerkIDQueryResult['courierID'];

  $overallScore = (int)($clerkScore+$deliveryScore+$courierScore);

  if(!$conn->query("INSERT INTO evaluates(customerID, submissionID, clerkID, courierID, score) VALUES('$userID', '$submissionID','$clerkID','$courierID','$overallScore'); "))
  {
    echo $conn->error;
  }
    header('location: MyDeliveries.php');
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
    <style>
        body {
            background-color: #C5C5C5;
            padding: 2%;
            padding-left: 5%;
            padding-right: 5%;
            text-align: center;
        }

        .jumbotron {
            background-color: white;
        }

        .baslik {
            text-align: center;
            color: black;
            padding-bottom: 2%;
        }

        .middle {
            align-items: center;
        }

        .button {
            display: inline-block;
            background: darkseagreen;
            color: black;
            text-transform: uppercase;
            padding: 15px 25px;
            border-radius: 5px;
            box-shadow: 0px 17px 10px -10px rgba(0, 0, 0, 0.4);
            cursor: pointer;
            -webkit-transition: all ease-in-out 300ms;
            transition: all ease-in-out 300ms;
        }

        .button:hover {
            box-shadow: 0px 37px 20px -20px rgba(0, 0, 0, 0.2);
            -webkit-transform: translate(0px, -10px) scale(1.2);
                  transform: translate(0px, -10px) scale(1.2);
        }

        .box select {
            background-color: #3a3a3a;
            color: white;
            padding: 12px;
            width: 250px;
            border: none;
            font-size: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
            -webkit-appearance: button;
            appearance: button;
            outline: none;
        }

        .input-group-text {
            border-bottom-right-radius: 0rem;
            border-top-right-radius: 0rem;
        }

        .info-header {
            text-align: left;
        }

        .radio{
            display: inline-flex;
        }

        .radio_input {
            display: none;
        }

        .radio_label {
            background: darkseagreen;
            color: black;
            cursor: pointer;
        }

        .radio_input:checked + .radio_label {
            background: black;
            color: white;
        }


    </style>
</head>
<body>
    <h1 class="baslik">Evaluate</h1>
    <div class="jumbotron">
      <form method="POST">
        <div class="radio">
            <strong>Evaluate clerk</strong>
            <input class="button radio_input" type="radio" name="clerk" id=1_1 value="1">
            <label class="button radio_label" for="1_1">1</label>
            <input class="button radio_input" type="radio" name="clerk" id=1_2 value="2">
            <label class="button radio_label" for="1_2">2</label>
            <input class="button radio_input" type="radio" name="clerk" id=1_3 value="3">
            <label class="button radio_label" for="1_3">3</label>
            <input class="button radio_input" type="radio" name="clerk" id=1_4 value="4">
            <label class="button radio_label" for="1_4">4</label>
            <input class="button radio_input" type="radio" name="clerk" id=1_5 value="5">
            <label class="button radio_label" for="1_5">5</label>
            <input class="button radio_input" type="radio" name="clerk" id=1_6 value="6">
            <label class="button radio_label" for="1_6">6</label>
            <input class="button radio_input" type="radio" name="clerk" id=1_7 value="7">
            <label class="button radio_label" for="1_7">7</label>
            <input class="button radio_input" type="radio" name="clerk" id=1_8 value="8">
            <label class="button radio_label" for="1_8">8</label>
            <input class="button radio_input" type="radio" name="clerk" id=1_9 value="9">
            <label class="button radio_label" for="1_9">9</label>
            <input class="button radio_input" type="radio" name="clerk" id=1_10 value="10">
            <label class="button radio_label" for="1_10">10</label>
        </div>
        <br><br>
        <div class="radio">
            <strong>Evaluate delivery</strong>
            <input class="button radio_input" type="radio" name="delivery" id="2_1" value="1">
            <label class="button radio_label" for="2_1">1</label>
            <input class="button radio_input" type="radio" name="delivery" id="2_2" value="2">
            <label class="button radio_label" for="2_2">2</label>
            <input class="button radio_input" type="radio" name="delivery" id="2_3" value="3">
            <label class="button radio_label" for="2_3">3</label>
            <input class="button radio_input" type="radio" name="delivery" id="2_4" value="4">
            <label class="button radio_label" for="2_4">4</label>
            <input class="button radio_input" type="radio" name="delivery" id="2_5" value="5">
            <label class="button radio_label" for="2_5">5</label>
            <input class="button radio_input" type="radio" name="delivery" id="2_6" value="6">
            <label class="button radio_label" for="2_6">6</label>
            <input class="button radio_input" type="radio" name="delivery" id="2_7" value="7">
            <label class="button radio_label" for="2_7">7</label>
            <input class="button radio_input" type="radio" name="delivery" id="2_8" value="8">
            <label class="button radio_label" for="2_8">8</label>
            <input class="button radio_input" type="radio" name="delivery" id="2_9" value="9">
            <label class="button radio_label" for="2_9">9</label>
            <input class="button radio_input" type="radio" name="delivery" id="2_10" value="10">
            <label class="button radio_label" for="2_10">10</label>
        </div>
        <br><br>
        <div class="radio">
            <strong>Evaluate courier</strong>
            <input class="button radio_input" type="radio" name="courier" id="3_1" value="1">
            <label class="button radio_label" for="3_1">1</label>
            <input class="button radio_input" type="radio" name="courier" id="3_2" value="2">
            <label class="button radio_label" for="3_2">2</label>
            <input class="button radio_input" type="radio" name="courier" id="3_3" value="3">
            <label class="button radio_label" for="3_3">3</label>
            <input class="button radio_input" type="radio" name="courier" id="3_4" value="4">
            <label class="button radio_label" for="3_4">4</label>
            <input class="button radio_input" type="radio" name="courier" id="3_5" value="5">
            <label class="button radio_label" for="3_5">5</label>
            <input class="button radio_input" type="radio" name="courier" id="3_6" value="6">
            <label class="button radio_label" for="3_6">6</label>
            <input class="button radio_input" type="radio" name="courier" id="3_7" value="7">
            <label class="button radio_label" for="3_7">7</label>
            <input class="button radio_input" type="radio" name="courier" id="3_8" value="8">
            <label class="button radio_label" for="3_8">8</label>
            <input class="button radio_input" type="radio" name="courier" id="3_9" value="9">
            <label class="button radio_label" for="3_9">9</label>
            <input class="button radio_input" type="radio" name="courier" id="3_10"value="10">
            <label class="button radio_label" for="3_10">10</label>
        </div>
        <br><br>

        <input type="submit" class="button" name="submitReport" value="Evaluate"></button>
</form>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
