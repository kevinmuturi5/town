<?php
require "config/database.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $data = "<div class='row'>";
        $product = trim($_POST["product"]);
        $sql = "SELECT p.id, p.name, p.price, p.available, d.description 
        FROM products p
        INNER JOIN product_description d ON p.id = d.product_id
        WHERE p.name like '%$product%'";

?>

<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title><?php echo $product?>|Willie Scant Ltd.</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="public/css/main.css" rel="stylesheet">
    <link href="public/css/ui-kit.css" rel="stylesheet">
    <script src="public/js/script.js"></script>

</head>
<body class="d-flex flex-column h-100">

<?php  include_once("templates/header.php")  ?>
   <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-md-10 col-sm-12 m-auto">

                <div class="row mt-5">

                <?php
                        if($result = mysqli_query($conn, $sql)){
                                if(mysqli_num_rows($result) > 0 ){
                                    $response["status"] = "success";
                                    while($row = mysqli_fetch_assoc($result)){
                                        if($row["available"] == 0){
                                            $availability = "Available";
                                        }else {
                                            $availability = "Available";
                                            
                                        }
                                    echo " 
                                    <div class='col-md-4'>
                                    <figure class='card card-product'>
                                        <div class='img-wrap'><img class='mt-2 mb-3 rounded' src='https://fakeimg.pl/220/?text=product'></div>
                                        <figcaption class='info-wrap'>
                                                <h4 class='title'>{$row["name"]}</h4>
                                                <p class='desc'>{$row["description"]}</p>
                                                <p class='desc'>{$availability}</p>
                                                <div class='rating-wrap'>
                                                    <ul class='rating-stars'>
                                                        <li style='width:80%' class='stars-active'> 
                                                            <i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i>
                                                        </li>
                                                        <li>
                                                            <i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> 
                                                        </li>
                                                    </ul>
                                                    <div class='label-rating'>132 reviews</div>
                                                    <div class='label-rating'>154 orders </div>
                                                </div> <!-- rating-wrap.// -->
                                        </figcaption>
                                        <form action='check_orders.php' method='POST'>
                                        <div class='bottom-wrap'>
                                        <input type='text' value='{$row["id"]}' name='product_id' hidden>
                                            <button type='submit' href='' class='btn btn-sm btn-primary float-right'>Details</button>	
                                            <div class='price-wrap h5'>
                                                <span class='price-new'>KSH {$row["price"]}</span>
                                                <del class='price-old'>KSH 19</del>
                                                <a href='' class='btn btn-sm btn-primary float-right mr-2'>Order Now</a>	
                                            </div> <!-- price-wrap.// -->
                                        </div> <!-- bottom-wrap.// -->
                                        </form>
                                    </figure>
                                </div> <!-- col // -->";

                                    }
                                }else{
                                    echo "No products found";
                                }
                            }else{
                                echo mysqli_error($conn);
                            }

                        // echo $data;
                    }
                    ?>

                    <div class='col-md-4'>
                        <figure class='card card-product'>
                            <div class='img-wrap'><img src='https://fakeimg.pl/220/?text=product'></div>
                            <figcaption class='info-wrap'>
                                    <h4 class='title'>Another name of item</h4>
                                    <p class='desc'>Some small description goes here</p>
                                    <p class='desc'>Availability</p>
                                    <div class='rating-wrap'>
                                        <ul class='rating-stars'>
                                            <li style='width:80%' class='stars-active'> 
                                                <i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i>
                                            </li>
                                            <li>
                                                <i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> 
                                            </li>
                                        </ul>
                                        <div class='label-rating'>132 reviews</div>
                                        <div class='label-rating'>154 orders </div>
                                    </div> <!-- rating-wrap.// -->
                            </figcaption>
                            <div class='bottom-wrap'>
                                <a href='' class='btn btn-sm btn-primary float-right'>Order Now</a>	
                                <div class='price-wrap h5'>
                                    <span class='price-new'>$1280</span> <del class='price-old'>$1980</del>
                                </div> <!-- price-wrap.// -->
                            </div> <!-- bottom-wrap.// -->
                        </figure>
                    </div> <!-- col // -->



                    </div> <!-- row.// -->

                </div>
            </div>

        </div>

    </main>
<?php include "templates/footer.php" ?>
<script src="public/js/bootstrap.min.js"></script>

</body>