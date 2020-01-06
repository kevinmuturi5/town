<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 7/29/19
 * Time: 9:43 AM
 */

require_once '../init.php';
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $response = [
        "status" => "",
        "data" => ""
    ];
    // echo $_GET["product_id"];
    if(!empty($_GET["ready_id"])){
        $ready_id = trim($_GET["ready_id"]);
        $fraction = trim($_GET["fraction"]);

        $sql = "select r.selling_price as selling_price, r.quantity as quantity
        from ready_sale r 
        where r.id = '$ready_id' AND r.fraction = '$fraction'";

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