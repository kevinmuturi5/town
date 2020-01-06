
<?php
require "init.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $product_id = $name = $description = $brand = $unit_price = $quantity = $sku = $size = $color = $availability = $other = $images = $unit_description = "";
    
        $response = [
            "status" => "",
            "message" => ""
        ];

        $product_id = trim($_POST["product_id"]);
        $name = trim($_POST["name"]);
        $description = trim($_POST["description"]);
        $brand = trim($_POST["brand"]);
        $unit_price = trim($_POST["unit_price"]);
        $quantity = trim($_POST["quantity"]);
        $unit_description = trim($_POST["unit_description"]);
        $sku = trim($_POST["sku"]);
        $size = trim($_POST["size"]);
        $color = trim($_POST["color"]);
        $availability = trim($_POST["availability"]);
        $other_desc = trim($_POST["other"]);

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
        //         // $fileName = uniqid($fileName);

        //         // Check whether file type is valid
        //         $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        //         if(in_array($fileType, $allowTypes)){
        //             // Upload file to server
        //             if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFilePath)){
        //                 // Image db insert sql
        //                 $images .= "$fileName,";
        //             }else{

        //                 $response["status"] = "error";
        //                 $response["message"] = "Cant upload file ".$_FILES["images"]["name"][$key];

        //             }
        //         }else{

        //             $response["status"] = "error";
        //             $response["message"] = "Invalid file type for ".$_FILES["images"]["name"][$key];
        //         }
        //     }

        //          $insert = "INSERT INTO products (name, description, supplier_id, unit_description, available, quantity, unit_price, sku, images, color, size, other_desc)

        //          VALUES ('$name', '$description' , '$supplier_id' , '$unit_description', '$availability', '$quantity', '$unit_price', '$sku', '$images', '$color', '$size', '$other_desc')";
                
        //         if($result = mysqli_query($conn, $insert)){
        //                 $response["status"] = "success";
        //                 $response["message"] = "Product Added successfully";
        //         }else{
        //             $response["status"] = "error";
        //             $response["message"] = "Product Could not be added";
        //         }

        //     }else{
            
            //Update With missing images
            $sql = "UPDATE products SET name = '$name', description = '$description', unit_description = '$unit_descritpion', available ='$availability', quantity='$quantity', unit_price='$unit_price', sku='$sku', color='$color', size='$size', other_desc='$other_dec' WHERE id = '$product_id'";

                if($result = mysqli_query($conn, $sql)){
                    $response["status"] = "success";
                    $response["message"] = "Product Updated successfully";
                }else{
                    $response["status"] = "error";
                    $response["message"] = mysqli_error($conn);                    
                }

            echo json_encode($response);

}
?>

