<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 8/5/19
 * Time: 9:14 AM
 */
require_once 'config/database.php';

if ($_SERVER ['REQUEST_METHOD'] == "GET"){
    $response = [
        "status" =>"",
        "data" => ""
    ];
    if(!empty($_GET["search"])) {
        $search_word = trim($_GET['search']);
        $sql = "SELECT r.id as id, p.name as product_name, p.description as description, p.available as available, p.unit_price as unit_price, 
            p.images as images, r.selling_price as selling_price, r.sku as sku FROM products p 
            INNER JOIN ready_sale r ON p.id = r.product_id where p.name like '%$search_word%'";
        if ($result = mysqli_query($conn, $sql)) {
            $response ['status'] = "success";
            $response ['data'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            $response ['status'] = "error ".mysqli_error($conn);
        }
    }else{
        $response ['status'] = "error ".mysqli_error($conn);
    }
    echo json_encode($response);
}