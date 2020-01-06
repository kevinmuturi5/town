<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 7/22/19
 * Time: 2:39 PM
 */

require_once '../init.php';

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $response = [
        "status" => "",
        "data" => ""
    ];
    // echo $_GET["product_id"];
    if(isset($_GET["product_sku"])){
        $prod_sku= trim($_GET["product_sku"]);
        $sql = "SELECT * from purchases WHERE sku = '$prod_sku'";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                $response["status"] = "success";
                $response["data"] = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }else{
                $response["status"] = "error";
            }
        }else{
            $response["status"] = "error";
        }
    }else{
        $response["status"] = "error";

    }
    echo json_encode($response);
}