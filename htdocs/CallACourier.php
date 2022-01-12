<?php
include 'connect.php';
session_start();

if(!isset($_SESSION['check']))
{
    header('location: index.php');
}
$username = $_SESSION['sessionUserName'];
$recipientName = $_SESSION["recipientname"];
echo 'Welcome ' .$username;
$userQuery = mysqli_query($conn, "SELECT userID FROM customer where username = '$username';");
$userQueryResult = mysqli_fetch_array($userQuery, MYSQLI_ASSOC);
$userID = $userQueryResult['userID'];

$branchQuery = mysqli_query($conn, "SELECT * FROM branch;");

$noOFPackages =   $_SESSION['packageNumber'];

if(!empty($_POST['getEmployeesButton']))
{
  $submissionID = $_SESSION['submissionID'];
  //
  if(!$conn->query("UPDATE submission SET status = 'waiting_for_courier' where submissionID = '$submissionID';"))
  {
    echo $conn->error;
  }
  $branchID = $_POST['branchID'];
  if(!$conn->query("INSERT INTO pickupassignment(submissionID,branchID,courierID,status) VALUES('$submissionID', '$branchID','3','waiting_for_courier');"))
  {
    echo $conn->error;
  }
  unset($_SESSION['submissionID']);
  unset($_SESSION['recipientname']);
  unset($_SESSION['packageNumber']);
  header('location: Menu.php');
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
            text-align: center;
        }

        .jumbotron2 {
            background-color: #c5c5c5;
            padding-left: 5%;
            padding-right: 5%;
        }

        .baslik {
            text-align: center;
            color: black;
            padding-bottom: 2%;
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

    </style>
</head>
<body class="body">
  <form action="CallACourier.php" method="POST" id ="my-form">
    <h1 class="baslik">Call A courier</h1>
    <div class="jumbotron">
      <div class="box">
        <select name="branchID">
          <option value= "">-Branch name-</option>
          <?php
          while($v = mysqli_fetch_array($branchQuery))
          {
                echo "<option value=".$v['branchID'].">" .$v['name'] . "</option>";
          }
          ?>

        </select>
      </div>
      <br><br>
      <div class="box">
        <input type="submit" class="button" name="getEmployeesButton" value="Select Branch">
      </div>
    </form>

    </div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
function myFunction(){
    document.getElementById("my-form").submit();
}
</script>
</body>
</html>
