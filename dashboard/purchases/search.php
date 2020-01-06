<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 7/15/19
 * Time: 8:45 AM
 */
require_once ("../init.php");

if($_SERVER["REQUEST_METHOD"] == "GET"){

    $response = [
        "status" => "",
        "data" => ""
    ];

    if(!empty($_GET["product_name"])){
        $product_name = trim($_GET["product_name"]);
//        $sql = "SELECT * FROM purchases WHERE name = '$product_name' AND supplier_id = '$supplier_id' ";
        $sql = "select s.pin as pin, s.name as supplier_name ,p.name as product_name ,p.receipt_number as receipt_number, p.unit as unit_price,p.total_price as total_price,
        p.vat as vat, p.date as date,p.sku as sku, p.time as time,p.sub_total as sub_total
        from product_suppliers s inner join  purchases p on s.id =supplier_id where s.customer_id ='$customer_id'";
        if($result = mysqli_query($conn, $sql)){
            if($count = mysqli_num_rows($result) > 0){
                $response["status"] = "success";
                $response["data"] = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }else{
                $response["status"] = "error";
                $response["data"] = "Error! No purchase found";
            }
        }else{
            $response["status"] = "error";
            $response["data"] = "Error! Could not retrieve this purchase(s)";
        }
    }
}
