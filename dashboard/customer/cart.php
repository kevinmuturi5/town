<?php
///**
// * Created by PhpStorm.
// * User: nabesh
// * Date: 7/26/19
// * Time: 1:36 PM
// */
//
//require_once '../init.php';
//
//if ($_SERVER["REQUEST_METHOD"] == "GET"){
//    $id = $_GET['id'];
////    $sql = "select s.name as supplier_name, p.name as product_name, p.sku as sku, o.units as units, o.cost as cost, p.images as images
////            from products as p inner join orders as o on p.supplier_id = o.supplier_id inner join product_suppliers as s on o.supplier_id = s.id
////            where p.id = o.product_id = 12";
//
////    $sql ="select s.name as supplier_name, o.units as units, o.cost as cost, p.name as product_name, p.images as images, p.sku as sku
////    from product_suppliers s inner join orders o on s.id = o.supplier_id inner join orders o on products p on o.product_id = p.id";
//    $sql = "select s.name as supplier_name, o.units as units, o.cost as cost, p.name as product_name, p.sku as sku, p.images as images
//            from product_suppliers s INNER JOIN orders o on s.id = o.supplier_id INNER JOIN products p on o.product_id = p.id";
//    if ($result = mysqli_query($conn, $sql)){
//        if ($count = mysqli_num_rows($result) > 0){
//            while($row = mysqli_fetch_assoc($result)){
//                $data = $row;
//            }
//        }
//    }
//}
//
//
//
//
?>
</<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
        crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link href="../../public/css/main.css" rel="stylesheet">
    <link href="css/lightbox.min.css">
    <script src="script.js"></script>
    <script src="js/lightbox-plus-jquery.min.js"></script>
    <style>
        img{
            padding: 10px;
        }
        img:hover{
            transform: scale(1.1);
        }
    </style>

    <title>Cart</title>
</head>
<body>
<?php include '../../templates/header.php'?>
<div class="container-fluid">
    <div class="row">
        <table class="table-responsive table-striped table-hover table-bordered">
            <thead>
            <tr><h2>Items on Cart</h2></tr>
            <tr>
                <th>Image of product</th>
                <th>Product Name</th>
                <th>Supplier Name</th>
                <th>Number bought</th>
                <th>Price of one</th>
                <th>Total Price</th>
            </tr>
            </thead>
            <tbody id="table-result">
<!--<!--            -->--><?php ////print_r($data); ?>
<!--                <td>--><?php //echo $data['images']; ?><!--</td>-->
<!--                <td>--><?php //echo $data['product_name']; ?><!--</td>-->
<!--                <td>--><?php //echo $data['supplier_name'];?><!--</td>-->
<!--                <td>--><?php //echo $data['units']; ?><!--</td>-->
<!--                <td>--><?php
//                    $total = $data['cost'];
//                    $quant = $data['units'];
//                    $unit_price = $total / $quant;
//                    echo $unit_price;
//                    ?><!--</td>-->
<!--                <td>--><?php //echo $data['cost'];?><!--</td>-->
<!--                <td><button class="btn btn-outline-success" id="payment">Move to Check out</button></td>-->
<!---->
<!--            </tr>-->
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
