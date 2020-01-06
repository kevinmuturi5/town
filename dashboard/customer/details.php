<?php
/**
 * Created by PhpStorm.
 * User: nabesh
 * Date: 7/24/19
 * Time: 12:52 PM
 */
 
session_start();
$_SESSION["id"]=$_SESSION["id"];
$user_id=$_SESSION["id"];

$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
$url=$_SESSION['current_page'];

if(isset($_POST['logintorder'])){
  header('location:../../auth/redirect.php');
}

require_once '../init.php';
$id = $_GET['product_id'];
    $sql1 = "select sum(units) as orders from orders where product_id='$id'";
    $result1 = mysqli_query($conn, $sql1);
    $rows1=mysqli_fetch_assoc($result1);
    $data1=$rows1;


    $id = $_GET['product_id'];
    $sql = "select p.id as pid, p.supplier_id as supplier_id, p.name as prod_name, p.sku as sku, p.description as description, p.images as images,p.color as color, 
            r.selling_price as selling_price, r.quantity as quantity from products p inner join ready_sale r on p.id = r.product_id where r.id = '$id'";
    if ($result = mysqli_query($conn, $sql)) {
        if ($count = mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
                $data = $row;
            }
            if($data["images"] != "") {
                $images = explode(",", $data["images"]);
            }
            

        }
        else{
            echo '<div class="error">Product currently unavailable</div>';
        }

    }
?>

</<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Details</title>
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


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
       <link href="../../public/css/main.css" rel="stylesheet">
    <link href="css/lightbox.min.css">
    <script src="script.js"></script>
<!--    <script src="js/lightbox-plus-jquery.min.js"></script>-->
       <style>
           img{
               padding: 10px;
           }
        img:hover{
            transform: scale(1.1);
        }
    </style>

</head>
<body>
<?php include '../../templates/header.php'?>
<main role="main" class="flex-shrink-0">
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-8 m-auto">
                <div class="op"></div>
              <div class="card">
                    <div class="row no-gutters">
                        <aside class="col-sm-5 border-right">
                            <article class="gallery-wrap">
                                <div class="img-big-wrap">
                                    <div>
                                        <?php
                                        //display image
                                        if (!empty($images)){
                                     "<a href='../../upload/$images[0]'><img src='../../upload/{$images[0]}' width='100%' height='50%'>view</a>";
                                        foreach ($images as $image) {
                                            //getting the rest of the images in the array
                                         echo "<a href='../../upload/{$image}' <!--data-ligthbox='mygallery'--> ><img src='../../upload/$image' width='100%' height='50%'>view</a>";
                                        }}else{
                                            "<img src='https://placeholder.com/150'>";
                                        }

                                        ?>
                                </div> <!-- slider-product.// -->

                                <div class="img-small-wrap">

                                </div> <!-- slider-nav.// -->
                            </article> <!-- gallery-wrap .end// -->
                        </aside>
                        <aside class="col-sm-7">
                            <article class="p-5">
                                <h3 class="title mb-3" id="prod_name"><?php echo $data["prod_name"]; ?></h3>
                                <div class="mb-3">
                                    <var class="price h3 text-warning">
                                        <span class="currency">KES </span><span class="num" id="price"><?php echo $data["selling_price"]; ?></span>
                                    </var>
                                    <span></span>
                                </div> <!-- price-detail-wrap .// -->
                                <dl>
                                    <dt>Description</dt>
                                    <dd><p><?php echo $data["description"]; ?></p></dd>
                                </dl>
                                <dl class="row">
<!--                                    <dt class="col-sm-3">Model#</dt>-->
<!--                                    <dd class="col-sm-9">12345611</dd>-->

                                    <dt class="col-sm-3">Color</dt>
                                    <dd class="col-sm-9"><?php echo $data["color"];?>
                                    </dd>

