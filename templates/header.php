<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

</body>
</html>>
<?php

include ("/home2/housinn1/public_html/willie/init.php");
if (isset( $_SESSION["id"]) && isset($_SESSION["type"])){
   $user_id = $_SESSION["id"];
    $user_type = $_SESSION["type"]; 
}else{
    //session_start();
}

$server_root = "/willie";

echo "<header>";
if(isset($user_id) && isset($user_type) ){
    if($user_type == 1){
        $sql = "select * from customers where user_id=$user_id";
        $sqlres=mysqli_query($conn,$sql);
        $rows=mysqli_fetch_array($sqlres);
        $name=$rows['name'];
        $profile=$rows['profile'];
            


        $sql1 = "select count(id) as count from orders where customer_id=$user_id and status='unconfirmed'";
        $sqlres1=mysqli_query($conn,$sql1);
        $rows1=mysqli_fetch_array($sqlres1);
        $count=$rows1['count'];
        echo "
                    <nav class='navbar navbar-expand-md navbar-light fixed-top bg-light'>
                    <a class='navbar-brand' href='{$server_root}/index.php'>
                        <img src='{$server_root}/public/img/LOGO.png' width='50px' height='75px' alt='Homepage'>
                    </a>
            
                    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarCollapse'
                    aria-controls='navbarCollapse' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarCollapse'>
                    <ul class='navbar-nav ml-auto'>
                   

                    <li class='nav-item active mr-4'>
                        <a class='nav-link' href='{$server_root}/dashboard/customer/index.php'>Home</a>
                    </li>


                    <li class='nav-item active mr-4'>
                        <a class='nav-link' href='../customer/orders.php'>Orders</a>
                    </li>
                    
                      <li class='nav-item active mr-4'>
                            <a class='nav-link' href='{$server_root
                                }/dashboard/customer/view_cart.php'><i id='cart' class='fa fa-shopping-cart'><sup class='numb'>".$count."</sup></i></a>  
                        </li>
                    <li class='nav-item active mr-4'>

                       <div class='dropdown'>
                                <button class='dropbtn'><div class='prof'>";
                                  if($profile){
                            echo" <div id='pic'>
                                    <a href='../../dashboard/customer/profile.php'><img id='pp' src='../../upload/".$profile."'></a>
                                    </div>";

                                }
                                else{
                                   echo" <div id='details'>
                                            <a href='../../dashboard/customer/profile.php'>Hello ".$name."</a>
                                         </div>";
                                }

                           echo"
                                
                            </div>
                       </button>
                                <div class='dropdown-content'>
                                    <a class='nav-link' href='{$server_root}/auth/logout.php' style=color:red;>Logout</a>
                                </div>
                        </div>

                       <style>

                            #pic,#pp{
                                height:7vh;
                                width:50px;
                                border-radius:50%;
                                margin-top:-0.5vh;
                                
                            }
                            #details{
                                    font-size:12px;
                                    color:green;
                            }
                            .numb{
                                color:red;
                                font-size:14px;
                                font-weight:bold;
                            }
                            #cart{
                               font-size:22px; 
                               color:#3CC9D5;
                            }
                                /* Dropdown Button */
                            .dropbtn {
                              background-color: transparent;
                              color: white;
                              padding: ;
                              font-size: 16px;
                              border: none;
                            }

                            /* The container <div> - needed to position the dropdown content */
                            .dropdown {
                              position: relative;
                              display: inline-block;
                            }

                            /* Dropdown Content (Hidden by Default) */
                            .dropdown-content {
                              display: none;
                              position: absolute;
                              background-color: #f1f1f1;
                              min-width: 160px;
                              box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                              z-index: 1;
                            }

                            /* Links inside the dropdown */
                            .dropdown-content a {
                              color: black;
                              padding: 12px 16px;
                              text-decoration: none;
                              display: block;
                            }

                            /* Change color of dropdown links on hover */
                            .dropdown-content a:hover {background-color: #ddd;}

                            /* Show the dropdown menu on hover */
                            .dropdown:hover .dropdown-content {display: block;}

                            /* Change the background color of the dropdown button when the dropdown content is shown */
                            .dropdown:hover .dropbtn {background-color: transparent;}
                            

                       </style> 
                    </li>
    
                    <li class='nav-item mr-auto'>
                    <div id='dropdiv' class='m-auto'>
            
                        <div class='dropdown'>
                                <input class='dropdown-toggle' data-toggle='dropdown' id='servicesbtn' type='image' src='{$server_root}/public/img/services.png' aria-disabled='false' width='25px' height='25px' alt='services' padding='1rem' style='margin:0.5rem'>
            
                                <div class='dropdown-menu dropdown-menu-left' style= ' right: 0; left: auto'>
                                    <h5 class='text-center'> Our Services</h5>
                                    <hr>
                                    <div class='d-flex'>
                                        <a class='dropdown-item service' href='{$server_root}/index.php'><img src='{$server_root}/public/img/LOGO.png' width='50' height='75'></a>
                                    <a class='dropdown-item service' href='https://housingsmart.co.ke/homepage'><img src='{$server_root}/public/img/housing.jpg' width='50' height='75'></a>
                                    </div>
            
                                    <div class='d-flex'>
                                        <a class='dropdown-item service' href='#'>Health</a>
                                        <a class='dropdown-item service' href='#'>Food</a>
                                    </div>
            
                                    <div class='d-flex'>
                                        <a class='dropdown-item service' href='#'>Clothing</a>
                                        <a class='dropdown-item service' href='#'>Security</a>
                                    </div>
            
                                    <div class='d-flex'>
                                        <a class='dropdown-item service' href='#'>Education</a>
                                        <a class='dropdown-item service' href='#'>Transport</a>
                                    </div>
                                    
                                    <div class='d-flex'>
                                        <a class='dropdown-item service' href='#'>Innovation</a>
                                        <a class='dropdown-item service' href='#'>Health</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                      
                    </ul>
    
                </div>";
    }
    elseif($user_type == 2){
        $sql = "select * from suppliers where user_id=$user_id";
        $sqlres=mysqli_query($conn,$sql);
        $rows=mysqli_fetch_array($sqlres);
        $name=$rows['name'];
        echo "
                    <nav class='navbar navbar-expand-md navbar-light fixed-top bg-light'>
                    <a class='navbar-brand' href='{$server_root}/index.php'>
                        <img src='{$server_root}/public/img/LOGO.png' width='50px' height='75px' alt='Homepage'>
                    </a>
                    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarCollapse'
                    aria-controls='navbarCollapse' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarCollapse'>
                    <ul class='navbar-nav ml-auto'>

           

                  <li class='nav-item active mr-4'>
                        <a class='nav-link' href='{$server_root}/dashboard/customer/index.php'>Customer</a>
                        </li>
                   
                        <li class='nav-item active mr-4'>
                        <a class='nav-link' href='{$server_root}/dashboard/supplier/index.php'>Shop</a>
                        </li>



                        <li class='nav-item active mr-4'>
                        <a class='nav-link' href='{$server_root}/dashboard/purchases/index.php'>Purchase receipts</a>
                        </li>
    
                        <li class='nav-item active mr-4'>
                        <a class='nav-link' href='{$server_root}/dashboard/sales/index.php'>Sales Receipts</a>
                        </li>

                        <li class='nav-item active mr-4'>
                            <a class='nav-link'href='{$server_root}/dashboard/kra/index.php'>KRA</a>
                        </li>


                        <li class='nav-item active mr-4'>
                            <a class='nav-link' href='{$server_root}/dashboard/inventory/index.php'>Store</a>
                        </li>

                        <li class='nav-item active mr-4'>
                       <a class='nav-link' href='{$server_root}/auth/logout.php' style=color:red;>Logout</a>
                       
                    </li>
    
                        <li class='nav-item mr-auto'>
                        <div id='dropdiv' class='m-auto'>

                            <div class='dropdown'>
                                    <input class='dropdown-toggle' data-toggle='dropdown' id='servicesbtn' type='image' src='{$server_root}/public/img/services.png' aria-disabled='false' width='25px' height='25px' alt='services' padding='1rem' style='margin:0.5rem'>

                                    <div class='dropdown-menu dropdown-menu-left' style= ' right: 0; left: auto'>
                                        <h5 class='text-center'> Our Services</h5>
                                        <hr>
                                        <div class='d-flex'>
                                        <a class='dropdown-item service' href='{$server_root}/index.php'><img src='{$server_root}/public/img/LOGO.png' width='50' height='75'></a>
                                    <a class='dropdown-item service' href='https://housingsmart.co.ke/homepage'><img src='{$server_root}/public/img/housing.jpg' width='50' height='75'></a>
                                    </div>
                                        <div class='d-flex'>
                                            <a class='dropdown-item service' href='#'>Health</a>
                                            <a class='dropdown-item service' href='#'>Food</a>
                                        </div>

                                        <div class='d-flex'>
                                            <a class='dropdown-item service' href='#'>Clothing</a>
                                            <a class='dropdown-item service' href='#'>Security</a>
                                        </div>

                                        <div class='d-flex'>
                                            <a class='dropdown-item service' href='#'>Education</a>
                                            <a class='dropdown-item service' href='#'>Transport</a>
                                        </div>
                                        
                                        <div class='d-flex'>
                                            <a class='dropdown-item service' href='#'>Innovation</a>
                                            <a class='dropdown-item service' href='#'>Health</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    
                    </ul>
                </div>";
    }
}else{
    echo "
                <nav class='navbar navbar-expand-md navbar-light fixed-top bg-light'>
                <a class='navbar-brand' href='{$server_root}/index.php'>
                    <img src='{$server_root}/public/img/LOGO.png' width='50px' height='75px' alt='Homepage'>
                </a>
                <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarCollapse'
                aria-controls='navbarCollapse' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarCollapse'>
                <ul class='navbar-nav ml-auto'>
                    <li class='nav-item active mr-4'>
                        <a class='nav-link' href='{$server_root}/auth/login.php'>Login</a>
                    </li>

                    <li class='nav-item active mr-4'>
                        <a class='nav-link' href='{$server_root}/auth/register.php'>Register</a>
                    </li>

                    <li class='nav-item mr-auto'>
                    <div id='dropdiv' class='m-auto'>
            
                        <div class='dropdown'>
                                <input class='dropdown-toggle' data-toggle='dropdown' id='servicesbtn' type='image' src='{$server_root}/public/img/services.png' aria-disabled='false' width='25px' height='25px' alt='services' padding='1rem' style='margin:0.5rem'>
            
                                <div class='dropdown-menu dropdown-menu-left' style= ' right: 0; left: auto'>
                                    <h5 class='text-center'> Our Services</h5>
                                    <hr>
                                    <div class='d-flex'>
                                        <a class='dropdown-item service' href='{$server_root}/index.php'><img src='{$server_root}/public/img/LOGO.png' width='50' height='75'></a>
                                    <a class='dropdown-item service' href='https://housingsmart.co.ke/homepage'><img src='{$server_root}/public/img/housing.jpg' width='50' height='75'></a>
                                    </div>
            
                                    <div class='d-flex'>
                                        <a class='dropdown-item service' href='#'>Health</a>
                                        <a class='dropdown-item service' href='#'>Food</a>
                                    </div>
            
                                    <div class='d-flex'>
                                        <a class='dropdown-item service' href='#'>Clothing</a>
                                        <a class='dropdown-item service' href='#'>Security</a>
                                    </div>
            
                                    <div class='d-flex'>
                                        <a class='dropdown-item service' href='#'>Education</a>
                                        <a class='dropdown-item service' href='#'>Transport</a>
                                    </div>
                                    
                                    <div class='d-flex'>
                                        <a class='dropdown-item service' href='#'>Innovation</a>
                                        <a class='dropdown-item service' href='#'>Health</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>

            </div>";
}
?>
</nav>
</header>
