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
    <?php include "../../templates/header.php"  ?>

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-md-8 m-auto table-responsive-sm">
                <table class="table table-bordered ">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Supplier Name</th>
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
                                <td></td>
                                <td>{$row["product_name"]}</td>
                                <td>{$row["units"]}</td>
                                <td>{$row["supplier_name"]}</td>
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
