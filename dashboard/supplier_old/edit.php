<?php

require "init.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $product = $description = $color = $price = $size = $quantity = $units_desc = $availabity = $images = "";

    // if(empty($_POST["product"]) || empty($_POST["description"])){
    //     echo "Cannot add product";
    // }else{
        $product_id = trim($_POST["id"]);
        $product = trim($_POST["name"]);
        $description = trim($_POST["description"]);
        $unit_desc = trim($_POST["unit_desc"]);
        $color = trim($_POST["color"]);
        $price = trim($_POST["price"]);
        $quantity = trim($_POST["quantity"]);
        $availability = trim($_POST["availability"]);
        $availability == "yes" ? $availability = 1 : $availability = 0;

        echo $product.$description.$unit_desc.$color.$price.$quantity.$availability.$product_id;

        // $targetDir = "../../upload/";
        // $allowTypes = array('jpg','png','jpeg','gif');

        // if(!empty($_FILES["images"])){
        //     $image_arr = array();
        //     // print_r ($_FILES);
        //     foreach ($_FILES["images"]["name"] as $key=>$val) {
        //         // echo $_FILES["images"]["name"][$key];


        //         $fileName = basename($_FILES['images']['name'][$key]);
        //         $targetFilePath = $targetDir . $fileName;
        //         // echo $targetFilePath;
        //         // Check whether file type is valid
        //         $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        //         if(in_array($fileType, $allowTypes)){
        //             // Upload file to server
        //             if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFilePath)){
        //                 // Image db insert sql
        //                 $images .= "$fileName,";
        //             }else{
        //                 // $errorUpload .= $_FILES['files']['name'][$key].', ';
        //                 echo "Error 1";
        //             }
        //         }else{
        //             // $errorUploadType .= $_FILES['files']['name'][$key].', ';
        //             echo "Error 2";
        //         }
        //     }
                
                 $update = "UPDATE products SET name = '$product', price = '$price', supplier_id = '$supplier_id',unit_description = '$unit_desc', available='$availability' WHERE id = '$product_id'";
                
                if($result = mysqli_query($conn, $update)){
                    $insert_details = "UPDATE product_description SET color = '$color', quantity = '$quantity',description = '$description' WHERE product_id = '$product_id'";

                    if($result = mysqli_query($conn, $insert_details)){
                        header("location: details.php?product_id={$product_id}");
                    }else{
                        echo "Failure. Cant Update Desc".mysqli_error($conn);
                    }
                }else{
                    echo "Failure. Cant Update product".mysqli_error($conn);
                }

            // echo $statusMsg;
            }


?>