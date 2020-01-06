<?php
require_once "init.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $response = [
        "status" => "",
        "data" => ""
    ];

    if(isset($_GET["sku"]) && isset($_GET["fraction"]) ){
        $sku = mysqli_real_escape_string($conn, $_GET["sku"]);
        $fraction = mysqli_real_escape_string($conn, trim($_GET["fraction"]));        
        $sql = "SELECT r.fraction, r.quantity, r.selling_price, r.sku, p.name
        FROM ready_sale r
        INNER JOIN products p ON r.product_id = p.id
        WHERE r.sku = '$sku' AND r.fraction='$fraction' ";

        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                $response["status"] = "success";
                $response["data"] = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }
        }else{
            $response["status"] = "error";
            $response["data"] = "Error! Could not fetch items prepared for sale"; 
        }
    }else{
        $response["status"] = "error";
        $response["data"] = "Error! Could not fetch Items prepred for sale";        
    }
    echo json_encode($response);
}

?>