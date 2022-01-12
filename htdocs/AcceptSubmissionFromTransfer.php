<?php
include 'connect.php';
session_start();

if(!isset($_SESSION['check']))
{
    header('location: index.php');
}
$username = $_SESSION['sessionUserName'];
echo 'Welcome ' .$username;
$employeeQuery = mysqli_query($conn, "SELECT userID,branchID FROM employee where username = '$username';");
$employeeQueryResult = mysqli_fetch_array($employeeQuery, MYSQLI_ASSOC);
$employeeID = $employeeQueryResult['userID'];
$branchID = $employeeQueryResult['branchID'];
if(!empty($_POST["organize"]))
{
        $submissionID = $_POST['subID'];
        $resChecks = mysqli_query($conn, "SELECT * FROM transfer where submissionID = '$submissionID' and branchID = '$branchID'");
        $resRow = mysqli_fetch_array($resChecks, MYSQLI_ASSOC);
        if($resRow != null)
        {
          if(!$conn->query("UPDATE submission SET status = 'in_destination_branch', clerkID = '$employeeID' where submissionID = '$submissionID';"))
          {
              echo $conn->error;
          }
          if(!$conn->query("DELETE FROM transfer where submissionID = '$submissionID';"))
          {
              echo $conn->error;
          }


        }
        else {
          echo '<script language="javascript">';
          echo 'alert("This submission does not exist!")';
          echo '</script>';
        }

}
?>
<html lang="en">
<head>
    <?php echo "<div align='left'><a href='EmpMenu.php' class='button2'>Go Back to Main Menu</a></div>"; ?>
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
           .col1{
              width:15cm;
          }

          .col2{
              width:15cm;
          }

          .col3{
              width:15cm;
          }
    </style>
</head>
<body>

    <h1 class="baslik">Accept Submission From Transfer</h1>
    <div class="jumbotron">
      <div class="w3-container">
      <?php
                      echo "Submissions Waiting for approval...";
                      echo "<br />";
                      echo "<br />";
                      $resChecks = mysqli_query($conn, "SELECT * FROM transfer where branchID = '$branchID';");
                      while($v = mysqli_fetch_array($resChecks))
                      {
                      echo "<tr>";
                      echo  '<td class="col1">'. "  ~~~  SubmissionID: ".$v['submissionID'] . "  ~~~  ".  "</td>";
                      echo "<tr>";
                      echo "<br />";
                      }
       ?>
       <form method="POST">
       <br><br>
     </div>
          <div class="dropdown btn-group">
            <div class="input-group-prepend">

              <input type="number" placeholder="Submission ID" name="subID" required></span>
            </div>

            <div class="box">
              <select name="subOption" required>
                <option value="">-Choose an option-</option>
                <option value="1">Accept</option>
              </select>
            </div>
          </div>
          <br><br>
          <input type="submit" class="button" name="organize" value="Submit"></button>
          </form>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
