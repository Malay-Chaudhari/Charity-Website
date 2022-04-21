<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "de";

    $conn = mysqli_connect($server, $username, $password, $database);
    if (!$conn) {
        die("Error : ".mysqli_error);
    }
?>