<?php
require_once ("init.php");
 
 if($_SERVER["REQUEST_METHOD"] == "GET"){
     $response = [
         "status" => "",
         "data" => ""
     ];
     if(!empty($_GET["sale_id"])){
        $sale_id = trim($_GET["sale_id"]);
        $sql = "SELECT * FROM sales WHERE id = '$sale_id' AND supplier_id = '$supplier_id' ";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                $response["status"] = "success";
                $response["data"] = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }else{
                $response["status"] = "error";
                $response["data"] = "Error! No sale found";            
            }
        }else{
            $response["status"] = "error";
            $response["data"] = "Error! Could not retrieve this sales";        
        }
     }
 }
 

?>