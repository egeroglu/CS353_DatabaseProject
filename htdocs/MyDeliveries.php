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
$submissionQuery = mysqli_query($conn, "SELECT submissionID,status FROM submission where senderID = '$userID';");
$recipientQuery = mysqli_query($conn, "SELECT submissionID,status FROM submission where recipientID = '$userID';");

if(!empty($_POST['dateBTN']))
{
  $startDate = $_POST['startDate'];
  $endDate = $_POST['endDate'];
  $submissionQuery = mysqli_query($conn, "SELECT submissionID,status FROM submission natural join pays natural join transaction where senderID = '$userID' AND datee BETWEEN '$startDate' AND '$endDate';");
  $recipientQuery = mysqli_query($conn, "SELECT submissionID,status FROM submission natural join pays natural join transaction where recipientID = '$userID' AND datee BETWEEN '$startDate' AND '$endDate';");
}


if(!empty($_POST['reportBtn']))
{
  $_SESSION['submissionID'] = $_POST['subToBeReport'];
  header('location: FileReport.php');
}
if(!empty($_POST['evaluateBtn']))
{
  $_SESSION['submissionID'] = $_POST['subToBeReport'];
  header('location: Evaluate.php');
}
if(!empty($_POST['finBtn']))
{
  $submissionID = $_POST['subToBeReport'];
  if(!$conn->query("UPDATE submission SET status = 'finalized' where submissionID = '$submissionID';"))
  {
    echo $conn->error;
  }
  header('location: MyDeliveries.php');
}
?>
<html lang="en">
<head>
    <?php echo "<div align='left'><a href='Menu.php' class='button2'>Go Back to Main Menu</a></div>"; ?>
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
            text-align: center;
        }
        .jumbotron {
            background-color: rgb(214, 16, 16);
            text-align: center;

        }
        .btn-circle.btn-xl {
            width: 30px;
             height: 30px;
             padding: 6px 0px;
             border-radius: 15px;
             text-align: center;
             font-size: 12px;
             line-height: 1.42857;
        }
        .tbody1{
            background-color:rgb(62, 116, 62) ;
        }
        .tbody2{
            background-color:rgb(73, 76, 240) ;
        }
        .button2 {
            display: inline-block;
            background: white;
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
    </style>

</head>
<body class="body">
    <h1 class="baslik">My Deliveries</h1><br>
    <label for="birthday">Start Date:</label>
    <form method="POST">
<input type="date" id="birthday" name="startDate">
<label for="birthday">End Date:</label>
<input type="date" id="birthday" name="endDate">
<input type="submit" name= "dateBTN" value="Search">
</form>
    <div class="container">
        <div class="row">
          <div class="col">
            <h4 class="baslik">Sentbox</h4><br>
            <table class="table ">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody class="tbody1">
                  <?php while($v = mysqli_fetch_array($submissionQuery))
                  {
                echo '<tr>';
                echo '<th scope="row"><label name="cargoNo">' . $v['submissionID'] .'</label></th>';
                echo '<th scope="row"><label name="cargoNo">' . $v['status'] .'</label></th>';
                echo '</tr>';
                }

               ?>
                </tbody>
              </table>
         </div>
         <div class="col">
            <h4 class="baslik">Inbox</h4><br>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">Status</th>
		    <th scope="col">Finalize</th>
                    <th scope="col">Evaluate</th>
                    <th scope="col">Write Report</th>
                    <th scope="col">Report Status</th>
                  </tr>
                </thead>
                <tbody class="tbody2">
                  <form method="POST">
                  <?php while($v = mysqli_fetch_array($recipientQuery))
                  {
                    echo '<tr>';
                    echo '<th scope="row"><label name="cargoNo">' . $v['submissionID'] .'</label></th>';
                    echo '<th scope="row"><label name="cargoNo">' . $v['status'] .'</label></th>';
                          $asd = $v['submissionID'];
                          $reportQuery = mysqli_query($conn, "SELECT * FROM report where submissionID = '$asd';");
                          $evaluateQuery  = mysqli_query($conn, "SELECT * FROM evaluates where submissionID = '$asd';");
                          $status = $v['status'];
                          if($status == 'finalized')
                          {
                              echo '<td><input type="submit"  class="btn btn-dark btn-circle btn-xl" value ="F" name="finBtn" disabled></button></td>';
                          }
                          else {
                            echo '<td><input type="submit"  class="btn btn-dark btn-circle btn-xl" value ="F" name="finBtn"></button></td>';
                          }

                          if(mysqli_num_rows($evaluateQuery) == 0)
                          {
                             echo '<td><input type="submit" class="btn btn-dark btn-circle btn-xl" name="evaluateBtn" value ="E"></button></td>';
                          }
                          else {
                            echo '<td><input type="submit" class="btn btn-dark btn-circle btn-xl" name="evaluateBtn"  value ="E" disabled></button></td>';
                          }


                          if(mysqli_num_rows($reportQuery) == 0)
                          {
                             echo '<td><input type="submit"  class="btn btn-dark btn-circle btn-xl" value ="R" name="reportBtn"></button></td>';
                             echo '<td>No report found</td>';
                          }
                          else {
                            echo '<td><input type="submit"  class="btn btn-dark btn-circle btn-xl" value ="R" name="reportBtn" disabled></button></td>';
                            $resRow = mysqli_fetch_array($reportQuery, MYSQLI_ASSOC);
                              echo '<td>'. $resRow['status']. '</td>';
                          }

                          echo '<td><input type="hidden"  class="btn btn-dark btn-circle btn-xl" value ='. $v['submissionID'] . ' name="subToBeReport"></button></td>';
                    }
               ?>
             </form>
                </tbody>
              </table>
            </div>
        </div>

      </div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
