<?php
require_once "../init.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $response = [
        "status" => "",
        "data" => ""        
    ];
    $search = trim($_GET["search"]);
    $sql = "SELECT * from products WHERE supplier_id = '$supplier_id'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            $response["status"] = "success";
            $response["data"] = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }else{
            $response["status"] = "error".mysqli_error($conn);
        }
    }else{
        $response["status"] = "error".mysqli_error($conn);
    }

    echo json_encode($response);
}

?>