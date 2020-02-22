<?php
require 'config.php';

session_start();
$user = $_SESSION['admin_username'];
if(!isset($_SESSION['admin_username'])){

  echo '<script>';
  echo 'window.location = "login.php"';
  echo '</script>';

}else if($_SESSION['admin_username'] == "logged_out"){

  echo '<script>';
  echo 'window.location = "login.php"';
  echo '</script>';
}

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<head>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Artify- Admin</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

</head>
<script src="plugins/jquery/jquery.min.js"></script>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

<div class="wrapper">
  
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
    </ul>

    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

  </nav>

 <aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo goes here-->
   <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="Artify" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Artify</span>
    </a>


    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $user;?></a>
        </div>
      </div>
   

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-users nav-icon"></i>
            <p>Artists</p>
          </a>          
        </li>

        <li class="nav-item">
          <a href="#?artist_broad=@users" class="nav-link" data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo">
            <i class="fas fa-envelope-open-text nav-icon"></i>
            <p>Broadcast Users</p>
          </a>          
        </li>

        <li class="nav-item">
          <a href="#?artist_broad=@artists" class="nav-link" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
            <i class="fas fa-envelope-open nav-icon"></i>
            <p>Broadcast Artists</p>
          </a>          
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-comments nav-icon"></i>
            <p>User Comments</p>
          </a>          
        </li>

        <li class="nav-item">
          <a href="?logout=true" class="nav-link">
            <i class="fas fa-sign-out-alt nav-icon"></i>
            <p>Log out</p>
          </a>          
        </li>        

        <li class="nav-item fixed-bottom">
          <div class="nav-link">
            <i class="fas fa-copyright nav-icon"></i>
            <p>Artify @ 2020</p>
          </div>          
        </li>


            <?php

                if(isset($_GET['logout'])){
                    
                    session_unset();
                    session_destroy();
                    echo '<script>';
                    echo 'window.location = "login.php"';
                    echo '</script>';
                    
                }

            ?>

      </ul>
    </nav>
 </div>
 </aside>


</div>

