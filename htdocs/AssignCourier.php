<?php
include 'connect.php';
session_start();

if(!isset($_SESSION['check']))
{
    header('location: index.php');
}
$submissionID = $_SESSION['submissionForCourier'];
if (isset($_POST['buy_btn'])) {
    $courierID = $_POST['rowid'];
    $query = mysqli_query($conn, "UPDATE pickupassignment set status = 'finished', courierID = '$courierID' WHERE  submissionID = '$submissionID';");

    $query = mysqli_query($conn, "UPDATE submission set status = 'waiting_to_be_accepted' WHERE  submissionID = '$submissionID';");

    header('location: EmpMenu.php');
}
$username = $_SESSION['sessionUserName'];
echo 'Welcome ' .$username;

$ri = mysqli_query($conn, "SELECT branchID FROM employee WHERE username = '$username';");
$rowID = mysqli_fetch_array($ri, MYSQLI_ASSOC);

$branchID = $rowID['branchID'];

$re = mysqli_query($conn, "SELECT x.userID, x.username FROM (SELECT * FROM employee natural join courier) as x WHERE  branchID = '$branchID';");

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
            padding-left: 5%;
            padding-right: 5%;
            text-align: center;
        }

        .jumbotron {
            background-color: white;
        }

        .internal {
            background-color: darkseagreen;
            padding: 4%;
            padding-bottom: 0%;
        }

        .node {
            float: left;
            width: 46%;
            text-align: left;
            margin-left: 2%;
            margin-right: 2%;
            -webkit-transition: all ease-in-out 300ms;
            transition: all ease-in-out 300ms;
        }

        .node:hover {
            box-shadow: 0px 37px 20px -20px rgba(0, 0, 0, 0.2);
            -webkit-transform: translate(0px, -10px) scale(1.2);
            transform: translate(0px, -10px) scale(1.2);
        }

        .row {
            padding-left: 2%;
            padding-right: 2%;
        }

        .space {
            width: 4%;
        }

        .baslik {
            text-align: center;
            color: black;
            padding-bottom: 2%;
        }

        .left, .right {
            float: left;
            width: 20%;
            text-align: left;
            vertical-align: bottom;
        }

        .mid {
            width: 60%;
            text-align: center;
            vertical-align: middle;
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

    </style>
</head>
<body>
    <h1 class="baslik">Assign Courier</h1>
    <div class="jumbotron">
    <div class="row">
        <?php
        while ($row = mysqli_fetch_array($re)) {

            echo '<div class="jumbotron internal node">';
                echo '<div class="jumbotron internal">';
                    echo '<div class="row">';
                        echo '<div class="left">';
                            echo '<img src="courier.jpg" alt="Avatar" style="float: left; margin-right: 15px;">';
                        echo '</div>';
                        echo '<div class="mid">';
                            echo "<strong>". $row['username'] . "<!--buraya Recipient Name gelecek--></strong>";
                        echo '</div>';
                        echo '<div class="right">';
                        echo "<td>" . '<form method="POST"><input type=hidden name="rowid" value='. $row['userID'].'>
                            <input type="submit" class="button" name="buy_btn" value="Select"></form>' . "</td>";
                        echo '</div>';
                    echo '</div>';
                 echo  '</div>';
            echo '</div>';

        }
          ?>
      </div>;
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
