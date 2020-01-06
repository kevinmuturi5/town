<?php
require_once "../init.php";

 if($_SERVER["REQUEST_METHOD"] == "GET"){
     $response = [
         "status" => "",
         "data" => ""
     ];
     if(isset($_GET["receipt_id"])){
        $receipt_id = trim($_GET["receipt_id"]);
        $sql = "DELETE FROM sales WHERE receipt_id= '$receipt_id' AND supplier_id = '$supplier_id' ";
        if($result = mysqli_query($conn, $sql)){
            $response["status"] = "success";
            $response["data"] = "Sale receipt deleted successfully";
        }else{
            $response["status"] = "error";
            $response["data"] = "Error! Could not delete this sale receipt";        
        }
     }

     echo json_encode($response);
 }
 

?>