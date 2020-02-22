<?php
include '../config.php';
session_start();
if(strstr($_SESSION['username'],'_',true) != 'guest'){
    $current_user = $_SESSION['username'];
    $check_if_seller = "SELECT CUSTOMER_TYPE, FULL_NAME, EMAIL from users WHERE USER_ID = '$current_user'";
    $results = mysqli_query($con,$check_if_seller);
    if(mysqli_affected_rows($con) > 0){
        
        while($row = mysqli_fetch_assoc($results)){
            $customer_type = $row["CUSTOMER_TYPE"];
            $full_name = $row["FULL_NAME"];
            $email = $row["EMAIL"];
        }
        
        if($customer_type == 0){
            $update_customer_to_seller = "UPDATE users SET CUSTOMER_TYPE = 1 WHERE USER_ID = '$current_user'";
            mysqli_query($con,$update_customer_to_seller);
        }
        
    }
}else{
      $string = '<script type="text/javascript">';
      $string .= 'window.location = "../authentication"';
      $string .= '</script>';
      $_SESSION['message'] = "You must be logged in to sell";
      $_SESSION['from'] = "seller";
      echo $string;
                  
}


$check_number_of_pieces = "SELECT SUM(ART_COUNT) from artwork WHERE USER_ID = '$current_user'";
$result = mysqli_query($con,$check_number_of_pieces);
$check_num_orders = "SELECT COUNT(USER_ID) from cart WHERE ORDERED = 1 && USER_ID = '$current_user'";
$checking_stuff = "SELECT artwork.ART_ID, cart.ORDERED, cart.CART_QTY, artwork.USER_ID, SUM(cart.ORDERED), SUM(artwork.ART_PRICE) FROM artwork INNER JOIN cart ON artwork.ART_ID=cart.ART_ID WHERE artwork.USER_ID = '$current_user' AND cart.ORDERED = 1";
$result2 = mysqli_query($con,$checking_stuff);


$new_pieces = "SELECT count(*) FROM artwork WHERE USER_ID = '$current_user'";
$result3 = mysqli_query($con,$new_pieces);


