<?php
require_once "init.php";


// if($_SERVER["REQUEST_METHOD"] == "GET"){

//     $data = array();

//     if(!empty(trim($_GET["product_id"]))){
//         $product_id = trim($_GET["product_id"]);

//         $sql = "SELECT * FROM products WHERE id = '$product_id'";
//         if($result = mysqli_query($conn, $sql)){
//             if(mysqli_num_rows($result) > 0){
//                 $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
//             }
//         }
//     }

//     // echo json_encode($data);
//     $data = $data[0];
// }

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
            <a class="navbar-brand" href="supplier.php">
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
                <div class="col-md-8 m-auto table-responsive-sm">
                    <div class="card">
                    <table class="table table-hover shopping-cart-wrap">
                    <thead class="text-muted">
                    <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Customer</th>
                    <th scope="col" width="120">Quantity</th>
                    <th scope="col" width="120">Price</th>
                    <th scope="col" width="200" class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT o.units as units, c.name as customer_name, p.name as product_name, s.name as supplier_name
                    FROM orders o
                    INNER JOIN customers c ON o.customer_id=c.id
                    INNER JOIN products p ON o.product_id = p.id
                    INNER JOIN suppliers s ON o.supplier_id = s.id
                    ";
                    // $sql = "SELECT * FROM orders";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo "
                                <tr>
                                <td>
                                <figure class='media'>
                                    <div class='img-wrap'><img src='https://fakeimg.pl/150/?text=product' class='img-thumbnail img-sm'></div>
                                    <figcaption class='media-body'>
                                        <h6 class='title text-truncate'>{$row["product_name"]}</h6>
                                        <dl class='dlist-inline small'>
                                        <dt>Size: </dt>
                                        <dd>XXL</dd>
                                        </dl>
                                        <dl class='dlist-inline small'>
                                        <dt>Color: </dt>
                                        <dd>Orange color</dd>
                                        </dl>
                                    </figcaption>
                                <figure>
                                    <td>
                                        <h5>{$row["customer_name"]}</h5>
                                    </td>
                                </figure>
                                </figure> 
                                    </td>
                                    <td>{$row["units"]}  </td> 
                                    <td> 
                                        <div class='price-wrap'> 
                                            <var class='price'>{$row["price"]}</var> 
                                            <small class='text-muted'>(USD10 each)</small> 
                                        </div> <!-- price-wrap .// -->
                                    </td>
                                    <td class='text-right'> 
                                    <a title='' href='' class='btn btn-outline-success' data-toggle='tooltip' data-original-title='Save to Wishlist'> <i class='fa fa-heart'></i></a> 
                                    <a href='' class='btn btn-outline-danger btn-round'> + Accept</a>
                                    </td>
                                </tr>";
                            }
                        }else{
                            echo mysqli_error($conn);
                        }
                    }else{
                        echo mysqli_error($conn);
                    }
                    
                    ?>
                    </tbody>
                    </table>
                    </div> <!-- card.// -->

                    </tbody>
                </table>                 
                </div>
            </div>

        </div>

    </main>

    <footer class="footer mt-auto py-3">
        <div class="container">
            <span class="text-muted">Place sticky footer content here.</span>
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
