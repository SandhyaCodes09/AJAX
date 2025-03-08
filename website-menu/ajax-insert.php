<?php

$user_name = $_POST["u_name"];
$user_email = $_POST["u_email"];

$conn = mysqli_connect("localhost", "root", "", "data_munch") or die("Connection Failed");

$sql = "INSERT INTO users (user_name, email) VALUES ('{$user_name}','{$user_email}')";

// $result = mysqli_query($conn, $sql) or die("SQL query failed");
    if(mysqli_query($conn, $sql)){
        echo 1;
    }
    else{
        echo 0;
    }
?>