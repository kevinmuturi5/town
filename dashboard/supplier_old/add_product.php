

<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Add products</title>
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
<header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
            <a class="navbar-brand" href="customer.php">
                <img src="../../public/img/LOGO.png" width="50px" height="50px" alt="Homepage">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active mr-4">
                        <a class="nav-link" href="orders.php">Orders</a>
                    </li>

                    <li class="nav-item active mr-4">
                        <a class="nav-link" href="../../auth/logout.php">Logout</a>
                    </li>

                    <li class="nav-item ml-auto">

                        <img onclick="toggleServices()" src="../../public/img/services.png" width="20px" height="20px" alt="">
                    </li>

                </ul>
                <!-- <form class="form-inline mt-2 mt-md-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form> -->
            </div>
        </nav>
    </header>

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-sm-8 col-md-6 col-lg-5 col- m-auto table-responsive-sm">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
                    <label class="form-check-label" for="product">Product Name</label>
                    <input class="form-control" type="text" name="product">
                    <br>
                    <label for="description">Product Description</label>
                    <textarea class="form-control" type="text"  name="description"></textarea>
                    <br>
                    <label for="color">Color</label>
                    <input class="form-control" type="text" name="color">
                    <br>
                    <label for="price">Price</label>
                    <input class="form-control" type="number" name="price">
                    <br>
                    <label for="quantity">Quantity in Stock</label>
                    <input class="form-control" type="number" name="quantity">
                    <br>
                    <label for="unit_desc">Unit Description</label>
                    <input class="form-control" type="text" name="unit_desc">
                    <br>
                    <label for="images"></label>
                    <input type="file" name="images[]" multiple>
                    <br><br>
                    <input class="btn btn-primary" type="submit" value="Add Product">
                </form>             
                </div>
            </div>
<?php
require "init.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $product = $description = $color = $price = $size = $quantity = $units_desc = $availabity = $images = "";

    // if(empty($_POST["product"]) || empty($_POST["description"])){
    //     echo "Cannot add product";
    // }else{
        $product = trim($_POST["product"]);
        $description = trim($_POST["description"]);
        $unit_desc = trim($_POST["desc"]);
        $color = trim($_POST["color"]);
        $price = trim($_POST["price"]);
        $quantity = trim($_POST["quantity"]);

        $targetDir = "../../upload/";
        $allowTypes = array('jpg','png','jpeg','gif');

        if(!empty($_FILES["images"])){
            $image_arr = array();
            // print_r ($_FILES);
            foreach ($_FILES["images"]["name"] as $key=>$val) {
                // echo $_FILES["images"]["name"][$key];


                $fileName = basename($_FILES['images']['name'][$key]);
                $targetFilePath = $targetDir . $fileName;
                // echo $targetFilePath;
                // Check whether file type is valid
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                if(in_array($fileType, $allowTypes)){
                    // Upload file to server
                    if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFilePath)){
                        // Image db insert sql
                        $images .= "$fileName,";
                    }else{
                        // $errorUpload .= $_FILES['files']['name'][$key].', ';
                        echo "Error 1";
                    }
                }else{
                    // $errorUploadType .= $_FILES['files']['name'][$key].', ';
                    echo "Error 2";
                }
            }
                
            //     if(!empty($insertValuesSQL)){
            //         $insertValuesSQL = trim($insertValuesSQL,',');
            //         // Insert image file name into database
            //         $insert = $db->query("INSERT INTO images (file_name, uploaded_on) VALUES $insertValuesSQL");
            //         if($insert){
            //             $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
            //             $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
            //             $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
            //             $statusMsg = "Files are uploaded successfully.".$errorMsg;
            //         }else{
            //             $statusMsg = "Sorry, there was an error uploading your file.";
            //         }
            //     }
            // }else{
            //     $statusMsg = 'Please select a file to upload.';
            // }
            
            // Display status message
            // echo (implode(",", $image_arr));
                 $insert = "INSERT INTO products (name, price, supplier_id, unit_description, available)

                 VALUES ('$product', '$price' , '$supplier_id' , '$unit_desc' , 1)";
                
                if($result = mysqli_query($conn, $insert)){
                    $product_id = mysqli_insert_id($conn);
                    $insert_details = "INSERT INTO product_description (color, quantity, description, product_id, images)
                    VALUES('$color', '$quantity', '$description', '$product_id', '$images')";

                    if($result = mysqli_query($conn, $insert_details)){
                        echo "Success";
                    }else{
                        echo "Failure. Cant add Desc".mysqli_error($conn);
                    }
                }else{
                    echo "Failure. Cant Insert product".mysqli_error($conn);
                }
            echo $insert;

            // echo $statusMsg;
            }


        // $sql = "INSERT INTO products (name, price, supplier_id)
        // VALUES ('$product','$price','$supplier_id')";
        
        // $result = mysqli_query($conn, $sql);

        // if($result){
        //     $product_id = mysqli_insert_id($conn);
        //     $sql = "INSERT INTO product_description (color, size, quantity, description, product_id)
        //     VALUES ('$color','$size', '$quantity', '$description', '$product_id' )";
            
        //     if(mysqli_query($conn, $sql)){
        //         echo "Added the product_description succesfully";
        //         header("location:supplier.php");
        //     }else{
        //         echo "Could not add description".mysqli_error($conn);
        //     }
        // }else{
        //     echo "Could not add product".mysqli_error($conn);
        // }

}

?>

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


</body>

</html>
