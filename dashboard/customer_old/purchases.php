<?php
require_once "init.php";
$customer_id = $_SESSION["id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchases</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/main.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</head>
<body>
    <?php include "../../templates/header.php"  ?>

<main class="main">
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-sm-12 m-auto">
                <table class="table tbale-responsive table-striped">
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>Supplier Name</th>
                            <th>KRA PIN</th>
                            <th>Supplier Location</th>
                            <th>Product Name</th>
                            <th>Product Description</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Sub Total</th>
                            <th>VAT</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $vat_total = $price_total = $sub_total = $count = 0;
                            $count = 1;
                            $sql = "SELECT p.id as id, s.name as supplier_name, s.pin as pin, s.location as location, p.name as product_name, p.description as description, p.quantity as quantity, p.unit_price as unit_price, p.total_price as total_price, p.sub_total as sub_total, p.vat as vat, p.date as date 
                            FROM purchases p
                            INNER JOIN product_suppliers s ON p.supplier_id = s.id 
                            WHERE customer_id = '$customer_id' ";

                            if($result = mysqli_query($conn, $sql)){
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo "<tr>
                                            <td>{$count}</td>
                                            <td>{$row["supplier_name"]}</td>
                                            <td>{$row["pin"]}</td>
                                            <td>{$row["location"]}</td>
                                            <td>{$row["product_name"]}</td>
                                            <td>{$row["description"]}</td>
                                            <td>{$row["quantity"]}</td>
                                            <td>{$row["unit_price"]}</td>
                                            <td>{$row["sub_total"]}</td>
                                            <td>{$row["vat"]}</td>
                                            <td>{$row["total_price"]}</td>";
                                            $vat_total += $row["vat"] + $vat_total;
                                            $price_total += $row["total_price"] + $price_total;
                                            $sub_total += $row["sub_total"] + $sub_total;
                                            $count += 1;
                                    }
                                }
                            }else{
                                echo mysqli_error($conn);
                            }
                        ?>
                        <tr class="mt-3">
                            <td><b>Totals</b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td><?php echo $sub_total; ?></td>
                            <td><?php echo $vat_total; ?></td>
                            <td><?php echo $price_total; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</main>
<?php include "../../templates/footer.php"  ?>
<script src="../../public/js/bootstrap.min.js"></script>
</body>
</html>