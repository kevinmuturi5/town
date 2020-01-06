<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 7/11/19
 * Time: 11:28 AM
 */

require "../init.php";


if($_SERVER["REQUEST_METHOD"] == "GET"){
    $response = [
        "status" => "",
        "data" => ""
    ];
    $search = trim($_GET["search"]);
//    $sql = "SELECT * from purchases WHERE supplier_id = '$supplier_id'";
    $sql = "select s.pin as pin, s.name as supplier_name , p.sku as sku, p.name as product_name, p.receipt_number as receipt_number, p.unit_price as unit_price, 
            p.total_price as total_price, p.vat as vat, p.date as date, p.time as time, p.sub_total as sub_total, p.id as id,
            p.quantity as quantity,p.description as description, s.location as supplier_location from product_suppliers s inner join 
            purchases p on s.id = p.supplier_id where p.customer_id = '$supplier_id' " ;
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            $response["status"] = "success";
            $response["data"] = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }else{
            $response["status"] = "error".mysqli_error($conn);
        }
    }else{
        $response["status"] = "error".mysqli_error($conn).$sql;
    }

    echo json_encode($response);
}
