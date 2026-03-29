<?php
    $servername = "localhost";
    $username = "root";
    $password = "M@h1ka123";
    $database = "nepaltelecom_projects";

    $conn = mysqli_connect($servername, $username, $password, $database) or die(mysqli_error($conn));

    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }
    // else
    // {
    //     echo "Connected successfully";
    // }
?>