<?php
require_once "../config/database.php";


$full_name = $phone = $username = $type = $password = $confirm_password = "";

$response = ["status" => "",
            "general_error" => "",
            "full_name_err" => "",
            "phone_err" => "",
            "username_err" => "",
            "type_err" => "",
            "password_err" => "",
            "confirm_password_err" => "" ];

// $username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){


    //Validate full names
    if(empty(trim($_POST["full_name"]))){
        $response["full_name_err"] = "Full names cannot be empty";
    }else{
        $full_name = htmlspecialchars(trim($_POST["full_name"]));
    }

    //validate Phone number
    if(empty(trim($_POST["phone"]))){
        $response["phone_err"] = "Phone number cannot be empty";
    }else{
        //Perform some regex validation
        //If phone validation passes
        $phone = strval(trim($_POST["phone"]));
        if((strlen($phone) <= 9 && stristr($phone, "7" != false) )  || (strlen($phone) >= 10 && stristr($phone, "07") == false )){
            $response["phone_err"] = "Phone number is not valid"; 
            if(strlen($phone) > 10 && ((stristr($phone, "+2547") != false && strlen($phone) == 13) || (stristr($phone, "2547") != false && strlen($phone) == 12))){
                $response["phone_err"] = "";
            }
        }elseif(strlen($phone) > 10 && stristr($phone, "+2547") == false && strlen($phone) != 13){
            $response["phone_err"] = "Phone number is not valid";
        }else{
            $reponse["phone_err"] = "Phone number is not valid";
        }
    }

    //Validate Username
    if(empty(trim($_POST["username"]))){
        $response["username_err"] = "Username cannot be empty";
    }else{
        $name = $_POST["username"];
        $check_username = mysqli_query($conn, "SELECT * FROM users WHERE username = '$name'");
        if(!$check_username){
            $response["username_err"] =  "Something went wrong try again";
        }else{
            if(mysqli_num_rows($check_username)  > 0){
                $response["username_err"] = "Username is already taken. Try again";
            }else{
                $username = trim($_POST["username"]);
            }
        }
    }

    //Validate type
    if(empty(trim($_POST["type"]))){
        $response["type_err"] = "Please select a user type";
    }else{
        $type = trim($_POST["type"]);
    }

    //Validate Password
    if(empty(trim($_POST["password"]))){
        $response["password_err"] = "Enter a password to continue";
    }elseif (strlen(trim($_POST["password"])) < 8 ){
        $response["password_err"] = "Your Password Must Contain More Than 8 Characters";
    }elseif(!preg_match("#[0-9]+#",$_POST["password"])){
        $response["password_err"] = "Your Password Must Contain At Least 1 Number!";
    }
    elseif(!preg_match("#[A-Z]+#",$_POST["password"])) {
        $response["password_err"] = "Your Password Must Contain At Least 1 Capital Letter!";
    }
    elseif(!preg_match("#[a-z]+#",$_POST["password"])) {
        $response["password_err"] = "Your Password Must Contain At Least 1 Lowercase Letter!";
    }elseif(max(array_count_values(str_split(strtolower($_POST["password"]))))>1)
    {
        $response["password_err"] = "Your Password Must NOT Contain Repeating Characters!";
    }
    else{
        $password = trim($_POST["password"]);
    }

    //validate Repeat Password
    if(empty(trim($_POST["password1"]))){
        $response["confirm_password_err"] = "Empty password confirmation";
    }elseif (strlen(trim($_POST["password1"])) < 8 ){
        $response["confirm_password_err"] = "Your Password Must Contain More Than 8 Characters";
    }
    else{
        $confirm_password = trim($_POST["password1"]);
        if($password != $confirm_password){
            $response["confirm_password_err"] = "Passwords DO NOT Match."; 
        }
    }

    if(empty($response["full_name_err"]) && empty($response["phone_err"]) && empty($response["username_err"]) && empty($response["type_err"]) && empty ($response["password_err"]) && empty($response["confirm_password_err"])){

        $password = password_hash($password, PASSWORD_DEFAULT);

        if(strtolower($type) == "customer"){
            $user_type = 1;
            $query = "INSERT INTO users (type, username, password)
            VALUES('$user_type', '$username', '$password')";

            if(mysqli_query($conn, $query)){
                $user_id = mysqli_insert_id($conn);
                $query = "INSERT INTO customers (name, user_id, phone)
                VALUES('$full_name', '$user_id', '$phone')";
    
                if(mysqli_query($conn, $query)){
                    $response["status"] =  "success";
                    // sleep(5);
                    // header("location: login.php");
                }else{
                    $response["general_error"] = "Failure could not add to customers";
                }
            }
        }elseif(strtolower($type) == "supplier"){
            $user_type = 2;
            $query = "INSERT INTO users (type, username, password)
            VALUES('$user_type', '$username', '$password')";

            if(mysqli_query($conn, $query)){
                $user_id = mysqli_insert_id($conn);
                $query = "INSERT INTO suppliers (name, user_id, phone)
                VALUES('$full_name', '$user_id', '$phone')";
    
                if(mysqli_query($conn, $query)){
                    $response["status"] =  "success";
                    sleep(5);
                    header("location: login.php");
                }else{
                    $response["general_error"] =  "Failure could not add to Suppliers";
                }
            }            
        }


        // //Add a user ==> Type not yet determined
        // if(mysqli_query($conn, $query1)){
        //     echo "Success added to Users";
        //     echo $type;
        //     //Confirm user type to add them to their appropriate tables   
        //     if(strtolower($type) == "customer"){
        //         $user_id1 = mysqli_insert_id($conn);
        //         $user_type = 1;
        //         $query2 = "INSERT INTO customers (name, user_id, phone)
        //         VALUES('$full_name', '$user_id', '$phone')";

        //         if(mysqli_query($conn, $query2)){
        //             echo "Success! Added to customers";
        //             header("location: login.php");
        //         }else{
        //             echo "Failure could not add to customers";
        //         }
        //     } 
        //     elseif(strtolower($type) == "supplier"){
        //         echo $type;
        //         $user_type = 2;
        //         $user_id2 = mysqli_insert_id($conn);
        //         $query3 = "INSERT INTO suppliers (name, user_id, phone)
        //         VALUES('$full_name', '$user_id2', '$phone')";

        //         if(mysqli_query($conn, $query3)){
        //             echo "Success! Added to supliers";
        //             header("location: login.php");
        //         }else{
        //             echo "Failure could not add to suppliers";
        //         }
        //     }
        else{
            $response["general_error"] = "Failure could not add to users";
        }      
    } else{
        $response["status"] =  "error";
    } 
    echo json_encode($response);
}


