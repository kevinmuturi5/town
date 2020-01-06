<?php
require_once "init.php";
?>



<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Customer Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">

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
    <link href="../../public/css/main.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">

    <?php include_once("../../templates/header.php") ?>
    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container-fluid">
            <div class="row mt-5">

                <div class="col-md-2">
                    <h4>Related Products</h4>
                    <button id="click" data-id="mfnbhds">Click</button>
                    <div class="card mb-2">
                        <figure class="itemside">
                        <div class="aside"><div class="img-wrap img-sm border-right"><img src="https://via.placeholder.com/150" width="100%" height="100px" ></div></div>
                        <figcaption class="p-3">
                            <h6 class="title"><a href="#">Some name of related item goes here</a></h6>
                            <div class="price-wrap">
                                <span class="price-new b">$1280</span>
                                <del class="price-old text-muted">$1980</del>
                            </div> <!-- price-wrap.// -->
                        </figcaption>
                    </figure> 
                    </div> <!-- card.// -->
                   
                    <div class="card mb-2">
                        <figure class="itemside">
                        <div class="aside"><div class="img-wrap img-sm border-right"><img src="https://via.placeholder.com/150" width="100%" height="100px"></div></div>
                        <figcaption class="p-3">
                            <h6 class="title"><a href="#">Some name of related item goes here</a></h6>
                            <div class="price-wrap">
                                <span class="price-new b">$1280</span>
                                <del class="price-old text-muted">$1980</del>
                            </div> <!-- price-wrap.// -->
                        </figcaption>
                    </figure> 
                    </div> <!-- card.// -->
              
                    <div class="card mb-2">
                        <figure class="itemside">
                        <div class="aside"><div class="img-wrap img-sm border-right"><img src="https://via.placeholder.com/150" width="100%" height="100px"></div></div>
                        <figcaption class="p-3">
                            <h6 class="title"><a href="#">Some name of related item goes here</a></h6>
                            <div class="price-wrap">
                                <span class="price-new b">$1280</span>
                                <del class="price-old text-muted">$1980</del>
                            </div> <!-- price-wrap.// -->
                        </figcaption>
                    </figure> 
                    </div> <!-- card.// -->
                   
                    <div class="card mb-2">
                        <figure class="itemside">
                        <div class="aside"><div class="img-wrap img-sm border-right"><img src="https://via.placeholder.com/150" width="100%" height="100px"></div></div>
                        <figcaption class="p-3">
                            <h6 class="title"><a href="#">Some name of related item goes here</a></h6>
                            <div class="price-wrap">
                                <span class="price-new b">$1280</span>
                                <del class="price-old text-muted">$1980</del>
                            </div> <!-- price-wrap.// -->
                        </figcaption>
                    </figure> 
                    </div> <!-- card.// -->                    

                </div>


                <div class="col-md-6">

                        <div class="input-group md-form form-sm form-2 pl-0">
                            <input class="form-control my-0 py-1 amber-border" id="search" type="text" placeholder="search for products" aria-label="Search">
                            <div class="input-group-append">
                                <button class="input-group-text btn amber lighten-3" id="search-btn">
                                    <!-- <i class="fas fa-search text-grey" aria-hidden="true"></i> -->
                                    Submit
                                </button>
                            </div>
                        </div>

                    <div id="product-row" class="mt-5">
                        
                    </div>


                </div>

                <div class="col-md-4">
                    <h4>Service Charter</h4>
                    <p>
                        Good equipments for cooking food and cakes
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>

                    <div class="row">
                        <div class="col-md-8 col-center m-auto">
                            <h2>Testimonials</h2>
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Carousel indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                    <li data-target="#myCarousel" data-slide-to="2"></li>
                                </ol>   
                                <!-- Wrapper for carousel items -->
                                <div class="carousel-inner">
                                    <div class="item carousel-item active">
                                        <div class="img-box"><img src="/examples/images/clients/1.jpg" alt=""></div>
                                        <p class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui.</p>
                                        <p class="overview"><b>Paula Wilson</b>, Media Analyst</p>
                                    </div>
                                    <div class="item carousel-item">
                                        <div class="img-box"><img src="/examples/images/clients/2.jpg" alt=""></div>
                                        <p class="testimonial">Vestibulum quis quam ut magna consequat faucibus. Pellentesque eget nisi a mi suscipit tincidunt.</p>
                                        <p class="overview"><b>Antonio Moreno</b>, Web Developer</p>
                                    </div>
                                    <div class="item carousel-item">
                                        <div class="img-box"><img src="/examples/images/clients/3.jpg" alt=""></div>
                                        <p class="testimonial">Phasellus vitae suscipit justo. Mauris pharetra feugiat ante id lacinia. Etiam faucibus mauris id tempor egestas.</p>
                                        <p class="overview"><b>Michael Holz</b>, Seo Analyst</p>
                                    </div>
                                </div>
                                <!-- Carousel controls -->
                                <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <section id="lab_social_icon_footer">
                        <!-- Include Font Awesome Stylesheet in Header -->
                        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
                        <div class="container">
                                <div class="text-center center-block">
                                        <a href="https://www.facebook.com/bootsnipp"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>
                                        <a href="https://twitter.com/bootsnipp"><i id="social-tw" class="fa fa-twitter-square fa-3x social"></i></a>
                                        <a href="https://plus.google.com/+Bootsnipp-page"><i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i></a>
                                        <a href="mailto:#"><i id="social-em" class="fa fa-envelope-square fa-3x social"></i></a>
                            </div>
                        </div>
                    </section>
                </div>

            </div>

        </div>


            <!-- The Modal -->
            <div class="modal" id="confirmOrder">
            <div class="modal-dialog modal-lg modal-center">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Confirm Order</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div id="confirm-details"></div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

                </div>
            </div>
            </div>


    </main>

    <?php include "../../templates/footer.php"; ?>

    <!-- <script>
        window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>

    <script src="/docs/4.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous">
    </script> -->

    <script src="../../public/js/bootstrap.min.js"></script>
</body>

</html>
