<?php
include 'connect.php';
session_start();

if(!isset($_SESSION['check']))
{
    header('location: index.php');
}
$username = $_SESSION['sessionUserName'];
$recipientName = $_SESSION["recipientname"];
echo 'Welcommeee ' .$username;
$userQuery = mysqli_query($conn, "SELECT userID FROM customer where username = '$username';");
$userQueryResult = mysqli_fetch_array($userQuery, MYSQLI_ASSOC);
$userID = $userQueryResult['userID'];

$recipentQuery = mysqli_query($conn, "SELECT userID FROM customer where username = '$recipientName';");
$recipientQueryResult = mysqli_fetch_array($recipentQuery, MYSQLI_ASSOC);
$recipientID = $recipientQueryResult['userID'];

$resChecks = mysqli_query($conn, "SELECT * FROM insurance natural join insurancecompany;");

$noOFPackages =   $_SESSION['packageNumber'];




if(!empty($_POST["submitButton"]))
{
  $insuranceOption = $_POST["InsuranceOption"];
  $payment = $_POST["payment"];
  $creditCardNoQuery = mysqli_query($conn, "SELECT creditCardNo FROM creditcard where customerID = '$userID'");

  if( $payment == 1 && mysqli_num_rows($creditCardNoQuery) == 0 )
  {
    echo '<script language="javascript">';
    echo 'alert("No credit card info found!")';
    echo '</script>';
    unset($_POST["submitButton"]);
  }
  else {
    if(!$conn->query( "INSERT INTO submission (senderID,recipientID,insuranceID,clerkID,status) VALUES('$userID', '$recipientID','$insuranceOption', null, 'waiting_to_be_accepted');"))
    {
      echo $conn->error;
    }
      $submissionID = mysqli_insert_id($conn);
      $width = $_POST["width"];
      $length = $_POST["length"];
      $height = $_POST["height"];
      $weight = $_POST["weight"];
    for($i = 0; $i < $noOFPackages; $i++)
    {
      $heightX = $height[$i];
      $lengthX = $length[$i];
      $widthX = $width[$i];
      $weightX = $weight[$i];
      $resChecks = mysqli_query($conn, "INSERT INTO package (submissionID,weight,width,length,height) VALUES('$submissionID', '$weightX','$widthX', '$lengthX', '$heightX');");
    }

    $submissionCountQuery = mysqli_query($conn, "SELECT senderID, COUNT(*) as sub from submission where senderID = '$userID' GROUP BY senderID;");
    $submissionQueryResult = mysqli_fetch_array($submissionCountQuery, MYSQLI_ASSOC);
    $submissionCount = $submissionQueryResult['sub'];
    $amount = rand(50,250);
    if($submissionCount % 3 == 0)
    {
      $discountID = 2;
      $date = date("Y-m-d");
      $discountCheck = mysqli_query($conn, "SELECT percentage FROM discount where discountID = '$discountID'");
      $discountResult = mysqli_fetch_array($submissionCountQuery, MYSQLI_ASSOC);
      $amount = $amount - ($discountResult['percentage']/100*$amount);
      $resChecks = mysqli_query($conn, "INSERT INTO transaction (amount,datee,discountID) VALUES('$amount', '$date','$discountID');");
    }
    else
    {
      $discountID = 1;
      $date = date("Y-m-d");
      echo $date;
      if(!$conn->query("INSERT INTO transaction (amount,datee,discountID) VALUES('$amount', '$date','$discountID');"))
      {
        echo $conn->error;
      }

    }
    $transactionID = mysqli_insert_id($conn);
    if($payment == 0) //Cash
    {
      $change = rand(5,15);
      if(!$conn->query("INSERT INTO cashtransaction (transactionID,changeAmount) VALUES('$transactionID', '$change');"))
      {
        echo $conn->error;
      }
    }
    else
    {
      $creditCardQueryResult = mysqli_fetch_array($creditCardNoQuery, MYSQLI_ASSOC);
      $creditCardNo = $creditCardQueryResult['creditCardNo'];
      $resChecks = mysqli_query($conn, "INSERT INTO creditcardtransaction (transactionID,creditCardNo) VALUES('$transactionID', '$creditCardNo');");
    }
    $resChecks = mysqli_query($conn, "INSERT INTO pays (transactionID,customerID,submissionID) VALUES('$transactionID', '$userID', '$submissionID');");
  }
  $_SESSION['submissionID'] = $submissionID;
  if($_POST["exampleRadios"] == 'a')
  {
    header('location: SubmitToBranchInPerson.php');

  }
  else {
    header('location:CallACourier.php');
  }

}

