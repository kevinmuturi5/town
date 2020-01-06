<?php
require_once "init.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $name = $unit_price = $quantity = $sku = $vat = $receipt_id = $sub_total = "";

    $response = [
        "status" => "",
        "message" => ""
    ];

    if(isset($_GET["sku"])){
        $sku = mysqli_real_escape_string($conn, trim($_POST["sku"]));
        $sql = "SELECT * FROM products WHERE sku = '$sku' ";
        if($result = mysqli_query($conn, $sql)){
            if (mysqli_num_rows($result) > 0){
                $response["status"] = "success";
                $response["data"] = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }else{
                $response["status"] = "error";
            }
        }else{
            $response["status"] = "error";
        }
    }
}
?>

