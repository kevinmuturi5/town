<?php
require_once "init.php";


if($_SERVER["REQUEST_METHOD"] == "GET"){

    $data = array();

    if(!empty(trim($_GET["product_id"]))){
        $product_id = trim($_GET["product_id"]);

        $sql = "SELECT * FROM products WHERE id = '$product_id'";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }
        }
    }

    // echo json_encode($data);
    $data = $data[0];
}

?>

<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Customer Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">

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
    <link href="../../public/css/main.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">

<?php include "../../templates/header.php"  ?>

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-md-8 m-auto">
 
                <div class="card">
                <div class="row no-gutters">
                    <aside class="col-sm-5 border-right">
                <article class="gallery-wrap"> 
                <div class="img-big-wrap">
                <div> <a href="images/items/1.jpg" data-fancybox=""><img src='https://via.placeholder.com/150?text=product' width='100%' height='100%' "></a></div>
                </div> <!-- slider-product.// -->
                
                <div class="img-small-wrap">

                </div> <!-- slider-nav.// -->
                </article> <!-- gallery-wrap .end// -->
                    </aside>
                    <aside class="col-sm-7">
                <article class="p-5">
                <h3 class="title mb-3"><?php echo $data["name"]; ?></h3>
                <div class="mb-3"> 
                <var class="price h3 text-warning"> 
                    <span class="currency">KES </span><span class="num"><?php echo $data["price"]; ?></span>
                </var> 
                <span></span> 
                </div> <!-- price-detail-wrap .// -->
                <dl>
                <dt>Description</dt>
                <dd><p><?php echo $data["name"]; ?></p></dd>
                </dl>
                <dl class="row">
                <dt class="col-sm-3">Model#</dt>
                <dd class="col-sm-9">12345611</dd>

                <dt class="col-sm-3">Color</dt>
                <dd class="col-sm-9">Black and white </dd>

                <dt class="col-sm-3">Delivery</dt>
                <dd class="col-sm-9">Russia, USA, and Europe </dd>
                </dl>
                <div class="rating-wrap">

                <ul class="rating-stars list-unstyled">
                    <li style="width:80%" class="stars-active"> 
                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> 
                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> 
                        <i class="fa fa-star"></i> 
                    </li>
                </ul>
                <div class="label-rating"><?php echo $data["orders"]; ?> orders </div>
                </div> <!-- rating-wrap.// -->
                <hr>
                <form action="placeorder.php" method="POST">
                <input  type="text" name="id" hidden value="<?php echo $data["id"]; ?>">
                <div class="row">
                    <div class="col-sm-5">
                        <dl class="dlist-inline">
                        <dt>Quantity: </dt>
                        <dd> 
                            <select name="units" class="form-control form-control-sm" style="width:70px;">
                                <option> 1 </option>
                                <option> 2 </option>
                                <option> 3 </option>
                            </select>
                        </dd>
                        </dl>  <!-- item-property .// -->
                    </div> <!-- col.// -->
                    <div class="col-sm-7">
                        <dl class="dlist-inline">
                            <dt>Size: </dt>
                            <dd>
                                <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                <span class="form-check-label">SM</span>
                                </label>
                                <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                <span class="form-check-label">MD</span>
                                </label>
                                <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                <span class="form-check-label">XXL</span>
                                </label>
                            </dd>
                        </dl>  <!-- item-property .// -->
                    </div> <!-- col.// -->
                </div> <!-- row.// -->
                <hr>
                <button id="confirmBtn" type="submit" class='btn btn-sm btn-primary openModal float-right' data-toggle='modal' data-id ='<?php echo $data["id"] ?>' data-target='#confirmOrder' type="submit" class="btn  btn-primary"> Order now </button>
                </form>
                <!-- <a href="#" class="btn  btn-outline-primary"> <i class="fas fa-shopping-cart"></i> Add to cart </a> -->
                </article> <!-- card-body.// -->
                    </aside> <!-- col.// -->
                </div> <!-- row.// -->
                </div> <!-- card.// -->                   
                </div>
            </div>

        </div>

    </main>

    <?php include "../../templates/footer.php"  ?>


    <!-- <script>
        window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>

    <script src="/docs/4.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous">
    </script> -->

    <script src="../../public/js/bootstrap.min.js"></script>


</body>

</html>
