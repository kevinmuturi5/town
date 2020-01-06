<!DOCTYPE html>
<html>
<head>
	<title>My Orders</title>
	<?php
	   session_start();
	   require_once('../../templates/header.php');
	   require_once('../../templates/footer.php');
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
		.card{
			width: 90%;
			min-height:60vh;
			background: ;
			margin-top: 5vh;
			margin-left:5%; 
		}
		.prodicon{
			height: 5vh;
			width:40px;
		}
		body{
			background: #f0f0f0;
		}
	</style>
</head>
<body>
	<?php
      $sql="select c.user_id as custid,c.name as custname,c.phone as custphone,p.images as prodimg,p.id as prodid,p.name as prodname,p.description as proddesc,o.units as prodqnty,o.cost as unitprice, s.id as suppid,s.name as suppname,s.phone as supp_phone,o.status as delstatus,o.units*o.cost as total,o.securitycode as seccode from products p join orders o on p.id=o.product_id join customers c on o.customer_id=c.user_id join suppliers s on p.supplier_id=s.user_id where c.user_id=$user_id and o.status='confirmed'";
      $res=mysqli_query($conn,$sql);
      $count=mysqli_num_rows($res);
	?>
   <div class="card">
   	<?php if($count>0){
   		echo'
   		    <table class="table">
   		    <thead>
			    <tr>
			      <th scope="col">Image</th>
			      <th scope="col">Product ID</th>
			      <th scope="col">Product Name</th>
			      <th scope="col">Quantity</th>
			      <th scope="col">Unit Cost</th>
			      <th scope="col">Total</th>
			      <th scope="col">Delivery Status</th>
			      <th scope="col">Shipping code</th>
			    </tr>
  			</thead>

   		';
   		while ($row=mysqli_fetch_assoc($res)) {
   			echo '
   			     <tbody>
				    <tr>
				      <td> <img class="prodicon" src=../../upload/'.$row["prodimg"].'></td>
				      <td>'.$row["prodid"].'</td>
				      <td>'.$row["prodname"].'</td>
				      <td>'.$row["prodqnty"].'</td>
				      <td>'.$row["unitprice"].'</td>
				      <td>'.$row["total"].'</td>
				      <td>'.$row["delstatus"].'</td>
				      <td>'.$row["seccode"].'</td>
				    </tr>

   			';
   		}
   	}
   	else{
   		echo'<div class="alert alert-warning ">
          <a class="panel-close close" data-dismiss="alert"></a> 
          <i class="fa fa-coffee"></i>No records of orders made yet
        </div>';

   	}?>
   	
                </tbody>
            </table>
    </div>
</body>
</html>