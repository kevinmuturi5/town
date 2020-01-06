<?php
session_start();
require_once "../init.php";


?>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Supplier Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/main.css">
    <link rel="stylesheet" href="../../public/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../public/css/owl.theme.default.min.css">
    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

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
<?php include "../../templates/header.php" ?>
    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <div class="input-group mb-3 mt-5">
                        <input type="text" class="form-control" placeholder="Search by your product name or description" id="search">
                        <div class="input-group-append">
                            <span class="btn btn-outline-dark" id="search-btn">Search</span>
                        </div>
            </div><div class="col-md-5 offset-3">
                        <div class="op" ></div>
                    </div>
                
                <div class="row" id="card-columns">

                </div>
                

                
            </div>

            </div>
        </div>
<!--    edit modal-->
        <div class="modal" tabindex="-1" role="dialog" id="edit_good">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Sales Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                          <div class="col-md-1">
<!--                                <img src="../../upload/">
                                <input type="file[]" class="form-control" id="edit-image">-->
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <input type="hidden" id="ready_id">
                                    <input type="hidden" id="fraction">
                                </div>
                        <div class="row">
                            <div class="col-md-4">
                            <label>Selling Price</label>
                            </div>
                            <div class="col-md-8">
                            <input type="text" class="form-control" id="edit-selling_price">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Quantity</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="edit-quantity">
                            </div>
                        </div>
                        </div>
                        <div class="col-md-1"></div>
                        </div>
                       </div>
                    <div class="modal-footer">
                        <div id="#edit-error"></div>
                        <button type="button" class="btn btn-primary" id="save">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!--<?php include "templates/footer.php" ?>-->

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

    <script src="../../public/js/bootstrap.min.js"></script>
<script type = "text/javascript"
        src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js">
</script>

</body>

</html>
