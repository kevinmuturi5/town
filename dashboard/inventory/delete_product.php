<?php
require "init.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST["product_id"])){
        $response = [
            "status" => "",
            "message" => ""
        ];
        $product_id = trim($_POST["product_id"]);
        $sql = "DELETE FROM products WHERE id= '$product_id'";

        if($result = mysqli_query($conn, $sql)){
            $response["status"] = "success";
            $response["message"] = "Success! One product deleted";
        }else{
            $response["status"] = "error";
            $response["message"] = "Error! product could not be deleted. Try again";            
        }
    }else{
        $response["status"] = "error";
        $response["message"] = "Error! Try again";
    }
    
    echo json_encode($response);
}

?>