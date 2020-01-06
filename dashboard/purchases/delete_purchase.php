<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 7/22/19
 * Time: 2:22 PM
 */
require_once '../init.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST["purchase_id"])){
        $response = [
            "status" => "",
            "message" => ""
        ];
        $product_id = trim($_POST["purchase_id"]);
        $sql = "DELETE FROM purchases WHERE id = '$product_id'";

        if($result = mysqli_query($conn, $sql)){
            $response["status"] = "success";
            $response["message"] = "Success! One purchase deleted";
        }else{
            $response["status"] = "error";
            $response["message"] = "Error! Purchase could not be deleted. Try again";
        }
    }else{
        $response["status"] = "error";
        $response["message"] = "Error! Try again";
    }
    echo json_encode($response);
}