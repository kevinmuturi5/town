<?php
require_once "../init.php";

//Function to convert decimal to fraction for a humnan readable storage in database
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
    $response = [
        "status" => "",
        "message" => ""
    ];

    $product_id = $fraction = $buying_price = $selling_price = $sku = $quantity = "";


    // print_r($response);#
    if(isset($_POST["product_id"])){
        $product_id = $_POST["product_id"]; 
        $fraction = $_POST["fraction"]; 
        $buying_price = $fraction * $_POST["buying_price"]; 
        $selling_price = $fraction * $_POST["selling_price"]; 
        $sku = $_POST["sku"]; 
        $quantity = intval($_POST["quantity"]); 

        $requested_quantity = $fraction * $quantity;

        $check_quantity = "SELECT quantity FROM products WHERE id='$product_id'";
        $fraction = float2rat($fraction);
        if($quantity_ok = mysqli_query($conn, $check_quantity)){
            if(mysqli_num_rows($quantity_ok) > 0){
                while($row = mysqli_fetch_assoc($quantity_ok)){
                    $available_quantity = $row["quantity"];
                }
                if($requested_quantity <= $available_quantity){
                    //Requested quantity is less than or equal to quantity in store

                    $check_ready = "SELECT fraction, quantity FROM ready_sale WHERE product_id = '$product_id'";
                    if($product_ready = mysqli_query($conn, $check_ready)){
                        if(mysqli_num_rows($product_ready) > 0){
                            //The preduct is already in store
                            while ($row = mysqli_fetch_assoc($product_ready)){
                                $ready_fraction = $row["fraction"];
                                $ready_quantity = $row["quantity"];
                            }
                            if($ready_fraction == $fraction){
                                $updated_quantity = $ready_quantity + $quantity;
                                //A similar fraction already exists in Prepared sales. Update the fraction quantity instead
                                $sql = "UPDATE ready_sale SET quantity = '$updated_quantity', selling_price='$selling_price', buying_price='$buying_price' WHERE product_id='$product_id' AND fraction = '$fraction'";

                                if($result = mysqli_query($conn, $sql)){
                                    $response["status"] = "success";
                                    $response["message"] = "Success Product is now ready for sale";
                                }else{
                                    $response["status"] = "error";
                                    $response["message"] = "Error! Could prepare this item for sale. Try again".mysqli_error($conn);        
                                } 
                            }else{
                                $sql = "INSERT INTO ready_sale SET fraction = '$fraction', quantity = '$quantity', selling_price='$selling_price', buying_price='$buying_price', sku='$sku', product_id='$product_id'";

                                if($result = mysqli_query($conn, $sql)){
                                    $response["status"] = "success";
                                    $response["message"] = "Success Product is now ready for sale";
                                }else{
                                    $response["status"] = "error";
                                    $response["message"] = "Error! Could prepare this item for sale. Try again".mysqli_error($conn);        
                                } 
                            }
                        }else{
                            $sql = "INSERT INTO ready_sale SET fraction = '$fraction', quantity = '$quantity', selling_price='$selling_price', buying_price='$buying_price', sku='$sku', product_id='$product_id'";

                            if($result = mysqli_query($conn, $sql)){
                                $response["status"] = "success";
                                $response["message"] = "Success Product is now ready for sale";
                            }else{
                                $response["status"] = "error";
                                $response["message"] = "Error! Could prepare this item for sale. Try again".mysqli_error($conn);        
                            } 
                        }
                    }else{
                        $response["status"] = "error";
                        $response["message"] = "Error! Could prepare this item for sale. Try again".mysqli_error($conn);
                    }
                }else{
                    $response["status"] = "error";
                    $response["message"] = "Error! Requested Quantity exceeds the amount in your Inventory. You requested ".$requested_quantity." units but only ".$available_quantity." units are available";  
                }
            }else{
                $response["status"] = "error";
                $response["message"] = "Error! You do not have this product in your Inventory"; 
            }
        }else{
            $response["status"] = "error";
            $response["message"] = "Error! Could prepare this item for sale. Try again".mysqli_error($conn);  
        }
        echo json_encode($response);
    }else{
        $response["status"] = "error";
        $response["message"] = "Error! Could prepare this item for sale. Try again".mysqli_error($conn);  
    }

}

?>