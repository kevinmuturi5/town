<?php
require "../config/database.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $data = array();
    if(isset($_GET["name"])){
        $username = $_GET["name"];
        $sql = "SELECT * FROM users WHERE username = '$username'";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                $data = [
                    status => "success",
                    message => "Username found"
                ];
            }else{
                $data = [
                    status => "error",
                    message => "Error! Username does not exist"
                ];                
            }
        }else{
            $data = [
                status => "error",
                message => "Error! Could not do this username search"
            ];            
        }
    }else{
        echo "Empty Username";
    }
    echo json_encode($data);
}


?>