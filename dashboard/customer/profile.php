<!DOCTYPE html>
<html>
<head>
	<title>My Profile</title>
	<?php
	   require_once ('../init.php');
      
	   require_once('../../templates/header.php');
	   
	   //require_once('../../config/database.php');
	   //require_once ('../init.php');
	   
       
       
       $_SESSION['success']="Update Your Profile";
       if(isset($_POST['updatebtn'])){
       	$name=$_POST['fname'];
       	$lastname=$_POST['lname'];
       	$email=$_POST['email'];
       	$phone=$_POST['phone'];
       	$profile=$_FILES['prof'];
       	$krapin=$_POST['krapin'];
       	$address=$_POST['address'];

		$file=$_FILES['prof']['name'];
		$filerror=$_FILES['prof']['error'];
		$filesize=$_FILES['prof']['size'];
		$filetype=$_FILES['prof']['type'];
		$filetemploc=$_FILES['prof']['tmp_name'];
echo'<style>
      #edit{
                display:inline;
            }
       	</style>
       	';
       		

       		$fileExt=explode('.', $file);
       		$fileActExt=strtolower(end($fileExt));
            $allowed= array('jpg','jpeg','png');

            if(in_array($fileActExt, $allowed)){

               $newfilename=uniqid($file,true).".".$fileActExt.'.'.$fileActExt;
               $target="../../upload/".$file;
               move_uploaded_file($filetemploc, $target);

				$sql="update customers set name='$name',lastname='$lastname',email='$email',krapin='$krapin',phone='$phone',profile='$file', address='$address' where user_id=$user_id";
				$res=mysqli_query($conn,$sql);
				if($res){
				$_SESSION['success']="Profile Updated Successfully";
				echo'<meta http-equiv="refresh" content="1/60">';

				}
				else{
				$_SESSION['success']="Failed to update Profile";
				}
            }
            else{
            	echo'You cannot upload file of this type';
            }

            echo'<meta http-equiv="refresh" content="1">';
           
       		
       	
       }

       $update="update your profile";
       $update=$_SESSION['success'];

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
      padding-top:2vh;
			width: 90%;
			min-height:60vh;
			background: ;
			margin-top:5vh ;
			margin-left:5%; 
		}
		.prodicon{
			height: 5vh;
			width:40px;
		}
		body{
			background: #f0f0f0;
		}
		#cancelbtn{
			margin-right: 59%;
		}
		.btn{
			width:20%;
		}
		.avatar{
	         border-radius: 50%;
	         height: 16vh;
	         width: 45%;
	         background:;
	    }
             #uploadfield{
                display:none;

             }
             #input{
              pointer-events:none;
             }

	</style>
</head>

<body>
	<?php
      $sql="select c.user_id as custid,c.name as custname,c.lastname as lastname,c.phone as custphone,u.username as custusername,c.email as email,c.profile as profile,c.krapin as kra,c.address as address from customers c join users u on u.id=c.user_id where c.user_id=$user_id";
      $res=mysqli_query($conn,$sql);
      $row=mysqli_fetch_assoc($res);
      $count=mysqli_num_rows($res);
      $profile=$row['profile'];
      if(!isset($profile)){
      	$profile="../upload/prof1.jpg";
      }

      if(isset($_POST['edit'])){
      	echo'
         <style>
             #uploadfield{
                display:inline;

             }
             #edit{
                display:none;
            }
            #input{
              pointer-events:auto;
             }
         </style>
      	';
      }else{
      	echo'
         <style>
             #uploadfield{
                display:none;

             }
         </style>
      	';
	    }
	?>
   <div class="card">
   	<div class="container bootstrap snippet">
     <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="../../upload/<?php echo $profile?>" class="avatar img-circle" alt="avatar">
          
          
          <input type="file" class="custom-file" name="prof" id="uploadfield" >
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-coffee"></i> <?php echo $update?>
        </div>
       <div style=" width: 50%;">
        <h3>Personal info</h3>
        
       
          <div class="form-group">
            <label class="col-lg-8 control-label">First name:</label>
            <div class="col-lg-12">
              <input class="form-control" type="text" id="input" name="fname" value="<?php echo $row["custname"]?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-8 control-label">Last name:</label>
            <div class="col-lg-12">
              <input class="form-control" id="input" type="text" name="lname" value="<?php echo $row['lastname']?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Phone:</label>
            <div class="col-lg-12">
              <input class="form-control" id="input" type="text" name="phone" value="<?php echo $row["custphone"]?>">
            </div>
          </div>
          <div class="form-group">
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-12">
              <input class="form-control" id="input" type="text" name="email" value="<?php echo $row["email"]?>">
            </div>
          </div>
      </div>
      <div style="position:absolute; width: 50%; left:50%; top:10vh;">
          <h3>Shipping info</h3>
          <div class="form-group">
            <label class="col-lg-3 control-label">KRA PIN:</label>
            <div class="col-lg-12">
              <div class="ui-select">
                <input id="gender" class="form-control" id="input" name="krapin" value="<?php echo $row["kra"]?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-8 control-label">SHIPPPING ADDRESS:</label>
            <div class="col-lg-12">
              <div class="ui-select">
                <input id="gender" class="form-control" id="input" name="address" value="<?php echo $row["address"]?>">
              </div>
            </div>
           </div>
          </div>
          <div class="col-lg-8">
              <input class="btn btn-warning" id="cancelbtn" type="reset" name="cancel" value="Cancel">
              <input class="btn btn-success" type="submit" name="updatebtn" value="Save" id="uploadfield">
              <input class="btn btn-success" type="submit" name="edit" value="Edit Profile" id="edit">
            </div>
        </form>
      </div>
  </div>
</div>
<hr>

    </div>
    <?php require_once('../../templates/footer.php');?>
</body>
</html>