<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 7/29/19
 * Time: 10:23 AM
 */

require_once '../init.php';

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $response = [
        'status' =>"",
        "message" =>""
    ];

    $quantity = $fraction = $selling_price = $ready_id ="";
    $ready_id = trim($_POST['ready_id']);
    $quantity = trim($_POST['quantity']);
    $selling_price = trim($_POST['selling_price']);
    $fraction = trim($_POST['fraction']);

    $query = "update ready_sale r set r.quantity = '$quantity', r.selling_price = '$selling_price' WHERE r.id = '$ready_id' AND r.fraction= '$fraction'";

    if ($result = mysqli_query($conn, $query)){
        $response ['status'] = "success";
        $response ['message'] = "Update successful";
    }
    else{
        $response ['status'] = "error";
        $response ['message'] ="Error in update".mysqli_error($conn);
    }
    echo json_encode($response);

}