while($row = mysqli_fetch_array($result3)){
    $piece_count = $row[0][0];
}
while($row = mysqli_fetch_array($result2)){
    $orders_count = $row[0][4];
    $total_sales = $row[0][5];
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Artify ~ Artist</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png"> -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../fonts/icomoon/style.css">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <script src="../js/jquery-3.3.1.min.js"></script>

   <style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }

    </style>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"><i class="menu-icon fa fa-laptop"></i><?php echo $full_name;?></a>
                    </li>
                    <li class="menu-title">ACTIONS</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>ART WORK</a>
                        <ul class="sub-menu children dropdown-menu"><li>
                            <i class="fa fa-puzzle-piece"></i><a href="#" data-toggle="modal" data-target="#uploadModal">Add Art</a></li>
                        </ul>
                    </li>
                   
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                    <!-- <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a> -->
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">1</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 1 Notification</p>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Start selling art now.</p>
                                </a>
                                <!--<a class="dropdown-item media" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Order #257809 failed</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Order #898989 success</p>
                                </a>-->
                            </div>
                        </div>

                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                <span class="count bg-primary">1</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 1 Mail</p>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Admin</span>
                                        <span class="time float-right">Just now</span>
                                        <p>Welcome to Artify.</p>
                                    </div>
                                </a>
                                <!--<a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Jack Sanders</span>
                                        <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Cheryl Wheeler</span>
                                        <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Rachel Santos</span>
                                        <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </div>
                                </a>-->
                            </div>
                        </div>
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="?logout=true"><i class="fa fa-power -off"></i>Logout</a>
                            <?php 
                            if(isset($_GET['logout'])){
                                session_unset();
                                session_destroy();
                                 $string = '<script type="text/javascript">';
                                 $string .= 'window.location = "../"';
                                 $string .= '</script>';
                                 echo $string;
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="pe-7s-cash"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text">Ksh <span class="count"><?php echo $total_sales;?></span></div>
                                            <div class="stat-heading">Revenue</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="pe-7s-cart"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count"><?php echo $orders_count;?></span></div>
                                            <div class="stat-heading">Orders</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="pe-7s-browser"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count"><?php echo $piece_count; ?></span></div>
                                            <div class="stat-heading">Pieces</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="pe-7s-users"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count"><?php echo $orders_count;?></span></div>
                                            <div class="stat-heading">Clients</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Widgets -->
                <div class="clearfix"></div>
                <!-- Orders -->
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">Orders </h4>
                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="serial">#</th>
                                                    <th>ID</th>
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php 
                                                $select_user_values = "SELECT * FROM orders WHERE SELLER_ID = '$current_user'";
                                                $results = mysqli_query($con,$select_user_values);
                                                if(mysqli_num_rows($results) == 0){
                                                    echo '<div class="container">
                                                    <span>You do not have any orders yet!</span>
                                                    </div>';
                                                }
                                                $count = 0;
                                                while($row = mysqli_fetch_array($results)){
                                                    $count += 1;
                                                    echo '<tr>'.
                                                    '<td class="serial">'.$count.'</td>'.
                                                    '<td>'.$row["ORDER_ID"].'</td>'.
                                                    '<td> <span class="product">'.$row["ART_ID"].'</span> </td>'.
                                                    '<td><span class="count">'.$row["ORDER_QTY"].'</span></td>'.
                                                    '<td>
                                                        <span class="badge badge-complete">Complete</span>
                                                    </td>
                                                </tr>';
                                                }
                                                ?>
                                             
                                            </tbody>
                                        </table>
                                    </div> <!-- /.table-stats -->
                                </div>
                            </div> <!-- /.card -->
                            <div class="card">
                                 <div class="card-body">
                                    <h4 class="box-title">Your Artwork </h4>
                                </div>
                                <div class="card-body--">
                                 <div>
                                     <table class="table text-center table-bordered table-striped">
                                         <thead>
                                             <tr>
                                                 <th>#</th>
                                                 <th>Name</th>
                                                 <th>Description</th>
                                                 <th>Price</th>
                                                 <th>Action</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php
                                             $find_user_articles = "SELECT * FROM artwork WHERE user_id = '$current_user'";
                                             $find_user_results = mysqli_query($con,$find_user_articles);
                                             if(mysqli_num_rows($find_user_results) == 0){
                                                    echo '<div class="container">
                                                    <span>Add Art. They will show up here.</span>
                                                    </div>';
                                                }
                                                $count = 0;
                                                while($row = mysqli_fetch_array($find_user_results)){
                                                    $count += 1;
                                                    echo '<tr>'.
                                                    '<td class="serial">'.$count.'</td>'.
                                                    '<td>'.$row["ART_NAME"].'</td>'.
                                                    '<td> <span class="texts">'.$row["ART_DESCRIPTION"].'</span> </td>'.
                                                    '<td><span>Ksh '.$row["ART_PRICE"].'</span></td>'.
                                                    '<td>
                                                       <div class="row">
                                                         <div class="col-md-3"></div>
                                                         <div class="col-md-3"><a class="btn btn-primary" type="button" href=?update='.$row["ART_ID"].'>UPDATE</a></div>
                                                         <div class="col-md-3"><a class="btn btn-danger" type="button" href=?delete='.$row["ART_ID"].'>DELETE</a></div>
                                                         <div class="col-md-3"></div>
                                                     </div>
                                                    </td>
                                                </tr>';
                                                }
                                             ?>
                                         </tbody>
                                     </table>
                                 </div>
                                 </div>
                            </div>
                            
                            <style>
                                .texts{
                                    display: block;
                                    width: 300px;
                                    overflow: hidden;
                                    white-space: nowrap;
                                    text-overflow: ellipsis;
                                }
                            </style>
                            
                        </div>  <!-- /.col-lg-8 -->
                        
                         <div class="card col-xl-4" style="padding: 5%;">
                             
                             <?php
                             
                             if(isset($_GET['update']) || isset($_GET['delete'])){
                                 
                                 if(isset($_GET['update'])){
                                 $update_ID = $_GET['update'];
                                 $deleting = false;
                                 }else{
                                 $update_ID = $_GET['delete'];
                                 $deleting = true;
                                 }                                 
                                 $query_update = "SELECT * from artwork where art_id = '$update_ID'";
                                 
                                 $_SESSION['update_session'] = $update_ID;
                                 
                                 $results = mysqli_query($con,$query_update);
                                 
                                 while($row = mysqli_fetch_array($results)){
                                     $ITEM_NAME = $row["ART_NAME"];
                                     $ITEM_DESC = $row["ART_DESCRIPTION"];
                                     $ITEM_PRICE = $row["ART_PRICE"];
                                     $ITEM_QTY = $row["ART_COUNT"];
                                 }
                                 
                                 ?>
                                 
                                 <form method="post" action"index.php" id="update_form_here">
                                     <div style="margin-left:auto; margin-right-auto;" class="text-center"><p>
                                         <?php
                                         if(isset($_GET['delete'])){
                                            echo 'DELETE:-';
                                         } else{
                                            echo 'UPDATE:-';
                                         }?>
                                         <?php echo $ITEM_NAME;?></p></div>
                                         
                                         <?php
                                          if(isset($_GET['delete'])){
                                         
                                         ?>
                                         
                                         <div class="alert alert-danger" role="alert">
                                             You are about to delete <?php echo $ITEM_NAME;?>
                                         </div>
                                         
                                         <?php
                                         
                                          }
                                         
                                         ?>
                                         
                                         <?php
                                          if(isset($_GET['update'])){
                                         
                                         ?>
                                         
                                         <div class="alert alert-primary" role="alert">
                                             Updating: <?php echo $ITEM_NAME;?>
                                         </div>
                                         
                                         <?php
                                         
                                          }
                                         
                                         ?>
                                    
                                     <div class="form-group">
                                        <label for="update_name">Art Name:</label>
                                        <input type="update_name" class="form-control" id="update_name" value="<?php echo $ITEM_NAME;?>" name="update_name" <?php if($deleting){echo "disabled";}?>>
                                     </div>
                                     
                                     <div class="form-group">
                                         <label for="update_description">Art Description</label>
                                         <textarea class="form-control" id="update_description" name="update_description" rows="5" <?php if($deleting){echo "disabled";}?>><?php echo $ITEM_DESC;?></textarea>
                                     </div>
                                     
                                     <div class=row>
                                         
                                     <div class="form-group col-md-6">
                                         <label for="update_price">Art Price(Ksh)</label>
                                         <input type="number" class="form-control" id="update_price" name="update_price" value="<?php echo $ITEM_PRICE;?>" <?php if($deleting){echo "disabled";}?>>
                                     </div>
                                     
                                     <div class="form-group col-md-6">
                                         <label for="update_qty">Art Quantity</label>
                                         <input type="number" class="form-control" id="update_qty" name="update_qty" value="<?php echo $ITEM_QTY;?>" <?php if($deleting){echo "disabled";}?>>
                                     </div>
                                     
                                     </div>
                                     
                                     <div class="row" <?php if($deleting){echo "hidden";}?>>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                        <input class="btn btn-primary col-md-3" onclick="updateData()" type="submit" id="update_form_here_submit" name="update_form_here_submit" value="UPDATE">
                                    </div>
                                    
                                 </form>
                                 
                                 <form method="post" action="index.php" id="delete_" <?php if(!$deleting){echo "hidden";}?>>
                                     <div class="row" style="margin-top: 2.5%">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                        <input class="btn btn-danger col-md-3" type="submit" id="delete_form_here_submit" name="delete_form_here_submit" value="DELETE">
                                    </div>
                                 </form>
                                 
                                 <script>
                                     function updateData(){
                                         document.getElementById('update_form_here').submit();
                                     }
                                 </script>
                                 
                            <?php     
                             }else{
                                 echo '<div style="margin:auto;"><p>Click on your art work to update.</p></div>';
                             }
                             
                             ?>
                             
                         
                        
                        <?php
                        
                        if(isset($_POST['delete_form_here_submit'])){
                             
                             $update_ID = $_SESSION['update_session'];
                             $delete_query = "DELETE from artwork WHERE ART_ID = '$update_ID'";
                             echo '<script>console.log("'.$update_ID.'");</script>';
                             
                             if(mysqli_query($con,$delete_query)){
                                 
                                 $string = '<script type="text/javascript">';
                                 $string .= 'window.location = "../artist/"';
                                 $string .= '</script>';
                                 echo $string;
                             }
                        }
                        
                        ?>
                        
                        
                        <?php 
                        
                        if(isset($_POST['update_form_here_submit'])){
                            $update_name = $_POST['update_name'];
                            $update_desc = $_POST['update_description'];
                            $update_price = $_POST['update_price'];
                            $update_qty = $_POST['update_qty'];
                            
                            $update_values_query = "UPDATE artwork SET ART_NAME='$update_name', ART_DESCRIPTION='$update_desc', ART_PRICE='$update_price', ART_COUNT='$update_qty' WHERE ART_ID='$update_ID'";
                            
                            if(mysqli_query($con,$update_values_query)){
                                
                                 $string = '<script type="text/javascript">';
                                 $string .= 'window.location = "../artist/?update=';
                                 $string .= $update_ID;
                                 $string .= '"';
                                 $string .= '</script>';
                                 
                                echo $string;
                                
                                ?>
                                <!--
                                <div class="alert alert-success" role="alert" style="margin-top: 5%;">
                                    Updated Successfully
                                </div>-->
                                
                                <?php
                                
                            }
                            
                            
                        }
                        
                        ?>
                        
                        </div>
                    </div>
                </div>
                <!-- /.orders -->
                
                
                
                <!--Delete Item -->
                <div class="modal fade none-border" id="deleteItem">
                    <div class="modal-dialog">
                        <div class="modal-content">
                             <div class="modal-header">
                                <h4 class="modal-title"><strong>Warning! </strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body text-center">
                                <span>Are you sure you want to delete this item <br>from your collection?</span>
                            </div>
                            <div class="modal-footer">
                               <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">No</button>
                                <button type="button" class="btn btn-primary waves-effect waves-light save-category" data-dismiss="modal">Yes</button> 
                            </div>
                        </div>
                    </div>
                </div>
                
                <style>
         #deleteItem{
            position: absolute;
            float: left;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
         }
     </style>
                
                <!-- Modal - Calendar - Add Category -->
                <div class="modal fade none-border" id="add-category">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Add a piece of art </strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">Name of Piece</label>
                                            <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Art Category</label>
                                            <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                                <option value="Sculpture">Sculpture</option>
                                                <option value="Drawing">Drawing</option>
                                                <option value="Photography">Photography</option>
                                                <option value="Prints">Prints</option>
                                                <option value="Paintings">Paintings</option>
                                                <option value="Collectibles">Collectibles</option>
                                                <option value="Jewelery and Accessories">Jewelery and Accessories</option>
                                                <option value="Vintage">Vintage</option>
                                                <option value="Clip Art">Clip Art</option>
                                                <option value="Dolls and Miniatures">Dolls and Miniature</option>
                                                <option value="Fibre Art">Fibre Art</option>
                                                <option value="Mixed Media & Collage">Mixed Media & Collage</option>
                                                <option value="Fine Art Ceramics">Fine Art Ceramics</option>
                                                <option value="Glass Art">Glass Art</option>
                                            </select>
                                        </div>
                                    </div>
                                
                                        <label for="">Add Photos of your art.</label>
                                       
                                     <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                                        aria-describedby="inputGroupFileAddon01">
                                 <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                                
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- /#add-category -->
            
             <style>
         #uploadModal{
            position: absolute;
            float: left;
            left: 50%;
            top: 25%;
            transform: translate(-50%, -25%);
         }
     </style>
            
            <!-- Modal -->
