<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 7/11/19
 * Time: 11:32 AM
 */

require_once '../init.php';
global $supplier_buy_id;

function generateSKU(){
    return substr(sha1(time()), 0, 8);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplier_name = $supplier_phone = $supplier_email = $pin = $location = $sku = $product_name = $description = $quantity = $unit_description
        = $receipt_number = $unit_price = $total_price = $vat = $date_of_purchase = $time_of_purchase = "";

    $response = [
        "status" => "",
        "message" => ""
    ];


// capturing data from the ajax call on script.js
    $supplier_name = trim($_POST['supplier_name']);
    $receipt_number = trim($_POST['receipt_number']);
    $supplier_phone = trim($_POST['supplier_phone_number']);
    $supplier_email = trim($_POST['supplier_email']);
    $pin = trim($_POST['KRA_pin']);
    $location = trim($_POST['location']);
    $sku = trim($_POST['sku']);
    $product_name = trim($_POST['product_name']);
    $description = trim($_POST['description']);
    $quantity = trim($_POST['quantity']);
    $unit_description = trim($_POST['unit_description']);
    $unit_price = trim($_POST['unit_price']);
    $total_price = trim($_POST['total_price']);
    $vat = trim($_POST['vat']);
    $date_of_purchase = trim($_POST['date_of_purchase']);
    $time_of_purchase = ($_POST['time_of_purchase']);

    $month = date("m", strtotime($date_of_purchase));
    $current_month = date("m");
    $in_month = false;

    if ((int)$month < (int)$current_month) {
        $in_month = false;
    } else {
        $in_month = true;
    }

    $duplicate = false;

    //check if supplier exists by using the KRA PIN
    $sql="SELECT * FROM product_suppliers WHERE pin = '$pin'";
    if ($supplier = mysqli_query($conn, $sql)){
        if (mysqli_num_rows($supplier) > 0){
            $update_supplier = "UPDATE `product_suppliers` SET `name`='$supplier_name',`phone`= '$supplier_phone',`email`= '$supplier_email',`location`='$location',`pin`='$pin' WHERE pin = '$pin'";
            $update_supplier_details_query = mysqli_query($conn, $update_supplier);
            while ($row = mysqli_fetch_assoc($supplier)){
                $supplier_buy_id = $row["id"];
            }
            // echo $supplier_buy_id;
        
            //supplier exists so check if product exists
            $prod = "select * from products where sku = '$sku'";
            if ($result_product = mysqli_query($conn, $prod)){
                if ($count_product = mysqli_num_rows($result_product) > 0){
                    
                    //product exists so take the quantity in the inventory
                    $row = mysqli_fetch_assoc($result_product);
                    $old_quantity = $row['quantity'];
                    $new_quantity = $old_quantity + $quantity;
                    
                    //update the inventory
                    $update = "update products set quantity = '$new_quantity' where sku = '$sku'";
                    if ($update_product = mysqli_query($conn, $update)){
                        if(!empty($_POST['total_price'])){
                            //calculating unit price
                            $unit_price = $total_price / $quantity;

                        // calculating vat and sub-totals
                        if(!empty(trim($_POST["vat"]))){
                            $vat = trim($_POST["vat"]);
                            $sub_total = $total_price - $vat;
                        }
                        else{
                            $sub_total = $total_price * (100/116);
                            $vat = $total_price - $sub_total;
                        }

                        }
                        else{
                        //calculating total price
                        $total_price = $unit_price * $quantity;

                        // calculating vat and sub-totals
                        if(!empty(trim($_POST["vat"]))){
                            $vat = trim($_POST["vat"]);
                            $sub_total = $total_price - $vat;
                        }
                        else{
                            $sub_total = $total_price * (100/116);
                            $vat = $total_price - $sub_total;
                        }}
                        $add_purchase = "INSERT INTO purchases(customer_id, name, receipt_number, description, quantity, total_price, unit_price, vat, sub_total, date, time, supplier_id, sku)
                                        VALUES ('$supplier_id' ,'$product_name', '$receipt_number' ,'$description','$quantity' ,'$total_price' , '$unit_price' ,'$vat','$sub_total','$date_of_purchase', '$time_of_purchase', '$supplier_buy_id', '$sku')";
                        if($purchase = mysqli_query($conn,$add_purchase)){
                        $response ['status'] = "success";
                        $response ['message'] = "Purchase added Sucessfully";
                        }
                        else{
                            $response ['status'] = "error";
                            $response ['message'] = "Purchase not added ".mysqli_error($conn);
                        }
                        }
                        else {
                        $response ['status'] = "error";
                        $response ['message'] = mysqli_error($conn);
                    }

                    }
                else{
                    //product does not exists so add a new product
                    $insert_sku = generateSKU();
                    if(!empty($_POST['total_price'])){
                            //calculating unit price
                            $unit_price = $total_price / $quantity;

                            // calculating vat and sub-totals
                            if(!empty(trim($_POST["vat"]))){
                                $vat = trim($_POST["vat"]);
                                $sub_total = $total_price - $vat;
                            }
                            else{
                                $sub_total = $total_price * (100/116);
                                $vat = $total_price - $sub_total;
                            }

                        }
                        else{
                            //calculating total price
                            $total_price = $unit_price * $quantity;

                            // calculating vat and sub-totals
                            if(!empty(trim($_POST["vat"]))){
                                $vat = trim($_POST["vat"]);
                                $sub_total = $total_price - $vat;
                            }
                            else{
                                $sub_total = $total_price * (100/116);
                                $vat = $total_price - $sub_total;
                            }}
                    $product_new = "INSERT INTO products (name,supplier_id, unit_description,description, quantity,unit_price, sku)
                   VALUES ('$product_name', '$supplier_id','$unit_description','$description', '$quantity', '$unit_price', '$insert_sku')";
                    if ($add_new = mysqli_query($conn, $product_new)){

                        //add a purchase
                        $add_purchase3 = "INSERT INTO purchases(customer_id, name,receipt_number,description, quantity, total_price, unit_price, vat, sub_total, date, time,supplier_id, sku)
                    VALUES ('$supplier_id' ,'$product_name' , '$receipt_number' ,'$description','$quantity' ,'$total_price' , '$unit_price' ,'$vat','$sub_total','$date_of_purchase', '$time_of_purchase', '$supplier_buy_id', '$insert_sku')";
                        if ($addp = mysqli_query($conn, $add_purchase3)){
                            $response ['status'] ="success";
                            $response ['message'] = "Purchase added successfully";
                        }
                        else{
                            $response ['status'] = "error";
                            $response ['message'] = "Error! Purchase not added ".mysqli_error($conn);
                        }


                    }
                    else{
                        $response['status'] = "error";
                        $response['message'] = mysqli_error($conn);
                    }

                }
            }
            else{
                $response['status'] = "error";
                $response['message'] = mysqli_error($conn);
            }
        }
        else{
            //supplier does not exists so add a supplier
            $add_supplier  = "INSERT INTO product_suppliers(name, phone, email, location, pin)
            VALUES ('$supplier_name', '$supplier_phone','$supplier_email','$location','$pin')";
            if ($add_new_supplier = mysqli_query($conn,$add_supplier)){
                $supplier_buy_id = mysqli_insert_id($conn);

                //check if product exists in db
                $sql="select * from products where sku = '$sku'";
                if ($prod_exists = mysqli_query($conn, $sql)){
                    if ($count_prod = mysqli_num_rows($prod_exists) > 0){
                        //product exists so update inventory
                        $row = mysqli_fetch_assoc($prod_exists);
                        $old_quantity = $row['quantity'];
                        $new_quantity = $quantity + $old_quantity;
                        $update = "update products set quantity ='$new_quantity' where sku = '$sku'";


                        if(!empty($_POST['total_price'])){
                            //calculating unit price
                            $unit_price = $total_price / $quantity;

                            // calculating vat and sub-totals
                            if(!empty(trim($_POST["vat"]))){
                                $vat = trim($_POST["vat"]);
                                $sub_total = $total_price - $vat;
                            }
                            else{
                                $sub_total = $total_price * (100/116);
                                $vat = $total_price - $sub_total;
                            }

                        }
                        else{
                            //calculating total price
                            $total_price = $unit_price * $quantity;

                            // calculating vat and sub-totals
                            if(!empty(trim($_POST["vat"]))){
                                $vat = trim($_POST["vat"]);
                                $sub_total = $total_price - $vat;
                            }
                            else{
                                $sub_total = $total_price * (100/116);
                                $vat = $total_price - $sub_total;
                            }
                            
                        }

                        $add_purchase2 = "INSERT INTO purchases(customer_id, name, receipt_number ,description, quantity, total_price, unit_price, vat, sub_total, date, time, supplier_id, sku)
                                          VALUES ('$supplier_id' ,'$product_name' ,'$receipt_number', '$description','$quantity' ,'$total_price' , '$unit_price' ,'$vat','$sub_total','$date_of_purchase', '$time_of_purchase', '$supplier_id', '$sku')";
                    if ($purchase2 = mysqli_query($conn, $add_purchase2)){
                        $response['status'] = "success";
                        $response ['message'] = "Purchase added successfully";
                    }
                    else{
                        $response ['status'] = "error";
                        $response ['message'] = "Purchase not added ".mysqli_error($conn);
                    }
                    }
                    else{
                        //product does not exist so add a new product
                        $insert_sku = generateSKU();
                        if(!empty($_POST['total_price'])){
                                //calculating unit price
                                $unit_price = $total_price / $quantity;

                                // calculating vat and sub-totals
                                if(!empty(trim($_POST["vat"]))){
                                    $vat = trim($_POST["vat"]);
                                    $sub_total = $total_price - $vat;
                                }
                                else{
                                    $sub_total = $total_price * (100/116);
                                    $vat = $total_price - $sub_total;
                                }

                            }
                            else{
                                //calculating total price
                                $total_price = $unit_price * $quantity;

                                // calculating vat and sub-totals
                                if(!empty(trim($_POST["vat"]))){
                                    $vat = trim($_POST["vat"]);
                                    $sub_total = $total_price - $vat;
                                }
                                else{
                                    $sub_total = $total_price * (100/116);
                                    $vat = $total_price - $sub_total;
                                }}

                        $add_product = "INSERT INTO products (name,supplier_id, unit_description,description, quantity,unit_price, sku)
                                  VALUES ('$product_name', '$supplier_id','$unit_description','$description', '$quantity', '$unit_price', '$insert_sku')";
                        if ($add_product2 = mysqli_query($conn, $add_product)){
                            // $response ["message"] = $add_product;
                            // echo $response ["message"];

                            //add to purchases
                            $add_purchase = "INSERT INTO purchases(customer_id, name, receipt_number, description, quantity, total_price, unit_price, vat, sub_total, date, time, supplier_id, sku)
                                             VALUES ('$supplier_id' ,'$product_name','$receipt_number' ,'$description','$quantity' ,'$total_price' , '$unit_price' ,'$vat','$sub_total','$date_of_purchase', '$time_of_purchase', '$supplier_buy_id', '$insert_sku')";
                                if ($query_add_purchase = mysqli_query($conn, $add_purchase)){
                                    $response ['status'] = "success";
                                    $response ['message'] = "Purchase added successfully";
                                }
                                else{
                                    $response ['status'] = "error";
                                    $response ['message'] = "Purchase not added";
                                }


                        }
                        else{
                            $response['status'] = "error";
                            $response ["message"] = mysqli_error($conn);
                        }

                    }

                }else{
                    $response ['status'] = "error";
                    $response ['message'] = mysqli_error($conn);
                }


            }
            else{
                $response ['status'] = "error";
                $response ['message'] = mysqli_error($conn);
            }
        }
    }
    else{
        $response ['status'] = "error";
        $response ['message'] = mysqli_error($conn);
    }




echo json_encode($response);
}