// if($_SERVER["REQUEST_METHOD"] == "POST"){
//     //Validate Username
//     if(empty(trim($_POST["username"]))){
//         $username_err =  "Please enter a username";
//     }else{
//         $usrname = trim($_POST["username"]);
//         $sql = "SELECT * FROM users WHERE name = '$usrname' ";
//         $check_username = mysqli_query($conn,$sql);
//         if(!$check_username){
//             $username_err = "Oops something went wrong try again later";
//         }else{
//             if(mysqli_num_rows($check_username) >= 1){
//                 $username_err = "The username is already taken";
//             }else{
//                 $username = trim($_POST["username"]);
//             }
//         }
//     }

//     // Validate Password
//     if(empty(trim($_POST["password"]))){
//         $password_err = "Please enter a password";
//     }elseif(strlen(trim($_POST["password"])) < 8){
//         $password_err = "Password must have at least 8 characters";
//     }else{
//         $password = trim($_POST["password"]);
//     }

//     //Validate confirm password
//     if(empty(trim($_POST["confirm_password"]))){
//         $confirm_password_err = "Please confirm password";
//     }else{
//         $confirm_password = trim($_POST["confirm_password"]);

//         if(empty($confirm_password_err) && ($password != $confirm_password)){
//             $confirm_password_err = "Passwords do not match";
//         }
//     }

//     //Check for input errors
//     if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
//         $param_username = $username;
//         $param_password = password_hash($password, PASSWORD_DEFAULT);

//         $query = "INSERT INTO users (name, password)
//         VALUES ('$param_username', '$param_password')";
//         $result = mysqli_query($conn, $query);
//         if($result){
//             header("location: login.php");
//         }else{
//             echo mysqli_error($conn);
//         }
//     }
// }

?>