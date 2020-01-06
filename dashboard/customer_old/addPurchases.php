<?php
require "init.php";

/*if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty(trim($_POST["submit"])) && trim($_POST["submit"]) == "Add supplier"){
        //Add Supplier Information
    }elseif (!empty(trim($_POST["submit"])) && trim($_POST["submit"]) == "Add product") {
        //Add Product Information
    }else{
        //Return Error Message to user
    }
}*/


if($_SERVER["REQUEST_METHOD"] == "POST"){
    echo  "Working";
    $supplier_name = $supplier_phone = $supplier_email = $location = $pin = $vat = $product_name = $description = $quantity = $total_price = $date = $time = "";

    // $field_err = "";
    $date = $_POST["date"];
    $month = date("m", strtotime($date));
    $current_month = date("m");
    $in_month = false;
    
    if((int)$month < (int)$current_month){
        $in_month = false;
    }else{
        $in_month = true;
    }

    $duplicate = false;

    if(isset($_POST["pin"]) && isset($_POST["supplier_name"]) && isset($_POST["product_name"])){
        $supplier_name =  htmlspecialchars(trim($_POST["supplier_name"]));   
        $supplier_phone = htmlspecialchars(trim($_POST["supplier_phone"])); 
        $supplier_email = htmlspecialchars(trim($_POST["supplier_email"])); 
        $location = htmlspecialchars(trim($_POST["location"])); 
        $pin = htmlspecialchars(trim($_POST["pin"])); 
        // $vat = htmlspecialchars(trim($_POST["vat"])); 
        $product_name = htmlspecialchars(trim($_POST["product_name"])); 
        $description = htmlspecialchars(trim($_POST["description"])); 
        $quantity = htmlspecialchars(trim($_POST["quantity"])); 
        $total_price = htmlspecialchars(trim($_POST["total_price"])); 
        $date = htmlspecialchars(trim($_POST["date"])); 
        $time = htmlspecialchars(trim($_POST["time"])); 


        //Check if supplier and product already exists => use supplier_name, pin and product_name
        $check_duplicate = "SELECT s.name as supplier_name, s.pin as pin, p.name as product_name
        FROM product_suppliers s 
        INNER JOIN purchases p ON s.id = p.supplier_id 
        WHERE s.pin = '$pin' AND p.name = '$product_name' AND s.name = '$supplier_name' ";

        if($result = mysqli_query($conn, $check_duplicate)){
            if(mysqli_num_rows($result) > 0){
                $duplicate = true; //Existing record found!!
                while($row = mysqli_fetch_assoc($result)){
                    $existing_pin = $row["pin"];
                    $existing_supplier = $row["supplier_name"];
                    $existing_product = $row["product_name"];
                }
            }else{
                // echo "No Duplicates";
            }
        }else{
            echo "Error".mysqli_error($conn);
        }

        if($duplicate == true){
            $message = "You Have entered a supplier and a product that already exist in your purchase history";
        }elseif($in_month == false){
            $message = "The date you entered is not valid. Enter a date within the current Month";
        }
        else{
            echo "Continue ==> No duplicates";
            $add_supplier  = "INSERT INTO product_suppliers(name, phone, email, location, pin) 
            VALUES ('$supplier_name', '$supplier_phone','$supplier_email','$location','$pin')";

            if($result = mysqli_query($conn, $add_supplier)){
                echo "Added supplier info";
                $supplier_id = mysqli_insert_id($conn);
                $customer_id = $_SESSION["id"];
                $unit_price = $total_price / $quantity;
                
                if(!empty(trim($_POST["vat"]))){
                    $vat = trim($_POST["vat"]);
                    $sub_total = $total_price - $vat;
                }else{
                    $sub_total = $total_price * (100/116);
                    $vat = $total_price - $sub_total;
                }

                $add_purchase = "INSERT INTO purchases(customer_id, name, description, quantity, total_price, unit_price, vat, sub_total, date, time, supplier_id) 
                VALUES ('$customer_id' ,'$product_name' ,'$description','$quantity' ,'$total_price' , '$unit_price' ,'$vat','$sub_total','$date', '$time', '$supplier_id')";

                if($result = mysqli_query($conn, $add_purchase)){
                    echo "Success";
                }else{
                    echo "Failed".mysqli_error($conn);
                }
            }else{
                exit(mysqli_error($conn));
            }
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Purchase</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/main.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <!-- <link href="public/css/bootstrap.min.css"> -->
</head>
<body>
    <?php include "../../templates/header.php"; ?>


<main style="margin-top: 60px;">
<div class="container-fluid">
<div class="row">
    <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div>
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <?php 
                        if(!empty($message)){
                            echo "<div class='alert alert-danger alert-dismissible'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            <strong>Alert!</strong> {$message}
                            </div>";
                        }

                    ?>
                    </div>
                </div>
            <div class="row m-auto">
           <div class="col-sm-5" style="border-style: groove;padding: 15px;border-radius: 5px;">
        <h2 style="text-align: center;">Supplier Details</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name">Name of Supplier:</label>
                        <input type="text" class="form-control" name="supplier_name" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="pwd">Telephone Number:</label>
                        <input type="text" class="form-control" name="supplier_phone" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="supplier_email" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="pin">KRA Pin:</label>
                        <input type="text" class="form-control" name="pin" required>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="pwd">Location:</label>
                        <textarea type="text" class="form-control" name="location" required></textarea>
                    </div>
                </div>

            </div>
           </div>

            <div class="col-sm-1"></div>
            <div class="col-sm-5" style="border-style: groove;padding: 15px; border-radius: 5px;">
                   <h2 style="text-align: center;">Product Details</h2>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="product_name">Product:</label>
                            <input type="text" class="form-control" name="product_name" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" class="form-control" name="quantity" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-sm-8">
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea type="text" class="form-control" name="description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="pwd">Total Price:</label>
                            <input type="number" class="form-control" name="total_price" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="vat">VAT</label>
                            <input type="number" class="form-control" name="vat">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="date" class="form-control" name="date" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="time">Time:</label>
                            <input type="time" class="form-control" name="time">
                        </div>
                    </div>

                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-sm-4 offset-4" style="padding: 2%">
                    <button type="submit" class="btn btn-danger btn-block">Submit</button>
                    <br><br>
                </div>
            </div>

            </form>
               </div>
        </div>
<div class="col-sm-1">
    </div>
</main>


<?php include "../../templates/footer.php"; ?>

<!-- <script>
    window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')
</script>

<script src="/docs/4.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous">
</script> -->

<script src="../../public/js/bootstrap.min.js"></script>

</body>

</html>