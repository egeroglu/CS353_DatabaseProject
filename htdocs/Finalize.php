<?php
include 'connect.php';
session_start();

if(!isset($_SESSION['check']))
{
    header('location: index.php');
}
$username = $_SESSION['sessionUserName'];
echo 'Welcommeee ' .$username;

$re = mysqli_query($conn, "SELECT branchID FROM employee WHERE username = '$username';");
$rowID = mysqli_fetch_array($re, MYSQLI_ASSOC);

$branchID = $rowID['branchID'];

$reportID = $_SESSION['reportForEmployee'];
$submissionQuery = mysqli_query($conn, "SELECT * FROM report WHERE reportID = '$reportID';");
$rowID = mysqli_fetch_array($submissionQuery, MYSQLI_ASSOC);
$customerID = $rowID['customerID'];
            $cusque = mysqli_query($conn, "SELECT username FROM users WHERE userID = '$customerID'");
            $rowFark = mysqli_fetch_array($cusque, MYSQLI_ASSOC);
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

        .card {
            text-align: left;
        }
    </style>
</head>
<body>
    <form method="POST">
    <h1 class="baslik">Finalize Report</h1>
    <div class="jumbotron">
        <div class="info-header">
            <strong>Order ID: </strong>
                <?php echo $rowID['reportID']; ?>
            <br>
            <strong>Recipient Name: </strong>
            <?php echo $rowFark['username'];?>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <?php echo $rowID['text'];?>
            </div>
        </div>
        <br><br>
            <input type= "submit" name= "neg" button type="button" value="Negative" class="btn btn-danger btn-lg"></button>
            <input type = "submit" name ="pos" button type="button" value="Positive" class="btn btn-success btn-lg"></button>
    </div>
    </form>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>

<?php
    if (isset($_POST['neg'])) 
    {
        $query = mysqli_query($conn, "UPDATE report set status = 'negative' WHERE reportID = '$reportID';");
        header('location: ManageReports.php');
    }

    if (isset($_POST['pos'])) 
    {
        $query = mysqli_query($conn, "UPDATE report set status = 'positive' WHERE reportID = '$reportID';");
        header('location: ManageReports.php');
    }
?>