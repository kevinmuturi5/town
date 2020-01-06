<?php
 session_start();
 $url=$_SESSION['current_page'];
require_once "../config/database.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $username = $password = $type = "";

    $response = ["username_err" => "",
        "password_err" => "",
        "wrong_password" => "",

        "type" => "",
        "status" => ""];

    if(empty(trim($_POST["username"]))){
        $response["username_err"] = "Username cannot be empty";
        $response["password_err"] = "Password Error";
    }else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"]))){
        $response["password_err"] = "Password cannot be empty";
    }else{
        $password = trim($_POST["password"]);
    }

    if(empty($response["username_err"]) && empty($response["password_err"])){
        $sql = "SELECT * FROM users WHERE username = '$username'";

        $result = mysqli_query($conn, $sql);
        if($result){
            if(mysqli_num_rows($result) > 0){
               while($row = mysqli_fetch_assoc($result)){
                   $password_verify = $row["password"];
                   if(password_verify($password, $password_verify)){
                        $type = $row["type"];
                        session_start();
                        $_SESSION["id"] = $row["id"];
                        $_SESSION["type"] = $row["type"];
                        
                        $response["type"] = $_SESSION["type"];
                        $response["status"] = "success";
                       if($_SESSION['type']==1){
                         header("location:$url"); 

                       }
                       if($_SESSION['type']==2){
                           header("location:../dashboard/inventory/"); 

                       }
                        
                   }else{
                       $response["wrong_password"] = "Wrong password Try again";
                   }
               } 
            }else{
                $response["username_err"] = "Username not found!";
                $response["password_err"] = "Enter valid username and password to continue";
            }
        }else{
            $response["username_err"] = "error try again";
            $response["password_err"] = "Enter valid username and ppassword to continue";
        }

    }
    
    echo json_encode($response);

}


?>
<?php
   if(isset($_POST["orderbtn"])){
        

        $user_id=$_SESSION["id"];
         $qnty=$_POST["units"];
         $supplier=$data["supplier_id"];
         $description=$data["description"];
         $cost=$data["selling_price"];
         $pid=$data["pid"];
     $sql4="select * from orders where customer_id=$user_id and product_id=$pid";
     $resultsel=mysqli_query($conn,$sql4);
     $rowres=mysqli_fetch_assoc($resultsel);
     $numrows=mysqli_num_rows($resultsel);
    if($numrows>0){
     $sql3="update orders set units=units+$qnty, status='unconfirmed' where customer_id=$user_id and product_id=$pid";
     $resupdate=mysqli_query($conn,$sql3);
    }
    else{
    
        $sql2="INSERT INTO orders VALUES (NULL, '$user_id', '$pid', '$qnty', '$supplier', '$description', '$cost','unconfirmed')";
        $res=mysqli_query($conn,$sql2);
        
     }
}
?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="../public/js/script.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="../public/css/main.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
<?php include("../templates/header.php");?>
    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-sm-8 col-md-6 col-lg-5 col- m-auto table-responsive-sm">
                <div id="msg"></div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="login-form" method="POST">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" name="username" id="username">
                    <div id="username_err"></div>
                    <br>
                    <label  for="password">Password</label>
                    <input class="form-control"  type="password" name="password" id="password">
                    <div id="password_err"></div>
                    <br><br>
                    <input type="submit" name="login" class="btn btn-outline-primary btn-sm-block" value="Login">
                    <span style="padding-left: 100px"><a class="text-warning" href="#"onclick="get_email()">Forgot Password?</a></span>
                </form>               
                </div>
            </div>

        </div>

    </main>

  <?php include ("../templates/footer.php");
  // if(isset($_POST['login'])){
  //   header('../dashboard/customer/details.php?product_id=7');

  // }
  ?>


<div class="modal" tabindex="-1" role="dialog" id="passModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Password Recovery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-5">
                            <label>Email</label>
                        </div>
                        <div class="col-md-7">
                            <input type="email" class="form-control" id="passmail" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="sendlink">Send Recovery Password</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



</body>

</html>
