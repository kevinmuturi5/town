
<?php
require "init.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $description = $brand = $unit_price = $quantity = $sku = $size = $color = $availability = $other = $images = $unit_description = "";

    // echo $_POST["name"].$_POST["description"].$_POST["images"];
    // if(empty($_POST["product"]) || empty($_POST["description"])){
    //     echo "Cannot add product";
    // }else{
        $response = [
            "status" => "",
            "message" => ""
        ];

        $name = trim($_POST["name"]);
        $description = trim($_POST["description"]);
        $brand = trim($_POST["brand"]);
        $color = trim($_POST["color"]);
        $unit_price = trim($_POST["unit_price"]);
        $quantity = trim($_POST["quantity"]);
        $unit_description = trim($_POST["unit_description"]);
        $sku = trim($_POST["sku"]);
        $size = trim($_POST["size"]);
        $color = trim($_POST["color"]);
        $availability = trim($_POST["availability"]);
        $other_desc = trim($_POST["other"]);

        $targetDir = "../../upload/";
        $allowTypes = array('jpg','png','jpeg','gif');

        if(!empty($_FILES["images"])){
            $image_arr = array();
            // print_r ($_FILES);
            foreach ($_FILES["images"]["name"] as $key=>$val) {
                // echo $_FILES["images"]["name"][$key];

                $fileName = basename($_FILES['images']['name'][$key]);

                $targetFilePath = $targetDir . $fileName;
                // echo $targetFilePath;
                // $fileName = uniqid($fileName);
                // echo $_FILES["images"]["name"];
                // Check whether file type is valid
                // echo(file_exists($targetDir));
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                if(in_array($fileType, $allowTypes)){
                    // Upload file to server
                    if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFilePath)){
                        // Image db insert sql
                        $images .= "$fileName,";
                    }else{
                        // $errorUpload .= $_FILES['files']['name'][$key].', ';
                        $response["status"] = "error";
                        $response["message"] = "Cant upload file ".$_FILES["images"]["name"][$key];

                    }
                }else{
                    // $errorUploadType .= $_FILES['files']['name'][$key].', ';
                    $response["status"] = "error";
                    $response["message"] = "Invalid file type for ".$_FILES["images"]["name"][$key];
                }
            }
            //     if(!empty($insertValuesSQL)){
            //         $insertValuesSQL = trim($insertValuesSQL,',');
            //         // Insert image file name into database
            //         $insert = $db->query("INSERT INTO images (file_name, uploaded_on) VALUES $insertValuesSQL");
            //         if($insert){
            //             $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
            //             $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
            //             $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
            //             $statusMsg = "Files are uploaded successfully.".$errorMsg;
            //         }else{
            //             $statusMsg = "Sorry, there was an error uploading your file.";
            //         }
            //     }
            // }else{
            //     $statusMsg = 'Please select a file to upload.';
            // }
            
            // Display status message
            // echo (implode(",", $image_arr));
                $images = explode(",", $images);
                array_pop($images);
                $images = implode(",", $images);
                
                 $insert = "INSERT INTO products (name, brand, description, supplier_id, unit_description, available, quantity, unit_price, sku, images, color, size, other_desc)

                 VALUES ('$name','$brand', '$description' , '$supplier_id' , '$unit_description', '$availability', '$quantity', '$unit_price', '$sku', '$images', '$color', '$size', '$other_desc')";
                
                if($result = mysqli_query($conn, $insert)){
                    // $product_id = mysqli_insert_id($conn);
                    // $insert_details = "INSERT INTO product_descrip (color, quantity, description, product_id, images)
                    // VALUES('$color', '$quantity', '$description', '$product_id', '$images')";

                    // if($result = mysqli_query($conn, $insert_details)){
                        $response["status"] = "success";
                        $response["message"] = "Product Added successfully";
                    // }else{
                    //     echo "Failure. Cant add Desc".mysqli_error($conn);
                    // }
                }else{
                    $response["status"] = "error";
                    $response["message"] = "Product Could not be added".mysqli_error($conn);
                }
            // echo $insert;
            }else{
                $response["status"] = "error";
                $response["message"] = "Missing Images for product".mysqli_error($conn);                
            }

            echo json_encode($response);


        // $sql = "INSERT INTO products (name, price, supplier_id)
        // VALUES ('$product','$price','$supplier_id')";
        
        // $result = mysqli_query($conn, $sql);

        // if($result){
        //     $product_id = mysqli_insert_id($conn);
        //     $sql = "INSERT INTO product_description (color, size, quantity, description, product_id)
        //     VALUES ('$color','$size', '$quantity', '$description', '$product_id' )";
            
        //     if(mysqli_query($conn, $sql)){
        //         echo "Added the product_description succesfully";
        //         header("location:supplier.php");
        //     }else{
        //         echo "Could not add description".mysqli_error($conn);
        //     }
        // }else{
        //     echo "Could not add product".mysqli_error($conn);
        // }

    // $product = $description = $color = $price = $size = $quantity = "";

    // if(empty($_POST["product"]) || empty($_POST["description"]) || empty($_POST["color"]) || empty($_POST["price"])
    // || empty($_POST["size"])){
    //     echo "Cannot add product";
    // }else{
    //     $product = trim($_POST["product"]);
    //     $description = trim($_POST["description"]);
    //     $color = trim($_POST["color"]);
    //     $price = trim($_POST["price"]);
    //     $size = trim($_POST["size"]);
    //     $quantity = trim($_POST["quantity"]);

    //     $sql = "INSERT INTO products (name, price, supplier_id)
    //     VALUES ('$product','$price','$supplier_id')";
        
    //     $result = mysqli_query($conn, $sql);

    //     if($result){
    //         $product_id = mysqli_insert_id($conn);
    //         $sql = "INSERT INTO product_description (color, size, quantity, description, product_id)
    //         VALUES ('$color','$size', '$quantity', '$description', '$product_id' )";
            
    //         if(mysqli_query($conn, $sql)){
    //             echo "Added the product_description succesfully";
    //             header("location:supplier.php");
    //         }else{
    //             echo "Could not add description".mysqli_error($conn);
    //         }
    //     }else{
    //         echo "Could not add product".mysqli_error($conn);
    //     }
    // }
}
?>

