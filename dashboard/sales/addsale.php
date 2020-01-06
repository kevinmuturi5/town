<?php
require_once "../init.php";

//Function to convert decimal to fraction for a humnan readable storage in database. 
// !!Dont touch copied from stackoverflow
function float2rat($n, $tolerance = 1.e-6) {
    $h1=1; $h2=0;
    $k1=0; $k2=1;
    $b = 1/$n;
    do {
        $b = 1/$b;
        $a = floor($b);
        $aux = $h1; $h1 = $a*$h1+$h2; $h2 = $aux;
        $aux = $k1; $k1 = $a*$k1+$k2; $k2 = $aux;
        $b = $b-$a;
    } while (abs($n-$h1/$k1) > $n*$tolerance);

    return "$h1/$k1";
}


if($_SERVER["REQUEST_METHOD"] == "POST"){    
    $name = $unit_price = $quantity = $sku = $vat = $receipt_id = $sub_total = $fraction = "";

    $response = [
        "status" => "",
        "message" => ""
    ];

    $name = trim($_POST["name"]);
    $unit_price = trim($_POST["unit_price"]);
    $quantity = trim($_POST["quantity"]);
    $sku = mysqli_escape_string($conn, trim($_POST["sku"]));
    $receipt_id = trim($_POST["receipt_id"]);
    $vat = trim($_POST["vat"]);
    $fraction = trim($_POST["fraction"]);

    if(isset($unit_price) && isset($quantity)){
        $sub_total = $unit_price * $quantity;
        if(empty($vat)){
            $vat = ($sub_total * (116/100)) - $sub_total;
        }
    }else{
      $response["status"] = "error";
      $response["message"] = "Could not add this sale. Add quantity/Unit price to continue";
      exit();
    }
    
    $text_fraction = float2rat($fraction);
    $fract_arr = explode("/", $text_fraction);
    $check_ready = "SELECT * FROM ready_sale WHERE sku='$sku' AND fraction='$text_fraction'";
    $result = mysqli_query($conn, $check_ready);
    if($result){
        if(mysqli_num_rows($result) > 0 ){
            while($row = mysqli_fetch_assoc($result)){ 
                //Check Quantity in ready_sales table .....
                if($row["quantity"] > 0 && $row["quantity"] >= $quantity){
                    $add_sale = "INSERT INTO sales(receipt_id, product_name, sku, fraction, quantity, unit_price, sub_total, vat, supplier_id)
                    VALUES('$receipt_id','$name','$sku','$text_fraction','$quantity','$unit_price','$sub_total','$vat','$supplier_id')";

                    if($add_sale = mysqli_query($conn, $add_sale)){
                        $new_quantity = $row["quantity"] - $quantity;
                        $update_ready = "UPDATE ready_sale SET quantity='$new_quantity' WHERE sku='$sku' AND fraction ='$text_fraction'";
                        $updated_ready = mysqli_query($conn, $update_ready);
                        
                        if($updated_ready){
                            $check_inventory = "SELECT * FROM products WHERE sku='$sku' AND supplier_id = '$supplier_id'";
                            if($res = mysqli_query($conn, $check_inventory)){
                                if(mysqli_num_rows($res) > 0){
                                    while($row = mysqli_fetch_assoc($res)){
                                        $product_quantity = $row["quantity"];
                                    }
                                    $product_quantity = $product_quantity - (( (int)$fract_arr[0]/(int)$fract_arr[1]) * $quantity);
                                    $update_inventory = "UPDATE products SET quantity='$product_quantity' WHERE sku='$sku' AND supplier_id='$supplier_id'";
                                    if($inventory_updated = mysqli_query($conn, $update_inventory)){
                                        // Sale add successfull and Inventory is updated
                                        $response["status"] = "success";
                                        $response["message"] = "Sale added successfully";
                                    }else{
                                        //Handle successfull sale add but failure in updating inventory
                                        $last_id = mysqli_insert_id($conn); 
                                        $roll_back = "DELETE * FROM sales WHERE id='$last_id'";
                                        if($rollback = mysqli_query($conn, $roll_back)){
                                            $response["status"] = "error";
                                            $response["message"] = "Error updating the inventory ..rolling back";
                                        } 
                                    }
                                }else{
                                    // Sale add successfull and Inventory is updated
                                    $response["status"] = "error";
                                    $response["message"] = "Error Inventory could not be updated";
                                }
                            }else{
                                // Sale add successfull and Inventory is updated
                                $response["status"] = "error";
                                $response["message"] = "Error Inventory could not be updated";  
                            }

                        }else{
                            //Handle successfull sale add but failure in updating inventory
                            $last_id = mysqli_insert_id($conn); 
                            $roll_back = "DELETE * FROM sales WHERE id='$last_id'";
                            if($rollback = mysqli_query($conn, $roll_back)){
                                $response["status"] = "error";
                                $response["message"] = "Error updating the inventory ..rolling back";
                            }
                        }
                    }else{
                        $response["status"] = "error";
                        $response["message"] = "Error adding this sale. Try again".mysqli_error($conn);                        
                    }
                }else{
                    $response["status"] = "error";
                    $response["message"] = "Error adding this sale. The sale quantity is greater than prepared quantity";
                }
            }
        }else{
            $response["status"] = "error";
            $response["message"] = "Error. You tried to add a sale for a product that does not exist in your inventory";
        }
    }else{
        $response["status"] = "error";
        $response["message"] = "Error. This product does not exist in your inventory";
    }

    echo json_encode($response);
}
?>

