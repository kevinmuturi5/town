<?php
require_once "../init.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $response = [
        "status" => "",
        "data" => ""
    ];
    // print_r($response);#
    if(isset($_GET["product_id"])){
        $product_id = $_GET["product_id"]; 
        $sql = "SELECT * FROM products WHERE id = '$product_id'";
    
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                $response["status"] = "success";
                while ($row = mysqli_fetch_assoc($result)){
                    $response["data"] = [
                        "id" => $row["id"],
                        "product_name" => $row["name"],
                        "sku" => $row["sku"],
                        "buying_price" => $row["unit_price"],
                    ];
    
                    $response["satus"] = "success";
                }
                // $response["data"] = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }else{
                $response["status"] = "error";
                $response["data"] = "Error! No Product is prepared for sale";            
            }
        }else{
            $response["status"] = "error";
            $response["data"] = "Error! Could not fetch Items prepred for sale";        
        }
    }
    echo json_encode($response);
}

?>