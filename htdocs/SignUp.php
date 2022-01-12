<?php
include 'connect.php';

if(!empty($_POST["logInButton"]))
{

    if(!empty($_POST['usernameInput']) && !empty($_POST['passwordInput']) && !empty($_POST['emailInput']) && !empty($_POST['phoneInput']))
    {
        $username = ($_POST['usernameInput']);
        $password = ($_POST['passwordInput']);
        $email = ($_POST['emailInput']);
        $phone = ($_POST['phoneInput']);
        $resChecks = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
        $resRowChecks = mysqli_fetch_array($resChecks, MYSQLI_ASSOC);

        $resChecks1 = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

        if(mysqli_num_rows($resChecks) != 0)
        {
            echo '<script language="javascript">';
            echo 'alert("The username had been taken!")';
            echo '</script>';
        }else if(mysqli_num_rows($resChecks1) != 0)
        {
            echo '<script language="javascript">';
            echo 'alert("Email had been already taken!")';
            echo '</script>';
        }else
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $res = mysqli_query($conn, "INSERT INTO users(username, password, email, phone_number)
                VALUES ('$username', '$password', '$email', '$phone');");
                echo $res;
                $a = mysqli_insert_id($conn);

                $res12 = mysqli_query($conn, "INSERT INTO customer(userID, address, discountID, username, password, email, phone_number)
                VALUES ('$a', null, null, '$username', '$password', '$email', '$phone');");
                header('location: LogIn.php');
            }
            else {
                echo '<script language="javascript">';
                echo 'alert("Not Valid Email format!")';
                echo '</script>';
            }
        }




    }else
    {
        echo '<script language="javascript">';
                echo 'alert("One of the fields is empty! Please Fill!")';
                echo '</script>';
    }

}
/*
INSERT INTO User(name, password, email, phoneNumber)
VALUES (@userName, @password, @email, @phoneNumber)
INSERT INTO Customer(userID,address,discountID)
VALUES (LAST_INSERT_ID(),null, null)
*/
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
    <h1 class="baslik">Sign Up</h1>
    <div class="jumbotron">
    <form method="POST">
        <div class="input-group input-group-lg">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">User Name</span>
            </div>
            <input type="text" class="form-control" placeholder="Username" name="usernameInput"aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <br>
        <div class="input-group input-group-lg">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Email </span>
            </div>
            <input type="text" class="form-control" placeholder="Email address" name="emailInput" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <br>
        <div class="input-group input-group-lg">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Phone no</span>
            </div>
            <input type="text" class="form-control" placeholder="Phone Number" name="phoneInput" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <br>
        <div class="input-group input-group-lg">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Password</span>
            </div>
            <input type="password" class="form-control" placeholder="Password" name="passwordInput" aria-label="Username" aria-describedby="basic-addon1">
        </div>

        <br>
        <input type="submit" class="button" value="Sign Up" name="logInButton"></button>

</form>
    </div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
