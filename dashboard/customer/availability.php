<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 7/31/19
 * Time: 4:38 PM
 */

require_once '../init.php';
 if ($_SERVER ['REQUEST_METHOD'] == "POST"){
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

     //checking if quantity in ready sale table is enough for sale
     $check = "select quantity from ready_sale where product_id = '$product_id'";
     if ($query = mysqli_query($conn, $check)){
         if ($count = mysqli_num_rows($query) > 0){
             if ($row = mysqli_fetch_assoc($query)) {
                 if ($units <= $row['quantity']) {
                     $response ['status'] = "success";
                     $response ['message'] = 'Enough to buy';

                 }else{
                     $response ['status'] = "error";
                     $response ['message'] = 'Sold Out!!..';
                 }
             }
             else{
                 $response ['status'] = "error";
                 $response ['message'] = mysqli_error($conn);
             }
         }
         else{
             $response ['status'] = "error";
             $response ['message'] = mysqli_error($conn);
         }
     }
     else{
         $response ['status'] = "error";
         $response ['message'] = mysqli_error($conn);
     }



     echo json_encode($response);
 }