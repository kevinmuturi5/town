<?php
session_start();
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
                        // $type == 1 ? header("location:../dashboard/customer/index.php") : header("location:../dashboard/supplier/index.php");
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
    exit();

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
<?php include("../templates/header.php")
?>
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
                    <input type="submit" class="btn btn-outline-primary btn-sm-block" value="Login">
                    <span style="padding-left: 100px"><a class="text-warning" href="#"onclick="get_email()">Forgot Password?</a></span>
                </form>               
                </div>
            </div>

        </div>

    </main>

  <?php include ("../templates/footer.php")?>
<!-- The Modal -->
<!--<div class="modal" id="passModal">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">-->

            <!-- Modal Header -->
<!--            <div class="modal-header">-->
<!--                <h4 class="modal-title">Password Recovery</h4>-->
<!--                <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<!--            </div>-->

            <!-- Modal body -->
<!--            <div class="modal-body">-->
<!--                <form class="form-signin" action="enter_email.php" method="POST">-->
<!--                    <div class="input-group">-->
<!--                        <span class="input-group-addon" id="basic-addon1">Email</span>-->
<!--                        <input type="text" name="username" class="form-control" placeholder="Your Email Address.." required>-->
<!--                    </div>-->
<!--                    <br />-->
<!--                    <button class="btn btn-primary btn-block" type="submit">Recover</button>-->
<!--                </form>            </div>-->

            <!-- Modal footer -->
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
<!--            </div>-->

<!--        </div>-->
<!--    </div>-->
<!--</div>-->

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


    <!-- <script>
        window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>

    <script src="/docs/4.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous">
    </script> -->

    <script src="../public/js/bootstrap.min.js"></script>
    <script>
        function checkUsername(){
                var username = $("#username").val();
                var password = $("#password").val();

                $.ajax({
                    type: "post",
                    data: {
                        username: username,
                        password: password
                    },
                    success: function (data, status) {
                        var response = JSON.parse(data);
                        console.log(response);
                        for(var feedback in response){
                            switch (feedback) {
                                case "username_err":
                                    if(response.username_err != ""){
                                        $("#username").removeClass("is-valid")
                                        $("#username").addClass("is-invalid")
                                        $("#username_err").html(`<div class="text-danger text-small">${response.username_err}</div>`)

                                        $("#password").removeClass("is-valid")
                                        $("#password").addClass("is-invalid")
                                        $("#password_err").html(`<div class="text-danger text-small">${response.password_err}</div>`)                                    
                                    }else{
                                        $("#username").removeClass("is-invalid")
                                        $("#username").addClass("is-valid")
                                        $("#username_err").html(`<div class="text-danger text-small"></div>`)
                                        
                                        $("#password").removeClass("is-invalid")
                                        $("#password_err").html(`<div class="text-danger text-small"></div>`) 
                                    }
                                    break;

                                default:
                                    break;
                            }
                        }
                        // if(response.status == "success"){
                        //     $("#username").removeClass("is-invalid")
                        //     $("#username").addClass("is-valid")
                        // }else if(response.status == "error"){
                        //     $("#username").removeClass("is-valid")
                        //     $("#username").addClass("is-invalid")
                        //     $("#username_err").html(`<div class="text-danger text-small">${response.message}</div>`)
                        // }else{

                        // }
                    },
                    error: function(data, status){

                    }
                });
        }
        
    function get_email(){
        var username = $("#username").val();
        $.ajax({
            type: "get",
            url: "get_user.php",
            data:{
                username:username
            },
            success: function(data, status){
                var response = JSON.parse(data);
                console.log(response)
                if (response.status == "success"){
                    response = response["data"][0];
                    $("#passmail").val(response.email);
                    $("#passModal").modal("show")

                }
            }
        })
    }

    function send_link(user){
        var user_email = user;
        $.ajax({
            type: "GET",
            url: "link.php",
            data: {
                 user_email:user_email
             },
            success: function (data, status) {
                var response = JSON.parse(data)
                if (response.status == "success"){
                    $("#passModal").modal("hide");
                    $("#msg").html(`<div class=" mt-2 alert alert-success">${response.message}. Redirecting.. </div>`);
                    $("#msg").effect("bounce", { times: 1 }, 300);
                }

            }
        });

    }
        
        $(document).ready(function() {
            $("#username").focusout(function(){
                checkUsername();
            })    
            // $("#password").focusout(function(){
            //     checkUsername();
            // })

            $("#login-form").on("submit", function(e){
                e.preventDefault();
                var username = $("#username").val();
                var password = $("#password").val();
                // console.log(username + password)

                $.ajax({
                    type: "post",
                    data: {
                        username:username,
                        password:password
                    },
                    success: function (data) {
                        console.log(data)
                        var response = JSON.parse(data);
                        console.log("After submit")
                        console.log(response)
                        for(var feedback in response){
                            switch (feedback) {
                                case "password_err":
                                    if(response.password_err != ""){
                                            $("#password").removeClass("is-valid")
                                            $("#password").addClass("is-invalid")
                                            $("#password_err").html(`<div class="text-danger text-small">${response.password_err}</div>`)                                   
                                        }else{
                                            $("#password").removeClass("is-invalid")
                                            $("#password").addClass("is-valid")
                                            $("#password_err").html(`<div class="text-danger text-small"></div>`) 
                                        }                                    
                                    break;

                                case "wrong_password":
                                    if(response.wrong_password != ""){
                                            $("#password").removeClass("is-valid")
                                            $("#password").addClass("is-invalid")
                                            $("#password_err").html(`<div class="text-danger text-small">${response.wrong_password}</div>`)                                   
                                        }                                   
                                    break; 

                                case "status":
                                    if(response.status == "success"){
                                        let user_type = response.type;
                                        // console.log(user_type)
                                        $("#msg").html(`<div></div>`);
                                        window.setTimeout(function(){
                                            location.href = ((user_type == 1) ? "../dashboard/customer/index.php" : "../dashboard/inventory")}, 500)                       
                                        }else{
                                            $("#msg").html(`<div class="alert alert-warning">Correct the errors below and try again</div>`);
                                            $("html").animate({scrollTop:0}, "slow");
                                        }                                    
                                    break;                                                                       
                                default:
                                    break;
                            }
                        }
                    },
                    error: function(data){
                        // console.log(data.responseText)
                    }
                });
            })  
            
       $("#sendlink").click(function () {
            var user_mail = $("#passmail").val();
            if (user_mail != ""){
                send_link(user_mail)
                setTimeout(function() {
                    //your code to be executed after 5 second
                    location.href="password_reset.php?email="+user_mail;
                }, 5000);

            }

        })
            
        });
        
    </script>

</body>

</html>
