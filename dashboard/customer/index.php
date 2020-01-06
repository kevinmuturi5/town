<?php
session_start();
require_once "/home2/housinn1/public_html/willie/dashboard/init.php";

// if(count($_COOKIE) > 0){
// if(isset($_COOKIE["cart"])){
//     echo "Hi " . $_COOKIE["cart"];
// } else{
//     echo "Welcome Guest!";
// }
// }
// else{
//     echo "cookie not enabled";
// }

?>



<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Customer Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous"></script>
    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
            integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
            crossorigin="anonymous"></script>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">

    <style>
    
        .cards {
            width: 300px;
            height: 400;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 350px;
            margin: 7px;
            text-align: center;
            font-family: arial;
            float: left;
        }

        .price {
            color: grey;
            font-size: 22px;
            float: left;
        }

        .cards button {
            float: right;
            border: none;
            outline: 0;
            padding: 12px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 40%;
            font-size: 18px;
        }

        .cards button:hover {
            opacity: 0.7;
        }
    
        .dropdown-menu{
            border: none;
        }
        .dropdown-toggle{
            border: none;
            background: none;
        }
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 34rem) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
            .nav-link{
                color: #2eaafc;
            }
            #servicecharter{
                background-color: #f8f9fa;
                -webkit-border-radius: 5px;
                border-color: #dae0e5;
                border-style: solid;
            }
            #md3{
                padding-left: 30px;
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
            <div class="col-md-2" id="features">
                    <h4 style="color: #073d8d">Related Products</h4>
                <hr>
                <!-- <nav class="navbar navbar-light bg-light">
                    <a class="navbar-brand" href="#">Features</a>
                    <div class="navbar-nav">
                        <a class="nav-item nav-link" href="#"><button id="fashion" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Fashion</button><span class="sr-only">(current)</span></a>
                        <div class="dropdown-menu" id="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Shoes</a>
                            <a class="dropdown-item" href="#">Clothing</a>
                            <a class="dropdown-item" href="#">Eye wear</a>
                        </div>
                        <a class="nav-item nav-link" href="#"><button id="food_and_drinks" class="dropdown-toggle">Food and Drinks</button></a>

                        <div class="dropdown-menu" id="food_and_drinks_items" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Restaurants</a>
                            <a class="dropdown-item" href="#">Grills</a>
                            <a class="dropdown-item" href="#">Bars</a>
                        </div>


                        <a class="nav-item nav-link" href="#"><button id="housing" class="dropdown-toggle">Housing</button></a>

                        <div class="dropdown-menu" id="housing_items" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Hotels</a>
                            <a class="dropdown-item" href="#">Lodges</a>
                            <a class="dropdown-item" href="#">Apartments</a>
                        </div>

                        <a class="nav-item nav-link disabled" href="#"><button class="dropdown-toggle">Disabled</button></a>
                    </div>
                </nav> -->
                
               <!-- <button id="click" data-id="mfnbhds">Click</button> -->
               <div class="card mb-2">
                   <figure class="itemside">
                       <div class="aside"><div class="img-wrap img-sm border-right"><img src="https://via.placeholder.com/150" width="100%" height="100px" ></div></div>
                       <figcaption class="p-3">
                           <h6 class="title"><a href="#">Some name of related item goes here</a></h6>
                           <div class="price-wrap">
                               <span class="price-new b">$1280</span>
                               <del class="price-old text-muted">$1980</del>
                           </div>  
                       </figcaption>
                   </figure>
               </div> 

               <div class="card mb-2">
                   <figure class="itemside">
                       <div class="aside"><div class="img-wrap img-sm border-right"><img src="https://via.placeholder.com/150" width="100%" height="100px"></div></div>
                       <figcaption class="p-3">
                           <h6 class="title"><a href="#">Some name of related item goes here</a></h6>
                           <div class="price-wrap">
                               <span class="price-new b">$1280</span>
                               <del class="price-old text-muted">$1980</del>
                           </div> 
                       </figcaption>
                   </figure>
               </div> 
               <nav class="navbar navbar-light bg-light">
                    <a class="navbar-brand" href="#" style="color: #073d8d">Partner Links</a>
                    <div class="navbar-nav">
                        <a class="nav-item nav-link" href="#">Link One</a>
                        <a class="nav-item nav-link" href="#">Link Two</a>

                        <a class="nav-item nav-link" href="#">Link Three</a>

                        <a class="nav-item nav-link" href="#">Link Four</a>
                    </div>
                </nav>

            </div>


            <div class="col-md-6" style="margin-top: 4vh;">
                <hr>
                <div class="dis">

                </div>
            </div>

            <div class="col-md-3" id="md3">
                <h4 style="text-align: center;color: #00a4be">Service Charter</h4>
                <hr>

                <div class="row" id="servicecharter">
                    <p style="text-align: justify; padding-top: 15px; padding-left: 10px; padding-right: 10px;">
                        Good equipments for cooking food and cakes
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <div class="col-md-12 col-center m-auto">
                        <h4 style="color: #073d8d">Testimonials</h4>
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



<!--        --><?php
//        $sql = "SELECT * FROM products";
//        if($result = mysqli_query($conn, $sql)){
//            if(mysqli_num_rows($result) > 0){
//                while($row = mysqli_fetch_assoc($result)){
//                    echo $row["name"]." ";
//                    echo $row["price"]." ";
//                    echo $row["supplier_id"]."<br>";
//                }
//            }
//        }else{
//            echo "Error";
//        }
//        ?>
    </div>


<!--    <!-- The Modal -->
<!--    <div class="modal" id="confirmOrder">-->
<!--        <div class="modal-dialog modal-lg modal-center">-->
<!--            <div class="modal-content">-->
<!---->
<!--                <!-- Modal Header -->
<!--                <div class="modal-header">-->
<!--                    <h4 class="modal-title">Confirm Order</h4>-->
<!--                    <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<!--                </div>-->
<!---->
<!--                <!-- Modal body -->
<!--                <div class="modal-body">-->
<!--                    <div id="confirm-details"></div>-->
<!--                </div>-->
<!---->
<!--                <!-- Modal footer -->
<!--                <div class="modal-footer">-->
<!--                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->


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
