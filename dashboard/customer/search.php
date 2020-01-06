<?php
//require "init.php";
//
//if($_SERVER["REQUEST_METHOD"] == "GET"){
//    $product = "";
//    $response = array();
//    $data = "
//        <div class='row'>
//    ";
//
//    if(empty(trim($_GET["product"]))){
//    }else{
//        $product = trim($_GET["product"]);
//        $sql = "SELECT * FROM products WHERE name like '%$product%'";
//        if($result = mysqli_query($conn, $sql)){
//            if(mysqli_num_rows($result) > 0 ){
//                $response["status"] = "success";
//                while($row = mysqli_fetch_assoc($result)){
//                    $data .= "
//                    <div class='col-md-4'>
//                    <figure class='card card-product' style='padding:10px;>
//                        <div class='img-wrap'><img src='https://via.placeholder.com/150?text=product' width='100%' ></div>
//                        <figcaption class='info-wrap'>
//                                <h4 class='title'>{$row["name"]}</h4>
//                                <p class='desc'>Some small description goes here</p>
//                                <div class='rating-wrap'>
//                                    <ul class='rating-stars'>
//                                        <li style='width:80%' class='stars-active'>
//                                            <i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i>
//                                        </li>
//                                        <li>
//                                            <i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i>
//                                        </li>
//                                    </ul>
//                                    <div class='label-rating'>132 reviews</div>
//                                    <div class='label-rating'>154 orders </div>
//                                </div> <!-- rating-wrap.// -->
//                        </figcaption>
//                        <div class='bottom-wrap'>
//                                <a href='' class='btn btn-sm btn-primary float-right'>Order Now</a>
//                                <div class='price-wrap h5'>
//                                    <span class='price-new'>$1280</span> <del class='price-old'>${$row["price"]}</del>
//                                </div> <!-- price-wrap.// -->
//                        </div> <!-- bottom-wrap.// -->
//                    </figure>
//                </div>";
//                }
//            }else{
//                echo "No product";
//            }
//        }else{
//            echo mysqli_error($conn);
//        }
//    }
//
//    echo $data;
//}
//
require_once '../init.php';

if ($_SERVER['REQUEST_METHOD'] == "GET"){

    $response = [
        "status" =>"",
        "data" =>""
        ];

$name = $description = $price = $image = "";

$sql = "select p.name as product_name, p.description as description, p.unit_price as unit_price, r.selling_price as selling_price 
        from products p inner join ready_sale r on p.id = r.product_id";
if ($result = mysqli_query($conn,$sql)){
    if ($count  = mysqli_num_rows($result) > 0){
        $response ['status'] ="success";
        $response ['data'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else{
        $response ['status'] = "error".mysqli_error($conn);
    }

}else{
    $response ['status'] = "error".mysqli_error($conn);
}


echo json_encode($response);
}

?>