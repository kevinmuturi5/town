<?php
session_start();
require "../init.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventory</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/main.css">
    <link rel="stylesheet" href="../../public/css/ui-kit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <?php include "../../templates/header.php" ?>
    <main>
        <div class="container-fluid">

            <div class="row mt-5 mr-auto ml-auto">
                <div class="col-md-2"></div>

                <div class="col-md-8 col-sm-12">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search by your product name, brand or description" id="search">
                        <div class="input-group-append">
                        <span class="btn btn-outline-info" id="search-btn">Search</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-2"></div>
            </div>

            <div class="row m-auto">
                <div class="col-sm-4"></div>
                <div class="col-sm-4 text-center">
                <button class="btn btn-outline-primary m-auto" data-toggle="modal" data-target="#add_product">Add Product <i class="fa fa-plus"></i></button>
                <div class="op"></div>
                </div>
                <div class="col-sm-4"></div>
            </div>

            <div class="row mt-1">
                <div class="col-md-12">
                    <h2>Inventory</h2>
                    <table class="table table-striped table-responsive table-bordered m-auto">
                        <thead>
                        <tr>
                            <th>Number</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Brand</th>
                            <th>Quantity</th>
                            <th>Buying Price</th>
                            <th>Availablity</th>
                            <th>SKU</th>
                            <th>Images</th>
                            <th>Action</th>
                        </tr>

                        </thead>
                        <tbody id="table-result">

                        </tbody>
                    </table>
            </div>
        </div>
    </main>

    <!-- Add Product Modal -->
    <div class="modal fade-in" id="add_product" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Product</h5>
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
                    <dt class="col-sm-3">Name</dt>
                    <dd class="col-sm-8">
                    <input class="form-control" type="text" name="name" placeholder="Printing papers" id="name">
                    </dd>

                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-8"><textarea class="form-control" type="text" name="description" placeholder="Gold printing papers" id="description"></textarea>

                    <dt class="col-sm-3">Brand</dt>
                    <dd class="col-sm-8">
                    <input class="form-control" type="text" name="brand" placeholder="brand" id="brand">
                    </dd>

                    <dt class="col-sm-3">Selling Price Per Unit</dt>
                    <dd class="col-sm-8">
                        <input name="price" class="form-control" type="number" placeholder="150" id="unit_price">
                    </dd>
             
                    <dt class="col-sm-3">Unit Description</dt>
                    <dd class="col-sm-8">
                        <input name="unit_description" class="form-control" type="text" placeholder="Per Dozens, Ream, Kilogram, etc" id="unit_description">
                    </dd>

                    <dt class="col-sm-3">Quantity</dt>
                    <dd class="col-sm-8">
                        <input name="quantity" class="form-control" type="number" placeholder="50" id="quantity">
                    </dd>


                    <dt class="col-sm-3">Product Code / SKU</dt>
                    <dd class="col-sm-8">
                        <input name="sku" class="form-control" type="text" placeholder="354346343" id="sku">
                    </dd>

                    <dt class="col-sm-3">Size/Weight</dt>
                    <dd class="col-sm-8">
                        <input name="size" class="form-control" type="text" placeholder="14 Grams" id="size">
                    </dd>

                    <dt class="col-sm-3">Color</dt>
                    <dd class="col-sm-8">
                        <input name="color" class="form-control" type="text" placeholder="Gold" id="color">
                    </dd>

                    <dt class="col-sm-3">Images</dt>
                    <dd class="col-sm-8">
                        <input name="images[]" class="form-control" type="file" placeholder="Upload Product Images" id="images" multiple>
                    </dd>

                    <dt class="col-sm-2"></dt>
                    <dd class="col-sm-10">
                        <div id="previewTab" class="row m-auto mb-4"></div>
                    </dd>

                    <dt class="col-sm-3">Other Properties</dt>
                    <dd class="col-sm-8">
                        <input name="other" class="form-control" type="text" placeholder="Enter other descriptive properties in the format property:value eg; RAM:4k, processor: i3 " id="other">
                    </dd>
                    
                </dl>

                <div class="rating-wrap">
                    <div class="col-sm-7 mt-4">
                        <label for="available"><b>Available</b></label>
                        <input type="radio" name="available" checked="checked" value="yes"> Yes
                        <input class="ml-3" type="radio" name="available" value="no"> No<br>
                    </div> <!-- col.// -->
                </div> <!-- row.// -->
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


    <!-- Edit Product Modal -->
    <div class="modal fade-in" id="edit_product" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid">
                <div class="row">
                    <form method="POST" enctype="multipart/form-data">
                <aside class="col-sm-12">
                <article class="p-5">    
                    <input type="text" id="edit-id" hidden>             
                <dl class="row">
                    <dt class="col-sm-3">Name</dt>
                    <dd class="col-sm-8">
                    <input class="form-control" type="text" name="name" placeholder="Printing papers" id="edit-name">
                    </dd>

                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-8"><textarea class="form-control" type="text" name="description" placeholder="Gold printing papers" id="edit-description"></textarea>

                    <dt class="col-sm-3">Brand</dt>
                    <dd class="col-sm-8">
                    <input class="form-control" type="text" name="brand" placeholder="brand" id="edit-brand">
                    </dd>

                    <dt class="col-sm-3">Selling Price Per Unit</dt>
                    <dd class="col-sm-8">
                        <input name="price" class="form-control" type="number" placeholder="150" id="edit-unit_price">
                    </dd>
             
                    <dt class="col-sm-3">Unit Description</dt>
                    <dd class="col-sm-8">
                        <input name="unit_description" class="form-control" type="text" placeholder="Per Dozens, Ream, Kilogram, etc" id="edit-unit_description">
                    </dd>

                    <dt class="col-sm-3">Quantity</dt>
                    <dd class="col-sm-8">
                        <input name="quantity" class="form-control" type="number" placeholder="50" id="edit-quantity">
                    </dd>


                    <dt class="col-sm-3">Product Code / SKU</dt>
                    <dd class="col-sm-8">
                        <input name="sku" class="form-control" type="text" placeholder="354346343" id="edit-sku">
                    </dd>

                    <dt class="col-sm-3">Size/Weight</dt>
                    <dd class="col-sm-8">
                        <input name="size" class="form-control" type="text" placeholder="14 Grams" id="edit-size">
                    </dd>

                    <dt class="col-sm-3">Color</dt>
                    <dd class="col-sm-8">
                        <input name="color" class="form-control" type="text" placeholder="Gold" id="edit-color">
                    </dd>

                    <dt class="col-sm-3">Images</dt>
                    <dd class="col-sm-8">
                        <input name="images[]" class="form-control" type="file" placeholder="Upload Product Images" id="edit-images" multiple>
                    </dd>

                    <dt class="col-sm-2"></dt>
                    <dd class="col-sm-10">
                        <div id="editPreview" class="row m-auto mb-4"></div>
                    </dd>

                    <dt class="col-sm-2"></dt>
                    <dd class="col-sm-10">
                        <h4 class="text-info text-center mt-3">Existing Images</h4>
                        <div id="existingImagePreview" class="row mb-4"></div>
                    </dd>

                    <dt class="col-sm-2">Other Properties</dt>
                    <dd class="col-sm-10">
                        <input name="other" class="form-control" type="text" placeholder="Enter other descriptive properties in the format property:value eg; RAM:4k, processor: i3 " id="edit-other">
                    </dd>
                </dl>

                <div class="rating-wrap">
                    <div class="col-sm-7 mt-4">
                        <label for="available"><b>Available</b></label>
                        <input type="radio" name="edit-available" value="yes"> Yes
                        <input class="ml-3" type="radio" name="edit-available" value="no"> No<br>
                    </div> <!-- col.// -->
                </div> <!-- row.// -->
                </article> <!-- card-body.// -->
                </aside>
                </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="mr-3" id="edit-error"></div>

                <button type="button" id="edit-submit"  class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>


        <!-- Edit Product Modal -->
        <div class="modal fade-in" id="prepare-product" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Prepare Product for sale</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid">
                <div class="row">
                    <form method="POST" enctype="multipart/form-data">
                <aside class="col-sm-12">
                <article class="p-5">    
                    <input type="text" id="edit-id" hidden>             
                <dl class="row">
                    <dt class="col-sm-5">Product Name: </dt>
                    <dd class="col-sm-6">
                        <b id="product-name"></b>
                        <input type="text" id="id" hidden>
                        <input type="text" id="sku" hidden>
                    </dd>

                    <dt class="col-sm-5">Buying Price: </dt>
                    <dd class="col-sm-6">
                        <b id="buying-price"></b>
                    </dd>

                    <dt class="col-sm-5">Expenses: </dt>
                    <dd class="col-sm-6">
                    <input class="form-control" type="text" name="expense" placeholder="Enter total expenses" id="expenses">
                    </dd>

                    <dt class="col-sm-5">Profit Margin: </dt>
                    <dd class="col-sm-6">
                    <input class="form-control" type="text" name="price" id="profit-margin" >
                    </dd>

                    <dt class="col-sm-5">Selling Price: </dt>
                    <dd class="col-sm-6">
                        <b id="selling-price"></b>
                    </dd>

                    <dt class="col-sm-5">Fraction: </dt>
                    <dd class="col-sm-6">
                        <input name="fraction" class="form-control" type="text" placeholder="Fraction of the product to prepare for sale" id="fraction">
                    </dd>
             
                    <dt class="col-sm-5">Quantity: </dt>
                    <dd class="col-sm-6">
                        <input name="amount" class="form-control" type="text" placeholder="Quantity of fraction to be prepared for sale" id="amount">
                    </dd>
                </dl>
                </article> <!-- card-body.// -->
                </aside>
                </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="mr-3" id="prepare-error"></div>

                <button type="button" id="prepare-submit" class="btn btn-primary">Prepare</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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