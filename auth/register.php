<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Registration</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="script.js"></script>
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
                <div class="col-sm-8 col-md-6 col-lg-5 col- m-auto">
                    <div id="msg"></div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="reg-form" method="POST">
                    <label for="full_name">Full names</label>
                    <input class="form-control" type="text" name="full_name" id="full_name">
                    <div id="full_name_err"></div>
                    <br>
                    <label for="phone">Phone</label>
                    <input class="form-control" type="text" name="phone" id="phone">
                    <div id="phone_err"></div>

                    <br>
                    <label for="username">Username</label>
                    <input class="form-control" type="text" name="username" id="username">
                    <div id="username_err"></div>
                    <br>
                    <br>
                    <label for="type">User Type</label>
                    <select class="form-control" name="type" id="type">
                        <option value="customer">Customer</option>
                        <option value="Supplier">Supplier</option>
                    </select>
                    <div id="type_err"></div>
                    <br><br>
                    <label  for="password">Password</label>
                    <input  class="form-control" type="password" name="password" id="password">
                    <div id="password_err"></div>
                    <br>
                    <label for="password1">Password Repeat</label>

                    <input class="form-control" type="password" name="password1" id="password1">
                    <div id="password1_err"></div>
                    <br><br>
                    <input class="btn btn-outline-primary" type="submit" value="Register">
                </form>             
                </div>
            </div>

        </div>

    </main>

    <footer class="footer mt-auto py-3">
        <div class="container">
            <span class="text-muted">Place sticky footer content here.</span>
        </div>
    </footer>

    <!-- <script>
        window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>

    <script src="/docs/4.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous">
    </script> -->

    <script src="../public/js/bootstrap.min.js"></script>

    <script>

        function checkErrors(){
            var full_name = $("#full_name").val();
            var phone = $("#phone").val();
            var username = $("#username").val();
            var type = $("#type").val();
            var password = $("#password").val();
            var password1 = $("#password1").val();

            $.ajax({
            type: "post",
            url: "reg_errors.php",
            data: {
                full_name: full_name,
                phone: phone,
                username: username,
                type: type,
                password: password,
                password1: password1,
            },
            success: function (data, status) {
                    // var response = JSON.stringify(data)
                    // console.log(data)
                    var response = JSON.parse(data);
                    for(var feedback in response){
                        // console.log(response[feedback])
                        switch (feedback) {
                        case "full_name_err":
                            if(response[feedback] != ""){
                                $("#full_name").addClass("is-invalid");
                                $("#full_name_err").html(`<div class="text-danger text-small">${response[feedback]}</div>`);
                            }else{
                                $("#full_name").removeClass("is-invalid");
                                $("#full_name").addClass("is-valid");
                                $("#full_name_err").html(`<div class="text-danger text-small"></div>`);
                            }
                            break;
                        case "phone_err":
                        if(response[feedback] != ""){
                                $("#phone").addClass("is-invalid");
                                $("#phone_err").html(`<div class="text-danger text-small">${response[feedback]}</div>`);
                            }else{
                                $("#phone").removeClass("is-invalid");
                                $("#phone").addClass("is-valid");
                                $("#phone_err").html(`<div class="text-danger text-small"></div>`);
                            }
                            break;
                        
                        case "username_err":
                        if(response[feedback] != ""){
                                $("#username").addClass("is-invalid");
                                $("#username_err").html(`<div class="text-danger text-small">${response[feedback]}</div>`);
                            }else{
                                $("#username").removeClass("is-invalid");
                                $("#username").addClass("is-valid");
                                $("#username_err").html(`<div class="text-danger text-small"></div>`);
                            }
                            break;
                        
                        case "type_err":
                        if(response[feedback] != ""){
                                $("#type").addClass("is-invalid");
                                $("#type_err").html(`<div class="text-danger text-small">${response[feedback]}</div>`);
                            }
                            break;
                        
                        case "password_err":
                        if(response[feedback] != ""){
                                $("#password").addClass("is-invalid");
                                $("#password_err").html(`<div class="text-danger text-small">${response[feedback]}</div>`);
                            }else{
                                $("#password").removeClass("is-invalid");
                                $("#password").addClass("is-valid");
                                $("#password_err").html(`<div class="text-danger text-small"></div>`);
                            }
                            break;
                        
                        case "confirm_password_err":
                        if(response[feedback] != ""){
                                $("#password1").addClass("is-invalid");
                                $("#password1_err").html(`<div class="text-danger text-small">${response[feedback]}</div>`);
                            }else{
                                $("#password1").removeClass("is-invalid");
                                $("#password1").addClass("is-valid");
                                $("#password1_err").html(`<div class="text-danger text-small"></div>`);
                            }
                            break;
                        
                        case "general_err":
                        if(response[feedback] != ""){
                                $("#msg").html(`<div class="alert alert-danger">${response[feedback]}</div>`);
                                $("html").animate({scrollTop:0}, 300);
                            }
                        
                        case "status":
                        if(response[feedback] == "error"){
                            $("#msg").html(`<div class="alert alert-warning">Please correct one or more errors below</div>`);
                            $("html").animate({scrollTop:0}, 300);
                        }else if(response[feedback] == "success"){
                            $("#msg").html(`<div class="alert alert-success">Successfully Registered. Redirecting to login page</div>`);
                            $("html").animate({scrollTop:0}, 300);
                            setTimeout(function () {
                                location.href = "login.php";
                            }, 1500);
                            
                        }else{
                            $("#msg").html(`<div class="text-danger text-small">${response[feedback]}</div>`);
                        }
                                                    
                        }
                    }
                },
            error: function(data, status){
                $("#msg").html(`<div class="text-danger text-small">Error Please try again</p></div>`);
            }
            });

        }

        $(document).ready(function () {
            $("#reg-form").on("submit", function(e){
                e.preventDefault()
                // console.log("Submitted")
                checkErrors()
            })
        });

    </script>


</body>

</html>