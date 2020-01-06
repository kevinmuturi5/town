<?php
require "../init.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $response = [
        "status" => "",
        "data" => ""        
    ];
    if(!empty($_GET["search"])){
        $search = trim($_GET["search"]);
        $sql = "SELECT * from products WHERE  name like '%$search%' AND supplier_id = '$supplier_id' ";
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