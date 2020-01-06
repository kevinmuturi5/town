<?php
require "init.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $data = "
        <div class='row'>
    ";
        $product = trim($_GET["product"]);
        $sql = "SELECT * FROM products";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0 ){
                $response["status"] = "success";
                while($row = mysqli_fetch_assoc($result)){
                    $data .= "
                    <div class='col-md-4'>
                    <form action='details.php' method='GET'>
                    <figure class='card card-product' style='padding:10px;'>
                        <div class='img-wrap'><img src='https://via.placeholder.com/150?text=product' width='100%' /></div>
                        <figcaption class='info-wrap'>
                                <input type='text' name='product_id' value='{$row["id"]}' hidden>
                                <h4 class='title'>{$row["name"]}</h4>
                                <p class='desc'>Some small description goes here</p>
                                <div class='rating-wrap'>
                                    <ul class='rating-stars'>
                                        <li style='width:80%; list-style:none' class='stars-active'> 
                                            <i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i>
                                        </li>
                                    </ul>
                                    <div class='label-rating'>132 reviews</div>
                                    <div class='label-rating'>154 orders </div>
                                </div> <!-- rating-wrap.// -->
                        </figcaption>
                        <div class='bottom-wrap'>
                                <button id='' type='submit' class='btn btn-sm btn-primary float-right'>
                                Order Now
                                </button>
                                <div class='price-wrap h5'>
                                    <span class='price-new'>$1280</span> <del class='price-old'>${$row["price"]}</del>
                                </div> <!-- price-wrap.// -->
                        </div> <!-- bottom-wrap.// -->
                    </figure>
                    </form>
                </div>";
                }
            }else{
                echo "No products found";
            }
        }else{
            echo mysqli_error($conn);
        }

    $data .= "
        </div> 
    ";
    echo $data;
}
?>