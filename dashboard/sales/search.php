<?php
require_once "init.php";

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["product_name"])){
    $response = [
        "status" => "",
        "data" => [

        ]
    ];
    $product_name = mysqli_real_escape_string($conn, $_GET["product_name"]);
    // print_r($response);
    $repeat_array = [];
    $sql = "SELECT * FROM sales WHERE supplier_id = '$supplier_id' AND product_name like '%$product_name%' ";

    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            $response["status"] = "success";
            while ($row = mysqli_fetch_assoc($result)){
                $receipt_key = $row["receipt_id"];
                if(in_array($receipt_key, $repeat_array)){
                    $sale = [
                        "id" => $row["id"],
                        "product_name" => $row["product_name"],
                        "sku" => $row["sku"],
                        "quantity" => $row["quantity"],
                        "unit_price" => $row["unit_price"],
                        "sub_total" => $row["sub_total"],
                        "vat" => $row["vat"], 
                        "fraction" => $row["fraction"], 
                    ];
                    $receipt_array = $response["data"][$row["receipt_id"]];
                    $test = "test";
                    array_push($response["data"][$receipt_key], $sale);
                }else{
                    $sale = [
                            "id" => $row["id"],
                            "product_name" => $row["product_name"],
                            "sku" => $row["sku"],
                            "quantity" => $row["quantity"],
                            "unit_price" => $row["unit_price"],
                            "sub_total" => $row["sub_total"],
                            "vat" => $row["vat"],
                            "fraction" => $row["fraction"],
                    ]; 
                    $response["data"][$row["receipt_id"]][0] = $sale;
                
                    array_push($repeat_array, $receipt_key);
                }
            }
            // $response["data"] = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }else{
            $response["status"] = "error";
            $response["data"] = "Error! No sales found";            
        }
    }else{
        $response["status"] = "error";
        $response["data"] = "Error! Could not fetch previous sales";        
    }
    echo json_encode($response);
}

?>