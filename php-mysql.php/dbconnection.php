<?php
    $server = "localhost";
    $dbName = "form";
    $accountName = "root";
    $accountPassword = "";

    $con = mysqli_connect($server, $accountName, $accountPassword, $dbName);

    if ($con){
        echo "Connection Done" . "</br>";
    } else {
        die("ERROR => " . mysqli_connect_error());
    }
?>