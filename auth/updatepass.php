<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 8/6/19
 * Time: 3:36 PM
 */

require_once '../config/database.php';

if ($_SERVER ["REQUEST_METHOD"] == "GET"){
    $response = [
        "status" => "",
        "message" => "",
        "oldpasserr" =>"",
        "newpass_err" => "",
        "usermailerr" => ""
        
    ];

    $oldpass = $newpass = $user_email = "";
    if (empty(trim($_GET['oldpass']))){
        $response ['oldpasserr'] = "This field cannot be empty";
    }else{
        $oldpass = trim($_GET['oldpass']);
    }


    //Validate newpass
    if(empty(trim($_GET["newpass"]))){
        $response["newpass_err"] = "Enter a new password to continue";
    }elseif (strlen(trim($_GET["newpass"])) < 8 ){
        $response["newpass_err"] = "Your new password Must Contain More Than 8 Characters";
    }elseif(!preg_match("#[0-9]+#",$_GET["newpass"])){
        $response["newpass_err"] = "Your new password Must Contain At Least 1 Number!";
    }
    elseif(!preg_match("#[A-Z]+#",$_GET["newpass"])) {
        $response["newpass_err"] = "Your new password Must Contain At Least 1 Capital Letter!";
    }
    elseif(!preg_match("#[a-z]+#",$_GET["newpass"])) {
        $response["newpass_err"] = "Your new Password Must Contain At Least 1 Lowercase Letter!";
    }elseif(max(array_count_values(str_split(strtolower($_GET["newpass"]))))>1)
    {
        $response["newpass_err"] = "Your new Password Must NOT Contain Repeating Characters!";
    }
    else{
        $newpass = trim($_GET["newpass"]);
    }

    //Getting the user email
    if (!empty(trim($_GET['user_email']))){
        $user_email = trim($_GET['user_email']);
    }else{
        $response ['usermailerr'] = "Email does not exist..!!";
    }


    if (empty($response['newpass_err']) && empty($response['oldpasserr']) && empty($response['usermailerr'])){
    $updated = $newpass;
    //Got data from old and new password fields so get the database stored password
    $query = "select * from users where email = '$user_email'";
    if ($result = mysqli_query($conn, $query)){
        if ($count = mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $db_password = $row['password'];
            if (password_verify($oldpass, $db_password)) {
                date_default_timezone_set("Africa/Nairobi");
                $time = date('Y-m-d-l  H:i:s');
                $file = fopen("password logs.txt", 'a');
                $txt = $time . " Database password is " .$db_password. "\t Old password that was input is " .$oldpass. "\t New password that was input is " .$newpass. "\r\n";
                fwrite($file, $txt);
                fclose($file);
                $newpass = password_hash($newpass, PASSWORD_DEFAULT);
                $update = "update users set password = '$newpass' where email = '$user_email'";
                if ($result2 = mysqli_query($conn, $update)){
                    $response ['status'] = "success";
                    $response ['message']= "Password updated sucessfully. Redirecting you to login with the new password...";
                }else{
                    $response['status'] = "error";
                    $response ['message'] = "Error! Password not changed";
                }
            }else{
                $response ['oldpasserr'] = "Check Email inbox for recovery password";
            }
        }else{
            $response ['status'] = "error";
            $response ['message'] = mysqli_error($conn);
        }
    }else{
        $response ['status'] = "error";
        $response ['message'] = mysqli_query($conn);
    }
    }

    
    echo json_encode($response);
    exit();
}