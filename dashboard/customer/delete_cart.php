<?php
require_once '../init.php';

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $ready_id = $_GET['ready_id'];

    if (isset($_COOKIE["cart"])){
        $cart = json_decode($_COOKIE["cart"], true);// True needed to ensure decoded object is an Array

        if(isset($cart[$ready_id])){
            foreach ($cart as $key => $value){
                if ($key == $ready_id) {
                    unset($cart[$key]);
                }
            }
            setcookie("cart", json_encode($cart), time() + (86400 * 30), '/');
             
        }else{
            //PASS
        }
        
    }else{
        $cookie_name = "cart";
        $cookie_value = [$ready_id => [
            "count" => 1,
            ]
        ];
        setcookie($cookie_name, json_encode($cookie_value), time() + (86400 * 30), "/"); 
        // 86400 = 1 day
    }
    
}
?>
