<?php
include 'connect.php';
session_start();

if(!isset($_SESSION['check']))
{
    header('location: index.php');
}
$username = $_SESSION['sessionUserName'];
echo 'Welcome ' .$username;

$re = mysqli_query($conn, "SELECT branchID FROM employee WHERE username = '$username';");
$rowID = mysqli_fetch_array($re, MYSQLI_ASSOC);

$branchID = $rowID['branchID'];

$submissionQuery = mysqli_query($conn, "SELECT * FROM submission where status = 'in_destination_branch' and clerkID in (select userID from employee where branchID = '$branchID');");


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
            background-color: darkseagreen;
            padding: 2%;
            padding-left: 10%;
            padding-right: 10%;
            text-align: center;
        }

        .jumbotron {
            background-color: white;
        }
        .button {
  display: inline-block;
  background: #C5C5C5;
  color: rgb(0, 0, 0);
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
        .internal {
            background-color: darkseagreen;-webkit-transition: all ease-in-out 300ms;
            transition: all ease-in-out 300ms;
        }

        .internal:hover {
            box-shadow: 0px 37px 20px -20px rgba(0, 0, 0, 0.2);
            -webkit-transform: translate(0px, -10px) scale(1.2);
                  transform: translate(0px, -10px) scale(1.2);
        }

        .baslik {
            text-align: center;
            color: black;
            padding-bottom: 2%;
        }

        .left, .mid {
            float: left;
            width: 40%;
            text-align: left;
        }

        .right {
            float: left;
            width: 20%;
        }




    </style>
</head>
<body>
    <h1 class="baslik">Choose Order</h1>
    <div class="jumbotron">
    <form method="POST">
      <?php
          while ($row = mysqli_fetch_array($submissionQuery))
          {


echo '<div class="jumbotron internal">';
echo '  <div class="row">';
echo ' <div class="mid">';
echo '<strong>Submission ID:'. $row['submissionID'] .' </strong>';
echo ' <br>';

echo '</div>';
echo '<div class="right">';
echo ' <input type="submit" class="button" name="buy_btn" value="select">';
echo ' <input type=hidden name="rowid" value='. $row['submissionID'].'>';
echo '  </div>';
  echo ' </div>';
echo '</div>';
              }
              if (isset($_POST['buy_btn'])) {
                            $_SESSION['submissionForDeliveryCourier']  = $_POST['rowid'];
                            header('Location: AssignCourierForDelivery.php');
                        }
          ?>
    </div>
  </form>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
