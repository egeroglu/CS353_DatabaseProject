<?php
include 'connect.php';
session_start();

if(!isset($_SESSION['check']))
{
    header('location: index.php');
}
$username = $_SESSION['sessionUserName'];

$resChecks = mysqli_query($conn, "SELECT * FROM customer WHERE username = '$username'");
$resRowChecks = mysqli_fetch_array($resChecks, MYSQLI_ASSOC);

$adress = $resRowChecks['address'];

$x = $resRowChecks['userID'];
$rez = mysqli_query($conn, "SELECT * FROM creditcard WHERE customerID = $x;");
$rezRowChecks = mysqli_fetch_array($rez, MYSQLI_ASSOC);
echo 'Welcommeee ' .$username;

$asd = mysqli_query($conn,"CALL get_report_procedure_customer('$x')");
$userDetails = mysqli_fetch_array($asd, MYSQLI_ASSOC);

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

        }

        .jumbotron {
            background-color: white;
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
        .container{

            color: white;
            background-color: #e5e5e5;
        }
.container-fluid{
    background-color:  #e5e5e5;
    padding: 15%;
}
.container-fluid2{
    background-color:  #c5c5c5;

}

.container-fluid3{
    background-color:  #c5c5c5;
    padding: 0%;
    line-height: 1200%;
}
.col{
    width:30%;
    text-align: center;
    background-color: #C5C5C5;

}
.row{
    background-color: #C5C5C5;
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
table, th, td {
                border: 1px solid #c5c5c5;
             }
    </style>
</head>
<body class="body">
    <h1 class="baslik">Profile</h1>
    <div class="container-fluid">
        <div class="container-fluid2">
            <table class="table bordertable-bordered ">
                <thead>
                  <tr>
                    <th class="col" scope="col"><div class="container-fluid3"><span class="label " name="userName"><img  src="profileUserr.png" width="200" height="200" alt="My picture" />
</span></div></th>
                    <th class="col1" scope="col">
                        <table class="table bordertable-bordered ">
                            <thead>
                              <tr><br>
                              <th class="row " scope="row"><span class="label label-primary" name="userAddress">Username:&ensp;  <?php echo $username ?></span></th>
                                <th class="row " scope="row"><span class="label label-primary" name="userAddress">Address:&ensp;  <?php echo $adress ?></span></th>
                                <th class="row" scope="row"><span class="label label-primary" name="userCard">Credit Card No:&ensp; <?php if(mysqli_num_rows($rez)==0){echo 'No credit card had been found.';} else {
                                    echo $rezRowChecks['creditCardNo'];
                                    }?></span></th>
                                <th class="row " scope="row"><span class="label label-primary" name="userAddress">Avg Money Spent:&ensp;  <?php echo $userDetails['avgMoney'] ?></span></th>
                                <th class="row " scope="row"><span class="label label-primary" name="userAddress">Max Money Spent:&ensp;  <?php echo $userDetails['maxMoney'] ?></span></th>
                                <th class="row " scope="row"><span class="label label-primary" name="userAddress">Min Money Spent:&ensp;  <?php echo $userDetails['minMoney'] ?></span></th>
                                <th class="row " scope="row"><span class="label label-primary" name="userAddress">Total Money Spent:&ensp;  <?php echo $userDetails['sumMoney'] ?></span></th>
                                <th class="row" scope="row"><a href="EditProfile.php"><button type="button" class="btn btn-outline-dark ">Edit Info</button></a>
                                </th>
                              </tr>
                            </thead>

                          </table>
                    </th>
                  </tr>
                </thead>

              </table>
        </div>
    </div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
