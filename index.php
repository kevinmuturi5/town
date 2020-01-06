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

        .card {
            width: 300px;
            height: 400px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 350px;
            max-height: 450px;
            margin: 10px;
            text-align: center;
            font-family: arial;
            float: left;
        }

        .price {
            color: grey;
            font-size: 22px;
            float: left;
        }

        .card button {
            float: right;
            border: none;
            outline: 0;
            padding: 12px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 50%;
            font-size: 18px;
        }

        .card button:hover {
            opacity: 0.7;
        }


    </style>
    <!-- Custom styles for this template -->
    <link href="public/css/main.css" rel="stylesheet">
</head>
<body>
<div id="body">

    <?php include("templates/header.php") ?>
    <main>
        <br>
        <div class="container-fluid">
            <div class="row m-auto">
                <div class="col-md-2 col-sm-1">
                    <!--<h4 style="color: #073d8d">Related Products</h4>-->
                    <!--<hr>-->
               <!--      <div class="card mb-2">-->
               <!--    <figure class="itemside">-->
               <!--        <div class="aside"><div class="img-wrap img-sm border-right"><img src="https://via.placeholder.com/150" width="100%" height="100px" ></div></div>-->
               <!--        <figcaption class="p-3">-->
               <!--            <h6 class="title"><a href="#">Some name of related item goes here</a></h6>-->
               <!--            <div class="price-wrap">-->
               <!--                <span class="price-new b">$1280</span>-->
               <!--                <del class="price-old text-muted">$1980</del>-->
               <!--            </div>  -->
               <!--        </figcaption>-->
               <!--    </figure>-->
               <!--</div> -->

               <!--<div class="card mb-2">-->
               <!--    <figure class="itemside">-->
               <!--        <div class="aside"><div class="img-wrap img-sm border-right"><img src="https://via.placeholder.com/150" width="100%" height="100px"></div></div>-->
               <!--        <figcaption class="p-3">-->
               <!--            <h6 class="title"><a href="#">Some name of related item goes here</a></h6>-->
               <!--            <div class="price-wrap">-->
               <!--                <span class="price-new b">$1280</span>-->
               <!--                <del class="price-old text-muted">$1980</del>-->
               <!--            </div> -->
               <!--        </figcaption>-->
               <!--    </figure>-->
               <!--</div> -->
               <!--<nav class="navbar navbar-light bg-light">-->
               <!--     <a class="navbar-brand" href="#" style="color: #073d8d">Partner Links</a>-->
               <!--     <div class="navbar-nav">-->
               <!--         <a class="nav-item nav-link" href="#">Link One</a>-->
               <!--         <a class="nav-item nav-link" href="#">Link Two</a>-->

               <!--         <a class="nav-item nav-link" href="#">Link Three</a>-->

               <!--         <a class="nav-item nav-link" href="#">Link Four</a>-->
               <!--     </div>-->
               <!-- </nav>-->
                </div>
                <div class="col-sm-10 col-md-8 m-auto">
                     <div class="op"></div>
                    <div class="row" id="row">
                        <div>
                            <h5>Pick an arrangement</h5>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown">Prices
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <button class="btn btn-outline-info form-control" id="asc">Ascending</button>
                                <button class="btn btn-outline-info form-control" id="desc">Descending</button>
                            </ul>
                        </div>
                        <button class="btn btn-outline-success" id="brand">Brand</button>
                        <button class="btn btn-outline-secondary" id="name">Name</button>

                    </div>
                    
                   <!-- <h1 class="text-center">Online Supermarket</h1>-->
                   <!--<form class="mx-auto" role="form" enctype="multipart/form-data" method="post" action="search.php">-->
                   <!--     <div class="text-center" >-->
                   <!--         <img src="public/img/LOGO.png" height="224px" width="150px">-->
                   <!--     </div>-->
                   <!--     <br>-->
                   <!--     <div class="row mx-auto w-100">-->
                   <!--         <div class="col-md-2 col-sm-1"></div>-->
                   <!--         <div class="col-md-8 col-sm-10 mx-auto">-->
                   <!--             <input id="input" class="form-control" type="text" name="product">-->
                   <!--             <br>-->
                   <!--         </div>-->
                   <!--         <div class="col-md-2 col-sm-1"></div>-->
                   <!--     </div>-->
                   <!--     <div class="row w-75 m-auto">-->
                   <!--         <div class="m-auto">-->
                   <!--             <button class="btn btn-outline-secondary" id="search">Search</button>-->
                   <!--             <button class="btn btn-outline-secondary">Feeling Lucky</button>-->
                   <!--         </div>-->
                   <!--     </div>-->
                   <!-- </form>-->
                </div>
              <div class="col-md-2" id="md3">
                <!--<h4 style="text-align: center;color: #00a4be">Service Charter</h4>-->
                <!--<hr>-->

                <!--<div class="row" id="servicecharter">-->
                <!--    <p style="text-align: justify; padding-top: 15px; padding-left: 10px; padding-right: 10px;">-->
                <!--        Good equipments for cooking food and cakes-->
                <!--        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.-->
                <!--    </p>-->
                <!--    <div class="col-md-12 col-center m-auto">-->
                <!--        <h4 style="color: #073d8d">Testimonials</h4>-->
                <!--        <div id="myCarousel" class="carousel slide" data-ride="carousel">-->
                            <!-- Carousel indicators -->
                <!--            <ol class="carousel-indicators">-->
                <!--                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>-->
                <!--                <li data-target="#myCarousel" data-slide-to="1"></li>-->
                <!--                <li data-target="#myCarousel" data-slide-to="2"></li>-->
                <!--            </ol>-->
                            <!-- Wrapper for carousel items -->
                <!--            <div class="carousel-inner">-->
                <!--                <div class="item carousel-item active">-->
                <!--                    <div class="img-box"><img src="/examples/images/clients/1.jpg" alt=""></div>-->
                <!--                    <p class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui.</p>-->
                <!--                    <p class="overview"><b>Paula Wilson</b>, Media Analyst</p>-->
                <!--                </div>-->
                <!--                <div class="item carousel-item">-->
                <!--                    <div class="img-box"><img src="/examples/images/clients/2.jpg" alt=""></div>-->
                <!--                    <p class="testimonial">Vestibulum quis quam ut magna consequat faucibus. Pellentesque eget nisi a mi suscipit tincidunt.</p>-->
                <!--                    <p class="overview"><b>Antonio Moreno</b>, Web Developer</p>-->
                <!--                </div>-->
                <!--                <div class="item carousel-item">-->
                <!--                    <div class="img-box"><img src="/examples/images/clients/3.jpg" alt=""></div>-->
                <!--                    <p class="testimonial">Phasellus vitae suscipit justo. Mauris pharetra feugiat ante id lacinia. Etiam faucibus mauris id tempor egestas.</p>-->
                <!--                    <p class="overview"><b>Michael Holz</b>, Seo Analyst</p>-->
                <!--                </div>-->
                <!--            </div>-->
                            <!-- Carousel controls -->
                <!--            <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">-->
                <!--                <i class="fa fa-angle-left"></i>-->
                <!--            </a>-->
                <!--            <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">-->
                <!--                <i class="fa fa-angle-right"></i>-->
                <!--            </a>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

                <!--<section id="lab_social_icon_footer">-->
                    <!-- Include Font Awesome Stylesheet in Header -->
                <!--    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">-->
                <!--    <div class="container">-->
                <!--        <div class="text-center center-block">-->
                <!--            <a href="https://www.facebook.com/bootsnipp"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>-->
                <!--            <a href="https://twitter.com/bootsnipp"><i id="social-tw" class="fa fa-twitter-square fa-3x social"></i></a>-->
                <!--            <a href="https://plus.google.com/+Bootsnipp-page"><i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i></a>-->
                <!--            <a href="mailto:#"><i id="social-em" class="fa fa-envelope-square fa-3x social"></i></a>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</section>-->
            </div>
            </div>
        </div>
    </main>
    <?php include "templates/footer.php" ?>
    <script src="public/js/bootstrap.min.js"></script>

</body>
</html>
