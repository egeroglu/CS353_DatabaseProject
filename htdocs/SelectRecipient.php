<?php
include 'connect.php';
session_start();

if(!isset($_SESSION['check']))
{
    header('location: index.php');
}
$username = $_SESSION['sessionUserName'];
echo 'Welcommeee ' .$username;




if(!empty($_POST["selectButton"]))
{
    $_SESSION['recipientname'] = $_POST["rowname"];
    echo   $_SESSION['recipientname'];
    header('location: PackageDescription.php');
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
                background-color: white;
                text-align: center;

            }
            .container {
                background-color: #e5e5e5;
                text-align: center;

            }
            .table-fixed tbody {
                display: block;
                height: 300px;
                overflow-y: auto;
            }

            .center {
                margin-left: auto;
                margin-right: auto;
            }
            table, th, td {
                border: 1px solid #c5c5c5;
             }
             .col1{
                width:4cm;
            }

            .col2{
                width:7cm;
            }

            .col3{
                width:3cm;
            }
            .btn-circle.btn-xl {
                width: 70px;
                height: 70px;
                padding: 10px 16px;
                border-radius: 35px;
                font-size: 12px;
                text-align: center;
            }
            .container2 {
              display: flex;
              justify-content: center;
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
        <h1 class="baslik">Select Recipient</h1><br>
        <div class="container">
            <br><br><br>
            <div class="container2">
            <form method="POST">
              <div class="input-group mb-3">

                  <input type="text" name="recipientNameInput" width="100"  placeholder="Enter the username" aria-label="Example text with button addon" aria-describedby="button-addon1" required>
                  <div class="input-group-prepend">
                    <input type="submit" class="button2 rounded btn-outline-secondary" name="searchRecipientButton" value="Search customer" id="button-addon1"></button>
                  </div>


                </div>
              </div>
                </form>
            <div class="row">
                <table class="col-xs-7 center ">
                    <tbody>
                        <?php

                        if(!empty($_POST["searchRecipientButton"]))
                        {
                              $recipientName = $_POST["recipientNameInput"];
                              $resChecks = mysqli_query($conn, "SELECT * FROM recipientview where username LIKE '%".$recipientName."%';");
                              if(!empty($_POST["searchRecipientButton"]))
                              {
                                    $recipientName = $_POST["recipientNameInput"];
                                    $resChecks = mysqli_query($conn, "SELECT * FROM recipientview where username LIKE '%".$recipientName."%' AND username != '$username' ;");
                                    while($v = mysqli_fetch_array($resChecks))
                                    {
				    if($v['address'] != NULL)
				    {
				    echo "<tr>";
                                    echo  '<td class="col1" >'. $v['username'] . "</td>";
                                    echo  '<td class="col2">' .$v['address'] . "</td>";
                                    echo "<td>". "<form method= 'POST'><input type = hidden name='rowname' value= '".$v['username']."'>";
                                    echo '<td class="col3"><br><input type ="submit" value="Select" button type="button" class="btn btn-dark btn-circle btn-xl" name="selectButton"></button><br><br></td>';
                                    echo '</form>';
                                    echo "<tr>";

					}


                                    }
                              }
                        }
                        ?>

                    </tbody>
                </table>
        </div>
        <br><br><br>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
    </html>
