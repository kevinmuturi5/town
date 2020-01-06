<?php
require_once '../init.php';
// unset($_COOKIE['cart']);
// setcookie('cart', '', time() - 3600, '/'); //UNCOMMENT THESE TO DELETE THE COOKIES WHILE DEBUGGING ONLY

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $ready_id = $_GET['ready_id'];

    if (isset($_COOKIE["cart"])){
        $cart = json_decode($_COOKIE["cart"], true);// True needed to ensure decoded object is an Array

        if(isset($cart[$ready_id])){
             $cart[$ready_id]["count"] += 1;
            setcookie("cart", json_encode($cart), time() + (86400 * 30), '/');
             
        }else{
            $cart[$ready_id]["count"] = 1;
            setcookie("cart", json_encode($cart), time() + (86400 * 30), '/');
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

 
        