<div class="content-wrapper">
  
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Artify</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Artify</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<section class="content">
  <div class="container-fluid">
    
    <!-- Information section-->

    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Registered Users</span>
                <span class="info-box-number">

                <?php
                #fetch number of users
                $query = "SELECT COUNT(FULL_NAME) FROM users";
                $result = mysqli_query($con,$query);
                $value = 0;

                while($row = mysqli_fetch_assoc($result)){

                $value = $row["COUNT(FULL_NAME)"];

                }
                echo $value;
                

                ?>
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


      <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-brush"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Uploaded Art</span>
                <span class="info-box-number">
                
                <?php
                $query = "SELECT COUNT(_ID) FROM artwork";
                $result = mysqli_query($con,$query);
                $value = 0;

                while($row = mysqli_fetch_assoc($result)){

                $value = $row["COUNT(_ID)"];

                }
                echo $value;
                

                ?>
                
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Orders</span>
                <span class="info-box-number">
                
                <?php
                $query = "SELECT COUNT(ORDER_CHECKED) FROM orders";
                $result = mysqli_query($con,$query);
                $value = 0;

                while($row = mysqli_fetch_assoc($result)){

                $value = $row["COUNT(ORDER_CHECKED)"];

                }
                echo $value;
                

                ?>
                
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Registered Artits</span>
                <span class="info-box-number">
                
                <?php
                $query = "SELECT COUNT(CUSTOMER_TYPE) FROM users WHERE CUSTOMER_TYPE = '1'";
                $result = mysqli_query($con,$query);
                $value = 0;

                while($row = mysqli_fetch_assoc($result)){

                $value = $row["COUNT(CUSTOMER_TYPE)"];

                }
                echo $value;
                

                ?>
                
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

    </div>
    

    <div class="row">
      
      <div class="card col-8" style="height:100%;">
        <div class="card-header border-transparent">
          <h3 class="card-title">Uploaded Art</h3>
          <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
        </div>

        <div class="card-body p-0">

              <div class="form-group container" hidden>
                  <div class="input-group mb-3">
                  <span class="input-group-text">Search</span>
                  <input type="text" name="search_art" id="search_art" placeholder="Search Art By Name"/>
                  </div>
                </div>
                <br/>
               
                <script>

                $(document).ready(function(){
                    $('#search_art').keyup(function(){
                      var search_value = $(this).val();
                      //check if the box has some value
                      if(search_value == ''){

                      }else{
                        $('#result_search').html('');
                        $.ajax({
                          url: "fetch_artwork.php",
                          method: "post",
                          data: {search_art:search_value},
                          dataType:"text",
                          success:function(data){
                            $('#result').html(data);
                          }
                        })
                      }
                    });
                });

                </script>

          <div class="table-responsive">
            <table class="table m-0" id="artTable">
              <thead>
                <tr>
                <th>#</th>
                <th>ART ID</th>
                <th onclick="sortTable(2,'artTable')">Art Name</th>
                <th>Art Category</th>
                <th>Upload Date</th>
                <th>Action</th>
                </tr>
              </thead>
              <tbody id="result_search">
                
              <?php
                
                $query = "SELECT * FROM artwork LIMIT 15";
                $results = mysqli_query($con, $query);

                $index = 0;
                if(mysqli_num_rows($results) > 0){

                  while($row = mysqli_fetch_assoc($results)){
                    ++$index;
                  
                
                ?>

                <tr>
                  <td><?php echo $index;?></td>
                  <td><?php echo $row["ART_ID"];?></td>
                  <td><?php echo $row["ART_NAME"];?></td>
                  <td><?php echo $row["ART_CATEGORY"];?></td>
                  <td><?php echo $row["ART_DATE"];?></td>
                  <td>
                  <div class="row">
                    <a href="?view=<?php echo $row["ART_ID"];?>" class="btn btn-primary" style="margin-right: 2%; width: auto;" onclick="toggleVisibility()">VIEW</a>
                    <a href="?delete=<?php echo $row["ART_ID"];?>" class="btn btn-danger" style="margin-left: 2%; width: auto;">DELETE</a>
                  </div>
                  </td>
                </tr>
                  <?php }
                  
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>

      
    <?php 

    $art_ID = "ART_ID WILL APPEAR";
    $art_NAME = "NAME";
    $art_DESC = "DESCRIPTION";
    $ordersQTY = 0;


    
    if(isset($_GET['view'])){

      $art_ID = $_GET['view'];
      $sql = "SELECT * FROM artwork WHERE ART_ID = '$art_ID'";
      $result = mysqli_query($con,$sql);

      echo '<script>
      function toggleVisibility(){
      document.getElementById("art_details").style.visibility = "visible";
      }
      </script>';


      while($art_ROW = mysqli_fetch_assoc($result)){

        $art_NAME = $art_ROW["ART_NAME"];
        $art_DESC = $art_ROW["ART_DESCRIPTION"];

        $findOrders = "SELECT SUM(ORDER_QTY) FROM orders WHERE ART_ID = '$art_ID'";
        $ordersResult = mysqli_query($con,$findOrders);
        
        $findImages = "SELECT image_url FROM item_images WHERE ART_ID = '$art_ID'";
        $findMainImage = "SELECT ART_IMAGES FROM artwork WHERE ART_ID = '$art_ID'";
        
        $mainImageResult = mysqli_query($con,$findMainImage);
        $imageArray = mysqli_query($con,$findImages);
        
        while($mainImageResultRow = mysqli_fetch_assoc($mainImageResult)){
            
         $main_Image = $mainImagesResultRow["ART_IMAGES"];   
            
        }
        #find the status of tthe artwork

        $status_query = "SELECT ART_HIDDEN WHERE ART_ID = '$art_ID'";
        $status_results = mysqli_query($con,$status_query);

        $actual_pics_found = mysqli_num_rows($imageArray);
        
        $pic1 = "/images/m.png";
        $pic2 = "/images/m.png";
        $pic3 = "/images/m.png";
        
         echo "<script>";
            echo "console.log('1')";
            echo "</script>";
        
        if($actual_pics_found == 0){
            
            $pic1 = '../'.$main_Image;
            $pic2 = '../'.$main_Image;
            $pic3 = '../'.$main_Image;
             echo "<script>";
            echo "console.log('0')";
            echo "</script>";
            
        }else if($actual_pics_found == 1){
            
            $array = array();
            while($imageArrayResultRow = mysqli_fetch_assoc($imagesArray)){
                
                $myImageArray = $imageArrayResultRow["image_url"];
                $array[] = $imageArrayResultRow;
            
            }
            $pic1 = $array["image_url"][0];
            $pic2 = $main_Image;
            $pic3 = $main_Image;
             echo "<script>";
            echo "console.log('1')";
            echo "</script>";

            
        }else if($actual_pics_found == 2){
            
           $array = array();
            while($imageArrayResultRow = mysqli_fetch_assoc($imagesArray)){
                
                $myImageArray = $imageArrayResultRow["image_url"];
                $array[] = $imagesArrayResultRow;
            
            }
            $pic1 = $array["image_url"][0];
            $pic2 = $array["image_url"][1];
            $pic3 = $main_Image;
             echo "<script>";
            echo "console.log('2')";
            echo "</script>";

            
        }else if($actual_pics_found == 3){
            
           $array = array();
            while($imageArrayResultRow = mysqli_fetch_assoc($imagesArray)){
                
                $myImageArray = $imageArrayResultRow["image_url"];
                $array[] = $imagesArrayResultRow;
            
            }
            $pic1 = $array["image_url"][0];
            $pic2 = $array["image_url"][1];
            $pic3 = $array["image_url"][2];
            
            echo "<script>";
            echo "console.log('3')";
            echo "</script>";

            
        }
        
        
        while($ordersRow = mysqli_fetch_assoc($ordersResult)){

          $ordersQTY = $ordersRow["SUM(ORDER_QTY)"];
          if($ordersQTY > 0){
          }else{
            $ordersQTY = 0;
          }

        }

        while($statusRow = mysqli_fetch_assoc($status_results)){
          $status = $statusRow["ART_HIDDEN"];
        }

      }

    } 
    if(isset($_GET['delete'])){


      $art_ID = $_GET['delete'];
      $sql = "DELETE FROM artwork WHERE ART_ID = '$art_ID'";
      $result = mysqli_query($con,$sql);
      $sql2 = "DELETE FROM orders WHERE ART_ID = '$art_ID";
      $result = mysqli_query($con,$sql2);

      // echo '<script>
      // window.location = "index.php";
      // </script>';

      echo '<script language="javascript">';
      echo 'alert("Deleted ART ID: '.$art_ID;
      echo '")';
      echo '</script>';

      // echo '<div class="alert alert-warning">
      // <p>Deleted ART ID: '.$art_ID.'</p></div>';

    }
    
    ?>

  <div id="art_details" class="card col-4" style="height:100%;">
  
  <div class="card-header border-transparent">
          <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
      </div>
<div class="card-body p-0 container">
<div style="padding: 2.5%;">
  <div class="row">
    
    <div class="col-8 container">

              <div class="row">
              <h4 class="col-5">ID: </h4>
              <p class="col-7"><?php echo $art_ID;?></p>
              </div>

              <div class="row">
              <h4 class="col-5">ART NAME: </h4>
              <p class="col-7"><?php echo $art_NAME;?></p>
              </div>

              <div class="row">
              <h4 class="col-5">STATUS: </h4>
              <p class="col-7"><?php if($status == 0){echo "Unapproved!";} else{ echo "Approved";}?></p>
              </div>

    </div>
    <div class="col-4">
      <img src="<?php echo $main_Image;?>" 
      class="rounded" alt="main_thumbnail" id="main_thumbnail" height="100px" width="100px" style="margin: 1%;">
    </div>

  </div>

  <div class="row" style="margin-top: 2%;">
  <h5>DESCRIPTION</h5>
  </div>

  <div class="row">
  <p><?php echo $art_DESC;?></p>
  </div>

  <div class="row" id="rowed">
      <div class="column">
      <img src="<?php echo $pic1;?>" alt="" style="width:100%" height="120px">
      </div>

      <div class="column">
      <img src="<?php echo $pic2;?>" alt="" style="width:100%" height="120px">
      </div>

      <div class="column">
      <img src="<?php echo $pic3;?>" alt="" style="width:100%" height="120px">
      </div>
  </div>

<div class="row" style="margin-top: 2.5%">
<span class="col-3">Orders: <?php echo $ordersQTY;?></span>
<div class="col-2"></div>
<button class="btn btn-danger col-3" style="margin-right: 1%" id="approve_button" name="approve_button" ><?php if($status == 0){ echo "Approve";} else{ echo "Disapprove";}?></button>
<button class="btn btn-warning col-3" style="margin-left: 1%">CONTACT</button>
</div>

</div>
</div>
</div>
    </div>


</script>

    <div class="row">
      
      <div class="card col-8">
         <div class="card-header border-transparent">
          <h3 class="card-title">ARTISTS</h3>
          <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
      </div>
      <div class="card-body p-0">
      <div class="form-group container">
                  <div class="input-group mb-3" hidden>
                  <span class="input-group-text">Search</span>
                  <input type="text" name="search_art" id="search_art" placeholder="Search Art By Name"/>
                  </div>
                </div>
                <br/>
                <div id="result_search"></div>
        <div class="table">
        <script>
function displayModal(actual_email){
  var supplier = document.getElementById("btn_submit").name;
  document.getElementById("recipient-name-personal").value=actual_email;
  $('#exampleModal2').modal();
}
function displayBlockModal(actual_uid){
  var supplier = document.getElementById("btn_submit").name;
  document.getElementById("block_p").innerHTML="Are you sure you want to block: "+actual_uid;
  $('#blockArtistModal').modal();
}
function displayUnblockModal(actual_email){
  var supplier = document.getElementById("btn_submit").name;
  document.getElementById("recipient-name-personal").value=actual_email;
  $('#exampleModal2').modal();
}
</script>
          <table class="table m-0">
            <thead>
            <tr>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>JOIN DATE</th>
            <th>PHONE NUMBER</th>
            <th>ACTION</th>
            </tr>
            </thead>
            <tbody>

                <?php
                
                $query = "SELECT * FROM users WHERE CUSTOMER_TYPE = '1'";
                $result = mysqli_query($con,$query);

                if(mysqli_num_rows($result) > 0 ){

                  while($row = mysqli_fetch_assoc($result)){
                  $memail =  $row["EMAIL"]
                ?>
                <tr>
                    <td><?php echo $row["FULL_NAME"];?></td>
                    <td><?php echo $row["EMAIL"];?></td>
                    <td><?php echo $row["USER_ID"];?></td>
                    <td><?php echo $row["_ID"];?></td>
                    <td>
                  <div class="row">
                    <a href="#?email=<?php echo $row["EMAIL"];?>"  id="btn_submit"  name="<?php echo $row["EMAIL"]?>" 
                    onclick="displayModal('<?php echo $memail;?>')" 
                    class="btn btn-primary" style="margin-right: 2%; width: auto;">EMAIL</a>
                    <a href="#?block=<?php echo $row["USER_ID"];?>" class="btn btn-danger" data-toggle="modal" onclick="displayBlockModal('<?php echo $row["USER_ID"];?>')" style="margin-left: 2%; width: auto;">BLOCK</a>
                  </div>
                  </td>
                </tr>
                <?php 
                }
              }?>
            </tbody>
          </table>
        </div>
      </div>

    </div>

  </div>

  <div class="row">
      
      <div class="card col-12">
         <div class="card-header border-transparent">
          <h3 class="card-title">ORDERS</h3>
          <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
      </div>
      <div class="card-body p-0">
      <div class="form-group">
                  <div class="input-group mb-3" hidden>
                  <span class="input-group-text">Search</span>
                  <input type="text" name="search_art" id="search_art" placeholder="Search Art By Name"/>
                  </div>
                </div>
                <br/>
                <div id="result_search"></div>
        <div class="table">
          <table class="table m-0">
          <thead>
            <tr>
            <th>ORDER_ID</th>
            <th>ITEM_NAME</th>
            <th>ORDER DATE</th>
            <th>CUSTOMER NAME</th>
            <th>CUSTOMER_PHONE</th>
            <th>SELLER</th>
            <th>ACTION</th>
            </tr>
            <tbody>

              <?php
              
              $query = "SELECT * FROM orders";
              $result = mysqli_query($con,$query);

              if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_assoc($result)){

                  $item_ID = $row["ART_ID"];
                  $item_name_query = "SELECT ART_NAME FROM artwork WHERE ART_ID = '$item_ID'";
                  $result_name = mysqli_query($con,$item_name_query); 
                   $seller_ID = $row["SELLER_ID"];
                   $seller_name_query = "SELECT FULL_NAME FROM users WHERE USER_ID = '$seller_ID'";
                   $result_seller_name = mysqli_query($con,$seller_name_query);
                   while($item_seller = mysqli_fetch_assoc($result_seller_name)){
                       
                       $seller_name_actual = $item_seller["FULL_NAME"];
                       
                   }
                  while($item_name = mysqli_fetch_assoc($result_name)){
                    $item_name_actual = $item_name["ART_NAME"];
                    
                   
                    
                    
                    
                  }

              ?>
            <tr>
            <td><?php echo $row["ORDER_ID"];?></td>
            <td><?php echo $item_name_actual;?></td>
            <td><?php echo $row["ORDER_TIME"];?></td>
            <td><?php echo $row["USER_FULL_NAME"];?></td>
            <td><?php echo $row["USER_PHONE"];?></td>
            <td><?php echo $seller_name_actual;?></td>
            <td>
                  <div class="row">
                    <button class="btn btn-primary" style="margin-right: 2%; width: auto;">CONFIRM</button>
                    <button class="btn btn-danger" style="margin-left: 2%; width: auto;">DISMISS</button>
                  </div>
                  </td>
            </tr>
            <?php
                }
              }
            
            ?>
            </tbody>
            </thead>
          </table>
        </div>
      </div>

    </div>

  </div>



<style>
#rowed {
  display: flex;
}

.column {
  flex: 33.33%;
  padding: 5px;
}
</style>



</section>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name" value="@all_artists" disabled>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name" value="@all_users" disabled>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name-personal" value="@all_users" disabled>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="blockArtistModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Warning</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id = "block_p">Are you sure you want to block: <?php echo $_GET['block'];?></p>
      </div>
      <div class="modal-footer">
        <a href="#?blocked=true" type="button" class="btn btn-danger">Yes</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="unblockArtistModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Warning</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>You are about to unblock: <?php echo $_GET['unblock']?></p>
      </div>
      <div class="modal-footer">
        <a href = "#?unblocked=true" type="button" class="btn btn-primary">Yes</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

<script>
function sortTable(n,myTableId) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById(myTableId);
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>


<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>

</body>
</html>