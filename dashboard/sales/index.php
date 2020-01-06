<?php
session_start();
require "../init.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Sale</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/main.css">
    <link rel="stylesheet" href="../../public/css/ui-kit.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="script.js"></script>

    <!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"-->
    <!--          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"-->
    <!--            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php include '../../templates/header.php'?>
<main>
<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-md-2"></div>
               <div class="col-md-8">
                <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search by your product name, brand or description" id="search">
                        <div class="input-group-append">
                            <span class="btn btn-outline-info" id="search-btn">Search</span>
                        </div>
                </div>
                <div class="row m-auto">
                    <div class="col-md-1"></div>
                       <div class="col-md-10 text-center">
                        <button class="btn btn-outline-info m-auto pl-4 pr-4" id="add-btn">Add Sale <i class="fa fa-plus"></i></button>
                        <div class="op"></div>
                       </div>
                    <div class="col-md-1"></div>
                </div>
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="row">
        <div class="col-md-1"></div>
          <div class="col-md-10 col-sm-12">
           <h2>Commodity on sale</h2>
            <table class="table table-hover text-center" id="sales">
                <thead>
                <tr>
                    <th>Receipt ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Fraction</th>
                    <th>Unit price</th>
                    <th>SKU</th>
                    <th>VAT</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="table-data">
                    
                </tbody>
            </table>
        </div>

        <div class="col-md-1"></div>
        
        </div>
        </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade-in" id="add-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Sale</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid">
                <div class="row">
                    <form method="POST" enctype="multipart/form-data">
                        <aside class="col-sm-12">
                            <article class="p-5">
                                <dl class="row">

                                    <dt class="col-sm-4">SKU</dt>
                                    <dd class="col-sm-8">
                                        <input name="sku" class="form-control" type="text" placeholder="354346343" id="sku">
                                    </dd>

                                    <dt class="col-sm-4">Receipt ID</dt>
                                    <dd class="col-sm-8">
                                        <input name="receipt_id" class="form-control" type="text" placeholder="3543" id="receipt_id">
                                    </dd>

                                    <dt class="col-sm-4">Name</dt>
                                    <dd class="col-sm-8">
                                        <b id="product_name"></b>
                                    </dd>

                                    <dt class="col-sm-4">Unit Price</dt>
                                    <dd class="col-sm-8">
                                        <b id="unit_price"></b>
                                    </dd>

                                    <dt class="col-sm-4">Fraction</dt>
                                    <dd class="col-sm-8">
                                        <input name="fraction" class="form-control" type="text" placeholder="1/8" id="fraction">
                                    </dd>

                                    <dt class="col-sm-4">Quantity</dt>
                                    <dd class="col-sm-8">
                                        <input name="quantity" class="form-control" type="number" placeholder="50" id="quantity">
                                    </dd>

                                    <dt class="col-sm-4">VAT</dt>
                                    <dd class="col-sm-8">
                                        <input name="vat" class="form-control" type="text" placeholder="Enter VAT. Leave blank for default 16%" id="vat">
                                    </dd>

                                    <dt class="col-sm-4">Total Price</dt>
                                    <dd class="col-sm-8">
                                        <b id="total_price"></b>
                                    </dd>

                                </dl>
                            </article> <!-- card-body.// -->
                        </aside>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="mr-3" id="error"></div>
                <button type="button" id="add-submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</main>
<script src="../../public/js/bootstrap.min.js"></script>
    <script type = "text/javascript" 
         src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js">
      </script>
    <?php include "../../templates/footer.php" ?>
</body>
</html>

