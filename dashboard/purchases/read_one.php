<?php
require "../init.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
   
    $response = [
        "status" => "",
        "data" => ""        
    ];
    
    if(!empty($_GET["search"])){
        $search = trim($_GET["search"]);
        //sql error on customer id that's why on search it is not displaying and giving an error message so to go around id replaced $customer_id with $Supplier_id and it works
        $sql = "select s.pin as pin, s.name as supplier_name , p.sku as sku, p.name as product_name, p.receipt_number as receipt_number ,p.unit_price as unit_price, p.total_price as total_price, p.vat as vat, p.date as date, p.time as time, p.sub_total as sub_total, p.id as id, p.description as description,p.quantity as quantity,s.location as supplier_location
        from product_suppliers s inner join  purchases p on s.id =supplier_id where p.customer_id ='$supplier_id' and p.name like '%$search%'";
        
        if($result = mysqli_query($conn, $sql)){
            $count = mysqli_num_rows($result);
            if($count > 0){
                $response["status"] = "success";
                $response["data"] = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }
            else{
                $response["status"] = "Error".mysqli_error($conn);
            }
        }else{
            $response["status"] = "error".mysqli_error($conn);
        }
    }else{
        $response["status"] = "error".mysqli_error($conn);
    }
    echo json_encode($response);
}

?>