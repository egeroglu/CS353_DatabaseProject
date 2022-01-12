<?php
include 'connect.php';

if(!empty($_POST["logInButton"]))
{    

    if(!empty($_POST['nameInput']) && !empty($_POST['passwordInput']))
    {
        $userID = strtoupper($_POST['nameInput']);
        $password = strtoupper($_POST['passwordInput']);
        $res = mysqli_query($conn, "SELECT * FROM (select * from clerk natural join employee) as X WHERE UPPER(username) = '$userID' AND UPPER(password) = '$password';");
        $resRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

        if($resRow != null)
        {
            session_start();
            $_SESSION['sessionUserName'] = $_POST['nameInput']; 
            $_SESSION['check'] = 0;
            $_SESSION['message'] = ""; 
            header('Location: EmpMenu.php'); 
        }else
        {
            echo '<script language="javascript">';
            echo 'alert("wrong name or password")';
            echo '</script>';
        }
    }else
    {
        echo '<script language="javascript">';
        echo 'alert("no name or password")';
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

        .input-group-prepend{
            width: 17%;
        }

        .input-group-prepend label {
            width: 100%;
            overflow: hidden;
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
    <h1 class="baslik">Employee Log In</h1>
    <div class="jumbotron">
          <form method="POST">
            <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-lg">User Name</span>
                </div>
                <input type="text" class="form-control" name="nameInput"aria-label="Username" aria-describedby="inputGroup-sizing-sm">
            </div>
            <br>
            
            <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-lg"> Password </span>
                </div>
                <input type="password" class="form-control" name="passwordInput" aria-label="Username" aria-describedby="inputGroup-sizing-sm">
            </div>
            <br>
             <input type="submit" class="button" value="Log In" name="logInButton"></button><br><br>
		</form>
            </div>
    </div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>