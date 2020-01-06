<?php
require_once ('../init.php');
session_start();
// unset($_COOKIE['cart']);
// setcookie('cart', '', time() - 3600, '/');

if ($_SERVER["REQUEST_METHOD"] == "GET"){
  if (isset($_COOKIE["cart"])){
    $cart = json_decode($_COOKIE["cart"], true);
    if(!count($cart) > 0){
        $message = 'You have zero items on your cart. Add more items <a href="index.php">Here</a>';
    }
    
  }else{
        //CART COOKIE NOT SET 
        $message = 'You have zero items on your cart. Add more items <a href="index.php">Here</a>';
  }
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cart</title>
    <!-- CSS -->
  <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../public/css/ui-kit.css">
  <link rel="stylesheet" href="../../public/css/main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="script.js"></script>

</head>
<body>
    <?php include "../../templates/header.php" ?>
    <main role="main" class="mt-3">
      <div class="container-fluid">
          <div class="mt-5">
          <div class="card">
            <table class="table table-hover shopping-cart-wrap">
              <thead class="text-muted">
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Fraction</th>
                <th scope="col" width="120">Quantity</th>
                <th scope="col" width="120">Price</th>
                <th scope="col" width="200" class="text-right">Action</th>
              </tr>
              </thead>
              <tbody>
          <?php
          

          if (isset($cart) && count($cart) > 0 ){
            $total_price = 0;

          
            foreach($cart as $item=>$ready_id){
          $qry="select * from ready_sale where id='$item'";
          $qryres=mysqli_query($conn,$qry); 
          $output=mysqli_fetch_assoc($qryres);
          $prod_id=$output['product_id'];


              $sql = "SELECT o.customer_id customer,p.id product,r.fraction, sum(r.selling_price) as selling_price, r.id, p.name as product_name,p.supplier_id as supplier,p.unit_price as cost,p.description as description, p.images as images, p.color as color,sum(o.units) as units
              FROM ready_sale r 
              INNER JOIN products p ON r.product_id = p.id join orders o on(p.id=o.product_id) where o.customer_id=$user_id group by o.customer_id,product";

              if($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_assoc($result)){
                  $selling_price = $row["units"] * $row["selling_price"];
                  $total_price += $selling_price;
                  if($row["images"] != ""){
                      $images = explode(",", $row["images"]);
                      $src = $images[0];
                    }else{
                      $src = "https://via.placeholder.com/150";
                    }
                    

                  echo "<tr>
                 <td>
                  <figure class='media'>
                    <div class='img-wrap'><img src='../../upload/{$src}' width=100 height=100 class='img-thumbnail img-sm'></div>
                    <figcaption class='media-body'>
                      <h6 class='title text-truncate'>{$row["product_name"]}</h6>
                      <dl class='dlist-inline small'>
                        <dt>Brand: </dt>
                      </dl>
                      <dl class='dlist-inline small'>
                        <dt>Color: </dt>
                        <dd>{$row["color"]}</dd>
                      </dl>
                    </figcaption>
                  </figure> 
                    </td>
                    <td>
                      {$row["fraction"]}
                    </td>
                    <td> 
                      <input name='quantity' min=1 id='{$item}' value={$row["units"]} class='form-control quantity'>
                    </td>
                    <td> 
                      <div class='price-wrap'> 
                        <var class='price' >KES <span id='price-{$item}' class='item-price'>{$selling_price}</span></var> 
                        <small class='text-muted'>(KES <span id='unitprice-{$item}'>{$row["selling_price"]}</span> each)</small> 
                      </div>
                    </td>
                    <td class='text-right'> 
                    <a><button class='btn btn-outline-danger delete-btn' id='{$item}'>× Remove</button></a>
                    </td>
                  </tr>";
                  }
                }
              }
            }
            #End of looping items in the cart..
            echo " 
                </tbody>
              </table>
            </div>
            
            <div class='card'>
              <div class='card-header text-right'> 
                <b><h4>Total : <span id='total'>{$total_price}</span> </h4></b>
              </div>
              <div class='card-body text-right'>
              <a href='index.php'>
                <button class='btn btn-outline-info mr-3'>Continue Shopping</button>
              </a>
                <a href='checkout.php'><button class='btn btn-outline-success'>Checkout and proceed to payment</button></a>
              </div>
            </div> ";
          }else{
            echo "<div class='alert alert-danger'>{$message}</div>";
          }
          ?>
          </div>
      </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

    <script>

      function updateQuantity(id, quantity){
          $.ajax({
            type: "get",
            url: "update_cart.php",
            data: {
              ready_id : id,
              quantity : quantity,
            },
            success: function (data, status) {
                // location.href="view_cart.php"
                // console.log(data)
                let count = JSON.parse(data)
                $(`${id}`).val(count["count"])
                let so  = $(`#${id}`).val()
                // console.log(so)
                calculateTotal(id)
            }
          });
      }

      function calculateTotal(id){
          let quantity = $(`#${id}`).val()
          let price = $(`#unitprice-${id}`).text()
          //Update Price
          let newPrice = Number(quantity) * Number(price)
          $(`#price-${id}`).text(newPrice)
          let total_price = 0
          $(".item-price").each(function(i, obj){
            total_price += Number(obj.innerHTML)
          })
          console.log(total_price)
          $("#total").text(total_price)
          // console.log(quantity)
      }

      function deleteItem(id){
        $.ajax({
            type: "get",
            url: "delete_cart.php",
            data: {
              ready_id : id,
            },
            success: function (data, status) {
              console.log(data)
              location.href="view_cart.php"
            }
          });
      }

      $(document).ready(function(){

        $(".quantity").on("input", function(){
          let ready_id = $(this).attr("id")
          let quantity = $(this).val()
          if(quantity < 1 || quantity == null){
            setTimeout(function(){
              $(this).val(1)
              quantity = 1            
            }, 1000)
          }
          updateQuantity(ready_id, quantity)
        })

        $(".delete-btn").on("click", function(){
          let ready_id = $(this).attr("id")
          deleteItem(ready_id)
        })

      })
    </script>
</body>
</html>