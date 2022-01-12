<?php
include 'connect.php';
session_start();

if(!isset($_SESSION['check']))
{
    header('location: index.php');
}
$username = $_SESSION['sessionUserName'];
$userQuery = mysqli_query($conn, "SELECT userID,username FROM customer where username = '$username';");
$userQueryResult = mysqli_fetch_array($userQuery, MYSQLI_ASSOC);
$userID = $userQueryResult['userID'];
$username = $userQueryResult['username'];
$submissionID = $_SESSION['submissionID'];

echo 'Welcommeee ' .$username;
if(!empty($_POST['submitReport']))
{
  $submissionID = $_SESSION['submissionID'];
  $text = $_POST['reportText'];
  $submissionQuery = mysqli_query($conn, "SELECT submissionID,status,clerkID FROM submission where submissionID = '$submissionID';");
  $submissionQueryResult = mysqli_fetch_array($submissionQuery, MYSQLI_ASSOC);
  $clerkID = $submissionQueryResult['clerkID'];
  $date = date("Y-m-d");
  if(!$conn->query("INSERT INTO report (submissionID, customerID, clerkID, text,date,status) VALUES ('$submissionID', '$userID', '$clerkID', '$text','$date', 'waiting') ;"))
  {
      echo $conn->error;
  }
  header('location:MyDeliveries.php');
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
            background: #C5C5C5;
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
    </style>
</head>
<body>
    <h1 class="baslik">File Your Report</h1>
    <div class="jumbotron">
        <div class="info-header">
            <strong>Order ID: <?php echo $_SESSION['submissionID'];?> </strong>
            <!--buraya Order ID gelecek-->
            <br>
            <strong>Recipient Name: <?php echo $username;?> </strong>
            <!--buraya Recipient Name gelecek-->
        </div>
        <form method="POST">
        <br>
        <div class="input-group">
            <textarea class="form-control" aria-label="With textarea" name="reportText" placeholder="How was the delivery process? Can you tell us the positive or negative aspects of the courier work?" required></textarea>
        </div>

        <br><br>
        <input type="submit" class="button" name="submitReport" value="Submit"></button>

          </form>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
