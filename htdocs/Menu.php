<?php
include 'connect.php';
session_start();

if(!isset($_SESSION['check']))
{
    header('location: index.php');
}
$username = $_SESSION['sessionUserName'];
echo 'Welcommeee ' .$username;

if(!empty($_POST["sendCardoButton"]))
{
  $_SESSION["packageNumber"] = $_POST["cargoNumberInput"];
if($_POST["cargoNumberInput"] <= 0)
{
            echo '<script language="javascript">';
            echo 'alert("Please enter a correct number!")';
            echo '</script>';

}
else{
 header('location: SelectRecipient.php');
}
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
        .body {
            background-color: #C5C5C5;
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
    <h1 class="baslik">MENU</h1>
    <div class="jumbotron">
        <a href="UserProfile.php"><button type="button" name="viewProfileButton" class="btn btn-outline-dark btn-lg btn-block ">View Profile</button></a>

        <br>
<br>
      <form method="POST">
        <div class="input-group mb-3">

            <div class="input-group-prepend">
              <input type="submit" class="button2 rounded btn-outline-secondary" name="sendCardoButton" value="Create Submission" id="button-addon1"></button>
            </div>

            <input type="number" name="cargoNumberInput" class="form-control" placeholder="Enter number of packages" aria-label="Example text with button addon" aria-describedby="button-addon1" required>
          </div>
          </form>

<br>
        <a href="MyDeliveries.php"><button type="button" name="myDeliveriesButton"class="btn btn-outline-dark btn-lg btn-block ">My Deliveries</button></a>
    </div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
