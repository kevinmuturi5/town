<?php
require_once "init.php";


if($_SERVER["REQUEST_METHOD"] == "GET"){

    $data = array();

    if(!empty(trim($_GET["product_id"]))){
        $product_id = trim($_GET["product_id"]);

        $sql = "SELECT p.name, p.price, p.unit_description, p.available, d.color, d.quantity, d.description, d.images FROM products p
        INNER JOIN product_description d ON p.id = d.product_id
        WHERE p.id = '$product_id'";

        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }
        }
    }

    // echo json_encode($data);
    $data = $data[0];
    if($data["images"]){
        $src = explode( ",", $data["images"]);
    }else{
        $src = "https://fakeimg.pl/350x200/?text=product";        
    }
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
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
            <a class="navbar-brand" href="#">
                <img src="../../public/img/LOGO.png" width="50px" height="50px" alt="Homepage">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="supplier.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active mr-4">
                        <a class="nav-link" href="orders.php">Orders</a>
                    </li>

                    <li class="nav-item active mr-4">
                        <a class="nav-link" href="../../auth/logout.php">Logout</a>
                    </li>

                    <li class="nav-item ml-auto">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">
                            <img src="../../public/img/services.png" width="20px" height="20px" alt="">
                        </a>
                    </li>

                </ul>
                <!-- <form class="form-inline mt-2 mt-md-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form> -->
            </div>
        </nav>
    </header>

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-md-8 m-auto">
                <form action="edit.php" method="POST">
                <div class="card">
                <div class="row no-gutters">
                    <aside class="col-sm-5 border-right">
                <article class="gallery-wrap"> 
                <div class="img-big-wrap">
                <div> <a href="<?php echo "../../upload/{$src[1]}"; ?>" data-fancybox=""><img src='<?php echo "../../upload/{$src[1]}"; ?>' width='100%' height='100%' "></a></div>
                </div> <!-- slider-product.// -->
                
                <div class="img-small-wrap mt-3">
                    <img src='<?php echo "../../upload/{$src[2]}"; ?>' width='100%' height='100%'">
                    <input type="file" name="images[]" multiple>
                </div> <!-- slider-nav.// -->
                </article> <!-- gallery-wrap .end// -->
                </aside>

                <aside class="col-sm-7">
                <article class="p-5">
                <label class="form-check-label" for="name">Name</label>
                <input class="form-control" type="text" name="name" value="<?php echo $data["name"]; ?>" >
                <div class="mt-3 mb-3"> 
                    <label class="form-check-label" for="price">Price </label>
                    <input name="price" class="form-control" type="text" value="<?php echo $data["price"];?>">
                <span></span> 
                </div> <!-- price-detail-wrap .// -->
                <dl>
                <dt>Description</dt>
                <dd><p><textarea class="form-control" type="text" name="description"><?php echo $data["description"]; ?></textarea></p></dd>
                </dl>
                <dl class="row">
                <dt class="col-sm-3">Model#</dt>
                <dd class="col-sm-9">12345611</dd>

                <dt class="col-sm-3">Color</dt>
                <dd class="col-sm-9"><input class="form-control" type="text" name="color" value="<?php echo $data["color"] ?>" ></dd>

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
                <input  type="text" name="id" hidden value="<?php echo $product_id; ?>">
                <div class="row">
                    <div class="col-sm-5">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" name="quantity" value="<?php echo $data["quantity"] ?>">
                    </div> <!-- col.// -->
                    <div class="col-sm-5">
                        <label for="unit_desc">Units Description</label>
                        <textarea type="text" class="form-control" name="unit_desc">
                            <?php echo $data["unit_description"] ?>
                        </textarea>
                    </div>
                    <div class="col-sm-7 mt-4">
                        <label for="available">Available </label>
                        <input type="radio" name="available" checked="checked" value="yes"> Yes
                        <input class="ml-3" type="radio" name="availability" value="no"> No<br>
                    </div> <!-- col.// -->
                </div> <!-- row.// -->
                <hr>
                <button id="confirmBtn" type="submit" class='btn btn-sm btn-primary openModal float-right' data-toggle='modal' data-id ='<?php echo $data["id"] ?>' data-target='#confirmOrder' type="submit" class="btn  btn-primary"> Confirm Edit </button>
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

    <footer class="footer mt-auto py-3">
        <div class="container">
            <span class="text-muted">Place sticky footer content here.</span>
            <?php 
            print_r($data["images"]);           
            ?>
        </div>
    </footer>

    <!-- <script>
        window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>

    <script src="/docs/4.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous">
    </script> -->

    <script src="../../public/js/bootstrap.min.js"></script>


</body>

</html>
