<?php
$host = "";
$database = "housinn1_food";
$username = "housinn1_willie";
$password = "WillieScant@2019";

$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn){
    die("Connection failed").mysqli_connect_error;
}

?>