<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog  mw-100 w-75">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Put your art out there.</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form method='post' action='#' enctype="multipart/form-data" id="upload-data-form" name="upload-data-form">
<div class="row">
 <div class="col-md-6">
                        <label class="control-label">Name of Piece</label>
                            <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name"/>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Art Category</label>
                                <select class="form-control form-white" data-placeholder="Choose a color..." name="category-value">
                                    <option value="Sculpture">Sculpture</option>
                                    <option value="Drawing">Drawing</option>
                                    <option value="Photography">Photography</option>
                                    <option value="Prints">Prints</option>
                                                <option value="Paintings">Paintings</option>
                                                <option value="Collectibles">Collectibles</option>
                                                <option value="Jewelery and Accessories">Jewelery and Accessories</option>
                                                <option value="Vintage">Vintage</option>
                                                <option value="Clip Art">Clip Art</option>
                                                <option value="Dolls and Miniatures">Dolls and Miniature</option>
                                                <option value="Fibre Art">Fibre Art</option>
                                                <option value="Mixed Media & Collage">Mixed Media & Collage</option>
                                                <option value="Fine Art Ceramics">Fine Art Ceramics</option>
                                                <option value="Glass Art">Glass Art</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-top:1%;">
                                <div class="col-md-12">
                                    <label class="control-label">Describe your masterpiece</label>
                                    <input class="form-control form-white" placeholder="Tell a story..." type="text" name="art-description"/>
                                </div>
                            </div>
                            
                            <div class="row" style="margin-top:1%;">
                                <div class="col-md-6">
                                    <label class="control-label">Price(Ksh)</label>
                                    <input class="form-control form-white" placeholder="Name your price.." type="number" name="art-price"/>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Quantity</label>
                                    <input class="form-control form-white" placeholder="Number of pieces" type="number" name="art-qty"/>
                                </div>
                            </div>
                                
          Select photos : 
          <input type='file' name='file[]' id='file' class='' style="padding:5%;" multiple><br>
          <input type='button' class='btn btn-info' value='Preview' id='btn_upload'>
        

        <!-- Preview-->
        <div id='preview' class="gallery"></div>
        
        <script>
            
            $(function() {
    // Multiple images preview in browser
         var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#file').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});
            
        </script>
        
      </div>
 
    <div class="modal-footer">
                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary waves-effect waves-light save-category" value="Add Art" id="save-art" name="save-art" onclick="submitData()">
                            </div>
    </div>
</form>
  </div>
</div>
<button class="float btn" data-toggle="modal" data-target="#uploadModal"><h3>Sell Art</h3></button>
<style>
    .float{
	position:fixed;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#0C9;
	color:#FFF;
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}

.my-float{
	margin-top:22px;
}
</style>

<script>
    function submitData(){
       document.getElementById('#upload-data-form').submit(); 
       $('#upload-data-form').submit();
//       $.ajax({
// 		type: "POST",
// 		url: "uploadData.php",
// 		cache:false,
// 		data: $('form#upload-data-form').serialize(),
// 		success: function(response){
			
// 			$("#uploadModal").modal('hide');
// 		},
// 		error: function(){
// 			alert("Error");
// 		}
// 	});
    }
</script>

<?php

if(isset($_POST['save-art'])){
    
    $art_name = $_POST['category-name'];
    $art_category = $_POST['category-value'];
    $art_desc = $_POST['art-description'];
    $art_price = $_POST['art-price'];
    $art_qty = $_POST['art-qty'];
    
    // file name
    $filename = $_FILES['file']['name'];
    $temp_names = $_FILES['file']['tmp_name'];
    
    // Valid image extensions
    $image_ext = array("jpg","png","jpeg","gif");
    
    for($i=0; $i<sizeof($filename); $i++){
        echo '<script>console.log("'.$filename[$i].'")</script>';
        
    $file_name = uniqid('file_');
    // Location
    $location = '../images/'.$file_name.'_'.$filename[$i];

    // file extension
    $file_extension = pathinfo($location, PATHINFO_EXTENSION);
    $file_extension = strtolower($file_extension);
        
    $response = '0';
    if(in_array($file_extension,$image_ext)){
    // Upload file
     if(move_uploaded_file($temp_names[$i],$location)){
        $response = $location;
        if($i != 0){
        $insert_photo = "INSERT into item_images(image_url,art_id) VALUES ('$response','$art_id')";
        mysqli_query($con,$insert_photo);
        }
     }
    }
    
    if($i == 0){
        
        if($response != '0'){
        $art_id = uniqid('ART_');
        $add_art_query = "INSERT into artwork (ART_ID,USER_ID,ART_NAME,ART_DESCRIPTION,
            ART_PRICE,ART_FEATURED,ART_IMAGES,ART_CATEGORY,ART_COUNT) values('$art_id','$current_user','$art_name','$art_desc',
            '$art_price','0','$response','$art_category','$art_qty')";
        mysqli_query($con,$add_art_query);
        
        $string = '<script type="text/javascript">';
                                 $string .= 'window.location = "./"';
                                 $string .= '</script>';
                                 echo $string;
        
    }else{
        echo "<script>console.log('$response');</script>";
    }
        
    }
    
    }
    
    
}

?>

<script>
    $(document).ready(function(){
  $('#btn_upload').click(function(){

    var fd = new FormData();
    var files = $('#file')[0].files[0];
    fd.append('file',files);

    // AJAX request
    $.ajax({
      url: 'ajaxupload.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
        if(response != 0){
          // Show image preview
          $('#preview').append("<img src='"+response+"' width='100' height='100' style='display: inline-block;'>");
        }else{
          alert('Preview not available');
        }
      }
    });
  });
});
</script>
            
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="assets/js/init/fullcalendar-init.js"></script>

    <!--Local Stuff-->
    <script>
        jQuery(document).ready(function($) {
            "use strict";

            // Pie chart flotPie1
            var piedata = [
                { label: "Desktop visits", data: [[1,32]], color: '#5c6bc0'},
                { label: "Tab visits", data: [[1,33]], color: '#ef5350'},
                { label: "Mobile visits", data: [[1,35]], color: '#66bb6a'}
            ];

            $.plot('#flotPie1', piedata, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.65,
                        label: {
                            show: true,
                            radius: 2/3,
                            threshold: 1
                        },
                        stroke: {
                            width: 0
                        }
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                }
            });
            // Pie chart flotPie1  End
            // cellPaiChart
            var cellPaiChart = [
                { label: "Direct Sell", data: [[1,65]], color: '#5b83de'},
                { label: "Channel Sell", data: [[1,35]], color: '#00bfa5'}
            ];
            $.plot('#cellPaiChart', cellPaiChart, {
                series: {
                    pie: {
                        show: true,
                        stroke: {
                            width: 0
                        }
                    }
                },
                legend: {
                    show: false
                },grid: {
                    hoverable: true,
                    clickable: true
                }

            });
            // cellPaiChart End
            // Line Chart  #flotLine5
            var newCust = [[0, 3], [1, 5], [2,4], [3, 7], [4, 9], [5, 3], [6, 6], [7, 4], [8, 10]];

            var plot = $.plot($('#flotLine5'),[{
                data: newCust,
                label: 'New Data Flow',
                color: '#fff'
            }],
            {
                series: {
                    lines: {
                        show: true,
                        lineColor: '#fff',
                        lineWidth: 2
                    },
                    points: {
                        show: true,
                        fill: true,
                        fillColor: "#ffffff",
                        symbol: "circle",
                        radius: 3
                    },
                    shadowSize: 0
                },
                points: {
                    show: true,
                },
                legend: {
                    show: false
                },
                grid: {
                    show: false
                }
            });
            // Line Chart  #flotLine5 End
            // Traffic Chart using chartist
            if ($('#traffic-chart').length) {
                var chart = new Chartist.Line('#traffic-chart', {
                  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                  series: [
                  [0, 18000, 35000,  25000,  22000,  0],
                  [0, 33000, 15000,  20000,  15000,  300],
                  [0, 15000, 28000,  15000,  30000,  5000]
                  ]
              }, {
                  low: 0,
                  showArea: true,
                  showLine: false,
                  showPoint: false,
                  fullWidth: true,
                  axisX: {
                    showGrid: true
                }
            });

                chart.on('draw', function(data) {
                    if(data.type === 'line' || data.type === 'area') {
                        data.element.animate({
                            d: {
                                begin: 2000 * data.index,
                                dur: 2000,
                                from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                                to: data.path.clone().stringify(),
                                easing: Chartist.Svg.Easing.easeOutQuint
                            }
                        });
                    }
                });
            }
            // Traffic Chart using chartist End
            //Traffic chart chart-js
            if ($('#TrafficChart').length) {
                var ctx = document.getElementById( "TrafficChart" );
                ctx.height = 150;
                var myChart = new Chart( ctx, {
                    type: 'line',
                    data: {
                        labels: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul" ],
                        datasets: [
                        {
                            label: "Visit",
                            borderColor: "rgba(4, 73, 203,.09)",
                            borderWidth: "1",
                            backgroundColor: "rgba(4, 73, 203,.5)",
                            data: [ 0, 2900, 5000, 3300, 6000, 3250, 0 ]
                        },
                        {
                            label: "Bounce",
                            borderColor: "rgba(245, 23, 66, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(245, 23, 66,.5)",
                            pointHighlightStroke: "rgba(245, 23, 66,.5)",
                            data: [ 0, 4200, 4500, 1600, 4200, 1500, 4000 ]
                        },
                        {
                            label: "Targeted",
                            borderColor: "rgba(40, 169, 46, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(40, 169, 46, .5)",
                            pointHighlightStroke: "rgba(40, 169, 46,.5)",
                            data: [1000, 5200, 3600, 2600, 4200, 5300, 0 ]
                        }
                        ]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        }

                    }
                } );
            }
            //Traffic chart chart-js  End
            // Bar Chart #flotBarChart
            $.plot("#flotBarChart", [{
                data: [[0, 18], [2, 8], [4, 5], [6, 13],[8,5], [10,7],[12,4], [14,6],[16,15], [18, 9],[20,17], [22,7],[24,4], [26,9],[28,11]],
                bars: {
                    show: true,
                    lineWidth: 0,
                    fillColor: '#ffffff8a'
                }
            }], {
                grid: {
                    show: false
                }
            });
            // Bar Chart #flotBarChart End
        });
    </script>
</body>
</html>
