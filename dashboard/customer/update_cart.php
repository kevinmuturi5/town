<?php
require_once '../init.php';

if ($_SERVER["REQUEST_METHOD"] == "GET"){
   $ready_id = $_GET['ready_id'];
   $quantity = $_GET['quantity'];

   if (isset($_SESSION["cart"])){
        if (isset($_SESSION["cart"][$ready_id]) && isset($quantity)){
            $_SESSION["cart"][$ready_id]["count"] = $quantity;
        }else{
            $_SESSION["cart"][$ready_id]= [
                "count" => 1,
            ];  
        }
   }else{
       $_SESSION["cart"] = array();
       $_SESSION["cart"][$ready_id] = [
        "count" => 1,
        ];  
   }

   echo json_encode($_SESSION["cart"][$ready_id]);

}
