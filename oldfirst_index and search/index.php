<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Home</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="public/js/script.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">

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
        main{
            margin-top: 60px;
        }
        #input{
            border-radius: 15px !important;
            height: 40px !important;
            line-height: 40px !important;
        }
        input[type="submit"]{
            height: 36px;
            line-height: 27px;
        }

        input[type="submit"]{
            background-image: -webkit-gradient(linear,left top,left bottom,from(#f5f5f5),to(#f1f1f1));
            background-image: -webkit-linear-gradient(top,#f5f5f5,#f1f1f1);
            -webkit-border-radius: 2px;
            -webkit-user-select: none;
            background-color: #f2f2f2;
            border: 1px solid #f2f2f2;
            border-radius: 4px;
            color: #5F6368;
            cursor: pointer;
            font-family: arial,sans-serif;
            font-size: 14px;
            min-width: 54px;
            padding: 0 16px;
            text-align: center;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="public/css/main.css" rel="stylesheet">
</head>
<body>
<div id="body">

<?php include("templates/header.php") ?>
<main>
<div class="container-fluid">

    <div class="row m-auto">
        <div class="col-md-2 col-sm-1"></div>
        <div class="col-sm-10 col-md-8 m-auto">
            <h1 class="text-center">Online Supermarket</h1>
            <form class="mx-auto" role="form" enctype="multipart/form-data" method="post" action="search.php">
                <div class="text-center" >
                    <img src="public/img/LOGO.png" height="224px" width="150px">
                </div>
                <br>
                <div class="row mx-auto w-100">
                    <div class="col-md-2 col-sm-1"></div>
                    <div class="col-md-8 col-sm-10 mx-auto">
                    <input id="input" class="form-control" type="text" id=""  name="product">
                    <br>
                    </div>
                    <div class="col-md-2 col-sm-1"></div>
                </div>
                <div class="row w-75 m-auto">
                    <div class="m-auto">
                    <button class="btn btn-outline-secondary">Search</button>
                    <button class="btn btn-outline-secondary">Feeling Lucky</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-2 col-sm-1"></div>
    </div>
</div>
</main>

<?php include "templates/footer.php" ?>
<script src="public/js/bootstrap.min.js"></script>

</body>
</html>
