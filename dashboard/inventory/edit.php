<?php
require "../init.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $product = $description = $color = $price = $size = $quantity = $units_desc = $availabity = $images = "";

    // if(empty($_POST["product"]) || empty($_POST["description"])){
    //     echo "Cannot add product";
    // }else{
        $response = [
            "status" => "",
            "message" => ""
        ];

        $product_id = trim($_POST["product_id"]);
        $product = trim($_POST["name"]);
        $description = trim($_POST["description"]);
        $unit_desc = trim($_POST["unit_description"]);
        $color = trim($_POST["color"]);
        $size = trim($_POST["size"]);
        $price = trim($_POST["price"]);
        $quantity = trim($_POST["quantity"]);
        $price = trim($_POST["unit_price"]);
        $brand = trim($_POST["brand"]);
        $other = trim($_POST["other"]);
        $availability = trim($_POST["availability"]);
        $availability == "yes" ? $availability = 1 : $availability = 0;
        $availability == "no" ? $availability = 0 : $availability = 1;
        $availability == "" ? $availability = 1 : $availability = 0;

        $targetDir = "../../upload/";
        $allowTypes = array('jpg','png','jpeg','gif');

        $fetch_images = "SELECT images FROM products WHERE id='$product_id' AND supplier_id='$supplier_id'";
                
        if($check_images = mysqli_query($conn, $fetch_images)){
            if(mysqli_num_rows($check_images) > 0 ){
                while($row = mysqli_fetch_assoc($check_images)){
                    $existing_images = $row["images"];

                }
            }
            if(!empty($_FILES["images"])){
                $image_arr = array();
    
                foreach ($_FILES["images"]["name"] as $key=>$val) {
                    $fileName = basename($_FILES['images']['name'][$key]);
                    $targetFilePath = $targetDir . $fileName;
                    // echo $targetFilePath;
                    // Check whether file type is valid
                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                    if(in_array($fileType, $allowTypes)){
                        // Upload file to server
                        if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFilePath)){
                            // Image db insert sql
                            $images .= "$fileName,";
                        }else{
                            echo "Error 1";
                        }
                    }else{
                        echo "Error 2";
                    }
                }
            }


            if(strlen($images) > 0){
                if($existing_images != ""){
                    $images .= $existing_images;    
                }
                $images = rtrim($images,",");
                // images = '$  images',
            }else{
                if($existing_images != ""){
                    $images .= $existing_images;    
                }else{
                    $images .= $existing_images;
                }
            }

        }

        $update = "UPDATE products SET name = '$product', unit_price ='$price', brand = '$brand', unit_description = '$unit_desc',available='$availability', color = '$color', size = '$size', quantity = '$quantity', images = '$images',  other_desc = '$other', description = '$description' WHERE id = '$product_id' AND supplier_id = '$supplier_id' ";
            
        if($result = mysqli_query($conn, $update)){
            $response["status"] = "success";
            $response["message"] = "Product Updated successfully";
        }
        else{
            $response["status"] = "error";
            $response["message"] = "Product Could not be Updated.".mysqli_error($conn);
            }
        echo json_encode($response);
    }


?>