<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 7/23/19
 * Time: 11:34 AM
 */

require_once '../init.php';


if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $response = [
      'status' =>"",
      'data' =>""
    ];
    $sql = "SELECT r.id as id, p.name as product_name, p.description as description, p.available as available, p.unit_price as unit_price, p.images as
            images, r.selling_price as selling_price, r.sku as sku FROM products p INNER JOIN ready_sale r ON p.id = r.product_id";
    if ($result = mysqli_query($conn, $sql)){
        $response ['status'] = "success";
        $response ["data"] = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else{
        $response ['status'] = "error".mysqli_error($conn);
    }

    echo json_encode($response);
}