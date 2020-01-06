<?php
require "../init.php";
if ($_SERVER["REQUEST_METHOD"] == "GET" ){
    $response = [
        "status" => "",
        "message" => "",
    ];

    if(empty($_GET["name"]) || empty($_GET["product_id"])){
        $response["status"] = "error";
        $response["message"] = "could not delete the image";
    }
    else{
        $imgName = mysqli_real_escape_string($conn, $_GET["name"]);
        $productId = mysqli_real_escape_string($conn, $_GET["product_id"]);
        $sql = "SELECT images FROM products WHERE id = '$productId'";

        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0 ){
                while($row = mysqli_fetch_assoc($result)){
                    $images = $row["images"];
                }

                $images =  explode(",", $images);
                foreach ($images as $image) {
                    if($image == $imgName){
                        array_splice($images, array_search($image, $images), 1);
                        unlink("../../upload/".$image);
                    }
                }

                $imagesString = implode(",", $images);
                $updateProductSQL = "UPDATE products SET images='$imagesString' WHERE id = '$productId'";
                if($updateProduct = mysqli_query($conn, $updateProductSQL)){
                    $response["status"] = "success";
                    $response["message"] = "Image deleted";
                }else{
                    $response["status"] = "error";
                    $response["message"] = "could not delete image";
                }
            }else{
                $response["status"] = "error";
                $response["message"] = "could not delete image";
            }
        }else{
            $response["status"] = "error";
            $response["message"] = "colud not delete image";
        }
    }

    echo json_encode($response);
}