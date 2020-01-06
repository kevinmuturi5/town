<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 8/6/19
 * Time: 10:31 AM
 */

require_once '../config/database.php';

if ($_SERVER ["REQUEST_METHOD"] == "GET"){
    $response = [
        "status" =>"",
        "data" =>""
    ];
    if(!empty(trim($_GET["username"]))){
        $username = trim($_GET["username"]);
        $sql = "select * from users where username = '$username'";
        if ($result = mysqli_query($conn, $sql)){
            if ($count = mysqli_num_rows($result) > 0){
            $response['status'] ="success";
            $response ['data'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }
            else{
                $response ['status'] = "error ".mysqli_error($conn);

            }
        }else{
            $response ['status'] ="error ".mysqli_error($conn);
        }

    }else{
        $response ['status'] ="error ".mysqli_error($conn);
    }


    echo json_encode($response);
}