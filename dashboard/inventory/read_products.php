<?php
require "../init.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $response = [
        "status" => "",
        "data" => ""        
    ];
    // echo $_GET["product_id"];
    if(!empty($_GET["product_id"])){
        $product_id = trim($_GET["product_id"]);
        $sql = "SELECT * from products WHERE  id='$product_id'";
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

?>