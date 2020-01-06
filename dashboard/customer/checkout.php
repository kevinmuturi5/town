<!DOCTYPE html>
<html>
<head>
	<title>My Orders</title>
	<?php
	   session_start();
	   require_once('../../templates/header.php');
	  
	   require_once('../../config/database.php');
	   require_once ('../init.php');
       $user_id=$_SESSION['id'];


	?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<style type="text/css">
		#maincard{
			width: 90%;
			min-height:60vh;
			background: ;
			margin-top: 15vh;
			margin-left:5%; 
		}
		.prodicon{
			height: 5vh;
			width:40px;
		}
		body{
			background: #f0f0f0;
		}
		.amount{
			color: orange;
		}
	
	</style>
</head>
<body>
	<?php
	  $qry="insert into sales(select '',o.id,p.id,p.name,p.sku,o.units,p.unit_price,(o.units*p.unit_price) as subtotal,0.16*(o.units*p.unit_price) as vat,p.supplier_id,o.customer_id,current_timestamp,'declared' from orders o join products p on(o.product_id=p.id) where status='unconfirmed' and customer_id=$user_id)";
      $res=mysqli_query($conn,$qry);

      $sql="update orders set status='confirmed' where status='unconfirmed' and customer_id=$user_id";
      $res=mysqli_query($conn,$sql);
    
      $sql1="select sum(cost*units) as amount from orders where status='confirmed' and customer_id=$user_id";
      $res1=mysqli_query($conn,$sql1);
      $row=mysqli_fetch_assoc($res1);
      $amount=number_format(($row['amount']));
	?>
   <div class="card" id="maincard">
      <div class="alert alert-success">
        <strong>Order submited Successfully!</strong><h3>Make your payment of <?php echo"<strong class='amount'>KSH "; if($amount){echo $amount;}else{echo "0";} echo"</strong>" ?> by withdrawing through Agent No. :<strong class='amount'> 082482</strong>(Power Comms Six seventeen shop stage mpya pipeline).<h3>
      </div>
   </div>
   <?php include('../../templates/footer.php');?>
</body>
</html>


