<?php
require_once "init.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $product_id = $units = $supplier_id = "";

    if(!empty(trim($_POST["id"])) && !empty(trim($_POST["units"])) ){
        
        $product_id = trim($_POST["id"]);
        $units = trim($_POST["units"]);

        $query = "SELECT * FROM products WHERE id = '$product_id'";

        if ($result = mysqli_query($conn, $query)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $supplier_id = $row["supplier_id"];
                }
            }
        }else{
            echo "Could Not fetch Supplier Information";
        }

        if(!empty($supplier_id)){
        echo "placing order....<br>";
        $sql = "INSERT INTO orders (customer_id, product_id, units, supplier_id)
        VALUES ('$customer_id', '$product_id', '$units', '$supplier_id') ";

            if($result = mysqli_query($conn, $sql)){
                header("location:orders.php");
                echo "Success";
            }else{
                echo "Failed to place your order. Try again!";
            }
        }

    }else{
        echo "Error";
    }


    echo "Supplier Id is ".$supplier_id;

}
?>