<!--                                    <dt class="col-sm-3">Delivery</dt>-->
<!--                                    <dd class="col-sm-9">Russia, USA, and Europe </dd>-->
                                </dl>
                                <div class="rating-wrap">

                                    <ul class="rating-stars list-unstyled">
                                        <li style="width:80%" class="stars-active">
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </li>
                                    </ul>
                                    <div class="label-rating"><?php echo $data1["orders"]; ?> orders </div>
                                </div> <!-- rating-wrap.// -->
                                <hr>
                                <form method="POST">
                                    <input id="pid" type="text" name="id" hidden value="<?php echo $data["pid"]; ?>">
                                    <input id="sku" type="text" name="sku" hidden value="<?php echo $data["sku"]; ?>">
                                     <input id="supplier_id" type="text" name="supplierid" hidden value="<?php echo $data["supplier_id"]; ?>">

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <dl class="dlist-inline">
                                                <dt>Quantity: </dt>
                                                <dd>
                                                    <select id="units" name="units" class="form-control form-control-sm" style="width:70px;">
                                                        <option> 1 </option>
                                                        <option> 2 </option>
                                                        <option> 3 </option>
                                                        <option> 4 </option>
                                                        <option> 5 </option>
                                                        <option> 6 </option>
                                                        <option> 7 </option>
                                                        <option> 8 </option>
                                                        <option> 9 </option>
                                                    </select>
                                                </dd>
                                            </dl>  <!-- item-property .// -->
                                        </div> <!-- col.// -->
                                        <div class="col-sm-7">
                                            <dl class="dlist-inline">
                                                <dt>Size: </dt>
                                                <dd>
                                                    <label class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                        <span class="form-check-label">SM</span>
                                                    </label>
                                                    <label class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                        <span class="form-check-label">MD</span>
                                                    </label>
                                                    <label class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                        <span class="form-check-label">XXL</span>
                                                    </label>
                                                    
                                                </dd>
                                            </dl>  <!-- item-property .// -->
                                        </div> <!-- col.// -->
<!--                                        data-id ='--><?php //echo $data["id"] ?><!--'-->
                                    </div> <!-- row.// -->
                                    <hr>
                                   

                                 <?php 
                                       if($user_id){
                                            echo"<input type='submit' name='orderbtn' id='cartBtn' value='Add to cart' class='btn btn-sm btn-primary float-right'  data-id ='".$id."'>";
                                       }
                                       else{
                                            echo"<input type='submit' name='logintorder' value='Login to Add to cart' class='btn btn-sm btn-primary float-right' >";
                                       }
                                 ?>
                                    
                           </form>
                                <!-- <a href="#" class="btn  btn-outline-primary"> <i class="fas fa-shopping-cart"></i> Add to cart </a> -->
                            </article> <!-- card-body.// -->
                        </aside> <!-- col.// -->
                    </div> <!-- row.// -->
                </div> <!-- card.// -->
            </div>

        </div>
    </div>
</main>
<?php include '../../templates/footer.php';?>
<?php 


    $id = $_GET['product_id'];
    $sql = "select p.id as pid, p.supplier_id as supplier_id, p.name as prod_name, p.sku as sku, p.description as description, p.images as images,p.color as color, 
            r.selling_price as selling_price, r.quantity as quantity from products p inner join ready_sale r on p.id = r.product_id where r.id = '$id'";
    $result = mysqli_query($conn, $sql);
    $rows=mysqli_fetch_assoc($result);
    $data=$rows;
      
      
    if(isset($_POST["orderbtn"])){
        
        $user_id=$_SESSION["id"];
         $qnty=$_POST["units"];
         $supplier=$data["supplier_id"];
         $description=$data["description"];
         $cost=$data["selling_price"];
         $pid=$data["pid"];
         echo $seccode=rand(1000,100000);
     $sql4="select * from orders where customer_id=$user_id and product_id=$pid and status='unconfirmed'";
     $resultsel=mysqli_query($conn,$sql4);
     $rowres=mysqli_fetch_assoc($resultsel);
     $numrows=mysqli_num_rows($resultsel);
    if($numrows>0){
     $sql3="update orders set units=units+$qnty where customer_id=$user_id and product_id=$pid and status='unconfirmed'";
     $resupdate=mysqli_query($conn,$sql3);
    }
    else{
    
        $sql2="INSERT INTO orders VALUES (NULL, '$user_id', '$pid', '$qnty', '$supplier', '$description', '$cost','unconfirmed','$seccode')";
        $res=mysqli_query($conn,$sql2);
        
     }
}


 
?>
</body>
</html>
