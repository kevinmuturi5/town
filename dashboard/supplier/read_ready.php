<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 7/17/19
 * Time: 10:43 AM
 */

require_once '../init.php';

if ($_SERVER["REQUEST_METHOD"] == 'GET'){
    $response =[
        'status' =>"",
        'data' => ""
    ];
    //get prepared items
        $sql = "select p.sku as sku, p.name as product_name, p.description as description, p.images as images, 
        r.id as ready_id, r.fraction as fraction, r.product_id as id, r.selling_price as selling_price, r.quantity as quantity
        from products p 
        inner join ready_sale r on p.id = r.product_id 
        where p.supplier_id = '$supplier_id' ";

        if ($result = mysqli_query($conn,$sql)){
            if(mysqli_num_rows($result) > 0){
                $response["status"] = "success";
                $response["data"] = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }
            else{
                $response["status"] = "error".mysqli_error($conn);
            }
        }else{
            $response['status'] = "error".mysqli_error($conn).$sql;
        }

    echo json_encode($response);
}





