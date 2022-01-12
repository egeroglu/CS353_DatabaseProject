
<?php
include 'connect.php';


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
            background-color: #c5c5c5;
            padding: 2%;
            padding-left: 5%;
            padding-right: 5%;
        }

        body,
html {
  height: 100%;
}
.main {
  width: 100%;
  height: 100%;
  position: relative;
  color: #ff0000;
  
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  transition: all 1s ease;
  padding-top: 70px;
}
.main:before {
  bottom: 0;
  left: 0;
  right: 0;
  top: 0;
  position: absolute;
  content: "";
  width: 100%;
  height: 100%;
  /*background: #111e6c;*/
  opacity: 0.2;
  filter: alpha(opacity=90);
}
.main-text {
  top: 20%;
  left: auto;
  right: auto;
  position: relative;
  color: black;
}
.btn-circle,
#to-top {
  border-radius: 50%;
  background: rgb(0, 0, 0);
  padding: 6px;
  font-size: 14px;
  /* border-radius: 50%; */
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  color: rgb(255, 255, 255);
  text-align: center;
  font-weight: 600;
  text-transform: uppercase;
}

.c2a-btn {
  margin: 48px auto 0;
  margin: 4.8rem auto 0;
}

.btn-default {
  color: rgb(0, 0, 0);
  background-color:#c5c5c5;
  border-color: rgb(0, 0, 0);
  transition: all 1s ease;
}

.btn-group-lg > .btn,
.btn-lg {
  padding: 18px 28px;
  font-size: 18px;
  line-height: 1.3333333;
  border-radius: 50px;
}

.btn-group .btn-or {
  top: 50%;
  left: 50%;
  position: absolute;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  z-index: 99;
  box-shadow: 0;
  border: 2px solid rgb(0, 0, 0);
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

    </style>
</head>
<body class="body">
    <h1 class="baslik">Welcome</h1>
    <div class="jumbotron">
        <div class="container-fluid main">
            <div class="text-center main-text">
              <h3>Choose your profile type</h3>
          
              <div class="c2a-btn footer-c2a-btn">
                <div class="btn-group btn-group-lg" role="group" aria-label="Call to action">
                  <a type="button" class="btn btn-default btn-lg" name="employeeButton" href="LoginEmployee.php">Employee</a>
                  <span class="btn-circle btn-or">or</span>
                  <a type="button" class="btn btn-default btn-lg" name="customerButton" href="LogIn.php">Customer</a>
                </div>
              </div>
            </div>
          </div>
          

    </div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>