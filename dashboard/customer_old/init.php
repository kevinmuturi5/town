<?php
require_once "../../config/database.php";
session_start();
if(isset($_SESSION["id"]) && isset($_SESSION["type"])){
    $user_id = $_SESSION["id"];
    $type = $_SESSION["type"];
    $query = "SELECT c.id FROM customers c INNER JOIN users u ON c.user_id = u.id WHERE u.id = '$user_id'";

    $result = mysqli_query($conn, $query);
    if($result && mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $customer_id = $row["id"];
        }
    }
    else{
        echo "Error".mysqli_error($conn);
    }
}

if($type != 1){
    header("location:../../auth/login.php");
    die("You are not authorized to access this page");
}

?>
