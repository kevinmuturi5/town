<?php
session_start();
require '../init.php';
?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchases</title>
    <link rel="stylesheet" href="../../public/css/main.css">
    <link rel="stylesheet" href="../../public/css/ui-kit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <style>
       .col-md-4,.col-md-8{
           padding: 10px;
           }
        textarea{ padding-top: 10px;}
    </style>
</head>
<body>
<?php include "../../templates/header.php" ?>
<main>
    <br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search by your product name, brand or description" id="search">
                    <div class="input-group-append">
                        <span class="btn btn-outline-dark" id="search-btn">Search</span>
                    </div>
                </div>

                <div class="row m-auto">
                    <div class="col-sm-4 offset-4 text-center">
                        <button class="btn btn-outline-primary m-auto" id="addPurchase-btn" data-toggle="modal">Add Purchase <i class="fa fa-plus"></i></button>
                        <div class="op"></div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12 ">
                <h2>Recent Purchases</h2>
                <table class="table table-striped table-bordered m-auto table-responsive">
                    <thead>
                    <tr>
                        <th>Number</th>
                        <th>Supplier Name</th>
                        <th>KRA PIN</th>
                        <th>Supplier Location</th>
                        <th>Product Name</th>
                        <th>Receipt Number</th>
                        <th>Product Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                        <th>VAT</th>
                        <th>Sub-Total Price</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>SKU</th>
                    </thead>

                    <tbody id="table_result">

                    </tbody>
                </table>
            </div>
        </div>

        </div>
</main>
<!-- Modal -->
<div class="modal fade-in bd-example-modal-lg" id="purchaseModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Purchase</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <h2>Supplier Details</h2>
                            <div class="row">
                                <div class="col-md-4 ml-auto"><label>KRA Pin:</label></div>
                                <div class="col-md-8 ml-auto"><input type="text" id="pin" class="form-control" placeholder="KRA Pin Number"></div>
                            </div>
                            <div class="row">
                        <div class="col-md-4 ml-auto"><label>Name of Supplier:</label></div>
                        <div class="col-md-8 ml-auto"><input type="text" id="name" class="form-control" placeholder="Supplier name"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 ml-auto"><label>Telephone Number:</label></div>
                        <div class="col-md-8 ml-auto"><input type="text" id="tel" class="form-control" placeholder="Phone number"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 ml-auto"><label>Email:</label></div>
                        <div class="col-md-8 ml-auto"><input type="email" id="mail" class="form-control" placeholder="yourname@example.com"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 ml-auto"><label>Location:</label></div>
                        <div class="col-md-8 ml-auto"><textarea placeholder="Address and location" id="loc"></textarea></div>
                    </div>
                    </div>
                        <div class="col-md-6 col-sm-6">
                            <h2>Product Details</h2>
                            <div class="row">
                                <div class="col-md-4 ml-auto"><label>Product Code:</label></div>
                                <div class="col-md-8 ml-auto"><input type="text" id="product_code" class="form-control" placeholder="Product Code, if available"></div>
                            </div>
                    <div class="row">
                        <div class="col-md-4 ml-auto"><label>Product:</label></div>
                        <div class="col-md-8 ml-auto"><input type="text" id="prod" class="form-control" placeholder="Product name"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 ml-auto"><label>Receipt Number:</label></div>
                        <div class="col-md-8 ml-auto"><input type="text" id="receipt" class="form-control" placeholder="Receipt Number"></div>
                    </div>
                     <div class="row">
                         <div class="col-md-4 ml-auto"><label>Description:</label></div>
                         <div class="col-md-8 ml-auto"><input type="text" id="description" class="form-control" placeholder="Product description"></div>
                     </div>
                    <div class="row">
                        <div class="col-md-4 ml-auto"><label>Quantity:</label></div>
                        <div class="col-md-8 ml-auto"><input type="number" id="quantity" class="form-control" placeholder="Number purchased"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 ml-auto"><label>Unit Description:</label></div>
                        <div class="col-md-8 ml-auto"><input type="text" id="unit_description" class="form-control" placeholder="Litres,Kilograms"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 ml-auto"><label>Unit Price:</label></div>
                        <div class="col-md-8 ml-auto"><input type="number" id="unit_price" class="form-control" placeholder="Price of one"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 ml-auto"><label>Total Price:</label></div>
                        <div class="col-md-8 ml-auto"><input type="number" id="price" class="form-control" placeholder="Total price"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 ml-auto"><label>VAT:</label></div>
                        <div class="col-md-8 ml-auto"><input type="number" id="vat" class="form-control" placeholder="VAT in percentage"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 ml-auto"><label>Date:</label></div>
                        <div class="col-md-8 ml-auto"><input type="date" id="date" class="form-control"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 ml-auto"><label>Time:</label></div>
                        <div class="col-md-8 ml-auto"><input type="time" id="time" class="form-control"></div>
                    </div>

                </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div id="error"></div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="purchase-btn">Save</button>
            </div>
        </div>
    </div>
</div>

    </div>
<script src="../../public/js/bootstrap.min.js"></script>
<script type = "text/javascript"
        src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js">
</script>
<?php include "../../templates/footer.php" ?>
</body>
</html>
