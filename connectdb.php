<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "cs3319";
    $dbname = "assign2db";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (mysqli_connect_errno()) {
        die("database connection failed :" .
        mysqli_connect_error() .
        "(" . mysqli_connect_errno() . ")"
            );
    }
?>