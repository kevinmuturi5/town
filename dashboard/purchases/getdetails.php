<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 7/22/19
 * Time: 11:36 AM
 */

require_once '../init.php';

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $response = [
        "status" => "",
        "data" => ""
    ];
    // echo $_GET["product_id"];
    if(!empty($_GET["supplier_pin"])){
        $supplier_pin = trim($_GET["supplier_pin"]);
        $sql = "SELECT * from product_suppliers WHERE  pin = '$supplier_pin'";
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