?>
<html lang="en">
<head>
    <?php echo "<div align='left'><a href='SelectRecipient.php' class='button2'>Go Back</a></div>"; ?>
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
            background-color: #e5e5e5;
            padding-left: 5%;
            padding-right: 5%;
        }
        .jumbotron2 {
            background-color: #e5e5e5;
            text-align: left;
            padding-left: 5%;
            padding-right: 5%;
        }
        .baslik {
            text-align: center;
            color: rgb(0, 0, 0);
            padding-bottom: 2%;
        }
        .container{
          text-align: center;
          background-color: #e5e5e5;
        }

        .button2 {
  display: inline-block;
  background: #A9A9A9;
  color: rgb(0, 0, 0);
  text-transform: uppercase;
  padding: 15px 25px;
  border-radius: 5px;
  box-shadow: 0px 17px 10px -10px rgba(0, 0, 0, 0.4);
  cursor: pointer;
  -webkit-transition: all ease-in-out 300ms;
  transition: all ease-in-out 300ms;
}

.box select {
  background-color: #3a3a3a;
  color: white;
  padding: 12px;
  width: 350px;
  border: none;
  font-size: 15px;
  box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
  -webkit-appearance: button;
  appearance: button;
  outline: none;
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
<body class="body">
<form method="POST">

    <h1 class="baslik">Package Description</h1>
    <div class="container ">
      <div class="row">
        <div class="col">
          <div class="jumbotron">
            <div class="box">
              <select name="InsuranceOption" required>
                <option value= "">-Insurance Coverage, Company, Description-</option>
                <?php
                while($v = mysqli_fetch_array($resChecks))
                {
                  if( $v['insuranceID']== 0)
                  {
                      echo "<option value=".$v['insuranceID'].">" .$v['coveragePercent'] . " " . $v['description']. "</option>";
                  }
                  else {
                        echo "<option value=".$v['insuranceID'].">" .$v['coveragePercent'] . " " .$v['name']. " " . $v['description']. "</option>";
                  }

                }

                ?>
              </select>

            </div><br><br>

            <div class="box">
              <select name="payment" required>
                <option value="">-Select Payment Method-</option>
                <option value="0">Cash</option>
                <option value="1">Credit Card</option>
              </select>
            </div><br><br>
            <div class="jumbotron2">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" value="a" checked>
                <label class="form-check-label" for="exampleRadios3">Submit to the Branch in Person</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" value="b">
                <label class="form-check-label" for="exampleRadios3">Call a Courier</label>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <br><br><br>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Number</th>
                <th scope="col">Weight</th>
                <th scope="col">Height</th>
                <th scope="col">Length</th>
                <th scope="col">Width</th>
              </tr>
            </thead>
            <tbody class="tbody2">
              <?php for($i = 1; $i<= $noOFPackages; $i++)
              {
                echo '<tr>';
                echo '<th scope="row"><label name="cargoNo">' . "$i" .'</label></th>';
                echo '<td><input type="number" class="form-control" placeholder="gr" required name="weight[]" ></td>';
                echo '<td><input type="number" class="form-control" placeholder="cm" required name="height[]"  ></td>';
                echo '<td><input type="number" class="form-control" placeholder="cm" required name="length[]"  ></td>';
                echo '<td><input type="number" class="form-control" placeholder="cm" required name="width[]"  ></td>';
                echo '</tr>';
              }

               ?>

          </table>
        </div>

      </div>
      <input type="submit" class="button" value="Create Submission" name="submitButton"></button><br><br><br><br>
      <!--- redio button a göre href ver --->

    </div>
  </form>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
