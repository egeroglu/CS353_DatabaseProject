<?php
include 'connect.php';
session_start();

if(!isset($_SESSION['check']))
{
    header('location: index.php');
}
$username = $_SESSION['sessionUserName'];
echo 'Welcommeee ' .$username;

if(!empty($_POST["submitButton"]))
{

    if(!empty($_POST['addresInput']) ||( !empty($_POST['cardNoInput']) && !empty($_POST['expirationInput']) && !empty($_POST['cvvInput'])))
    {
        $adresss = ($_POST['addresInput']);
        $cardNo = ($_POST['cardNoInput']);
        $expiration = ($_POST['expirationInput']);
        $cvv = ($_POST['cvvInput']);
        $resChecks = mysqli_query($conn, "SELECT * FROM customer WHERE username = '$username'");
        $resRowChecks = mysqli_fetch_array($resChecks, MYSQLI_ASSOC);

        $resChecks1 = mysqli_query($conn, "SELECT * FROM users WHERE email = 'email'");
        $resRowChecks1 = mysqli_fetch_array($resChecks1, MYSQLI_ASSOC);

        if(!empty($_POST['addresInput']))
        {
            $query = mysqli_query($conn, "UPDATE customer set address = '$adresss' WHERE username = '$username';");
            header('location: UserProfile.php');
        }



       if(!empty($_POST['cardNoInput']) && !empty($_POST['expirationInput']) && !empty($_POST['cvvInput']))
       {
           $x = $resRowChecks['userID'];
           $rez = mysqli_query($conn, "SELECT * FROM creditcard WHERE customerID = '$x';");

           if(mysqli_num_rows($rez)==0)
           {
            $insertCard = mysqli_query($conn, "INSERT INTO creditcard(creditCardNo, expirationDate, cvv, customerID)
            VALUES ('$cardNo', '$expiration', '$cvv', '$x');");
           }else
           {
             $deleteCard = mysqli_query($conn, "DELETE FROM creditcard where customerID= '$x'");
             $insertCard = mysqli_query($conn, "INSERT INTO creditcard(creditCardNo, expirationDate, cvv, customerID)
             VALUES ('$cardNo', '$expiration', '$cvv', '$x');");
           }
           header('location: UserProfile.php');
       }




    }else
    {
        echo '<script language="javascript">';
                echo 'alert("Enter adress or credit card information please!")';
                echo '</script>';
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
            background-color: #e5e5e5;
        }
        .jumbotron2 {
            background-color:#c5c5c5;
            padding: 5%;
            padding-bottom: 2%;
        }

        .baslik {
            text-align: center;
            color: black;
            padding-bottom: 2%;
        }

        .input-group-prepend label {
            width: 100%;
            overflow: hidden;
        }
        .form-control{
            background-color: #e5e5e5;
        }
        .jumbotron3 {
            background-color:#e5e5e5;
            text-align:end;
        }



.button {
  display: inline-block;
  background: #C5C5C5;
  color: black;
  text-transform: uppercase;
  padding: 20px 30px;
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

.button2 {
  display: inline-block;
  background: #C5C5C5;
  color: black;
  float:left;
  overflow: hidden;
  text-transform: uppercase;
  padding: 20px 30px;
  border-radius: 5px;
  box-shadow: 0px 17px 10px -10px rgba(0, 0, 0, 0.4);
  cursor: pointer;
  -webkit-transition: all ease-in-out 300ms;
  transition: all ease-in-out 300ms;
}
.button2:hover {
  box-shadow: 0px 37px 20px -20px rgba(0, 0, 0, 0.2);
  -webkit-transform: translate(0px, -10px) scale(1.2);
          transform: translate(0px, -10px) scale(1.2);
}




    </style>
</head>
<body class="body">
    <h1 class="baslik">Edit Profile</h1>
    <div class="jumbotron">
    <form method="POST">
        <div class="jumbotron2">
        <h3>Addres: <span class="label label-default"></span></h3>
        <div class="form-group">
            <textarea class="form-control" name="addresInput"id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>

            <h4>New Card No: <span class="label label-default"></span></h4>
            <div class="form-group">
                <div class="form-group">
                    <input type="text" class="form-control" name="cardNoInput" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Card No">
                  </div>
            </div>



            <h4>Expiration Date: <span class="label label-default"></span></h4>
            <div class="form-group">
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputEmail1" name="expirationInput" aria-describedby="emailHelp" placeholder="Expiration Date">
                  </div>
            </div>


            <h4>CVV: <span class="label label-default"></span></h4>
            <div class="form-group">
                <div class="form-group">
                    <input type="password" class="form-control" id="exampleInputEmail1" name="cvvInput" aria-describedby="emailHelp" placeholder="CVV">
                    <small id="cvvHelp" class="form-text text-muted">Three digit at the back of your card.</small>
                </div>

            </div>
        </div>
        <br>
        <div class="jumbotron3">
        <input type="submit" class="button" value="Submit" name="submitButton"></button>
        <button class="button2"><a href="DeleteAccount.php" onclick="return confirm('Are you sure?')">Delete Account</a></button>
</form>
</div></a>
        </div>


    </div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
