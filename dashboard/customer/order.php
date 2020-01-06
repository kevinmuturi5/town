<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 7/26/19
 * Time: 7:31 AM
 */

require_once '../init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $response = [
        "status" => "",
        "message" => ""
    ];
    //variable declaration
    $customer_id = $product_id = $units = $supplier_id = $unit_description = $cost = "";
    $customer_id = $_SESSION['id'];

    //getting data from javascript
    $product_id = trim($_POST['pid']);
    $units = trim($_POST['units']);
    $supplier_id = trim($_POST['supplier_id']);
    $cost = trim($_POST['cost']);

    //Checking if quantity is enough for sale
    $check = "select quantity from ready_sale where product_id = '$product_id'";
    if ($quantity_in_ready_sale = mysqli_query($conn, $check)){
       if ($count = mysqli_num_rows($quantity_in_ready_sale) > 0) {

           if ($row = mysqli_fetch_assoc($quantity_in_ready_sale)) {

               if ($units <= $row['quantity']) {

                   //subtract from ready sale
                   $remain = $row["quantity"] - $units;

                   //update ready sale
                   $update = "update ready_sale set quantity = '$remain' where product_id = '$product_id'";
                   if ($sql2 = mysqli_query($conn, $update)) {

                       //insert into orders
                       $sql = "insert into orders (`id`, `customer_id`, `product_id`, `units`, `supplier_id`, `cost`)
                        values (null,'$customer_id', '$product_id', '$units', '$supplier_id', '$cost')";
                       if ($query = mysqli_query($conn, $sql)) {
                           $response['status'] = "success";
                           $response ['message'] = 'Order taken sucessfully';
                       } else {
                           $response ['status'] = "error";
                           $response ['message'] = "Order not taken";
                       }

                   } else {
                       $response ['status'] = "error" . mysqli_error($conn);
                   }
               } else {
                   $response ['status'] = "error";
                   $response ['message'] = "Sold out!!";
               }
           } else {
               $response ['status'] = "error" . mysqli_error($conn);
           }
       }else{
           $response ['status'] = "error".mysqli_error($conn);
       }
    }
    else{
        $response ['status'] = "error".mysqli_error($conn);
    }


echo json_encode($response);
}