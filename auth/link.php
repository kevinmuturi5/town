<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 8/6/19
 * Time: 11:48 AM
 */

require_once '../config/database.php';

if ($_SERVER ["REQUEST_METHOD"] == "GET"){
    $response =[
        "status" =>"",
        "message" =>""
    ];
//    $user_email = $_GET['user_email'];
    if (!empty($_GET['user_email'])) {
        $user_email = $_GET['user_email'];
//        $user_email = trim($_GET("user_email"));

        //generating a random 8 digit password
        $char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%^&*+-/~`?><\|";
        $new_password = substr(str_shuffle($char), 0, 8);
        $myfile = fopen("sent passwords.txt", "a") or die("Unable to open file!");
        date_default_timezone_set('Africa/Nairobi');
        $time = date('Y-m-d-l  H:i:s');
        $txt = $time." Recovery password sent to ".$user_email." is ".$new_password."\r\n";
        fwrite($myfile, $txt);
        fclose($myfile);
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // updating old password in db to the new password that is auto generated
        $query = "update users set password = '$hashed_password' where email = '$user_email'";
        if ($result = mysqli_query($conn, $query)) {
            //send new password to user's email
            $to = $user_email;
            $company_name = "Willie Scant Company";
            $subject = 'Use the following information to change your password';
            $message = 'Welcome to ' . $company_name."\r\n" 
                . 'Your email and password is as the following :'."\r\n"
                . 'Email: ' . $user_email ."\r\n"
                . 'Your recovery password : ' . $new_password."\r\n"
                . 'Now you can login with this email and password';
//            $headers = 'From: Your name <' . $user_email . '>' . "\r\n";
//            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers = 'From: noreply @ company . com';
            mail($to, $subject, $message, $headers);
            $response['status'] = "success";
            $response['message'] = "Email sent successfully";

        } else {
            $response['status'] = "error";
            $response['message'] = mysqli_error($conn);
        }
    } else {
        $response['status'] = "error";
        $response['message'] = mysqli_error($conn);
    }

    echo json_encode($response);
}
?>