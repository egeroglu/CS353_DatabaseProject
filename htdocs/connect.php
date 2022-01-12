<?php 
    $conn = new mysqli("localhost", "root","" , "cargo_db" );

    if($conn){
    }else{
        die(mysqli_error($conn));
    }
?>