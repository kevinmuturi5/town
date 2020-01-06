<?php
require "../config/database.php";
$server_root = "/willie";
if(isset($_SESSION["id"]) && isset($_SESSION["type"])){
    $user_id = $_SESSION["id"];
    $type = $_SESSION["type"];

    echo $user_id;exit;
    //Supplier Logged In
    if($type == 2){
        $query = "SELECT s.id FROM suppliers s INNER JOIN users u ON s.user_id = u.id WHERE u.id = '$user_id'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                //$supplier_id = $row["id"];
                $user_id = $_SESSION["id"];
                
            }
            if(isset($supplier_id)){
                
            }else{
                // header("location:{$server_root}/supplier/index.php");
                echo "Error1".mysqli_error($conn);
            }
        }
        else{
            echo "Error2".mysqli_error($conn);
        }
    }elseif($type == 1){
        //Customer logged in
        $query = "SELECT c.id FROM customers c INNER JOIN users u ON c.user_id = u.id WHERE u.id = '$user_id'";

        //$customer_id = $_SESSION["id"];
        $user_id = $_SESSION["id"];
        
        $result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $customer_id = $row["id"];
            }
            if(isset($customer_id)){
            }else{

            }
        }
        else{
            exit ("Error4".mysqli_error($conn));
        }
    }

}else{
    // header("location:{$server_root}/auth/login.php");
}


?>