<?php
//require "/home2/housinn1/public_html/willie/config/database.php";
require "config/database.php";
$server_root = "/willie";

if(isset($_SESSION["id"]) && isset($_SESSION["type"])){
    //$user_id = $_SESSION["id"];
    $type = $_SESSION["type"];

    //Supplier Logged In
    if($type == 2){
        $query = "SELECT s.id FROM suppliers s INNER JOIN users u ON s.user_id = u.id WHERE u.id = '$user_id'";
        $result = mysqli_query($conn, $query);
        $supplier_id = $_SESSION["id"];
        // if(mysqli_num_rows($result) > 0){
        //     while($row = mysqli_fetch_assoc($result)){
        //         $supplier_id = $row["id"];
        //         $_SESSION["id"] = $supplier_id;
        //     }
        //     if(isset($supplier_id)){
                
        //     }else{
        //         // header("location:{$server_root}/supplier/index.php");
        //         echo "Error1".mysqli_error($conn);
        //     }
        // }
        // else{
        //     echo "Error2".mysqli_error($conn);
        // }
    }elseif($type == 1){ //Customer logged in
        $query = "SELECT s.id FROM customers c INNER JOIN users u ON s.user_id = u.id WHERE u.id = '$user_id'";

        $customer_id = $_SESSION["id"];
        $result = mysqli_query($conn, $query);
        // if($result && mysqli_num_rows($result) > 0){
        //     while($row = mysqli_fetch_assoc($result)){
        //         $customer_id = $row["id"];
        //     }
        //     if(isset($customer_id)){
        //     }else{
        //         header("location:{$server_root}/customer/customer.php");               
        //         exit ("Error3".mysqli_error($conn));
        //     }
        // }
        // else{
        //     exit ("Error4".mysqli_error($conn));
        // }
    }

}

// if($type == 1){
//     die("You are not authorized to access this page");
// }

?>